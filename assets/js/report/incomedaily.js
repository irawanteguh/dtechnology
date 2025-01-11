billingcash();
billingbpjsrj();
billingbpjsri();
analisa();

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
                    tableresult += "<td>" + result[i].jenisepisode + "</td>";
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

function billingbpjsrj(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjs",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingbpjsrj").html("");
            $("#footresultbillingbpjsrj").html("");
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
                    if(result[i].status_lanjut==='Ralan'){
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
                        tableresult += "<td>" + result[i].provider + "</td>";
                        tableresult += "<td>" + result[i].jenisepisode + "</td>";
                        tableresult += "<td>" + result[i].politujuan + "</td>";
                        tableresult += "<td>" + result[i].namadokter + "</td>";
                        if(parseFloat(result[i].estimasiklaim) > parseFloat(result[i].grandtotal)){
                            tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].estimasiklaim) + " <i class='bi bi-check-circle-fill text-success' title='Harga klaim lebih besar dibandingkan beban biaya : "+todesimal(result[i].grandtotal)+"'></i></td>";
                        }else{
                            tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].estimasiklaim) + " <i class='bi bi-exclamation-circle-fill text-danger' title='Harga klaim lebih rendah dibandingkan beban biaya : "+todesimal(result[i].grandtotal)+"'></i></td>";
                        }
                        
                        tableresult += "</tr>";

                        // Perbarui subtotal dan total
                        subtotal += parseFloat(result[i].estimasiklaim);
                        total += parseFloat(result[i].estimasiklaim);

                        // Perbarui lastpoli
                        lastpoli = result[i].politujuan;
                    }
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='8' class='text-end fw-bold'>Grand Total OutPatient / Rawat Jalan :</td>";
                tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + "</td>";
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultbillingbpjsrj").html(tableresult);
            $("#footresultbillingbpjsrj").html(tableresultfoot);
        
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function billingbpjsri(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjs",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingbpjsri").html("");
            $("#footresultbillingbpjsri").html("");
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
                    if(result[i].status_lanjut==='Ranap'){
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
                        // if (lastpoli !== result[i].politujuan) {
                        //     tableresult += "<tr>";
                        //     tableresult += "<td colspan='9' class='ps-4 table-warning'>" + result[i].politujuan + "</td>";
                        //     tableresult += "</tr>";
                        // }

                        // Tambahkan data baris
                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4'>" + result[i].tglperawatan + "</td>";
                        tableresult += "<td>" + result[i].nobilling + "</td>";
                        tableresult += "<td>" + result[i].norm + "</td>";
                        tableresult += "<td>" + result[i].namapasien + "</td>";
                        tableresult += "<td>" + result[i].provider + "</td>";
                        tableresult += "<td>" + result[i].jenisepisode + "</td>";
                        tableresult += "<td>" + result[i].ruangperawatan + "</td>";
                        tableresult += "<td>" + result[i].namadokter + "</td>";
                        tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].estimasiklaim) + "</td>";
                        tableresult += "</tr>";

                        // Perbarui subtotal dan total
                        subtotal += parseFloat(result[i].estimasiklaim);
                        total += parseFloat(result[i].estimasiklaim);

                        // Perbarui lastpoli
                        lastpoli = result[i].politujuan;
                    }
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='8' class='text-end fw-bold'>Grand Total InPatient / Rawat Jalan :</td>";
                tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + "</td>";
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultbillingbpjsri").html(tableresult);
            $("#footresultbillingbpjsri").html(tableresultfoot);
        
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function analisa(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/analisa",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultanalisa").html("");
            $("#footresultanalisa").html("");
        },
        success: function (data) {
            var tableresult     = "";
            var tableresultfoot = "";
            var totalbeban      = 0;
            var totalestimasi   = 0;
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].politujuan + "</td>";
                    tableresult += "<td>" + result[i].namadokter + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].totalbeban) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].totalestimasi) + "</td>";
                    if(parseFloat(result[i].totalestimasi) > parseFloat(result[i].totalbeban)){
                        tableresult += "<td class='pe-4 text-end table-success fs-8'>Total estimasi klaim lebih besar dibandingkan beban rumah sakit</td>";
                    }else{
                        tableresult += "<td class='pe-4 text-end table-danger fs-8'>Total estimasi klaim lebih rendah dibandingkan beban rumah sakit</td>";
                    }
                    
                    tableresult += "</tr>";

                    // Perbarui subtotal dan total
                    // subtotal += parseFloat(result[i].grandtotal);
                    totalbeban    += parseFloat(result[i].totalbeban);
                    totalestimasi += parseFloat(result[i].totalestimasi);

                    // Perbarui lastpoli
                    // lastpoli = result[i].politujuan;
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='2' class='text-end fw-bold'>Grand Total</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(totalbeban) + "</td>";
                tableresultfoot += "<td class='ext-end fw-bold'>" + todesimal(totalestimasi) + "</td>";
                if(parseFloat(totalestimasi) > parseFloat(totalbeban)){
                    tableresultfoot += "<td class='pe-4 text-end fw-bold text-success'>Profit Rumah Sakit : "+todesimal(parseFloat(totalestimasi)-parseFloat(totalbeban))+"</td>";
                }else{
                    tableresultfoot += "<td class='pe-4 text-end fw-bold text-danger'>Kerugian Rumah Sakit : "+todesimal(parseFloat(totalestimasi)-parseFloat(totalbeban))+"</td>";
                }
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultanalisa").html(tableresult);
            $("#footresultanalisa").html(tableresultfoot);
        
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