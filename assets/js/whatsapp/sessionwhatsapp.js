let qrPollingLoop = null;
let pollingConnectionLoop = null;
let qrTimeout = null;

// Hentikan semua loop jika modal ditutup manual
$('#modal_sessionwhatsapp_viewbarcode').on('hidden.bs.modal', function () {
    if (qrPollingLoop) clearInterval(qrPollingLoop);
    if (pollingConnectionLoop) clearInterval(pollingConnectionLoop);
    if (qrTimeout) clearTimeout(qrTimeout);

    masterdevice();
});

masterdevice();

function masterdevice() {
    $.ajax({
        url: url + "index.php/whatsapp/sessionwhatsapp/masterdevice",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterdevice").html("");
        },
        success: function (data) {
            var result = "";
            var tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].device_id + "</td>";
                    tableresult += "<td>" + result[i].device_name + "</td>";
                    tableresult += "<td>" + (result[i].phone || '') + "</td>";
                    tableresult += `<td><span class='badge ${(result[i].status === "connected" ? "badge-light-success" : "badge-light-danger")}'>${result[i].status || ''}</span></td>`;
                    if (result[i].status === "disconnected" || !result[i].status) {
                        tableresult += `<td class='text-end pe-4'><a class='btn btn-sm btn-light-success' data-bs-toggle='modal' data-bs-target='#modal_sessionwhatsapp_viewbarcode' onclick="startSession('${result[i].transaksi_id}')"><i class='bi bi-link-45deg'></i> Link Device</a></td>`;
                    } else {
                        tableresult += `<td class='text-end pe-4'><a class='btn btn-sm btn-light-danger' onclick="deleteSession('${result[i].transaksi_id}')"><i class='bi bi-link-45deg'></i> Logout</a></td>`;
                    }
                    tableresult += "</tr>";
                }
            }

            $("#resultdatamasterdevice").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error(xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
}

async function startSession(sessionId) {
    if (!sessionId) {
        return Swal.fire("Peringatan", "Session ID wajib diisi.", "warning");
    }

    const statusEl = document.getElementById("status");
    const loaderEl = document.getElementById("qr-loader");
    const qrEl = document.getElementById("qr");

    statusEl.innerText = "Mengecek status sesi...";
    loaderEl.style.display = "block";
    qrEl.innerHTML = "";

    if (qrPollingLoop) clearInterval(qrPollingLoop);
    if (pollingConnectionLoop) clearInterval(pollingConnectionLoop);
    if (qrTimeout) clearTimeout(qrTimeout);

    const pollQR = async () => {
        try {
            const qrRes = await fetch(`http://192.168.102.13:5001/session/qr/${sessionId}`);
            if (qrRes.ok) {
                const qrData = await qrRes.json();
                if (qrData.qr && qrData.qr.startsWith("2@")) {
                    qrEl.innerHTML = "";
                    new QRCode(qrEl, {
                        text: qrData.qr,
                        width: 280,
                        height: 280,
                    });
                    statusEl.innerText = "Silakan scan QR dengan WhatsApp Anda.";
                } else {
                    statusEl.innerText = "Menunggu QR tersedia...";
                }
            } else {
                statusEl.innerHTML = "Gagal Menampilkan QR Code<br>Koneksi ke Gateway WhatsApp terputus.<br>Silakan periksa server atau jaringan.";
                qrEl.innerHTML = "";
            }
        } catch (err) {
            console.warn("Polling QR error:", err.message);
            statusEl.innerHTML = "Gagal Menampilkan QR Code<br>Koneksi ke Gateway WhatsApp terputus.<br>Silakan periksa server atau jaringan.";
            qrEl.innerHTML = "";
        } finally {
            loaderEl.style.display = "none";
        }
    };

    const pollConnection = async () => {
        try {
            const infoRes = await fetch(`http://192.168.102.13:5001/session/info/${sessionId}`);
            if (infoRes.ok) {
                const data = await infoRes.json();
                const userId = data?.info?.user?.id;

                if (userId) {
                    statusEl.innerHTML = `✅ Terhubung dengan WhatsApp<br><b>ID:</b> ${userId.split(":")[0]}`;
                    clearInterval(qrPollingLoop);
                    clearInterval(pollingConnectionLoop);
                    clearTimeout(qrTimeout);

                    $('#modal_sessionwhatsapp_viewbarcode').modal('hide');
                    setTimeout(() => { masterdevice(); }, 3000);
                } else {
                    await pollQR();
                }
            }
        } catch (err) {
            console.warn("Polling connection error:", err.message);
        }
    };

    try {
        const sessionCheck = await fetch(`http://192.168.102.13:5001/session/info/${sessionId}`);

        if (sessionCheck.ok) {
            const sessionData = await sessionCheck.json();
            const userId = sessionData?.info?.user?.id;

            if (!userId) {
                statusEl.innerText = "Menunggu QR Code dari server...";
                await pollQR();

                qrPollingLoop = setInterval(pollQR, 20000);
                pollingConnectionLoop = setInterval(pollConnection, 5000);

                qrTimeout = setTimeout(() => {
                    clearInterval(qrPollingLoop);
                    clearInterval(pollingConnectionLoop);
                    $('#modal_sessionwhatsapp_viewbarcode').modal('hide');
                }, 120000);
            } else {
                statusEl.innerHTML = `✅ Terhubung dengan WhatsApp<br><b>ID:</b> ${userId.split(":")[0]}`;
                loaderEl.style.display = "none";
            }
        } else {
            statusEl.innerText = "Membuat Session Baru...";

            const startRes = await fetch("http://192.168.102.13:5001/session/start", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ session: sessionId })
            });

            if (startRes.ok) {
                statusEl.innerText = "Menunggu QR Code dari server...";
                await new Promise(resolve => setTimeout(resolve, 3000));

                await pollQR();
                qrPollingLoop = setInterval(pollQR, 20000);
                pollingConnectionLoop = setInterval(pollConnection, 5000);

                qrTimeout = setTimeout(() => {
                    clearInterval(qrPollingLoop);
                    clearInterval(pollingConnectionLoop);
                    $('#modal_sessionwhatsapp_viewbarcode').modal('hide');
                }, 120000);
            } else {
                statusEl.innerText = "Gagal memulai session baru.";
                qrEl.innerHTML = "";
            }
        }
    } catch (err) {
        statusEl.innerHTML = "Gagal mengecek session.<br>Periksa server atau hubungi admin.";
        loaderEl.style.display = "none";
    }
}

function deleteSession(sessionId) {
    if (!sessionId) return;

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Session ini akan dihapus dari gateway.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const res = await fetch(`http://localhost:5001/session/logout?session=${sessionId}`);
                const json = await res.json();

                if (json.status) {
                    toastr.success("Session berhasil dihapus.");
                    masterdevice();
                } else {
                    Swal.fire({
                        title: "Gagal Menghapus Session",
                        text: json.message || "Terjadi kesalahan saat menghapus session.",
                        icon: "error",
                        confirmButtonText: "Tutup"
                    });
                }
            } catch (err) {
                console.error("Error deleting session:", err.message);
                Swal.fire({
                    title: "Kesalahan",
                    text: "Terjadi kesalahan saat menghapus session.",
                    icon: "error",
                    confirmButtonText: "Tutup"
                });
            }
        }
    });
}
