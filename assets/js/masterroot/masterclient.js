listclient();

$('#modal_client_add').on('hidden.bs.modal', function (e) {
    $('#data_client_name_addh').val("");
    $('#data_client_website_add').val("");
});

function getdata(btn){
    var $btn = $(btn);
    var orgid          = $btn.attr("data_orgid");
    var orgname          = $btn.attr("data_orgname");
    var website          = $btn.attr("data_website");

    $(":hidden[name='data_client_orgid_edit']").val(orgid);
    $(":text[name='data_client_name_edit']").val(orgname);
    $(":text[name='data_client_website_edit']").val(website);

};

function listclient(){
    $.ajax({
        url       : url+"index.php/masterroot/Masterclient/listclient",
        method    : "GET",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterclient").html("");
        },
        success:function(data){
            toastr.clear();
            var result      = "";
            var getvariabel = "";
            var tableresult = "";
            var action      = "";
            
            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    getvariabel =   "data_orgid='"+result[i].ORG_ID+"'"+
                                    "data_orgname='"+result[i].ORG_NAME+"'"+
                                    "data_website='"+result[i].WEBSITE+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].ORG_ID+"</td>";
                    tableresult +="<td>"+result[i].CODE+"</td>";
                    tableresult +="<td>"+result[i].ORG_NAME+"</td>";
                    tableresult +="<td>"+result[i].WEBSITE+"</td>";
                    tableresult +="<td>Admin_"+result[i].CODE+"</td>";

                    // tableresult +="<td class='text-center'>";
                    // if (result[i].TRIAL === "Y") {
                    //     tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].ORG_ID + "' checked='checked' /></div>";
                    // } else {
                    //     tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].ORG_ID + "' /></div>";
                    // }
                    // tableresult +="</td>";

                    tableresult +="<td class='text-center'>";
                    if (result[i].ACTIVE === "1") {
                        tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].ORG_ID + "' checked='checked' /></div>";
                    } else {
                        tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].ORG_ID + "' /></div>";
                    }
                    tableresult +="</td>";

                    tableresult +="<td class='text-end'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1' data-bs-toggle='modal' data-bs-target='#modal_client_edit' "+getvariabel+" onclick='getdata(this)'><i class='bi bi-pencil-fill'></i></a></td>";

                    tableresult +="</tr>";
                }
            }

            $("#resultmasterclient").html(tableresult);
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

$(document).on("submit", "#formaddclient", function (e) {
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
			$("#btn_client_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                listclient();
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_client_edit").removeClass("disabled");
            $('#modal_client_add').modal('hide');
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

$(document).on("submit", "#formeditclient", function (e) {
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
			$("#btn_client_edit").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                listclient();
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_client_edit").removeClass("disabled");
            $('#modal_client_edit').modal('hide');
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