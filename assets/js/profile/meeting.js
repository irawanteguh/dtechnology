listmeeting();

function listmeeting() {
    $.ajax({
        url       : url + "index.php/profile/meeting/listmeeting",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function() {
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";
            var images      = ["abstract-1", "abstract-2", "abstract-3", "abstract-4"];

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    var randomImage = images[Math.floor(Math.random() * images.length)];

                    tableresult += '<div class="col-xl-4">';
                    tableresult += '<div class="card bgi-no-repeat card-xl-stretch mb-xl-8" style="background-position: right top; background-size: 30% auto; background-image: url(' + url + 'assets/images/svg/shapes/' + randomImage + '.svg)">';
                    tableresult += '<div class="card-body">';
                    tableresult += '<a href="'+result[i].url+'"  target="_blank" class="card-title fw-bolder text-muted text-hover-primary fs-4">' + result[i].category + '</a>';
                    tableresult += '<div class="fw-bolder text-primary my-6">' + result[i].date + ' '+result[i].start_time+'-'+result[i].end_time+'</div>';
                    tableresult += '<h6 class="text-dark-75 fw-bold fs-5 m-0">' + result[i].meeting + '</h6>';
                    tableresult += '<p class="text-dark-75 fw-bold fs-5 m-0 text-muted">' + result[i].description + '</p>';
                    tableresult += '</div>';
                    tableresult += '</div>';
                    tableresult += '</div>';
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