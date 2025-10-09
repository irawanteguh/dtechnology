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

# Base folder project (root Flask)
BASE_DIR = os.path.abspath(os.path.dirname(__file__))
PROJECT_DIR = os.path.dirname(BASE_DIR)

app      = Flask(__name__)
CORS(app)


# === Folder master wajah & folder absensi ===
MASTER_FOLDER     = os.path.join(PROJECT_DIR, "assets", "images", "avatars")
ATTENDANCE_FOLDER = os.path.join(PROJECT_DIR, "assets", "attendance")

# Pastikan folder ada
os.makedirs(MASTER_FOLDER, exist_ok=True)
os.makedirs(ATTENDANCE_FOLDER, exist_ok=True)

print("MASTER_FOLDER:", MASTER_FOLDER)
print("ATTENDANCE_FOLDER:", ATTENDANCE_FOLDER)

# Global untuk master wajah
master_encodings = []
master_names     = []

# === Fungsi global untuk timestamp ===
def timestamp():
    """Mengembalikan waktu saat ini dalam format YYYY-MM-DD HH:MM:SS"""
    return datetime.now().strftime("%Y-%m-%d %H:%M:%S")

class LogColor:
    INFO    = "\033[94m"  # Hijau
    WARN    = "\033[93m"  # Kuning
    SUCCESS = "\033[92m"  # Hijau
    ERROR   = "\033[91m"  # Merah
    END     = "\033[0m"   # Reset warna

def log_info(msg):
    print(f"🔵 {LogColor.INFO}[INFO]{LogColor.END}\t{timestamp()} {msg}")

def log_warn(msg):
    print(f"🟡 {LogColor.WARN}[WARN]{LogColor.END}\t{timestamp()} {msg}")

def log_success(msg):
    print(f"🟢 {LogColor.SUCCESS}[SUCCESS]{LogColor.END}\t{timestamp()} {msg}")

def log_error(msg):
    print(f"🔴 {LogColor.ERROR}[ERROR]{LogColor.END}\t{timestamp()} {msg}")


# Fungsi load master wajah dengan PIL + convert RGB
def load_master_faces():
    global master_encodings, master_names
    encodings = []
    names     = []

    # Hitung jumlah file gambar di folder master
    image_files = [
        f for f in os.listdir(MASTER_FOLDER)
        if f.lower().endswith(('.jpg', '.jpeg', '.png'))
    ]
    total_files = len(image_files)

    log_info(f"Ditemukan: {total_files} file gambar di folder master.")

    for filename in image_files:
        path = os.path.join(MASTER_FOLDER, filename)
        try:
            # Paksa konversi ke RGB 8-bit
            with Image.open(path) as img:
                img    = img.convert('RGB')
                img_np = np.array(img)
            # Hitung encoding
            image_encodings = face_recognition.face_encodings(img_np)
            if image_encodings:
                encodings.append(image_encodings[0])
                names.append(os.path.splitext(filename)[0])
            else:
                print(f"{timestamp()} [WARNING] Tidak ada wajah terdeteksi di {filename}")
        except Exception as e:
            print(f"{timestamp()} [ERROR] Gagal memuat {filename}: {e}")

    master_encodings = encodings
    master_names     = names

    log_success(f"Master wajah terupdate: {len(master_encodings)} wajah dari {total_files} file.")

# Thread auto reload setiap 10 detik
def auto_reload_master():
    while True:
        load_master_faces()
        time.sleep(10)

# Start thread auto reload
threading.Thread(target=auto_reload_master, daemon=True).start()


# =======================
# Endpoint confidence wajah
# =======================
def face_confidence(face_distance, face_match_threshold=0.6):
    if face_distance > face_match_threshold:
        range_ = (1.0 - face_match_threshold)
        linear_val = (1.0 - face_distance) / (range_ * 2.0)
        return linear_val * 100
    else:
        range_ = face_match_threshold
        linear_val = 1.0 - (face_distance / (range_ * 2.0))
        return linear_val * 100


# =======================
# Endpoint deteksi wajah
# =======================
@app.route("/detect_face", methods=["POST"])
def detect_face():
    try:
        data = request.json.get('image')
        if not data:
            return jsonify({'status': 'error', 'message': 'No image provided'}), 400

        # Bersihkan base64 prefix
        if "base64," in data:
            data = data.split("base64,")[1]

        # Decode gambar
        img_bytes = base64.b64decode(data)
        img = Image.open(BytesIO(img_bytes)).convert('RGB')
        img_np = np.array(img)

        # Deteksi wajah
        face_locations = face_recognition.face_locations(img_np)
        face_encodings = face_recognition.face_encodings(img_np, face_locations)

        results = []
        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            if not master_encodings:
                continue

            matches = face_recognition.compare_faces(master_encodings, face_encoding)
            distances = face_recognition.face_distance(master_encodings, face_encoding)
            best_match_index = np.argmin(distances)

            name = "Unknown"
            confidence = face_confidence(distances[best_match_index])

            if matches[best_match_index]:
                name = master_names[best_match_index]

            results.append({
                'top': top,
                'right': right,
                'bottom': bottom,
                'left': left,
                'name': name,
                'confidence': confidence
            })

        status = "success" if len(results) > 0 else "false"
        return jsonify({'status': status, 'faces': results})

    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500

# =======================
# Endpoint simpan capture absensi
# =======================
@app.route("/save_capture", methods=["POST"])
def save_capture():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data"}), 400

        base64_data = data["image"].split(",")[-1]
        img_bytes   = base64.b64decode(base64_data)
        filename    = f"{uuid.uuid4().hex}.jpeg"
        filepath    = os.path.join(ATTENDANCE_FOLDER, filename)

        with open(filepath, "wb") as f:
            f.write(img_bytes)

        log_success(f"Capture absensi disimpan: {filename}")

        location = data.get("location", {})
        lat      = location.get("lat", "-")
        lon      = location.get("lon", "-")
        alamat   = location.get("alamat", "-")

        log_info(f"Lokasi: lat={lat}, lon={lon}, alamat={alamat}")

        return jsonify({
            "status": "success",
            "filename": filename,
            "location": {"lat": lat, "lon": lon, "alamat": alamat}
        })

    except Exception as e:
        print(f"[ERROR] {e}")
        return jsonify({"status": "error", "message": str(e)}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True, use_reloader=True)
