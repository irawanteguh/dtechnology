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

$("#modal_mcu_pembayaran").on('show.bs.modal', function(event){
    var button              = $(event.relatedTarget);
    var datapiutangid     = button.attr("datapiutangid");
    $("#modal_mcu_pembayaran_piutangid").val(datapiutangid);
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

function datapiutang(){
    $.ajax({
        url       : url+"index.php/piutang/mcu/datapiutang",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappiutang").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                var tableresult = "";
                var currentRekanan = "";
                var subtotalNilai = 0;
                var subtotalTerbayar = 0;
                var subtotalSisa = 0;

                for (var i = 0; i < result.length; i++) {
                    var item = result[i];

                    // Deteksi pergantian rekanan
                    if (item.rekanan !== currentRekanan) {
                        // Jika bukan pertama dan ada subtotal sebelumnya, tampilkan subtotal dulu
                        if (currentRekanan !== "") {
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='4' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                            tableresult += "<td class='text-end'></td>";
                            tableresult += "</tr>";
                        }

                        // Reset subtotal dan set rekanan baru
                        currentRekanan = item.rekanan;
                        subtotalNilai = 0;
                        subtotalTerbayar = 0;
                        subtotalSisa = 0;
                    }

                    var getvariabel =   " datapiutangid='"+result[i].piutang_id+"'";

                    // Tampilkan baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + item.no_tagihan + "</td>";
                    tableresult += "<td>" + item.note + "</td>";
                    tableresult += "<td>" + item.rekanan + "</td>";
                    tableresult += "<td class='text-center'>" + item.tgldate + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.nilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.jmlterbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.sisa) + "</td>";
                    tableresult += "<td class='text-end'><a class='btn btn-sm btn-light-success' data-bs-toggle='modal' data-bs-target='#modal_mcu_pembayaran' "+getvariabel+">Payment</a></td>";
                    tableresult += "</tr>";

                    // Tambahkan ke subtotal
                    subtotalNilai += parseFloat(item.nilai);
                    subtotalTerbayar += parseFloat(item.jmlterbayar);
                    subtotalSisa += parseFloat(item.sisa);
                }

                // Subtotal terakhir setelah loop selesai
                if (currentRekanan !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='4' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalTerbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "<td class='text-end'></td>";
                    tableresult += "</tr>";
                }
            }

            

            $("#resultrekappiutang").html(tableresult);

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
                            tableresult += "<td colspan='3' class='text-end pe-2'>Subtotal " + currentProvider + "</td>";
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
                    tableresult += "<td colspan='3' class='text-end pe-2'>Subtotal " + currentProvider + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotalNilai) + "</td>";

                    for (var j = 0; j < 12; j++) {
                        tableresult += "<td class='text-end'>" + todesimal(subtotalJml[j]) + "</td>";
                    }

                    tableresult += "<td class='text-end pe-4'>" + todesimal(subtotalSisa) + "</td>";
                    tableresult += "</tr>";
                }

                // TFOOT: total
                var footresult = "<tr class='fw-bold bg-light'>";
                footresult += "<td colspan='3' class='text-end pe-2'>TOTAL</td>";
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