masterrole();

function getdata(btn) {
    var $btn       = $(btn);
    var roleid = $btn.attr("data_roleid");
    var role   = $btn.attr("data_role");

    $(":hidden[name='roleid_mapping']").val(roleid);
    $("#headerlistrole").html("List Detail Role : " + role);
    mastermodules();
};

function masterrole(){
    $.ajax({
        url       : url+"index.php/mastersystem/mappingrole/masterrole",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#listmasterrole").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel = "";
                    getvariabel =   "data_roleid='" + result[i].role_id + "'" +
                                    "data_role='" + result[i].role + "'";

                    tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-hover border border-dashed border-gray-300 cursor-pointer mb-1' data-kt-search-element='customer' title='Klik Untuk Memilih' " + getvariabel + ">";
                    tableresult += "<div class='fw-bold'><span class='fs-6 text-gray-800 me-2'>"+result[i].role+"</span></div>";
                    tableresult += "</div>";
                }
            }


            $("#listmasterrole").html(tableresult);

            $("#listmasterrole div").on('click', function () {
                getdata(this);
            });

            // toastr[data.responHead](data.responDesc, "INFORMATION");
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

function mastermodules() {
    var roleid = $("input[name='roleid_mapping']").val();
    $.ajax({
        url: url + "index.php/mastersystem/mappingrole/mastermodules",
        data: { roleid: roleid },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            $("#listmodules").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                // Recursive function to generate child elements
                function generateChildElements(parentId, level) {
                    var childElements = "";
                    for (var j in result) {
                        if (result[j].modules_header_id === parentId) {
                            var indent = level * 20; // Increase indent based on level
                            childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                            childElements += "<div class='fw-bold'>";
                            childElements += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[j].icon + "'></i> " + result[j].modules_name + "</span><br>";
                            childElements += "<span class='fs-6 text-muted me-2'>" + result[j].package + (result[j].def_controller ? " - " + result[j].def_controller : "") + " </span>";
                            childElements += "</div>";
                            childElements += "<div class='fw-bold d-flex justify-content-end'>";
                            if (result[j].transid != null) {
                                childElements += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[j].modules_id + "' data-parent-id='" + parentId + "' checked='checked' /></div>";
                            } else {
                                childElements += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[j].modules_id + "' data-parent-id='" + parentId + "' /></div>";
                            }
                            childElements += "</div>";
                            childElements += "</div>";

                            // Recursively generate children for the current module
                            childElements += generateChildElements(result[j].modules_id, level + 1);
                        }
                    }
                    return childElements;
                }

                // Generate top-level elements
                for (var i in result) {
                    if (result[i].parent === "C") {
                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                        tableresult += "<div class='fw-bold'>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'><i class='" + result[i].icon + "'></i> " + result[i].modules_name + "</span>";
                        tableresult += "</div>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                        if (result[i].transid != null) {
                            tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].modules_id + "' data-parent-id='' checked='checked' /></div>";
                        } else {
                            tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].modules_id + "' data-parent-id='' /></div>";
                        }
                        tableresult += "</div>";
                        tableresult += "</div>";

                        // Generate children for the top-level element
                        tableresult += generateChildElements(result[i].modules_id, 1);
                    }
                }
            }

            $("#listmodules").html(tableresult);

            // Add event listener for checkboxes
            $(document).on("change", ".form-check-input", function (e) {
                e.preventDefault();
                var switchId = $(this).attr('id');
                var switchValue = $(this).prop('checked');
                var roleid = $("input[name='roleid_mapping']").val();
                var parentId = $(this).data('parent-id');
            
                // Check or uncheck parent checkboxes if needed
                if (switchValue) {
                    if (parentId) {
                        checkParentCheckboxes(parentId);
                    }
                } else {
                    uncheckChildCheckboxes(switchId);
                }
            
                // Gather all form switch statuses
                var allSwitchStatuses = [];
                $(".form-check-input").each(function () {
                    allSwitchStatuses.push({
                        id: $(this).attr('id'),
                        value: $(this).prop('checked')
                    });
                });
            
                // AJAX call
                $.ajax({
                    url: url + "index.php/mastersystem/mappingrole/mappingrole",
                    data: { switchId: switchId, switchValue: switchValue, roleid: roleid, allSwitchStatuses: allSwitchStatuses },
                    method: "POST",
                    dataType: "JSON",
                    cache: false,
                    beforeSend: function () {
                        //
                    },
                    success: function (data) {
                        if (data.responCode === "00") {
                            
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
                            });
                        }
                    },
                    complete: function () {
                        // mastermodules();
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
                }
            
                function uncheckChildCheckboxes(parentId) {
                    $(".form-check-input[data-parent-id='" + parentId + "']").each(function () {
                        $(this).prop('checked', false);
                        uncheckChildCheckboxes($(this).attr('id'));
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
            }

            function uncheckChildCheckboxes(parentId) {
                $(".form-check-input[data-parent-id='" + parentId + "']").each(function () {
                    $(this).prop('checked', false);
                    uncheckChildCheckboxes($(this).attr('id'));
                });
            }
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