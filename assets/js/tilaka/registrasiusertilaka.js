
datakaryawan();

$('#search').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

$(document).on("click",".btn-edit", function(e){            
    e.preventDefault();
    getdata($(this));
});

function getdata(btn){
	var userid = btn.attr("data-userid");
	var nik    = btn.attr("data-nik");
	var nama   = btn.attr("data-nama");
	var noktp  = btn.attr("data-noktp");
	var email  = btn.attr("data-email");

	$(":hidden[name='userid-edit']").val(userid);
	$("input[name='nikrs-edit']").val(nik);
	$("input[name='namakryawan-edit']").val(nama);
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

function certificatestatus(btn){
    var userid         = $(btn).attr("data-userid");
    var useridentifier = $(btn).attr("data-useridentifier");
    $.ajax({
        url     : url+"index.php/tilaka/registrasiusertilaka/useridentifier",
        data    : {userid:userid,useridentifier:useridentifier},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            result        = data.responResult;

            if(result['status']===1){
                Swal.fire({
                    position         : "center",
                    icon             : data.responHead,
                    title            : "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                    html             : "<h6 class='small'>"+result['message']['info']+"</h6>",
                    timerProgressBar : true,
                    showConfirmButton: false,
                    timer            : 5000,
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        `
                    }
                });
            }else{
                Swal.fire({
                    position         : "center",
                    icon             : data.responHead,
                    title            : "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                    html             : "<h6 class='small'>Status : "+result['data'][0]['status']+"</h6><h6 class='small'>Serial Number : "+result['data'][0]['serialnumber']+"</h6><h6 class='small'>Active Date : "+result['data'][0]['start_active_date']+"</h6><h6 class='small'>Expired Date : "+result['data'][0]['expiry_date']+"</h6>",
                    timerProgressBar : true,
                    showConfirmButton: false,
                    timer            : 5000,
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        `
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			datakaryawan();
		}
    });
    return false;
};

function registrasiuser(btn){
    var userid   = $(btn).attr("data-userid");
    $.ajax({
        url     : url+"index.php/tilaka/registrasiusertilaka/registrasiuser",
        data    : {userid:userid},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result     = "";

            if(data.responCode == "00"){
                result        = data.responResult;

                if(result['success']===false){
                    Swal.fire({
                        position         : "center",
                        icon             : "error",
                        title            : "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                        html             : result['message'],
                        timerProgressBar : true,
                        showConfirmButton: false,
                        timer            : 5000,
                        showClass: {
                            popup: `
                            animate__animated
                            animate__fadeInUp
                            `
                        },
                        hideClass: {
                            popup: `
                            animate__animated
                            animate__fadeOutDown
                            `
                        }
                    });
                }
            }else{
                Swal.fire({
                    position: "center",
                    icon: data.responHead,
                    title: "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                    html: data.responDesc,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 5000,
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        `
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			
		}
    });
    return false;
};

function datakaryawan(){
    var search = $("input[name='search']").val();
    $.ajax({
        url     : url+"index.php/tilaka/registrasiusertilaka/datakaryawan",
        data    : {search:search},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            $("#resultregistrasiusertilaka").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            var getvariabel = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    getvariabel =   "data-userid='"+result[i].USER_ID+"'"+
                                    "data-nik='"+result[i].NIK+"'"+
                                    "data-nama='"+result[i].NAME+"'"+
                                    "data-noktp='"+result[i].IDENTITY_NO+"'"+
                                    "data-useridentifier='"+result[i].USER_IDENTIFIER+"'"+
                                    "data-email='"+result[i].EMAIL+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='text-center'>";
                        tableresult +="<div class='btn-group'>";
                        tableresult +="<a type='button' class='btn btn-primary'>Action</a>";
                            tableresult +="<button type='button' class='btn btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'>";
                                tableresult +="<span class='sr-only'>Toggle Dropdown</span>";
                            tableresult +="</button>";
                            tableresult +="<div class='dropdown-menu' role='menu' style=''>";
                                if(result[i].CERTIFICATE===""){
                                    tableresult +="<a class='dropdown-item btn  btn-edit' data-toggle='modal' data-target='#modal-edituser' "+getvariabel+"><i class='fa-solid fa-user-pen'></i> Perbaharui Data</a>";
                                }
                                if(result[i].IDENTITY_NO!=null&&result[i].EMAIL!=null){
                                    if(result[i].REGISTER_ID!=""){
                                        if(result[i].VERIFICATION==="N"){
                                            tableresult +="<a class='dropdown-item btn' href='https://sb-api.tilaka.id/personal-webview/guide?request_id="+result[i].REGISTER_ID+"&redirect_url=http://localhost/dtechnology/index.php/tilaka/registrasiusertilaka?userid="+result[i].USER_ID+"&registerid="+result[i].REGISTER_ID+"'><i class='fa-solid fa-list-check'></i> Verification</a>";
                                        }else{
                                            if(result[i].CERTIFICATE===""||result[i].CERTIFICATE==="1"){
                                                tableresult +="<a class='dropdown-item btn' "+getvariabel+" onclick='certificatestatus(this)' title='Proses permohonan sertifikat dalam proses'><i class='fa-solid fa-circle-check text-success'></i> Check Status Certificate</a>";
                                            }else{
                                                if(result[i].CERTIFICATE==="2"){
                                                    tableresult +="<a class='dropdown-item btn' href='https://sb-api.tilaka.id/personal-webview/link-account?setting=1&channel_id=be2642fe-a581-4a69-aaad-ed8174dddc7e&request_id="+result[i].REGISTER_ID+"&redirect_url=http://localhost/dtechnology/index.php/tilaka/registrasiusertilaka?userid="+result[i].USER_ID+"&registerid="+result[i].REGISTER_ID+"&useridentifier="+result[i].USER_IDENTIFIER+"'><i class='fa-solid fa-file-circle-check'></i> Approval Certificate</a>";
                                                }else{
                                                    if(result[i].CERTIFICATE==="3"){
                                                        tableresult +="<a class='dropdown-item btn' "+getvariabel+" onclick='certificatestatus(this)' title='Certificate Sudah Di Terbitkan'><i class='fa-solid fa-circle-check text-success'></i> Check Status Certificate</a>";
                                                        tableresult +="<a class='dropdown-item btn' "+getvariabel+" onclick='certificatestatus(this)' title='Certificate Sudah Di Terbitkan'><i class='fa-solid fa-user-slash text-danger'></i> Revoke</a>";
                                                    }else{
                                                        tableresult +="<a class='dropdown-item btn' "+getvariabel+" onclick='certificatestatus(this)' title='Pengajuan Di Tolak'><i class='fa-solid fa-circle-xmark text-danger'></i> Check Status</a>";
                                                    }
                                                }
                                            }
                                        }
                                    }else{
                                        tableresult +="<a class='dropdown-item btn' "+getvariabel+" onclick='registrasiuser(this)' title='Klik Untuk Melakukan Pendaftaran Account / User Tilaka'><i class='fa-solid fa-user-plus'></i> Registrasi Account</a>";
                                    }
                                }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="<td class='text-center align-middle'>"+result[i].NIK+"</td>";
                    tableresult +="<td class='text-left align-middle'>"+result[i].NAME+"</td>";
                    if(result[i].IMAGE_IDENTITY==="N"){
                        tableresult += result[i].IDENTITY_NO === null ? "<td class='text-center'><i class='fa-solid fa-circle-xmark text-danger'></i></td>" : "<td class='text-center align-middle'><i class='fa-solid fa-triangle-exclamation text-warning' title='File KTP Belum Terdapat Dalam Sistem'></i> "+result[i].IDENTITY_NO+"</td>";
                    }else{
                        tableresult += "<td class='text-center align-middle'><i class='fa-solid fa-circle-check text-success' title='File KTP Terdapat Dalam Sistem'></i> "+result[i].IDENTITY_NO+"</td>";
                    }
                    tableresult += result[i].EMAIL === null ? "<td class='text-center'><i class='fa-solid fa-circle-xmark text-danger'></i></td>" : "<td class='text-left align-middle'>" + result[i].EMAIL + "</td>";
                    tableresult += result[i].USER_IDENTIFIER === null ? "<td class='text-center'></td>" : "<td class='text-left align-middle'>" + result[i].USER_IDENTIFIER + "</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultregistrasiusertilaka").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");

        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};

$(document).on("submit", "#formedituser", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/tilaka/registrasiusertilaka/edituser',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            toastr.clear();
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
			toastr.clear();
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
	});
    return false;
});