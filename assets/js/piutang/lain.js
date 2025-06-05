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

$("#modal_mcu_pembayaran").on('show.bs.modal', function(event){
    var button              = $(event.relatedTarget);
    var datapiutangid     = button.attr("datapiutangid");
    $("#modal_mcu_pembayaran_piutangid").val(datapiutangid);
});

function datapiutang(){
    $.ajax({
        url       : url+"index.php/piutang/lain/datapiutang",
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
                var result      = data.responResult;
                var tableresult = "";

                for (var i = 0; i < result.length; i++) {

                    var getvariabel =   " datapiutangid='"+result[i].piutang_id+"'";

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].no_tagihan + "</td>";
                    tableresult += "<td>" + result[i].note + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].tgldate + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].nilai) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].jmlterbayar) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(result[i].sisa) + "</td>";
                    tableresult += "<td class='text-end'><a class='btn btn-sm btn-light-success' data-bs-toggle='modal' data-bs-target='#modal_mcu_pembayaran' "+getvariabel+">Payment</a></td>";
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

function historypembayaran() {
    const startDate = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/piutang/lain/historypembayaran",
        data: { startDate: startDate },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrekappembayaran").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                var totalNilai = 0;
                var totalJml = Array(12).fill(0);
                var totalSisa = 0;

                for (var i = 0; i < result.length; i++) {
                    var row = result[i];

                    // Tambahkan baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + row.no_tagihan + "</td>";
                    tableresult += "<td>" + row.note + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(row.nilai) + "</td>";

                    for (var m = 1; m <= 12; m++) {
                        var val = parseFloat(row["jml" + m]) || 0;
                        tableresult += "<td class='text-end'>" + todesimal(val) + "</td>";
                        totalJml[m - 1] += val;
                    }

                    tableresult += "<td class='text-end pe-4'>" + todesimal(row.sisa_tagihan) + "</td>";
                    tableresult += "</tr>";

                    totalNilai += parseFloat(row.nilai) || 0;
                    totalSisa += parseFloat(row.sisa_tagihan) || 0;
                }

                // TFOOT: total
                var footresult = "<tr class='fw-bold bg-light'>";
                footresult += "<td colspan='2' class='text-end pe-2'>TOTAL</td>";
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


$(document).on("submit", "#formnewinvoice", function (e) {
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