rekapbukudagang();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    rekapbukudagang();
});

function rekapbukudagang() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/bukudagang/bukudagang/rekapbukudagang",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultdatabukudagang").html("");
            $("#resulttotalbukudagang").html("");
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;
                var tableresult = "";

                var totalEstimasi = 0;
                var totalBayar1 = 0;
                var totalBayar2 = 0;
                var totalSelisih = 0;

                for (var i in result) {
                    var estimasi = parseFloat(result[i].estimasi) || 0;
                    var bayar1   = parseFloat(result[i].pembayaransatu) || 0;
                    var bayar2   = parseFloat(result[i].pembayarandua) || 0;
                    var selisih  = estimasi - (bayar1 + bayar2);

                    totalEstimasi += estimasi;
                    totalBayar1 += bayar1;
                    totalBayar2 += bayar2;
                    totalSelisih += selisih;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].buku + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(estimasi) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(bayar1) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(bayar2) + "</td>";
                    tableresult += "<td class='text-end fw-bold pe-4'>" + todesimal(selisih) + "</td>";
                    tableresult += "</tr>";
                }

                // Isi tbody
                $("#resultdatabukudagang").html(tableresult);

                // Isi tfoot
                var tfoot = "<tr class='fw-bolder align-middle bg-primary text-white'>";
                tfoot += "<td class='ps-4 text-end rounded-start'>Total</td>";
                tfoot += "<td class='text-end'>" + todesimal(totalEstimasi) + "</td>";
                tfoot += "<td class='text-end'>" + todesimal(totalBayar1) + "</td>";
                tfoot += "<td class='text-end'>" + todesimal(totalBayar2) + "</td>";
                tfoot += "<td class='text-end pe-4 rounded-end'>" + todesimal(totalSelisih) + "</td>";
                tfoot += "</tr>";

                $("#resulttotalbukudagang").html(tfoot);

                toastr[data.responHead](data.responDesc, "INFORMATION");
            }
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
        },
        complete: function () {
            toastr.clear();
        }
    });

    return false;
}

