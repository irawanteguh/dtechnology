Dropzone.autoDiscover = false;
let myDropzone;

const filternoinvoice = new Tagify(document.querySelector("#filternoinvoice"), { enforceWhitelist: true });
const filternote      = new Tagify(document.querySelector("#filternote"), { enforceWhitelist: true });
const filterjenisid   = new Tagify(document.querySelector("#filterjenisid"), { enforceWhitelist: true });
const filterperiode   = new Tagify(document.querySelector("#filterperiode"), { enforceWhitelist: true });

function filterTable() {
    const noinvoicefilter = filternoinvoice.value.map(tag => tag.value);
    const jenisidfilter   = filterjenisid.value.map(tag => tag.value);
    const notefilter      = filternote.value.map(tag => tag.value);
    const periodefilter   = filterperiode.value.map(tag => tag.value);

    const tbody = document.getElementById("resultrekappiutang");
    const rows = tbody.getElementsByTagName("tr");

    for (const row of rows) {
        const noinvoice = row.getElementsByTagName("td")[0].textContent;
        const jenisid   = row.getElementsByTagName("td")[2].textContent;
        const note      = row.getElementsByTagName("td")[1].textContent;
        const periode   = row.getElementsByTagName("td")[3].textContent;

        const showRow = 
            (noinvoicefilter.length === 0 || noinvoicefilter.includes(noinvoice)) &&
            (jenisidfilter.length === 0 || jenisidfilter.includes(jenisid)) &&
            (notefilter.length === 0 || notefilter.includes(note)) &&
            (periodefilter.length === 0 || periodefilter.includes(periode));

        row.style.display = showRow ? "" : "none";
    }
}

filternoinvoice.on('change', filterTable);
filterjenisid.on('change', filterTable);
filternote.on('change', filterTable);
filterperiode.on('change', filterTable);

datapiutang();
historypembayaran();

flatpickr('[name="modal_mcu_invoice_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_mcu_pembayaran_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_mcu_invoice_edit_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$("#modal_mcu_invoice_edit").on('show.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    var datapiutangid    = button.attr("datapiutangid");
    var datanotagihan    = button.attr("datanotagihan");
    var datajenistagihan = button.attr("datajenistagihan");
    var datanote         = button.attr("datanote");
    var dataperiode      = button.attr("dataperiode");
    var datatanggal      = button.attr("datatanggal");
    var datanilai        = button.attr("datanilai");
    var datarekananid    = button.attr("datarekananid");


    $("#modal_mcu_invoice_edit_piutangid").val(datapiutangid);
    $("#modal_mcu_invoice_edit_notagihan").val(datanotagihan);
    $("#modal_mcu_invoice_edit_date").val(datatanggal);
    $("#modal_mcu_invoice_edit_note").val(datanote);
    $("#modal_mcu_invoice_edit_tagihan").val(formatRupiah(datanilai));

    var $datarekananid = $('#modal_mcu_invoice_edit_provider').select2();
        $datarekananid.val(datarekananid).trigger('change');

    // var $datajenistagihan = $('#modal_bpjs_invoice_edit_jenisid').select2();
    //     $datajenistagihan.val(datajenistagihan).trigger('change');

    var $dataperiode = $('#modal_mcu_invoice_edit_periodeid').select2();
        $dataperiode.val(dataperiode).trigger('change');
});

$("#modal_mcu_pembayaran").on('show.bs.modal', function(event){
    var button             = $(event.relatedTarget);
    var datapiutangid      = button.attr("datapiutangid");
    var datanotagihan      = button.attr("datanotagihan");
    var dataprovider       = button.attr("dataprovider");
    var dataperiodetagihan = button.attr("dataperiodetagihan");
    var datanote           = button.attr("datanote");

    $("#modal_mcu_pembayaran_piutangid").val(datapiutangid);
    $("#modal_mcu_pembayaran_note").val("Pembayaran Piutang Medical Check Up Provider : "+dataprovider+", periode "+dataperiodetagihan+", no invoice : "+datanotagihan+", catatan : "+datanote);
});

$("#modal_mcu_upload_invoice").on('show.bs.modal', function (event) {
    var button        = $(event.relatedTarget);
    var datapiutangid = button.attr("datapiutangid");

    if (myDropzone) {
        myDropzone.destroy();
    }

    myDropzone = new Dropzone("#file_invoice_mcu", {
        url               : url + "index.php/piutang/mcu/uploadinvoice?piutangid=" + datapiutangid,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 30,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        init: function () {
            this.on("success", function (file, response) {
                datapiutang();
                $('#modal_mcu_upload_invoice').modal('hide');
            });
        }
    });
});

