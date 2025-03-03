datarequest();
decline();
approve();


$("#modal_upload_invoice").on('shown.bs.modal', function(){
    var no_pemesanan = $(":hidden[name='no_pemesanan_invoice']").val();

    var myDropzone = new Dropzone("#file_invoice", {
        url               : url + "index.php/logistik/spu/uploadinvoice?no_pemesanan="+no_pemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept            : function(file, done) {
            done();
        }
    });
});

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_invoice_no       = $btn.attr("data_invoice_no");

    $(":hidden[name='no_pemesanan_invoice']").val(data_nopemesanan);

    if(data_invoice_no!='null'){
        $("input[name='modal_upload_invoice_no']").val(data_invoice_no);
    }else{
        $("input[name='modal_upload_invoice_no']").val('');
    }
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentrequest/datarequest",
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
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice' data_invoice_no='"+result[i].invoice_no+"' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
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
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		}
    });
    return false;
};

function decline(){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentrequest/decline",
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
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
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

function approve(){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentrequest/approve",
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
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
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
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                // if(result[i].status==="2"){
                                    // tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    // tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    // tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='3' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                // }

                                // if(result[i].status==="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='0' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re On Process</a>";
                                // }

                                // if(result[i].status==="3"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                // }

                                // if(result[i].status==="4"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                // }

                                // if(result[i].status==="7"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='9' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='8' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Cancelled</a>";
                                // }
                                
                                
                                // if(result[i].status==="17"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                                // }
                                if(result[i].status!="17"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice' data_invoice_no='"+result[i].invoice_no+"' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
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

$(document).on("submit", "#forminvoice", function (e) {
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
			$("#btn_upload_invoice").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_upload_invoice").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_upload_invoice").removeClass("disabled");
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