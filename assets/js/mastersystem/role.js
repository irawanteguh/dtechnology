masterrole();

function getdata(btn) {
    var roleid = btn.attr("data_roleid");
    mastermodules(roleid);
};

function masterrole(){
    $.ajax({
        url       : url+"index.php/mastersystem/role/masterrole",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterrole").html("");
        },
        success:function(data){
            let tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;

                tableresult +="<div class='col-md-4'>";
                    tableresult +="<div class='card h-md-100'>";
                        tableresult +="<div class='card-body d-flex flex-center'>";
                            tableresult +="<button type='button' class='btn btn-clear d-flex flex-column flex-center' data-bs-toggle='modal' data-bs-target='#modal_role_add'>";
                                tableresult +="<img src='"+url+"assets/images/illustrations/unitedpalms-1/4.png' alt='' class='mw-100 mh-150px mb-7'>";
                                tableresult +="<div class='fw-bolder fs-3 text-gray-600 text-hover-primary'>Add New Role</div>";
                            tableresult +="</button>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                tableresult +="</div>";

                for(var i in result){
                    getvariabel =   "data_roleid='" + result[i].role_id + "'";

                    tableresult +="<div class='col-md-4'>";
                        tableresult +="<div class='card card-flush h-md-100'>";
                            tableresult +="<div class='card-header'>";
                                tableresult +="<div class='card-title'>";
                                    tableresult +="<h2>"+result[i].role+"</h2>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='card-body pt-1'>";
                                tableresult +="<div class='fw-bolder text-gray-600 mb-5'>Total users with this role: "+result[i].jmluser+"</div>";
                                tableresult +="<div class='d-flex flex-column text-gray-600'>";
                                var modules = result[i].modules ? result[i].modules.split(';') : [];
                                var maxModulesToShow = 5;

                                for (var j = 0; j < Math.min(modules.length, maxModulesToShow); j++) {
                                    tableresult += "<div class='d-flex align-items-center py-2'>";
                                    tableresult += "<span class='bullet bg-primary me-3'></span>" + modules[j] + "</div>";
                                }

                                if (modules.length > maxModulesToShow) {
                                    tableresult += "<div class='d-flex align-items-center py-2'>";
                                    tableresult += "<span class='bullet bg-primary me-3'></span>and " + (modules.length - maxModulesToShow) + " more...</div>";
                                }
                                tableresult +="</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='card-footer flex-wrap pt-0'>";
                            tableresult +="<button type='button' class='btn btn-light btn-active-light-primary my-1' data-bs-toggle='modal' data-bs-target='#modal_role_list' "+getvariabel+" onclick='getdata($(this));'>Edit Role</button>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                }
            }


            $("#resultmasterrole").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			//
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

// function mastermodules(roleid) {
//     $.ajax({
//         url       : url + "index.php/mastersystem/role/mastermodules",
//         data      : {roleid:roleid},
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             $("#listmodules").html("");
//         },
//         success: function (data) {
//             var tableresult = "";

//             if (data.responCode === "00") {
//                 var result = data.responResult;

//                 function generateChildElements(parentId, level) {
//                     var childElements = "";
//                     for (var j in result) {
//                         if (result[j].modules_header_id === parentId) {
//                             var indent = level * 20;

//                             childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
//                             childElements += "<div class='fw-bold'>";
//                             childElements += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[j].icon + "'></i> " + result[j].modules_name + "</span><br>";
//                             childElements += "<span class='fs-6 text-muted me-2'>" + result[j].package + (result[j].def_controller ? " - " + result[j].def_controller : "") + " </span>";
//                             childElements += "</div>";
//                             childElements += "<div class='fw-bold d-flex justify-content-end'>";
//                             if (result[j].transid != null) {
//                                 childElements += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[j].modules_id + "' data-parent-id='" + parentId + "' checked='checked' /></div>";
//                             } else {
//                                 childElements += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[j].modules_id + "' data-parent-id='" + parentId + "' /></div>";
//                             }
//                             childElements += "</div>";
//                             childElements += "</div>";

//                             childElements += generateChildElements(result[j].modules_id, level + 1);
//                         }
//                     }
//                     return childElements;
//                 }

//                 for (var i in result) {
//                     if (result[i].parent === "C") {
//                         tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
//                         tableresult += "<div class='fw-bold'>";
//                         tableresult += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[i].icon + "'></i> " + result[i].modules_name + "</span>";
//                         tableresult += "</div>";
//                         tableresult += "<div class='fw-bold d-flex justify-content-end'>";
//                         if (result[i].transid != null) {
//                             tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].modules_id + "' data-parent-id='' checked='checked' /></div>";
//                         } else {
//                             tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].modules_id + "' data-parent-id='' /></div>";
//                         }
//                         tableresult += "</div>";
//                         tableresult += "</div>";

//                         tableresult += generateChildElements(result[i].modules_id, 1);
//                     }
//                 }
//             }

//             $("#listmodules").html(tableresult);

//             $(document).on("change", ".form-check-input", function (e) {
//                 e.preventDefault();
//                 var switchId    = $(this).attr('id');
//                 var switchValue = $(this).prop('checked');
//                 var parentId    = $(this).data('parent-id');
            
//                 if(switchValue){
//                     if(parentId){
//                         checkParentCheckboxes(parentId);
//                     }
//                 } else {
//                     uncheckChildCheckboxes(switchId);
//                 }
            
//                 var allSwitchStatuses = [];
//                 $(".form-check-input").each(function () {
//                     allSwitchStatuses.push({
//                         id   : $(this).attr('id'),
//                         value: $(this).prop('checked')
//                     });
//                 });
            
//                 $.ajax({
//                     url       : url + "index.php/mastersystem/role/mappingrole",
//                     data      : { switchId: switchId, switchValue: switchValue, roleid: roleid, allSwitchStatuses: allSwitchStatuses },
//                     method    : "POST",
//                     dataType  : "JSON",
//                     cache     : false,
//                     beforeSend: function () {
//                         toastr.clear();
//                         toastr["info"]("Sending request...", "Please wait");
//                     },
//                     success: function (data) {
//                         toastr.clear();
//                         toastr[data.responHead](data.responDesc, "INFORMATION");
//                     },
//                     complete: function () {
//                         // mastermodules();
//                     },
//                     error: function (xhr, status, error) {
//                         Swal.fire({
//                             title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                             html: "<b>" + error + "</b>",
//                             icon: "error",
//                             confirmButtonText: "Please Try Again",
//                             buttonsStyling: false,
//                             timerProgressBar: true,
//                             timer: 5000,
//                             customClass: { confirmButton: "btn btn-danger" },
//                             showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
//                             hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
//                         });
//                     }
//                 });
            
//                 function checkParentCheckboxes(parentId) {
//                     if (parentId) {
//                         var parentCheckbox = $("#" + parentId);
//                         if (parentCheckbox.length) {
//                             parentCheckbox.prop('checked', true);
//                             var grandParentId = parentCheckbox.data('parent-id');
//                             if (grandParentId) {
//                                 checkParentCheckboxes(grandParentId);
//                             }
//                         }
//                     }
//                 }
            
//                 function uncheckChildCheckboxes(parentId) {
//                     $(".form-check-input[data-parent-id='" + parentId + "']").each(function () {
//                         $(this).prop('checked', false);
//                         uncheckChildCheckboxes($(this).attr('id'));
//                     });
//                 }
//             });
            
//             function checkParentCheckboxes(parentId) {
//                 if (parentId) {
//                     var parentCheckbox = $("#" + parentId);
//                     if (parentCheckbox.length) {
//                         parentCheckbox.prop('checked', true);
//                         var grandParentId = parentCheckbox.data('parent-id');
//                         if (grandParentId) {
//                             checkParentCheckboxes(grandParentId);
//                         }
//                     }
//                 }
//             }

//             function uncheckChildCheckboxes(parentId) {
//                 $(".form-check-input[data-parent-id='" + parentId + "']").each(function () {
//                     $(this).prop('checked', false);
//                     uncheckChildCheckboxes($(this).attr('id'));
//                 });
//             }
//         },
//         complete: function () {
//             toastr.clear();
//         },
//         error: function (xhr, status, error) {
//             Swal.fire({
//                 title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html: "<b>" + error + "</b>",
//                 icon: "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling: false,
//                 timerProgressBar: true,
//                 timer: 5000,
//                 customClass: { confirmButton: "btn btn-danger" },
//                 showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
//                 hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
//             });
//         }
//     });
//     return false;
// };

function mastermodules(roleid) {
    $.ajax({
        url       : url + "index.php/mastersystem/role/mastermodules",
        data      : {roleid:roleid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#listmodules").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                function generateChildElements(parentId, level) {
                    var childElements = "";
                    for (var j in result) {
                        if (result[j].modules_header_id === parentId) {
                            var indent = level * 20;

                            childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                            childElements += "<div class='fw-bold'>";
                            childElements += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[j].icon + "'></i> " + result[j].modules_name + "</span><br>";
                            childElements += "<span class='fs-6 text-muted me-2'>" + result[j].package + (result[j].def_controller ? " - " + result[j].def_controller : "") + " </span>";
                            childElements += "</div>";
                            childElements += "<div class='fw-bold d-flex justify-content-end'>";
                            childElements += "<div class='form-check form-switch form-check-custom form-check-solid'>";
                            childElements += "<input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[j].modules_id + "' data-parent-id='" + parentId + "' " + (result[j].transid != null ? "checked='checked'" : "") + " />";
                            childElements += "</div>";
                            childElements += "</div>";
                            childElements += "</div>";

                            childElements += generateChildElements(result[j].modules_id, level + 1);
                        }
                    }
                    return childElements;
                }

                for (var i in result) {
                    if (result[i].parent === "C") {
                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                        tableresult += "<div class='fw-bold'>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[i].icon + "'></i> " + result[i].modules_name + "</span>";
                        tableresult += "</div>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                        tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'>";
                        tableresult += "<input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].modules_id + "' data-parent-id='' " + (result[i].transid != null ? "checked='checked'" : "") + " />";
                        tableresult += "</div>";
                        tableresult += "</div>";
                        tableresult += "</div>";

                        tableresult += generateChildElements(result[i].modules_id, 1);
                    }
                }
            }

            $("#listmodules").html(tableresult);

            $(document).on("change", ".form-check-input", function (e) {
                e.preventDefault();
                var switchId    = $(this).attr('id');
                var switchValue = $(this).prop('checked');
                var parentId    = $(this).data('parent-id');
            
                if(switchValue){
                    if(parentId){
                        checkParentCheckboxes(parentId);
                    }
                } else {
                    uncheckChildCheckboxes(switchId);
                }

                $.ajax({
                    url       : url + "index.php/mastersystem/role/mappingrole",
                    data      : {switchId:switchId,switchValue:switchValue,roleid:roleid},
                    method    : "POST",
                    dataType  : "JSON",
                    cache     : false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                    },
                    success: function (data) {
                        toastr.clear();
                        toastr[data.responHead](data.responDesc, "INFORMATION");
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

                function checkParentCheckboxes(parentId) {
                    if (parentId) {
                        var parentCheckbox = $("#" + parentId);
                        if (parentCheckbox.length) {
                            parentCheckbox.prop('checked', true);
                            var grandParentId = parentCheckbox.data('parent-id');
                            if (grandParentId) {
                                checkParentCheckboxes(grandParentId);
                            }
                        }
                    }
                };
            
                function uncheckChildCheckboxes(parentId) {
                    $(".form-check-input[data-parent-id='" + parentId + "']").each(function () {
                        $(this).prop('checked', false);
                        uncheckChildCheckboxes($(this).attr('id'));
                    });
                };
            });
    
        },
        complete: function () {
            toastr.clear();
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
    return false;
};

$(document).on("submit", "#formaddrole", function (e) {
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
			$("#btn_role_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                masterrole();
                $('#modal_role_add').modal('hide');
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_role_add").removeClass("disabled");
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