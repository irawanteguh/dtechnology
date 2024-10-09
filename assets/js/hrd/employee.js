$(document).on("change", "select[name='drawer_data_employee_registrationkategoritenaga_days_add'], select[name='drawer_data_employee_registrationkategoritenaga_hours_add']", function (e) {
    e.preventDefault();
    calculateTotalHours();
});

function calculateTotalHours() {
    var daysSelect = document.getElementById('drawer_data_employee_registrationkategoritenaga_days_add');
    var hoursSelect = document.getElementById('drawer_data_employee_registrationkategoritenaga_hours_add');

    var days  = parseInt(daysSelect.value) || 0;
    var hours = parseInt(hoursSelect.value) || 0;

    $("input[name='drawer_data_employee_registrationkategoritenaga_totalhours_add']").val(days * hours * 60);
}

masteremployee();

$("#modal_employee_registrationposition_view").on('hide.bs.modal', function(){
    $(":hidden[name='modal_data_employee_registrationposition_transid_view']").val("");
    $("input[name='modal_data_employee_registrationposition_name_view']").val("");
    $("input[name='modal_data_employee_registrationposition_position_view']").val("");
    $("input[name='modal_data_employee_registrationposition_atasan_view']").val("");
    $("input[name='modal_data_employee_registrationposition_nik_view']").val("");
});

