rekappiutang();

function rekappiutang() {
    $.ajax({
        url: url + "index.php/sb/piutangsum/rekappiutang",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("[id^='resultdatapiutang_']").html("");
        },
        success: function (data) {
            if (data.responCode === "00") {
                let result = data.responResult;
                let lastJenis = "";
                let subtotalNilai = 0;
                let subtotalTerbayar = 0;
                let subtotalSisa = 0;
                let tablerow = {};
                
                for (let i = 0; i < result.length; i++) {
                    const item = result[i];
                    const sisa = parseFloat(item.nilai - item.jumlahterbayar);
                    const target = "#resultdatapiutang_" + item.org_id;

                    if (!tablerow[target]) tablerow[target] = "";

                    // Subtotal per jenis tagihan
                    if (item.jenistagihan !== lastJenis && lastJenis !== "") {
                        tablerow[target] += "<tr class='bg-light fw-bold text-primary'>";
                        tablerow[target] += "<td colspan='4' class='text-end pe-4'>Subtotal " + lastJenis + "</td>";
                        tablerow[target] += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                        tablerow[target] += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                        tablerow[target] += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                        tablerow[target] += "</tr>";

                        subtotalNilai = 0;
                        subtotalTerbayar = 0;
                        subtotalSisa = 0;
                    }

                    lastJenis = item.jenistagihan;

                    subtotalNilai += parseFloat(item.nilai);
                    subtotalTerbayar += parseFloat(item.jumlahterbayar);
                    subtotalSisa += sisa;

                    tablerow[target] += "<tr>";
                    tablerow[target] += "<td class='ps-4'>" + (item.no_tagihan || "") + "</td>";
                    tablerow[target] += "<td><div>" + item.jenistagihan + "</div>" + (item.periode_indonesia ? "<div class='badge badge-light-info'>" + item.periode_indonesia + "</div>" : "") + "</td>";
                    tablerow[target] += "<td><div>" + (item.provider || '')+"</div><div>"+item.note+"</div></td>";
                    tablerow[target] += "<td class='text-center'>" + item.tgltagihan + "</td>";
                    tablerow[target] += "<td class='text-end'>" + todesimal(item.nilai) + "</td>";
                    tablerow[target] += "<td class='text-end'>" + todesimal(item.jumlahterbayar) + "</td>";
                    tablerow[target] += "<td class='text-end pe-4'>" + todesimal(sisa) + "</td>";
                    tablerow[target] += "</tr>";
                }

                // Subtotal terakhir
                if (lastJenis !== "") {
                    for (const target in tablerow) {
                        tablerow[target] += "<tr class='bg-light fw-bold text-primary'>";
                        tablerow[target] += "<td colspan='4' class='text-end pe-4'>Subtotal " + lastJenis + "</td>";
                        tablerow[target] += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                        tablerow[target] += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                        tablerow[target] += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                        tablerow[target] += "</tr>";
                    }
                }

                // Masukkan hasil ke dalam DOM
                for (const target in tablerow) {
                    $(target).html(tablerow[target]);
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
