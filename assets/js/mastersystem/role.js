masterrole();

// function masterrole(){
//     $.ajax({
//         url       : url+"index.php/mastersystem/role/masterrole",
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultmasterrole").html("");
//         },
//         success:function(data){
//             let tableresult;

//             if(data.responCode==="00"){
//                 let result        = data.responResult;
//                 for(var i in result){

//                     tableresult += "<tr>";
//                     tableresult += "<td class='text-start ps-4'>" + result[i].role_id + "</td>";
//                     tableresult += "<td>" + result[i].role + "</td>";
//                     tableresult += "<td>" + result[i].createdby + "</td>";
//                     tableresult += "<td class='text-end pe-4'>" + result[i].createddate + "</td>";
//                     tableresult += "</tr>";
//                 }
//             }


//             $("#resultmasterrole").html(tableresult);
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
// 			//
// 		},
//         error: function(xhr, status, error) {
//             Swal.fire({
//                 title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html             : "<b>"+error+"</b>",
//                 icon             : "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling   : false,
//                 timerProgressBar : true,
//                 timer            : 5000,
//                 customClass      : {confirmButton: "btn btn-danger"},
//                 showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
//                 hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
//             });
// 		}		
//     });
//     return false;
// };

function masterrole(){
    $.ajax({
        url       : url+"index.php/mastersystem/role/masterrole",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterrole").html("");
        },
        success:function(data){
            let tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;

                tableresult +="<div class='col-md-4'>";
                    tableresult +="<div class='card h-md-100'>";
                        tableresult +="<div class='card-body d-flex flex-center'>";
                            tableresult +="<button type='button' class='btn btn-clear d-flex flex-column flex-center' data-bs-toggle='modal' data-bs-target='#modal_role_add'>";
                                tableresult +="<img src='"+url+"assets/images/illustrations/unitedpalms-1/4.png' alt='' class='mw-100 mh-150px mb-7'>";
                                tableresult +="<div class='fw-bolder fs-3 text-gray-600 text-hover-primary'>Add New Role</div>";
                            tableresult +="</button>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                tableresult +="</div>";

                for(var i in result){
                    tableresult +="<div class='col-md-4'>";
                        tableresult +="<div class='card card-flush h-md-100'>";
                            tableresult +="<div class='card-header'>";
                                tableresult +="<div class='card-title'>";
                                    tableresult +="<h2>"+result[i].role+"</h2>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='card-body pt-1'>";
                                tableresult +="<div class='fw-bolder text-gray-600 mb-5'>Total users with this role: "+result[i].jmluser+"</div>";
                                tableresult +="<div class='d-flex flex-column text-gray-600'>";
                                var modules = result[i].modules ? result[i].modules.split(';') : [];
                                var maxModulesToShow = 5;

                                for (var j = 0; j < Math.min(modules.length, maxModulesToShow); j++) {
                                    tableresult += "<div class='d-flex align-items-center py-2'>";
                                    tableresult += "<span class='bullet bg-primary me-3'></span>" + modules[j] + "</div>";
                                }

                                if (modules.length > maxModulesToShow) {
                                    tableresult += "<div class='d-flex align-items-center py-2'>";
                                    tableresult += "<span class='bullet bg-primary me-3'></span>and " + (modules.length - maxModulesToShow) + " more...</div>";
                                }
                                tableresult +="</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='card-footer flex-wrap pt-0'>";
                            tableresult +="<a href='../../demo1/dist/apps/user-management/roles/view.html' class='btn btn-light btn-active-primary my-1 me-2'>View Role</a>";
                            tableresult +="<button type='button' class='btn btn-light btn-active-light-primary my-1' data-bs-toggle='modal' data-bs-target='#kt_modal_update_role'>Edit Role</button>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                }
            }


            $("#resultmasterrole").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			//
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

$(document).on("submit", "#formaddrole", function (e) {
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
			$("#btn_role_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                masterrole();
                $('#modal_role_add').modal('hide');
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_role_add").removeClass("disabled");
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