datarequest();


$('#modal-upload-lampiran').on('hidden.bs.modal', function (e) {
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;
    datarequest();
});

$('#modal-upload-invoice').on('hidden.bs.modal', function (e) {
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;
    datarequest();
});

$('#modal_detail_barang').on('hidden.bs.modal', function (e) {
    datarequest();
});

$('#modal_master_item').on('hidden.bs.modal', function (e) {
    datarequest();
});

function getdetail(btn){
    var $btn = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

    $(":hidden[name='no_pemesanan']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_item']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_invoice']").val(data_nopemesanan);

    datadetail(data_nopemesanan,data_status);
    masterbarang(data_nopemesanan);

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
            $('#modal-upload-lampiran').modal('hide');
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

function viewdoc(btn) {
    var filename = $(btn).attr("data-dirfile");
        filename = filename.replace('/www/wwwroot/', 'http://');
      
    var responsefile = jQuery.ajax({
        url: filename,
        type: 'HEAD',
        async: false
    }).status;

    if (responsefile === 200) {
        var viewfile = "<embed src='" + filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
        $("#viewdoc").html(viewfile);
        
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
        $("#viewdoc").html(viewfile);
        $('#openInNewTabButton').data('filename', '');
    }
};

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

                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_status='"+result[i].status+"'";

                    tableresult +="<tr>";

                    if(result[i].status==="10"){
                        tableresult +="<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_print_po' "+getvariabel+" onclick='getdetail(this)'>"+result[i].no_pemesanan+"</a></td>";
                    }else{
                        tableresult +="<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_detail_barang' "+getvariabel+" onclick='getdetail(this)'>"+result[i].no_pemesanan+"</a></td>";
                    }
                    
                    tableresult +="<td><div>"+result[i].judul_pemesanan+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td>"+result[i].namasupplier+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>View Document</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                
                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>Data Pendukung</a>";
                                }

                                if(result[i].invoice==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>Invoice</a>";
                                }

                                tableresult +="<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' "+getvariabel+" onclick='getdetail(this)'>Re Upload</a>";

                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    
                    tableresult += getStatusBadge(result[i].decoded_status);
                    
                    tableresult += "<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status==="0"){
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" onclick='approve($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" onclick='cancelled($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                                }else{
                                    if(result[i].status==="10"){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-invoice' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Invoce</a>";
                                    }
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

function getStatusBadge(decodedStatus) {
    // Pecah nilai berdasarkan separator "|"
    const [badgeClass, statusText] = decodedStatus.split('|');

    // Kembalikan HTML badge
    return `<td><div class='badge ${badgeClass} fw-bolder'>${statusText}</div></td>`;
}

const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

