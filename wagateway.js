const express  = require("express");
const cors     = require("cors");
const fs       = require("fs");
const whatsapp = require("wa-multi-session");
const qrStore  = {};

const app = express();
app.use(cors());
app.use(express.json());

whatsapp.loadSessionsFromStorage();

// Start new session
app.post("/session/start", async (req, res) => {
  const { session } = req.body;
  if (!session) return res.status(400).json({ message: "Session is required" });

  await whatsapp.startSession(session);
  res.json({ message: "Session started", session });
});

// Get QR Code
app.get("/session/qr/:session", (req, res) => {
  const sessionId = req.params.session;
  if (qrStore[sessionId]) {
    res.json({ qr: qrStore[sessionId] });
  } else {
    res.status(404).json({ message: "QR not available" });
  }
});

// Send Text Message
app.post("/message/send-text", async (req, res) => {
  const { session, to, text } = req.body;
  try {
    const result = await whatsapp.sendTextMessage({ sessionId: session, to, text });
    res.json({ status: true, result });
  } catch (err) {
    res.status(500).json({ status: false, error: err.message });
  }
});

// Send Document
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
    res.json({ status: true, result });
  } catch (err) {
    res.status(500).json({ status: false, error: err.message });
  }
});

// Get session info
app.get("/session/info/:session", async (req, res) => {
	const sessionId = req.params.session;

	try {
		const session = await whatsapp.getSession(sessionId);

		if (!session) {
			console.warn(`⚠️ Session ${sessionId} tidak ditemukan.`);
			return res.status(404).json({ message: "Session not found" });
		}

		const info = {
			user     : session.user || {},
			pushname : session.pushname || null,
			platform : session.platform || null,
			state    : session.user?.id ? "CONNECTED" : "PAIRING",
			sessionId: sessionId
		};

		res.json({ status: true, info });
	}catch (err){
		console.error(`❌ Gagal ambil info session ${sessionId}:`, err.message);
		res.status(500).json({ status: false, message: "Failed to retrieve session info", error: err.message });
	}
});

// Fetch file from URL or local path
async function fetchFile(url) {
  if (url.startsWith("http")) {
    const https = require("https");
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

// Event handlers
whatsapp.onQRUpdated(({ sessionId, qr }) => {
  qrStore[sessionId] = qr;
  console.log(`📲 QR updated for session ${sessionId}`);
});

whatsapp.onConnected(async (sessionId) => {
	console.log("✅ Session connected:", sessionId);

	try{
		const session = await whatsapp.getSession(sessionId);
		const phone    = (session?.user?.id || "").split(":")[0];
		const username = session?.user?.name || "";

		// const info = {
		// 	user    : session?.user,
		// 	pushname: session?.pushname,
		// 	platform: session?.platform,
		// 	state   : session?.state
		// };

		console.log("ℹ️  Informasi session:", session?.user);

		const payload = {
			session_id: sessionId,
			status    : 'connected',
			username  : username,
			phone     : phone
		};

		console.log("ℹ️  Informasi Payload:", payload);

		const response = await fetch('http://localhost/dtech/dtechnology/index.php/updatedevice', {
			method: 'POST',
			headers: {
			'Content-Type': 'application/json'
			},
			body: JSON.stringify(payload)
		});

		const text = await response.text();

		try {
			const data = JSON.parse(text);
			console.log('Device update sent to API:', data);
		} catch (e) {
			console.error('❌ Response bukan JSON. Kemungkinan HTML:', text);
		}

	}catch (err){
		console.error('❌ Fetch error:', err.message);
	}
});

whatsapp.onDisconnected(async (sessionId, reason) => {
	console.log("ℹ️  Informasi Session Disconnected : ", sessionId);

	const payload = {
		session_id: sessionId,
		status    : "disconnected",
		phone     : ""
	};

	try{
		const response = await fetch("http://localhost/dtech/dtechnology/index.php/updatedevice", {
			method : "POST",
			headers: { "Content-Type": "application/json" },
			body   : JSON.stringify(payload)
		});
		const text = await response.text();
		try{
			const data = JSON.parse(text);
			console.log("ℹ️  Informasi Update Divice Disconnected : ", data);
		}catch{
			console.log("❌ Response Update Divice Disconnected : ", text);
		}
	}catch(err){
		console.log("❌ Fetch error Session Disconnected : ", err.message);
	}
});

whatsapp.onMessageReceived(msg => {
	const from       = msg.key?.remoteJid?.split('@')[0] || "unknown";
	const sessionId  = msg.sessionId || "unknown";
	const pushName   = msg.pushName || "Tanpa Nama";

	console.log("Pesan Baru Diterima:");
	console.log(`Session     : ${sessionId}`);
	console.log(`Pengirim    : ${from}`);
	console.log(`Nama        : ${pushName}`);
});


const PORT = 5001;
app.listen(PORT, () => {
	console.log(`🚀 WhatsApp Gateway running at http://localhost:${PORT}`);
});