datahandling();

$("#modal_handling_update_department").on('show.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    var datatransid      = button.attr("datatransid");
    var datadepartmentid = button.attr("datadepartmentid");

    $("#modal_handling_update_department_transid").val(datatransid);

    var $datadepartmentid = $('#modal_handling_update_department_departmentid').select2();
        $datadepartmentid.val(datadepartmentid).trigger('change');
});

function datahandling(){
    $.ajax({
        url       : url+"index.php/crm/handling/datahandling",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatahandling").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel =   " datatransid='" + result[i].trans_id + "'"+
                                        " datadepartmentid='" + result[i].department_id + "'"+
                                        " datanamapic='" + (result[i].namapic ? result[i].namapic : "")+ "'"+
                                        " datanohppic='" + result[i].nohppic + "'"+
                                        " datanamapasien='" + result[i].nama + "'"+
                                        " datacodelaporan='" + result[i].code + "'"+
                                        " datasaran='" + result[i].saran + "'"+
                                        " dataorgname='" + result[i].nameorg + "'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].code+"</td>";
                    tableresult +="<td>"+result[i].nama+"</td>";
                    tableresult +="<td>"+result[i].no_identitas+"</td>";
                    tableresult +="<td>"+result[i].no_hp+"</td>";
                    tableresult +="<td><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_handling_update_department' "+getvariabel+">"+result[i].department+"</a></div><div>"+(result[i].namapic ? result[i].namapic : "")+"</div></td>";
                    tableresult +="<td>"+result[i].lantai+"</td>";
                    tableresult +="<td>"+result[i].nama_petugas+"</td>";
                    tableresult +="<td>"+result[i].saran+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+(result[i].statuscolor ? result[i].statuscolor : "")+"'>"+(result[i].statusname ? result[i].statusname : "")+"</div></td>";
                    tableresult +="<td>"+result[i].tgldibuat+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="0"){
                                tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='1' onclick='updatestatus($(this));'><i class='bi bi-check2-circle text-success'></i> Forward Department</a>";
                            }
                            
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }


            $("#resultdatahandling").html(tableresult);
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

$(document).on("submit", "#formupdatedepartment", function (e) {
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
			$("#modal_handling_update_department_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_handling_update_department").modal("hide");
                datahandling();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_handling_update_department_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
    return false;
});

function updatestatus(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var datatransid     = btn.attr("datatransid");
            var datanamapic     = btn.attr("datanamapic");
            var datanohppic     = btn.attr("datanohppic");
            var datanamapasien  = btn.attr("datanamapasien");
            var datacodelaporan = btn.attr("datacodelaporan");
            var datasaran       = btn.attr("datasaran");
            var datastatus      = btn.attr("datastatus");
            var dataorgname     = btn.attr("dataorgname");

            $.ajax({
                url       : url+"index.php/crm/handling/updatesaran",
                data      : {
                                datatransid    : datatransid,
                                datastatus     : datastatus,
                                datanamapic    : datanamapic,
                                datanohppic    : datanohppic,
                                datanamapasien : datanamapasien,
                                datacodelaporan: datacodelaporan,
                                datasaran      : datasaran,
                                dataorgname    : dataorgname
                            },
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    toastr.clear();
                    toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    toastr.clear();
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    datahandling();
                },
                error: function (xhr, status, error) {
                    showAlert(
                        "I'm Sorry",
                        error,
                        "error",
                        "Please Try Again",
                        "btn btn-danger"
                    );
                }
            });
        }
    });
    return false;
};