masterlocation();

function getdata(btn) {
    var data_locationid = btn.attr("data_locationid");
    var data_location   = btn.attr("data_location");
    var data_levelid    = btn.attr("data_levelid");

    $(":hidden[name='headerid']").val(data_locationid);
    $(":hidden[name='levelid']").val(parseFloat(data_levelid)+1);

    // $(":hidden[name='departmentid']").val(departmentid);
    // $(":hidden[name='departmentidedit']").val(departmentid);
    

    $("input[name='location_name']").val(data_department);

    // if(data_departmentcode==="null"){
    //     $("input[name='department_code_edit']").val('');
    // }else{
    //     $("input[name='department_code_edit']").val(data_departmentcode);
    // }
   
    // masteruser();
};

function masterlocation(){
    $.ajax({
        url       : url + "index.php/mastersystem/location/masterlocation",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#listlocation").html("");
        },
        success: function (data) {
            var tableresult = "";

            if (data.responCode === "00") {
                var result = data.responResult;

                for(var i in result) {
                    if(result[i].type==="si"){
                        getvariabel =       "data_locationid='" + result[i].location_id + "'"+
                                            "data_location='" + result[i].location + "'"+
                                            "data_levelid='" + result[i].level_id + "'";

                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                            tableresult += "<div class='fw-bold'>";
                                tableresult += "<span class='fs-6 text-gray-800 me-2'>"+ result[i].location + "</span>";
                                tableresult += "<span class='badge badge-sm badge-light-info'>Site</span><br>";
                                tableresult += "<span class='fs-6 text-muted me-2'>"+ (result[i].namapj ? result[i].namapj : "") + " </span>";
                            tableresult += "</div>";
                            tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                                tableresult += "<div class='btn-group' role='group'>";
                                    tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                    tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_department_addsublocation' onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Sub Location</a>";
                                        // tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+"data_validasi='2' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        // tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                                    tableresult +="</div>";
                                tableresult +="</div>";
                            tableresult += "</div>";
                        tableresult += "</div>";

                        tableresult += generateChildElements(result[i].location_id, 1);
                    }
                    
                }

                function generateChildElements(parentId, level) {
                    var childElements = "";
                    for (var j in result) {
                        if (result[j].header_id === parentId) {
                            getvariabel =   "data_locationid='" + result[j].location_id + "'"+
                                            "data_location='" + result[j].location + "'"+
                                            "data_levelid='" + result[j].level_id + "'";

                            var indent = level * 20;

                            childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                                
                                childElements += "<div class='fw-bold'>";
                                    childElements += "<span class='fs-6 text-gray-800 me-2'>"+ result[j].location + "</span><br>";
                                    childElements += "<span class='fs-6 text-muted me-2'>"+ (result[j].namapj ? result[j].namapj : "") + " </span>";
                                childElements += "</div>";

                                childElements += "<div class='fw-bold d-flex justify-content-end'>";
                                    childElements += "<div class='btn-group' role='group'>";
                                        childElements += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                        childElements += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                            childElements += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_department_addsublocation' onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Sub Location</a>";
                                            // childElements += "<a class='dropdown-item btn btn-sm text-primary'  data-bs-toggle='modal' data-bs-target='#modal_department_adduser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Update User</a>";
                                            // childElements += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#modal_department_addsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-check2-circle text-success'></i> Add Sub Department</a>";
                                            // childElements += "<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_department_editsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Edit Department</a>";
                                            // childElements += "<a class='dropdown-item btn btn-sm text-danger'  data_validasi='1' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Delete Department</a>";
                                        childElements +="</div>";
                                    childElements +="</div>";
                                childElements += "</div>";

                            childElements += "</div>";

                            childElements += generateChildElements(result[j].location_id, level+1);
                        }
                    }
                    return childElements;
                }
            }

            $("#listlocation").html(tableresult);
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
};


$(document).on("submit", "#forminsertlocation", function (e) {
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
			$("#btn_location_add").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                masterlocation();
                $('#modal_department_addsublocation').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#btn_location_add").removeClass("disabled");
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