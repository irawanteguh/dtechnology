getmaritalstatus();
getethnic();
getreligion();
getemergencycontact();
getaddress();

var dob = document.querySelector("[name='dob']");
new tempusDominus.TempusDominus(dob, {
    display: {
        viewMode: "calendar",
        components: {
            decades: true,
            year: true,
            month: true,
            date: true,
            hours: false,
            minutes: false,
            seconds: false
        }
    },
    localization: {
        locale: "in",
        startOfTheWeek: 1,
        format: "dd/MM/yyyy",
        close: true
    },
    restrictions: {
        minDate: undefined,
        maxDate: new Date(),
        disabledDates: [],
        enabledDates: [],
        daysOfWeekDisabled: [],
        disabledTimeIntervals: [],
        disabledHours: [],
        enabledHours: []
    }
});

Inputmask({
    "mask": "99/99/9999"
}).
mask(".kt_inputmask_1");


setTimeout(() => {
    datauser();
}, 100);

function getreligion() {
    $.ajax({
        url: url + "index.php/profile/overview/getreligion",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var opt = '<option></option>';
            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    opt += '<option value="' + d.RELIGION_ID + '">' + d.RELIGION_NAME + '</option>';
                })
            }

            $("#religion").html(opt);
        }
    });
}

function getethnic() {
    $.ajax({
        url: url + "index.php/profile/overview/getethnic",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var opt = '<option></option>';
            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    opt += '<option value="' + d.ETHNIC_ID + '">' + d.ETHNIC_NAME + '</option>';
                })
            }

            $("#ethnic").html(opt);
        }
    });
}

function calculateAge() {
    var birthdate = $('[name="dob"]').val();
    birthdate = birthdate.split('/');
    birthdate = birthdate[2] + '-' + birthdate[1] + '-' + birthdate[0];
    var today = new Date();
    var birthDate = new Date(birthdate);
    let years = today.getFullYear() - birthDate.getFullYear();
    let months = today.getMonth() - birthDate.getMonth();
    let days = today.getDate() - birthDate.getDate();
    if (days < 0) {
        months--;
        const previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
        days += previousMonth.getDate();
    }
    if (months < 0) {
        years--;
        months += 12;
    }

    var ages = years + 'Y ' + months + 'M ' + days + 'D';
    $("[name='ages']").val(ages);
}

function datauser() {
    $.ajax({
        url: url + "index.php/profile/overview/datauser",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            if (data.responCode === '00') {
                $("[name='identity_no']").val(data.responResult.IDENTITY_NO);
                $("[name='name']").val(data.responResult.NAME);
                $("[name='name_identity']").val(data.responResult.NAME_IDENTITY);
                $("[name='pob']").val(data.responResult.PLACE_OF_BIRTH);
                $("[name='dob']").val(data.responResult.TGLLAHIR);

                $("[name='gender'][value='" + data.responResult.SEX_ID + "']").prop('checked', true);
                //setTimeout(() => {
                $("[name='marital_status']").val(data.responResult.MARITAL_ID).trigger('change');
                $("[name='religion']").val(data.responResult.RELIGION_ID).trigger('change');
                $("[name='ethnic']").val(data.responResult.ETHNIC_ID).trigger('change');
                $("[name='blood_type']").val(data.responResult.BLOOD_TYPE).trigger('change');
                $("[name='clothes_size']").val(data.responResult.CLOTHES_SIZE).trigger('change');
                $("[name='rhesus'][value='" + data.responResult.RHESUS + "']").prop('checked', true);
                $("[name='phone']").val(data.responResult.PHONE);
                $("[name='email']").val(data.responResult.EMAIL);
                //}, 100);
                if (data.responResult.TGLLAHIR) {
                    calculateAge();
                }
            }
        }
    });
}

function getmaritalstatus() {
    $.ajax({
        url: url + "index.php/profile/overview/getmaritalstatus",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var opt = '<option></option>';
            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    opt += '<option value="' + d.MARITAL_ID + '">' + d.MARITAL_NAME + '</option>';
                })
            }
            $("#marital_status").html(opt);
        }
    });
}

