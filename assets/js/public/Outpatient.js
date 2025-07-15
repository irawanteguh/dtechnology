Dropzone.autoDiscover = false;
let myDropzone;


document.querySelectorAll('[data-kt-plan]').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('[data-kt-plan]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const target = this.getAttribute('data-kt-plan');
        document.querySelectorAll('.plan-content').forEach(div => {
            div.classList.add('d-none');
        });
        document.getElementById(target).classList.remove('d-none');
    });
});

flatpickr('[name="booking_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
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
        booking: function () {
            stepper         = document.querySelector("#stepper_booking");
            form            = document.querySelector("#formbooking");
            nextBtn         = stepper.querySelector('[data-kt-stepper-action="next"]');
            prevBtn         = stepper.querySelector('[data-kt-stepper-action="previous"]');
            stepperInstance = new KTStepper(stepper);

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
        },
        saran: function () {
            const stepper         = document.querySelector("#stepper_saran");
            const form            = document.querySelector("#formsaran");
            const nextBtn         = stepper.querySelector('[data-kt-stepper-action="next"]');
            const prevBtn         = stepper.querySelector('[data-kt-stepper-action="previous"]');
            const stepperInstance = new KTStepper(stepper);

            stepperInstance.on("kt.stepper.changed", function () {
                var currentStep = stepperInstance.getCurrentStepIndex();
                if (currentStep === 4) {
                    prevBtn.style.display = "none";
                } else {
                    prevBtn.style.display = "";
                }
            });

            stepperInstance.on("kt.stepper.next", function (e) {
                var currentStep = e.getCurrentStepIndex();

                // === STEP 1: Validasi Identitas ===
                if (currentStep === 1) {
                    const nama = $("#namapasiensaran").val().trim();
                    const noktp = $("#noktppasiensaran").val().trim();
                    const notelp = $("#notlpsaran").val().trim();

                    if (nama === "" || noktp === "" || notelp === "") {
                        Swal.fire({
                            title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html: "<b>Silakan lengkapi Nama, No KTP/BPJS, dan No Telepon sebelum melanjutkan.</b>",
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
                }

                // === STEP 2: Validasi Masukan dan UUID ===
                if (currentStep === 2) {
                    const sarandanmasukansaran = $("#sarandanmasukansaran").val();

                    if (sarandanmasukansaran === "") {
                        Swal.fire({
                            title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html: "<b>Silakan lengkapi Saran dan Masukan Anda.</b>",
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

                    // Generate UUID dan set ke field
                    const uuid = crypto.randomUUID();
                    $("#saranmasukanid").val(uuid);

                    // Inisialisasi Dropzone upload file bukti
                    if (window.myDropzone) {
                        window.myDropzone.destroy();
                    }

                    window.myDropzone = new Dropzone("#file_bukti", {
                        url               : url + "index.php/public/outpatient/uploadbukti?transid="+uuid,
                        paramName         : "file",
                        dictDefaultMessage: "Drop files here or click to upload",
                        maxFiles          : 1,
                        maxFilesize       : 2,
                        addRemoveLinks    : true,
                        autoProcessQueue  : true,
                        init: function () {
                            this.on("success", function (file, response) {
                                // Swal.fire({
                                //     title: "<h1 class='font-weight-bold' style='color:#234974;'>Upload Berhasil</h1>",
                                //     html: "<b>File bukti berhasil diunggah.</b>",
                                //     icon: "success",
                                //     confirmButtonText: "OK",
                                //     buttonsStyling: false,
                                //     customClass: { confirmButton: "btn btn-success" },
                                //     showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                                //     hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                                // });
                            });

                            this.on("error", function (file, errorMessage) {
                                Swal.fire({
                                    title: "<h1 class='font-weight-bold' style='color:#234974;'>Upload Gagal</h1>",
                                    html: "<b>Gagal mengunggah file bukti. Pastikan file adalah PDF dan ukurannya di bawah 2MB.</b>",
                                    icon: "error",
                                    confirmButtonText: "Coba Lagi",
                                    buttonsStyling: false,
                                    customClass: { confirmButton: "btn btn-danger" },
                                    showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                                    hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                                });
                            });
                        }
                    });
                }

                // === STEP 3: Submit ke server ===
                if (currentStep === 3) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: url + "index.php/public/outpatient/insertsaran",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType   : "JSON",
                        cache: false,
                        beforeSend: function () {
                            Swal.fire({
                                title: "<h1 class='font-weight-bold' style='color:#234974;'>Mengirim...</h1>",
                                html: "<b>Mohon tunggu, data sedang diproses.</b>",
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                        },
                        success: function (data) {
                            Swal.close();

                            if (data.responCode === "00") {
                                $("#namapasiensaranresponse").html(data.responResult[0].nama);
                                $("#codesaranresponse").html(data.responResult[0].code);

                                var qrcode = new QRCode(document.getElementById("qrcode_saran"), {
                                    text    : data.responResult[0].code,
                                    width   : 128,
                                    height  : 128,
                                    colorDark : "#000000",
                                    colorLight: "#ffffff",
                                    correctLevel: QRCode.CorrectLevel.H // High error correction
                                });
                                
                                e.goNext();
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    html: "<b>Gagal menyimpan data. Silakan coba kembali.</b>",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Error!",
                                html: "<b>Terjadi kesalahan saat menghubungi server.</b>",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });

                    return; // STOP auto next
                }

                e.goNext();
            });

            stepperInstance.on("kt.stepper.previous", function (e) {
                e.goPrevious();
                KTUtil.scrollTop();
            });
        }


    };
})();

document.addEventListener("DOMContentLoaded", function () {
    KTCreateAccount.booking();
    KTCreateAccount.saran();
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

function jadwaldokter() {
    var poliid   = $("select[name='booking_poliid']").val();
    var dokterid = $("select[name='booking_doctorid']").val();
    var hariid   = $("input[name='booking_hariid']").val();
    var date     = $("input[name='booking_date']").val();

    $.ajax({
        url     : url + "index.php/public/outpatient/jadwaldokter",
        data    : {poliid:poliid,dokterid:dokterid,hariid:hariid,date:date},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        success : function (data) {
            var result      = "";
            var tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    tableresult += "<div class='col-md-6 col-lg-12 col-xxl-6'>";
                        tableresult += "<label class='btn btn-outline btn-outline-dashed border-primary border-3 btn-outline-default d-flex text-start p-6' data-kt-button='true'>";
                            tableresult += " <span class='form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1 is-valid'>";
                                tableresult += " <input class='form-check-input' type='radio' name='booking_jadwal_poli_id' value='"+result[i].slot+"_"+result[i].kuota_online+"_"+result[i].antrian+"_"+result[i].sisakuota+"_"+result[i].jam_mulai+"_"+result[i].jam_selesai+"_"+result[i].seqnorawat+"'>";
                            tableresult += "</span>";
                            tableresult += "<span class='ms-5'>";
                                tableresult += "<span class='fs-4 fw-bolder text-gray-800 mb-2 d-block'>[" +result[i].slot+"] "+result[i].jam_mulai + " - " + result[i].jam_selesai + "</span>";
                                tableresult += "<span class='fw-bold fs-7 text-gray-600'>Kuota : " + result[i].kuota_online + "</span></br>";
                                tableresult += "<span class='fw-bold fs-7 text-gray-600'>Sisa Kuota : " + result[i].sisakuota + "</span>";
                            tableresult += "</span>";
                        tableresult += "</label>";
                    tableresult += "</div>";
                }
            }

            $("#jadwaldokter").html(tableresult);
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
        }
    });
};

function simpanData() {
    return new Promise((resolve, reject) => {
        var form = new FormData(document.querySelector("#formbooking"));
        $.ajax({
            url        : url+"index.php/public/outpatient/insertepisode",
            data       : form,
            method     : "POST",
            processData: false,
            contentType: false,
            dataType   : "JSON",
            cache      : false,
            success    : function (data) {
                if (data.responCode === "00") {
                    $("#struk_namapasien").html(data.responResult[0].namapasien);
                    $("#struk_politujuan").html(data.responResult[0].politujuan);
                    $("#struk_namadokter").html(data.responResult[0].namadokter);
                    $("#struk_noantrian").html(data.responResult[0].nomorantrian);
                    $("#struk_jampelayanan").html(data.responResult[0].tglpelayanan);

                    // Menampilkan booking_id sebagai teks
                    $("#struk_bookinid").html(data.responResult[0].no_rkm_medis);

                    // Hapus QR Code lama (jika ada) dan buat baru
                    $("#qrcode_booking").empty();

                    var qrcode = new QRCode(document.getElementById("qrcode_booking"), {
                        text    : data.responResult[0].no_rkm_medis,
                        width   : 128,
                        height  : 128,
                        colorDark : "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H // High error correction
                    });

                    resolve(data);
                } else {
                    reject("Failed to save data. Please try again!");
                }
            },
            error: function (xhr, status, error) {
                reject("Error: " + error);
            }
        });
    });
};

$(document).on("change","select[name='booking_poliid']",function(e){
	e.preventDefault();
    var poliid = $(this).val();
    var hariid = $("input[name='booking_hariid']").val();
	$.ajax({
		url    : url + "index.php/public/outpatient/masterdokter",
		method : "POST",
		data   : {poliid:poliid,hariid:hariid},
		cache  : false,
		success: function (data) {
			$("select[name='booking_doctorid']").html(data);
            $("select[name='booking_doctorid']").trigger("change");
		}
	});
});

$(document).on("change", "select[name='booking_doctorid']",function(e){
    e.preventDefault();
    jadwaldokter();
});