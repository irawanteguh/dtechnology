datatransaksi();

function datatransaksi(){
    $.ajax({
        url       : url+"index.php/casemix/validdoc/datatransaksi",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultlistregistrasi").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].no_rawat + "</td>";
                    tableresult += "<td>" + result[i].tanggalmasuk + "</td>";
                    tableresult += "<td>" + result[i].no_rkm_medis + "</td>";
                    tableresult += "<td>" + result[i].namapasien + "</td>";
                    tableresult += "<td>" + result[i].poliklinik + "</td>";
                    tableresult += "<td>" + result[i].namadokter + "</td>";
                    tableresult += "<td>" + result[i].provider + "</td>";
                    tableresult += "<td class='text-end pe-4'></td>";
                    tableresult += "</tr>";
                }
            }


            $("#resultlistregistrasi").html(tableresult);
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