$("#modal_history_payment").on('show.bs.modal', function(event){
    var button        = $(event.relatedTarget);
    var datapiutangid = button.attr("datapiutangid");
    var datanilai     = button.attr("datanilai");
    var dataterbayar  = button.attr("dataterbayar");
    var datasisa      = button.attr("datasisa");

    historypayment(datapiutangid,datanilai,dataterbayar,datasisa);
});

function formatRupiah(angka, prefix = 'Rp ') {
    let numberString = angka.replace(/[^,\d]/g, '').toString();
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah ? prefix + rupiah : '';
}

function viewdoc(btn) {
    var filename     = $(btn).attr("data-dirfile");
    var filename     = filename.replace('/www/wwwroot/', 'http://');
    var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

    if(responsefile === 200){
        var viewfile = "<embed src='"+filename+"' width='100%' height='100%' type='application/pdf' id='view'>";
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

document.querySelectorAll('.currency-rp').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let formatted = formatRupiah(e.target.value);
        e.target.value = formatted;
    });
});

function deletepiutang(elm) {
    var piutang_id = $(elm).attr("datapiutangid");
    var no_tagihan = $(elm).attr("datanotagihan");

    Swal.fire({
        title             : "Hapus Data?",
        html              : "Yakin ingin menghapus tagihan: <b>" + no_tagihan + "</b>?",
        icon              : "warning",
        showCancelButton  : true,
        confirmButtonColor: "#d33",
        cancelButtonColor : "#3085d6",
        confirmButtonText : "Ya, hapus!",
        cancelButtonText  : "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url + "index.php/piutang/mcu/hapuspiutang",
                type: "POST",
                data: { piutang_id: piutang_id },
                dataType: "JSON",
                beforeSend: function () {
                    toastr.info("Menghapus data...", "Mohon tunggu");
                },
                success: function (res) {
                    toastr.clear();
                    if (res.responCode === "00") {
                        toastr.success(res.responDesc, "Berhasil");
                        datapiutang();
                        historypembayaran();
                    } else {
                        toastr.error(res.responDesc, "Gagal");
                    }
                },
                error: function (xhr, status, error) {
                    toastr.clear();
                    toastr.error("Terjadi kesalahan saat menghapus data", "Error");
                }
            });
        }
    });
}

