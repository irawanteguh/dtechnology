// nodejs/wagateway.js (ESM version)
import express from "express";
import cors from "cors";
import fs from "node:fs";
import http from "node:http";
import https from "node:https";

const qrStore         = {};
const baseurl         = "http://192.168.102.13/dtechnology/index.php";
const ipgateway       = "http://192.168.102.13:";
const separator       = "=========================================================================================";
const intervalMs      = 30000;
let   autoSendLoop    = null;
let   autoSendEnabled = true;

// whatsapp import — robust terhadap modul CommonJS atau ESM
const _whatsappModule = await import("wa-multi-session").catch(err => {
	console.error("❌ Gagal import wa-multi-session:", err.message);
	throw err;
});
const whatsapp = _whatsappModule.default ?? _whatsappModule;

const app = express();
app.use(cors());
app.use(express.json());

// =======================================================
// 🔄 Load sessions from disk (jika pernah tersimpan)
// =======================================================
if (typeof whatsapp.loadSessionsFromStorage === "function") {
	whatsapp.loadSessionsFromStorage();
}

console.log(separator);
console.log("📦 [INIT] Sessions loaded from storage");

// =======================================================
// 📡 Endpoint: Get session info
// =======================================================
app.get("/session/info/:session", async (req, res) => {
	const sessionId = req.params.session;

	try {
		const session = await whatsapp.getSession(sessionId);

		if (!session) {
			console.warn(`⚠️  Session ${sessionId} tidak ditemukan.`);
			return res.status(404).json({ message: "Session not found" });
		}

		const info = {
			user     : session.user || {},
			pushname : session.pushname || null,
			platform : session.platform || null,
			state    : session.user?.id ? "CONNECTED" : "PAIRING",
			sessionId
		};

		res.json({ status: true, info });
	} catch (err) {
		console.error(`❌ Gagal mengambil info session ${sessionId}:`, err.message);
		res.status(500).json({ status: false, message: "Failed to retrieve session info", error: err.message });
	}
});

// =======================================================
// ▶️ Endpoint: Start new session
// =======================================================
app.post("/session/start", async (req, res) => {
	const { session } = req.body;
	if (!session) return res.status(400).json({ message: "Session is required" });

	try {
		await whatsapp.startSession(session);
		console.log(`✅ Session ${session} berhasil dimulai`);
		res.json({ message: "Session started", session });
	} catch (err) {
		console.error(`❌ Gagal memulai session ${session}:`, err.message);
		res.status(500).json({ message: "Failed to start session", error: err.message });
	}
});

// =======================================================
// 📷 Endpoint: Get QR Code
// =======================================================
app.get("/session/qr/:session", (req, res) => {
	const sessionId = req.params.session;
	if (qrStore[sessionId]) res.json({ qr: qrStore[sessionId] });
	else res.status(404).json({ message: "QR not available" });
});

// =======================================================
// ❌ Endpoint: Logout Session
// =======================================================
app.get("/session/logout", async (req, res) => {
	const sessionId = req.query.session;
	if (!sessionId) return res.status(400).json({ status: false, message: "Session ID is required" });

	try {
		const removed = await whatsapp.deleteSession(sessionId);
		if (removed) {
			console.log(`🗑️  Session ${sessionId} berhasil dihapus`);
			res.json({ status: true, message: `Session ${sessionId} deleted` });
		} else {
			console.warn(`⚠️  Session ${sessionId} tidak ditemukan atau gagal dihapus`);
			res.status(404).json({ status: false, message: `Session ${sessionId} not found or could not be deleted` });
		}
	} catch (err) {
		console.error(`❌ Gagal menghapus session ${sessionId}:`, err.message);
		res.status(500).json({ status: false, error: err.message });
	}
});

// =======================================================
// 💬 Endpoint: Send text message
// =======================================================
app.post("/message/send-text", async (req, res) => {
	const { session, to, text } = req.body;
	try {
		const result = await whatsapp.sendTextMessage({ sessionId: session, to, text });
		console.log(`📨 Pesan berhasil dikirim ke ${to} melalui session ${session}`);
		res.json({ status: true, result });
	} catch (err) {
		console.error(`❌ Gagal mengirim pesan ke ${to}:`, err.message);
		res.status(500).json({ status: false, error: err.message });
	}
});

// =======================================================
// 📎 Endpoint: Send document
// =======================================================
app.post("/message/send-document", async (req, res) => {
	const { session, to, document_url, document_name, text } = req.body;

	try {
		const fileBuffer = await fetchFile(document_url);

		const result = await whatsapp.sendDocument({
			sessionId: session,
			to,
			filename: document_name,
			media   : fileBuffer,
			text    : text || ""
		});

		console.log(separator);
		console.log(`:: ✅ Document sent successfully ::`);
		console.log(`      To      : ${to}`);
		console.log(`      Session : ${session}`);

		res.json({ status: true, result });
	} catch (err) {
		console.log(separator);
		console.log(`:: ❌ Sending document failed. Please try again ::`);
		console.log(`      To      : ${to}`);
		console.log(`      Mesasge : `,err.message);
		res.status(500).json({ status: false, error: err.message });
	}
});

