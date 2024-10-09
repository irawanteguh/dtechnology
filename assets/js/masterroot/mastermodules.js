masterapps();

$('#tambahmodules').on('show.bs.modal', function () {
    $(":text[name='modulesname-tambah']").val('');
    $(":text[name='modulesversion-tambah']").val('');
    $(":text[name='modulespackage-tambah']").val('');
    $(":text[name='modulescontrollers-tambah']").val('');
});

function getdata(btn){
    var $btn = $(btn);

    var modulesid          = $btn.attr("data-modulesid");
    var modulesname        = $btn.attr("data-modulesname");
    var modulesversion     = $btn.attr("data-modulesversion");
    var modulesicon        = $btn.attr("data-modulesicon");
    var modulespackage     = $btn.attr("data-modulespackage");
    var modulesparent      = $btn.attr("data-modulesparent");
    var modulesstatus      = $btn.attr("data-modulesstatus");
    var modulesheader      = $btn.attr("data-modulesheader");
    var modulesheaderid    = $btn.attr("data-modulesheaderid");
    var status             = $btn.attr("data-status");
    var modulescontrollers = $btn.attr("data-modulescontrollers");

    $(":hidden[name='modulesid-hapus']").val(modulesid);
    $(":hidden[name='modulesid-edit']").val(modulesid);
    $(":hidden[name='modulesid-hide']").val(modulesid);
    $(":hidden[name='modulesid-unhide']").val(modulesid);

    $(":text[name='modulesname-hapus']").val(modulesname);
    $(":text[name='modulesname-edit']").val(modulesname);
    $(":text[name='modulesname-hide']").val(modulesname);
    $(":text[name='modulesname-unhide']").val(modulesname);

    if(modulesversion==="null"){
        $(":text[name='modulesversion-hapus']").val("");
        $(":text[name='modulesversion-edit']").val("");
        $(":text[name='modulesversion-hide']").val("");
        $(":text[name='modulesversion-unhide']").val("");
    }else{
        $(":text[name='modulesversion-hapus']").val(modulesversion);
        $(":text[name='modulesversion-edit']").val(modulesversion);
        $(":text[name='modulesversion-hide']").val(modulesversion);
        $(":text[name='modulesversion-unhide']").val(modulesversion);
    }

    if(modulesicon==="null"){
        $(":text[name='modulesicon-hapus']").val("");
        $(":text[name='modulesicon-edit']").val("");
        $(":text[name='modulesicon-hide']").val("");
        $(":text[name='modulesicon-unhide']").val("");
    }else{
        $(":text[name='modulesicon-hapus']").val(modulesicon);
        $(":text[name='modulesicon-edit']").val(modulesicon);
        $(":text[name='modulesicon-hide']").val(modulesicon);
        $(":text[name='modulesicon-unhide']").val(modulesicon);
    }

    if(modulespackage==="null"){
        $(":text[name='modulespackage-hapus']").val("");
        $(":text[name='modulespackage-edit']").val("");
        $(":text[name='modulespackage-hide']").val("");
        $(":text[name='modulespackage-unhide']").val("");
    }else{
        $(":text[name='modulespackage-hapus']").val(modulespackage);
        $(":text[name='modulespackage-edit']").val(modulespackage);
        $(":text[name='modulespackage-hide']").val(modulespackage);
        $(":text[name='modulespackage-unhide']").val(modulespackage);
    }

    if(modulescontrollers==="null"){
        $(":text[name='modulescontrollers-hapus']").val("");
        $(":text[name='modulescontrollers-edit']").val("");
        $(":text[name='modulescontrollers-hide']").val("");
        $(":text[name='modulescontrollers-unhide']").val("");
    }else{
        $(":text[name='modulescontrollers-hapus']").val(modulescontrollers);
        $(":text[name='modulescontrollers-edit']").val(modulescontrollers);
        $(":text[name='modulescontrollers-hide']").val(modulescontrollers);
        $(":text[name='modulescontrollers-unhide']").val(modulescontrollers);
    }


    var $modulesheaderEdit = $('#modulesheader-edit').select2();
        $modulesheaderEdit.val(modulesheaderid).trigger('change');

    var $modulesstatusEdit = $('#modulesstatus-edit').select2();
        $modulesstatusEdit.val(status).trigger('change');

    var $modulesparentEdit = $('#modulesparent-edit').select2();
        $modulesparentEdit.val(modulesparent).trigger('change');

};

