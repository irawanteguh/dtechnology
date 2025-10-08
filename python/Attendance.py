from flask import Flask, request, jsonify
from flask_cors import CORS
import face_recognition
import numpy as np
import base64
from io import BytesIO
from PIL import Image
import os
import uuid
import threading
import time

app = Flask(__name__)
CORS(app)

# === Folder master wajah & folder absensi ===
MASTER_FOLDER = r"D:\xampp\dtechnology\assets\images\avatars"
ATTENDANCE_FOLDER = r"D:\xampp\dtechnology\assets\attendance"
os.makedirs(ATTENDANCE_FOLDER, exist_ok=True)

# Global untuk master wajah
master_encodings = []
master_names = []

# Fungsi load master wajah dengan PIL + convert RGB
def load_master_faces():
    global master_encodings, master_names
    encodings = []
    names = []

    for filename in os.listdir(MASTER_FOLDER):
        if filename.lower().endswith('.jpeg'):
            path = os.path.join(MASTER_FOLDER, filename)
            try:
                # Paksa konversi ke RGB 8-bit
                with Image.open(path) as img:
                    img = img.convert('RGB')
                    img_np = np.array(img)
                # Hitung encoding
                image_encodings = face_recognition.face_encodings(img_np)
                if image_encodings:
                    encodings.append(image_encodings[0])
                    names.append(os.path.splitext(filename)[0])
                else:
                    print(f"[WARNING] Tidak ada wajah terdeteksi di {filename}")
            except Exception as e:
                print(f"[ERROR] Gagal memuat {filename}: {e}")

    master_encodings = encodings
    master_names = names
    print(f"[INFO] Master wajah terupdate: {len(master_encodings)} wajah")

# Thread auto reload setiap 10 detik
def auto_reload_master():
    while True:
        load_master_faces()
        time.sleep(10)

# Start thread auto reload
threading.Thread(target=auto_reload_master, daemon=True).start()

# =======================
# Endpoint deteksi wajah
# =======================
@app.route('/detect_face', methods=['POST'])
def detect_face():
    try:
        data = request.json.get('image')
        if not data:
            return jsonify({'status': 'error', 'message': 'No image provided'}), 400

        if "base64," in data:
            data = data.split("base64,")[1]

        img_bytes = base64.b64decode(data)
        img = Image.open(BytesIO(img_bytes)).convert('RGB')
        img_np = np.array(img)

        face_locations = face_recognition.face_locations(img_np)
        face_encodings = face_recognition.face_encodings(img_np, face_locations)

        results = []
        for (top, right, bottom, left), face_encoding in zip(face_locations, face_encodings):
            matches = face_recognition.compare_faces(master_encodings, face_encoding)
            name = "Unknown"
            if matches:
                distances = face_recognition.face_distance(master_encodings, face_encoding)
                best_match_index = np.argmin(distances)
                if matches[best_match_index]:
                    name = master_names[best_match_index]

            results.append({
                'top': top,
                'right': right,
                'bottom': bottom,
                'left': left,
                'name': name
            })

        status = "success" if results else "false"
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
        img_bytes = base64.b64decode(base64_data)
        filename = f"{uuid.uuid4().hex}.jpeg"
        filepath = os.path.join(ATTENDANCE_FOLDER, filename)

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

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