function datapiutang() {
    $.ajax({
        url: url + "index.php/piutang/mcu/datapiutang",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappiutang").html("");
            $("#footrekappiutang").html("");
        },
        success: function (data) {
            var tableresult = "";
            var footresult  = "";
            var noinvoice   = new Set();
            var jenisid     = new Set();
            var note        = new Set();
            var periode     = new Set();

            if (data.responCode === "00") {
                var result           = data.responResult;
                var currentRekanan   = "";
                var subtotalNilai    = 0;
                var subtotalTerbayar = 0;
                var subtotalSisa     = 0;

                // TOTAL AKHIR
                var totalNilai    = 0;
                var totalTerbayar = 0;
                var totalSisa     = 0;

                for (var i = 0; i < result.length; i++) {
                    var item = result[i];

                    if (item.rekanan !== currentRekanan) {
                        if (currentRekanan !== "") {
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='5' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                            tableresult += "<td></td><td></td>";
                            tableresult += "</tr>";
                        }

                        currentRekanan   = item.rekanan;
                        subtotalNilai    = 0;
                        subtotalTerbayar = 0;
                        subtotalSisa     = 0;
                    }

                    var getvariabel =   " datapiutangid='" + item.piutang_id + "'" +
                                        " datanotagihan='" + item.no_tagihan + "'" +
                                        " datajenistagihan='" + item.jenis_id + "'" +
                                        " datajenis='" + item.jenistagihan + "'" +
                                        " dataperiodetagihan='" + item.periode_indonesia + "'" +
                                        " datanote='" + item.note + "'" +
                                        " dataperiode='" + item.periode + "'" +
                                        " datatanggal='" + item.tgldate + "'" +
                                        " datanilai='" + item.nilai + "'" +
                                        " dataterbayar='" + item.jmlterbayar + "'" +
                                        " datasisa='" + item.sisa + "'" +
                                        " dataprovider='" + item.rekanan + "'" +
                                        " datarekananid='" + item.rekanan_id + "'";

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + item.no_tagihan + "</td>";
                    tableresult += "<td>" + item.note + "</td>";
                    tableresult += "<td>" + item.rekanan + "</td>";
                    tableresult += "<td><div class='badge badge-light-info'>" + item.periode_indonesia + "</div></td>";
                    tableresult += "<td class='text-center'>" + item.tgldate + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.nilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.jmlterbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.sisa) + "</td>";
                    tableresult += "<td class='text-end'><div>" + item.dibuatoleh + "<div>" + item.tgldibuat + "</div></div></td>";
                    tableresult += "<td class='text-end'>";
                    tableresult += "<div class='btn-group' role='group'>";
                    tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                    tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_mcu_invoice_edit'><i class='bi bi-pencil-square text-primary'></i> Edit</a>";
                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_mcu_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Invoice</a>";
                    if (item.attachment === "1") {
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' " + getvariabel + " data-dirfile='" + url + "assets/invoice/" + item.piutang_id + ".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                    }
                    tableresult += "<a class='dropdown-item btn btn-sm text-success' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_mcu_pembayaran'><i class='bi bi-credit-card text-success'></i> Payment</a>";
                    tableresult += "<a class='dropdown-item btn btn-sm text-info' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_history_payment'><i class='bi bi-credit-card text-info'></i> Detail Payment</a>";
                    tableresult += "<a class='dropdown-item btn btn-sm text-danger' " + getvariabel + " onclick='deletepiutang(this)'><i class='bi bi-trash3 text-danger'></i> Delete</a>";
                    tableresult += "</div></div></td></tr>";

                    subtotalNilai    += parseFloat(item.nilai);
                    subtotalTerbayar += parseFloat(item.jmlterbayar);
                    subtotalSisa     += parseFloat(item.sisa);

                    totalNilai    += parseFloat(item.nilai);
                    totalTerbayar += parseFloat(item.jmlterbayar);
                    totalSisa     += parseFloat(item.sisa);

                    noinvoice.add(item.no_tagihan);
                    jenisid.add(item.rekanan);
                    note.add(item.note);
                    periode.add(item.periode_indonesia);
                }

                // Tambahkan subtotal terakhir
                if (currentRekanan !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='5' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "<td></td><td></td></tr>";
                }

                
                footresult += "<tr class='bg-light fw-bold'>";
                footresult += "<td colspan='5' class='text-end pe-4'>TOTAL KESELURUHAN</td>";
                footresult += "<td class='text-end'>" + todesimal(totalNilai) + "</td>";
                footresult += "<td class='text-end'>" + todesimal(totalTerbayar) + "</td>";
                footresult += "<td class='text-end'>" + todesimal(totalSisa) + "</td>";
                footresult += "<td></td><td></td></tr>";

                filternoinvoice.settings.whitelist = Array.from(noinvoice);
                filterjenisid.settings.whitelist   = Array.from(jenisid);
                filternote.settings.whitelist      = Array.from(note);
                filterperiode.settings.whitelist   = Array.from(periode);
            }

            $("#resultrekappiutang").html(tableresult);
            $("#footrekappiutang").html(footresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            showAlert("I'm Sorry", error, "error", "Please Try Again", "btn btn-danger");
        }
    });
    return false;
}

function historypayment(datapiutangid, datanilai, dataterbayar, datasisa) {
    $.ajax({
        url: url + "index.php/piutang/mcu/historypayment",
        data: { datapiutangid: datapiutangid },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatahistorypayment").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                for (var i in result) {
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].tglpembayaran + "</td>";
                    tableresult += "<td>" + result[i].rekening + "</td>";
                    tableresult += "<td>" + (result[i].department || "") + "</td>";
                    tableresult += "<td>" + result[i].note + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].nominal) + "</td>";
                    tableresult += "<td class='pe-4 text-end'>" + result[i].dibuatoleh + "</td>";
                    tableresult += "</tr>";
                }

                // Tambahkan baris nilai invoice, terbayar, dan sisa
                tableresult += "<tr class='fw-bold text-dark bg-light'>";
                tableresult += "<td colspan='4' class='ps-4 text-end'>Total Invoice</td>";
                tableresult += "<td class='text-end'>" + todesimal(datanilai) + "</td>";
                tableresult += "<td></td>";
                tableresult += "</tr>";

                tableresult += "<tr class='fw-bold text-success'>";
                tableresult += "<td colspan='4' class='ps-4 text-end'>Total Terbayar</td>";
                tableresult += "<td class='text-end'>" + todesimal(dataterbayar) + "</td>";
                tableresult += "<td></td>";
                tableresult += "</tr>";

                tableresult += "<tr class='fw-bold text-danger'>";
                tableresult += "<td colspan='4' class='ps-4 text-end'>Sisa Piutang</td>";
                tableresult += "<td class='text-end'>" + todesimal(datasisa) + "</td>";
                tableresult += "<td></td>";
                tableresult += "</tr>";
            }

            $("#resultdatahistorypayment").html(tableresult);
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            showAlert("I'm Sorry", error, "error", "Please Try Again", "btn btn-danger");
        }
    });
    return false;
}