var idcontact = '';
var submitButton = document.querySelector("#kt_contact_submit");
var validator;
var formcontact = document.querySelector("#formcontact");

function getrelathionship() {
    $.ajax({
        url: url + "index.php/profile/overview/getrelathionship",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var opt = '<option></option>';
            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    opt += '<option value="' + d.RELATIONSHIP_ID + '">' + d.RELATIONSHIP_NAME + '</option>';
                })
            }
            $("#contact_relationship").html(opt);
        }
    });
}

function getemergencycontact() {
    $.ajax({
        url: url + "index.php/profile/overview/getemergencycontact",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var html = '';
            var newcontact = '';

            newcontact += `<div class="col-lg-6">
                            <div class="notice d-flex bg-light-danger border-3 rounded border-danger border border-dashed h-lg-100 p-6">
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <div class="mb-3 mb-md-0 fw-bold">
                                        <h4 class="text-gray-900 fw-bolder">Emergency Contact Information!</h4>
                                        <div class="fs-6 text-gray-700 pe-7">Please carefully read
                                        <a href="#" class="fw-bolder me-1">our guidelines</a> before adding a new emergency contact.</div>
                                    </div>
                                    <a href="#" class="btn btn-danger px-6 align-self-center text-nowrap" onclick="newcontact()"><i class="fa-solid fa-plus"></i> Add Emergency Contact</a>
                                </div>
                            </div>
                        </div>`;

            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    var primary = '';

                    if (d.CONTACT_PRIMARY === '1') {
                        primary = '<span class="badge badge-light-primary fs-7 ms-2">Primary</span>';
                    }

                    html += `
                    <div class="col-lg-6">
                        <div class="card card-dashed border-danger border-3 h-xl-100 flex-row flex-stack flex-wrap p-4">
                            <div class="d-flex flex-column py-2">
                                <div class="d-flex align-items-center fs-5 fw-bolder mb-5">`+ d.CONTACT_NAME + `
                                    `+ primary + `
                                </div>
                                <div class="fs-6 fw-bold text-gray-600">
                                    `+ d.RELATIONSHIP_NAME + `
                                </div>
                                <div class="fs-6 fw-bold text-gray-600">
                                    `+ d.CONTACT_ADDRESS + `
                                </div>
                                <div class="fs-6 fw-bold text-gray-600">
                                    `+ d.CONTACT_PHONE + `
                                </div>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <button type="button" class="btn btn-sm btn-light btn-active-light-primary  me-3" onclick='editcontact(this)' data-id='`+ d.CONTACT_ID + `'>Edit</button>
                                <button type="button" class="btn btn-sm btn-light btn-active-light-primary" onclick='deletecontact(this)' data-id='`+ d.CONTACT_ID + `'>Delete</button>
                            </div>
                        </div>
                    </div>
                    `;
                })
            }

            $("#listcontact").html(newcontact+html);
        }
    });
}

function formreset() {
    $('#formcontact')[0].reset();
    $('#formcontact #contact_relationship').val('').trigger('change');
}

function newcontact() {
    getrelathionship();
    formreset();
    idcontact = '';
    $("#kt_modal_new_contact").modal('show');
    $("#kt_modal_new_contact form").attr('action', url + 'index.php/profile/overview/savecontact');
    $("#kt_modal_new_contact .modal-header h1").text('New Contact');
}

function editcontact(e) {
    getrelathionship();
    var id = $(e).attr('data-id');
    idcontact = id;
    $("#kt_modal_new_contact").modal('show');
    $("#kt_modal_new_contact form").attr('action', url + 'index.php/profile/overview/updatecontact');
    $("#kt_modal_new_contact .modal-header h1").text('Edit Contact');
    $.ajax({
        url: url + 'index.php/profile/overview/selectcontact',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (res) {
            if (res.responCode === '00') {
                if (res.responResult.CONTACT_PRIMARY === '1') {
                    $("#contact_primary").prop('checked', true);
                }
                $("#contact_name").val(res.responResult.CONTACT_NAME);
                $("#contact_relationship").val(res.responResult.RELATIONSHIP_ID).trigger('change');
                $("#contact_address").val(res.responResult.CONTACT_ADDRESS);
                $("#contact_phone").val(res.responResult.CONTACT_PHONE);
            }
        }
    });
}
function deletecontact(e) {
    var id = $(e).attr('data-id');
    $.ajax({
        url: url + 'index.php/profile/overview/deletecontact',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (res) {
            if (res.responCode == "00") {
                getemergencycontact();
            }
            toastr.clear();
            toastr[res.responHead](res.responDesc, "INFORMATION");;
        }
    });

}

