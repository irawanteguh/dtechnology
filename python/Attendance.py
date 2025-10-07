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
CORS(app)  # Izinkan request dari frontend

# === Konfigurasi folder ===
MASTER_FOLDER = r"E:\xampp\htdocs\dtech\dtechnology\assets\images\avatars"  # Folder master wajah
TMP_FOLDER    = r"E:\xampp\htdocs\dtech\dtechnology\assets\attendance"    # Folder hasil capture absensi

# Pastikan folder attendance ada
os.makedirs(TMP_FOLDER, exist_ok=True)

# Variabel global untuk master faces
master_encodings = []
usernames = []

# === Fungsi load master faces ===
def load_master_faces():
    global master_encodings, usernames
    master_encodings = []
    usernames = []

    print(f"[INFO] Loading master faces from: {MASTER_FOLDER}")

    if not os.path.exists(MASTER_FOLDER):
        print(f"[ERROR] Folder {MASTER_FOLDER} tidak ditemukan!")
        return

    for filename in os.listdir(MASTER_FOLDER):
        if filename.lower().endswith((".jpg", ".jpeg", ".png")):
            path = os.path.join(MASTER_FOLDER, filename)
            try:
                image = face_recognition.load_image_file(path)
                encodings = face_recognition.face_encodings(image)
                if encodings:
                    master_encodings.append(encodings[0])
                    usernames.append(os.path.splitext(filename)[0])
                    print(f"[INFO] Loaded face for {filename}")
                else:
                    print(f"[WARN] No face found in {filename}")
            except Exception as e:
                print(f"[ERROR] Gagal load {filename}: {e}")

    print(f"[INFO] Total master faces loaded: {len(master_encodings)}")

# === Fungsi auto-reload setiap 5 detik ===
def auto_reload_faces():
    while True:
        try:
            load_master_faces()
        except Exception as e:
            print(f"[ERROR] Auto reload failed: {e}")
        time.sleep(5000)  # interval 5 detik (ubah sesuai kebutuhan)

# === Endpoint: Recognize wajah ===
@app.route("/recognize", methods=["POST"])
def recognize():
    try:
        data = request.get_json()
        if not data or "image" not in data:
            return jsonify({"error": "No image data provided"}), 400

        base64_data = data["image"]
        if "," in base64_data:
            base64_data = base64_data.split(",")[1]

        img_bytes = base64.b64decode(base64_data)
        img = np.array(Image.open(BytesIO(img_bytes)))

        face_locations = face_recognition.face_locations(img)
        face_encodings = face_recognition.face_encodings(img, face_locations)

        print(f"[INFO] Detected {len(face_encodings)} face(s) in request")

        for face_encoding in face_encodings:
            matches = face_recognition.compare_faces(master_encodings, face_encoding)
            if True in matches:
                index = matches.index(True)
                username = usernames[index]
                print(f"[INFO] Face recognized: {username}")
                return jsonify({"username": username})

        print("[INFO] No faces matched")
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
        filepath  = os.path.join(TMP_FOLDER, filename)

        with open(filepath, "wb") as f:
            f.write(img_bytes)

        print(f"[INFO] Attendance capture saved: {filepath}")

        location = data.get("location", {})
        lat      = location.get("lat", "-")
        lon      = location.get("lon", "-")
        alamat   = location.get("alamat", "-")

        print(f"[INFO] Location: lat={lat}, lon={lon}, alamat={alamat}")

        return jsonify({
            "status": "success",
            "filename": filename,
            "location": {"lat": lat, "lon": lon, "alamat": alamat}
        })

    except Exception as e:
        print(f"[ERROR] {e}")
        return jsonify({"status": "error", "message": str(e)}), 500

# === Jalankan server ===
if __name__ == "__main__":
    # Jalankan thread auto_reload_faces hanya sekali (tidak di-reloader Flask)
    if os.environ.get("WERKZEUG_RUN_MAIN") == "true":
        threading.Thread(target=auto_reload_faces, daemon=True).start()

    print("[INFO] Starting Flask server on port 5000...")
    app.run(host="0.0.0.0", port=5000, debug=True, use_reloader=True)
