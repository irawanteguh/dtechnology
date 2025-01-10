billing();

function billing(){
    $.ajax({
        url        : url+"index.php/report/incomedaily/billing",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultbillingumum").html("");
        },
        success:function(data){
            var tableresult     = "";
            var tableresultfoot = "";
            var lastpoli        = "";
            var total           = 0;

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){
                    if(lastpoli != result[i].politujuan){
                        tableresult +="<tr>";
                        tableresult +="<td colspan='9' class='ps-4 table-warning'>"+result[i].politujuan+"</td>";
                        tableresult +="</tr>";
                    }
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].tglbilling+"</td>";
                    tableresult +="<td>"+result[i].nobilling+"</td>";
                    tableresult +="<td>"+result[i].norm+"</td>";
                    tableresult +="<td>"+result[i].namapasien+"</td>";
                    tableresult +="<td>"+result[i].provider+"</td>";
                    tableresult +="<td>"+result[i].status_lanjut+"</td>";
                    tableresult +="<td>"+result[i].politujuan+"</td>";
                    tableresult +="<td>"+result[i].namadokter+"</td>";
                    tableresult +="<td class='pe-4 text-end'>"+todesimal(result[i].grandtotal)+"</td>";
                    tableresult +="</tr>";

                    lastpoli = result[i].politujuan;
                    total = total+parseFloat(result[i].grandtotal);
                }

                tableresultfoot +="<tr>";
                tableresultfoot +="<td class='ps-4' colspan='8'>Grand Total</td>";
                tableresultfoot +="<td class='pe-4 text-end'>"+todesimal(total)+"</td>";
                tableresultfoot +="</tr>";
            }

            $("#resultbillingumum").html(tableresult);
            $("#footresultbillingumum").html(tableresultfoot);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
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
    });
    return false;
};