datapiutang();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    datapiutang();
});

function datapiutang() {
    var tahun = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url: url + "index.php/piutang/summary/datapiutang",
        data: { periode: tahun },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Mengambil data piutang...", "Harap tunggu");

            // Kosongkan semua tabel per bulan
            for (var i = 1; i <= 12; i++) {
                $("#resultdatapiutang_" + i).html("");
                $("#resulttotaldatapiutang_" + i).html(""); // Kosongkan tfoot
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                let result = data.responResult;

                // Struktur penampung total per bulan
                let totals = {};
                for (let i = 1; i <= 12; i++) {
                    totals[i] = { nilai: 0, terbayar: 0, sisa: 0 };
                }

                result.forEach(function (item) {
                    let bulan    = parseInt(item.periode.split('.')[0]);
                    let nilai    = parseFloat(item.jml) || 0;
                    let terbayar = parseFloat(item.jmlterbayar) || 0;
                    let sisa     = nilai - terbayar;

                    // Provider dipecah jadi <div> per baris jika mengandung ;
                    let providers = item.provider ? item.provider.split(";") : [];
                    let providerHtml = providers.map(p => "<div>" + p.trim() + "</div>").join("");

                    // Bangun baris tabel
                    let baris = "<tr>";
                    baris += "<td class='ps-4'>" + item.jenistagihan + "</td>";
                    baris += "<td><div class='badge badge-light-info'>" + item.periode_indonesia + "</div></td>";
                    baris += "<td>" + providerHtml + "</td>";
                    baris += "<td class='text-end'>" + todesimal(nilai) + "</td>";
                    baris += "<td class='text-end'>" + todesimal(terbayar) + "</td>";
                    baris += "<td class='text-end pe-4'>" + todesimal(sisa) + "</td>";
                    baris += "</tr>";

                    // Masukkan ke tabel berdasarkan bulan
                    $("#resultdatapiutang_" + bulan).append(baris);

                    // Akumulasi total per bulan
                    totals[bulan].nilai    += nilai;
                    totals[bulan].terbayar += terbayar;
                    totals[bulan].sisa     += sisa;
                });

                // Tampilkan total per bulan di tfoot
                for (let i = 1; i <= 12; i++) {
                    let totalBaris = "<tr class='fw-bold bg-light'>";
                    totalBaris += "<td colspan='3' class='text-end rounded-start'>Total</td>";
                    totalBaris += "<td class='text-end'>" + todesimal(totals[i].nilai) + "</td>";
                    totalBaris += "<td class='text-end'>" + todesimal(totals[i].terbayar) + "</td>";
                    totalBaris += "<td class='text-end pe-4 rounded-end'>" + todesimal(totals[i].sisa) + "</td>";
                    totalBaris += "</tr>";

                    $("#resulttotaldatapiutang_" + i).html(totalBaris);
                }

                toastr["success"]("Data berhasil dimuat", "INFORMASI");
            } else {
                toastr["warning"](data.responDesc || "Data tidak ditemukan", "PERINGATAN");
            }
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            showAlert("Maaf", error, "error", "Silakan coba lagi", "btn btn-danger");
        }
    });

    return false;
}

