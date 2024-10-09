var validatorsignin = function () {

    var form, submitButton, validator;

    function signin() {
        var formdata = new FormData(form);
        var url = form.getAttribute('action');

        $.ajax({
            url        : url,
            type       : 'POST',
            data       : formdata,
            dataType   : 'JSON',
            cache      : false,
            contentType: false,
            processData: false,
            beforeSend : function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
            },
            success: function (response) {
                if(response.responCode == "00"){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                        html             : "<b>"+response.responDesc+"</b>",
                        icon             : response.responHead,
                        confirmButtonText: 'Yeah, got it!',
                        customClass      : {confirmButton: 'btn btn-success'},
                        timerProgressBar : true,
                        timer            : 2000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    }).then(function (result) {
                        if(result.isConfirmed){
                            form.querySelector('[name="username"]').value = "";
                            form.querySelector('[name="password"]').value = "";
                            window.open(response.url, "_self");
                        }else{
                            if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                                form.querySelector('[name="username"]').value = "";
                                form.querySelector('[name="password"]').value = "";
                                window.open(response.url, "_self");
                            }
                        }
                    });
                }else{
                    if(response.responCode == "02"){
                        window.open(response.url, "_self");
                    }else{
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                            html             : "<b>"+response.responDesc+"</b>",
                            icon             : response.responHead,
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : {confirmButton: "btn btn-danger"},
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        }).then(function (result) {
                            if(result.isConfirmed){
                                form.querySelector('[name="username"]').value = "";
                                form.querySelector('[name="password"]').value = "";
                            }else{
                                if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                                    form.querySelector('[name="username"]').value = "";
                                    form.querySelector('[name="password"]').value = "";
                                }
                            }
                        });
                    }
                    
                }
            },
            complete: function () {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
            },
            error: function (xhr, status, error) {
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
                }).then(function (result) {
                    if(result.isConfirmed){
                        form.querySelector('[name="username"]').value = "";
                        form.querySelector('[name="password"]').value = "";
                    }else{
                        if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                            form.querySelector('[name="username"]').value = "";
                            form.querySelector('[name="password"]').value = "";
                        }
                    }
                });
            }
        });
    };

    return {
        init: function () {
            form         = document.querySelector("#kt_sign_in_form");
            submitButton = document.querySelector("#kt_sign_in_submit");

            validator = FormValidation.formValidation(form, {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: "Username is required"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "The password is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            });

            submitButton.addEventListener("click", function (event) {
                event.preventDefault();
                validator.validate().then(function (status) {
                    if (status === "Valid") {
                        signin();
                    }else{
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                            html             : "<b>Sorry, looks like there are some errors detected, please try again.</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : {confirmButton: "btn btn-danger"},
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                form.querySelector('[name="username"]').value = "";
                                form.querySelector('[name="password"]').value = "";
                            }else{
                                if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                                    form.querySelector('[name="username"]').value = "";
                                    form.querySelector('[name="password"]').value = "";
                                }
                            }
                        });
                    }
                });
            });
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    validatorsignin.init();
});
