Dropzone.autoDiscover = false;
let myDropzone;

let today     = new Date();
let startDate = today.toISOString().split('T')[0];
let endDate   = today.toISOString().split('T')[0];

dataonprocess();
dataapprove();
datapayment(startDate, endDate);
datadecline();

$("#modal_upload_buktibayar").on('show.bs.modal', function (event) {
    var button             = $(event.relatedTarget);
    var datanopemesanan    = button.attr("datanopemesanan");

    if (myDropzone) {
        myDropzone.destroy();
    }

    myDropzone = new Dropzone("#file_bukti_bayar", {
        url               : url + "index.php/paymentponew/paymentfinance/uploadbuktibayar?datanopemesanan=" + datanopemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept: function (file, done) {
            done();
            datapayment(startDate, endDate);
            $('#modal_upload_buktibayar').modal('hide');
        }
    });
});

flatpickr('[name="dateperiode"]', {
    mode      : "range",
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange: function (selectedDates, dateStr, instance) {
        const formatDate = (date) => {
            if (!date) return null;
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); 
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`; // Format YYYY-MM-DD
        };

        startDate = selectedDates[0] ? formatDate(selectedDates[0]) : null;
        endDate = selectedDates[1] ? formatDate(selectedDates[1]) : null;
    }
});

$(document).on("click", ".btn-apply", function (e) {
    e.preventDefault();

    if (!startDate || !endDate) {
        toastr["warning"]("Please select a valid date range", "Warning");
        return;
    }

    datapayment(startDate, endDate);
});

$("#modal_note_finance").on('show.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    var datanopemesanan  = button.attr("datanopemesanan");

    $("input[name='modal_note_finance_nopemesanan']").val(datanopemesanan);
    $("textarea[name='modal_note_finance_catatan']").val("");
});

$("#modal_finance_payment").on('show.bs.modal', function(event){
    var button               = $(event.relatedTarget);
    var datanopemesanan      = button.attr("datanopemesanan");
    var datanopemesananunit  = button.attr("datanopemesananunit");
    var datajudulpemesanan   = button.attr("datajudulpemesanan");
    var datacatatanpemesanan = button.attr("datacatatanpemesanan");
    var datacatatankeuangan  = button.attr("datacatatankeuangan");
    var datainvoiceno        = button.attr("datainvoiceno");
    var datanominal          = button.attr("datanominal");
    var datadepartmentid     = button.attr("datadepartmentid");

    $("input[name='modal_finance_payment_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_finance_payment_departmentid']").val(datadepartmentid);
    $("input[name='modal_finance_payment_note']").val("Pembayaran invoice no : "+datainvoiceno+", no pemesanan : "+datanopemesananunit+" "+datajudulpemesanan+" "+datacatatanpemesanan+" "+datacatatankeuangan+" Sebesar : Rp. "+todesimal(datanominal));
    $("input[name='modal_finance_payment_nominal']").val("Rp. "+todesimal(datanominal));
});

function viewdoc(btn) {
    var filename     = $(btn).attr("data-dirfile");
    var note         = $(btn).attr("data_attachment_note");
    var filename     = filename.replace('/www/wwwroot/', 'http://');
    var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

    $("textarea[name='modal_view_pdf_note']").val(note === 'null' ? '' : note);

    if(responsefile === 200){
        var viewfile = "<embed src='"+filename+"' width='100%' height='100%' type='application/pdf' id='view'>";
        $("#viewdocnote").html(viewfile);
        $('#openInNewTabButton').data('filename', filename);
    } else {
        var viewfile = `
            <div class='alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
                <span class='svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                        <path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
                        <path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
                    </svg>
                </span>
                <div class='d-flex flex-column pe-0 pe-sm-10'>
                    <h5 class='mb-1'>For Your Information</h5>
                    <span>File Tidak Di Temukan, Silakan Periksa Kembali</span>
                </div>
            </div>
        `;
        $("#viewdocnote").html(viewfile);
        $('#openInNewTabButton').data('filename', '');
    }
};

function dataonprocess(){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentfinance/dataonprocess",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataonprocess").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " dataattachmentnote='"+result[i].attachment_note+"'"+
                                        " datainvoiceno='"+result[i].invoice_no+"'"+
                                        " datadepartmentid='"+result[i].department_id+"'";

                    tableresult +="<tr>";
                    tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
                    tableresult +="<td>"+result[i].unitdituju+"</td>";
                    tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].method==="4"){
                        tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    }else{
                        tableresult +="<td><div>"+result[i].namadir+"<div>"+result[i].tgldir+"</div></td>";
                    }
                    
                    tableresult += "<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_note_finance'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='14' datavalidator='FINANCE' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Decline</a>";
                            if(result[i].invoice==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                            }
                            if(result[i].attachment==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdataonprocess").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function dataapprove(){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentfinance/dataapprove",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataapprove").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " datanopemesananunit='"+result[i].no_pemesanan_unit+"'"+
                                        " dataattachmentnote='"+result[i].attachment_note+"'"+
                                        " datainvoiceno='"+result[i].invoice_no+"'"+
                                        " datadepartmentid='"+result[i].department_id+"'"+
                                        " datajudulpemesanan='"+result[i].judul_pemesanan+"'"+
                                        " datacatatanpemesanan='"+result[i].note+"'"+
                                        " datacatatankeuangan='"+result[i].inv_keu_note+"'"+
                                        " datanominal='"+result[i].total+"'";

                    tableresult +="<tr>";
                    tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
                    tableresult +="<td>"+result[i].unitdituju+"</td>";
                    tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult +="<td><div>"+result[i].disetujuikeuoleh+"<div>"+result[i].tglkeuangan+"</div></td>";
                    tableresult += "<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_finance_payment'><i class='bi bi-check2-circle text-success'></i> Payment</a>";
                            if(result[i].invoice==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                            }
                            if(result[i].attachment==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdataapprove").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function datapayment(startDate, endDate){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentfinance/datapayment",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapayment").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " dataattachmentnote='"+result[i].attachment_note+"'"+
                                        " datainvoiceno='"+result[i].invoice_no+"'"+
                                        " datadepartmentid='"+result[i].department_id+"'";

                    tableresult +="<tr>";
                    tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
                    tableresult +="<td>"+result[i].unitdituju+"</td>";
                    tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult += "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div>" + (result[i].rekening ? "<br><div class='badge badge-secondary'>" + result[i].rekening + "</div>" : "") + "</td>";
                    tableresult +="<td><div>" + (result[i].dibayarkanoleh || result[i].disetujuikeuoleh)  + "<div>" + (result[i].tgldibayar || result[i].tglkeuangan) + "</div></td>";
                    tableresult +="<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="16"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_buktibayar'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload File Transfer</a>";
                            }
                            if(result[i].status==="17"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].inv_keu_note+"' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                            }
                            if(result[i].invoice==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                            }
                            if(result[i].attachment==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatapayment").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function datadecline(){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentfinance/datadecline",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatadecline").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " dataattachmentnote='"+result[i].attachment_note+"'"+
                                        " datainvoiceno='"+result[i].invoice_no+"'"+
                                        " datadepartmentid='"+result[i].department_id+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
                    tableresult +="<td>"+result[i].unitdituju+"</td>";
                    tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td class='text-end pe-4'><div>"+result[i].disetujuikeuoleh+"<div>"+result[i].tglkeuangan+"</div></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatadecline").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function validasi(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var datanopemesanan = btn.attr("datanopemesanan");
            var datastatus      = btn.attr("datastatus");
            var datavalidator   = btn.attr("datavalidator");

            $.ajax({
                url       : url+"index.php/paymentponew/paymentmanager/updateheader",
                data      : {datanopemesanan:datanopemesanan,datastatus:datastatus,datavalidator:datavalidator},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    toastr.clear();
                    toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    toastr.clear();
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    dataonprocess();
                    dataapprove();
                    datapayment();
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
    });
    return false;
};

$(document).on("submit", "#formcatatankeuangan", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this);
    var url  = $(this).attr("action");
	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_note_finance_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_note_finance").modal("hide");
                dataonprocess();
                dataapprove();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_note_finance_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
    return false;
});

$(document).on("submit", "#formpayment", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this);
    var url  = $(this).attr("action");
	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_finance_payment_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_finance_payment").modal("hide");
                dataonprocess();
                dataapprove();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_finance_payment_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
    return false;
});