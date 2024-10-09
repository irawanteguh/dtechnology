Dropzone.autoDiscover = false;


datakaryawan();

$('#modal-edituser').on('hidden.bs.modal', function (e) {
    Dropzone.autoDiscover = false;
    datakaryawan();
});

$('#modal-registerusertilaka').on('shown.bs.modal', function (e) {
    $('#btnregistrasiusertilaka').prop('disabled', true);
    $('#checkboxsyarattilaka').prop('checked', false);
});

$('#checkboxsyarattilaka').change(function() {
    if(this.checked) {
        $('#btnregistrasiusertilaka').prop('disabled', false);
    } else {
        $('#btnregistrasiusertilaka').prop('disabled', true);
    }
});

$('#searchtablemasterkaryawan').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

function getdata(btn){
	var userid  = btn.attr("data-userid");
	var nik     = btn.attr("data-nik");
	var nama    = btn.attr("data-nama");
	var namaktp = btn.attr("data-namaktp");
	var noktp   = btn.attr("data-noktp");
	var email   = btn.attr("data-email");

	$(":hidden[name='userid-edit']").val(userid);
    $(":hidden[name='userid-registrasi']").val(userid);
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
};

function getdataedit(btn){
	var userid  = btn.attr("data-userid");
	var nik     = btn.attr("data-nik");
	var nama    = btn.attr("data-nama");
	var namaktp = btn.attr("data-namaktp");
	var noktp   = btn.attr("data-noktp");
	var email   = btn.attr("data-email");

	$(":hidden[name='userid-edit']").val(userid);
    $(":hidden[name='userid-registrasi']").val(userid);
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
        url       : url+"index.php/tilaka/registrasi/certificatestatus",
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
            var result        = data.responResult;

            if(result['success']===false){
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
            };

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
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		},
		complete: function () {
			datakaryawan();
		}
    });
    return false;
};

function revoke(btn){
    var useridentifier = $(btn).attr("data-useridentifier");
    $.ajax({
        url       : url+"index.php/tilaka/registrasi/revoke",
        data      : {useridentifier:useridentifier},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result        = data.responResult;

            if(result['success']){
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                    html             : "<b>"+result['message']+"<br>Dengan Nomor Issue ID : </b><br><b>"+result['data'][0]+"</b>",
                    icon             : data.responHead,
                    confirmButtonText: 'Yeah, got it!',
                    customClass      : {confirmButton: 'btn btn-success'},
                    timerProgressBar : true,
                    timer            : 5000,
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                }).then(function (result) {
                    if(result.isConfirmed){
                        window.open(tilakabaseurl+"personal-webview/kyc/re-enroll?issue_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                    }else{
                        if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                            window.open(tilakabaseurl+"personal-webview/kyc/re-enroll?issue_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                        }
                    }
                });
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
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		},
		complete: function () {
			datakaryawan();
		}
    });
    return false;
};

function reenroll(btn){
    var useridentifier = $(btn).attr("data-useridentifier");
    $.ajax({
        url       : url+"index.php/tilaka/registrasi/reenroll",
        data      : {useridentifier:useridentifier},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result        = data.responResult;

            if(data.responCode === "00"){
                if(result['success']){
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                        html             : "<b>"+result['message']+"<br>Dengan Nomor Issue Id : </b><br><b>"+result['data'][0]+"</b>",
                        icon             : data.responHead,
                        confirmButtonText: 'Yeah, got it!',
                        customClass      : {confirmButton: 'btn btn-success'},
                        timerProgressBar : true,
                        timer            : 5000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    }).then(function (result) {
                        if(result.isConfirmed){
                            window.open(tilakabaseurl+"ersonal-webview/kyc/revoke?revoke_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                        }else{
                            if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                                window.open(tilakabaseurl+"ersonal-webview/kyc/revoke?revoke_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                            }
                        }
                    }); 
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
            }else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html             : "<b>"+data.responDesc+"</b>",
                    icon             : data.responHead,
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
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		},
		complete: function () {
			datakaryawan();
		}
    });
    return false;
};

