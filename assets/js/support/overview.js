dataeticket();

function dataeticket(){
    $.ajax({
        url        : url+"index.php/support/overview/dataeticket",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataeticket").html("");
        },
        success:function(data){
           
            var tableresult      = "";

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){
                    tableresult +="<div class='d-flex mb-10'>";
                        tableresult +="<span class='svg-icon svg-icon-2x me-5 ms-n1 mt-2 svg-icon-warning'>";
                            tableresult +="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path opacity='0.3' d='M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 13H13V10C13 9.4 12.6 9 12 9C11.4 9 11 9.4 11 10V13H8C7.4 13 7 13.4 7 14C7 14.6 7.4 15 8 15H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V15H16C16.6 15 17 14.6 17 14C17 13.4 16.6 13 16 13Z' fill='black' /><path d='M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z' fill='black' /></svg>";
                        tableresult +="</span>";    
                        tableresult +="<div class='d-flex flex-column'>";
                            tableresult +="<div class='d-flex align-items-center mb-2'>";
                                tableresult +="<a href='../../demo1/dist/apps/support-center/tickets/view.html' class='text-dark text-hover-primary fs-4 me-3 fw-bold'>"+result[i].SUBJECT+"</a>";
                                tableresult +="<span class='badge badge-light my-1'>Angular</span>";
                            tableresult +="</div>";
                            tableresult +="<span class='text-muted fw-bold fs-6'>"+result[i].DESCRIPTION+"</span>";
                        tableresult +="</div>";
                       
                    tableresult +="</div>";
                }
            }

            $("#resultdataeticket").html(tableresult);

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