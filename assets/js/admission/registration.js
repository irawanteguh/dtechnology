request();

function request(){
    $.ajax({
        url       : url+"index.php/admission/registration/request",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrequest").html("");
        },
        success:function(data){
            var tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    
                    
                    tableresult +="<tr>";
                    if(result[i].source==="OK"){
                        tableresult +="<td><span class='badge badge-light-info'>Operasi Elektif</span></td>";
                        tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div><div>"+(result[i].phone ? result[i].phone : "")+"</div></td>";
                        tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";

                        var arraydiagnosis = result[i].diagnosis ? result[i].diagnosis.split(';') : [];
                        tableresult +="<td>";
                        tableresult +="<div>Medical Treatment :</div><div>"+(result[i].package ? result[i].package : "")+"</div><br><div>Diagnosis :</div><div>";
                        for (var j = 0; j < arraydiagnosis.length; j++) {
                            tableresult +="<div class='fst-italic small'>"+arraydiagnosis[j]+"</div>";
                        }
                        tableresult += "</td>";
                        tableresult +="<td>"+(result[i].kelas ? result[i].kelas : "")+"</td>";
                        tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                        tableresult +="<td><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";

                    }
                    tableresult +="</tr>";
                }
            }


            $("#resultrequest").html(tableresult);
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