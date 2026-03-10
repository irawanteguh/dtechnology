let mapAbsensi;
let markerMasuk, markerKeluar;
const CENTER       = { lat: 1.2858396300516295, lon: 101.19232472131372 };
const RADIUS_LIMIT = 0.1; // dalam kilometer (100 meter)

reportpresence();

$(document).on('show.bs.modal', '#modal_view_informasi_absensi', function (e) {
    const triggerLink = $(e.relatedTarget);

    // Ambil data lokasi dari atribut
    const latMasuk  = parseFloat(triggerLink.attr("datalatitudemasuk"));
    const lonMasuk  = parseFloat(triggerLink.attr("datalongtitudemasuk"));
    const latKeluar = parseFloat(triggerLink.attr("datalatitudekeluar"));
    const lonKeluar = parseFloat(triggerLink.attr("datalongtitudekeluar"));

    // Bersihkan isi jika tidak ada data
    if ((isNaN(latMasuk) || isNaN(lonMasuk)) && (isNaN(latKeluar) || isNaN(lonKeluar))) {
        $("#map_absensi").html("<div class='text-center text-danger fw-bold mt-5'>Lokasi tidak tersedia</div>");
        return;
    }

    setTimeout(() => {
        tampilkanMapAbsensi(latMasuk, lonMasuk, latKeluar, lonKeluar);
    }, 300);
});

function tampilkanMapAbsensi(latMasuk, lonMasuk, latKeluar, lonKeluar) {
    if (mapAbsensi) {
        mapAbsensi.remove();
    }

    mapAbsensi = L.map('map_absensi');
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(mapAbsensi);

    let markers = [];

    // === Tambahkan area radius pusat (misalnya kantor) ===
    const centerMarker = L.marker([CENTER.lat, CENTER.lon], {
        icon: L.icon({
            iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/blue-dot.png',
            iconSize: [36, 36],
            iconAnchor: [18, 36]
        })
    }).addTo(mapAbsensi);

    centerMarker.bindTooltip("🏢 <b>Area Kantor</b>", {
        permanent: true,
        direction: 'right',
        offset: [10, 0],
        className: 'tooltip-custom'
    }).openTooltip();

    // Buat lingkaran radius area (meter)
    const radiusMeter = RADIUS_LIMIT * 1000;
    const areaCircle = L.circle([CENTER.lat, CENTER.lon], {
        radius: radiusMeter,
        color: '#007bff',
        fillColor: '#007bff',
        fillOpacity: 0.15
    }).addTo(mapAbsensi);

    markers.push([CENTER.lat, CENTER.lon]);

    // === Marker MASUK (Hijau)
    if (!isNaN(latMasuk) && !isNaN(lonMasuk)) {
        let markerMasuk = L.marker([latMasuk, lonMasuk], {
            icon: L.icon({
                iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/green-dot.png',
                iconSize: [36, 36],
                iconAnchor: [18, 36]
            })
        }).addTo(mapAbsensi);

        markerMasuk.bindTooltip("🟢 <b>Absen Masuk</b>", {
            permanent: true,
            direction: 'right',
            offset: [10, 0],
            className: 'tooltip-custom'
        }).openTooltip();

        markers.push([latMasuk, lonMasuk]);
    }

    // === Marker KELUAR (Merah)
    if (!isNaN(latKeluar) && !isNaN(lonKeluar)) {
        let markerKeluar = L.marker([latKeluar, lonKeluar], {
            icon: L.icon({
                iconUrl: 'https://maps.gstatic.com/mapfiles/ms2/micons/red-dot.png',
                iconSize: [36, 36],
                iconAnchor: [18, 36]
            })
        }).addTo(mapAbsensi);

        markerKeluar.bindTooltip("🔴 <b>Absen Pulang</b>", {
            permanent: true,
            direction: 'right',
            offset: [10, 0],
            className: 'tooltip-custom'
        }).openTooltip();

        markers.push([latKeluar, lonKeluar]);
    }

    // === Sesuaikan tampilan map ===
    if (markers.length > 1) {
        mapAbsensi.fitBounds(markers, { padding: [50, 50] });
    } else if (markers.length === 1) {
        mapAbsensi.setView(markers[0], 17);
    }
}

