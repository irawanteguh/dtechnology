datarequest();
decline();
approve();

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");

    var myDropzone = new Dropzone("#file_invoice", {
        url               : url + "index.php/paymentpo/paymentfinance/uploadinvoice?no_pemesanan="+data_nopemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept            : function(file, done) {
            done();
            $('#modal-upload-invoice').modal('hide');
        }
    });

    var myDropzone = new Dropzone("#file_bukti_bayar", {
        url               : url + "index.php/logistik/request/uploadbuktibayar?no_pemesanan="+data_nopemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept            : function(file, done) {
            done();
            datarequest();
            decline();
            approve();
            $('#modal-upload-buktibayar').modal('hide');
        }
    });
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/datarequest",
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
                    var cito = "";
                    var vice = "";
                    var dir  = "";
                    var type = "";
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].cito==="Y"){
                        cito =" <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>";
                    }
                    if(result[i].status_vice==="N"){
                        vice =" <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>";
                    }
                    if(result[i].status_vice==="Y"){
                        vice =" <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    }
                    if(result[i].status_dir==="N"){
                        dir =" <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>";
                    }
                    if(result[i].status_dir==="Y"){
                        dir =" <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                    }

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+type+"</td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>" + (result[i].namasupplier ? result[i].namasupplier : "") + "</div><div class='badge badge-light-info fw-bolder'>" + (result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown") + "</div><div>"+(result[i].invoice_no ? "Invoice no : "+result[i].invoice_no : "")+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='15' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='14' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Decline</a>";
                                tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Re Upload invoice</a>";
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang_terima' onclick='getdetail($(this));'><i class='bi bi-eye text-primary'></i> View Accept Goods</a>";
                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                                }
                                if(result[i].invoice==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                }
                                // if(result[i].status==="17"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
                                // }
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

function decline(){
    $.ajax({
        url       : url+"index.php/paymentpo/paymentfinance/decline",
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

                    if(result[i].cito==="Y"){
                        cito =" <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>";
                    }
                    if(result[i].status_vice==="N"){
                        vice =" <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>";
                    }
                    if(result[i].status_vice==="Y"){
                        vice =" <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    }
                    if(result[i].status_dir==="N"){
                        dir =" <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>";
                    }
                    if(result[i].status_dir==="Y"){
                        dir =" <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                    }

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>" + (result[i].namasupplier ? result[i].namasupplier : "") + "</div><div class='badge badge-light-info fw-bolder'>" + (result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown") + "</div><div>"+(result[i].invoice_no ? "Invoice no : "+result[i].invoice_no : "")+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";

                    if(result[i].status==="6"){
                        if(result[i].status_vice===null && result[i].status_dir===null ){
                            tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                        }else{
                            tableresult +="<td>"+vice+dir+"</td>";
                        }
                    }else{
                        tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="4"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='6' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='5' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="5"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled Status</a>";
                                }

                                if(result[i].status==="13"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang_terima' onclick='getdetail($(this));'><i class='bi bi-eye text-primary'></i> View Accept Goods</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='15' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='14' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Cancelled</a>";
                                }

                                if(result[i].status==="15"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-buktibayar' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload File Transfer</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='16' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Payment Success</a>";
                                }

                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                                }
                                if(result[i].invoice==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                }
                                if(result[i].status==="17"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
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
        url       : url+"index.php/paymentpo/paymentfinance/approve",
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
                    var cito = "";
                    var vice = "";
                    var dir  = "";
                    
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].cito==="Y"){
                        cito =" <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>";
                    }
                    if(result[i].status_vice==="N"){
                        vice =" <div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div>";
                    }
                    if(result[i].status_vice==="Y"){
                        vice =" <div class='badge badge-light-info fw-bolder'>Approval Vice Director</div>";
                    }
                    if(result[i].status_dir==="N"){
                        dir =" <div class='badge badge-light-danger fw-bolder'>Cancelled Director</div>";
                    }
                    if(result[i].status_dir==="Y"){
                        dir =" <div class='badge badge-light-info fw-bolder'>Approval Director</div>";
                    }

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>" + (result[i].namasupplier ? result[i].namasupplier : "") + "</div><div class='badge badge-light-info fw-bolder'>" + (result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown") + "</div><div>"+(result[i].invoice_no ? "Invoice no : "+result[i].invoice_no : "")+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";

                    if(result[i].status==="6"){
                        if(result[i].status_vice===null && result[i].status_dir===null ){
                            tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                        }else{
                            tableresult +="<td>"+vice+dir+"</td>";
                        }
                    }else{
                        tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    }

                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="4"){
                                    // tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='6' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='5' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="5"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='4' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled Status</a>";
                                }

                                if(result[i].status==="13"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang_terima' onclick='getdetail($(this));'><i class='bi bi-eye text-primary'></i> View Accept Goods</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='15' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='14' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Cancelled</a>";
                                }

                                if(result[i].status==="15"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-buktibayar' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload File Transfer</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='16' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Payment Success</a>";
                                }

                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                                }
                                if(result[i].invoice==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                                }
                                if(result[i].status==="17"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
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