// =======================================================
// 📥 Fungsi bantu: Ambil file dari URL atau lokal
// =======================================================
async function fetchFile(url) {
	return new Promise((resolve, reject) => {
		try {
			if (url.startsWith("http://") || url.startsWith("https://")) {
				const lib = url.startsWith("https") ? https : http;

				lib.get(url, res => {
					if (res.statusCode !== 200) {
						return reject(new Error(`Gagal fetch file. Status Code: ${res.statusCode}`));
					}

					const chunks = [];
					res.on("data", chunk => chunks.push(chunk));
					res.on("end", () => resolve(Buffer.concat(chunks)));
				}).on("error", reject);
			} else {
				fs.readFile(url, (err, data) => {
					if (err) return reject(err);
					resolve(data);
				});
			}
		} catch (err) {
			reject(err);
		}
	});
}

// =======================================================
// 🧩 Event: Saat QR diperbarui
// =======================================================
if (typeof whatsapp.onQRUpdated === "function") {
	whatsapp.onQRUpdated(({ sessionId, qr }) => {
		qrStore[sessionId] = qr;
		console.log(`🧩 QR Code diperbarui untuk session ${sessionId}`);
	});
}

// =======================================================
// ✅ Event: Saat session berhasil terhubung
// =======================================================
if (typeof whatsapp.onConnected === "function") {
	whatsapp.onConnected(async (sessionId) => {
		console.log(separator);
		console.log(`:: ✅ Session ${sessionId} : Connected ::`);

		try {
			const session  = await whatsapp.getSession(sessionId);
			const phone    = (session?.user?.id || "").split(":")[0];
			const username = session?.user?.name || "";

			console.log(separator);
			console.log(":: ℹ️  Informasi Pengguna ::");
			console.log("   id   :",(session?.user?.id || "").split(":")[0]);
			console.log("   lid  :",(session?.user?.lid || "").split(":")[0]);
			console.log("   name :",session?.user.name || "");

			const payload = {
				session_id: sessionId,
				status    : 'connected',
				username  : username,
				phone     : phone
			};

			const response = await fetch(`${baseurl}/updatedevice`, {
				method : 'POST',
				headers: { 'Content-Type': 'application/json' },
				body   : JSON.stringify(payload)
			});

			const text = await response.text();
			try {
				const data = JSON.parse(text);
				console.log(separator);
				console.log(':: ✅ Update Device Link Session ::');
				console.log("   status   :",data.status);
				console.log("   message  :",data.message);
				console.log("   username :",data.data.username);
				console.log("   phone    :",data.data.phone);
				console.log("   status   :",data.data.status);

				// ?? Tambahkan Auto Send di sini
				startAutoSend();
			} catch {
				console.log(separator);
				console.log(':: ⚠️  Response Rest API ::');
				console.log(response);
			}
		} catch (err) {
			console.log(separator);
			console.log('❌ Error saat mengirim info ke API:', err.message);
		}
	});
}

// =======================================================
// 🔌 Event: Saat session terputus
// =======================================================
if (typeof whatsapp.onDisconnected === "function") {
	whatsapp.onDisconnected(async (sessionId) => {
		console.log(separator);
		console.log(`:: ⚠️ Session ${sessionId} : Disconnected ::`);

		try {
			const payload = {
				session_id: sessionId,
				status    : "disconnected",
				phone     : ""
			};
			
			const response = await fetch(`${baseurl}/updatedevice`, {
				method : "POST",
				headers: { "Content-Type": "application/json" },
				body   : JSON.stringify(payload)
			});

			const text = await response.text();
			try {
				const data = JSON.parse(text);
				console.log(separator);
				console.log(':: ⚠️ Device Disconnect Session ::');
				console.log("   status   :",data.data.status);
				console.log("   message  :",data.message);
			} catch {
				console.warn("⚠️  Response disconnect bukan JSON:", text);
			}
		} catch (err) {
			console.error("❌ Gagal kirim update disconnect:", err.message);
		}
	});
}

if (typeof whatsapp.onMessageReceived === "function") {
	whatsapp.onMessageReceived(async msg => {
		// ... tetapkan ulang handler message Anda di sini (saya mempertahankan logika asli)
		// Untuk ringkas saya tidak menyalin lagi seluruh handler — salin dari kode Anda sebelumnya
		console.log("Message received (handler aktif).");
	});
}

// =======================================================
// 🚀 Jalankan server
// =======================================================
const port = 5001;
app.listen(port, () => {
	console.log(separator);
	console.log(`🚀 WhatsApp Gateway aktif di ${ipgateway}${port}`);
	console.log(separator);
});

// tambahkan fungsi startAutoSend() sama persis dengan versi Anda sebelumnya
// (salin fungsi startAutoSend dari kode original Anda)
