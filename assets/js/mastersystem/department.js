masterdatadepartment();
chart();

const filterusername = new Tagify(document.querySelector("#filterusername"), { enforceWhitelist: true });
const filtername     = new Tagify(document.querySelector("#filtername"), { enforceWhitelist: true });

filterusername.on('change', filterTable);
filtername.on('change', filterTable);

$("#modal_department_addsubdepartment").on('show.bs.modal', function(event){
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button               = $(event.relatedTarget);
    var levelid              = button.attr("data_levelid");

    $(":hidden[name='levelid']").val(parseFloat(levelid)+1);
});

$("#modal_department_addsubdepartment").on('hide.bs.modal', function(){
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
});

$("#modal_department_editsubdepartment").on('show.bs.modal', function(event){
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button               = $(event.relatedTarget);
    var departmentid         = button.attr("data_departmentid");
    var data_department      = button.attr("data_department");
    var data_jabatan         = button.attr("data_jabatan");
    var data_departmentcode  = button.attr("data_departmentcode");
    var data_headerid        = button.attr("data_headerid");
    var data_headkoordinator = button.attr("data_headkoordinator");
    var levelid              = button.attr("data_levelid");
    var data_levelidhead     = button.attr("data_levelidhead");
     
    $(":hidden[name='departmentidedit']").val(departmentid);
    $(":hidden[name='levelidedit']").val(parseFloat(data_levelidhead)+1);

    $("input[name='department_name_edit']").val((!data_department || data_department === "null") ? "" : data_department);
    $("input[name='department_position_edit']").val((!data_jabatan || data_jabatan === "null") ? "" : data_jabatan);
    $("input[name='department_code_edit']").val((!data_departmentcode || data_departmentcode === "null") ? "" : data_departmentcode);
    $("#department_koordinator_edit").prop("checked", data_headkoordinator === "Y");

    var $data_headerid = $('#department_departmentheader_edit').select2();
        $data_headerid.val(data_headerid).trigger('change');
});

$("#modal_department_adduser").on('show.bs.modal', function(event){
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button              = $(event.relatedTarget);
    var departmentid        = button.attr("data_departmentid");
     
    $(":hidden[name='departmentidadduser']").val(departmentid);
    
});

function filterTable() {
    const usernamefilter = filterusername.value.map(tag => tag.value);
    const namefilter     = filtername.value.map(tag => tag.value);

    const table = document.getElementById("tablemasteruser");
    const rows  = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (const row of rows) {
        const itemusername = row.getElementsByTagName("td")[0].textContent;
        const itemname     = row.getElementsByTagName("td")[1].textContent;

        const showRow = 
            (usernamefilter.length === 0 || usernamefilter.includes(itemusername)) &&
            (namefilter.length === 0 || namefilter.includes(itemname));

        row.style.display = showRow ? "" : "none";
    }
}

function getdata(btn) {
    masteruser();
};

function adduser(btn){
    var userid              = btn.attr("data-userid");
    var departmentidadduser = $("[name='departmentidadduser']").val();
	$.ajax({
        url        : url+"index.php/mastersystem/department/adduser",
        data       : {userid:userid,departmentidadduser:departmentidadduser},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				masterdatadepartment();
                $('#modal_department_adduser').modal('hide');
			};

            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
	return false;
};

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    masterdatadepartment();
    chart();
});

