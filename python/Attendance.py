from flask import Flask, request, jsonify
from flask_cors import CORS
import face_recognition
import numpy as np
import base64
from io import BytesIO
from PIL import Image
import os
import threading
import time
import uuid

app = Flask(__name__)
CORS(app)

# === Konfigurasi folder ===
MASTER_FOLDER = r"D:\xampp\htdocs\dtechnology\assets\images\avatars"  # Folder master wajah
TMP_FOLDER    = r"D:\xampp\htdocs\dtechnology\assets\attendance"      # Folder hasil capture absensi

# Pastikan folder attendance ada
os.makedirs(TMP_FOLDER, exist_ok=True)

# Variabel global untuk master faces
master_encodings = []
usernames = []

# === Fungsi bantu: load image dengan konversi aman ===
def load_face_image_safe(image_path):
    """Buka gambar dan konversi ke RGB jika perlu"""
    try:
        img = Image.open(image_path)
        if img.mode not in ("RGB", "L"):
            print(f"[INFO] Konversi {os.path.basename(image_path)} dari {img.mode} ke RGB")
            img = img.convert("RGB")

        # Pastikan jadi numpy array untuk face_recognition
        img_array = np.array(img)
        return img_array

    except Exception as e:
        print(f"[ERROR] Gagal load {image_path}: {str(e)}")
        return None


# === Fungsi load master faces ===
def load_master_faces():
    global master_encodings, usernames
    master_encodings = []
    usernames = []

    print(f"[INFO] Memuat master wajah dari: {MASTER_FOLDER}")

    if not os.path.exists(MASTER_FOLDER):
        print(f"[ERROR] Folder {MASTER_FOLDER} tidak ditemukan!")
        return

    for filename in os.listdir(MASTER_FOLDER):
        if filename.lower().endswith((".jpg", ".jpeg", ".png")):
            path = os.path.join(MASTER_FOLDER, filename)
            img_array = load_face_image_safe(path)
            if img_array is None:
                continue

            try:
                encodings = face_recognition.face_encodings(img_array)
                if encodings:
                    master_encodings.append(encodings[0])
                    usernames.append(os.path.splitext(filename)[0])
                    print(f"[INFO] Loaded face for {filename}")
                else:
                    print(f"[WARN] Tidak ditemukan wajah dalam {filename}")
            except Exception as e:
                print(f"[ERROR] Gagal proses {filename}: {e}")

    print(f"[INFO] Total master faces loaded: {len(master_encodings)}")


# === Fungsi auto-reload master wajah ===
def auto_reload_faces():
    while True:
        try:
            load_master_faces()
        except Exception as e:
            print(f"[ERROR] Auto reload gagal: {e}")
        time.sleep(5)  # reload tiap 5 detik


# === Endpoint: Pengenalan wajah ===
@app.route("/recognize", methods=["POST"])
def recognize():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data provided"}), 400

        # Decode base64
        base64_data = data["image"]
        if "," in base64_data:
            base64_data = base64_data.split(",")[1]

        img_bytes = base64.b64decode(base64_data)
        img = Image.open(BytesIO(img_bytes))

        # Konversi ke RGB aman
        if img.mode not in ("RGB", "L"):
            img = img.convert("RGB")

        img_np = np.array(img)

        face_locations = face_recognition.face_locations(img_np)
        face_encodings = face_recognition.face_encodings(img_np, face_locations)

        print(f"[INFO] Terdeteksi {len(face_encodings)} wajah pada request")

        for face_encoding in face_encodings:
            matches = face_recognition.compare_faces(master_encodings, face_encoding)
            if True in matches:
                index = matches.index(True)
                username = usernames[index]
                print(f"[INFO] Wajah dikenali: {username}")
                return jsonify({"username": username})

        print("[INFO] Tidak ada wajah yang cocok")
        return jsonify({"username": None})

    except Exception as e:
        print(f"[ERROR] {e}")
        return jsonify({"error": str(e)}), 500


# === Endpoint: Reload master faces manual ===
@app.route("/reload_faces", methods=["POST"])
def reload_faces():
    try:
        load_master_faces()
        return jsonify({"status": "success", "message": "Master faces reloaded"})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)}), 500


# === Endpoint: Simpan foto capture absensi ===
@app.route("/save_capture", methods=["POST"])
def save_capture():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data"}), 400

        base64_data = data["image"]
        if "," in base64_data:
            base64_data = base64_data.split(",")[1]

        img_bytes = base64.b64decode(base64_data)
        filename = f"{uuid.uuid4().hex}.jpg"
        filepath = os.path.join(TMP_FOLDER, filename)

        # Simpan file
        with open(filepath, "wb") as f:
            f.write(img_bytes)

        print(f"[INFO] Capture absensi disimpan: {filepath}")

        # Data lokasi (jika ada)
        location = data.get("location", {})
        lat = location.get("lat", "-")
        lon = location.get("lon", "-")
        alamat = location.get("alamat", "-")

        print(f"[INFO] Lokasi: lat={lat}, lon={lon}, alamat={alamat}")

        return jsonify({
            "status": "success",
            "filename": filename,
            "location": {"lat": lat, "lon": lon, "alamat": alamat}
        })

    except Exception as e:
        print(f"[ERROR] {e}")
        return jsonify({"status": "error", "message": str(e)}), 500


# === Jalankan server Flask ===
if __name__ == "__main__":
    # Jalankan thread auto reload hanya sekali (hindari duplikat di debug mode)
    if os.environ.get("WERKZEUG_RUN_MAIN") == "true":
        threading.Thread(target=auto_reload_faces, daemon=True).start()

    print("[INFO] Starting Flask server on port 5000...")
    load_master_faces()  # Muat awal sebelum server aktif
    app.run(host="0.0.0.0", port=5000, debug=True, use_reloader=True)