function masterapps(){
    $.ajax({
        url       : url+"index.php/masterroot/Mastermodules/masterapps",
        method    : "GET",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmastermodules > tr").remove();
        },
        success:function(data){
            var result      = "";
            var getvariabel = "";
            var tableresult = "";
            var action      = "";
            
            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    getvariabel =   "data-modulesid='"+result[i].modules_id+"'"+
                                    "data-modulesname='"+result[i].modules_name+"'"+
                                    "data-modulesversion='"+result[i].version+"'"+
                                    "data-modulesicon='"+result[i].icon+"'"+
                                    "data-modulespackage='"+result[i].package+"'"+
                                    "data-modulesparent='"+result[i].parent+"'"+
                                    "data-modulesstatus='"+result[i].status+"'"+
                                    "data-modulesheader='"+result[i].modulesheader+"'"+
                                    "data-modulesheaderid='"+result[i].modules_header_id+"'"+
                                    "data-status='"+result[i].status+"'"+
                                    "data-modulescontrollers='"+result[i].def_controller+"'";

                    if(result[i].active==="1"){
                        action ="<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1' data-bs-toggle='modal' data-bs-target='#editmodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-pencil-fill text-primary'></i></a>";
                        action +="<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1' data-bs-toggle='modal' data-bs-target='#hidemodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-eye-slash-fill text-info'></i></a>";
                        action +="<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1' data-bs-toggle='modal' data-bs-target='#hapusmodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-trash-fill text-danger'></i></a>";
                    }else{
                        action +="<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1' data-bs-toggle='modal' data-bs-target='#unhidemodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-eye-fill text-success'></i></a>";
                    }

                    tableresult +="<tr>";
                    
                    if(result[i].active==="1"){
                        if(result[i].status==="0"){
                            tableresult +="<td><span class='badge badge-light-primary fs-7 fw-bold'>"+result[i].statusdesc+"</span></td>";
                        }else{
                            if(result[i].status==="1"){
                                tableresult +="<td><span class='badge badge-light-warning fs-7 fw-bold'>"+result[i].statusdesc+"</span></td>";
                            }else{
                                tableresult +="<td><span class='badge badge-light-success fs-7 fw-bold'>"+result[i].statusdesc+"</span></td>";
                            }
                        }
                    }else{
                        tableresult +="<td><span class='badge badge-light-danger fs-7 fw-bold'>Hidden</span></td>";
                    }

                    tableresult +="<td data-bs-target='license'>"+result[i].modules_id+"</td>";
                    tableresult +="<td><button data-action='copy' class='btn btn-active-color-primary btn-icon btn-sm btn-outline-light'><span class='svg-icon svg-icon-2'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path opacity='0.5' d='M18 2H9C7.34315 2 6 3.34315 6 5H8C8 4.44772 8.44772 4 9 4H18C18.5523 4 19 4.44772 19 5V16C19 16.5523 18.5523 17 18 17V19C19.6569 19 21 17.6569 21 16V5C21 3.34315 19.6569 2 18 2Z' fill='black' /><path fill-rule='evenodd' clip-rule='evenodd' d='M14.7857 7.125H6.21429C5.62255 7.125 5.14286 7.6007 5.14286 8.1875V18.8125C5.14286 19.3993 5.62255 19.875 6.21429 19.875H14.7857C15.3774 19.875 15.8571 19.3993 15.8571 18.8125V8.1875C15.8571 7.6007 15.3774 7.125 14.7857 7.125ZM6.21429 5C4.43908 5 3 6.42709 3 8.1875V18.8125C3 20.5729 4.43909 22 6.21429 22H14.7857C16.5609 22 18 20.5729 18 18.8125V8.1875C18 6.42709 16.5609 5 14.7857 5H6.21429Z' fill='black' /></svg></span></button></i></td>";
                    tableresult +="<td><div class='d-flex align-items-center'><div class='symbol symbol-50px me-5'><i class='"+result[i].icon+"'></i></div><div class='d-flex justify-content-start flex-column'><span class='fw-bold d-block fs-7'>"+result[i].modules_name+"</span><span class='text-muted fw-bold d-block fs-7'>"+result[i].package+" - "+result[i].def_controller+"</span></div></div></td>";
                    
                    tableresult +="<td class='text-end'>"+action+"</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultmastermodules").html(tableresult);
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
        },
		complete: function () {

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

$(document).on("submit", "#formeditmastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();

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
			$("#btn-modules-edit").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
			}
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr.clear();
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
            toastr.clear();
            $("#editmodules").modal("hide");
			$("#btn-modules-edit").removeClass("disabled");
		}
	});
    return false;
});

$(document).on("submit", "#formhapusmastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#btn-modules-hapus").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
			}
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr.clear();
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
            toastr.clear();
            $("#hapusmodules").modal("hide");
			$("#btn-modules-hapus").removeClass("disabled");
		}
	});
    return false;
});

$(document).on("submit", "#formhidemastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#btn-modules-hide").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
			}
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            toastr.clear();
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
            toastr.clear();
            $("#hidemodules").modal("hide");
			$("#btn-modules-hide").removeClass("disabled");
		}
	});
    return false;
});

$(document).on("submit", "#formunhidemastermodules", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#btn-modules-unhide").addClass("disabled");
        },
		success: function (data) {
            if (data.responCode == "00") {
                masterapps();
			}
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
		complete: function () {
            toastr.clear();
            $("#unhidemodules").modal("hide");
			$("#btn-modules-unhide").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            toastr.clear();
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
	});
    return false;
});

var KTAccountAPIKeys = {
    init: function() {
        KTUtil.each(document.querySelectorAll('#tablemastermodules [data-action="copy"]'), function(e) {
            var row = e.closest("tr");
            var license = KTUtil.find(row, '[data-bs-target="license"]');

            new ClipboardJS(e, {
                target: function() {
                    return license;
                },
                text: function() {
                    return license.innerHTML;
                }
            }).on("success", function(event) {
                var svgIcon = e.querySelector(".svg-icon");
                var checkIcon = e.querySelector(".bi.bi-check");

                if (!checkIcon) {
                    checkIcon = document.createElement("i");
                    checkIcon.classList.add("bi", "bi-check", "fs-2x");
                    e.appendChild(checkIcon);
                    license.classList.add("text-success");
                    svgIcon.classList.add("d-none");

                    setTimeout(function() {
                        svgIcon.classList.remove("d-none");
                        e.removeChild(checkIcon);
                        license.classList.remove("text-success");
                    }, 3000);
                }
            });
        });
    }
};

KTUtil.onDOMContentLoaded(function() {
    KTAccountAPIKeys.init();
});