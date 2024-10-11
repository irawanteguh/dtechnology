summarykpi();

function summarykpi() {
    $.ajax({
        url       : url + "index.php/profile/overview/summarykpi",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function() {
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    
                    tableresult +="<tr>";
                    tableresult +="<td>"+result[i].periode+"</td>";
                    tableresult +="<td class='text-end'>"+(result[i].hours_month ? todesimal(result[i].hours_month)  : "0")+" Minutes</td>";
                    tableresult +="<td class='text-end'>"+(result[i].dibuat ? todesimal(result[i].dibuat)  : "0")+" Minutes</td>";
                    tableresult +="<td class='text-end'>"+(result[i].wait ? todesimal(result[i].wait)  : "0")+" Minutes</td>";
                    tableresult +="<td class='text-end'>"+(result[i].approve ? todesimal(result[i].approve)  : "0")+" Minutes</td>";
                    tableresult +="<td class='text-end'>"+(result[i].tolak ? todesimal(tolak[i].tolak)  : "0")+" Minutes</td>";
                    tableresult +="<td class='text-center'>"+(result[i].presentasiactivity ? todesimal(result[i].presentasiactivity)  : "0")+"%</td>";
                    tableresult +="<td class='text-center'>"+(result[i].presentasiperilaku ? todesimal(result[i].presentasiperilaku)  : "0")+"%</td>";
                    tableresult +="<td class='text-center'>"+(result[i].resultkpi ? todesimal(result[i].resultkpi)  : "0")+"%</td>";

                    tableresult +="</tr>";
                }
            }

            $("#summmarykpi").html(tableresult);
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
        },
        complete: function() {
            toastr.clear();
        }
    });
    return false;
};