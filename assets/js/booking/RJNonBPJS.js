var KTCreateAccount = (function () {
    var stepper, form, nextBtn, stepperInstance;

    return {
        init: function () {
            stepper = document.querySelector("#kt_create_account_stepper");
            form = document.querySelector("#kt_create_account_form");
            nextBtn = stepper.querySelector('[data-kt-stepper-action="next"]');
            stepperInstance = new KTStepper(stepper);

            stepperInstance.on("kt.stepper.next", function (e) {
                var currentStep = e.getCurrentStepIndex();

                if (currentStep === 1) {
                    var identitaspasien = document.querySelector("#identitaspasien").value;

                    if (!identitaspasien) {
                        Swal.fire({
                            title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html: "<b>Please enter your Medical Record / KTP / BPJS number!</b>",
                            icon: "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling: false,
                            timerProgressBar: true,
                            timer: 5000,
                            customClass: { confirmButton: "btn btn-danger" },
                            showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
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
                                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                                html: "<b>Patient data not found! Please check your input.</b>",
                                icon: "error",
                                confirmButtonText: "Please Try Again",
                                buttonsStyling: false,
                                timerProgressBar: true,
                                timer: 5000,
                                customClass: { confirmButton: "btn btn-danger" },
                                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                            });
                        });

                } else if (currentStep === 2) {
                    var isChecked = document.querySelector("input[name='confirm']").checked;
                    if (!isChecked) {
                        Swal.fire({
                            title: "<h1 class='font-weight-bold' style='color:#234974;'>Confirmation Required</h1>",
                            html: "<b>Please confirm that the patient's identity is correct.</b>",
                            icon: "warning",
                            confirmButtonText: "OK",
                            buttonsStyling: false,
                            customClass: { confirmButton: "btn btn-warning" },
                            showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });
                        return;
                    }

                    e.goNext();
                    KTUtil.scrollTop();
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

flatpickr('[name="date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
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
                    let result = data.responResult[0];

                    $("#nomr").val(result.no_rkm_medis);
                    $("#noktp").val(result.no_ktp);
                    $("#nobpjs").val(result.no_bpjs);
                    $("#name").val(result.nm_pasien);
                    $("#bod").val(result.tgl_lahir);
                    $("#age").val(result.umur);
                    $("#sex").val(result.jk === "L" ? "Male" : "Female");
                    $("#address").val(result.alamat);

                    resolve();
                } else {
                    reject();
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
