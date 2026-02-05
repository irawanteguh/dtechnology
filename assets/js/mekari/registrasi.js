datakaryawan();

function pengajuantte(btn){
    var userid = $(btn).attr("data-userid");
    var email  = $(btn).attr("data-email");

    $.ajax({
        url       : url+"index.php/mekari/registrasi/pengajuantte",
        data      : {userid:userid,email:email},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            Swal.fire({
                title            : 'Processing',
                html             : 'Please wait while the system displays the requested data.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                showConfirmButton: false,
                didOpen          : () => Swal.showLoading()
            });
        },
        success:function(data){
            var result = data.responResult;

        },
        complete: function () {
            Swal.close();
			datakaryawan();
		},
        error: function () {
            Swal.fire({
                icon : 'error',
                title: 'Error',
                text : 'Unable to retrieve visit data.'
            });
        }
    });
    return false;
};

function datakaryawan(){
    $.ajax({
        url        : url+"index.php/mekari/registrasi/datakaryawan",
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
                                    "data-email='"+result[i].EMAIL+"'";

                    btnpengajuan = "<a class='dropdown-item btn btn-sm' onclick='pengajuantte(this)'>><i class='bi bi-person-add'></i> Pengajuan</a>";

                    if(result[i].EMAIL===null){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Data belum lengkap</div><div class='small'>Silakan Melengkapi Alamat Email</div></td>";
                    }

                    if(result[i].REGISTER_ID===null && result[i].EMAIL!=null){
                        statususer ="<td><div class='badge badge-light-primary fw-bolder'>Data lengkap</div><div class='small'>Silakan Melakukan Pengajuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction += btnpengajuan;
                    }

                    if(result[i].CERTIFICATE==="0" && result[i].REVOKE_ID!=null && result[i].CERTIFICATE_INFO==="Revoke"){
                        statususer = "<td><div class='badge badge-light-danger fw-bolder'>Account Sudah Di "+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Silakan Melakukan Pengajuan Re Enroll</div></td>";
                    }

                    if(result[i].CERTIFICATE==="3"){
                        statususer = "<td><div class='badge badge-light-success fw-bolder'>Sertifikat "+(result[i].CERTIFICATE_INFO ? result[i].CERTIFICATE_INFO : "")+"</div><div class='small'>Active : "+(result[i].startactive ? result[i].startactive : "")+" Expired :"+(result[i].expireddate ? result[i].expireddate : "")+"</div></td>";
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
                                    tableresult +="<div class='text-gray-800 mb-1'>"+result[i].NAME+"</div>";
                                    tableresult +="<span>"+(result[i].EMAIL ? result[i].EMAIL : "-")+"</span>";
                                tableresult +="</div>";
                        tableresult +="</td>";
                        tableresult += "<td><div>"+(result[i].NIK ? result[i].NIK : "")+"</div><div>" + (result[i].IDENTITY_NO ? result[i].IDENTITY_NO : "") + "</div></td>";
                        tableresult += "<td>"+(result[i].USER_IDENTIFIER ? "<a class='text-hover-primary mb-1' "+getvariabel+" onclick='certificatestatus(this)' style='cursor: pointer;' title='Click For Cretificate Status'>"+result[i].USER_IDENTIFIER+"</a>" : "")+"</td>";
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