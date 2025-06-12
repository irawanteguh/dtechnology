rekapbukudagang();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    rekapbukudagang();
});

function rekapbukudagang() {
    var tahun = $("select[name='toolbar_kunjunganyears_periode']").val(); // pastikan ini ambil tahun
    $.ajax({
        url: url + "index.php/bukudagang/bukudagang/rekapbukudagang",
        data: { periode: tahun },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Mengambil data...", "Mohon tunggu");

            for (var i = 1; i <= 12; i++) {
                $("#resultdatabukudagang_" + i).html("");
                $("#resulttotalbukudagang_" + i).html("");
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;

                for (var bulan = 1; bulan <= 12; bulan++) {
                    var tableresult   = "";
                    var totalEstimasi = 0;
                    var totalBayar1   = 0;
                    var totalSelisih  = 0;

                    for (var i in result) {
                        var estimasi = parseFloat(result[i]['estimasi_' + bulan]) || 0;
                        var bayar1   = parseFloat(result[i]['penerimaan_' + bulan]) || 0;
                        var selisih  = estimasi - bayar1;

                        totalEstimasi += estimasi;
                        totalBayar1   += bayar1;
                        totalSelisih  += selisih;

                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4'>" + result[i].buku + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(estimasi) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(bayar1) + "</td>";
                        tableresult += "<td class='text-end pe-4'>" + todesimal(selisih) + "</td>";
                        tableresult += "</tr>";
                    }

                    console.log("#resultdatabukudagang_" + bulan);
                    $("#resultdatabukudagang_" + bulan).html(tableresult);

                    // Tampilkan total
                    var tfoot = "<tr class='fw-bolder align-middle bg-primary text-white'>";
                    tfoot += "<td class='ps-4 text-end rounded-start'>Total</td>";
                    tfoot += "<td class='text-end'>" + todesimal(totalEstimasi) + "</td>";
                    tfoot += "<td class='text-end'>" + todesimal(totalBayar1) + "</td>";
                    tfoot += "<td class='text-end pe-4 rounded-end'>" + todesimal(totalSelisih) + "</td>";
                    tfoot += "</tr>";

                    $("#resulttotalbukudagang_" + bulan).html(tfoot);
                }

                toastr.success("Data berhasil dimuat", "Sukses");
            } else {
                toastr.warning(data.responDesc || "Data tidak ditemukan", "Peringatan");
            }
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan: " + error, "Opps !");
        },
        complete: function () {
            toastr.clear();
        }
    });

    return false;
}


