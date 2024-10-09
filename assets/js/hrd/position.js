daftarjabatan();

function getdata(btn){
    var $btn = $(btn);

    var data_positionid = $btn.attr("data_positionid");
    var data_position   = $btn.attr("data_position");


    $(":hidden[name='data_positiion_id_edit']").val(data_positionid);
    $(":text[name='data_position_name_edit']").val(data_position);

};

function daftarjabatan(){
    $.ajax({
        url       : url+"index.php/hrd/position/daftarjabatan",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#listposition").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];
            var maxuser     = 5;
            var jml         = 0;

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    

                    getvariabel =   "data_positionid='"+result[i].POSITION_ID+"'"+
                                    "data_position='"+result[i].POSITION+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].POSITION+" "+(result[i].FUNCTIONAL ? result[i].FUNCTIONAL : "")+"</td>";
                    tableresult +="<td>";
                    tableresult +="<div class='symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2'>";
                    
                    var userIdsprimary = result[i].memberprimary ? result[i].memberprimary.split(';') : [];
                    var displayedUsersprimary = 0;

                    for (var j = 0; j < userIdsprimary.length; j++) {
                        var randomIndex = Math.floor(Math.random() * color.length);
                        var randomColor = color[randomIndex];

                        if (displayedUsersprimary >= maxuser) {
                            break;
                        }

                        var userProfile = userIdsprimary[j].trim().split(':');
                        var userId      = userProfile[0];
                        var statusimg   = userProfile[1];
                        var nameprofile = userProfile[2];
                        var intial      = userProfile[3];

                        if (statusimg === "N") {
                            tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='" + nameprofile + "'>";
                            tableresult += "<div class='symbol-label fs-8 fw-bold bg-"+randomColor+" text-inverse-primary'>" + intial + "</div>";
                            tableresult += "</div>";
                        } else {
                            tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='" + nameprofile + "'>";
                            tableresult += "<img src='" + url + "assets/images/avatars/" + userId + ".jpeg' alt='" + nameprofile + "'>";
                            tableresult += "</div>";
                        }
                        
                        displayedUsersprimary++;
                    }

                    if (userIdsprimary.length > maxuser) {
                        var remainingCount = userIdsprimary.length - maxuser;
                        tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='+" + remainingCount + " more'>";
                        tableresult += "<div class='symbol-label fs-8 fw-bold bg-dark text-inverse-primary'>" + remainingCount + "+</div>";
                        tableresult += "</div>";
                    }

                    tableresult += "</div>";
                    tableresult += "</td>";

                    tableresult +="<td>";
                    tableresult +="<div class='symbol-group symbol-hover flex-nowrap flex-grow-1 min-w-100px pe-2'>";
                    
                    var userIdssecondary = result[i].membersecondry ? result[i].membersecondry.split(';') : [];
                    var displayedUserssecondary = 0;

                    for (var j = 0; j < userIdssecondary.length; j++) {
                        var randomIndex = Math.floor(Math.random() * color.length);
                        var randomColor = color[randomIndex];

                        if (displayedUserssecondary >= maxuser) {
                            break;
                        }

                        var userProfile = userIdssecondary[j].trim().split(':');
                        var userId      = userProfile[0];
                        var statusimg   = userProfile[1];
                        var nameprofile = userProfile[2];
                        var intial      = userProfile[3];

                        if (statusimg === "N") {
                            tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='" + nameprofile + "'>";
                            tableresult += "<div class='symbol-label fs-8 fw-bold bg-"+randomColor+" text-inverse-primary'>" + intial + "</div>";
                            tableresult += "</div>";
                        } else {
                            tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='" + nameprofile + "'>";
                            tableresult += "<img src='" + url + "assets/images/avatars/" + userId + ".jpeg' alt='" + nameprofile + "'>";
                            tableresult += "</div>";
                        }
                        
                        displayedUserssecondary++;
                    }

                    if (userIdssecondary.length > maxuser) {
                        var remainingCount = userIdssecondary.length - maxuser;
                        tableresult += "<div class='symbol symbol-circle symbol-25px' data-bs-toggle='tooltip' title='+" + remainingCount + " more'>";
                        tableresult += "<div class='symbol-label fs-8 fw-bold bg-dark text-inverse-primary'>" + remainingCount + "+</div>";
                        tableresult += "</div>";
                    }

                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult +="<td><span class='fw-bold d-block fs-7'>"+result[i].dibuatoleh+"</span><span class='fw-bold text-muted d-block fs-7'>"+result[i].last_update_date+"</span></td>";
                    tableresult += "<td class='text-end'>";
                    tableresult += "<div class='btn-group' role='group'>";
                    tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                    tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                        tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_position_edit' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Perbaharui Data</a>";
                        // tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_position_registration' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Positioning</a>"; 
                    tableresult +="</div>";
                    tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultmasterposition").html(tableresult);
            $("#info_list_position").html(todesimal(jml)+" Position");
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
		},
    });
    return false;
};

$(document).on("submit", "#formaddposition", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#btn_position_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if (data.responCode == "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_position_add").modal("hide");
                daftarjabatan();
			}else{
                $("#btn_position_add").removeClass("disabled");
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
            };
			
		},
        complete: function () {
            toastr.clear();
            $("#btn_position_add").removeClass("disabled");
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

$(document).on("submit", "#formeditposition", function (e) {
	e.preventDefault();
    e.stopPropagation();
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
			$("#btn_position_edit").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if (data.responCode == "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_position_edit").modal("hide");
                daftarjabatan();
			}else{
                $("#btn_position_edit").removeClass("disabled");
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
            };
			
		},
        complete: function () {
            toastr.clear();
            $("#btn_position_edit").removeClass("disabled");
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