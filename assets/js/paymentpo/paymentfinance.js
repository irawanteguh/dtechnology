let today     = new Date();
let startDate = today.toISOString().split('T')[0];
let endDate   = today.toISOString().split('T')[0];

refreshdata(startDate, endDate);

flatpickr('[name="dateperiode"]', {
    mode      : "range",
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function (selectedDates, dateStr, instance) {
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

    refreshdata(startDate, endDate);
});

$("#modal_upload_buktibayar").on('shown.bs.modal', function(){
    var no_pemesanan = $(":hidden[name='no_pemesanan_buktibayar']").val();

    var myDropzone = new Dropzone("#file_bukti_bayar", {
        url               : url + "index.php/logistik/request/uploadbuktibayar?no_pemesanan="+no_pemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept            : function(file, done) {
            done();
            $('#modal_upload_buktibayar').modal('hide');
        }
    });
});

$("#modal_print_po").on('shown.bs.modal', function(){
    var no_pemesanan = $(":hidden[name='no_pemesanan_po']").val();
    printpo(no_pemesanan);
});

$("#modal_note_finance").on('hidden.bs.modal', function(){
    $('#modal_note_finance_catatan').val("");
});

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_nopemesanan_unit = $btn.attr("data_nopemesanan_unit");
    var data_suppliers        = $btn.attr("data_suppliers");
    var data_inv_keu_note      = $btn.attr("data_inv_keu_note");
    var data_createddate      = $btn.attr("data_createddate");

    $(":hidden[name='no_pemesanan_buktibayar']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_po']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_note']").val(data_nopemesanan);

    $("#pono").html(data_nopemesanan_unit);
    $("#suppliers").html(data_suppliers);
    $("#orderdate").html(data_createddate);

    $("#modal_note_finance_catatan").val((data_inv_keu_note == null || data_inv_keu_note === 'null') ? '' : data_inv_keu_note);
};

function refreshdata(startDate, endDate){
    datarequest(startDate, endDate);
    decline(startDate, endDate);
    approve(startDate, endDate);
    payment(startDate, endDate);
}

