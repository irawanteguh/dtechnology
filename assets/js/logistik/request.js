datarequest();

function getdetail(btn){
    var $btn = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

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
            var result = "";
            var tableresult = "";
            var tfoot = "";
            var totalvat = 0;
            var grandtotal = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    // Perhitungan VAT
                    const qty = parseFloat(result[i].qty_minta) || 0;
                    const harga = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0; // Persentase VAT
                    const vatAmount = qty * (harga * vatPercent / 100); // Rumus VAT

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
                    tableresult += "<td>" + (result[i].jenis ? result[i].jenis : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanbeli ? result[i].satuanbeli : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanpakai ? result[i].satuanpakai : "") + "</td>";

                    if (data_status === "0") {
                        tableresult += "<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_" + result[i].item_id + "' name='qty_" + result[i].item_id + "' value='" + todesimal(result[i].qty_minta) + "' onchange='updateVatAndTotal(this)'></td>";
                    } else {
                        tableresult += "<td class='text-end'>" + todesimal(result[i].qty_minta) + "</td>";
                    }

                    if (data_status === "0") {
                        tableresult += "<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_" + result[i].item_id + "' name='harga_" + result[i].item_id + "' value='" + todesimal(result[i].harga) + "' onchange='updateVatAndTotal(this)'></td>";
                    } else {
                        tableresult += "<td class='text-end'>" + todesimal(result[i].harga) + "</td>";
                    }

                    tableresult += "<td class='text-end'>" + todesimal(vatPercent) + "%</td>"; // Persentase VAT
                    tableresult += "<td class='text-end' id='vat_" + result[i].item_id + "'>" + todesimal(vatAmount) + "</td>"; // Nilai VAT
                    tableresult += "<td class='text-end pe-4'>" + todesimal(result[i].total) + "</td>";
                    tableresult += "</tr>";

                    totalvat += vatAmount; // Tambahkan ke total VAT
                    grandtotal += parseFloat(result[i].total); // Tambahkan ke grand total
                }

                tfoot = "<tr><th class='ps-4' colspan='6'>Grand Total</th><th class='text-end'>" + todesimal(totalvat) + "</th><th class='text-end pe-4'>" + todesimal(grandtotal) + "</th></tr>";
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

    // Ambil ID barang dari input (misalnya "qty-123" -> "123")
    const itemId = input.id.split("_")[1];

    // Ambil elemen qty, harga, dan VAT yang sesuai
    const qtyInput = document.getElementById(`qty_${itemId}`);
    const hargaInput = document.getElementById(`harga_${itemId}`);
    const vatElement = document.getElementById(`vat_${itemId}`); // Elemen VAT

    
    
    // Cek apakah elemen ada
    if (qtyInput && hargaInput && vatElement) {
        const qty = parseFloat(qtyInput.value) || 0;
        const harga = parseFloat(hargaInput.value) || 0;
        const vatPercent = parseFloat(vatElement.dataset.vat) || 0; // VAT dari atribut data

        console.error(qty);
        console.error(harga);
        console.error(vatPercent);

        // Hitung VAT baru
        const newVat = qty * (harga * vatPercent / 100);

        // Perbarui elemen VAT
        vatElement.innerText = todesimal(newVat);
    } else {
        console.error("Element qty, harga, atau VAT tidak ditemukan.");
    }
}

