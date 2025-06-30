async function startSession() {
  const session = document.getElementById("session").value.trim();
  if (!session) return alert("Session wajib diisi.");

  document.getElementById("status").innerText = "🕐 Membuat session & mengambil QR...";
  document.getElementById("qr").innerHTML = "";

  await fetch("http://localhost:5001/session/start", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ session }),
  });

  const loop = setInterval(async () => {
    const res = await fetch(`http://localhost:5001/session/qr/${session}`);
    if (res.ok) {
      const data = await res.json();
      if (data.qr && data.qr.startsWith("2@")) {
        document.getElementById("qr").innerHTML = "";
        new QRCode(document.getElementById("qr"), {
          text: data.qr,
          width: 300,
          height: 300,
        });
        document.getElementById("status").innerText = "📲 Scan QR dengan WhatsApp";
        clearInterval(loop);
      }
    }
  }, 1000);
}