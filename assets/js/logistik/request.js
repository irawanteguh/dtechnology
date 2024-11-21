datarequest();

$('#modal_detail_barang').on('hidden.bs.modal', function (e) {
    datarequest();
});

function getdetail(btn){
    var $btn = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

    $(":hidden[name='no_pemesanan']").val(data_nopemesanan);
    datadetail(data_nopemesanan,data_status)
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
                    tableresult +="<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_detail_barang' "+getvariabel+" onclick='getdetail(this)'>"+result[i].no_pemesanan+"</a></td>";
                    tableresult += "<td><div>"+result[i].judul_pemesanan+"<div>"+result[i].note+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td></td>";
                    if(result[i].status==="0"){
                        tableresult +="<td><div class='badge badge-light-info fw-bolder'>New</div></td>";
                    }

                    tableresult += "<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    
                    tableresult +="<td></td>";
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
                    const qty = parseFloat(result[i].qty_minta) || 0;
                    const harga = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount = qty * (harga * vatPercent / 100);
                    const subtotal = (qty * harga) + vatAmount;

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
                                   value='${todesimal(result[i].qty_minta)}' 
                                   onchange='updateVatAndTotal(this)'>
                        </td>`;
                    } else {
                        tableresult += `<td class='text-end'>${todesimal(result[i].qty_minta)}</td>`;
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
        $.ajax({
            url: url + "index.php/logistik/request/updatedetailitem",
            method: "POST",
            dataType: "JSON",
            data: {
                no_pemesanan: no_pemesanan,
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

