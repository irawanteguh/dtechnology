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
MASTER_FOLDER = r"D:\xampp\htdocs\dtechnology\assets\images\avatars"
TMP_FOLDER = r"D:\xampp\htdocs\dtechnology\assets\attendance"
CONVERTED_FOLDER = os.path.join(MASTER_FOLDER, "_converted")

os.makedirs(TMP_FOLDER, exist_ok=True)
os.makedirs(CONVERTED_FOLDER, exist_ok=True)

# Variabel global
master_encodings = []
usernames = []


# === Fungsi bantu: pastikan gambar valid 8-bit RGB ===
def load_face_image_safe(image_path):
    try:
        img = Image.open(image_path)

        # Jika bit depth tinggi (misalnya 16-bit), turunkan ke 8-bit RGB
        if img.mode == "I;16":
            print(f"[INFO] Konversi {os.path.basename(image_path)} dari 16-bit ? 8-bit RGB")
            img = img.point(lambda i: i * (1.0 / 256)).convert("RGB")

        elif img.mode not in ("RGB", "L"):
            print(f"[INFO] Konversi {os.path.basename(image_path)} dari {img.mode} ? RGB")
            img = img.convert("RGB")

        img_array = np.asarray(img, dtype=np.uint8)

        # Pastikan hasil akhir benar-benar RGB 3-channel
        if img_array.ndim != 3 or img_array.shape[2] != 3:
            print(f"[WARN] {os.path.basename(image_path)} bukan gambar RGB 3 channel valid.")
            return None

        # Simpan hasil konversi di folder khusus
        save_path = os.path.join(CONVERTED_FOLDER, os.path.splitext(os.path.basename(image_path))[0] + ".jpg")
        if not os.path.exists(save_path):
            img.save(save_path, "JPEG", quality=90)

        return img_array

    except Exception as e:
        print(f"[ERROR] Gagal load {os.path.basename(image_path)}: {e}")
        return None


# === Fungsi utama: memuat master wajah ===
def load_master_faces():
    global master_encodings, usernames
    master_encodings.clear()
    usernames.clear()

    print(f"[INFO] Memuat master wajah dari folder: {CONVERTED_FOLDER}")

    # Pastikan folder hasil konversi ada
    if not os.path.exists(CONVERTED_FOLDER):
        print(f"[ERROR] Folder {CONVERTED_FOLDER} tidak ditemukan!")
        return

    total = 0
    for filename in os.listdir(CONVERTED_FOLDER):
        if not filename.lower().endswith((".jpg", ".jpeg", ".png")):
            continue

        path_to_load = os.path.join(CONVERTED_FOLDER, filename)
        img_array = load_face_image_safe(path_to_load)

        if img_array is None:
            print(f"[WARN] Gagal memuat {path_to_load}")
            continue

        try:
            encodings = face_recognition.face_encodings(img_array)
            if encodings:
                master_encodings.append(encodings[0])
                usernames.append(os.path.splitext(filename)[0])
                total += 1
                print(f"[INFO] Loaded face for {filename}")
            else:
                print(f"[WARN] Tidak ditemukan wajah dalam {filename}")
        except Exception as e:
            print(f"[ERROR] Gagal proses {filename}: {e}")

    print(f"[INFO] Total wajah master dimuat: {total}")

# === Auto reload master wajah ===
def auto_reload_faces():
    while True:
        try:
            load_master_faces()
        except Exception as e:
            print(f"[ERROR] Auto reload gagal: {e}")
        time.sleep(10)  # cek ulang tiap 10 detik


# === Endpoint: pengenalan wajah ===
@app.route("/recognize", methods=["POST"])
def recognize():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data provided"}), 400

        base64_data = data["image"].split(",")[-1]
        img_bytes = base64.b64decode(base64_data)
        img = Image.open(BytesIO(img_bytes))

        if img.mode not in ("RGB", "L"):
            img = img.convert("RGB")

        img_np = np.asarray(img, dtype=np.uint8)
        face_locations = face_recognition.face_locations(img_np)
        face_encodings = face_recognition.face_encodings(img_np, face_locations)
        print(f"[INFO] Terdeteksi {len(face_encodings)} wajah pada request")

        if not master_encodings:
            return jsonify({"username": None, "error": "Master data kosong"}), 500

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


# === Endpoint: reload manual ===
@app.route("/reload_faces", methods=["POST"])
def reload_faces():
    try:
        load_master_faces()
        return jsonify({"status": "success", "message": "Master faces reloaded"})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)}), 500


# === Endpoint: simpan hasil capture ===
@app.route("/save_capture", methods=["POST"])
def save_capture():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data"}), 400

        base64_data = data["image"].split(",")[-1]
        img_bytes = base64.b64decode(base64_data)
        filename = f"{uuid.uuid4().hex}.jpg"
        filepath = os.path.join(TMP_FOLDER, filename)

        with open(filepath, "wb") as f:
            f.write(img_bytes)

        print(f"[INFO] Capture absensi disimpan: {filepath}")

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
    if os.environ.get("WERKZEUG_RUN_MAIN") == "true":
        threading.Thread(target=auto_reload_faces, daemon=True).start()

    print("[INFO] Starting Flask server on port 5000...")
    load_master_faces()
    app.run(host="0.0.0.0", port=5000, debug=True, use_reloader=True)