function datarequest(startDate, endDate){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/datarequest",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatarequest").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_inv_keu_note='"+result[i].inv_keu_note+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_status='"+result[i].status+"'";

                    cito = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu  = result[i].type        === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";
                    type = result[i].type        === "1" ? " <div class='badge badge-light-info fw-bolder'>Invoice Submission</div>" : "";
                    vice = result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    dir  = result[i].status_dir  === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                

                    tableresult +="<tr>";
                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div><div>${result[i].nokwitansi ? "Cash Out : " + result[i].nokwitansi : ""}</div></td>`: "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_note_finance' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Finance Note</a>";
                                if(result[i].status==="13"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='15' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='14' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Decline</a>";
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

            $("#resultdatarequest").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

function approve(startDate, endDate){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/approve",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatarequestapprove").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_inv_keu_note='"+result[i].inv_keu_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    cito = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu  = result[i].type        === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";
                    type = result[i].type        === "1" ? " <div class='badge badge-light-info fw-bolder'>Invoice Submission</div>" : "";
                    vice = result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    dir  = result[i].status_dir  === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                

                    tableresult +="<tr>";
                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div><div>${result[i].nokwitansi ? "Cash Out : " + result[i].nokwitansi : ""}</div></td>`: "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].cashout!=null){
                        tableresult +="<td class='text-end'>"+todesimal(result[i].cashout)+"</td>";
                    }else{
                        tableresult +="<td class='text-end'>0</td>";
                    }
                    if(result[i].cashout!=null){
                        tableresult +="<td class='text-end'>"+todesimal(parseFloat(result[i].cashout)-parseFloat(result[i].total))+"</td>";
                    }else{
                        tableresult +="<td class='text-end'>0</td>";
                    }
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                  

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_note_finance' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Finance Note</a>";
                                if(result[i].status==="15"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='16' data-bs-toggle='modal' data-bs-target='#modal_payment' onclick='getdetail($(this));'><i class='bi bi-check2-circle text-success'></i> Payment Success</a>";
                                    // tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='16' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Payment Success</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='14' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline Invoice</a>";
                                }
                                if(result[i].status!="15"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_buktibayar' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload File Transfer</a>";
                                }
                                if(result[i].status==="17"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
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

            $("#resultdatarequestapprove").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

function payment(startDate, endDate){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/payment",
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
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_departmentid='"+result[i].department_id+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_inv_keu_note='"+result[i].inv_keu_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    cito = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu  = result[i].type        === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";
                    type = result[i].type        === "1" ? " <div class='badge badge-light-info fw-bolder'>Invoice Submission</div>" : "";
                    vice = result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    dir  = result[i].status_dir  === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                

                    tableresult +="<tr>";
                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div><div>${result[i].nokwitansi ? "Cash Out : " + result[i].nokwitansi : ""}</div></td>`: "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].cashout!=null){
                        tableresult +="<td class='text-end'>"+todesimal(result[i].cashout)+"</td>";
                        tableresult +="<td class='text-end'>"+todesimal(parseFloat(result[i].cashout)-parseFloat(result[i].total))+"</td>";
                    }else{
                        tableresult +="<td class='text-end'>0</td>";
                        tableresult +="<td class='text-end'>0</td>";
                    }
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                  
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_note_finance' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Finance Note</a>";
                                if((parseFloat(result[i].cashout)-parseFloat(result[i].total)) > 0){
                                    if(result[i].transaksiid===null){
                                        tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_refpettycase='"+result[i].pettycash_id+"' data_nopemesanan='"+result[i].no_pemesanan+"' data_note='Pengembalian Sisa Cash Out No : "+result[i].nokwitansi+" No Pemesanan Unit : "+result[i].no_pemesanan_unit+" "+result[i].judul_pemesanan+" "+result[i].note+"' data_balance='"+(parseFloat(result[i].cashout)-parseFloat(result[i].total)).toString()+"' onclick='submitpettycash($(this));'><i class='bi bi-check2-circle text-info'></i> Submit Petty Cash</a>";
                                    }
                                }
                                if(result[i].status==="16"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_balance='"+(parseFloat(result[i].cashout)-parseFloat(result[i].total)).toString()+"' data_note='Pembatalan Pengembalian Cash In No : "+result[i].lastnokwitansi+"' data_transaksiid='"+result[i].transaksiid+"' data_validasi='15' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Payment Success</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_balance='"+(parseFloat(result[i].cashout)-parseFloat(result[i].total)).toString()+"' data_note='Pembatalan Pengembalian Cash In No : "+result[i].lastnokwitansi+"' data_transaksiid='"+result[i].transaksiid+"' data_validasi='14' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline Invoice</a>";
                                }
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_buktibayar' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload File Transfer</a>";
                                if(result[i].status==="17"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
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
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

function decline(startDate, endDate){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/decline",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatarequestdecline").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_inv_keu_note='"+result[i].inv_keu_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    cito = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu  = result[i].type        === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";
                    type = result[i].type        === "1" ? " <div class='badge badge-light-info fw-bolder'>Invoice Submission</div>" : "";
                    vice = result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    dir  = result[i].status_dir  === "N" ? " <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>" : " <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                

                    tableresult +="<tr>";
                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div></td>` : "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td>"+(result[i].inv_keu_note ? result[i].inv_keu_note : "")+"</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_note_finance' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Finance Note</a>";
                                if(result[i].status==="14"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='13' data_validator='FINANCE' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
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

            $("#resultdatarequestdecline").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

function submitpettycash(btn){
    var data_balance      = btn.attr("data_balance");
    var data_departmentid = btn.attr("data_departmentid");
    var data_note         = btn.attr("data_note");
    var data_nopemesanan  = btn.attr("data_nopemesanan");
    var data_refpettycase = btn.attr("data_refpettycase");
	$.ajax({
        url        : url+"index.php/paymentpo/paymentfinance/submitpettycash",
        data       : {data_refpettycase:data_refpettycase,data_balance:data_balance,data_departmentid:data_departmentid,data_note:data_note,data_nopemesanan:data_nopemesanan},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				datarequest();
                decline();
                approve();
                payment();
			};

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
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
                refreshdata(startDate, endDate);
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