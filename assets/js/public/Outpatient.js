document.querySelectorAll('[data-kt-plan]').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        // Hapus kelas 'active' dari semua tombol
        document.querySelectorAll('[data-kt-plan]').forEach(b => b.classList.remove('active'));

        // Tambahkan kelas 'active' ke tombol yang diklik
        this.classList.add('active');

        // Ambil data target yang diklik
        const target = this.getAttribute('data-kt-plan');

        // Sembunyikan semua konten
        document.querySelectorAll('.plan-content').forEach(div => {
            div.classList.add('d-none');
        });

        // Tampilkan konten yang sesuai
        document.getElementById(target).classList.remove('d-none');
    });
});

flatpickr('[name="booking_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : new Date().fp_incr(1),
    maxDate   : new Date().fp_incr(7),
    onChange  : function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            const days        = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const selectedDay = days[selectedDates[0].getDay()];
            const dayID       = selectedDates[0].getDay();

            $("input[name='booking_hariid']").val(dayID);
            $("select[name='booking_poliid']").trigger("change");
        }

        instance.close();
    }
});

var KTCreateAccount = (function () {
    var stepper, form, nextBtn, prevBtn, stepperInstance;

    return {
        init: function () {
            stepper         = document.querySelector("#kt_create_account_stepper");
            form            = document.querySelector("#formbooking");
            nextBtn         = stepper.querySelector('[data-kt-stepper-action="next"]');
            prevBtn         = stepper.querySelector('[data-kt-stepper-action="previous"]'); // Tombol Previous
            stepperInstance = new KTStepper(stepper);

            // 🔹 Sembunyikan tombol Previous di Step 4
            stepperInstance.on("kt.stepper.changed", function () {
                var currentStep = stepperInstance.getCurrentStepIndex();

                if (currentStep === 4) {
                    prevBtn.style.display = "none";  // Sembunyikan tombol Previous di Step 4
                } else {
                    prevBtn.style.display = "";      // Munculkan tombol Previous jika bukan Step 4
                }
            });

            stepperInstance.on("kt.stepper.next", function (e) {
                var currentStep = e.getCurrentStepIndex();

                if (currentStep === 1) {
                    var identitaspasien = document.querySelector("#identitaspasien").value;

                    if (!identitaspasien) {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>Please enter your Medical Record / KTP / BPJS number!</b>",
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

                    datapasien(identitaspasien).then(() => {
                        e.goNext();
                        // KTUtil.scrollTop();
                    }).catch(() => {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>Patient data not found! Please check your input.</b>",
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
                } else if (currentStep === 2) {
                    var isChecked = document.querySelector("input[name='booking_confirm']").checked;

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
                    // KTUtil.scrollTop();
                } else if (currentStep === 3) {
                    var selectedJadwal = document.querySelector("input[name='booking_jadwal_poli_id']:checked");

                    if (!selectedJadwal) {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>Selection Required</h1>",
                            html             : "<b>Please select a doctor's schedule before proceeding.</b>",
                            icon             : "warning",
                            confirmButtonText: "OK",
                            buttonsStyling   : false,
                            customClass      : { confirmButton: "btn btn-warning" },
                            showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });
                        return;
                    }

                    simpanData().then(() => {
                        e.goNext();
                        // KTUtil.scrollTop();
                    }).catch((error) => {
                        Swal.fire({
                            title: "<h1 class='font-weight-bold' style='color:#234974;'>Error</h1>",
                            html: "<b>" + error + "</b>",
                            icon: "error",
                            confirmButtonText: "Retry",
                            buttonsStyling: false,
                            customClass: { confirmButton: "btn btn-danger" },
                            showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                            hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                        });
                    });
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
            url     : url + "index.php/public/outpatient/datapasien",
            data    : {identitaspasien:identitaspasien},
            method  : "POST",
            dataType: "JSON",
            cache   : false,
            success : function (data) {
                if(data.responCode === "00"){

                    let result = data.responResult[0];

                    $("#booking_nomr").val(result.no_rkm_medis);
                    $("#booking_noktp").val(result.no_ktp);
                    $("#booking_nobpjs").val(result.no_peserta);
                    $("#booking_name").val(result.nm_pasien);
                    $("#booking_bod").val(result.tgllahir);
                    $("#booking_age").val(result.umur);
                    $("#booking_sex").val(result.jk === "L" ? "Male" : "Female");
                    $("#booking_address").val(result.alamat);

                    resolve();
                } else {
                    reject();
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html             : "<b>" + error + "</b>",
                    icon             : "error",
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : { confirmButton: "btn btn-danger" },
                    showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                    hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                });
                reject();
            }
        });
    });
};