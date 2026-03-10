datakaryawan();

function datakaryawan() {
    $.ajax({
        url     : url + "index.php/profile/connection/datakaryawan",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function() {
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];


            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    tableresult +="<div class='col-md-6 col-xxl-4'>";
                    tableresult +="<div class='card'>";
                    tableresult +="<div class='card-body d-flex flex-center flex-column p-9'>";
                        tableresult +="<div class='symbol symbol-65px symbol-circle mb-5'>";
                            if(result[i].image_profile==="N"){
                                tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initial+"</div>";
                            }else{
                                tableresult +="<img src='"+url+"assets/images/avatars/"+result[i].user_id+".jpeg' alt='"+result[i].name+"'>";
                            }
                            tableresult +="<div class='bg-success position-absolute rounded-circle translate-middle start-100 top-100 border border-4 border-white h-15px w-15px ms-n3 mt-n3'></div>";
                        tableresult +="</div>";
                        tableresult +="<a href='#' class='fs-4 text-gray-800 text-hover-primary fw-bolder mb-0'>"+result[i].name+"</a>";
                        tableresult +="<div class='fw-bold text-gray-400 mb-6'>"+(result[i].position ? result[i].position : "-")+"</div>";
                        tableresult +="<div class='d-flex flex-center flex-wrap mb-5'>";
                            if(result[i].staff === "Y"){
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                    tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center' data-kt-countup='true' data-kt-countup-value='70' data-kt-countup-prefix='%'>70</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>Aktivitas</div>";
                                tableresult +="</div>";
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center' data-kt-countup='true' data-kt-countup-value='30' data-kt-countup-prefix='%'>30</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>perilaku</div>";
                                tableresult +="</div>";
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                    tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center' data-kt-countup='true' data-kt-countup-value='100' data-kt-countup-prefix='%'>100</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>Total</div>";
                                tableresult +="</div>";
                            }else{
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                    tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center'>N/A</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>Aktivitas</div>";
                                tableresult +="</div>";
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                    tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center'>N/A</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>perilaku</div>";
                                tableresult +="</div>";
                                tableresult +="<div class='border border-dashed rounded min-w-50px py-3 px-4 mx-3 mb-3'>";
                                    tableresult +="<div class='fs-6 fw-bolder text-gray-700 d-flex justify-content-center'>N/A</div>";
                                    tableresult +="<div class='fw-bold text-gray-400 d-flex justify-content-center'>Total</div>";
                                tableresult +="</div>";
                            }
                        tableresult +="</div>";
                        if(result[i].staff === "Y"){
                            tableresult +="<a href='#' class='btn btn-sm btn-light-primary'>";
                                tableresult +="<span class='svg-icon svg-icon-3'>";
                                    tableresult +="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>";
                                        tableresult +="<path opacity='0.3' d='M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z' fill='black'></path>";
                                        tableresult +="<path d='M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z' fill='black'></path>";
                                    tableresult +="</svg>";
                                tableresult +="</span>";
                            tableresult +="Connected";
                            tableresult +="</a>";
                        }else{
                            tableresult +="<a href='#' class='btn btn-sm btn-light'>";
                                tableresult +="<span class='svg-icon svg-icon-3'>";
                                    tableresult +="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>";
                                        tableresult +="<rect opacity='0.5' x='11.364' y='20.364' width='16' height='2' rx='1' transform='rotate(-90 11.364 20.364)' fill='black'></rect>";
                                        tableresult +="<rect x='4.36396' y='11.364' width='16' height='2' rx='1' fill='black'></rect>";
                                    tableresult +="</svg>";
                                tableresult +="</span>";
                            tableresult +="Connect";
                            tableresult +="</a>";
                        }
                    tableresult +="</div>";
                    tableresult +="</div>";
                    tableresult +="</div>";
                }
            }

            $("#datakaryawan").html(tableresult);
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