function getaddress() {
    $.ajax({
        url: url + "index.php/profile/overview/getaddress",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
        },
        success: function (data) {
            var html       = '';
            var newaddress = '';

            newaddress += `<div class="col-lg-6">
                            <div class="notice d-flex bg-light-info border-3 rounded border-info border border-dashed h-lg-100 p-6">
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <div class="mb-3 mb-md-0 fw-bold">
                                        <h4 class="text-gray-900 fw-bolder">Add New Address</h4>
                                        <div class="fs-6 text-gray-700 pe-7">Please carefully read
                                        <a href="#" class="fw-bolder me-1">our address guidelines</a> before adding a new address.</div>
                                    </div>
                                    <a href="#" class="btn btn-info px-6 align-self-center text-nowrap" onclick="newaddress()"><i class="fa-solid fa-plus"></i> Add Address</a>
                                </div>
                            </div>
                        </div>`;

            if (data.responCode === '00') {
                data.responResult.map(function (d) {
                    var primary = '';
                    if (d.PRIMARY === '1') {
                        primary = '<span class="badge badge-light-primary fs-7 ms-2">Primary</span>';
                    }
                    html += `
                    <div class="col-lg-6">
                        <div class="card card-dashed border-info border-3 h-xl-100 flex-row flex-stack flex-wrap p-4">
                            <div class="d-flex flex-column py-2">
                                <div class="d-flex align-items-center fs-5 fw-bolder mb-5">`+ d.ADDRESS_LABEL + `
                                    `+ primary + `
                                </div>
                                <div class="fs-6 fw-bold text-gray-600">
                                    `+ d.ADDRESS + `
                                </div>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-3" onclick='editaddress(this)' data-id='`+ d.ADDRESS_ID + `'>Edit</button>
                                <button type="button" class="btn btn-sm btn-light btn-active-light-primary" onclick='deleteaddress(this)' data-id='`+ d.ADDRESS_ID + `'>Delete</button>
                            </div>
                        </div>
                    </div>
                    `;
                })
            }
            $("#listaddress").html(newaddress+html);
        }
    });
}

KTUtil.onDOMContentLoaded(function () {

    validator = FormValidation.formValidation(formcontact, {
        fields: {
            contact_name: {
                validators: {
                    notEmpty: {
                        message: "Contact Name is required"
                    }
                }
            },
            contact_relationship: {
                validators: {
                    notEmpty: {
                        message: "Contact Relationship is required"
                    }
                }
            },
            contact_address: {
                validators: {
                    notEmpty: {
                        message: "Contact Address is required"
                    }
                }
            },
            contact_phone: {
                validators: {
                    notEmpty: {
                        message: "Contact Phone is required"
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

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                var formdata = new FormData(formcontact);
                formdata.append('idcontact', idcontact)
                $.ajax({
                    url: $(formcontact).attr('action'),
                    type: $(formcontact).attr('method'),
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;
                    },
                    success: function (res) {
                        if (res.responCode == "00") {
                            $("#kt_modal_new_contact").modal('hide');
                            getemergencycontact();
                        }
                        
                        toastr.clear();
                        toastr[res.responHead](res.responDesc, "INFORMATION");
                    },
                    complete: function () {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                    },
                });
            };
        });
    })
});

