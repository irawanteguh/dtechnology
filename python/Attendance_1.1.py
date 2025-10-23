import cv2
from flask import Flask, request, jsonify
from flask_cors import CORS
from io import BytesIO
from PIL import Image, ImageOps
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
    """
    Memperbarui status, tingkat kepercayaan (confidence), dan user_id 
    untuk data face recognition berdasarkan image_id (filename).
    """
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

def face_confidence(distance, threshold=0.45):
    """Konversi jarak jadi confidence dengan kurva logistik"""
    if distance > 1:
        distance = 1
    confidence = 100 / (1 + np.exp(12 * (distance - threshold)))
    return round(confidence, 2)

def preprocess_image(image_path):
    img = Image.open(image_path).convert('RGB')
    img = ImageOps.exif_transpose(img)
    
    # ✅ Batasi resize hanya jika terlalu besar
    if img.width > 1000:
        scale = 800 / img.width
        img = img.resize((800, int(img.height * scale)))

    img_np = np.array(img)

    # ✅ Ubah ke YUV untuk sedikit normalisasi pencahayaan
    img_yuv = cv2.cvtColor(img_np, cv2.COLOR_RGB2YUV)
    img_yuv[:, :, 0] = cv2.equalizeHist(img_yuv[:, :, 0])
    img_eq = cv2.cvtColor(img_yuv, cv2.COLOR_YUV2RGB)

    # ✅ Hindari blur; cukup tambahkan sedikit peningkatan kontras lembut
    img_eq = cv2.convertScaleAbs(img_eq, alpha=1.05, beta=5)

    return img_eq

def load_master_faces():
    """Muat semua wajah master ke memory"""
    global master_encodings, master_names
    encodings, names = [], []

    files = [f for f in os.listdir(MASTER_FOLDER) if f.lower().endswith(('.jpeg', '.jpg', '.png'))]
    if not files:
        log_warn("Tidak ada file wajah di folder master.")
        return

    for f in files:
        path = os.path.join(MASTER_FOLDER, f)
        try:
            img_eq = preprocess_image(path)

            face_locations = face_recognition.face_locations(img_eq, model='hog')
            face_encs = face_recognition.face_encodings(img_eq, face_locations)

            if face_encs:
                for enc in face_encs:
                    encodings.append(enc)
                    names.append(os.path.splitext(f)[0])
                log_info(f"Master loaded: {f} ({len(face_encs)} wajah)")
            else:
                log_warn(f"Tidak ada wajah pada {f}")

        except Exception as e:
            log_error(f"Gagal load {f}: {e}")

    master_encodings = encodings
    master_names = names
    log_success(f"Master wajah siap: {len(master_encodings)} wajah terdaftar.")

# def detect_face(path, tolerance=0.5):
#     """Mendeteksi wajah dan mencocokkannya dengan master face menggunakan tolerance."""
#     global master_encodings, master_names
#     img_eq = preprocess_image(path)

#     # Gunakan model HOG (lebih ringan) atau CNN (lebih akurat)
#     face_locations = face_recognition.face_locations(img_eq, model='hog')
#     face_encodings = face_recognition.face_encodings(img_eq, face_locations)

#     if not face_encodings:
#         return "NoFace", 0.0, False

#     best_name = "Unknown"
#     best_conf = 0.0

#     for face_encoding in face_encodings:
#         # Hitung jarak antar wajah
#         distances = face_recognition.face_distance(master_encodings, face_encoding)
#         if len(distances) == 0:
#             continue

#         # Ambil jarak terkecil
#         best_index = np.argmin(distances)
#         best_distance = distances[best_index]
#         best_name_candidate = master_names[best_index]

#         # Cek apakah jarak di bawah tolerance (semakin kecil semakin mirip)
#         match = best_distance <= tolerance

#         # Konversi jarak jadi "confidence" (semakin kecil jarak → semakin tinggi confidence)
#         confidence = (1 - best_distance) * 100

#         if match and confidence > best_conf:
#             best_name = best_name_candidate
#             best_conf = confidence

#     # Jika tidak ada yang cocok di bawah tolerance
#     if best_name == "Unknown":
#         return "Unknown", best_conf, True
#     else:
#         return best_name, best_conf, True

def detect_face(path, tolerance=0.5):
    """Mendeteksi wajah dan mencocokkannya dengan master face, fallback ke tiny detector jika gagal."""
    global master_encodings, master_names
    img_eq = preprocess_image(path)

    # --- ⛔ Cegah error jika master kosong ---
    if not master_encodings or not master_names:
        log_warn("Master wajah kosong — skip deteksi sementara.")
        return "NoMaster", 0.0, False

    # --- Tahap 1: coba deteksi dengan face_recognition (HOG) ---
    face_locations = face_recognition.face_locations(img_eq, model='hog')
    face_encodings = face_recognition.face_encodings(img_eq, face_locations)

    # --- Jika tidak ada wajah, fallback ke Tiny (Haar Cascade) ---
    if not face_encodings:
        log_warn(f"Tidak terdeteksi wajah dengan face_recognition → mencoba Tiny detector")
        gray = cv2.cvtColor(img_eq, cv2.COLOR_RGB2GRAY)
        face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
        faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(80, 80))

        if len(faces) > 0:
            log_info(f"Tiny detector menemukan {len(faces)} wajah (fallback mode).")
            return "Unknown", 0.0, True
        else:
            return "NoFace", 0.0, False

    # --- Tahap 2: Pencocokan wajah dengan master ---
    best_name = "Unknown"
    best_conf = 0.0

    for face_encoding in face_encodings:
        if not master_encodings:
            log_warn("Master kosong saat perbandingan wajah — skip.")
            return "NoMaster", 0.0, False

        distances = face_recognition.face_distance(master_encodings, face_encoding)
        if len(distances) == 0:
            continue

        best_index = np.argmin(distances)
        best_distance = distances[best_index]
        best_name_candidate = master_names[best_index]

        match = best_distance <= tolerance
        confidence = (1 - best_distance) * 100

        if match and confidence > best_conf:
            best_name = best_name_candidate
            best_conf = confidence

    return best_name, best_conf, True


