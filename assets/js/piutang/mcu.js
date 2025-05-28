datapiutang();

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

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>" + result[i].no_tagihan+"</td>";
                    tableresult +="<td><div>"+result[i].note+"</div><div class='badge badge-light-info'>"+result[i].rekanan+"</div></td>";
                    tableresult +="<td class='text-center'>"+result[i].createddate+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].nilai)+"</td>";
                    tableresult +="<td class='text-end'>0</td>";
                    tableresult +="<td class='text-end pe-4'>0</td>";
                    tableresult +="</tr>";
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