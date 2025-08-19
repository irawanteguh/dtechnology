const urlParams = new URLSearchParams(window.location.search);
const xids = urlParams.get('xids');
const xide = urlParams.get('xide');

bab();

$('#modal_standart_add').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    $('#modal_standart_babid').val(xids);
});

$('#modal_element_add').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    $('#modal_element_babid').val(xids);
    $('#modal_element_standartid').val(xide);
});


$('#modal_sub_element_add').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button                = $(event.relatedTarget);
    var dataelementid           = button.attr("dataelementid");

    $('#modal_sub_element_babid').val(xids);
    $('#modal_sub_element_standartid').val(xide);
    $("#modal_sub_element_elementid").val(dataelementid);
    
});

function bab() {
    $.ajax({
        url       : url + "index.php/akreditasi/selfassessment/bab",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#babakreditasi").html("");
        },
        success: function (data) {
            let tableresult       = "";

            if (data.responCode === "00") {
                let result    = data.responResult;

                for (let i in result) {
                    tableresult += "<div class='col-xl-12'>";
                        tableresult += "<div class='card'>";

                            tableresult += "<div class='card-header border-0 pt-5'>";
                                tableresult += "<h3 class='card-title align-items-start flex-column'>";
                                    tableresult += "<span class='card-label fw-bolder fs-3 mb-1'>" + result[i].penilaian + "</span>";
                                    tableresult += "<span class='text-muted mt-1 fw-bold fs-7'>" + (result[i].do || '') + "</span>";
                                tableresult += "</h3>";

                                tableresult += "<div class='card-toolbar'>";
                                    tableresult += "<button type='button' class='btn btn-sm btn-icon btn-color-primary btn-active-light-primary' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'>";
                                        tableresult += "<span class='svg-icon svg-icon-2'>";
                                            tableresult += "<svg xmlns='http://www.w3.org/2000/svg' width='24px' height='24px' viewBox='0 0 24 24'>";
                                                tableresult += "<g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>";
                                                    tableresult += "<rect x='5' y='5' width='5' height='5' rx='1' fill='#000000'></rect>";
                                                    tableresult += "<rect x='14' y='5' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                    tableresult += "<rect x='5' y='14' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                    tableresult += "<rect x='14' y='14' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                tableresult += "</g>";
                                            tableresult += "</svg>";
                                        tableresult += "</span>";
                                    tableresult += "</button>";

                                    tableresult += "<div class='menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3' data-kt-menu='true'>";
                                        tableresult += "<div class='menu-item px-3'>";
                                            tableresult += "<div class='menu-content text-muted pb-2 px-3 fs-7 text-uppercase'>ACTIONS</div>";
                                        tableresult += "</div>";
                                        tableresult += "<div class='menu-item px-3'>";
                                            tableresult += "<a href='../../index.php/akreditasi/selfassessment?xids="+result[i].penilaian_id+"' class='menu-link px-3'>Buka Standart Penilaian</a>";
                                        tableresult += "</div>";
                                    tableresult += "</div>";
                                tableresult += "</div>"; // end card-toolbar
                            tableresult += "</div>"; // end card-header

                            tableresult += "<div class='card-body'>";
                                tableresult += "<div class='d-flex flex-wrap flex-stack'>";
                                    tableresult += "<div class='d-flex flex-column flex-grow-1 pe-8'>";
                                        tableresult += "<div class='d-flex flex-wrap'>";

                                            tableresult += "<div class='border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3'>";
                                                tableresult += "<div class='d-flex align-items-center'>";
                                                    tableresult += "<div class='fs-2 fw-bolder' data-kt-countup='true' data-kt-countup-value='50' data-kt-countup-suffix='%'>50</div>";
                                                tableresult += "</div>";
                                                tableresult += "<div class='fw-bold fs-6 text-gray-400'>Skor Penilaian</div>";
                                            tableresult += "</div>";

                                            tableresult += "<div class='border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3'>";
                                                tableresult += "<div class='d-flex align-items-center'>";
                                                    tableresult += "<div class='fs-2 fw-bolder' data-kt-countup='true' data-kt-countup-value='"+result[i].jmlelemen+"'>"+result[i].jmlelemen+" Element</div>";
                                                tableresult += "</div>";
                                                tableresult += "<div class='fw-bold fs-6 text-gray-400'>Total Element Penilaian</div>";
                                            tableresult += "</div>";

                                            tableresult += "<div class='border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3'>";
                                                tableresult += "<div class='d-flex align-items-center'>";
                                                    tableresult += "<div class='fs-2 fw-bolder' data-kt-countup='true' data-kt-countup-value='60' data-kt-countup-suffix='%'>60</div>";
                                                tableresult += "</div>";
                                                tableresult += "<div class='fw-bold fs-6 text-gray-400'>Total Elemen Penilaian Terisi</div>";
                                            tableresult += "</div>";

                                            tableresult += "<div class='border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3'>";
                                                tableresult += "<div class='d-flex align-items-center'>";
                                                    tableresult += "<div class='fs-2 fw-bolder' data-kt-countup='true' data-kt-countup-value='60' data-kt-countup-suffix='%'>60</div>";
                                                tableresult += "</div>";
                                                tableresult += "<div class='fw-bold fs-6 text-gray-400'>Jumlah Dokumen</div>";
                                            tableresult += "</div>";

                                        tableresult += "</div>";
                                    tableresult += "</div>";

                                    tableresult += "<div class='d-flex align-items-center w-200px w-sm-300px flex-column mt-3'>";
                                        tableresult += "<div class='d-flex justify-content-between w-100 mt-auto mb-2'>";
                                            tableresult += "<span class='fw-bold fs-6 text-gray-400'>Progress Pengisian</span>";
                                            tableresult += "<span class='fw-bolder fs-6'>60%</span>";
                                        tableresult += "</div>";
                                        tableresult += "<div class='h-15px mx-3 w-100 bg-light mb-3'>";
                                            tableresult += "<div class='bg-success rounded h-15px' role='progressbar' style='width: 70%;' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100'></div>";
                                        tableresult += "</div>";
                                    tableresult += "</div>";

                                tableresult += "</div>";
                            tableresult += "</div>"; // end card-body

                        tableresult += "</div>"; // end card
                    tableresult += "</div>"; // end col
                }

            }

            $("#babakreditasi").html(tableresult);

            if (typeof KTMenu !== "undefined") {
                KTMenu.createInstances();
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
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
        }
    });
    return false;
}

$(document).on("submit", "#formaddstandart", function (e) {
	e.preventDefault();
    var form = $(this);
    var url  = $(this).attr("action");

	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_standart_add_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                location.reload();
                $('#modal_standart_add').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_standart_add_btn").removeClass("disabled");
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
});


$(document).on("submit", "#formaddelement", function (e) {
	e.preventDefault();
    var form = $(this);
    var url  = $(this).attr("action");

	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_element_add_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                location.reload();
                $('#modal_element_add').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_element_add_btn").removeClass("disabled");
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
});

$(document).on("submit", "#formaddsubelement", function (e) {
	e.preventDefault();
    var form = $(this);
    var url  = $(this).attr("action");

	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_sub_element_add_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                location.reload();
                $('#modal_sub_element_add').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_sub_element_add_btn").removeClass("disabled");
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
});