masterdepartment();

$("#modal_department_addsubdepartment").on('hide.bs.modal', function(){
    $(":hidden[name='headerid']").val("");
    $("hidden[name='levelid']").val("");
    $("input[name='department_name']").val("");
});

function getdata(btn) {
    var departmentid        = btn.attr("data_departmentid");
    var data_department     = btn.attr("data_department");
    var data_departmentcode = btn.attr("data_departmentcode");
    var levelid             = btn.attr("data_levelid");

    $(":hidden[name='headerid']").val(departmentid);
    $(":hidden[name='departmentid']").val(departmentid);
    $(":hidden[name='departmentidedit']").val(departmentid);
    $(":hidden[name='levelid']").val(parseFloat(levelid)+1);

    $("input[name='department_name_edit']").val(data_department);
    if(data_departmentcode==="null"){
        $("input[name='department_code_edit']").val('');
    }else{
        $("input[name='department_code_edit']").val(data_departmentcode);
    }
   

    masteruser();
};

function masterdepartment() {
    $.ajax({
        url       : url + "index.php/mastersystem/department/masterdepartment",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#listdepartment").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                function generateChildElements(parentId, level) {
                    var childElements = "";
                    for (var j in result) {
                        if (result[j].header_id === parentId) {
                            var indent = level * 20;

                            getvariabel =   "data_departmentid='" + result[j].department_id + "'"+
                                            "data_department='" + result[j].department + "'"+
                                            "data_departmentcode='" + result[j].code + "'"+
                                            "data_levelid='" + result[j].level_id + "'";

                            childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                            childElements += "<div class='fw-bold'>";
                            childElements += "<span class='fs-6 text-gray-800 me-2'>"+(result[j].code ? "["+result[j].code+"] " : "")+ result[j].department + "</span><br>";
                            childElements += "<span class='fs-6 text-muted me-2'>"+ (result[j].namapj ? result[j].namapj : "") + " </span>";
                            childElements += "</div>";
                            childElements += "<div class='fw-bold d-flex justify-content-end'>";
                            childElements += "<div class='btn-group' role='group'>";
                            childElements += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            childElements += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            childElements += "<a class='dropdown-item btn btn-sm text-primary'  data-bs-toggle='modal' data-bs-target='#modal_department_adduser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Add User</a>";
                            childElements += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#modal_department_addsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-check2-circle text-success'></i> Add Sub Department</a>";
                            childElements += "<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_department_editsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Edit Department</a>";
                            childElements += "<a class='dropdown-item btn btn-sm text-danger'  data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Delete Department</a>";
                            childElements +="</div>";
                            childElements +="</div>";
                            childElements += "</div>";
                            childElements += "</div>";

                            // Recursively generate children for the current module
                            childElements += generateChildElements(result[j].department_id, level + 1);
                        }
                    }
                    return childElements;
                }

                // Generate top-level elements
                for(var i in result) {
                    if(result[i].level_id==="1"){
                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                        tableresult += "<div class='fw-bold'>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'>"+ result[i].department + "</span><br>";
                        tableresult += "<span class='fs-6 text-muted me-2'>"+ (result[i].namapj ? result[i].namapj : "") + " </span>";
                        tableresult += "</div>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                            // tableresult += "<div class='btn-group' role='group'>";
                            //     tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            //     tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            //         tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_item' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                            //         tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+"data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                            //         tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                            //     tableresult +="</div>";
                            // tableresult +="</div>";
                        tableresult += "</div>";
                        tableresult += "</div>";

                        // Generate children for the top-level element
                        tableresult += generateChildElements(result[i].department_id, 1);
                    }
                    
                }
            }

            $("#listdepartment").html(tableresult);
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

$(document).on("submit", "#forminsertdepartment", function (e) {
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
			$("#btn_department_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                masterdepartment();
                $('#modal_department_addsubdepartment').modal('hide');
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_department_add").removeClass("disabled");
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

$(document).on("submit", "#formeditdepartment", function (e) {
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
			$("#btn_department_edit").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                masterdepartment();
                $('#modal_department_editsubdepartment').modal('hide');
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_department_edit").removeClass("disabled");
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

function masteruser(){
    $.ajax({
        url       : url+"index.php/mastersystem/department/masteruser",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteruser").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].username + "</td>";
                    tableresult += "<td>" + result[i].name + "</td>";
                    tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-light-primary' data-userid='"+result[i].user_id+"' onclick='adduser($(this));'>Pilih</a></td>";
                    tableresult += "</tr>";
                }
            }


            $("#resultmasteruser").html(tableresult);
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

function adduser(btn){
    var userid       = btn.attr("data-userid");
    var departmentid = $("[name='departmentid']").val();
	$.ajax({
        url        : url+"index.php/mastersystem/department/adduser",
        data       : {userid:userid,departmentid:departmentid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				masterdepartment();
                $('#modal_department_adduser').modal('hide');
			};

            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};