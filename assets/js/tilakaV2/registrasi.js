datakaryawan();

$('#searchdatakaryawan').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

$('#modal-registerusertilaka').on('shown.bs.modal', function (e) {
    $('#btnregistrasiusertilaka').prop('disabled', true);
    $('#checkboxsyarattilaka').prop('checked', false);
});

$('#modal-edituser').on('hidden.bs.modal', function (e) {
    Dropzone.autoDiscover = false;
    datakaryawan();
});

$('#checkboxsyarattilaka').change(function() {
    if(this.checked) {
        $('#btnregistrasiusertilaka').prop('disabled', false);
    } else {
        $('#btnregistrasiusertilaka').prop('disabled', true);
    }
});

function getdata(btn){
    var userid         = btn.attr("data-userid");
    var nik            = btn.attr("data-nik");
    var nama           = btn.attr("data-nama");
    var namaktp        = btn.attr("data-namaktp");
    var noktp          = btn.attr("data-noktp");
    var email          = btn.attr("data-email");
    var useridentifier = btn.attr("data-useridentifier");

	$(":hidden[name='userid-edit']").val(userid);
    $(":hidden[name='userid-registrasi']").val(userid);
    $(":hidden[name='useridentifier']").val(useridentifier);
    $(":hidden[name='useridentifier-reenroll']").val(useridentifier);

    $("input[name='nikrs-edit']").val(nik);
    $("input[name='namakaryawan-edit']").val(nama);
	
    if(namaktp==="null"){
        $("input[name='namaktp-edit']").val(nama);
    }else{
        $("input[name='namaktp-edit']").val(namaktp);
    }

    if(noktp==="null"){
        $("input[name='noktp-edit']").val("");
    }else{
        $("input[name='noktp-edit']").val(noktp);
    }
	if(email==="null"){
        $("input[name='email-edit']").val("");
    }else{
        $("input[name='email-edit']").val(email);
    }

    var myDropzone = new Dropzone("#file_doc", {
        url             : url + "index.php/tilaka/registrasi/uploadktp?userid="+userid,
        acceptedFiles   : '.jpeg',
        paramName       : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles        : 1,
        maxFilesize     : 2,
        addRemoveLinks  : true,
        autoProcessQueue: true,
        accept: function(file, done) {
            done();
        }
    });
};

function certificatestatus(btn){
    var userid         = $(btn).attr("data-userid");
    var useridentifier = $(btn).attr("data-useridentifier");
    var registerid     = $(btn).attr("data-registerid");
    $.ajax({
        url       : url+"index.php/tilakaV2/registrasi/certificatestatus",
        data      : {userid:userid,useridentifier:useridentifier,registerid:registerid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            toastr.clear();
            var result = data.responResult;

            if(result['success']){
                if(result['status']===0){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<b>Message : "+result['data'][0]['status']+"<br>Serial Number : "+result['data'][0]['serialnumber']+"<br>Expired Date : "+result['data'][0]['expiry_date']+"</b>",
                        icon             : "info",
                        confirmButtonText: 'Please Try Again',
                        customClass      : {confirmButton: 'btn btn-danger'},
                        timerProgressBar : true,
                        timer            : 5000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    });
                };
    
                if(result['status']===1){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<h6>"+result['message']['info']+"</br> Mohon Menunggu Silakan Lakukan Pengecekan Secara Berkala</b>",
                        icon             : "info",
                        confirmButtonText: 'Please Try Again',
                        customClass      : {confirmButton: 'btn btn-danger'},
                        timerProgressBar : true,
                        timer            : 10000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    });
                };
    
                if(result['status']===2){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<b>Message : "+result['message']['info']+"<br>Serial Number : "+result['message']['serialnumber']+"<br>Unique Id : "+result['message']['uniqueId']+"</b>",
                        icon             : "info",
                        confirmButtonText: 'Please Try Again',
                        customClass      : {confirmButton: 'btn btn-danger'},
                        timerProgressBar : true,
                        timer            : 5000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    });
                };
    
                if(result['status']===3){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<h6>Status : "+result['data'][0]['status']+"<br>Serial Number : "+result['data'][0]['serialnumber']+"<br>Active Date : "+result['data'][0]['start_active_date']+"<br>Expired Date : "+result['data'][0]['expiry_date']+"</b>",
                        icon             : "success",
                        confirmButtonText: 'Yeah, got it!',
                        customClass      : {confirmButton: 'btn btn-success'},
                        timerProgressBar : true,
                        timer            : 10000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    });
                };
    
                if(result['status']===4){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<b>Message : "+result['message']['info']+"</b>",
                        icon             : "success",
                        confirmButtonText: 'Please Try Again',
                        customClass      : {confirmButton: 'btn btn-danger'},
                        timerProgressBar : true,
                        timer            : 5000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    });
                };
            }else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+result['message']['info']+"</b>",
                    icon             : "error",
                    confirmButtonText: 'Please Try Again',
                    customClass      : {confirmButton: 'btn btn-danger'},
                    timerProgressBar : true,
                    timer            : 5000,
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            }
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
		},
		complete: function () {
			datakaryawan();
		}
    });
    return false;
};

