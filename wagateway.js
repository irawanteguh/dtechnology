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
			media   : fileBuffer,
			text    : text || ""
		});

		console.log("_______________________________________________________");
		console.log(`:: ✅ Berhasil mengirim dokumen ::`);
		console.log(`   To      : ${to}`);
		console.log(`   Session : ${session}`);

		res.json({ status: true, result });

	} catch (err) {
		console.log("_______________________________________________________");
		console.log(`:: ❌ Gagal mengirim dokumen ::`);
		console.log(`   To      : ${to}`);
		console.log(`   Mesasge : `,err.message);
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
	console.log("_______________________________________________________");
	console.log(`:: ✅ Session ${sessionId} : Connected ::`);

	try {
		const session  = await whatsapp.getSession(sessionId);
		const phone    = (session?.user?.id || "").split(":")[0];
		const username = session?.user?.name || "";

		// console.log(session);

		console.log("_______________________________________________________");
		console.log(":: ℹ️  Informasi Pengguna ::");
		console.log("   id   :",(session?.user?.id || "").split(":")[0]);
		console.log("   lid  :",(session?.user?.lid || "").split(":")[0]);
		console.log("   name :",session?.user.name);

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
			console.log("_______________________________________________________");
			console.log(':: ✅ Payload terkirim ke API ::');
			console.log("   status   :",data.status);
			console.log("   message  :",data.message);
			console.log("   username :",data.data.username);
			console.log("   phone    :",data.data.phone);
			console.log("   status   :",data.data.status);
		} catch {
			console.log("_______________________________________________________");
			console.log(':: ⚠️  Response Rest API ::');
			console.log(text);
		}
	} catch (err) {
		console.log("_______________________________________________________");
		console.log('❌ Error saat mengirim info ke API:', err.message);
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
// whatsapp.onMessageReceived(async msg => {
// 	const sessionId   = msg.sessionId || "unknown";
// 	const isFromMe    = msg.key?.fromMe === true;
// 	const isGroup     = msg.key?.remoteJid?.endsWith("@g.us");
// 	const remoteJid   = msg.key?.remoteJid || "unknown";
// 	const pushName    = msg.pushName || "";
// 	const broadcast   = msg.broadcast || false;
// 	const participant = msg.key?.participant || null;

// 	// console.log("==================================");
// 	// console.log(msg);
// 	// console.log("==================================");

// 	let from      = "";
// 	let to        = "";
// 	let groupId   = "";
// 	let groupName = "";
// 	let msgType   = "[📎 Unknown]";
// 	let content   = "[📎 Tidak ada isi pesan]";

// 	// Tentukan From & To
// 	if (isFromMe) {
// 		from = remoteJid.split("@")[0]+" "+pushName || "Me";
// 		to   = remoteJid.split("@")[0];
// 	} else {
// 		from = (participant || remoteJid).split("@")[0];
// 		to   = "Me";
// 	}

// 	// Ambil ID dan Nama Grup jika grup
// 	if (isGroup) {
// 		const match = remoteJid.match(/^(.*)@g\.us$/);
// 		groupId = match ? match[1] : remoteJid.split("@")[0];

// 		try {
// 			const metadata = await whatsapp.groupMetadata(remoteJid);
// 			groupName = metadata?.subject || "";
// 		} catch (err) {
// 			groupName = "";
// 		}
// 	}

// 	// Deteksi isi dan tipe pesan
// 	const m = msg.message || {};

// 	if (m.protocolMessage && m.protocolMessage.type === 0) {
// 		msgType = "Pesan Dihapus";
// 		content = "[Pesan telah dihapus]";
// 	} else if (m.conversation) {
// 		msgType = "Teks";
// 		content = m.conversation;
// 	} else if (m.extendedTextMessage?.text) {
// 		msgType = "Teks";
// 		content = m.extendedTextMessage.text;
// 	} else if (m.imageMessage?.caption) {
// 		msgType = "Gambar";
// 		content = m.imageMessage.caption;
// 	} else if (m.imageMessage) {
// 		msgType = "Gambar";
// 		content = "[Gambar tanpa caption]";
// 	} else if (m.documentMessage?.fileName) {
// 		msgType = "Dokumen";
// 		content = m.documentMessage.fileName;
// 	} else if (m.videoMessage?.caption) {
// 		msgType = "Video";
// 		content = m.videoMessage.caption;
// 	} else if (m.videoMessage) {
// 		msgType = "Video";
// 		content = "[Video tanpa caption]";
// 	} else if (m.audioMessage) {
// 		msgType = "Audio";
// 		content = "[Audio]";
// 	} else if (m.stickerMessage) {
// 		msgType = "Stiker";
// 		content = "[Stiker]";
// 	} else if (m.contactMessage) {
// 		msgType = "Kontak";
// 		content = "[Kontak dikirim]";
// 	} else if (m.locationMessage) {
// 		msgType = "Lokasi";
// 		content = "[Lokasi dibagikan]";
// 	} else if (m.buttonsMessage) {
// 		msgType = "Tombol";
// 		content = "[Pesan dengan tombol]";
// 	}


// 	// Format waktu
// 	const timestamp = msg.messageTimestamp
// 		? new Date(msg.messageTimestamp * 1000)
// 		: new Date();
// 	const pad = n => n.toString().padStart(2, '0');
// 	const timeStr = `${pad(timestamp.getDate())}.${pad(timestamp.getMonth() + 1)}.${timestamp.getFullYear()} ${pad(timestamp.getHours())}:${pad(timestamp.getMinutes())}:${pad(timestamp.getSeconds())}`;
// 	const label = isFromMe ? "📤 Pesan Keluar :" : "💬 Pesan Masuk :";

// 	// Tampilkan ke console
// 	console.log("=========================================================");
// 	console.log(`${timeStr} ${label}`);
// 	console.log(`📨  Session   : ${sessionId}`);
// 	console.log(`🆔  Message ID: ${msg.key?.id || '-'}`); 
// 	console.log(`👤  From      : ${from}${!isFromMe ? ` ${pushName}` : ""}`);
// 	console.log(`📲  To        : ${to}`);
// 	if(isGroup){
// 		console.log(`👥  Group     : True | 🆔 ID: ${groupId} | 📛 Name: ${groupName}`);
// 	}
// 	console.log(`🗂️   Tipe      : ${msgType}`);
// 	console.log(`🗂️   Broadcast : ${broadcast}`);
// 	console.log(`✉️   Message   : ${content}`);
// });

whatsapp.onMessageReceived(async msg => {
	const separator     = "_______________________________________________________";
	const sessionId     = msg.sessionId || "unknown";
	const remoteJidFull = msg.key?.remoteJid || "";                                                                                                                                                                                                                                                                                                      // ex: 120363422251812300@g.us
	const remoteJid     = remoteJidFull.split("@")[0];                                                                                                                                                                                                                                                                                                   // ex: 120363422251812300
	const groupId       = (remoteJidFull.match(/^.+?-(\d+)@g\.us$/) || remoteJidFull.match(/^(\d+)@g\.us$/) || [])[1] || "";
	const participant   = msg.key?.participant ? msg.key.participant.split("@")[0] : "";
	const isGroup       = msg.key?.remoteJid?.endsWith("@g.us");
	const isFromMe      = msg.key?.fromMe === true;
	const broadcast     = msg.broadcast || false;
	const pushName      = msg.verifiedBizName || msg.pushName || "";
	const m             = msg.message || {};
	const messageId     = m?.protocolMessage?.key?.id || msg.key?.id || "";
	const timestamp     = `${(t => `${t.getDate().toString().padStart(2,'0')}.${(t.getMonth()+1).toString().padStart(2,'0')}.${t.getFullYear()} ${t.getHours().toString().padStart(2,'0')}:${t.getMinutes().toString().padStart(2,'0')}:${t.getSeconds().toString().padStart(2,'0')}`)(new Date((msg.messageTimestamp || Date.now() / 1000) * 1000))}`;
	
	let msgType = "Unknown";
	let content = "";
	let caption = "";

	// console.log("==================================");
	// console.log(msg);
	// console.log("==================================");

	if (m.editedMessage?.message) {
		const em = m.editedMessage.message;
		if (em.conversation) {
			msgType = "Edited Message";
			content = em.conversation;
		} else if (em.extendedTextMessage?.text) {
			msgType = "Edited Message";
			content = em.extendedTextMessage.text;
		} else if (em.imageMessage?.caption) {
			msgType = "Edited Image";
			caption = em.imageMessage.caption;
			content = "[Image]";
		} else {
			msgType = "Edited Message";
			content = "[Unrecognized edited message]";
		}
	} else if (m.conversation) {
		msgType = "Text";
		content = m.conversation;
	} else if (m.extendedTextMessage?.text) {
		msgType = "Text";
		content = m.extendedTextMessage.text;
	} else if (m.imageMessage) {
		msgType = "Image";
		caption = m.imageMessage.caption || "";
		content = "";
	} else if (m.documentMessage) {
		msgType = "Document";
		caption = m.documentMessage.caption || "";
		content = m.documentMessage.fileName || "";
	} else if (m.videoMessage) {
		msgType = "Video";
		caption = m.videoMessage.caption || "";
		content = caption || "";
	} else if (m.audioMessage) {
		msgType = "Audio";
		content = "Audio message";
	} else if (m.stickerMessage) {
		msgType = "Sticker";
		content = "Sticker";
	} else if (m.contactMessage) {
		msgType = "Contact";
		content = "Contact shared";
	} else if (m.locationMessage) {
		msgType = "Location";
		content = "Location shared";
	} else if (m.buttonsMessage) {
		msgType = "Buttons";
		content = "Message with buttons";
	} else if (m.templateMessage?.templateId) {
		msgType = "Template";
		content = `Template ID: ${m.templateMessage.templateId}`;
	}


	console.log(separator);
	if(broadcast){
		console.log(":: 📢  Broadcast ::");
		console.log(`   From          : ${participant} ${pushName}`);
		console.log(`   Message Type  : ${msgType}`);
		console.log(`   Message       : ${content}`);
	}else{
		if(m.protocolMessage?.type === 0){
			if(isGroup){
				console.log(":: 🗑️  Messages in Group have been deleted ::");
				console.log(`   From          : ${participant} ${pushName}`);
				console.log(`   Group ID      : ${remoteJid}`);
			}else{
				console.log(":: 🗑️  Message has been deleted ::");
				console.log(`   From          : ${pushName}`);
				console.log(`   To            : ${remoteJid}`);
			}
		}else{
			console.log(`${isGroup ? (isFromMe ? ":: 📤 Outgoing Group Message ::" : ":: 📥 Incoming Group Message ::") : (isFromMe ? ":: 📤 Outgoing Message ::" : ":: 📥 Incoming Message ::")}`);
			if(isGroup){
				console.log(`   From          : ${participant} ${pushName}`);
				console.log(`   Group ID      : ${groupId}`);
			}else{
				if(isFromMe){
					console.log(`   From          : ${pushName}`);
					console.log(`   To            : ${remoteJid}`);
				}else{
					console.log(`   From          : ${remoteJid} ${pushName}`);
					console.log(`   To            : Me`);
				}
			}
			console.log(`   Message Type  : ${msgType}`);
			console.log(`   Message       : ${content}`);
			if(msgType!="Text"){
				console.log(`   Caption       : ${caption}`);
			}
			
		}
	}

	console.log(`   Session ID    : ${sessionId}`);
	console.log(`   Message ID    : ${messageId}`);
	console.log(`   Timestamp     : ${timestamp}`);
	
});

// =======================================================
// 🚀 Jalankan server
// =======================================================
app.listen(port, () => {
	console.log("==================================================");
	console.log(`🚀 WhatsApp Gateway aktif di http://localhost:${port}`);
	console.log("==================================================");
});