from flask import Flask, request, jsonify
from flask_cors import CORS
from io import BytesIO
from PIL import Image
from datetime import datetime
import face_recognition
import numpy as np
import base64
import os
import uuid
import threading
import time
import pymysql

# Global untuk master wajah
master_encodings = []
master_names     = []

BASE_DIR = os.path.abspath(os.path.dirname(__file__))
PROJECT_DIR = os.path.dirname(BASE_DIR)


app = Flask(__name__)
CORS(app)

# === Folder master wajah & folder absensi ===
MASTER_FOLDER          = os.path.join(PROJECT_DIR, "assets", "images", "avatars")
ATTENDANCE_FOLDER      = os.path.join(PROJECT_DIR, "assets", "attendance")
FACERECOGNITION_FOLDER = os.path.join(PROJECT_DIR, "assets", "facerecognition")

# Pastikan folder ada
os.makedirs(MASTER_FOLDER, exist_ok=True)
os.makedirs(ATTENDANCE_FOLDER, exist_ok=True)
os.makedirs(FACERECOGNITION_FOLDER, exist_ok=True)

def get_db_connection():
    return pymysql.connect(
        host='192.168.200.105',
        user='joker',
        password='midlane',
        database='sikms',
        cursorclass=pymysql.cursors.DictCursor
    )

def timestamp():
    return datetime.now().strftime("%Y-%m-%d %H:%M:%S")

class LogColor:
    INFO    = "\033[94m"
    WARN    = "\033[93m"
    SUCCESS = "\033[92m"
    ERROR   = "\033[91m"
    END     = "\033[0m"

def log_info(msg): print(f"🔵 {LogColor.INFO}[INFO]{LogColor.END}\t{timestamp()} {msg}")
def log_warn(msg): print(f"🟡 {LogColor.WARN}[WARN]{LogColor.END}\t{timestamp()} {msg}")
def log_success(msg): print(f"🟢 {LogColor.SUCCESS}[SUCCESS]{LogColor.END}\t{timestamp()} {msg}")
def log_error(msg): print(f"🔴 {LogColor.ERROR}[ERROR]{LogColor.END}\t{timestamp()} {msg}")

def update_facerecognition_status(filename, status, confidence=0, user_id=None):
    try:
        conn = get_db_connection()
        with conn.cursor() as cur:
            sql = """
                UPDATE dt01_gen_facerecognition_hd
                SET status = %s,
                    confidence = %s,
                    user_id = %s
                WHERE image_id = %s
            """
            cur.execute(sql, (status, confidence, user_id, filename))
            conn.commit()
        conn.close()
        log_info(f"[DB] Update {filename}: status={status}, conf={confidence:.2f}%, user_id={user_id}")
    except Exception as e:
        log_error(f"[DB] Gagal update untuk {filename}: {e}")




def face_confidence(face_distance, face_match_threshold=0.6):
    if face_distance > face_match_threshold:
        range_ = (1.0 - face_match_threshold)
        linear_val = (1.0 - face_distance) / (range_ * 2.0)
        return linear_val * 100
    else:
        range_ = face_match_threshold
        linear_val = 1.0 - (face_distance / (range_ * 2.0))
        return linear_val * 100


def load_master_faces():
    global master_encodings, master_names
    encodings, names = [], []

    files = [f for f in os.listdir(MASTER_FOLDER) if f.lower().endswith('.jpeg')]

    if not files:
        log_warn("Tidak ada file wajah di folder master.")
        return

    for f in files:
        path = os.path.join(MASTER_FOLDER, f)
        try:
            with Image.open(path) as img:
                img = img.convert('RGB')
                img_np = np.array(img)

            enc = face_recognition.face_encodings(img_np)
            if enc:
                encodings.append(enc[0])
                names.append(os.path.splitext(f)[0])
                log_info(f"Master loaded: {f}")
            else:
                log_warn(f"Tidak ada wajah di {f}")

        except Exception as e:
            log_error(f"Gagal load {f}: {e}")

    master_encodings = encodings
    master_names = names
    log_success(f"Master wajah siap: {len(master_encodings)} file.")

# def auto_detect_faces():
#     log_info("=== Memulai auto detect wajah dari folder attendance ===")
#     load_master_faces()

#     while True:
#         try:
#             if not os.path.exists(ATTENDANCE_FOLDER):
#                 log_error(f"Folder tidak ditemukan: {ATTENDANCE_FOLDER}")
#                 time.sleep(5)
#                 continue

#             files = [
#                 f for f in os.listdir(ATTENDANCE_FOLDER)
#                 if f.lower().endswith(('.jpeg', '.jpg', '.png'))
#             ]

#             if not files:
#                 time.sleep(2)
#                 continue

#             for filename in files:
#                 try:
#                     path = os.path.join(ATTENDANCE_FOLDER, filename)
#                     if not os.path.isfile(path):
#                         continue

#                     log_warn(f"Memproses file: {filename}")

#                     with Image.open(path) as img:
#                         img = img.convert('RGB')
#                         img_np = np.array(img)

#                     face_locations = face_recognition.face_locations(img_np)
#                     face_encodings = face_recognition.face_encodings(img_np, face_locations)

#                     # Default jika tidak ada wajah / master kosong
#                     status = 9
#                     best_conf = 0.0
#                     best_name = "Unknown"
#                     newname = f"done_nowface_{filename}"

#                     if face_encodings and master_encodings:
#                         # Cek tiap wajah di gambar
#                         for face_encoding in face_encodings:
#                             distances = face_recognition.face_distance(master_encodings, face_encoding)
#                             if len(distances) == 0:
#                                 continue