var idaddress = '';
var submitaddressButton = document.querySelector("#kt_address_submit");
var validatoraddress;
var formaddress = document.querySelector("#formaddress");
function formaddressreset() {
    $('#formcontact')[0].reset();
    $('#formcontact #contact_relationship').val('').trigger('change');
}
function newaddress() {
    formaddressreset();
    idaddress = '';
    $("#kt_modal_address").modal('show');
    $("#kt_modal_address form").attr('action', url + 'index.php/profile/overview/saveaddress');
    $("#kt_modal_address .modal-header h1").text('New Address');
}
function editaddress(e) {
    var id = $(e).attr('data-id');
    idaddress = id;
    $("#kt_modal_address").modal('show');
    $("#kt_modal_address form").attr('action', url + 'index.php/profile/overview/updateaddress');
    $("#kt_modal_address .modal-header h1").text('Edit Address');
    $.ajax({
        url: url + 'index.php/profile/overview/selectaddress',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (res) {
            if (res.responCode === '00') {
                if (res.responResult.PRIMARY === '1') {
                    $("#address_primary").prop('checked', true);
                }
                $("#address_label").val(res.responResult.ADDRESS_LABEL);
                $("#address").val(res.responResult.ADDRESS);
            }
        }
    });
}
function deleteaddress(e) {
    var id = $(e).attr('data-id');
    $.ajax({
        url: url + 'index.php/profile/overview/deleteaddress',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        cache: false,
        success: function (res) {
            if (res.responCode == "00") {
                getaddress();
            }
            toastr.clear();
            toastr[res.responHead](res.responDesc, "INFORMATION");;
        }
    });

}
KTUtil.onDOMContentLoaded(function () {
    validatoraddress = FormValidation.formValidation(formaddress, {
        fields: {
            address_label: {
                validators: {
                    notEmpty: {
                        message: "Address Label Name is required"
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: "Address is required"
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
    submitaddressButton.addEventListener('click', function (e) {
        e.preventDefault();
        validatoraddress.validate().then(function (status) {
            if (status == 'Valid') {
                var formdata = new FormData(formaddress);
                formdata.append('idaddress', idaddress)
                $.ajax({
                    url: $(formaddress).attr('action'),
                    type: $(formaddress).attr('method'),
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        submitaddressButton.setAttribute("data-kt-indicator", "on");
                        submitaddressButton.disabled = true;
                    },
                    success: function (res) {
                        if (res.responCode == "00") {
                            $("#kt_modal_address").modal('hide');
                            getaddress();
                        }
                        toastr.clear();
                        toastr[res.responHead](res.responDesc, "INFORMATION");

                    },
                    complete: function () {
                        submitaddressButton.removeAttribute("data-kt-indicator");
                        submitaddressButton.disabled = false;
                    },
                });
            }
        });
    })
});


var submitoverview = document.querySelector("#kt_overview_submit");
var validatoroverview;
var formoverview = document.querySelector("#formoverview");
$("#formoverview").attr('action', url + 'index.php/profile/overview/saveoverview');
$("#formoverview").attr('method', 'post');
function formoverview() {
    $('#formoverview')[0].reset();
}
KTUtil.onDOMContentLoaded(function () {
    validatoroverview = FormValidation.formValidation(formoverview, {
        fields: {
            identity_no: {
                validators: {
                    notEmpty: {
                        message: "Identity Number is required"
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: "Name is required"
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
    submitoverview.addEventListener('click', function (e) {
        e.preventDefault();
        validatoroverview.validate().then(function (status) {
            if (status == 'Valid') {
                var formdata = new FormData(formoverview);
                $.ajax({
                    url: $(formoverview).attr('action'),
                    type: $(formoverview).attr('method'),
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        submitoverview.setAttribute("data-kt-indicator", "on");
                        submitoverview.disabled = true;
                    },
                    success: function (res) {
                        //console.log(res);
                        if (res.responCode == "00") {
                            datauser();
                        }
                        toastr.clear();
                        toastr[res.responHead](res.responDesc, "INFORMATION");
                    },
                    complete: function () {
                        submitoverview.removeAttribute("data-kt-indicator");
                        submitoverview.disabled = false;
                    },
                });
            }
        });
    })
});