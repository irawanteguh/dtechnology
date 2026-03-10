datakaryawan();

function getdata(btn){
    var userid         = btn.attr("data-userid");
    var nik            = btn.attr("data-nik");
    var nama           = btn.attr("data-nama");
    var namaktp        = btn.attr("data-namaktp");
    var noktp          = btn.attr("data-noktp");
    var email          = btn.attr("data-email");

	$(":hidden[name='userid-edit']").val(userid);
    $("input[name='nikrs-edit']").val(nik);
    $("input[name='namakaryawan-edit']").val(nama);
    $("input[name='namaktp-edit']").val(namaktp === "null" ? nama : namaktp);
    $("input[name='noktp-edit']").val(noktp === "null" ? "" : noktp);
    $("input[name='email-edit']").val(email === "null" ? "" : email);
};

function certificatestatus(btn){
    var userid = $(btn).attr("data-userid");
    var noktp  = $(btn).attr("data-noktp");
    $.ajax({
        url       : url+"index.php/bsre/registrasi/certificatestatus",
        data      : {userid:userid,noktp:noktp},
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

            if(result['status']===405 || result['status']===500){
                showAlert(
                    "For Your Information",
                    result['error']+"</br>"+result['path'],
                    "error",
                    "Please Check Again",
                    "btn btn-danger"
                );
            };

            if(result['status_code']===1111){
                if(result['status']==="EXPIRED"){
                    showAlert(
                        "For Your Information",
                        "Message : "+result['message'],
                        "error",
                        "Please Check Again",
                        "btn btn-danger"
                    );
                }else{
                    showAlert(
                        "For Your Information",
                        "Message : "+result['message'],
                        "success",
                        "Yeah, got it!",
                        "btn btn-success"
                    );
                }
                
            };
        },
        complete: function () {
			datakaryawan();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function datakaryawan(){
    $.ajax({
        url        : url+"index.php/bsre/registrasi/datakaryawan",
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
                    
                    getvariabel =   "data-userid='"+result[i].USER_ID+"'"+
                                    "data-nik='"+result[i].NIK+"'"+
                                    "data-nama='"+result[i].NAME+"'"+
                                    "data-namaktp='"+result[i].NAME_IDENTITY+"'"+
                                    "data-noktp='"+result[i].IDENTITY_NO+"'"+
                                    "data-email='"+result[i].EMAIL+"'";

                    btncheckstatus = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='certificatestatus(this)'><i class='fa-solid fa-circle-check text-success'></i> Check Certificate</a>";
                    btnedit        = "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_edituser' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Perbaharui Data</a>";

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
                                    if(result[i].IDENTITY_NO!=""){
                                        tableresult +="<a class='text-gray-800 text-hover-primary mb-1' "+getvariabel+" onclick='certificatestatus(this)' style='cursor: pointer;' title='Click For Certificate Status'>"+result[i].NAME+"</a>";
                                    }else{
                                        tableresult +="<a class='text-gray-800 text-hover-primary mb-1' style='cursor: pointer;'>"+result[i].NAME+"</a>";
                                    }
                                    tableresult +="<span>"+(result[i].EMAIL ? result[i].EMAIL : "-")+"</span>";
                                tableresult +="</div>";
                        tableresult +="</td>";
                        tableresult +="<td><div>"+(result[i].NIK ? result[i].NIK : "")+"</div><div>" + (result[i].IDENTITY_NO ? result[i].IDENTITY_NO : "") + "</div></td>";
                        if(result[i].CERTIFICATE==="3"){
                            tableresult +="<td><div class='badge badge-light-success fw-bolder'>Certificate "+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div></td>";
                        }else{
                            tableresult +="<td><div class='badge badge-light-danger fw-bolder'>"+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div></td>";
                        }
                        
                        tableresult +="<td class='text-end'>";
                            tableresult +="<div class='btn-group' role='group'>";
                                tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult +=btncheckstatus+btnedit;                  
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
        url        : url+'index.php/bsre/registrasi/edituser',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#modal_edituser_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode==="00"){
                datakaryawan();
                $('#modal_edituser').modal('hide');
            }

            toastr[data.responHead](data.responDesc, "INFORMATION");
			
		},
        complete: function () {
            toastr.clear();
            $("#modal_edituser_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold'>I'm Sorry</h1>",
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