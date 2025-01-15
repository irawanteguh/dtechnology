

let startDate = null;
let endDate = null;

flatpickr('[name="dateperiode"]', {
    mode: "range", // Mengaktifkan mode range
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        // Mendapatkan tanggal sesuai dengan zona waktu lokal
        const formatDate = (date) => {
            if (!date) return null;
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`; // Format YYYY-MM-DD
        };

        startDate = selectedDates[0] ? formatDate(selectedDates[0]) : null;
        endDate   = selectedDates[1] ? formatDate(selectedDates[1]) : null;
    }
});

$(document).on("click", ".btn-apply", function (e) {
    e.preventDefault();

    if (!startDate || !endDate) {
        toastr["warning"]("Please select a valid date range", "Warning");
        return;
    }

    analisa(startDate, endDate);
    billingcash(startDate, endDate);
    billingbpjsrj(startDate, endDate);
    billingbpjsri(startDate, endDate);
});

$("#modal_detail_pasien").on('shown.bs.modal', function() {
    var kd_dokter =$(":hidden[name='kd_dokter_listpasien']").val();
    billingbpjsrjdetail(startDate,endDate,kd_dokter);
});

$("#modal_rincian_pasien").on('hide.bs.modal', function() {
    var kd_dokter =$(":hidden[name='kd_dokter']").val();
    billingbpjsrjdetail(startDate,endDate,kd_dokter);
    $("#modal_detail_pasien").modal('show');
});

$("#modal_rincian_pasien").on('shown.bs.modal', function() {
    var no_rawat = $(":hidden[name='no_rawat']").val();
    var type     = $(":hidden[name='type']").val();
    rincianbilling(no_rawat,type);
});


function getdetail(btn){
    var kd_dokter = btn.attr("kd_dokter");
    var no_rawat  = btn.attr("no_rawat");
    var type      = btn.attr("type");

    $(":hidden[name='kd_dokter']").val(kd_dokter);
    $(":hidden[name='kd_dokter_listpasien']").val(kd_dokter);
    $(":hidden[name='no_rawat']").val(no_rawat);
    $(":hidden[name='type']").val(type);
};

function billingcash(startDate, endDate){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingcash",
        data      : {startDate:startDate,endDate:endDate},
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

function billingbpjsrj(startDate, endDate){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjs",
        data      : {startDate:startDate,endDate:endDate},
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
                            tableresult += "<tr><td colspan='8'></td></tr>";

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

function billingbpjsrjdetail(startDate,endDate,kd_dokter){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjsrjdetail",
        data      : {startDate:startDate,endDate:endDate,kd_dokter:kd_dokter},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingbpjsrjdetail").html("");
            $("#footresultbillingbpjsrjdetail").html("");
        },
        success: function (data) {
            var tableresult     = "";
            var tableresultfoot = "";
            var lastpoli        = null;
            var subtotal        = 0;
            var total           = 0;
            var reg             = 0;
            var farmasi         = 0;
            var rad             = 0;
            var lab             = 0;
            var tindakan        = 0;
            var totalestimasi   = 0;
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    if(result[i].status_lanjut==='Ralan'){
                        // Jika ada perubahan `politujuan`, tambahkan subtotal
                        if (lastpoli !== null && lastpoli !== result[i].politujuan) {
                            tableresult += "<tr>";
                            tableresult += "<td colspan='13' class='text-end fw-bold'>Subtotal "+lastpoli+" :</td>";
                            tableresult += "<td class='pe-4 text-end fw-bold'>" + todesimal(subtotal) + "</td>";
                            tableresult += "</tr>";
                            tableresult += "<tr><td colspan='13'></td></tr>";

                            // Reset subtotal untuk grup baru
                            subtotal = 0;
                        }

                        // Jika `politujuan` berubah, tambahkan header baru
                        if (lastpoli !== result[i].politujuan) {
                            tableresult += "<tr>";
                            tableresult += "<td colspan='14' class='ps-4 table-warning'>" + result[i].politujuan + "</td>";
                            tableresult += "</tr>";
                        }

                        var getvariabel = "kd_dokter='"+result[i].kd_dokter+"'"+
                                          "no_rawat='"+result[i].no_rawat+"'";

                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4'>" + result[i].tglbilling + "</td>";
                        tableresult += "<td>" + result[i].nobilling + "</td>";
                        tableresult += "<td>" + result[i].norm + "</td>";
                        tableresult += "<td>" + result[i].namapasien + "</td>";
                        tableresult += "<td>" + result[i].provider + "</td>";
                        tableresult += "<td>" + result[i].jenisepisode + "</td>";
                        tableresult += "<td>" + result[i].politujuan + "</td>";
                        tableresult += "<td>" + result[i].namadokter + "</td>";
                        tableresult += "<td class='text-end'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_rincian_pasien' "+getvariabel+" type='Registrasi' onclick='getdetail($(this));'>" + todesimal(result[i].biayareg) + "</a></td>";
                        tableresult += "<td class='text-end'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_rincian_pasien' "+getvariabel+" type='Obat' onclick='getdetail($(this));'>" + todesimal(result[i].biayaobat) + "</a></td>";
                        tableresult += "<td class='text-end'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_rincian_pasien' "+getvariabel+" type='Radiologi' onclick='getdetail($(this));'>" + todesimal(result[i].biayarad) + "</a></td>";
                        tableresult += "<td class='text-end'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_rincian_pasien' "+getvariabel+" type='Laborat' onclick='getdetail($(this));'>" + todesimal(result[i].biayalab) + "</a></td>";
                        tableresult += "<td class='text-end'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_rincian_pasien' "+getvariabel+" type='Ralan Dokter' onclick='getdetail($(this));'>" + todesimal(result[i].RJtindakandokter) + "</a></td>";

                        if(parseFloat(result[i].estimasiklaim) > parseFloat(result[i].grandtotal)){
                            tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].grandtotal) + " <i class='bi bi-check-circle-fill text-success' title='Beban rumah sakit lebih rendah di bandingkan estimasi klaim : "+todesimal(result[i].estimasiklaim)+"'></i></td>";
                        }else{
                            tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].grandtotal) + " <i class='bi bi-exclamation-circle-fill text-danger' title='Beban rumah sakit lebih tinggi di bandingkan estimasi klaim : "+todesimal(result[i].estimasiklaim)+"'></i></td>";
                        }
                        
                        tableresult += "</tr>";

                        subtotal      += parseFloat(result[i].grandtotal);
                        total         += parseFloat(result[i].grandtotal);
                        totalestimasi += parseFloat(result[i].estimasiklaim);
                        reg           += parseFloat(result[i].biayareg);
                        farmasi       += parseFloat(result[i].biayaobat);
                        rad           += parseFloat(result[i].biayarad);
                        lab           += parseFloat(result[i].biayalab);
                        tindakan      += parseFloat(result[i].RJtindakandokter);

                        lastpoli = result[i].politujuan;
                    }
                }

                tableresultfoot = "<tr>";
                tableresultfoot += "<td colspan='8' class='text-end fw-bold'>Grand Total OutPatient / Rawat Jalan :</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(reg) + "</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(farmasi) + "</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(rad) + "</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(lab) + "</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(tindakan) + "</td>";
                if(totalestimasi > total){
                    tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + " <i class='bi bi-check-circle-fill text-success' title='Beban rumah sakit lebih rendah di bandingkan estimasi klaim : "+todesimal(totalestimasi)+"'></td>";
                }else{
                    tableresultfoot += "<td class='pe-4 text-end fw-bold'>" + todesimal(total) + " <i class='bi bi-exclamation-circle-fill text-danger' title='Beban rumah sakit lebih tinggi di bandingkan estimasi klaim : "+todesimal(totalestimasi)+"'></td>";
                }
                
                tableresultfoot += "</tr>";

            }
        
            // Perbarui tabel dan footer di halaman
            $("#resultbillingbpjsrjdetail").html(tableresult);
            $("#footresultbillingbpjsrjdetail").html(tableresultfoot);
        
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

function rincianbilling(norawat,type){
    $.ajax({
        url        : url+"index.php/report/incomedaily/rincianbilling",
        data      : {norawat:norawat,type:type},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrincianbilling").html("");
        },
        success: function (data) {
            var tableresult     = "";
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].nm_perawatan + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].jumlah) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].biaya) + "</td>";
                    tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].totalbiaya) + "</td>";
                    tableresult += "</tr>";
                }
            }
        
            $("#resultrincianbilling").html(tableresult);
        
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

function billingbpjsri(startDate,endDate,){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billingbpjs",
        data      : {startDate:startDate,endDate:endDate},
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

function analisa(startDate, endDate){
    $.ajax({
        url        : url+"index.php/report/incomedaily/analisa",
        data      : {startDate:startDate,endDate:endDate},
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
                    
                    var getvariabel = "kd_dokter='"+result[i].kd_dokter+"'";

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].politujuan + "</td>";
                    tableresult += "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modal_detail_pasien' "+getvariabel+" onclick='getdetail($(this));'>" + result[i].namadokter + "</a></td>";
                    tableresult += "<td class='text-center'>" + todesimal(result[i].jmlpasien) + "</td>";
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
                tableresultfoot += "<td colspan='3' class='text-end fw-bold'>Grand Total</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(totalbeban) + "</td>";
                tableresultfoot += "<td class='text-end fw-bold'>" + todesimal(totalestimasi) + "</td>";
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