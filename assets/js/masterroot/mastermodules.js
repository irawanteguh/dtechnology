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
                    if(result[i].parent==="C"){
                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                        tableresult += "<div class='fw-bold'>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'>"+ result[i].modules_name + "</span><br>";
                        tableresult += "</div>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                        tableresult += "</div>";
                        tableresult += "</div>";

                        // Generate children for the top-level element
                        tableresult += generateChildElements(result[i].modules_id, 1);
                    }

                    function generateChildElements(parentId, level) {
                        var childElements = "";
                        for (var j in result) {
                            if (result[j].modules_header_id === parentId) {
                                var active = "";
                                var indent = level * 20;
    
                                getvariabel =   "data-modulesid='"+result[j].modules_id+"'"+
                                                "data-modulesname='"+result[j].modules_name+"'"+
                                                "data-modulesversion='"+result[j].version+"'"+
                                                "data-modulesicon='"+result[j].icon+"'"+
                                                "data-modulespackage='"+result[j].package+"'"+
                                                "data-modulesparent='"+result[j].parent+"'"+
                                                "data-modulesstatus='"+result[j].status+"'"+
                                                "data-modulesheader='"+result[j].modulesheader+"'"+
                                                "data-modulesheaderid='"+result[j].modules_header_id+"'"+
                                                "data-status='"+result[j].status+"'"+
                                                "data-modulescontrollers='"+result[j].def_controller+"'";

                                if(result[j].active==="1"){
                                    active = "<span class='badge badge-light-primary fs-7 fw-bold'>Active</span>";
                                }else{
                                    active = "<span class='badge badge-light-danger fs-7 fw-bold'>Hide Modules</span>";
                                }

                                childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                                childElements += "<div class='fw-bold'>";
                                childElements += "<i class='"+result[j].icon+"'></i> <span class='fs-6 text-gray-800 me-2'>"+result[j].modules_name+"</span><br>";
                                childElements += "<span class='fs-6 text-muted me-2'>"+(result[j].package ? result[j].package : "")+(result[j].def_controller ? " - "+result[j].def_controller : "")+"</span><br>";
                                childElements += "<span class='badge badge-light-primary fs-7 fw-bold'>"+result[j].statusdesc+"</span> "+active;
                                childElements += "</div>";
                                childElements += "<div class='fw-bold d-flex justify-content-end'>";
                                childElements += "<div class='btn-group' role='group'>";
                                childElements += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                childElements += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                childElements += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#modal_department_addsubdepartment' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-check2-circle text-success'></i> Add Sub Modules</a>";
                                childElements += "<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#editmodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-pencil-square text-primary'></i> Edit Modules</a>";
                                if(result[j].active==="1"){
                                    childElements += "<a class='dropdown-item btn btn-sm text-info' data-bs-toggle='modal' data-bs-target='#hidemodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-eye-slash-fill text-info'></i> Hide Modules</a>";
                                }else{
                                    childElements += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#unhidemodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-eye-fill text-success'></i> Unhide Modules</a>";
                                }

                                childElements += "<a class='dropdown-item btn btn-sm text-danger' data-bs-toggle='modal' data-bs-target='#hapusmodules' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-trash-fill text-danger'></i> Non Active Modules</a>";
                                
                                childElements +="</div>";
                                childElements +="</div>";
                                childElements += "</div>";
                                childElements += "</div>";
    
                                // Recursively generate children for the current module
                                childElements += generateChildElements(result[j].modules_id, level + 1);
                            }
                        }
                        return childElements;
                    }
                }
            }

            $("#resultmastermodules").html(tableresult);
            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
        },
		complete: function () {
            toastr.clear();
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