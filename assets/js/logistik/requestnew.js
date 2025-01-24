const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

datarequest();
approve();
decline();

$("#modal_upload_lampiran").on('shown.bs.modal', function(){
    var no_pemesanan = $(":hidden[name='no_pemesanan_upload']").val();

    var myDropzone = new Dropzone("#file_doc", {
        url               : url + "index.php/logistik/spu/uploaddocument?no_pemesanan="+no_pemesanan,
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

$("#modal_master_detail_spu").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    detailbarangspu(nopemesanan);
});

$("#modal_master_item").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    masterbarang(nopemesanan);
});

function filterTable() {
    const itemnamefilter = filteritemname.value.map(tag => tag.value);
    const categoryfilter = filtercategory.value.map(tag => tag.value);
    const unitfilter     = filterunit.value.map(tag => tag.value);

    const table = document.getElementById("tablemasterbarang");
    const rows  = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (const row of rows) {
        const itemname = row.getElementsByTagName("td")[0].textContent;
        const category = row.getElementsByTagName("td")[1].textContent;
        const unit     = row.getElementsByTagName("td")[2].textContent;

        const showRow = 
            (itemnamefilter.length === 0 || itemnamefilter.includes(itemname)) &&
            (categoryfilter.length === 0 || categoryfilter.includes(category)) &&
            (unitfilter.length === 0 || unitfilter.includes(unit));

        row.style.display = showRow ? "" : "none";
    }
};

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_fromdepartmentid = $btn.attr("data_fromdepartmentid");
    var data_invoice_no       = $btn.attr("data_invoice_no");
    var data_attachment_note  = $btn.attr("data_attachment_note");

    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_invoice']").val(data_nopemesanan);
    $(":hidden[name='nopemesanan_item']").val(data_nopemesanan);

    if(data_attachment_note!='null'){
        $("textarea[name='modal_upload_lampiran_note']").val(data_attachment_note);
    }else{
        $("textarea[name='modal_upload_lampiran_note']").val('');
    }

    if(data_invoice_no!='null'){
        $("input[name='modal_upload_invoice_no']").val(data_invoice_no);
    }else{
        $("input[name='modal_upload_invoice_no']").val('');
    }
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/requestnew/datarequest",
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
                    var getvariabel = " data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      " data_fromdepartmentid='"+result[i].from_department_id+"'";

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
                    tableresult +="<td></td>";
                    tableresult += result[i].supplier_id != null ? `<td><div>${result[i].namasupplier || ""}</div><div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown"}</div><div>${result[i].invoice_no ? "Invoice no : " + result[i].invoice_no : ""}</div></td>` : "<td></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].status != "6"){
                        tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                    }else{
                        if(result[i].status === "6" && result[i].status_vice === null && result[i].status_dir === null){
                            tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                        }else{
                            if(result[i].status === "6" && result[i].status_vice === '' && result[i].status_dir === ''){
                                tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                            }
                        }
                    }
                    //tableresult += ((result[i].status != "6") || (result[i].status === "6" && result[i].status_vice === null && result[i].status_dir === null)) ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            // if(result[i].status==="0"){
                            //     if(result[i].type === "0" || result[i].type === "1"){
                            //         tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                            //     }
                            // }
                            
                            // tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            
                            // if(result[i].jmlitem!="0"){
                            //     if(result[i].status==="0"){
                            //         if(result[i].type==="0"){
                            //             tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            //             tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                            //         }else{
                            //             if(result[i].invoice==="1"){
                            //                 tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='9' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            //             }
                            //             tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            //         }
                            //     }else{
                            //         if(result[i].status==="2"){
                            //             tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            //         }else{
                            //             if(result[i].status==="92"){
                            //                 tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='94' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            //                 tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='95' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            //             }
                            //         }
                            //     }
                            // }else{
                            //     tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                            // }
                            // if(result[i].status==="0"){
                            //     tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice' data_invoice_no='"+result[i].invoice_no+"' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                            // }

                            if(result[i].type === "0"){ // Untuk Pengajuan Request
                                if(result[i].status==="0"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    if(result[i].jmlitem!="0"){
                                        tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    }
                                }
                                tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            }

                            if(result[i].type === "1"){ // Untuk Pengajuan Invoice
                                if(result[i].status==="0"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";

                                    if(result[i].jmlitem!="0"){
                                        if(result[i].invoice==="1"){
                                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='7' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        }
                                        tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                        tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice' data_invoice_no='"+result[i].invoice_no+"' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }   
                            }

                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' data_attachment_note='"+result[i].attachment_note+"' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
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

function approve(){
    $.ajax({
        url       : url+"index.php/logistik/requestnew/approve",
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
                    var getvariabel = " data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      " data_fromdepartmentid='"+result[i].from_department_id+"'";

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

                    if(result[i].status != "6"){
                        tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                    }else{
                        if(result[i].status === "6" && result[i].status_vice === null && result[i].status_dir === null){
                            tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                        }else{
                            if(result[i].status === "6" && result[i].status_vice === '' && result[i].status_dir === ''){
                                tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                            }else{
                                if(result[i].status === "6" && result[i].status_vice != null && result[i].status_dir != null){
                                    tableresult +="<td>"+vice+dir+"</td>";
                                }
                            }
                        }
                    }
                    //tableresult += ((result[i].status != "6") || (result[i].status === "6" && result[i].status_vice === null && result[i].status_dir === null)) ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            // tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            // tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='94' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            // tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='95' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            if(result[i].invoice==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='7' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Submission</a>";
                            }
                            if(result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice' data_invoice_no='"+result[i].invoice_no+"' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                            }
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' data_attachment_note='"+result[i].attachment_note+"' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
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

function decline(){
    $.ajax({
        url       : url+"index.php/logistik/requestnew/decline",
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
                    var getvariabel = " data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      " data_fromdepartmentid='"+result[i].from_department_id+"'";

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
                    if(result[i].status != "6"){
                        tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                    }else{
                        if(result[i].status === "6" && result[i].status_vice === null && result[i].status_dir === null){
                            tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                        }else{
                            if(result[i].status === "6" && result[i].status_vice === '' && result[i].status_dir === ''){
                                tableresult +="<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                            }else{
                                if(result[i].status === "6" && result[i].status_vice != null && result[i].status_dir != null){
                                    tableresult +="<td>"+vice+dir+"</td>";
                                }
                            }
                        }
                    }
                    // tableresult += ((result[i].status != "6") || (result[i].status === "6" && (result[i].status_vice === null || result[i].status_vice === '') && (result[i].status_dir === null || result[i].status_dir === ''))) ? "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>" : "<td>" + vice + dir + "</td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="1"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='0' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
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

function masterbarang(nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/spu/masterbarang",
        data      : {nopemesanan:nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterbarang").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result     = data.responResult;
                var namabarang = new Set();
                var jenis      = new Set();
                var satuan     = new Set();

                for(var i in result){

                    namabarang.add(result[i].nama_barang);
                    jenis.add(result[i].jenis);
                    satuan.add(result[i].satuanbeli);

                    const stock      = parseFloat(result[i].stock) || 0;
                    const qty        = parseFloat(result[i].qty) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));


                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].nama_barang+"</td>";
                    tableresult +="<td>"+(result[i].jenis ? result[i].jenis : "")+"</td>";
                    tableresult +="<td>"+(result[i].satuanbeli ? result[i].satuanbeli : "")+"</td>";


                    if(result[i].stock!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].barang_id}' value='${todesimal(result[i].stock)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    if(result[i].qty!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].barang_id}' value='${todesimal(result[i].qty)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    if(result[i].harga!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].barang_id}' value='${todesimal(result[i].harga)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    if(result[i].ppn!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].barang_id}' value='${todesimal(result[i].ppn)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].barang_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end' id='subtotal_${result[i].barang_id}'>${todesimal(subtotal)}</td>`;

                    if(result[i].note!=null){
                        tableresult += `<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='note_${result[i].barang_id}' value='${result[i].note}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='note_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    tableresult +="</tr>";
                }
            }

            filteritemname.settings.whitelist = Array.from(namabarang);
            filtercategory.settings.whitelist = Array.from(jenis);
            filterunit.settings.whitelist     = Array.from(satuan);

            $("#resultmasterbarang").html(tableresult);

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
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].item_id}' name='qty_${result[i].item_id}' value='${todesimal(qty)}' data_validator='KAINS' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].item_id}' name='harga_${result[i].item_id}' value='${todesimal(result[i].harga)}' data_validator='KAINS' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].item_id}' name='vat_${result[i].item_id}' value='${todesimal(vatPercent)}' data_validator='KAINS' onchange='updateVatAndTotal(this)'></td>`;

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;
                    if(result[i].note!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' value='${result[i].note}' data_validator='KAINS' onchange='updateVatAndTotal(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' data_validator='KAINS' onchange='updateVatAndTotal(this)'></td>`;
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

function simpandata(input) {
    const barangid = input.id.split("_")[1];
    const value    = input.value;

    if (input.id !== `note_${barangid}` && (isNaN(value) || value.trim() === "")) {
        showAlert(
            "I'm Sorry",
            "Masukkan nilai numerik yang valid!",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
        input.value = "";
        return;
    }

    const stockInput       = document.getElementById(`stock_${barangid}`);
    const qtyInput         = document.getElementById(`qty_${barangid}`);
    const hargaInput       = document.getElementById(`harga_${barangid}`);
    const vatElement       = document.getElementById(`vat_${barangid}`);
    const vatAmountElement = document.getElementById(`vat_amount_${barangid}`);
    const subtotalElement  = document.getElementById(`subtotal_${barangid}`);
    const note             = document.getElementById(`note_${barangid}`);

    if (stockInput && qtyInput && hargaInput && vatElement && vatAmountElement) {
        const stock = parseFloat(stockInput.value);
        const qty   = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn   = parseFloat(vatElement.value) / 100;

        if (isNaN(qty) || isNaN(harga) || isNaN(ppn)) {
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        const newVat    = parseFloat((qty * (harga * ppn)).toFixed(0));
        const itemTotal = parseFloat(((qty * harga) + newVat).toFixed(0));


        vatAmountElement.innerText = todesimal(newVat);
        subtotalElement.innerText  = todesimal(itemTotal);

        let totalVat   = 0;
        let grandTotal = 0;

        document.querySelectorAll("[id^='vat_amount_']").forEach((vat) => {
            totalVat += parseFloat(vat.innerText.replace(/\./g, "").replace(",", ".")) || 0;
        });

        document.querySelectorAll("[id^='qty_']").forEach((qtyElem) => {
            const id        = qtyElem.id.split("_")[1];
            const hargaElem = document.getElementById(`harga_${id}`);
            const vatElem   = document.getElementById(`vat_${id}`);

            const qtyVal   = parseFloat(qtyElem.value);
            const hargaVal = parseFloat(hargaElem.value.replace(/\./g, "").replace(",", "."));
            const ppnVal   = parseFloat(vatElem.value) / 100;

            if (!isNaN(qtyVal) && !isNaN(hargaVal) && !isNaN(ppnVal)) {
                const vatAmount = qtyVal * (hargaVal * ppnVal);
                const itemTotal = (qtyVal * hargaVal) + vatAmount;

                grandTotal += itemTotal;
            }
        });

        const type         = $("#type").val();
        const no_pemesanan = $("#nopemesanan_item").val();
        
        $.ajax({
            url     : url + "index.php/logistik/spu/additem",
            method  : "POST",
            dataType: "JSON",
            data    : {
                no_pemesanan: no_pemesanan,
                type        : type,
                barangid    : barangid,
                note        : note ? note.value: "",
                stock       : stock,
                qty         : qty,
                harga       : harga,
                ppn         : ppn,
                subtotal    : itemTotal,
                vat_amount  : newVat
            },
            beforeSend: function () {
                toastr.clear();
                toastr.info("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr.clear();
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                showAlert(
                    "I'm Sorry",
                    "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
                    "error",
                    "Please Try Again",
                    "btn btn-danger"
                );
            }
        });
    }else{
        showAlert(
            "I'm Sorry",
            "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
};

$(document).on("submit", "#formnewrequest", function (e) {
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
			$("#btn_new_request").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_request").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_request").removeClass("disabled");
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

$(document).on("submit", "#formnewinvoice", function (e) {
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
			$("#btn_new_invoice").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_invoice").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_invoice").removeClass("disabled");
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

$(document).on("submit", "#formlampiran", function (e) {
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
			$("#btn_upload_lampiran").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_upload_lampiran").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#btn_upload_lampiran").removeClass("disabled");
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