flatpickr('[name="drawer_data_employee_registrationposition_date_add"], [name="drawer_data_employee_registrationposition_date_edit"]', {
    enableTime: false,
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange: function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function getdata(btn){
    toastr.clear();

    var userid            = btn.attr("data-userid");
    var transid           = btn.attr("data-transid");
    var name              = btn.attr("data-name");
    var positioidprimary  = btn.attr("data-positioidprimary");
    var positionprimary   = btn.attr("data-positionprimary");
    var funsgionalprimary = btn.attr("data-funsgionalprimary");
    var atasanidprimary   = btn.attr("data-atasanidprimary");
    var atasanprimary     = btn.attr("data-atasanprimary");
    var kategoriid        = btn.attr("data-kategoriid");
    var kategori          = btn.attr("data-kategori");
    var type              = btn.attr("data-type");
    var dutydays          = btn.attr("data-dutydays");
    var dutyhours         = btn.attr("data-dutyhours");
    var hoursmonth        = btn.attr("data-hoursmonth");
    var nik               = btn.attr("data-nik");

    namaatasan(userid,atasanidprimary);
    position(positioidprimary);

    //Drawer
	$(":hidden[name='drawer_data_employee_registrationposition_userid_add']").val(userid);
    $(":hidden[name='drawer_data_employee_registrationkategoritenaga_userid_add']").val(userid);

	$("input[name='drawer_data_employee_registrationposition_name_add']").val(name);
    $("input[name='drawer_data_employee_registrationkategoritenaga_name_add']").val(name);
    $("input[name='drawer_data_employee_registrationkategoritenaga_totalhours_add']").val(hoursmonth);

    var $classification = $('#drawer_data_employee_registrationkategoritenaga_classifictionid_add').select2();
        $classification.val(kategoriid).trigger('change');

    //Modal
    $(":hidden[name='modal_data_employee_registrationposition_transid_view']").val(transid);
    $(":hidden[name='modal_data_employee_registrationposition_transid_edit']").val(transid);
    $(":hidden[name='modal_data_employee_registrationposition_userid_edit']").val(userid);
    $("input[name='modal_data_employee_registrationposition_name_view']").val(name);
    $("input[name='modal_data_employee_registrationposition_name_edit']").val(name);
    $("input[name='modal_data_employee_registrationposition_nik_view']").val(nik);
    $("input[name='modal_data_employee_registrationposition_nik_edit']").val(nik);

    if(funsgionalprimary != "null"){
        $("input[name='modal_data_employee_registrationposition_position_view']").val(positionprimary+" "+funsgionalprimary);
    }else{
        $("input[name='modal_data_employee_registrationposition_position_view']").val(positionprimary);
    }
    
    $("input[name='modal_data_employee_registrationposition_atasan_view']").val(atasanprimary);

    var $typeid = $('#modal_data_employee_registrationposition_type_edit').select2();
    $typeid.val(type).trigger('change');

    var $dutydaysid = $('#drawer_data_employee_registrationkategoritenaga_days_add').select2();
    $dutydaysid.val(dutydays).trigger('change');

    var $dutyhoursid = $('#drawer_data_employee_registrationkategoritenaga_hours_add').select2();
    $dutyhoursid.val(dutyhours).trigger('change');
};

function namaatasan(userid,atasanidprimary){
	$.ajax({
		url     : url+"index.php/hrd/employee/namaatasan",
		data    : {userid:userid},
		method  : "POST",
		dataType: "html",
		cache   : false,
		success : function (data) {
			$("select[name='drawer_data_employee_registrationposition_atasanid_add']").html(data);
            $("select[name='modal_data_employee_registrationposition_atasanid_edit']").html(data);
		},
        complete: function () {
            var $atasanid = $('#modal_data_employee_registrationposition_atasanid_edit').select2();
            $atasanid.val(atasanidprimary).trigger('change');
		}
	});
	return false;
};

function position(positioidprimary){
	$.ajax({
		url     : url+"index.php/hrd/employee/position",
		method  : "POST",
		dataType: "html",
		cache   : false,
		success : function (data) {
			$("select[name='drawer_data_employee_registrationposition_positionid_add']").html(data);
            $("select[name='modal_data_employee_registrationposition_positionid_edit']").html(data);
		},
        complete: function () {
            var $positionid = $('#modal_data_employee_registrationposition_positionid_edit').select2();
            $positionid.val(positioidprimary).trigger('change');
		}
	});
	return false;
};

function masteremployee(){
    $.ajax({
        url        : url+"index.php/hrd/employee/masteremployee",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteremployee").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";
            var getvariabelsecodary = "";
            var color               = ['danger','warning','success','primary'];
            var jml                 = 0;

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    getvariabel =   "data-userid='"+result[i].user_id+"'"+
                                    "data-transid='"+result[i].transidprimary+"'"+
                                    "data-name='"+result[i].name+"'"+
                                    "data-positioidprimary='"+result[i].positioidprimary+"'"+
                                    "data-positionprimary='"+result[i].positionprimary+"'"+
                                    "data-funsgionalprimary='"+result[i].fungsionalprimary+"'"+
                                    "data-atasanidprimary='"+result[i].atasanidprimary+"'"+
                                    "data-atasanprimary='"+result[i].atasanprimary+"'"+
                                    "data-kategoriid='"+result[i].kategori_id+"'"+
                                    "data-kategori='"+result[i].kategori+"'"+
                                    "data-type='Y'"+
                                    "data-dutydays='"+result[i].duty_days+"'"+
                                    "data-dutyhours='"+result[i].duty_hours+"'"+
                                    "data-hoursmonth='"+result[i].hours_month+"'"+
                                    "data-nik='"+result[i].nik+"'";

                    tableresult +="<tr>";
                    tableresult +="<td>";
                        tableresult +="<div class=' align-middle d-flex align-items-center ps-4'>";
                            tableresult +="<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>";
                                tableresult +="<a href='#'>";
                                    if(result[i].image_profile==="N"){
                                        tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initial+"</div>";
                                    }else{
                                        tableresult +="<div class='symbol-label'>";
                                        tableresult +="<img src='"+url+"assets/images/avatars/"+result[i].user_id+".jpeg' alt='"+result[i].name+"' class='w-100'>";
                                        tableresult +="</div>";
                                    }
                                tableresult +="</a>";
                            tableresult +="</div>";

                            tableresult +="<div class='d-flex flex-column'>";
                                tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].name+"</a>";
                                tableresult +="<span>"+(result[i].email ? result[i].email : "-")+"</span>";
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";
                    
                    tableresult +="<td><div>"+(result[i].nik ? result[i].nik : "")+"</div><div>" + (result[i].identity_no ? result[i].identity_no : "") + "</div></td>";
                    tableresult +="<td><div>"+(result[i].hours_month ? todesimal(result[i].hours_month)  : "")+"</div><div>Minutes / Month</div></td>";
                    tableresult +="<td>"+(result[i].kategori ? result[i].kategori : "")+"</td>";
                    tableresult +="<td><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_employee_registrationposition_view' "+getvariabel+" onclick='getdata($(this));'>"+(result[i].positionprimary ? result[i].positionprimary : "")+(result[i].fungsionalprimary ? " "+result[i].fungsionalprimary : "")+"</a></div><div>"+(result[i].atasanprimary ? result[i].atasanprimary : "")+"</div></td>"

                    var userIdsprimary = result[i].membersecondry ? result[i].membersecondry.split(';') : [];
                    tableresult += "<td>";
                    for (var j = 0; j < userIdsprimary.length; j++) {
                        var userProfile = userIdsprimary[j].trim().split(':');

                        if (userProfile.length === 6) {
                            var transid    = userProfile[0];
                            var positionid = userProfile[1];
                            var atasanid   = userProfile[2];
                            var position   = userProfile[3];
                            var level      = userProfile[4];
                            var atasan     = userProfile[5];
                            
                        } else if (userProfile.length === 5) { 
                            var transid    = userProfile[0];
                            var positionid = userProfile[1];
                            var atasanid   = userProfile[2];
                            var position   = userProfile[3];
                            var level      = "";
                            var atasan     = userProfile[4];
                        }

                        getvariabelsecodary =   "data-userid='"+result[i].user_id+"'"+
                                                "data-transid='"+transid+"'"+
                                                "data-name='"+result[i].name+"'"+
                                                // "data-positioidprimary='"+result[i].positioidprimary+"'"+
                                                "data-positionprimary='"+position+"'"+
                                                "data-funsgionalprimary='"+level+"'"+
                                                "data-atasanidprimary='"+atasanid+"'"+
                                                "data-atasanprimary='"+atasan+"'"+
                                                // "data-kategoriid='"+result[i].kategori_id+"'"+
                                                // "data-kategori='"+result[i].kategori+"'"+
                                                "data-type='N'"+
                                                "data-nik='"+result[i].nik+"'";

                        tableresult += "<div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_employee_registrationposition_view' "+getvariabelsecodary+" onclick='getdata($(this));'>"+position+" "+level+"</a></div><div>"+atasan+"</div>";
                        
                        if (j < userIdsprimary.length - 1) {
                            tableresult += "<div class='separator my-2'></div>";
                        }
                    }
                    tableresult += "</td>";


                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_registrationkategoritenaga_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Classification Category</a>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_registrationposition_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Positioning</a>";
                                tableresult += "<div class='separator my-2'></div>";
                                tableresult += "<a class='dropdown-item btn btn-sm btn-light-danger' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_registrationposition_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-trash-fill'></i> Non Active</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultmasteremployee").html(tableresult);
            $("#info_list_employee").html(todesimal(jml)+" Staff");
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
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

$(document).on("submit", "#forminsertpenempatan", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/hrd/employee/insertpenempatan',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_position_registrasi").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $('#drawer_employee_registrationposition_add_close').trigger('click');
				masteremployee();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
                $("#btn_position_registrasi").removeClass("disabled");
            }
		},
        complete: function () {
            toastr.clear();
            $("#btn_position_registrasi").removeClass("disabled");
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

$(document).on("submit", "#formeditpenempatan", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/hrd/employee/editpenempatan',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_employee_edit").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_employee_registrationposition_edit").modal("hide");
				masteremployee();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
                $("#btn_employee_edit").removeClass("disabled");
            }
		},
        complete: function () {
            toastr.clear();
            $("#btn_employee_edit").removeClass("disabled");
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

$(document).on("submit", "#formupdatekategoritenaga", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/hrd/employee/updatekategoritenaga',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_registrationkategoritenaga_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $('#drawer_employee_registrationkategoritenaga_add_close').trigger('click');
				masteremployee();
			}else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
                $("#btn_registrationkategoritenaga_add").removeClass("disabled");
            }
		},
        complete: function () {
            toastr.clear();
            $("#btn_registrationkategoritenaga_add").removeClass("disabled");
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

function hapus(userid){
	$.ajax({
		url     : url+"index.php/hrd/employee/namaatasan",
		data    : {userid:userid},
		method  : "POST",
		dataType: "html",
		cache   : false,
		success : function (data) {
			$("select[name='drawer_data_employee_registrationposition_atasanid_add']").html(data);
		}
	});
	return false;
};

document.getElementById('modal_employee_registrationposition_delete').addEventListener('click', function() {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var transId = document.getElementById('modal_data_employee_registrationposition_transid_view').value;
            $.ajax({
                url    : url+"index.php/hrd/employee/hapuspenempatan",
                type   : 'POST',
                data   : { modal_data_employee_registrationposition_transid_view: transId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    
                    if(jsonResponse.responCode === "00"){
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                            html             : "<b>The position has been deleted.</b>",
                            icon             : jsonResponse.responHead,
                            confirmButtonText: 'Yeah, got it!',
                            customClass      : {confirmButton: 'btn btn-success'},
                            timerProgressBar : true,
                            timer            : 2000,
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        }).then(function (result) {
                            if(result.isConfirmed){
                                masteremployee();
                                $("#modal_employee_registrationposition_view").modal("hide");
                            }else{
                                masteremployee();
                                $("#modal_employee_registrationposition_view").modal("hide");
                            }
                        });
                    }else{
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>The position could not be deleted.</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : {confirmButton: "btn btn-danger"},
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                        html             : "<b>There was a problem with the server.</b>",
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
        }
    });
});

document.getElementById('modal_employee_registrationposition_nonactive').addEventListener('click', function() {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var transId = document.getElementById('modal_data_employee_registrationposition_transid_view').value;
            $.ajax({
                url    : url+"index.php/hrd/employee/nonactivepenempatan",
                type   : 'POST',
                data   : { modal_data_employee_registrationposition_transid_view: transId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    
                    if(jsonResponse.responCode === "00"){
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                            html             : "<b>The position has been deleted.</b>",
                            icon             : jsonResponse.responHead,
                            confirmButtonText: 'Yeah, got it!',
                            customClass      : {confirmButton: 'btn btn-success'},
                            timerProgressBar : true,
                            timer            : 2000,
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        }).then(function (result) {
                            if(result.isConfirmed){
                                masteremployee();
                                $("#modal_employee_registrationposition_view").modal("hide");
                            }else{
                                masteremployee();
                                $("#modal_employee_registrationposition_view").modal("hide");
                            }
                        });
                    }else{
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>The position could not be deleted.</b>",
                            icon             : "error",
                            confirmButtonText: "Please Try Again",
                            buttonsStyling   : false,
                            timerProgressBar : true,
                            timer            : 5000,
                            customClass      : {confirmButton: "btn btn-danger"},
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                        html             : "<b>There was a problem with the server.</b>",
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
        }
    });
});