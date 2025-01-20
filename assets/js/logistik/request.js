const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

datarequest();
decline();
approve();

$("#modal_new_request").on('hide.bs.modal', function(){
    $("input[name='modal_new_request_nama']").val("");
    $("textarea[name='modal_new_request_note']").val("");
    $("input[name='modal_new_request_cito']").prop("checked", false);
});

$("#modal-upload-lampiran").on('hide.bs.modal', function(){
    $("input[name='no_pemesanan_upload']").val("");
    $("textarea[name='modal-upload-lampiran-note']").val("");
});

$("#modal_master_item").on('shown.bs.modal', function(){
    var no_pemesanan_item = $(":hidden[name='no_pemesanan_item']").val();
    masterbarang(no_pemesanan_item);
});

$("#modal_print_po").on('shown.bs.modal', function(){
    var no_pemesanan = $(":hidden[name='no_pemesanan']").val();
    printpo(no_pemesanan);
});


function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_nopemesanan_unit = $btn.attr("data_nopemesanan_unit");
    var data_departmentid     = $btn.attr("data_departmentid");
    var data_suppliers        = $btn.attr("data_suppliers");
    var data_createddate      = $btn.attr("data_createddate");
    var data_attachment_note  = $btn.attr("data_attachment_note");
    var data_no_invoice       = $btn.attr("data_no_invoice");

    $(":hidden[name='departmentid']").val(data_departmentid);
    $(":hidden[name='no_pemesanan']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_item']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_invoice']").val(data_nopemesanan);

    if(data_attachment_note!='null'){
        $("textarea[name='modal-upload-lampiran-note']").val(data_attachment_note);
    }else{
        $("textarea[name='modal-upload-lampiran-note']").val('');
    }
    
    if(data_no_invoice!='null'){
        $("input[name='modal_upload_invoice_no']").val(data_no_invoice);
    }else{
        $("input[name='modal_upload_invoice_no']").val('');
    }
    
    $("#pono").html(data_nopemesanan_unit);
    $("#suppliers").html(data_suppliers);
    $("#orderdate").html(data_createddate);

    var myDropzone = new Dropzone("#file_doc", {
        url               : url + "index.php/logistik/request/uploaddocument?no_pemesanan="+data_nopemesanan,
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

    var myDropzone = new Dropzone("#file_invoice", {
        url               : url + "index.php/logistik/request/uploadinvoice?no_pemesanan="+data_nopemesanan,
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
};

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
}

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/request/datarequest",
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
                    var cito = "";
                    var vice = "";
                    var dir  = "";
                    var type = "";

                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_departmentid='"+result[i].department_id+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_no_invoice='"+result[i].invoice_no+"'"+
                                      "data_no_invoice='"+result[i].invoice_no+"'"+
                                      "data_no_invoice='"+result[i].invoice_no+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].type==="1"){
                        type =" <div class='badge badge-light-info fw-bolder fa-fade'>Invoice Submission</div>";
                    }

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
                    if(result[i].status!="6"){
                        tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    }else{
                        if(result[i].invoice==="0" || result[i].invoice_no===null){
                            if(result[i].status_vice===null && result[i].status_dir===null ){
                                tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                            }else{
                                tableresult +="<td>"+vice+dir+"</td>";
                            }
                        }else{
                            tableresult +="<td><div class='badge badge-light-info fw-bolder'>Invoice Submission</div></td>";
                        }
                        
                    }
                    
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="0"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    if(result[i].jmlitem!="0"){
                                        if(result[i].type==="0"){
                                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        }else{
                                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='6' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        }
                                        
                                        tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                    }
                                }

                                if(result[i].status==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='0' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re On Process</a>";
                                }

                                if(result[i].status==="3"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                }

                                if(result[i].status==="6" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                if(result[i].status==="7" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                if(result[i].status!="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                }
                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
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
        url       : url+"index.php/logistik/request/approve",
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
                    var type = "";

                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_departmentid='"+result[i].department_id+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_no_invoice='"+result[i].invoice_no+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].type==="1"){
                        type =" <div class='badge badge-light-info fw-bolder fa-fade'>Invoice Submission</div>";
                    }
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
                    if(result[i].status!="6"){
                        tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    }else{
                        if(result[i].invoice==="0" || result[i].invoice_no===null){
                            if(result[i].status_vice===null && result[i].status_dir===null ){
                                tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                            }else{
                                tableresult +="<td>"+vice+dir+"</td>";
                            }
                        }else{
                            tableresult +="<td><div class='badge badge-light-info fw-bolder'>Invoice Submission</div></td>";
                        }
                        
                    }
                    
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="0"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='0' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re On Process</a>";
                                }

                                if(result[i].status==="3"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Waiting</a>";
                                }

                                if(result[i].status==="6" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                if(result[i].status==="7" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                // if(result[i].status!="1"){
                                //     tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                // }
                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
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

function decline(){
    $.ajax({
        url       : url+"index.php/logistik/request/decline",
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
                    var type = "";

                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_nopemesanan_unit='"+result[i].no_pemesanan_unit+"'"+
                                      "data_departmentid='"+result[i].department_id+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_no_invoice='"+result[i].invoice_no+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].type==="1"){
                        type =" <div class='badge badge-light-info fw-bolder fa-fade'>Invoice Submission</div>";
                    }
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
                    if(result[i].status!="6"){
                        tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                    }else{
                        if(result[i].invoice==="0" || result[i].invoice_no===null){
                            if(result[i].status_vice===null && result[i].status_dir===null ){
                                tableresult +="<td>"+getStatusBadge(result[i].decoded_status)+"</td>";
                            }else{
                                tableresult +="<td>"+vice+dir+"</td>";
                            }
                        }else{
                            tableresult +="<td><div class='badge badge-light-info fw-bolder'>Invoice Submission</div></td>";
                        }
                        
                    }
                    
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="0"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data_validasi='0' onclick='validasi($(this));'><i class='bi bi-check2-circle text-primary'></i> Re Process</a>";
                                }

                                if(result[i].status==="6" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                if(result[i].status==="7" && result[i].status_vice==="Y" && result[i].status_dir==="Y"){
                                    if(result[i].invoice==="0" || result[i].invoice_no===null){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }

                                if(result[i].status!="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                                }

                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
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
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		}
    });
    return false;
};

function masterbarang(data_nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/request/masterbarang",
        data      : {data_nopemesanan:data_nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultmasterbarang").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
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

            $("#resultmasterbarang").html(tableresult);

            filteritemname.settings.whitelist = Array.from(namabarang);
            filtercategory.settings.whitelist = Array.from(jenis);
            filterunit.settings.whitelist     = Array.from(satuan);

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

function printpo(data_nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/request/detailbarang",
        data      : {data_nopemesanan:data_nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdetailpo").html("");
        },
        success: function (data) {
            let result      = "";
            let tableresult = "";
            let ttdkains    = "";
            let ttdmanager  = "";
            let totalvat    = 0;
            let grandtotal  = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {
                    const stock      = parseFloat(result[i].stock) || 0;
                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) ||parseFloat(result[i].qty_minta) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
                    tableresult += `<td class='text-end'>${todesimal(qty)}</td>`;
                    tableresult += `<td class='text-end pe-4'>${result[i].note ? result[i].note : ""}</td>`;
                    tableresult += "</tr>";

                    totalvat   += vatAmount;
                    grandtotal += subtotal;

                    ttdkains   = result[i].createdby;
                    ttdmanager = result[i].manager;
                }
            }

            $("#resultdetailpo").html(tableresult);

            $("#ttdkains").html(ttdkains);
            $("#ttdmanager").html(ttdmanager);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
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

        const no_pemesanan = $("#no_pemesanan_item").val();
        $.ajax({
            url     : url + "index.php/logistik/request/additem",
            method  : "POST",
            dataType: "JSON",
            data    : {
                no_pemesanan: no_pemesanan,
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
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                toastr.error("Terjadi kesalahan: " + error, "Error");
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
			$("#btnproses").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal-upload-lampiran").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btnproses").removeClass("disabled");
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
			$("#btnproses").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal-upload-invoice").modal("hide");
                datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btnproses").removeClass("disabled");
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
			$("#btnproses").addClass("disabled");
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
            $("#btnproses").removeClass("disabled");
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
});