#                             matches = face_recognition.compare_faces(master_encodings, face_encoding)
#                             best_match_index = np.argmin(distances)
#                             confidence = face_confidence(distances[best_match_index])
#                             name = master_names[best_match_index] if matches[best_match_index] else "Unknown"

#                             # Ambil confidence tertinggi
#                             if confidence > best_conf:
#                                 best_conf = confidence
#                                 best_name = name

#                         # Tentukan status berdasarkan threshold 70%
#                         if best_conf > 70.0:
#                             status = 1
#                             newname = filename
#                             log_success(f"{filename} dikenali sebagai {best_name} ({best_conf:.2f}%)")
#                         else:
#                             status = 9
#                             best_name = "Unknown"
#                             best_conf = 0.0
#                             log_warn(f"{filename} wajah terdeteksi tapi confidence rendah ({best_conf:.2f}%)")
#                     else:
#                         if not face_encodings:
#                             log_warn(f"Tidak ada wajah pada {filename}")
#                         else:
#                             log_warn("Master wajah kosong, lewati perbandingan.")

#                     # Pindahkan file ke folder hasil
#                     new_path = os.path.join(FACERECOGNITION_FOLDER, newname)
#                     os.rename(path, new_path)

#                     # Update database dengan status & confidence
#                     base_filename = os.path.splitext(filename)[0]
#                     update_facerecognition_status(
#                         base_filename,
#                         status=status,
#                         confidence=best_conf,
#                         user_id=best_name
#                     )

#                 except Exception as e:
#                     log_error(f"Gagal memproses {filename}: {e}")
#                     time.sleep(0.5)
#                     continue

#         except Exception as e:
#             log_error(f"[auto_detect_faces] Error utama: {e}")

#         time.sleep(3)

def auto_detect_faces():
    log_info("=== Memulai auto detect wajah dari folder attendance ===")
    # load_master_faces()

    while True:
        try:
            if not os.path.exists(ATTENDANCE_FOLDER):
                log_error(f"Folder tidak ditemukan: {ATTENDANCE_FOLDER}")
                time.sleep(1)
                continue

            # Ambil semua file gambar baru
            files = [
                f for f in os.listdir(ATTENDANCE_FOLDER)
                if f.lower().endswith(('.jpeg', '.jpg', '.png'))
            ]

            if not files:
                time.sleep(1)
                continue

            for filename in files:
                path = os.path.join(ATTENDANCE_FOLDER, filename)
                if not os.path.isfile(path):
                    continue

                try:
                    # Fungsi bantu deteksi wajah
                    def detect_face(img_path):
                        """Return best_name, best_conf, has_face"""
                        log_warn(f"Memproses file: {filename}")  # dicetak sekali per file
                        with Image.open(img_path) as img:
                            img = img.convert('RGB')
                            img_np = np.array(img)

                        face_locations = face_recognition.face_locations(img_np)
                        face_encodings = face_recognition.face_encodings(img_np, face_locations)

                        best_name = "Unknown"
                        best_conf = 0.0
                        has_face = bool(face_encodings)

                        if face_encodings and master_encodings:
                            for face_encoding in face_encodings:
                                distances = face_recognition.face_distance(master_encodings, face_encoding)
                                if len(distances) == 0:
                                    continue

                                matches = face_recognition.compare_faces(master_encodings, face_encoding)
                                best_match_index = np.argmin(distances)
                                confidence = face_confidence(distances[best_match_index])
                                name = master_names[best_match_index] if matches[best_match_index] else "Unknown"

                                if confidence > best_conf:
                                    best_conf = confidence
                                    best_name = name

                        return best_name, best_conf, has_face

                    # Deteksi wajah sekali
                    best_name, best_conf, has_face = detect_face(path)

                    # Tentukan status
                    if has_face and best_conf >= 50.0:
                        status = 1
                        newname = filename
                        log_success(f"{filename} dikenali sebagai {best_name} ({best_conf:.2f}%)")
                    else:
                        status = 9
                        best_name = "Unknown"
                        best_conf = 0.0
                        newname = f"done_nowface_{filename}"
                        if not has_face:
                            log_warn(f"Tidak ada wajah pada {filename}")
                        else:
                            log_warn(f"{filename} wajah terdeteksi tapi confidence rendah ({best_conf:.2f}%)")

                    # Pindahkan file hanya jika masih ada
                    if os.path.exists(path):
                        new_path = os.path.join(FACERECOGNITION_FOLDER, newname)
                        try:
                            os.rename(path, new_path)
                        except Exception as e:
                            log_error(f"Gagal memindahkan {filename}: {e}")
                    else:
                        log_warn(f"File {filename} sudah dipindahkan, lewati rename")

                    # Update database
                    base_filename = os.path.splitext(filename)[0]
                    update_facerecognition_status(
                        base_filename,
                        status=status,
                        confidence=best_conf,
                        user_id=best_name
                    )

                except Exception as e:
                    log_error(f"Gagal memproses {filename}: {e}")
                    time.sleep(0.1)
                    continue

        except Exception as e:
            log_error(f"[auto_detect_faces] Error utama: {e}")

        time.sleep(1)  # cek folder tiap detik


def auto_reload_master():
    while True:
        load_master_faces()
        time.sleep(10)

     

if __name__ == '__main__':
    log_info("=== Konfigurasi Folder ===")
    log_info(f"MASTER_FOLDER     : {MASTER_FOLDER}")
    log_info(f"ATTENDANCE_FOLDER : {ATTENDANCE_FOLDER}")
    log_info(f"FACERECOGNITION   : {FACERECOGNITION_FOLDER}")
    log_info("===========================")

    load_master_faces()
    threading.Thread(target=auto_detect_faces, daemon=True).start()
    threading.Thread(target=auto_detect_faces, daemon=True).start()
    app.run(host='0.0.0.0', port=5000, debug=True, use_reloader=True)