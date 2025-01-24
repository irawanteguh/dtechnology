datarequest();
decline();
approve();

$("#modal_master_detail_spu").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    detailbarangspu(nopemesanan);
});

function getdetail(btn){
    var $btn             = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

    $(":hidden[name='nopemesanan_item']").val(data_nopemesanan);
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/appmanager/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultdatarequest").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
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
                    vice = result[i].status_vice === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Vice Director</div>" : (result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Vice Director</div>" : "");
                    dir  = result[i].status_dir  === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Director</div>" : (result[i].status_dir === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Director</div>" : "");
                
                    tableresult +="<tr>";

                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div></td>` : "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult += (result[i].status_vice === null || result[i].status_dir === null || result[i].status_vice === '' || result[i].status_dir === '') ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                // if(result[i].status==="2"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='3' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
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

                                
                                // if(result[i].status!="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                // }
                                // if(result[i].invoice==="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                // }
                                // if(result[i].status==="17"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                                // }

                                // if(result[i].status==="7"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='9' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='8' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Decline</a>";
                                // }

                                // tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' data_attachment_note='"+result[i].attachment_note+"' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                
                                if(result[i].status==="2"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='4' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='3' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
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

function approve(){
    $.ajax({
        url       : url+"index.php/logistik/appmanager/approve",
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
                    vice = result[i].status_vice === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Vice Director</div>" : (result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Vice Director</div>" : "");
                    dir  = result[i].status_dir  === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Director</div>" : (result[i].status_dir === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Director</div>" : "");
                

                    tableresult +="<tr>";
                    
                    if(result[i].type === "20"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_spu+"</div>"+spu+"</td>";
                    }else{
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }
                    
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>" + (result[i].namasupplier ? result[i].namasupplier : "") + "</div><div class='badge badge-light-info fw-bolder'>" + (result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown") + "</div><div>"+(result[i].invoice_no ? "Invoice no : "+result[i].invoice_no : "")+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult += (result[i].status_vice === null || result[i].status_dir === null || result[i].status_vice === '' || result[i].status_dir === '') ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                // if(result[i].status==="2"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='3' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                // }

                                // if(result[i].status==="4"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                // }

                                // if(result[i].status==="7"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='9' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='8' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Cancelled</a>";
                                // }
                                // if(result[i].status!="1" && result[i].status!="3"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                // }
                                // if(result[i].invoice==="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                // }
                                // if(result[i].status==="17"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                                // }
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
        url       : url+"index.php/logistik/appmanager/decline",
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
                    var cito = "";
                    var vice = "";
                    var dir  = "";
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    cito = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu  = result[i].type        === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";
                    type = result[i].type        === "1" ? " <div class='badge badge-light-info fw-bolder'>Invoice Submission</div>" : "";
                    vice = result[i].status_vice === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Vice Director</div>" : (result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Vice Director</div>" : "");
                    dir  = result[i].status_dir  === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Director</div>" : (result[i].status_dir === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Director</div>" : "");
                
                    tableresult +="<tr>";

                    if(result[i].type === "0" || result[i].type === "1"){
                        tableresult +="<td class='ps-4'><div>"+(result[i].unitdituju ? result[i].unitdituju : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+type+"</td>";
                    }
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div></td>` : "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult += (result[i].status_vice === null || result[i].status_dir === null || result[i].status_vice === '' || result[i].status_dir === '') ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                // if(result[i].status==="2"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='3' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                // }
                                // if(result[i].status==="3"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                // }
                                // if(result[i].status==="7"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='9' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='8' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Cancelled</a>";
                                // }
                                // if(result[i].status!="1" && result[i].status!="3"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                // }
                                // if(result[i].invoice==="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                // }
                                // if(result[i].status==="17"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                                // }
                                // if(result[i].status==="8"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='7' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
                                // }
                                if(result[i].status==="3"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='2' data_validator='MANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
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
		complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		}
    });
    return false;
};

function detailbarangspu(nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/requestnew/detailbarangspu",
        data      : {nopemesanan:nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdetailspu").html("");
            $("#resultdetailfootspu").html("");
        },
        success: function (data) {
            let result      = "";
            let tableresult = "";
            let tfoot       = "";
            let totalvat    = 0;
            let grandtotal  = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {

                    const stock      = parseFloat(result[i].stock) || 0;
                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) || parseFloat(result[i].qty_minta) || parseFloat(result[i].qty_req) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";

                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].item_id}' name='stock_${result[i].item_id}' value='${todesimal(stock)}' disabled></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].item_id}' name='qty_${result[i].item_id}' value='${todesimal(qty)}' data_validator='MANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].item_id}' name='harga_${result[i].item_id}' value='${todesimal(result[i].harga)}' data_validator='MANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].item_id}' name='vat_${result[i].item_id}' value='${todesimal(vatPercent)}' data_validator='MANAGER' onchange='updateVatAndTotal(this)'></td>`;

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;
                    if(result[i].note!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' value='${result[i].note}' data_validator='MANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' data_validator='MANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    }
                    tableresult += "</tr>";

                    totalvat   += vatAmount;
                    grandtotal += subtotal;
                }

                tfoot = `<tr><th class='ps-4 fw-bolder text-muted bg-light align-middle' colspan='5'>Grand Total</th><th class='text-end' id='total_vat'>${todesimal(totalvat)}</th><th class='text-end pe-4' id='grand_total'>${todesimal(grandtotal)}</th><th></th></tr>`;

            }

            $("#resultdetailspu").html(tableresult);
            $("#resultdetailfootspu").html(tfoot);

            toastr.clear();
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
    return false;
};