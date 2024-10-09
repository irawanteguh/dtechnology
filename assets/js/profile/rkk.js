listrkk();

function listrkk() {
    $.ajax({
        url       : url + "index.php/profile/rkk/listrkk",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function() {
            $("#resultrkk").html("");
            $("#info_list_rkk").html("");
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";
            var jml = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].activity+"</td>";
                    tableresult +="<td class='pe-4 text-end'>"+result[i].jenjangklinis+"</td>";
                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultrkk").html(tableresult);
            $("#info_list_rkk").html("List Of Clinical Authority : "+jml);
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