function datakaryawan(){
    const search = $("input[name='teguh']").val().toUpperCase();
    $.ajax({
        url        : url+"index.php/tilaka/registrasi/datakaryawan",
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
            var result      = "";
            var tableresult = "";
            var getvariabel = "";
            var color       = ['danger','warning','success','primary'];

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];
                        btnaction   = "";
                        statususer  = "<td><div class='badge badge-light-success fw-bolder'></div></td>";

                    getvariabel =   "data-userid='"+result[i].USER_ID+"'"+
                                    "data-nik='"+result[i].NIK+"'"+
                                    "data-nama='"+result[i].NAME+"'"+
                                    "data-namaktp='"+result[i].NAME_IDENTITY+"'"+
                                    "data-noktp='"+result[i].IDENTITY_NO+"'"+
                                    "data-useridentifier='"+result[i].USER_IDENTIFIER+"'"+
                                    "data-registerid='"+result[i].REGISTER_ID+"'"+
                                    "data-issueid='"+result[i].ISSUE_ID+"'"+
                                    "data-email='"+result[i].EMAIL+"'";

                    btnedit             = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-edituser' "+getvariabel+" onclick='getdataedit($(this));'><i class='bi bi-pencil'></i> Perbaharui Data</a>";
                    btnpengajuan        = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registerusertilaka' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Pengajuan</a>";
                    
                    btnreenroll         = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='reenroll(this)' title='Re Enroll'><i class='fa-solid fa-user-clock text-success'></i> Re Enroll</a>";
                    btncheckstatus      = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='certificatestatus(this)'><i class='fa-solid fa-circle-check text-success'></i> Check Status</a>";
                    btnrevoke           = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='revoke(this)'><i class='fa-solid fa-user-slash text-danger'></i> Revoke</a>";
                    btnverifpengajuan   = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/guide?request_id="+result[i].REGISTER_ID+"&redirect_url="+url+"index.php/tilaka/registrasi'><i class='fa-solid fa-list-check'></i> Verification Pengajuan</a>";
                    btnverifikasienroll = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/kyc/re-enroll?issue_id="+result[i].ISSUE_ID+"&redirect_url="+url+"index.php/tilaka/registrasi'><i class='fa-solid fa-list-check'></i> Verification Re Enroll</a>";
                    btnappcertificate   = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/link-account?setting=1&channel_id="+clientidtilaka+"&request_id="+result[i].REGISTER_ID+"&redirect_url="+url+"index.php/tilaka/registrasi'><i class='fa-solid fa-file-circle-check'></i> Approval Certificate</a>";
                    
                    btnapprevoke        = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/kyc/revoke?revoke_id="+result[i].REVOKE_ID+"&redirect_url="+url+"index.php/tilaka/registrasi' title='Revoke Approval'><i class='fa-solid fa-user-slash text-danger'></i> Revoke Approval</a>";
                    btngantimfa         = "<a class='dropdown-item btn btn-sm' href='"+tilakabaseurl+"personal-webview/login?setting=2&tilaka_name="+result[i].USER_IDENTIFIER+"&redirect_url="+url+"index.php/tilaka/registrasi&channel_id="+clientidtilaka+"'><i class='fa-solid fa-arrows-spin text-primary'></i> Change MFA</a>";

                    if(result[i].REGISTER_ID===""){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Data Belum Lengkap</div><div class='small'>Silakan Melakukan Melengkapi No KTP, Email dan Upload KTP</div></td>";
                        btnaction = btnedit;
                    }

                    if(result[i].REGISTER_ID==="" && result[i].IDENTITY_NO!=null && result[i].EMAIL!=null && result[i].IMAGE_IDENTITY==="Y"){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Data Lengkap</div><div class='small'>Silakan Melakukan Pengajuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction = btnedit+btnpengajuan;
                    }

                    if((result[i].REGISTER_ID!="" && result[i].USER_IDENTIFIER==="") || (result[i].REGISTER_ID!="" && result[i].USER_IDENTIFIER!="") ){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Pengajuan Berhasil</div><div class='small'>Silakan Melakukan face recognition</div></td>";
                        btnaction = btnverifpengajuan;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="0"){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Sertifikat Expired</div><div class='small'>Sialakan Melakukan Pengajuan Kembali</div></td>";
                        btnaction = btnreenroll;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="1"){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Face Recognition Berhasil</div><div class='small'>Silakan Menunggu Persetujuan Tilaka 1 x 24 Jam</div></td>";
                        btnaction = btncheckstatus;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="2"){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Pengajuan Di Setujui Tilaka</div><div class='small'>Silakan Lakukan Persetujuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction = btnappcertificate;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="3" && result[i].REVOKE_ID===""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Sertifikat Aktif</div><div class='small'>Sertifikat Tanda Tangan Eektronik sudah dapat digunakan</div></td>";
                        btnaction = btncheckstatus+btnrevoke+btngantimfa;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="3" && result[i].REVOKE_ID!="" && result[i].ISSUE_ID===""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Pengajuan Revoke Berhasil</div><div class='small'>Silakan Melakukan face recognition</div></td>";
                        btnaction = btnapprevoke;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="4"){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Pengajuan Di Tolak Tilaka</div><div class='small'>Silakan Melakukan Pengajuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction = btnedit+btnpengajuan;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="X" && result[i].REVOKE_ID!="" && result[i].ISSUE_ID===""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Face Recognition Berhasil</div><div class='small'>Silakan Melakukan Re Enroll Untuk Penerbitan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction = btnreenroll;    
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="X" && result[i].REVOKE_ID!="" && result[i].ISSUE_ID!=""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Pengajuan Re Enroll Berhasil</div><div class='small'>Silakan Melakukan face recognition</div></td>";
                        btnaction = btnverifikasienroll;
                    }

                    if(result[i].REGISTER_ID!="" &&  result[i].USER_IDENTIFIER!="" && result[i].CERTIFICATE==="Y" && result[i].ISSUE_ID!=""){
                        statususer ="<td><div class='badge badge-light-success fw-bolder'>Face Recognition Berhasil</div><div class='small'>Silakan Menunggu Persetujuan Tilaka 1 x 24 Jam</div></td>";
                        btnaction = btncheckstatus;
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
                                    tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#' "+getvariabel+" onclick='certificatestatus(this)'>"+result[i].NAME+"</a>";
                                }else{
                                    tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].NAME+"</a>";
                                }
                                tableresult +="<span>"+(result[i].EMAIL ? result[i].EMAIL : "-")+"</span>";
                            tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult += "<td><div>"+(result[i].NIK ? result[i].NIK : "")+"</div><div>" + (result[i].IDENTITY_NO ? result[i].IDENTITY_NO : "") + "</div></td>";
                    tableresult += "<td>" + (result[i].USER_IDENTIFIER ? result[i].USER_IDENTIFIER : "") + "</td>";
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

$(document).on("submit", "#formedituser", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/tilaka/registrasi/edituser',
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
        url        : url+'index.php/tilaka/registrasi/registrasiuser',
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
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                        html             : "<b>"+result['message']+"<br>Dengan Nomor Registrasi : </b><br><b>"+result['data'][0]+"</b>",
                        icon             : data.responHead,
                        confirmButtonText: 'Yeah, got it!',
                        customClass      : {confirmButton: 'btn btn-success'},
                        timerProgressBar : true,
                        timer            : 5000,
                        showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                        hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                    }).then(function (result) {
                        if(result.isConfirmed){
                            window.open(tilakabaseurl+"personal-webview/guide?request_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                        }else{
                            if(Swal.DismissReason.backdrop || Swal.DismissReason.cancel || Swal.DismissReason.close || Swal.DismissReason.esc || Swal.DismissReason.timer){
                                window.open(tilakabaseurl+"personal-webview/guide?request_id="+result['data'][0]+"&redirect_url="+url+"index.php/tilaka/registrasi", "_self");
                            }
                        }
                    });

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