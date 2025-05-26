Dropzone.autoDiscover = false;
let myDropzone;

const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

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

$("#modal_upload_lampiran").on('show.bs.modal', function (event) {
    var button             = $(event.relatedTarget);
    var datanopemesanan    = button.attr("datanopemesanan");
    var dataattachmentnote = button.attr("dataattachmentnote");

    $("input[name='modal_upload_lampiran_nopemesanan']").val(datanopemesanan);
    $("textarea[name='modal_upload_lampiran_note']").val(dataattachmentnote === 'null' ? '' : dataattachmentnote);

    if (myDropzone) {
        myDropzone.destroy();
    }

    // Inisialisasi ulang Dropzone
    myDropzone = new Dropzone("#file_doc", {
        url: url + "index.php/logistiknew/request/uploaddocument?datanopemesanan=" + datanopemesanan,
        acceptedFiles: '.pdf',
        paramName: "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles: 1,
        maxFilesize: 2,
        addRemoveLinks: true,
        autoProcessQueue: true,
        accept: function (file, done) {
            done();
        }
    });
});

$("#modal_upload_invoice").on('show.bs.modal', function (event) {
    var button          = $(event.relatedTarget);
    var datanopemesanan = button.attr("datanopemesanan");
    var datainvoiceno   = button.attr("datainvoiceno");

    $("input[name='modal_upload_invoice_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_upload_invoice_invoiceno']").val(datainvoiceno === 'null' ? '' : datainvoiceno);

    if(myDropzone){
        myDropzone.destroy();
    }

    myDropzone = new Dropzone("#file_invoice", {
        url               : url + "index.php/logistiknew/request/uploadinvoice?datanopemesanan=" + datanopemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept: function (file, done) {
            done();
        }
    });
});

$("#modal_add_item").on('show.bs.modal', function(event){
    var button             = $(event.relatedTarget);
    var datanopemesanan    = button.attr("datanopemesanan");
    var datadepartmentid    = button.attr("datadepartmentid");

    $("input[name='modal_add_item_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_add_item_departmentid']").val(datadepartmentid);

    masterbarang(datanopemesanan,datadepartmentid);
});

$('#modal_add_item').on('hidden.bs.modal', function (e) {
    dataonprocess();
});

dataonprocess();
datadecline();

function viewdoc(btn) {
    var filename     = $(btn).attr("data-dirfile");
    var note         = $(btn).attr("data_attachment_note");
    var filename     = filename.replace('/www/wwwroot/', 'http://');
    var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

    if (responsefile === 200) {
        var viewfile = "<embed src='"+filename+"' width='100%' height='100%' type='application/pdf' id='view'>";
        $("#viewdocnote").html(viewfile);

        if(note!='null'){
            $("textarea[name='modal_view_pdf_note']").val(note);
        }else{
            $("textarea[name='modal_view_pdf_note']").val('');
        }
        
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

function masterbarang(datanopemesanan,datadepartmentid){
    $.ajax({
        url       : url+"index.php/logistiknew/request/masterbarang",
        data      : {datanopemesanan:datanopemesanan,datadepartmentid:datadepartmentid},
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

function dataonprocess(){
    $.ajax({
        url       : url+"index.php/logistiknew/request/dataonprocess",
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
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    tableresult += "<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_add_item'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                            if(result[i].jmlitem!="0"){
                                if(result[i].type==="0"){
                                    if(result[i].method==="4"){
                                        if(result[i].itemhargakosong!="0"){
                                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                        }
                                    }else{
                                        tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='2' data_validator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    }
                                }else{
                                    if(result[i].itemhargakosong!="0"){
                                        tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                    }
                                }
                            }
                            tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='1' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' data_attachment_note='"+result[i].attachment_note+"'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
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

function datadecline(){
    $.ajax({
        url       : url+"index.php/logistiknew/request/datadecline",
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

                    cito      = result[i].cito        === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";
                    vice      = result[i].status_vice === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Vice Director</div>" : (result[i].status_vice === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Vice Director</div>" : "");
                    dir       = result[i].status_dir  === "Y" ? " <div class='badge badge-light-info fw-bolder'>PO Approval Director</div>" : (result[i].status_dir === "N" ? " <div class='badge badge-light-danger fw-bolder'>PO Decline Director</div>" : "");

                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'";

                    tableresult +="<tr>";
                    tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
                    tableresult +="<td>"+result[i].unitdituju+"</td>";
                    tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].status!="6"){
                        tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    }else{
                        tableresult +="<td>"+vice+dir+"</td>";
                    }
                    tableresult +="<td class='text-end pe-4'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
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
                url       : url+"index.php/logistiknew/request/updateheader",
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
                    datadecline();
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

$(document).on("submit", "#formnewpurchaseorder", function (e) {
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
			$("#modal_new_po_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_po").modal("hide");
                dataonprocess();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_new_po_btn").removeClass("disabled");
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
			$("#modal_new_invoice_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_invoice").modal("hide");
                dataonprocess();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_new_invoice_btn").removeClass("disabled");
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

$(document).on("submit", "#formnotelampiran", function (e) {
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
			$("#modal_upload_lampiran_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_upload_lampiran").modal("hide");
                dataonprocess();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_upload_lampiran_btn").removeClass("disabled");
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

$(document).on("submit", "#formnoinvoice", function (e) {
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
			$("#modal_upload_invoice_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_upload_invoice").modal("hide");
                dataonprocess();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_upload_invoice_btn").removeClass("disabled");
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

        const no_pemesanan = $("#modal_add_item_nopemesanan").val();
        
        $.ajax({
            url     : url + "index.php/logistiknew/request/additem",
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