function masterbarang(data_nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/request/masterbarang",
        data :{data_nopemesanan:data_nopemesanan},
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

                    const qty        = parseFloat(result[i].qty) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = qty * (harga * vatPercent / 100);
                    const subtotal   = (qty * harga) + vatAmount;



                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].nama_barang+"</td>";
                    tableresult +="<td>"+result[i].jenis+"</td>";
                    tableresult +="<td>"+(result[i].satuanbeli ? result[i].satuanbeli : "")+"</td>";


                    if(result[i].qty!=null){
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='qty_${result[i].barang_id}'
                                                value='${todesimal(result[i].qty)}'  
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }else{
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='qty_${result[i].barang_id}'
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }

                    if(result[i].harga!=null){
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='harga_${result[i].barang_id}'
                                                value='${todesimal(result[i].harga)}'  
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }else{
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='harga_${result[i].barang_id}'
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }

                    if(result[i].ppn!=null){
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='vat_${result[i].barang_id}'
                                                value='${todesimal(result[i].ppn)}'  
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }else{
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='vat_${result[i].barang_id}'
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].barang_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].barang_id}'>${todesimal(subtotal)}</td>`;

                    if(result[i].note!=null){
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='note_${result[i].barang_id}'
                                                value='${result[i].note}'  
                                                onchange='simpandata(this)'>
                                        </td>`;
                    }else{
                        tableresult += `<td class='text-end'>
                                            <input class='form-control form-control-sm text-end' 
                                                id='note_${result[i].barang_id}'
                                                onchange='simpandata(this)'>
                                        </td>`;
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

function filterTable() {
    const itemnamefilter = filteritemname.value.map(tag => tag.value);
    const categoryfilter = filtercategory.value.map(tag => tag.value);
    const unitfilter     = filterunit.value.map(tag => tag.value);

    const table = document.getElementById("tablemasterbarang");
    const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (const row of rows) {
        const itemname = row.getElementsByTagName("td")[0].textContent;
        const category = row.getElementsByTagName("td")[1].textContent;
        const unit = row.getElementsByTagName("td")[2].textContent;

        const showRow = 
            (itemnamefilter.length === 0 || itemnamefilter.includes(itemname)) &&
            (categoryfilter.length === 0 || categoryfilter.includes(category)) &&
            (unitfilter.length === 0 || unitfilter.includes(unit));

        row.style.display = showRow ? "" : "none";
    }
}

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

function datadetail(data_nopemesanan, data_status) {
    $.ajax({
        url: url + "index.php/logistik/request/detailbarang",
        data: { data_nopemesanan: data_nopemesanan },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            $("#resultdetail").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success: function (data) {
            let result = "";
            let tableresult = "";
            let tfoot = "";
            let totalvat = 0;
            let grandtotal = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {
                    // Perhitungan VAT dan Subtotal
                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) ||parseFloat(result[i].qty_minta) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = qty * (harga * vatPercent / 100);
                    const subtotal   = (qty * harga) + vatAmount;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
                    tableresult += "<td>" + (result[i].jenis ? result[i].jenis : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanbeli ? result[i].satuanbeli : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanpakai ? result[i].satuanpakai : "") + "</td>";

                    if (data_status === "0") {
                        tableresult += `<td class='text-end'>
                            <input class='form-control form-control-sm text-end' 
                                   id='qty_${result[i].item_id}' 
                                   name='qty_${result[i].item_id}' 
                                   value='${todesimal(qty)}' 
                                   onchange='updateVatAndTotal(this)'>
                        </td>`;
                    } else {
                        tableresult += `<td class='text-end'>${todesimal(qty)}</td>`;
                    }

                    if (data_status === "0") {
                        tableresult += `<td class='text-end'>
                            <input class='form-control form-control-sm text-end' 
                                   id='harga_${result[i].item_id}' 
                                   name='harga_${result[i].item_id}' 
                                   value='${todesimal(result[i].harga)}' 
                                   onchange='updateVatAndTotal(this)'>
                        </td>`;
                    } else {
                        tableresult += `<td class='text-end'>${todesimal(result[i].harga)}</td>`;
                    }

                    if (data_status === "0") {
                        tableresult += `<td class='text-end'>
                            <input class='form-control form-control-sm text-end' 
                                   id='vat_${result[i].item_id}' 
                                   name='vat_${result[i].item_id}' 
                                   value='${todesimal(vatPercent)}' 
                                   onchange='updateVatAndTotal(this)'>
                        </td>`;
                    } else {
                        tableresult += `<td class='text-end'>${todesimal(vatPercent)}%</td>`;
                    }

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;
                    
                    if (data_status === "0") {
                        if(result[i].note!=null){
                            tableresult += `<td class='text-end'>
                                                <input class='form-control form-control-sm text-end' 
                                                    id='note_${result[i].item_id}'
                                                    value='${result[i].note}'  
                                                    onchange='updateVatAndTotal(this)'>
                                            </td>`;
                        }else{
                            tableresult += `<td class='text-end'>
                                                <input class='form-control form-control-sm text-end' 
                                                    id='note_${result[i].item_id}'
                                                    onchange='updateVatAndTotal(this)'>
                                            </td>`;
                        }
                    } else {
                        tableresult += `<td class='text-end'>${result[i].note ? result[i].note : ""}</td>`;

                    }
                    
                    tableresult += "</tr>";

                    

                    totalvat   += vatAmount;
                    grandtotal += subtotal;
                }

                tfoot = `<tr>
                            <th class='ps-4' colspan='7'>Grand Total</th>
                            <th class='text-end' id='total_vat'>${todesimal(totalvat)}</th>
                            <th class='text-end pe-4' id='grand_total'>${todesimal(grandtotal)}</th>
                        </tr>`;

            }

            $("#resultdetail").html(tableresult);
            $("#resultdetailfoot").html(tfoot);

            $("#resultdetailpo").html(tableresult);
            $("#resultdetailfootpo").html(tfoot);

            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
        },
        complete: function () {
            toastr.clear();
        }
    });
    return false;
};

function updateVatAndTotal(input) {
    const itemId = input.id.split("_")[1];  // Ambil ID barang lebih awal
    const value  = input.value;

    // Validasi kecuali untuk note
    if (input.id !== `note_${itemId}` && (isNaN(value) || value.trim() === "")) {
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

    // Ambil elemen qty, harga, VAT, dan elemen untuk grand total
    const qtyInput          = document.getElementById(`qty_${itemId}`);
    const hargaInput        = document.getElementById(`harga_${itemId}`);
    const vatElement        = document.getElementById(`vat_${itemId}`);
    const vatAmountElement  = document.getElementById(`vat_amount_${itemId}`);
    const subtotalElement   = document.getElementById(`subtotal_${itemId}`);
    const totalVatElement   = document.getElementById("total_vat");
    const grandTotalElement = document.getElementById("grand_total");
    const note              = document.getElementById(`note_${itemId}`);

    // Cek apakah elemen ada
    if (qtyInput && hargaInput && vatElement && vatAmountElement) {
        // Ambil nilai-nilai dari elemen
        const qty = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", ".")); // Konversi format desimal
        const ppn = parseFloat(vatElement.value) / 100;

        // Validasi nilai-nilai yang diperlukan
        if (isNaN(qty) || isNaN(harga) || isNaN(ppn)) {
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        // Hitung VAT dan Total
        const newVat = qty * (harga * ppn);
        const itemTotal = (qty * harga) + newVat;

        // Perbarui VAT Amount dan Subtotal di elemen tabel
        vatAmountElement.innerText = todesimal(newVat);
        subtotalElement.innerText = todesimal(itemTotal);

        // Hitung ulang total VAT dan grand total
        let totalVat = 0;
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

        // Perbarui elemen footer
        if (totalVatElement) totalVatElement.innerText = todesimal(totalVat);
        if (grandTotalElement) grandTotalElement.innerText = todesimal(grandTotal);

        // Kirim data perubahan ke database
        var no_pemesanan = $("#no_pemesanan").val();
        var validasi     = "KAINS";
        $.ajax({
            url: url + "index.php/logistik/request/updatedetailitem",
            method: "POST",
            dataType: "JSON",
            data: {
                no_pemesanan: no_pemesanan,
                validasi    : validasi,
                item_id     : itemId,
                note        : note ? note.value: "",
                qty         : qty,
                harga       : harga,
                ppn         : ppn,
                subtotal    : itemTotal,
                vat_amount  : newVat
            },
            beforeSend: function () {
                toastr.clear();
                toastr["info"]("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                toastr["error"]("Terjadi kesalahan: " + error, "Error");
            }
        });
    } else {
        console.error("Element qty, harga, VAT, atau VAT Amount tidak ditemukan.");
    }
};

function simpandata(input) {
    const barangid = input.id.split("_")[1]; // Ambil ID barang lebih awal
    const value = input.value;

    // Validasi kecuali untuk note
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

    // Ambil elemen terkait
    const qtyInput         = document.getElementById(`qty_${barangid}`);
    const hargaInput       = document.getElementById(`harga_${barangid}`);
    const vatElement       = document.getElementById(`vat_${barangid}`);
    const vatAmountElement = document.getElementById(`vat_amount_${barangid}`);
    const subtotalElement  = document.getElementById(`subtotal_${barangid}`);
    const note             = document.getElementById(`note_${barangid}`);

    if (qtyInput && hargaInput && vatElement && vatAmountElement) {
        const qty = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn = parseFloat(vatElement.value) / 100;

        if (isNaN(qty) || isNaN(harga) || isNaN(ppn)) {
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        const newVat = qty * (harga * ppn);
        const itemTotal = (qty * harga) + newVat;

        vatAmountElement.innerText = todesimal(newVat);
        subtotalElement.innerText = todesimal(itemTotal);

        let totalVat = 0;
        let grandTotal = 0;

        document.querySelectorAll("[id^='vat_amount_']").forEach((vat) => {
            totalVat += parseFloat(vat.innerText.replace(/\./g, "").replace(",", ".")) || 0;
        });

        document.querySelectorAll("[id^='qty_']").forEach((qtyElem) => {
            const id = qtyElem.id.split("_")[1];
            const hargaElem = document.getElementById(`harga_${id}`);
            const vatElem = document.getElementById(`vat_${id}`);

            const qtyVal = parseFloat(qtyElem.value);
            const hargaVal = parseFloat(hargaElem.value.replace(/\./g, "").replace(",", "."));
            const ppnVal = parseFloat(vatElem.value) / 100;

            if (!isNaN(qtyVal) && !isNaN(hargaVal) && !isNaN(ppnVal)) {
                const vatAmount = qtyVal * (hargaVal * ppnVal);
                const itemTotal = (qtyVal * hargaVal) + vatAmount;
                grandTotal += itemTotal;
            }
        });

        // Kirim data ke server
        const no_pemesanan = $("#no_pemesanan_item").val();
        $.ajax({
            url: url + "index.php/logistik/request/additem",
            method: "POST",
            dataType: "JSON",
            data: {
                no_pemesanan: no_pemesanan,
                barangid    : barangid,
                note        : note ? note.value: "",
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
                if (data && data.responHead && data.responDesc) {
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                } else {
                    toastr.error("Response tidak valid dari server.", "Error");
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Terjadi kesalahan: " + error, "Error");
            }
        });
    } else {
        console.error("Element qty, harga, VAT, atau VAT Amount tidak ditemukan.");
    }
}

function cancelled(btn){
    var datanopemesanan = btn.attr("data_nopemesanan");
    var status           = "1";
	$.ajax({
        url        : url+"index.php/logistik/request/updateheader",
        data       : {datanopemesanan:datanopemesanan,status:status},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
				datarequest();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            }
		}
	});
	return false;
};

function approve(btn){
    var datanopemesanan = btn.attr("data_nopemesanan");
    var status           = "2";
	$.ajax({
        url        : url+"index.php/logistik/request/updateheader",
        data       : {datanopemesanan:datanopemesanan,status:status},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
				datarequest();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            }
		}
	});
	return false;
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
			$("#btn_position_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if (data.responCode == "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_new_request").modal("hide");
                datarequest();
			}else{
                $("#btn_position_add").removeClass("disabled");
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            };
			
		},
        complete: function () {
            toastr.clear();
            $("#btn_position_add").removeClass("disabled");
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

function printPDF() {
    var printContents = document.querySelector('#modal_print_po .modal-body').innerHTML;
    var printWindow = window.open('', '', 'height=700,width=900');
    printWindow.document.write('<html>');
        printWindow.document.write('<head>');
            printWindow.document.write('<title>Goods Procurement Details</title>');
            printWindow.document.write('<style>');
                // Atur font-size global
                printWindow.document.write('body, * { font-size: 10px; font-family: Arial, sans-serif; }');
                
                // Gaya tabel
                printWindow.document.write('table, th, td {border: 1px solid black; border-collapse: collapse;}');
                printWindow.document.write('th, td { padding: 5px; }'); 
                
                // Gaya tambahan
                printWindow.document.write('.text-center { text-align: center; }');
                printWindow.document.write('.mb-5 { margin-bottom: 3rem; }');
                printWindow.document.write('.mb-3 { margin-bottom: 1rem; }');
                printWindow.document.write('.fw-bold { font-weight: bold; }');
                printWindow.document.write('.d-flex { display: flex; }');
                printWindow.document.write('.justify-content-center { justify-content: center; }');
                printWindow.document.write('.justify-content-between { justify-content: space-between; }');
                printWindow.document.write('.col-xl-12 { width: 100%; }');
                printWindow.document.write('.col-xl-5 { width: 41.666667%; }');
                printWindow.document.write('.col-xl-2 { width: 16.666667%; }');
                printWindow.document.write('.row { display: flex; flex-wrap: wrap; margin: 0 -15px; }');
                
            printWindow.document.write('</style>');
        printWindow.document.write('</head>');
        printWindow.document.write('<body>');
            printWindow.document.write(printContents);
        printWindow.document.write('</body>');
    printWindow.document.write('</html>');
    printWindow.document.close();
    printWindow.print();
}
