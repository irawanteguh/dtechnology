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

# Global untuk master wajah
master_encodings = []
master_names     = []

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


# === Fungsi load master wajah ===
def load_master_faces():
    global master_encodings, master_names
    encodings, names = [], []

    files = [f for f in os.listdir(MASTER_FOLDER)
             if f.lower().endswith(('.jpg', '.jpeg', '.png'))]

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

# === Confidence function ===
def face_confidence(face_distance, face_match_threshold=0.6):
    if face_distance > face_match_threshold:
        range_ = (1.0 - face_match_threshold)
        linear_val = (1.0 - face_distance) / (range_ * 2.0)
        return linear_val * 100
    else:
        range_ = face_match_threshold
        linear_val = 1.0 - (face_distance / (range_ * 2.0))
        return linear_val * 100

# === Auto detect attendance ===
def auto_detect_faces():
    load_master_faces()
    log_info("=== Memulai auto detect wajah dari folder attendance ===")

    while True:
        try:
            if not os.path.exists(ATTENDANCE_FOLDER):
                log_error(f"Folder tidak ditemukan: {ATTENDANCE_FOLDER}")
                time.sleep(5)
                continue

            # Ambil semua file gambar baru
            files = [
                f for f in os.listdir(ATTENDANCE_FOLDER)
                if f.lower().endswith(('.jpeg', '.jpg', '.png'))
            ]

            if not files:
                time.sleep(2)
                continue

            for filename in files:
                try:
                    path = os.path.join(ATTENDANCE_FOLDER, filename)
                    if not os.path.isfile(path):
                        continue

                    log_warn(f"Memproses file: {filename}")

                    # Baca gambar
                    with Image.open(path) as img:
                        img = img.convert('RGB')
                        img_np = np.array(img)

                    # Deteksi wajah
                    newname = f"done_nowface_{filename}"
                    face_locations = face_recognition.face_locations(img_np)
                    face_encodings = face_recognition.face_encodings(img_np, face_locations)

                    if not face_encodings:
                        log_warn(f"Tidak ada wajah pada {filename}")
                        newname = f"done_nowface_{filename}"

                    elif not master_encodings:
                        log_warn("Master wajah kosong, lewati perbandingan.")
                        newname = f"done_nomaster_{filename}"

                    else:
                        best_name = "Unknown"
                        best_conf = 0.0

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

                        log_success(f"{filename} dikenali sebagai {best_name} ({best_conf:.2f}%)")
                        newname = f"done_{best_name}_{filename}"

                    # Pindahkan file ke folder hasil (done)
                    new_path = os.path.join(FACERECOGNITION_FOLDER, newname)
                    os.rename(path, new_path)

                except Exception as e:
                    log_error(f"Gagal memproses {filename}: {e}")
                    time.sleep(0.5)
                    continue

        except Exception as e:
            log_error(f"[auto_detect_faces] Error utama: {e}")

        time.sleep(5)
        
# Thread auto reload setiap 10 detik
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

    # threading.Thread(target=auto_reload_master, daemon=True).start()
    threading.Thread(target=auto_detect_faces, daemon=True).start()
    app.run(host='0.0.0.0', port=5000, debug=True, use_reloader=True)