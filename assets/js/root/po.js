$('#modal_master_item').on('hidden.bs.modal', function (e) {
    datarequest();
    approve();
    decline();
});

$('#modal_master_detail_spu').on('hidden.bs.modal', function (e) {
    datarequest();
    approve();
    decline();
});

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
            var datanopemesanan = btn.attr("data_nopemesanan");
            var status          = btn.attr("data_validasi");
            var validator       = btn.attr("data_validator");

            $.ajax({
                url       : url+"index.php/logistik/spu/updateheader",
                data      : {datanopemesanan:datanopemesanan,status:status,validator:validator},
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
                    datarequest();
                    approve();
                    decline();
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

function updateVatAndTotal(input) {
    const itemId = input.id.split("_")[1];
    const value  = input.value;

    if(input.id !== `note_${itemId}` && (isNaN(value) || value.trim() === "")){
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

    const stockInput        = document.getElementById(`stock_${itemId}`);
    const qtyInput          = document.getElementById(`qty_${itemId}`);
    const hargaInput        = document.getElementById(`harga_${itemId}`);
    const vatElement        = document.getElementById(`vat_${itemId}`);
    const vatAmountElement  = document.getElementById(`vat_amount_${itemId}`);
    const subtotalElement   = document.getElementById(`subtotal_${itemId}`);
    const totalVatElement   = document.getElementById("total_vat");
    const grandTotalElement = document.getElementById("grand_total");
    const note              = document.getElementById(`note_${itemId}`);

    if(stockInput && qtyInput && hargaInput && vatElement && vatAmountElement){
        const stock = parseFloat(stockInput.value);
        const qty   = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn   = parseFloat(vatElement.value) / 100;

        if(isNaN(qty) || isNaN(harga) || isNaN(ppn)){
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
                const vatAmount = parseFloat((qtyVal * (hargaVal * ppnVal)).toFixed(0)); // Pembulatan ke 0 desimal
                const itemTotal = parseFloat(((qtyVal * hargaVal) + vatAmount).toFixed(0));
                grandTotal += itemTotal;
            }
        });

        if (totalVatElement) totalVatElement.innerText = todesimal(totalVat);
        if (grandTotalElement) grandTotalElement.innerText = todesimal(grandTotal);

        var no_pemesanan = $("#nopemesanan_item").val();
        var validator     = input.getAttribute("data_validator");
        $.ajax({
            url     : url + "index.php/logistik/spu/updatedetailitem",
            method  : "POST",
            dataType: "JSON",
            data    : {
                no_pemesanan: no_pemesanan,
                validator   : validator,
                item_id     : itemId,
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
                toastr["info"]("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr.clear();
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                showAlert(
                    "I'm Sorry",
                    "Element qty, harga, VAT, atau VAT Amount tidak ditemukan.",
                    "error",
                    "Please Try Again",
                    "btn btn-danger"
                );
            }
        });
    }else{
        showAlert(
            "I'm Sorry",
            "Element qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
};