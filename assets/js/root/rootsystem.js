function todesimal(value) {
    return new Intl.NumberFormat('id-ID').format(value);
};

function formatCurrency(value) {
    if (typeof value !== "string" && typeof value !== "number") return '';

    const cleaned = String(value).replace(/[^0-9]/g, '');
    const number = parseInt(cleaned);
    if (isNaN(number)) return '';

    return 'Rp. ' + new Intl.NumberFormat('id-ID', {
        maximumFractionDigits: 0,
        minimumFractionDigits: 0
    }).format(number);
}

if (window.location.href !== url+'index.php/auth/sign') {
    var sessiontimeout = function() {
        var timeout = function() {
            $.sessionTimeout({
                title             : "Session Timeout Notification",
                message           : "Your session is about to expire.",
                keepAliveUrl      : window.location.href,
                redirUrl          : url+'index.php/auth/sign',
                logoutUrl         : url+'index.php/auth/sign',
                warnAfter         : 1800000,                               // warn after 30 minutes
                redirAfter        : 1810000,                               // redirect after 30 minutes and 10 seconds
                ignoreUserActivity: true,
                countdownMessage  : "Redirecting in {timer} seconds.",
                countdownBar      : true
            });
        }
    
        return {
            init: function() {
                timeout();
            }
        };
    }();
    
    jQuery(document).ready(function() {
        sessiontimeout.init();
    });
};

document.querySelectorAll('.currency-rp').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let formatted = formatCurrency(e.target.value);
        e.target.value = formatted;
    });
});

$('#openInNewTabButton').on('click', function() {
    var filename = $(this).data('filename');
    if (filename) {
        window.open(filename, '_blank');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var form = document.querySelector("#formnewpassword");
    var submitButton = document.querySelector("#kt_new_password_submit");
    var passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

    // Password validation function
    function validatePassword() {
        var password = form.querySelector("input[name='newpassword']").value;
        var confirmPassword = form.querySelector("input[name='confirm-password']").value;
        var isValid = true;

        // Clear previous errors
        form.querySelectorAll('.error-message').forEach(function(el) {
            el.remove();
        });

        if (password.length < 8) {
            isValid = false;
            displayError(form.querySelector("input[name='newpassword']"), "Password must be at least 8 characters long.");
        }

        if (password !== confirmPassword) {
            isValid = false;
            displayError(form.querySelector("input[name='confirm-password']"), "Passwords do not match.");
        }

        if (passwordMeter.getScore() < 80) {
            isValid = false;
            displayError(form.querySelector("input[name='newpassword']"), "Password strength is too weak. It must reach at least 3 bars.");
        }

        return isValid;
    }

    // Display error message
    function displayError(element, message) {
        var errorMessage = document.createElement('div');
        errorMessage.className = 'error-message text-danger';
        errorMessage.innerHTML = message;
        element.parentElement.appendChild(errorMessage);
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        if (validatePassword()) {
            var formData = new FormData(form);
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;

            fetch(form.action, {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;

                if (data.responCode === "00") {
                    Swal.fire({
                        title: "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                        html: "<b>" + data.responDesc + "</b>",
                        icon: data.responHead,
                        confirmButtonText: 'Yeah, got it!',
                        customClass: { confirmButton: 'btn btn-success' },
                        timerProgressBar: true,
                        timer: 2000,
                        showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                        hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                    }).then(function (result) {
                        form.reset();
                        window.location.href = "../auth/sign";
                    });
                } else {
                    Swal.fire({
                        title: "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html: "<b>" + data.responDesc + "</b>",
                        icon: data.responHead,
                        confirmButtonText: "Please Try Again",
                        buttonsStyling: false,
                        timerProgressBar: true,
                        timer: 5000,
                        customClass: { confirmButton: "btn btn-danger" },
                        showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                        hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                    }).then(function (result) {
                        form.reset();
                    });
                }
            })
            .catch(error => {
                submitButton.removeAttribute("data-kt-indicator");
                submitButton.disabled = false;
                Swal.fire({
                    text             : "An error occurred while processing your request. Please try again.",
                    icon             : "error",
                    buttonsStyling   : false,
                    confirmButtonText: "Ok, got it!",
                    customClass      : { confirmButton: "btn btn-danger" },
                    showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                    hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                }).then(function (result) {
                    form.reset();
                });
            });
        }
    });
    
});

function getDaySuffix(day) {
    if (day >= 11 && day <= 13) {
        return 'th';
    }
    switch (day % 10) {
        case 1: return 'st';
        case 2: return 'nd';
        case 3: return 'rd';
        default: return 'th';
    }
};

function exportTableToExcel(tableID, filename = ''){
    $("#"+tableID).table2excel({
        exclude: ".excludeThisClass",
        name: "Worksheet Name",
        filename: filename+".xls", // do include extension
        preserveColors: false // set to true if you want background colors and font colors preserved
    });
};

function showAlert(title, htmlContent, icon, confirmButtonText, buttonClass, timer = 5000) {
    Swal.fire({
        title            : `<h1 class='font-weight-bold' style='color:#234974;'>${title}</h1>`,
        html             : htmlContent,
        icon             : icon,
        confirmButtonText: confirmButtonText,
        customClass      : {confirmButton: buttonClass},
        timerProgressBar : true,
        timer            : timer,
        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
    });
}