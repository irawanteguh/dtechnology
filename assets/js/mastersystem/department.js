masterdepartment();

function masterdepartment(){
    $.ajax({
        url       : url+"index.php/mastersystem/department/masterdepartment",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterdepartment").html("");
        },
        success:function(data){
            var result = "";
            var jml    = 0;

            var tableresult = "";
            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + (result[i].name ? result[i].name : "") + "</td>";
                    tableresult += "<td class='text-start ps-4'>" + (result[i].partof ? result[i].partof : "") + "</td>";
                    tableresult += "</tr>";

                    jml ++;
                }
            }


            $("#resultmasterdepartment").html(tableresult);
            $("#info_list_activity").html(todesimal(jml)+" Activity");
            toastr[data.responHead](data.responDesc, "INFORMATION");
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