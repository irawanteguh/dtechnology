listmeeting();

function listmeeting() {
    $.ajax({
        url       : url + "index.php/meeting/Schedulemeeting/listmeeting",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function() {
            $("#listmeeting").html("");
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";
            var images      = ["abstract-1", "abstract-2", "abstract-3", "abstract-4"];

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    var randomImage = images[Math.floor(Math.random() * images.length)];

                    tableresult +="<div class='col-xl-4'>";
                        tableresult +="<div class='overflow-hidden position-relative card-rounded mb-xl-8'>";
                                tableresult +="<div class='card ribbon ribbon-top ribbon-vertical bgi-no-repeat card-xl-stretch' style='background-position: right top; background-size: 30% auto; background-image: url(\""+url+"assets/images/svg/shapes/"+randomImage+".svg\")'>";
                                    tableresult +="<div class='card-body'>";
                                        tableresult += "<a href='"+result[i].url+"' target='_blank' title='Klik Untuk Mendapatkan Link Meeting' class='card-title fw-bolder text-muted text-hover-primary fs-4'>'"+result[i].category+"</a>";
                                        tableresult += "<div class='fw-bolder text-primary my-6'>"+result[i].date+" "+result[i].start_time+"-"+result[i].end_time+"</div>";
                                        tableresult += "<h6 class='text-dark-75 fw-bold fs-5 m-0'>"+result[i].meeting+"</h6>";
                                        tableresult += "<p class='text-dark-75 fw-bold fs-5 m-0 text-muted'>"+result[i].description+"</p>";
                                    tableresult +="</div>";
                                tableresult +="</div>";

                                if(result[i].kategori_id === "0"){
                                    tableresult +="<div class='ribbon ribbon-triangle ribbon-bottom-start border-danger'>";
                                        tableresult +="<div class='ribbon-icon mt-0 ms-n6'>";
                                            tableresult +="<i class='bi bi-person text-white'></i>";
                                        tableresult +="</div>";
                                    tableresult +="</div>";
                                }else{
                                    tableresult +="<div class='ribbon ribbon-triangle ribbon-bottom-start border-primary'>";
                                        tableresult +="<div class='ribbon-icon mt-0 ms-n6'>";
                                            tableresult +="<i class='bi bi-people text-white'></i>";
                                        tableresult +="</div>";
                                    tableresult +="</div>";
                                }

                        tableresult +="</div>";
                    tableresult +="</div>";

                    // tableresult += '<div class="col-xl-4">';
                    // tableresult += '<div class="card bgi-no-repeat card-xl-stretch mb-xl-8 ribbon ribbon-start" style="background-position: right top; background-size: 30% auto; background-image: url(' + url + 'assets/images/svg/shapes/' + randomImage + '.svg)">';
                    // tableresult += "<div class='ribbon-label bg-primary'>Ribbon</div>";
                    // tableresult += '<div class="card-body">';
                    // tableresult += '<a href="'+result[i].url+'"  target="_blank" class="card-title fw-bolder text-muted text-hover-primary fs-4">' + result[i].category + '</a>';
                    // tableresult += '<div class="fw-bolder text-primary my-6">' + result[i].date + ' '+result[i].start_time+'-'+result[i].end_time+'</div>';
                    // tableresult += '<h6 class="text-dark-75 fw-bold fs-5 m-0">' + result[i].meeting + '</h6>';
                    // tableresult += '<p class="text-dark-75 fw-bold fs-5 m-0 text-muted">' + result[i].description + '</p>';
                    // tableresult += '</div>';
                    // tableresult += '</div>';
                    // tableresult += '</div>';
                }
            }

            $("#listmeeting").html(tableresult);
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