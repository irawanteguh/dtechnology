// log();

function log(){
    $.ajax({
        url       : url+"index.php/root/log/log",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#logservice").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            
            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    tableresult +="<div class='d-flex flex-stack py-4'>";
                        tableresult +="<div class='d-flex align-items-center me-2'>";
                            tableresult +="<span class='w-70px badge badge-light-success me-4'>"+result[i].response_status+"</span>";
                            tableresult +="<a href='#' class='text-gray-800 text-hover-primary fw-bold'>"+result[i].source+"</a>";
                        tableresult +="</div>";
                        tableresult +="<span class='badge badge-light fs-8'>"+result[i].created_date+"</span>";
                    tableresult +="</div>";
                }
            }


            $("#logservice").html(tableresult);
        },
        complete: function () {
			//
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