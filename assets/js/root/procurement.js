$("#modal_print_po").on('shown.bs.modal', function(event){
    var button       = $(event.relatedTarget);
    var no_pemesanan = button.attr("datanopemesanan");

    printpo(no_pemesanan);
});

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    datapemesanan(startDate,endDate);
});

function updatedetail(input) {
    const itemId = input.id.split("_")[1];
    const value = input.value;

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

    const stockInput        = document.getElementById(`stock_${itemId}`);
    const qtyInput          = document.getElementById(`qty_${itemId}`);
    const hargaInput        = document.getElementById(`harga_${itemId}`);
    const vatElement        = document.getElementById(`vat_${itemId}`);
    const vatAmountElement  = document.getElementById(`vat_amount_${itemId}`);
    const subtotalElement   = document.getElementById(`subtotal_${itemId}`);
    const totalVatElement   = document.getElementById("total_vat");
    const grandTotalElement = document.getElementById("grand_total");
    const note              = document.getElementById(`note_${itemId}`);

    if (stockInput && qtyInput && hargaInput && vatElement && vatAmountElement) {
        const stock = parseFloat(stockInput.value);
        const qty   = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn   = parseFloat(vatElement.value) / 100;

        if (isNaN(qty) || isNaN(harga) || isNaN(ppn)) {
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        if (qty === 0) {
            Swal.fire({
                title             : "Konfirmasi",
                text              : "Jumlah qty adalah 0. Apakah Anda ingin melanjutkan?",
                icon              : "warning",
                showCancelButton  : true,
                confirmButtonText : "Lanjutkan",
                cancelButtonText  : "Batalkan",
                confirmButtonColor: "#3085d6",
                cancelButtonColor : "#d33"
            }).then((result) => {
                if (!result.isConfirmed) {
                    input.value = ""; // Batalkan input jika pengguna memilih "Batalkan"
                    return;
                }
                processUpdate(); // Lanjutkan jika pengguna memilih "Lanjutkan"
            });
        }else{
            processUpdate();
        }

        function processUpdate() {
            const newVat    = parseFloat((qty * (harga * ppn)).toFixed(0));
            const itemTotal = parseFloat(((qty * harga) + newVat).toFixed(0));

            vatAmountElement.innerText = todesimal(newVat);
            subtotalElement.innerText = todesimal(itemTotal);

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
                    const vatAmount = parseFloat((qtyVal * (hargaVal * ppnVal)).toFixed(0));
                    const itemTotal = parseFloat(((qtyVal * hargaVal) + vatAmount).toFixed(0));
                    grandTotal += itemTotal;
                }
            });

            if (totalVatElement) totalVatElement.innerText = todesimal(totalVat);
            if (grandTotalElement) grandTotalElement.innerText = todesimal(grandTotal);

            var no_pemesanan = $("#nopemesanan_item").val();
            var validator    = input.getAttribute("data_validator");

            $.ajax({
                url     : url + "index.php/logistiknew/request/updatedetailitem",
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
        }
    } else {
        showAlert(
            "I'm Sorry",
            "Element qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
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
            var datanopemesanan     = btn.attr("datanopemesanan");
            var datanopemesananunit = btn.attr("datanopemesananunit");
            var datastatus          = btn.attr("datastatus");
            var datavalidator       = btn.attr("datavalidator");

            $.ajax({
                url       : url+"index.php/logistiknew/request/updateheader",
                data      : {datanopemesanan:datanopemesanan,datanopemesananunit:datanopemesananunit,datastatus:datastatus,datavalidator:datavalidator},
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
                    datapemesanan();
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

function printpo(nopemesanan){
    $.ajax({
        url       : url+"index.php/logistiknew/request/detailbarangspu",
        data      : {nopemesanan:nopemesanan},
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

            let orgname        = "";
            let pono           = "";
            let orderdate      = "";
            let suppliers      = "";
            let ttddirector    = "";
            let ttdfinance     = "";
            let ttdmanager     = "";
            let ttdcoordinator = "";
            let ttdkains       = "";
            let ttdcmo         = "";
            let ttdcfo         = "";

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

                    orgname        = result[i].orgname;
                    pono           = result[i].nopesananunit;
                    orderdate      = result[i].tglpemesanan;
                    suppliers      = result[i].namasupplier;
                    ttddirector    = result[i].director;
                    ttdfinance     = result[i].finance;
                    ttdmanager     = result[i].manager;
                    ttdcoordinator = result[i].koordinator;
                    ttdkains       = result[i].createdby;
                    ttdcmo         = result[i].cmo;
                    ttdcfo         = result[i].cfo;
                }
            }

            $("#resultdetailpo").html(tableresult);

            $("#orgname").html(orgname);
            $("#pono").html(pono);
            $("#orderdate").html(orderdate);
            $("#suppliers").html(suppliers);

            // alert(ttdfinance);
            
            function setTtd(id, value) {
                let td = $("#" + id).closest("td");     
                let colIndex = td.index();              
                let table = td.closest("table");        

                // debug
                // console.log(id, "raw:", value);

                let val = (value !== null && value !== undefined) ? String(value).trim() : "";

                // console.log(id, "processed:", val);

                if (val !== "") {
                    $("#" + id).html(val);
                } else {
                    td.hide();
                    table.find("tr").each(function(){
                        $(this).find("td").eq(colIndex).hide();
                    });
                }
            }



            // panggil semua
            setTtd("ttdcmo", ttdcmo);
            setTtd("ttdcfo", ttdcfo);
            setTtd("ttddirector", ttddirector);
            setTtd("ttdfinance", ttdfinance);
            setTtd("ttdmanager", ttdmanager);
            setTtd("ttdcoordinator", ttdcoordinator);
            setTtd("ttdkains", ttdkains);


            



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
};



$(document).on("click", "[data-kt-element='send']", function () {
    var refid   = $("#drawer_chat_refid").val();
    var message = $("textarea[data-kt-element='input']").val();

    if (message.trim() === "") {
        Swal.fire({
            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
            html             : "<b>Pesan tidak boleh kosong</b>",
            icon             : "error",
            confirmButtonText: "Please Try Again",
            buttonsStyling   : false,
            timerProgressBar : true,
            timer            : 5000,
            customClass      : {confirmButton: "btn btn-danger"},
            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
        });

        return;
    }

    $.ajax({
        url     : url + "index.php/surat/disposisi/sendchat",
        method  : "POST",
        data    : {chat:message,refid:refid},
        dataType: "JSON",
        beforeSend: function () {
            toastr.clear();
            $("#transaksichat").html(`
                <div class="d-flex justify-content-center align-items-center" style="height:200px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
        },
        success : function (data) {
            if(data.responCode === "00"){
                $("textarea[data-kt-element='input']").val("");
                $('textarea[data-kt-element="input"]').focus();
                chat(refid);
            }else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html             : "<b>Gagal mengirim pesan!</b>",
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
        }
    });
});

function getdatachat(btn){
    var datajudulpemesanan  = btn.attr("datajudulpemesanan");
    var datanopemesanan     = btn.attr("datanopemesanan");
    var datanopemesananunit = btn.attr("datanopemesananunit");

    $("#drawer_chat_judul").html(datajudulpemesanan);
    $("#drawer_chat_detail").html(datanopemesananunit);
    $("#drawer_chat_refid").val(datanopemesanan);

    chat(datanopemesanan);
};

function chat(refid) {
    $.ajax({
        url       : url + "index.php/logistiknew/request/chat",
        data      : {refid:refid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            $("#transaksichat").html(`
                <div class="d-flex justify-content-center align-items-center" style="height:200px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
        },
        success: function (data) {
            var tableresult = "";
            var lastName = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                for (var i in result) {
                    var chatType   = result[i].type === "in" ? "info" : "primary";
                    var isSameUser = lastName       === result[i].name;
                        lastName   = result[i].name;

                    tableresult += `<div class='d-flex justify-content-${result[i].type === "in" ? "start" : "end"}'>`;
                    tableresult += `<div class='d-flex flex-column align-items-${result[i].type === "in" ? "start" : "end"}'>`;

                    if (!isSameUser) {
                        tableresult += `<div class='d-flex align-items-center mb-2'>`;
                        if (result[i].type === "out") {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='d-flex flex-column me-3 text-end'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        } else {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='d-flex flex-column'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        }
                        tableresult += `</div>`;
                    }

                    tableresult += `<div class='p-2 rounded bg-light-${chatType} text-dark fw-bold mw-lg-400px text-${result[i].type === "in" ? "start" : "end"} mb-1' data-kt-element='message-text'>`;
                    tableresult += `${result[i].chat}`;
                    tableresult += `<div class='text-muted small'>${result[i].jambuat}</div>`;
                    tableresult += `</div>`;
                    
                    tableresult += `</div>`;
                    tableresult += `</div>`;
                }
            }

            $("#transaksichat").html(tableresult);
        },
        complete: function () {
             var container = $("#transaksichat");
                 container.scrollTop(container[0].scrollHeight);
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
};

function detailbarangspu(nopemesanan,validator){
    $.ajax({
        url       : url+"index.php/logistiknew/request/detailbarangspu",
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
                    const qty        = parseFloat(result[i].pt_qty_cmo)|| 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";

                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].item_id}' name='stock_${result[i].item_id}' value='${todesimal(stock)}' disabled></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].item_id}' name='qty_${result[i].item_id}' value='${todesimal(qty)}' data_validator='${validator}' onchange='updatedetail(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].item_id}' name='harga_${result[i].item_id}' value='${todesimal(result[i].harga)}' data_validator='${validator}' onchange='updatedetail(this)'></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].item_id}' name='vat_${result[i].item_id}' value='${todesimal(vatPercent)}' data_validator='${validator}' onchange='updatedetail(this)'></td>`;

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;
                    if(result[i].note!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' value='${result[i].note}' data_validator='MANAGER' onchange='updatedetail(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' data_validator='${validator}' onchange='updatedetail(this)'></td>`;
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