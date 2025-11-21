masterenvironment();

function masterenvironment() {
    $.ajax({
        url        : url + "index.php/operation/environment/masterenvironment",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr.info("Sending request...", "Please wait");
            $("#resultdatatilaka").empty();
            $("#resultdataetc").empty();
        },

        success: function (data) {
            let tilakaHTML = "";
            let otherHTML  = "";

            if (data.responCode === "00") {
                const result = data.responResult;

                result.forEach(item => {
                    const labelName = item.environment_name.replace(/_/g, " ");
                    const row = `
                                    <div class="col-md-12 mb-5">
                                        <div class="fv-row">
                                            <label class="fs-6 fw-bold mb-2">${labelName}</label>

                                            <div class="d-flex justify-content-between gap-3 flex-wrap">

                                                <div class="flex-fill" style="min-width:250px;">
                                                    <label for="${item.env_id}_dev" class="form-label">Development</label>
                                                    <input class="form-control form-control-solid"
                                                        id="${item.env_id}_dev"
                                                        name="${item.env_id}_dev"
                                                        value="${item.dev}"
                                                        placeholder="Silakan Masukan ${labelName} Development"
                                                        type="text">
                                                </div>

                                                <div class="flex-fill" style="min-width:250px;">
                                                    <label for="${item.env_id}_prod" class="form-label">Production</label>
                                                    <input class="form-control form-control-solid"
                                                        id="${item.env_id}_prod"
                                                        name="${item.env_id}_prod"
                                                        value="${item.prod}"
                                                        placeholder="Silakan Masukan ${labelName} Production"
                                                        type="text">
                                                </div>

                                                <div class="d-flex align-items-end">
                                                    <button class="btn btn-primary"
                                                            onclick="saveEnvironment('${item.env_id}')">
                                                        Simpan
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                `;


                    // Masukkan HTML berdasarkan kategori jenis
                    if (item.jenis === "1") {
                        tilakaHTML += row;
                    } else {
                        otherHTML += row;
                    }
                });
            }

            $("#resultdatatilaka").html(tilakaHTML);
            $("#resultdataetc").html(otherHTML);

            toastr[data.responHead](data.responDesc, "INFORMATION");
        },

        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : `<b>${error}</b>`,
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
}



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