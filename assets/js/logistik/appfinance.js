datarequest();

$('#modal_detail_barang').on('hidden.bs.modal', function (e) {
    datarequest();
});

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

function getdetail(btn){
    var $btn             = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

    $(":hidden[name='no_pemesanan']").val(data_nopemesanan);
    datadetail(data_nopemesanan,data_status);

};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/appfinance/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultappfinance").html("");
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
                    tableresult +="<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_detail_barang' "+getvariabel+" onclick='getdetail(this)'>"+result[i].no_pemesanan+"</a></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    if(result[i].attachment==="0"){
                        tableresult +="<td class='text-center'><a class='btn btn-light-info btn-sm' data-bs-toggle='modal' data-bs-target='#modal-upload-lampiran' "+getvariabel+" onclick='getdetail(this)'>Upload Attachment</a></td>";
                    }else{
                        tableresult +="<td class='text-center'><a class='btn btn-light-success btn-sm m-1' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>View</a></td>";
                    }
                    
                    if(result[i].status==="0"){
                        tableresult +="<td><div class='badge badge-light-info fw-bolder'>New</div></td>";
                    }else{
                        if(result[i].status==="1"){
                            tableresult +="<td><div class='badge badge-light-danger fw-bolder'>Cancelled</div></td>";
                        }else{
                            if(result[i].status==="2"){
                                tableresult +="<td><div class='badge badge-light-info fw-bolder'>Waiting Approval Manager</div></td>";
                            }else{
                                if(result[i].status==="3"){
                                    tableresult +="<td><div class='badge badge-light-danger fw-bolder'>Cancelled Manager</div></td>";
                                }else{
                                    if(result[i].status==="4"){
                                        tableresult +="<td><div class='badge badge-light-info fw-bolder'>Approval Manager</div></td>";
                                    }else{
                                        if(result[i].status==="5"){
                                            tableresult +="<td><div class='badge badge-light-danger fw-bolder'>Canceled Finance</div></td>";
                                        }else{
                                            if(result[i].status==="6"){
                                                tableresult +="<td><div class='badge badge-light-info fw-bolder'>Approval Finance</div></td>";
                                            }else{
                                                if(result[i].status==="7"){
                                                    tableresult +="<td><div class='badge badge-light-danger fw-bolder'>Cancelled Vice Director</div></td>";
                                                }else{
                                                    if(result[i].status==="8"){
                                                        tableresult +="<td><div class='badge badge-light-info fw-bolder'>Approval Vice Director</div></td>";
                                                    }else{
                                                        if(result[i].status==="9"){
                                                            tableresult +="<td><div class='badge badge-light-danger fw-bolder'>Cancelled Director</div></td>";
                                                        }else{
                                                            if(result[i].status==="10"){
                                                                tableresult +="<td><div class='badge badge-light-info fw-bolder'>Approval Director</div></td>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    tableresult += "<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    
                    if(result[i].status==="4"){
                        tableresult += "<td class='text-end'>";
                            tableresult += "<div class='btn-group' role='group'>";
                                tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" onclick='approve($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" onclick='cancelled($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }else{
                        tableresult +="<td></td>";
                    }

                    tableresult +="</tr>";
                }
            }

            $("#resultappfinance").html(tableresult);
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

                    if (data_status === "4") {
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

                    if (data_status === "4") {
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

                    if (data_status === "4") {
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
}

function updateVatAndTotal(input) {
    const value = input.value;

    // Validasi apakah value adalah angka
    if (isNaN(value) || value.trim() === "") {
        showAlert(
            "I'm Sorry",
            "Masukkan nilai numerik yang valid!",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
        input.value = ""; // Kosongkan input jika bukan angka
        return; // Hentikan fungsi jika input tidak valid
    }

    // Ambil ID barang dari input (misalnya "qty_123" -> "123")
    const itemId = input.id.split("_")[1];

    // Ambil elemen qty, harga, VAT, dan elemen untuk grand total
    const qtyInput = document.getElementById(`qty_${itemId}`);
    const hargaInput = document.getElementById(`harga_${itemId}`);
    const vatElement = document.getElementById(`vat_${itemId}`);
    const vatAmountElement = document.getElementById(`vat_amount_${itemId}`);
    const subtotalElement = document.getElementById(`subtotal_${itemId}`);
    const totalVatElement = document.getElementById("total_vat");
    const grandTotalElement = document.getElementById("grand_total");

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
        var validasi     = "FINANCE";
        $.ajax({
            url: url + "index.php/logistik/request/updatedetailitem",
            method: "POST",
            dataType: "JSON",
            data: {
                no_pemesanan: no_pemesanan,
                validasi    : validasi,
                item_id     : itemId,
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
            success: function (response) {
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                toastr["error"]("Terjadi kesalahan: " + error, "Error");
            },
            complete: function () {
                toastr.clear();
            }
        });
    } else {
        console.error("Element qty, harga, VAT, atau VAT Amount tidak ditemukan.");
    }
}

function cancelled(btn){
    var datanopemesanan = btn.attr("data_nopemesanan");
    var status           = "5";
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
    var status           = "6";
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