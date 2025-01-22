const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

datarequest();
approve();
decline();

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

    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='nopemesanan_item']").val(data_nopemesanan);
};

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

$("#modal_master_item").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    masterbarang(nopemesanan);
});

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/spu/datarequest",
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
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div></td>";
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
                            if(result[i].status==="90"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            }
                            if(result[i].jmlitem!="0"){
                                if(result[i].status==="90"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_validasi='91' data_validator='REQ' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                }else{
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='90' data_validator='REQ' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                                }
                            }
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
        url       : url+"index.php/logistik/spu/approve",
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
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div></td>";
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
        url       : url+"index.php/logistik/spu/decline",
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
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>"+result[i].unitdituju+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
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

        const no_pemesanan = $("#nopemesanan_item").val();

        $.ajax({
            url     : url + "index.php/logistik/spu/additem",
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
            toastr.clear();
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