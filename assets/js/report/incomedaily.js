billingcash();
billingbpjs();

function billingcash(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingcash",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingumum").html("");
            $("#footresultbillingumum").html("");
        },
        success: function (data) {
            var tableresult     = "";
            var tableresultfoot = "";
            var lastpoli        = null;
            var subtotal        = 0;
            var total           = 0;
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    // Jika ada perubahan `politujuan`, tambahkan subtotal
                    if (lastpoli !== null && lastpoli !== result[i].politujuan) {
                        tableresult += "<tr>";
                        tableresult += "<td colspan='8' class='text-end fw-bold'>Subtotal "+lastpoli+" :</td>";
                        tableresult += "<td class='pe-4 text-end fw-bold'>" + todesimal(subtotal) + "</td>";
                        tableresult += "</tr>";
                        tableresult += "<tr><td colspan='9'></td></tr>";

                        // Reset subtotal untuk grup baru
                        subtotal = 0;
                    }

                    // Jika `politujuan` berubah, tambahkan header baru
                    if (lastpoli !== result[i].politujuan) {
                        tableresult += "<tr>";
                        tableresult += "<td colspan='9' class='ps-4 table-warning'>" + result[i].politujuan + "</td>";
                        tableresult += "</tr>";
                    }

                    // Tambahkan data baris
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].tglbilling + "</td>";
                    tableresult += "<td>" + result[i].nobilling + "</td>";
                    tableresult += "<td>" + result[i].norm + "</td>";
                    tableresult += "<td>" + result[i].namapasien + "</td>";
                    tableresult += "<td>" + result[i].status_lanjut + "</td>";
                    tableresult += "<td>" + result[i].provider + "</td>";
                    tableresult += "<td>" + result[i].politujuan + "</td>";
                    tableresult += "<td>" + result[i].namadokter + "</td>";
                    tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].grandtotal) + "</td>";
                    tableresult += "</tr>";

                    // Perbarui subtotal dan total
                    subtotal += parseFloat(result[i].grandtotal);
                    total += parseFloat(result[i].grandtotal);

                    // Perbarui lastpoli
                    lastpoli = result[i].politujuan;
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='8' class='text-end fw-bold'>Grand Total</td>";
                tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + "</td>";
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultbillingumum").html(tableresult);
            $("#footresultbillingumum").html(tableresultfoot);
        
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function billingbpjs(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjs",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingbpjs").html("");
            $("#footresultbillingbpjs").html("");
        },
        success: function (data) {
            var tableresult     = "";
            var tableresultfoot = "";
            var lastpoli        = null;
            var subtotal        = 0;
            var total           = 0;
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    // Jika ada perubahan `politujuan`, tambahkan subtotal
                    if (lastpoli !== null && lastpoli !== result[i].politujuan) {
                        tableresult += "<tr>";
                        tableresult += "<td colspan='8' class='text-end fw-bold'>Subtotal "+lastpoli+" :</td>";
                        tableresult += "<td class='pe-4 text-end fw-bold'>" + todesimal(subtotal) + "</td>";
                        tableresult += "</tr>";
                        tableresult += "<tr><td colspan='9'></td></tr>";

                        // Reset subtotal untuk grup baru
                        subtotal = 0;
                    }

                    // Jika `politujuan` berubah, tambahkan header baru
                    if (lastpoli !== result[i].politujuan) {
                        tableresult += "<tr>";
                        tableresult += "<td colspan='9' class='ps-4 table-warning'>" + result[i].politujuan + "</td>";
                        tableresult += "</tr>";
                    }

                    // Tambahkan data baris
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].tglbilling + "</td>";
                    tableresult += "<td>" + result[i].nobilling + "</td>";
                    tableresult += "<td>" + result[i].norm + "</td>";
                    tableresult += "<td>" + result[i].namapasien + "</td>";
                    tableresult += "<td>" + result[i].status_lanjut + "</td>";
                    tableresult += "<td>" + result[i].provider + "</td>";
                    tableresult += "<td>" + result[i].politujuan + "</td>";
                    tableresult += "<td>" + result[i].namadokter + "</td>";
                    tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].grandtotal) + "</td>";
                    tableresult += "</tr>";

                    // Perbarui subtotal dan total
                    subtotal += parseFloat(result[i].grandtotal);
                    total += parseFloat(result[i].grandtotal);

                    // Perbarui lastpoli
                    lastpoli = result[i].politujuan;
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='8' class='text-end fw-bold'>Grand Total</td>";
                tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + "</td>";
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultbillingbpjs").html(tableresult);
            $("#footresultbillingbpjs").html(tableresultfoot);
        
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};