function masterdatadepartment(){
    var orgid = $("#selectorganization").val();
    $.ajax({
        url       : url + "index.php/mastersystem/department/masterdatadepartment",
        data      : {orgid,orgid},
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
                                            "data_headerid='" + result[j].header_id + "'"+
                                            "data_department='" + result[j].department + "'"+
                                            "data_jabatan='" + result[j].jabatan + "'"+
                                            "data_departmentcode='" + result[j].code + "'"+
                                            "data_headkoordinator='" + result[j].head_koordinator + "'"+
                                            "data_levelid='" + result[j].level_id + "'"+
                                            "data_levelidhead='" + result[j].levelidhead + "'";

                            childElements += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' style='margin-left:" + indent + "px;' data-kt-search-element='customer'>";
                            childElements += "<div class='fw-bold'>";
                            if(result[j].active==="1"){
                                childElements += "<span class='fs-6 text-gray-800 me-2'>"+(result[j].department ? result[j].department : "") + "</span><br>";
                            }else{
                                childElements += "<span class='fs-6 text-gray-800 me-2'>"+(result[j].department ? result[j].department : "") + "</span><span class='badge badge-light-danger'>Non Active</span> <br>";
                            }
                            
                            childElements += "<span class='fs-6 text-gray-800 me-2'>"+(result[j].code ? "<span class='badge badge-light-info'>"+result[j].code+"</span> " : "")+(result[j].jabatan ? result[j].jabatan : "")+"</span><br>";
                            childElements += "<span class='fs-6 text-muted me-2'>"+(result[j].namapj ? result[j].namapj : "")+" </span>";
                            childElements += "</div>";
                            childElements += "<div class='fw-bold d-flex justify-content-end'>";
                                childElements += "<div class='btn-group' role='group'>";
                                    childElements += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                    childElements += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                        childElements += "<a class='dropdown-item btn btn-sm text-primary'  data-bs-toggle='modal' data-bs-target='#modal_department_adduser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Update User</a>";
                                        childElements += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#modal_department_addsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-check2-circle text-success'></i> Add Sub Department</a>";
                                        childElements += "<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_department_editsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Edit Department</a>";
                                        childElements += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" onclick='hapusdata($(this));''><i class='bi bi-trash-fill text-danger'></i> Delete Department</a>";
                                    childElements +="</div>";
                                childElements +="</div>";
                            childElements += "</div>";
                            childElements += "</div>";

                            childElements += generateChildElements(result[j].department_id, level + 1);
                        }
                    }
                    return childElements;
                }

                for(var i in result) {
                    if(result[i].level_id==="1"){
                        getvariabel =   "data_departmentid='" + result[i].department_id + "'"+
                                        "data_department='" + result[i].department + "'"+
                                        "data_departmentcode='" + result[i].code + "'"+
                                        "data_levelid='" + result[i].level_id + "'";

                        tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                        tableresult += "<div class='fw-bold'>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'>"+ result[i].department + "</span><br>";
                        tableresult += "<span class='fs-6 text-gray-800 me-2'>"+ (result[i].jabatan ? result[i].jabatan : "") + "</span><br>";
                        tableresult += "<span class='fs-6 text-muted me-2'>"+ (result[i].namapj ? result[i].namapj : "") + " </span>";
                        tableresult += "</div>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                        tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                        tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary'  data-bs-toggle='modal' data-bs-target='#modal_department_adduser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Update User</a>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-success' data-bs-toggle='modal' data-bs-target='#modal_department_addsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-check2-circle text-success'></i> Add Sub Department</a>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_department_editsubdepartment' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Edit Department</a>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-danger'  "+getvariabel+" onclick='hapusdata($(this));'><i class='bi bi-trash-fill text-danger'></i> Delete Department</a>";
                        tableresult +="</div>";
                        tableresult +="</div>";
                        tableresult += "</div>";
                        tableresult += "</div>";

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
};

function chart(){
    var orgid = $("#selectorganization").val();
    $.ajax({
        url: url + "index.php/mastersystem/department/masterdatadepartment",
        data: { orgid: orgid },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            $("#tree").html(""); // kosongkan wadah org chart
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;

                let nodes = [];

                nodes.push({ id: "top-management", tags: ["top-management"] });

                $.each(result, function (i, row) {
                    if(row.active==="1"){
                        nodes.push({
                            id: "dept-" + row.department_id,
                            pid: row.header_id ? "dept-" + row.header_id : "top-management",
                            tags: ["department"],
                            name: row.department
                        });

                        nodes.push({
                            id   : "emp-" + row.department_id + "-" + i,
                            stpid: "dept-" + row.department_id,
                            name : row.namapj || "",
                            title: row.jabatan || "",
                            dept : "Department Code: " + row.department_id,   // tambahkan property baru
                            img  : url+"assets/images/svg/avatars/001-boy.svg"
                        });
                    }
                    
                });

                // buat orgchart
                let chart = new OrgChart(document.getElementById("tree"), {
                template: "ana",
                enableDragDrop: false,
                nodeBinding: {
                    field_0: "name",
                    field_1: "title",
                    field_2: "dept",   // tampilkan department id
                    img_0: "img"
                },
                tags: {
                    "top-management": {
                        template: "invisibleGroup",
                        subTreeConfig: {
                            orientation: OrgChart.orientation.bottom,
                            collapse: { level: 1 }
                        }
                    },
                    "department": {
                        template: "group",
                        nodeMenu: {
                            remove: { text: "Remove Department" }
                        }
                    }
                },
                nodeMenu: {
                    delete: { text: "Delete", icon: OrgChart.icon.remove }
                },
                nodeMenuHandler: function (id, action, nodeId) {
                    if (action === "delete") {
                        if (confirm("Yakin ingin menghapus node ini dari database?")) {
                            
                            console.log("Menghapus node:", nodeId); // cek ID yg dikirim

                            // Kirim AJAX ke backend dulu
                            $.ajax({
                                url: url + "mastersystem/department/hapusdata",
                                type: "POST",
                                dataType: "json",
                                data: { datatransid: nodeId },
                                success: function (res) {
                                    console.log("Respon server:", res);

                                    if (res.responCode === "00") {
                                        // baru hapus node di chart kalau sukses
                                        chart.removeNode(nodeId);
                                        alert("Node berhasil dihapus");
                                    } else {
                                        alert("Gagal hapus: " + res.responMessage);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.log("AJAX Error:", status, error);
                                    alert("Terjadi kesalahan koneksi ke server.");
                                }
                            });
                        }
                    }
                },
                toolbar: {
                    fullScreen: true,
                    zoom: true,
                    fit: true,
                    expandAll: true
                },
                nodes: nodes
            });

            } else {
                Swal.fire("Info", "Data department tidak ditemukan", "warning");
            }
        },
        error: function (xhr, status, error) {
            Swal.fire("Error", error, "error");
        }
    });
}

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
                let result   = data.responResult;
                var username = new Set();
                var name     = new Set();

                for(var i in result){
                    username.add(result[i].username);
                    name.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].username + "</td>";
                    tableresult += "<td>" + result[i].name + "</td>";
                    tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-light-primary' data-userid='"+result[i].user_id+"' onclick='adduser($(this));'>Pilih</a></td>";
                    tableresult += "</tr>";
                }
            }


            $("#resultmasteruser").html(tableresult);

            filterusername.settings.whitelist = Array.from(username);
            filtername.settings.whitelist = Array.from(name);

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

