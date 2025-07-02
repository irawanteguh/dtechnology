// =======================================================
// 🚀 WhatsApp Gateway Server
// =======================================================
const port         = 5001;
const express      = require("express");
const cors         = require("cors");
const fs           = require("fs");
const http         = require("http");
const https        = require("https");
const whatsapp     = require("wa-multi-session");
const qrStore      = {};
const API_BASE_URL = "http://localhost/dtech/dtechnology/index.php";

const app = express();
app.use(cors());
app.use(express.json());

// =======================================================
// 🔄 Load sessions from disk (jika pernah tersimpan)
// =======================================================
whatsapp.loadSessionsFromStorage();
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
			media: fileBuffer,
			text: text || ""
		});

		console.log(`📎 Dokumen berhasil dikirim ke ${to} via ${session}`);
		res.json({ status: true, result });

	} catch (err) {
		console.error(`❌ Gagal mengirim dokumen ke ${to}:`, err.message);
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
whatsapp.onQRUpdated(({ sessionId, qr }) => {
	qrStore[sessionId] = qr;
	console.log(`🧩 QR Code diperbarui untuk session ${sessionId}`);
});

// =======================================================
// ✅ Event: Saat session berhasil terhubung
// =======================================================
whatsapp.onConnected(async (sessionId) => {
	console.log(`📶 Session ${sessionId} berhasil terhubung`);

	try {
		const session  = await whatsapp.getSession(sessionId);
		const phone    = (session?.user?.id || "").split(":")[0];
		const username = session?.user?.name || "";

		console.log("ℹ️  Informasi Pengguna:", session?.user);

		const payload = {
			session_id: sessionId,
			status    : 'connected',
			username  : username,
			phone     : phone
		};

		const response = await fetch(`${API_BASE_URL}/updatedevice`, {
			method : 'POST',
			headers: { 'Content-Type': 'application/json' },
			body   : JSON.stringify(payload)
		});

		const text = await response.text();
		try {
			const data = JSON.parse(text);
			console.log('📡 Payload terkirim ke API:', data);
		} catch {
			console.warn('⚠️  Respon bukan JSON:', text);
		}
	} catch (err) {
		console.error('❌ Error saat mengirim info ke API:', err.message);
	}
});

// =======================================================
// 🔌 Event: Saat session terputus
// =======================================================
whatsapp.onDisconnected(async (sessionId) => {
	console.log(`🔌 Session ${sessionId} terputus`);

	const payload = {
		session_id: sessionId,
		status    : "disconnected",
		phone     : ""
	};

	try {
		const response = await fetch(`${API_BASE_URL}/updatedevice`, {
			method : "POST",
			headers: { "Content-Type": "application/json" },
			body   : JSON.stringify(payload)
		});
		const text = await response.text();
		try {
			const data = JSON.parse(text);
			console.log("📡 Informasi disconnect dikirim ke API:", data);
		} catch {
			console.warn("⚠️  Response disconnect bukan JSON:", text);
		}
	} catch (err) {
		console.error("❌ Gagal kirim update disconnect:", err.message);
	}
});

// =======================================================
// 💬 Event: Saat menerima pesan masuk / keluar
// =======================================================
whatsapp.onMessageReceived(msg => {
	const sessionId   = msg.sessionId || "unknown";
	const isFromMe    = msg.key?.fromMe === true;
	const isGroup     = msg.key?.remoteJid?.endsWith("@g.us");
	const remoteJid   = msg.key?.remoteJid || "unknown";
	const pushName    = msg.pushName || "";
	const broadcast   = msg.broadcast;
	const participant = msg.key?.participant || null;

	// console.log("==================================");
	// console.log(msg);
	// console.log("==================================");
	
	let from     = "-";
	let to       = "-";
	let groupId  = "-";
	let msgType  = "[📎 Unknown]";
	let content  = "[📎 Tidak ada isi pesan]";

	// Tentukan From & To
	if (isFromMe) {
		from = pushName ? pushName : "Me";
		to   = remoteJid.split("@")[0]; // penerima
	} else {
		from = (participant || remoteJid).split("@")[0];
		to   = remoteJid.endsWith("@g.us") ? "Me" : "Me";
	}

	// Ambil Group ID jika grup
	if (isGroup) {
		const match = remoteJid.match(/-(\d+)@/);
		groupId = match ? match[1] : remoteJid.split("@")[0];;
	}

	// Deteksi isi dan tipe pesan
	const m = msg.message || {};
	if (m.conversation) {
		msgType = "Teks";
		content = m.conversation;
	} else if (m.extendedTextMessage?.text) {
		msgType = "Teks";
		content = m.extendedTextMessage.text;
	} else if (m.imageMessage?.caption) {
		msgType = "Gambar";
		content = m.imageMessage.caption;
	} else if (m.imageMessage) {
		msgType = "Gambar";
		content = "[Gambar tanpa caption]";
	} else if (m.documentMessage?.fileName) {
		msgType = "Dokumen";
		content = m.documentMessage.fileName;
	} else if (m.videoMessage?.caption) {
		msgType = "Video";
		content = m.videoMessage.caption;
	} else if (m.videoMessage) {
		msgType = "Video";
		content = "[Video tanpa caption]";
	} else if (m.audioMessage) {
		msgType = "Audio";
		content = "[Audio]";
	} else if (m.stickerMessage) {
		msgType = "Stiker";
		content = "[Stiker]";
	} else if (m.contactMessage) {
		msgType = "Kontak";
		content = "[Kontak dikirim]";
	} else if (m.locationMessage) {
		msgType = "Lokasi";
		content = "[Lokasi dibagikan]";
	} else if (m.buttonsMessage) {
		msgType = "Tombol";
		content = "[Pesan dengan tombol]";
	}

	// Format timestamp dari WhatsApp
	const timestamp = msg.messageTimestamp
		? new Date(msg.messageTimestamp * 1000)
		: new Date();
	const pad = n => n.toString().padStart(2, '0');
	const timeStr = `${pad(timestamp.getDate())}.${pad(timestamp.getMonth() + 1)}.${timestamp.getFullYear()} ${pad(timestamp.getHours())}:${pad(timestamp.getMinutes())}:${pad(timestamp.getSeconds())}`;

	const label = isFromMe ? "📤 Pesan Keluar :" : "💬 Pesan Masuk :";

	// Cetak ke console
	console.log("=========================================================");
	console.log(`${timeStr} ${label}`);
	console.log(`📨  Session   : ${sessionId}`);
	console.log(`👤  From      : ${from}${!isFromMe ? ` ${pushName}` : ""}`);
	console.log(`📲  To        : ${to}`);
	console.log(`👥  Group     : ${isGroup ? "True" : "False"}`);
	if (isGroup) {
		console.log(`🆔  Group ID  : ${groupId}`);
	}
	console.log(`🗂️  Tipe      : ${msgType}`);
	console.log(`🗂️  Broadcast : ${broadcast}`);
	console.log(`✉️  Message   : ${content}`);
});


// =======================================================
// 🚀 Jalankan server
// =======================================================
app.listen(port, () => {
	console.log("==================================================");
	console.log(`🚀 WhatsApp Gateway aktif di http://localhost:${port}`);
	console.log("==================================================");
});