Dropzone.autoDiscover = false;
let myDropzone;

const filternoinvoice = new Tagify(document.querySelector("#filternoinvoice"), { enforceWhitelist: true });
const filterjenisid   = new Tagify(document.querySelector("#filterjenisid"), { enforceWhitelist: true });
const filternote      = new Tagify(document.querySelector("#filternote"), { enforceWhitelist: true });
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
        const jenisid   = row.getElementsByTagName("td")[1].textContent;
        const note      = row.getElementsByTagName("td")[2].textContent;
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

flatpickr('[name="modal_bpjs_invoice_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_bpjs_invoice_edit_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_bpjs_pembayaran_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    historypembayaran();
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

document.querySelectorAll('.currency-rp').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let formatted = formatRupiah(e.target.value);
        e.target.value = formatted;
    });
});

$("#modal_bpjs_pembayaran").on('show.bs.modal', function(event){
    var button        = $(event.relatedTarget);
    var datapiutangid      = button.attr("datapiutangid");
    var datanotagihan      = button.attr("datanotagihan");
    var datajenis          = button.attr("datajenis");
    var dataperiodetagihan = button.attr("dataperiodetagihan");
    var datanote           = button.attr("datanote");

    $("#modal_bpjs_pembayaran_piutangid").val(datapiutangid);
    $("#modal_bpjs_pembayaran_note").val("Pembayaran Piutang "+datajenis+", periode "+dataperiodetagihan+", no invoice : "+datanotagihan+", catatan : "+datanote);
});

$("#modal_bpjs_invoice_edit").on('show.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    var datapiutangid    = button.attr("datapiutangid");
    var datanotagihan    = button.attr("datanotagihan");
    var datajenistagihan = button.attr("datajenistagihan");
    var datanote         = button.attr("datanote");
    var dataperiode      = button.attr("dataperiode");
    var datatanggal      = button.attr("datatanggal");
    var datanilai        = button.attr("datanilai");
    var datarekananid    = button.attr("datarekananid");


    $("#modal_bpjs_invoice_edit_piutangid").val(datapiutangid);
    $("#modal_bpjs_invoice_edit_notagihan").val(datanotagihan);
    $("#modal_bpjs_invoice_edit_date").val(datatanggal);
    $("#modal_bpjs_invoice_edit_note").val(datanote);
    $("#modal_bpjs_invoice_edit_tagihan").val(formatRupiah(datanilai));

    var $datarekananid = $('#modal_bpjs_invoice_edit_provider').select2();
        $datarekananid.val(datarekananid).trigger('change');

    var $datajenistagihan = $('#modal_bpjs_invoice_edit_jenisid').select2();
        $datajenistagihan.val(datajenistagihan).trigger('change');

    var $dataperiode = $('#modal_bpjs_invoice_edit_periodeid').select2();
        $dataperiode.val(dataperiode).trigger('change');
});

$("#modal_bpjs_upload_invoice").on('show.bs.modal', function (event) {
    var button        = $(event.relatedTarget);
    var datapiutangid = button.attr("datapiutangid");

    if (myDropzone) {
        myDropzone.destroy();
    }

    myDropzone = new Dropzone("#file_invoice_bpjs", {
        url               : url + "index.php/piutang/bpjs/uploadinvoice?piutangid=" + datapiutangid,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        init: function () {
            this.on("success", function (file, response) {
                datapiutang();
                $('#modal_bpjs_upload_invoice').modal('hide');
            });
        }
    });
});

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

