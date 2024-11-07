datakaryawan();

$('#searchtablemasterkaryawan').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

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

                    btncheckstatus = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='certificatestatus(this)'><i class='fa-solid fa-circle-check text-success'></i> Check Status</a>";

                    if(result[i].CERTIFICATE==="0"){
                        statususer = "<td><div class='badge badge-light-danger fw-bolder'>"+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'></div></td>";
                    }

                    if(result[i].CERTIFICATE==="3"){
                        statususer = "<td><div class='badge badge-light-success fw-bolder'>Sertifikat "+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Active : "+(result[i].startactive ? result[i].startactive : "")+" Expired :"+(result[i].expireddate ? result[i].expireddate : "")+"</div></td>";
                        btnaction  = btncheckstatus;
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
                                        tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].NAME+"</a>";
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