function datakaryawan(){
    const search = $("input[name='searchdatakaryawan']").val().toUpperCase();
    $.ajax({
        url        : url+"index.php/tilakaV2/registrasi/datakaryawan",
        data       : {search:search},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterkaryawan").html("");
        },
        success:function(data){
            toastr.clear();
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];

            if(data.responCode==="00"){
                var result = data.responResult;
                for(var i in result){
                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];
                    var statususer  = "<td><div class='badge badge-light-success fw-bolder'></div></td>";
                    var btnaction   = "";

                    getvariabel =   "data-userid='"+result[i].USER_ID+"'"+
                                    "data-nik='"+result[i].NIK+"'"+
                                    "data-nama='"+result[i].NAME+"'"+
                                    "data-namaktp='"+result[i].NAME_IDENTITY+"'"+
                                    "data-noktp='"+result[i].IDENTITY_NO+"'"+
                                    "data-useridentifier='"+result[i].USER_IDENTIFIER+"'"+
                                    "data-registerid='"+result[i].REGISTER_ID+"'"+
                                    "data-issueid='"+result[i].ISSUE_ID+"'"+
                                    "data-email='"+result[i].EMAIL+"'";

                    btnedit           = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-edituser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Perbaharui Data</a>";
                    btnpengajuan      = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registerusertilaka' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Pengajuan</a>";
                    btnrevoke         = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-revoke' "+getvariabel+" onclick='getdata($(this));'><i class='fa-solid fa-user-slash text-danger'></i> Revoke</a>";
                    btncheckstatus    = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='certificatestatus(this)'><i class='fa-solid fa-circle-check text-success'></i> Check Status</a>";
                    btnverifpengajuan = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/guide?request_id="+result[i].REGISTER_ID+"&redirect_url="+url+"index.php/tilakaV2/registrasi'><i class='bi bi-person-bounding-box'></i> Liveness</a>";
                    btnappcertificate = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/link-account?setting=1&channel_id="+clientidtilaka+"&request_id="+result[i].REGISTER_ID+"&redirect_url="+url+"index.php/tilakaV2/registrasi'><i class='bi bi-shield-check'></i> Activation</a>";
                    

                    if(result[i].REGISTER_ID===""){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Data Belum Lengkap</div><div class='small'>Silakan Melakukan Melengkapi No KTP, Email dan Upload KTP</div></td>";
                        btnaction = btnedit;
                    }

                    if(result[i].REGISTER_ID==="" && result[i].IDENTITY_NO!=null && result[i].EMAIL!=null && result[i].IMAGE_IDENTITY==="Y"){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Data Lengkap</div><div class='small'>Silakan Melakukan Pengajuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction = btnedit+btnpengajuan;
                    }

                    if(result[i].REGISTER_ID!="" && result[i].CERTIFICATE===""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Pengajuan Berhasil</div><div class='small'>Silakan Melakukan face recognition / Liveness</div></td>";
                        btnaction = btnverifpengajuan;
                    }

                    if(result[i].CERTIFICATE==="0"){
                        statususer = "<td><div class='badge badge-light-info fw-bolder'>"+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'></div></td>";
                    }

                    if(result[i].CERTIFICATE==="1"){
                        statususer = "<td><div class='badge badge-light-info fw-bolder'>"+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Mohon Menunggu Silakan Lakukan Pengecekan Secara Berkala</div></td>";
                    }

                    if(result[i].CERTIFICATE==="2"){
                        statususer = "<td><div class='badge badge-light-success fw-bolder'>"+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Silakan Melakukan Aktivasi</div></td>";
                        btnaction  = btnappcertificate;
                    }

                    if(result[i].CERTIFICATE==="3"){
                        statususer = "<td><div class='badge badge-light-success fw-bolder'>Sertifikat "+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Active : "+(result[i].startactive ? result[i].startactive : "")+" Expired :"+(result[i].expireddate ? result[i].expireddate : "")+"</div></td>";
                        if(result[i].REVOKE_ID===""){
                            btnaction  = btncheckstatus+btnrevoke;
                        }else{
                            btnaction  = btncheckstatus;
                        }
                    }

                    tableresult +="<tr>";
                        tableresult +="<td class='d-flex align-items-center'>";
                                tableresult +="<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>";
                                    tableresult +="<a href='#'>";
                                        if(result[i].IMAGE_PROFILE==="N"){
                                            tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initial+"</div>";
                                        }else{
                                            tableresult +="<div class='symbol-label'>";
                                            tableresult +="<img src='"+url+"assets/images/avatars/"+result[i].USER_ID+".jpeg' alt='"+result[i].NAME+"' class='w-100'>";
                                            tableresult +="</div>";
                                        }
                                    tableresult +="</a>";
                                tableresult +="</div>";
                                tableresult +="<div class='d-flex flex-column'>";
                                    if(result[i].REGISTER_ID!=""){
                                        tableresult +="<a class='text-gray-800 text-hover-primary mb-1' "+getvariabel+" onclick='certificatestatus(this)' style='cursor: pointer;'>"+result[i].NAME+"</a>";
                                    }else{
                                        tableresult +="<a class='text-gray-800 text-hover-primary mb-1'>"+result[i].NAME+"</a>";
                                    }
                                    tableresult +="<span>"+(result[i].EMAIL ? result[i].EMAIL : "-")+"</span>";
                                tableresult +="</div>";
                        tableresult +="</td>";
                        tableresult += "<td><div>"+(result[i].NIK ? result[i].NIK : "")+"</div><div>" + (result[i].IDENTITY_NO ? result[i].IDENTITY_NO : "") + "</div></td>";
                        tableresult += "<td>"+(result[i].USER_IDENTIFIER ? result[i].USER_IDENTIFIER : "")+"</td>";
                        tableresult += statususer;
                        tableresult +="<td class='text-end'>";
                            tableresult +="<div class='btn-group' role='group'>";
                                tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult +=btnaction;                  
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultmasterkaryawan").html(tableresult);
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

$(document).on("submit", "#formedituser", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/tilakaV2/registrasi/edituser',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr["info"]("Sending request...", "Please wait");
        },
		success: function (data) {
			if(data.responCode === "00"){
				datakaryawan();
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $('#modal-edituser').modal('hide');
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
});

$(document).on("submit", "#formregisteruser", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/tilakaV2/registrasi/registrasiuser',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $('#btnregistrasiusertilaka').prop('disabled', true);
        },
		success: function (data) {
			if(data.responCode==="00"){
                var result = data.responResult;
                if(result['success']){
                    window.location.href = tilakabaseurl + "personal-webview/guide?request_id="+result['data'][0]+"&redirect_url=" + url + "index.php/tilakaV2/registrasi";
                }else{
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                        html             : "<b>"+result['message']+"</b>",
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
            }

            datakaryawan();
		},
        complete: function () {
            $('#modal-registerusertilaka').modal('hide');
            $('#btnregistrasiusertilaka').prop('disabled', false);
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

$(document).on("submit", "#formrevoke", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/tilakaV2/registrasi/revoke',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $('#btnrevoke').prop('disabled', true);
        },
		success: function (data) {
            var result        = data.responResult;
            if(result['success']){
                window.location.href = tilakabaseurl+"personal-webview/kyc/re-enroll?issue_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilakaV2/registrasi";
            }else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+result['message']+"</b>",
                    icon             : "error",
                    confirmButtonText: 'Please Try Again',
                    customClass      : {confirmButton: 'btn btn-danger'},
                    timerProgressBar : true,
                    timer            : 5000,
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            }
		},
        complete: function () {
            $('#modal-revoke').modal('hide');
            $('#btnrevoke').prop('disabled', false);
            datakaryawan();
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