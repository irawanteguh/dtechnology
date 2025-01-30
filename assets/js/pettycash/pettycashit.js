datapettycash();

function datapettycash(){
    $.ajax({
        url       : url+"index.php/pettycash/pettycashit/datapettycash",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapettycash").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td>"+result[i].tglbuat+"</td>";
                    tableresult +="<td>"+result[i].dibuatoleh+"</td>";
                    tableresult +="<td></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatapettycash").html(tableresult);
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
			$("#btn_new_pengeluaran").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_pettycash_pengeluaran").modal("hide");
                datapettycash();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_pengeluaran").removeClass("disabled");
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