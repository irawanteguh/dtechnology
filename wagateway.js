const express = require("express");
const cors = require("cors");
const fs = require("fs");
const whatsapp = require("wa-multi-session");

const app = express();
app.use(cors());
app.use(express.json());

// QR Store
const qrStore = {};

// Load saved sessions on startup
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

whatsapp.onConnected(sessionId => {
  console.log("✅ Session connected:", sessionId);
});

whatsapp.onMessageReceived(msg => {
  console.log(`📨 New message from ${msg.key.remoteJid} on session ${msg.sessionId}`);
});

// Run server
const PORT = 5001;
app.listen(PORT, () => {
  console.log(`🚀 WhatsApp Gateway running at http://localhost:${PORT}`);
});