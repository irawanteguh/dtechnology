historyposition();

function historyposition() {
    $.ajax({
        url       : url + "index.php/profile/position/historyposition",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
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
                    
                    tableresult +="<tr>";
                    
                    tableresult +="<td>";
                    tableresult +="<div class='d-flex align-items-center'>";

                        tableresult +="<div class='symbol symbol-45px me-5'>";
                        if(result[i].photoprofile==="N"){
                            tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initial+"</div>";
                        }else{
                            tableresult +="<img src='"+url+"assets/images/avatars/"+result[i].atasan_id+".jpeg' alt='"+result[i].name+"'>";
                        }
                        tableresult +="</div>";

                        tableresult +="<div class='d-flex justify-content-start flex-column'>";
                        tableresult +="<a href='#' class='text-dark fw-bolder text-hover-primary fs-6'>"+result[i].position+"</a>";
                        tableresult +="<span class='fw-bold text-muted d-block fs-7'>"+result[i].nameatasan+"</span>";
                        tableresult +="</div>";

                    tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="<td><div>"+(result[i].START_DATE ? result[i].START_DATE : "")+"</div><div>"+(result[i].END_DATE ? result[i].END_DATE : "")+"</div></td>";
                    if(result[i].position_primary === "Y"){
                        tableresult +="<td><div class='badge badge-light-primary fw-bolder'>Primary</div></td>";
                    }else{
                        tableresult +="<td><div class='badge badge-light-warning fw-bolder'>Secondry</div></td>";
                    }
                    if(result[i].status === "1"){
                        tableresult +="<td><div class='badge badge-light-success fw-bolder'>Active</div></td>";
                    }else{
                        tableresult +="<td><div class='badge badge-light-danger fw-bolder'>In Active</div></td>";
                    }
                    tableresult +="<td class='text-end pe-4'><span class='fw-bold d-block fs-7'>"+result[i].dibuatoleh+"</span><span class='fw-bold text-muted d-block fs-7'>"+result[i].CREATED_DATE+"</span></td>";
                    tableresult +="</tr>";
                }
            }

            $("#historyposition").html(tableresult);
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