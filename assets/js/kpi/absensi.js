reportpresence();

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