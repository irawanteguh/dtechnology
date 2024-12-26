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

$('#modal-upload-buktibayar').on('hidden.bs.modal', function (e) {
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

function getStatusBadge(decodedStatus) {
    const [badgeClass, statusText] = decodedStatus.split('|');
    return `<div class='badge ${badgeClass} fw-bolder'>${statusText}</div>`;
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

        const newVat    = qty*(harga*ppn);
        const itemTotal = (qty*harga)+newVat;

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

        if (totalVatElement) totalVatElement.innerText = todesimal(totalVat);
        if (grandTotalElement) grandTotalElement.innerText = todesimal(grandTotal);

        var no_pemesanan = $("#no_pemesanan").val();
        var validasi     = input.getAttribute("data-validasi");
        $.ajax({
            url     : url + "index.php/logistik/request/updatedetailitem",
            method  : "POST",
            dataType: "JSON",
            data    : {
                no_pemesanan: no_pemesanan,
                validasi    : validasi,
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
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                toastr["error"]("Terjadi kesalahan: " + error, "Error");
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

function validasi(btn){
    var datanopemesanan = btn.attr("data_nopemesanan");
    var status          = btn.attr("data_validasi");
    var position        = btn.attr("data_position");
	$.ajax({
        url        : url+"index.php/logistik/request/updateheader",
        data       : {datanopemesanan:datanopemesanan,status:status,position:position},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				datarequest();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

function printPDF() {
    var printContents = document.querySelector('#modal_print_po .modal-body').innerHTML;
    var printWindow = window.open('', '', 'height=700,width=900');
    printWindow.document.write('<html>');
        printWindow.document.write('<head>');
            printWindow.document.write('<title>Purchase Request</title>');

            printWindow.document.write('<style>');
                // Global styles
                printWindow.document.write('body, * { font-size: 10px; font-family: Arial, sans-serif; margin: 0; padding: 0; }');
                printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
                printWindow.document.write('th, td { padding: 5px; }');
                printWindow.document.write('h1 { font-size: 30px; text-align: center; }');
                printWindow.document.write('h6 { font-size: 10px; text-align: left; }');
                printWindow.document.write('img { height: 60px; display: block; margin: 0 auto; }');

                // Styles specific to the header table
                printWindow.document.write('#tableheader { border: none; }');
                printWindow.document.write('#tableheader th, #tableheader td { border: none; }');

                // Ensure other tables retain their borders
                printWindow.document.write('table:not(#tableheader), table:not(#tableheader) th, table:not(#tableheader) td { border: 1px solid black; }');

                // Full-page layout for print
                printWindow.document.write('@page { size: A4; margin: 0; }');
                printWindow.document.write('body { margin: 0; }');
            printWindow.document.write('</style>');

        printWindow.document.write('</head>');
        printWindow.document.write('<body>');
        
            // Konten untuk dicetak
            printWindow.document.write(printContents);
        
        printWindow.document.write('</body>');
    printWindow.document.write('</html>');
    printWindow.document.close();
    printWindow.print();
}

function viewdoc(btn) {
    var filename     = $(btn).attr("data-dirfile");
    var note         = $(btn).attr("data_attachment_note");
    var filename     = filename.replace('/www/wwwroot/', 'http://');
    alert(filename);
    var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

    if (responsefile === 200) {
        var viewfile = "<embed src='" + filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
        $("#viewdocnote").html(viewfile);
        $("textarea[name='modal_view_pdf_note']").val(note);
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