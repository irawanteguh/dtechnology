datakaryawan();

function registerkyc(btn){
    var userid = $(btn).attr("data-userid");
    var email  = $(btn).attr("data-email");

    $.ajax({
        url       : url+"index.php/mekari/registrasi/registerkyc",
        data      : {userid:userid,email:email},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function(){
            showLoading('Processing','Please wait while the system displays the requested data.');
        },
        success:function(data){
            Swal.close();
            var result = data.responResult;

            if(
                result?.data?.routing_error ||
                result?.data?.message ||
                result?.error_description ||
                result?.message
            ){
                const emailErrors = result?.data?.params?.email ? result.data.params.email.join("<br>") : "";
                showAlert(
                    "For Your Information",
                    (result?.data?.routing_error ?? result?.data?.message ?? result?.error_description ?? result?.message)+(emailErrors ? "<br>" + emailErrors : ""),
                    "info",
                    "Please Check Again",
                    "btn btn-info",
                    10000
                );
            }


            
        },
        complete: function(){
		},
        error: function(){
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
            showLoading('Processing','Please wait while the system displays the requested data.');
            $("#resultmasterkaryawan").html("");
        },
        success:function(data){
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];

            if(data.responCode==="00"){
                var result = data.responResult;

                for(var i in result){
                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];
                    var statususer  = "<td><div class='badge badge-light-success fw-bolder'></div></td>";
                    var btnaction   = "";

                    getvariabel =   "data-userid='"+result[i].user_id+"'"+
                                    "data-nik='"+result[i].nik+"'"+
                                    "data-email='"+result[i].email+"'";

                    btnpengajuan = "<a class='dropdown-item btn btn-sm' "+getvariabel+" onclick='registerkyc(this)'><i class='bi bi-person-add'></i> Pengajuan</a>";

                    if(result[i].idregistrasi===null && result[i].email===null){
                        statususer ="<td><div class='badge badge-light-danger fw-bolder'>Data belum lengkap</div><div class='small'>Silakan Melengkapi Alamat Email</div></td>";
                    }

                    if(result[i].idregistrasi===null && result[i].email!=null ){
                        statususer ="<td><div class='badge badge-light-primary fw-bolder'>Data lengkap</div><div class='small'>Silakan Melakukan Pengajuan Sertifikat Tanda Tangan Elektronik</div></td>";
                        btnaction += btnpengajuan;
                    }

                    if(result[i].idregistrasi!=null){
                        statususer ="<td><div class='badge badge-light-info fw-bolder'>"+result[i].status+"</div><div class='small'>Silakan Periksa Email Anda : "+result[i].emailinvitation+"</div></td>";
                    }

                    tableresult +="<tr>";
                        tableresult +="<td class='d-flex align-items-center'>";
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
                                    tableresult +="<div class='text-gray-800 mb-1'>"+result[i].name+"</div>";
                                    tableresult +="<span>"+(result[i].email ? result[i].email : "-")+"</span>";
                                tableresult +="</div>";
                        tableresult +="</td>";
                        tableresult += "<td><div>"+(result[i].nik ? result[i].nik : "")+"</div><div>" + (result[i].identity_no ? result[i].identity_no : "") + "</div></td>";
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
        },
        complete: function(){
            Swal.close();
		},
        error: function(){
            Swal.fire({
                icon : 'error',
                title: 'Error',
                text : 'Unable to retrieve visit data.'
            });
        }
    });
    return false;
};