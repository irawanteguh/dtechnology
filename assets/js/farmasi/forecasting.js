
function forecasting() {
    const periode = $("select[name='toolbar_periode']").val();
    $.ajax({
        url     : url + "index.php/farmasi/forecasting/forecasting",
        data    : {periode:periode},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataforecasting").html("");
        },
        success : function (data) {
            if(data.responCode==="00"){
                var tableresult = "";
                var result      = data.responResult;

                for(var i in result){
                    var rowClass = (parseFloat(result[i].ratarata) === 0) ? "table-warning" : "";
                    tableresult +="<tr class='" + rowClass + "'>";
                    tableresult +="<td class='ps-4'>"+result[i].nama_brng+"</td>";
                    tableresult +="<td>"+result[i].kategori+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].bulan_1)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].bulan_2)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].bulan_3)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].bulan_4)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].ratarata)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].stok)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].pemesanan)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td>"+result[i].industri+"</td>";
                    tableresult +="</tr>";
                }
                
            }

            $("#resultdataforecasting").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
        }
    });
}

const bulanIndo = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];

// Fungsi untuk update <th> bulan sesuai pilihan dropdown
function updateHeaderBulan(periodeStr) {
    // Split periode: "05.2025;06.2025;07.2025;08.2025" → array
    const periodeArr = periodeStr.split(";");
    
    const labels = periodeArr.map(per => {
        const [bln, thn] = per.split(".");
        return bulanIndo[parseInt(bln, 10) - 1];
    });

    // Update header kolom tabel
    const headerEls = document.querySelectorAll("th.bulan-dinamis");
    headerEls.forEach((el, i) => {
        el.textContent = labels[i] || "-";
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const selectPeriode = document.getElementById("toolbar_periode");

    // Saat pertama kali load
    if (selectPeriode.value) {
        updateHeaderBulan(selectPeriode.value);
        forecasting();
    }

    // Saat combo box berubah
    $('#toolbar_periode').on('change.select2', function (e) {
        updateHeaderBulan(this.value);
        forecasting();
    });
});