function historypembayaran(){
    $.ajax({
        url       : url+"index.php/piutang/mcu/historypembayaran",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappembayaran").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                var tableresult = "";
                var currentProvider = "";
                var subtotalNilai = 0;
                var subtotalJml = Array(12).fill(0);
                var subtotalSisa = 0;

                var totalNilai = 0;
                var totalJml = Array(12).fill(0);
                var totalSisa = 0;

                for (var i = 0; i < result.length; i++) {
                    var row = result[i];

                    // Jika provider berubah, tampilkan subtotal sebelumnya
                    if (row.provider !== currentProvider) {
                        if (currentProvider !== "") {
                            // Subtotal row
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='4' class='text-end pe-2'>Subtotal " + currentProvider + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";

                            for (var j = 0; j < 12; j++) {
                                tableresult += "<td class='text-end'>" + todesimal(subtotalJml[j]) + "</td>";
                            }

                            tableresult += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                            tableresult += "</tr>";
                        }

                        // Reset subtotal
                        currentProvider = row.provider;
                        subtotalNilai = 0;
                        subtotalJml = Array(12).fill(0);
                        subtotalSisa = 0;
                    }

                    // Tambahkan baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + row.no_tagihan + "</td>";
                    tableresult += "<td>" + row.note + "</td>";
                    tableresult += "<td>" + row.provider + "</td>";
                    tableresult += "<td><div class='badge badge-light-info'>" + row.periode_indonesia + "</div></td>";
                    tableresult += "<td class='text-end'>" + todesimal(row.nilai) + "</td>";

                    for (var m = 1; m <= 12; m++) {
                        var val = parseFloat(row["jml" + m]) || 0;
                        tableresult += "<td class='text-end'>" + todesimal(val) + "</td>";
                        subtotalJml[m - 1] += val;
                        totalJml[m - 1] += val;
                    }

                    tableresult += "<td class='text-end pe-4'>" + todesimal(row.sisa_tagihan) + "</td>";
                    tableresult += "</tr>";

                    subtotalNilai += parseFloat(row.nilai) || 0;
                    subtotalSisa += parseFloat(row.sisa_tagihan) || 0;

                    totalNilai += parseFloat(row.nilai) || 0;
                    totalSisa += parseFloat(row.sisa_tagihan) || 0;
                }

                // Subtotal terakhir
                if (currentProvider !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='4' class='text-end pe-2'>Subtotal " + currentProvider + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";

                    for (var j = 0; j < 12; j++) {
                        tableresult += "<td class='text-end'>" + todesimal(subtotalJml[j]) + "</td>";
                    }

                    tableresult += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "</tr>";
                }

                // TFOOT: total
                var footresult = "<tr class='fw-bold bg-light'>";
                footresult += "<td colspan='4' class='text-end pe-2'>TOTAL</td>";
                footresult += "<td class='text-end'>" + todesimal(totalNilai) + "</td>";

                for (var j = 0; j < 12; j++) {
                    footresult += "<td class='text-end'>" + todesimal(totalJml[j]) + "</td>";
                }

                footresult += "<td class='text-end pe-4'>" + todesimal(totalSisa) + "</td>";
                footresult += "</tr>";

                $("#resultrekappembayaran").html(tableresult);
                $("#footrekappembayaran").html(footresult);
            }




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

$(document).on("submit", "#formnewinvoicemcu", function (e) {
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
			$("#modal_mcu_invoice_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_mcu_invoice").modal("hide");
                datapiutang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_mcu_invoice_btn").removeClass("disabled");
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

$(document).on("submit", "#editinvoicemcu", function (e) {
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
			$("#modal_mcu_invoice_edit_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_mcu_invoice_edit").modal("hide");
                datapiutang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_mcu_invoice_edit_btn").removeClass("disabled");
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

$(document).on("submit", "#formpembayaran", function (e) {
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
			$("#modal_mcu_pembayaran_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_mcu_pembayaran").modal("hide");
                datapiutang();
                historypembayaran();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_mcu_pembayaran_btn").removeClass("disabled");
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