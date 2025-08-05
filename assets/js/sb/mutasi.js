datamutasi();

$(document).on("change", "select[name='mutasi_rekeningid']", function (e) {
    e.preventDefault();
    datamutasi();
});

function datamutasi() {
    var rekeningid = $("select[name='mutasi_rekeningid']").val();
    $.ajax({
        url: url + "index.php/sb/mutasi/datamutasi",
        method: "POST",
        dataType: "JSON",
        cache: false,
        data: { rekeningid: rekeningid },
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("[id^='resultdatamutasi_']").html("");
        },
        success: function (data) {
            if (data.responCode === "00") {
                let result = data.responResult;

                for (let i in result) {
                    let row = "<tr>";
                    row += "<td class='ps-4'><div>" + (result[i].rekeningname || "") + "</div><div>" + (result[i].rekeningid || "") + "</div></td>";
                    row += "<td><div>" + (result[i].no_kwitansi || "") + "</div><div>" + (result[i].note || "") + "</div><div class='badge badge-light-info'>" + result[i].unit + "</div></td>";
                    row += "<td><div><span class='badge fs-8 fw-bold " + (result[i].status === "6" ? (result[i].cash_in != 0 ? "badge-light-primary'>CR" : "badge-light-danger'>DB") : "badge-light-secondary'>-") + "</span></div></td>";
                    row += "<td class='text-end'>" + todesimal(result[i].cash_in) + "</td>";
                    row += "<td class='text-end'>" + todesimal(result[i].cash_out) + "</td>";
                    row += "<td class='text-end'>" + todesimal(result[i].balance) + "</td>";
                    row += "<td class='text-end pe-4'><div>" + result[i].dibuatoleh + "<div>" + result[i].tglbuat + "</div></td>";
                    row += "</tr>";

                    let target = "#resultdatamutasi_" + result[i].org_id;
                    $(target).append(row);
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
