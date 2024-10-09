masterenvironment();

function masterenvironment(){
    $.ajax({
        url       : url+"index.php/operation/environment/masterenvironment",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultenvironment").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for (let i in result) {
                    tableresult += "<div class='col-md-12 mb-5'>";
                    tableresult += "<div class='fv-row'>";
                    tableresult += "<label class='fs-6 fw-bold mb-2'>" + result[i].environment_name.replace(/_/g, " ") + "</label>";
                    tableresult += "<div class='row'>";
                    tableresult += "<div class='col-xl-5'>";
                    tableresult += "<label for='" + result[i].env_id + "_dev' class='form-label'>Development</label>";
                    tableresult += "<input class='form-control form-control-solid flatpickr-input' name='" + result[i].env_id + "_dev' placeholder='Silakan Masukan " + result[i].environment_name.replace(/_/g, " ") + " Development' id='" + result[i].env_id + "_dev' value='" + result[i].dev + "' type='text'>";
                    tableresult += "</div>";
                    tableresult += "<div class='col-xl-5'>";
                    tableresult += "<label for='" + result[i].env_id + "_prod' class='form-label'>Production</label>";
                    tableresult += "<input class='form-control form-control-solid flatpickr-input' name='" + result[i].env_id + "_prod' placeholder='Silakan Masukan " + result[i].environment_name.replace(/_/g, " ") + " Production' id='" + result[i].env_id + "_prod' value='" + result[i].prod + "' type='text'>";
                    tableresult += "</div>";
                    tableresult += "<div class='col-xl-2 d-flex align-items-end'>";
                    tableresult += "<button class='btn btn-primary mt-3 mt-xl-0' onclick='saveEnvironment(\"" + result[i].env_id + "\")'>Simpan</button>";
                    tableresult += "</div>";
                    tableresult += "</div>"; // Close row
                    tableresult += "</div>"; // Close fv-row
                    tableresult += "</div>"; // Close col-md-12


                }
            }


            $("#resultenvironment").html(tableresult);
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

function saveEnvironment(envId) {
    let devValue = document.getElementById(envId + "_dev").value;
    let prodValue = document.getElementById(envId + "_prod").value;

    // Perform AJAX request to update the environment
    fetch(url + "index.php/operation/environment/updateenvironment", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            envid: envId,
            dev  : devValue,
            prod : prodValue
        })
    })
    .then(response => response.json())
    .then(data => {
        toastr[data.responHead](data.responDesc, "INFORMATION");
    })
    .catch(error => {
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
    });
}