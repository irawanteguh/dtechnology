rekapbukudagang();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    rekapbukudagang();
});

function rekapbukudagang() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/sb/bukudagang/rekapbukudagang",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("[id^='resultdatabukudagang_']").html("");
            $("[id^='resulttotalbukudagang_']").html(""); // bersihkan tfoot
        },
        success: function (data) {
            if (data.responCode === "00") {
                let result = data.responResult;
                let total = {}; // simpan total per org_id

                for (let i in result) {
                    let item = result[i];
                    let orgId = item.org_id;
                    let estimasi = parseFloat(item.estimasi) || 0;
                    let pembayaran1 = parseFloat(item.pembayaransatu) || 0;
                    let pembayaran2 = parseFloat(item.pembayarandua) || 0;
                    let sisa = estimasi - pembayaran1 - pembayaran2;

                    // inisialisasi total jika belum ada
                    if (!total[orgId]) {
                        total[orgId] = {
                            estimasi: 0,
                            pembayaran1: 0,
                            pembayaran2: 0,
                            sisa: 0
                        };
                    }

                    total[orgId].estimasi += estimasi;
                    total[orgId].pembayaran1 += pembayaran1;
                    total[orgId].pembayaran2 += pembayaran2;
                    total[orgId].sisa += sisa;

                    let row = "<tr>";
                    row += "<td class='ps-4'>" + (item.pendapatan || "") + "</td>";
                    row += "<td class='text-end'>" + todesimal(estimasi) + "</td>";
                    row += "<td class='text-end'>" + todesimal(pembayaran1) + "</td>";
                    row += "<td class='text-end'>" + todesimal(pembayaran2) + "</td>";
                    row += "<td class='text-end pe-4'>" + todesimal(sisa) + "</td>";
                    row += "</tr>";

                    let target = "#resultdatabukudagang_" + orgId;
                    $(target).append(row);
                }

                // tampilkan total per org_id ke <tfoot>
                for (let orgId in total) {
                    let totalRow = "<tr class='fw-bold'>";
                    totalRow += "<td class='ps-4 rounded-start'>TOTAL</td>";
                    totalRow += "<td class='text-end'>" + todesimal(total[orgId].estimasi) + "</td>";
                    totalRow += "<td class='text-end'>" + todesimal(total[orgId].pembayaran1) + "</td>";
                    totalRow += "<td class='text-end'>" + todesimal(total[orgId].pembayaran2) + "</td>";
                    totalRow += "<td class='text-end rounded-end pe-4'>" + todesimal(total[orgId].sisa) + "</td>";
                    totalRow += "</tr>";

                    let targetFooter = "#resulttotalbukudagang_" + orgId;
                    $(targetFooter).html(totalRow);
                }
            }

            toastr[data.responHead](data.responDesc, "INFORMATION");
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



