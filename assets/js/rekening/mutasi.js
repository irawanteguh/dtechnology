datamutasi();

$(document).on("change", "select[name='mutasi_rekeningid']", function (e) {
    e.preventDefault();
    datamutasi();
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

function datamutasi(){
    var rekeningid = $("select[name='mutasi_rekeningid']").val();
    $.ajax({
        url       : url+"index.php/rekening/mutasi/datamutasi",
        data      : {rekeningid:rekeningid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamutasi").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].rekeningname ? result[i].rekeningname : "")+"</div><div>"+(result[i].rekeningid ? result[i].rekeningid : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+(result[i].unit ? result[i].unit : "")+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";

                    if(result[i].status==="6"){
                        if(result[i].cash_in!=0){
                            tableresult +="<td><div><span class='badge badge-light-primary fs-8 fw-bold'>CR</span></div></td>";
                        }else{
                            tableresult +="<td><div><span class='badge badge-light-danger fs-8 fw-bold'>DB</span></div></td>";
                        }
                    }

                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td class='text-end pe-4'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatamutasi").html(tableresult);
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

$(document).on("submit", "#formnewpemasukan", function (e) {
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
			$("#modal_rekening_pemasukan_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_rekening_pemasukan").modal("hide");
                datamutasi();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_rekening_pemasukan_btn").removeClass("disabled");
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

$(document).on("submit", "#formnewpengeluaran", function (e) {
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
			$("#modal_rekening_pengeluaran_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_rekening_pengeluaran").modal("hide");
                datamutasi();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_rekening_pengeluaran_btn").removeClass("disabled");
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