function hapusdata(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var datatransid = btn.attr("data_departmentid");

            $.ajax({
                url       : url+"index.php/mastersystem/department/hapusdata",
                data      : {datatransid:datatransid},
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
                complete: function () {
                    masterdatadepartment();
                },
                error: function (xhr, status, error) {
                    showAlert(
                        "I'm Sorry",
                        error,
                        "error",
                        "Please Try Again",
                        "btn btn-danger"
                    );
                }
            });
        }
    });
    return false;
};

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
            if(data.responCode == "00"){
                masterdatadepartment();
                chart();
                $('#modal_department_addsubdepartment').modal('hide');
			}

            toastr.clear();
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
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
                masterdatadepartment();
                chart();
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

$(document).on("change","select[name='modal_department_editsubdepartment_departmentid']",function(e){
	e.preventDefault();
	var departmentid = $(this).val();
	$.ajax({
		method : "POST",
		url    : url+"index.php/mastersystem/department/masterbagian",
		data   : {departmentid:departmentid},
		cache  : false,
		success: function (data) {
			$("select[name='modal_department_editsubdepartment_bagianid']").html(data);
		}
	});
});

$(document).on("change","select[name='modal_department_editsubdepartment_bagianid']",function(e){
	e.preventDefault();
	var unitid = $(this).val();
	$.ajax({
		method : "POST",
		url    : url+"index.php/mastersystem/department/masterunit",
		data   : {unitid:unitid},
		cache  : false,
		success: function (data) {
			$("select[name='modal_department_editsubdepartment_unitid']").html(data);
		}
	});
});