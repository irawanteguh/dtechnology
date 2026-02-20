datarequest();
decline();
approve();

$("#modal_master_detail_spu").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    detailbarangspu(nopemesanan);
});

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

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_fromdepartmentid = $btn.attr("data_fromdepartmentid");

    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='nopemesanan_item']").val(data_nopemesanan);
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/managerspu/datarequest",
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

                    cito = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_spu+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>"+result[i].unitdituju+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='92' data_validator='REQMANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='93' data_validator='REQMANAGER' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' onclick='getdetail(this)'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
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
        url       : url+"index.php/logistik/managerspu/approve",
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

                    cito = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_spu+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>"+result[i].unitdituju+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="92"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='91' data_validator='REQMANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Approved</a>";
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
        url       : url+"index.php/logistik/managerspu/decline",
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

                    cito = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_spu+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>"+result[i].unitdituju+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="93"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='91' data_validator='REQMANAGER' onclick='validasi($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
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
                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) || parseFloat(result[i].qty_minta) || parseFloat(result[i].qty_req) || parseFloat(result[i].qty_req_manager) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";

                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].item_id}' name='stock_${result[i].item_id}' value='${todesimal(stock)}' disabled></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].item_id}' name='qty_${result[i].item_id}' value='${todesimal(qty)}' data_validator='REQMANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].item_id}' name='harga_${result[i].item_id}' value='${todesimal(result[i].harga)}' data_validator='REQMANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].item_id}' name='vat_${result[i].item_id}' value='${todesimal(vatPercent)}' data_validator='REQMANAGER' onchange='updateVatAndTotal(this)'></td>`;

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;
                    if(result[i].note!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' value='${result[i].note}' data_validator='REQMANAGER' onchange='updateVatAndTotal(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' data_validator='REQMANAGER' onchange='updateVatAndTotal(this)'></td>`;
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