# def auto_detect_faces(tolerance=0.5):
#     log_info("=== Memulai auto detect wajah dari folder attendance ===")

#     # Buat folder "noface" jika belum ada
#     noface_folder = os.path.join(FACERECOGNITION_FOLDER, "noface")
#     os.makedirs(noface_folder, exist_ok=True)

#     while True:
#         try:
#             files = [f for f in os.listdir(ATTENDANCE_FOLDER) if f.lower().endswith(('.jpeg', '.jpg', '.png'))]
#             if not files:
#                 time.sleep(1)
#                 continue

#             for filename in files:
#                 path = os.path.join(ATTENDANCE_FOLDER, filename)
#                 if not os.path.isfile(path):
#                     continue

#                 log_warn(f"Memproses file: {filename}")
#                 try:
#                     best_name, best_conf, has_face = detect_face(path, tolerance=tolerance)
#                     base_filename = os.path.splitext(filename)[0]

#                     # === Jika wajah dikenali ===
#                     if has_face and best_name != "Unknown":
#                         status = 1
#                         new_path = os.path.join(FACERECOGNITION_FOLDER, filename)
#                         log_success(f"{filename} dikenali sebagai {best_name} ({best_conf:.2f}%)")

#                     # === Selain itu (tidak dikenal atau tidak ada wajah) ===
#                     else:
#                         status = 9
#                         best_name = "Unknown" if has_face else "NoFace"
#                         new_path = os.path.join(noface_folder, filename)
#                         log_warn(f"{filename} tidak dikenali atau tidak ada wajah (conf={best_conf:.2f}%)")

#                     # Pindahkan file ke folder tujuan
#                     os.rename(path, new_path)

#                     # Update status di database
#                     update_facerecognition_status(base_filename, status, best_conf, best_name)

#                 except Exception as e:
#                     log_error(f"Gagal memproses {filename}: {e}")

#         except Exception as e:
#             log_error(f"[auto_detect_faces] Error utama: {e}")

#         time.sleep(1)

MAX_BATCH = 2  # jumlah maksimal file per loop

def auto_detect_faces(tolerance=0.5):
    log_info("=== Memulai auto detect wajah dari folder attendance ===")

    noface_folder = os.path.join(FACERECOGNITION_FOLDER, "noface")
    os.makedirs(noface_folder, exist_ok=True)

    while True:
        try:
            files = [f for f in os.listdir(ATTENDANCE_FOLDER) if f.lower().endswith(('.jpeg', '.jpg', '.png'))]
            if not files:
                time.sleep(2)
                continue

            # ambil hanya beberapa file per siklus
            batch = files[:MAX_BATCH]

            for filename in batch:
                path = os.path.join(ATTENDANCE_FOLDER, filename)
                if not os.path.isfile(path):
                    continue

                try:
                    log_warn(f"Memproses file: {filename}")
                    best_name, best_conf, has_face = detect_face(path, tolerance=tolerance)
                    base_filename = os.path.splitext(filename)[0]

                    if has_face and best_name != "Unknown":
                        status = 1
                        new_path = os.path.join(FACERECOGNITION_FOLDER, filename)
                        log_success(f"{filename} dikenali sebagai {best_name} ({best_conf:.2f}%)")
                    else:
                        status = 9
                        best_name = "Unknown" if has_face else "NoFace"
                        new_path = os.path.join(noface_folder, filename)
                        log_warn(f"{filename} tidak dikenali / tidak ada wajah (conf={best_conf:.2f}%)")

                    os.rename(path, new_path)
                    update_facerecognition_status(base_filename, status, best_conf, best_name)

                except Exception as e:
                    log_error(f"Gagal memproses {filename}: {e}")

            # beri jeda antar batch agar CPU & RAM sempat istirahat
            time.sleep(3)

        except Exception as e:
            log_error(f"[auto_detect_faces] Error utama: {e}")
            time.sleep(5)


def auto_reload_master():
    while True:
        load_master_faces()
        time.sleep(60)

if __name__ == '__main__':
    log_info("=== Konfigurasi Folder ===")
    log_info(f"MASTER_FOLDER     : {MASTER_FOLDER}")
    log_info(f"ATTENDANCE_FOLDER : {ATTENDANCE_FOLDER}")
    log_info(f"FACERECOGNITION   : {FACERECOGNITION_FOLDER}")
    log_info("===========================")

    threading.Thread(target=auto_reload_master, daemon=True).start()
    threading.Thread(target=auto_detect_faces, daemon=True).start()
    app.run(host='0.0.0.0', port=5000, debug=True, use_reloader=True)