function datapiutang(){
    $.ajax({
        url       : url + "index.php/piutang/bpjs/datapiutang",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappiutang").html("");
        },
        success: function(data){
            var tableresult         = "";
            var currentGroupKey     = "";
            var currentJenisTagihan = "";
            var currentTahunOrder   = "";
            var subtotalNilai       = 0;
            var subtotalTerbayar    = 0;
            var subtotalSisa        = 0;
            var noinvoice           = new Set();
            var jenisid             = new Set();
            var note                = new Set();
            var periode             = new Set();

            if (data.responCode === "00") {
                var result = data.responResult;

                for (var i = 0; i < result.length; i++) {
                    var item     = result[i];
                    var groupKey = item.jenistagihan + "-" + item.tahun_order;

                    if (groupKey !== currentGroupKey) {
                        if (currentGroupKey !== "") {
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='5' class='text-end pe-4'>Subtotal " + currentJenisTagihan + " (" + currentTahunOrder + ")</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                            tableresult += "<td></td><td></td>";
                            tableresult += "</tr>";
                        }

                        currentGroupKey     = groupKey;
                        currentJenisTagihan = item.jenistagihan;
                        currentTahunOrder   = item.tahun_order;
                        subtotalNilai       = 0;
                        subtotalTerbayar    = 0;
                        subtotalSisa        = 0;
                    }

                    // Kumpulkan filter
                    noinvoice.add(item.no_tagihan);
                    jenisid.add(item.jenistagihan);
                    note.add(item.note);
                    periode.add(item.periode_indonesia);

                    // Data variabel untuk tombol action
                    var getvariabel = " datapiutangid='" + item.piutang_id + "'" +
                                      " datanotagihan='" + item.no_tagihan + "'" +
                                      " datajenistagihan='" + item.jenis_id + "'" +
                                      " datajenis='" + item.jenistagihan + "'" +
                                      " dataperiodetagihan='" + item.periode_indonesia + "'" +
                                      " datanote='" + item.note + "'" +
                                      " dataperiode='" + item.periode + "'" +
                                      " datatanggal='" + item.tgldate + "'" +
                                      " datanilai='" + item.nilai + "'" +
                                      " dataprovider='" + item.rekanan + "'" +
                                      " datarekananid='" + item.rekanan_id + "'";

                    // Baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + item.no_tagihan + "</td>";
                    tableresult += "<td><div>" + item.jenistagihan + "</div></td>";
                    tableresult += "<td>" + item.note + "</td>";
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
                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_bpjs_invoice_edit'><i class='bi bi-pencil-square text-primary'></i> Edit</a>";
                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_bpjs_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Invoice</a>";
                    if (item.attachment === "1") {
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' " + getvariabel + " data-dirfile='" + url + "assets/invoice/" + item.piutang_id + ".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                    }
                    tableresult += "<a class='dropdown-item btn btn-sm text-success' " + getvariabel + " data-bs-toggle='modal' data-bs-target='#modal_bpjs_pembayaran'><i class='bi bi-credit-card text-success'></i> Payment</a>";
                    tableresult += "</div>";
                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                    // Akumulasi subtotal
                    subtotalNilai       += parseFloat(item.nilai);
                    subtotalTerbayar    += parseFloat(item.jmlterbayar);
                    subtotalSisa        += parseFloat(item.sisa);
                }

                // Tambahkan subtotal terakhir
                if (currentGroupKey !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='5' class='text-end pe-4'>Subtotal " + currentJenisTagihan + " (" + currentTahunOrder + ")</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "<td></td><td></td>";
                    tableresult += "</tr>";
                }

                // Update filter input (jika pakai tagify atau semacamnya)
                filternoinvoice.settings.whitelist = Array.from(noinvoice);
                filterjenisid.settings.whitelist   = Array.from(jenisid);
                filternote.settings.whitelist      = Array.from(note);
                filterperiode.settings.whitelist   = Array.from(periode);
            }

            $("#resultrekappiutang").html(tableresult);
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
}

function historypembayaran() {
    const startDate = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url + "index.php/piutang/bpjs/historypembayaran",
        data      : {startDate:startDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappembayaran").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                var currentGroupKey     = "";
                var currentJenisTagihan = "";
                var currentTahunOrder   = "";

                var subtotalNilai   = 0;
                var subtotalJml     = Array(12).fill(0);
                var subtotalSisa    = 0;

                var totalNilai = 0;
                var totalJml   = Array(12).fill(0);
                var totalSisa  = 0;

                for (var i = 0; i < result.length; i++) {
                    var row = result[i];
                    var groupKey = row.jenistagihan + "-" + row.tahun_order;

                    if (groupKey !== currentGroupKey) {
                        if (currentGroupKey !== "") {
                            // Tampilkan subtotal sebelumnya
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='4' class='text-end pe-2'>Subtotal " + currentJenisTagihan + " (" + currentTahunOrder + ")</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";

                            for (var j = 0; j < 12; j++) {
                                tableresult += "<td class='text-end'>" + todesimal(subtotalJml[j]) + "</td>";
                            }

                            tableresult += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                            tableresult += "</tr>";
                        }

                        // Reset subtotal
                        currentGroupKey     = groupKey;
                        currentJenisTagihan = row.jenistagihan;
                        currentTahunOrder   = row.tahun_order;
                        subtotalNilai       = 0;
                        subtotalJml         = Array(12).fill(0);
                        subtotalSisa        = 0;
                    }

                    // Render baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + row.no_tagihan + "</td>";
                    tableresult += "<td><div>" + row.jenistagihan + "</div></td>";
                    tableresult += "<td>" + row.note + "</td>";
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

                    // Hitung subtotal & total
                    subtotalNilai += parseFloat(row.nilai) || 0;
                    subtotalSisa  += parseFloat(row.sisa_tagihan) || 0;
                    totalNilai    += parseFloat(row.nilai) || 0;
                    totalSisa     += parseFloat(row.sisa_tagihan) || 0;
                }

                // Tampilkan subtotal terakhir
                if (currentGroupKey !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='4' class='text-end pe-2'>Subtotal " + currentJenisTagihan + " (" + currentTahunOrder + ")</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";

                    for (var j = 0; j < 12; j++) {
                        tableresult += "<td class='text-end'>" + todesimal(subtotalJml[j]) + "</td>";
                    }

                    tableresult += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "</tr>";
                }

                // Baris total akhir
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
}

$(document).on("submit", "#newinvoicebpjs", function (e) {
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
			$("#modal_bpjs_invoice_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_bpjs_invoice").modal("hide");
                datapiutang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_bpjs_invoice_btn").removeClass("disabled");
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

$(document).on("submit", "#editinvoicebpjs", function (e) {
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
			$("#modal_bpjs_invoice_edit_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_bpjs_invoice_edit").modal("hide");
                datapiutang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_bpjs_invoice_edit_btn").removeClass("disabled");
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

$(document).on("submit", "#pembayaran", function (e) {
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
			$("#modal_bpjs_pembayaran_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_bpjs_pembayaran").modal("hide");
                datapiutang();
                historypembayaran();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_bpjs_pembayaran_btn").removeClass("disabled");
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