function reportpresence(){
    $.ajax({
        url        : url+"index.php/kpi/absensi/reportpresence",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatareportpresence").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";

            if (data.responCode === "00") {
                result = data.responResult;

                // Ambil tanggal hari ini (tanpa jam)
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                for (var i in result) {
                    // Parsing "DD.MM.YYYY" → Date object
                    let parts = result[i].periode.split(".");
                    const periodeDate = new Date(parts[2], parts[1] - 1, parts[0]);
                    periodeDate.setHours(0, 0, 0, 0);

                    let terlambat = 0;
                    let pulangcepat = 0;
                    let note = [];

                    var getvariabel =  " datalatitudemasuk='" + result[i].latjammasuk + "'"+
                                       " datalongtitudemasuk='" + result[i].longjammasuk + "'"+
                                       " datalatitudekeluar='" + result[i].latjamkeluar + "'"+
                                       " datalongtitudekeluar='" + result[i].longjamkeluar + "'";

                    // Hitung terlambat
                    if (result[i].realjammasuk && result[i].jammasuk) {
                        const jamKerjaMasuk = timeToMinutes(result[i].jammasuk);
                        const jamRealisasiMasuk = timeToMinutes(result[i].realjammasuk);
                        const diffMasuk = jamRealisasiMasuk - jamKerjaMasuk;
                        terlambat = diffMasuk > 0 ? diffMasuk : 0;
                    }

                    // Hitung pulang cepat
                    if (result[i].realjamkeluar && result[i].jamkeluar) {
                        const jamKerjaKeluar = timeToMinutes(result[i].jamkeluar);
                        const jamRealisasiKeluar = timeToMinutes(result[i].realjamkeluar);
                        const diffKeluar = jamKerjaKeluar - jamRealisasiKeluar;
                        pulangcepat = diffKeluar > 0 ? diffKeluar : 0;
                    }

                    // Tentukan catatan (note)
                    if ((!result[i].realjammasuk || result[i].realjammasuk === "") && periodeDate <= today) {
                        note.push("Tidak absen masuk");
                    }
                    if ((!result[i].realjamkeluar || result[i].realjamkeluar === "") && periodeDate <= today) {
                        note.push("Tidak absen keluar");
                    }
                    if (terlambat > 0) note.push("Terlambat " + terlambat + " menit");
                    if (pulangcepat > 0) note.push("Pulang cepat " + pulangcepat + " menit");
                    if (note.length === 0 && periodeDate <= today) note.push("Lengkap");

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].days + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].periode + "</td>";
                    tableresult += "<td class='text-center table-" + result[i].colorshift + "'>" + result[i].codeshift + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].jammasuk + " - " + result[i].jamkeluar + "</td>";

                    // realjammasuk
                    if (!result[i].realjammasuk) {
                        if (periodeDate <= today)
                            tableresult += "<td class='text-center'><i class='bi bi-x-circle-fill text-danger'></i></td>";
                        else
                            tableresult += "<td class='text-center text-muted'></td>";
                    } else {
                        tableresult += "<td class='text-center'>" + result[i].realjammasuk + "</td>";
                    }

                    // realjamkeluar
                    if (!result[i].realjamkeluar) {
                        if (periodeDate <= today)
                            tableresult += "<td class='text-center'><i class='bi bi-x-circle-fill text-danger'></i></td>";
                        else
                            tableresult += "<td class='text-center text-muted'></td>";
                    } else {
                        tableresult += "<td class='text-center'>" + result[i].realjamkeluar + "</td>";
                    }

                    // Terlambat & Pulang cepat
                    tableresult += "<td class='text-center " + (terlambat > 0 ? "text-danger fw-bold" : "text-muted") + "'>" +
                                (terlambat > 0 ? terlambat + " min" : "0") + "</td>";
                    tableresult += "<td class='text-center " + (pulangcepat > 0 ? "text-danger fw-bold" : "text-muted") + "'>" +
                                (pulangcepat > 0 ? pulangcepat + " min" : "0") + "</td>";

                    // Catatan
                    let colorNote = "text-muted";
                    if (note.includes("Tidak absen masuk") || note.includes("Tidak absen keluar")) colorNote = "text-danger fw-bold";
                    else if (note.includes("Terlambat") || note.includes("Pulang cepat")) colorNote = "text-warning fw-bold";
                    else if (note.includes("Lengkap")) colorNote = "text-success fw-bold";

                    tableresult += "<td class='" + colorNote + "'>" + note.join(", ") + "</td>";
                    tableresult += "<td class='pe-4 text-end'><a href='#' class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#modal_view_informasi_absensi' "+getvariabel+">View Detail</a></td>";

                    tableresult += "</tr>";
                }
            }

            // === Fungsi bantu: konversi "HH.MM.SS" → menit ===
            function timeToMinutes(timeStr) {
                if (!timeStr) return 0;
                const parts = timeStr.split(".");
                const hours = parseInt(parts[0]) || 0;
                const minutes = parseInt(parts[1]) || 0;
                return hours * 60 + minutes;
            }







            $("#resultdatareportpresence").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            KTApp.initBootstrapTooltips();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};