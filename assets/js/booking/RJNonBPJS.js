var KTCreateAccount = (function () {
    var stepper, form, nextBtn, stepperInstance;

    return {
        init: function () {
            stepper         = document.querySelector("#kt_create_account_stepper");
            form            = document.querySelector("#kt_create_account_form");
            nextBtn         = stepper.querySelector('[data-kt-stepper-action="next"]');
            stepperInstance = new KTStepper(stepper);

            stepperInstance.on("kt.stepper.next", function (e) {
                var currentStep = e.getCurrentStepIndex();

                if (currentStep === 1) {
                    var identitaspasien = document.querySelector("#identitaspasien").value;

                    if (!identitaspasien) {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>Please enter your</br>Medical Record / KTP / BPJS number!</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : { confirmButton: "btn btn-danger" },
                            showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });

                        return;
                    }

                    datapasien(identitaspasien)
                        .then(() => {
                            e.goNext();
                            KTUtil.scrollTop();
                        })
                        .catch(() => {
                            Swal.fire({
                                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                                html             : "<b>Patient data not found!</br>Please check your input.</b>",
                                icon             : "error",
                                confirmButtonText: "Please Try Again",
                                buttonsStyling   : false,
                                timerProgressBar : true,
                                timer            : 5000,
                                customClass      : { confirmButton: "btn btn-danger" },
                                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                            });
                        });

                } else {
                    e.goNext();
                    KTUtil.scrollTop();
                }
            });

            stepperInstance.on("kt.stepper.previous", function (e) {
                e.goPrevious();
                KTUtil.scrollTop();
            });
        }
    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTCreateAccount.init();
});

function datapasien(identitaspasien) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url + "index.php/booking/RJNonBPJS/datapasien",
            data: { identitaspasien: identitaspasien },
            method: "POST",
            dataType: "JSON",
            cache: false,
            success: function (data) {
                if (data.responCode === "00") {
                    let result        = data.responResult;
                    $("#nomr").val(result[0].no_rkm_medis);
                    $("#name").val(result[0].nm_pasien);
                    resolve(); // Jika data ditemukan, lanjut ke step berikutnya
                } else {
                    reject(); // Jika data tidak ditemukan, munculkan alert & tetap di step saat ini
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html: "<b>" + error + "</b>",
                    icon: "error",
                    confirmButtonText: "Please Try Again",
                    buttonsStyling: false,
                    timerProgressBar: true,
                    timer: 5000,
                    customClass: { confirmButton: "btn btn-danger" },
                    showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                    hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                });
                reject();
            }
        });
    });
}
