datapiutang();

flatpickr('[name="modal_mcu_invoice_date"]', {
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
                var subtotal = 0;
            
                for (var i = 0; i < result.length; i++) {
                    var item = result[i];
            
                    // Deteksi pergantian rekanan
                    if (item.rekanan !== currentRekanan) {
                        // Jika bukan pertama dan ada subtotal sebelumnya, tampilkan subtotal dulu
                        if (currentRekanan !== "") {
                            tableresult += "<tr class='fw-bold bg-warning'>";
                            tableresult += "<td colspan='4' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(subtotal) + "</td>";
                            tableresult += "<td class='text-end'>0</td>";
                            tableresult += "<td class='text-end'>0</td>";
                            tableresult += "<td class='text-end'></td>";
                            tableresult += "</tr>";
                        }
            
                        // Reset subtotal dan set rekanan baru
                        currentRekanan = item.rekanan;
                        subtotal = 0;
                    }
            
                    // Tampilkan baris data
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + item.no_tagihan + "</td>";
                    tableresult += "<td>" + item.note + "</td>";
                    tableresult += "<td>" + item.rekanan + "</td>";
                    tableresult += "<td class='text-center'>" + item.tgldate + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.nilai) + "</td>";
                    tableresult += "<td class='text-end'>0</td>";
                    tableresult += "<td class='text-end'>0</td>";
                    tableresult += "<td class='text-end'><a class='btn btn-sm btn-light-success'>Payment</a></td>";
                    tableresult += "</tr>";
            
                    subtotal += parseFloat(item.nilai);
                }
            
                // Subtotal terakhir setelah loop selesai
                if (currentRekanan !== "") {
                    tableresult += "<tr class='fw-bold bg-warning'>";
                    tableresult += "<td colspan='4' class='text-end pe-4'>Subtotal " + currentRekanan + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(subtotal) + "</td>";
                    tableresult += "<td class='text-end'>0</td>";
                    tableresult += "<td class='text-end'>0</td>";
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