const port     = 5001;
const express  = require("express");
const cors     = require("cors");
const fs       = require("fs");
const https    = require("https");
const whatsapp = require("wa-multi-session");
const qrStore  = {};

const app = express();
app.use(cors());
app.use(express.json());

// =======================================================
// 🔄 Load sessions from disk (jika pernah tersimpan)
// =======================================================
whatsapp.loadSessionsFromStorage();

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

	if (qrStore[sessionId]) {
		res.json({ qr: qrStore[sessionId] });
	} else {
		res.status(404).json({ message: "QR not available" });
	}
});

// =======================================================
// 💬 Endpoint: Send text message
// =======================================================
app.post("/message/send-text", async (req, res) => {
	const { session, to, text } = req.body;
	try {
		const result = await whatsapp.sendTextMessage({ sessionId: session, to, text });
		console.log(`✅ Pesan berhasil dikirim ke ${to} melalui session ${session}`);
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
		console.log(`✅ Dokumen berhasil dikirim ke ${to} melalui session ${session}`);
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
	if (url.startsWith("http")) {
		return new Promise((resolve, reject) => {
			https.get(url, res => {
				const chunks = [];
				res.on("data", chunk => chunks.push(chunk));
				res.on("end", () => resolve(Buffer.concat(chunks)));
			}).on("error", reject);
		});
	} else {
		return fs.readFileSync(url);
	}
}

// =======================================================
// 📌 Event: Saat QR diperbarui
// =======================================================
whatsapp.onQRUpdated(({ sessionId, qr }) => {
	qrStore[sessionId] = qr;
	console.log(`📲 QR Code diperbarui untuk session ${sessionId}`);
});

// =======================================================
// ✅ Event: Saat session berhasil terhubung
// =======================================================
whatsapp.onConnected(async (sessionId) => {
	console.log(`✅ Session ${sessionId} berhasil terhubung`);

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

		const response = await fetch('http://localhost/dtechnology/index.php/updatedevice', {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(payload)
		});

		const text = await response.text();
		try {
			const data = JSON.parse(text);
			console.log('📡 Payload terkirim ke API:', data);
		} catch {
			console.warn('⚠️  Respon bukan JSON (kemungkinan HTML):', text);
		}
	} catch (err) {
		console.error('❌ Error saat mengirim info ke API:', err.message);
	}
});

// =======================================================
// 🔌 Event: Saat session terputus
// =======================================================
whatsapp.onDisconnected(async (sessionId, reason) => {
	console.log(`🔌 Session ${sessionId} terputus`);

	const payload = {
		session_id: sessionId,
		status    : "disconnected",
		phone     : ""
	};

	try {
		const response = await fetch("http://localhost/dtechnology/index.php/updatedevice", {
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
// 📥 Event: Saat menerima pesan masuk
// =======================================================
whatsapp.onMessageReceived(msg => {
	const from      = msg.key?.remoteJid?.split('@')[0] || "unknown";
	const sessionId = msg.sessionId || "unknown";
	const pushName  = msg.pushName || "Tanpa Nama";

	console.log("💬 Pesan Baru Diterima:");
	console.log(`📨 Session : ${sessionId}`);
	console.log(`👤 Dari    : ${from} (${pushName})`);
});

// =======================================================
// 🚀 Jalankan server
// =======================================================
app.listen(port, () => {
	console.log("==================================================");
	console.log(`🚀 WhatsApp Gateway aktif di http://localhost:${port}`);
	console.log("==================================================");
});
