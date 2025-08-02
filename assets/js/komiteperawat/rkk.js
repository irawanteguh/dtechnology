masteremployee();

function getdata(btn){
    toastr.clear();

    var userid            = btn.attr("data-userid");
    var transid           = btn.attr("data-transid");
    var name              = btn.attr("data-name");
    var positionprimary   = btn.attr("data-positionprimary");
    var funsgionalprimary = btn.attr("data-funsgionalprimary");
    var atasanprimary     = btn.attr("data-atasanprimary");
    var kategori          = btn.attr("data-kategori");
    var klinisid          = btn.attr("data-klinisid");
    var klinis            = btn.attr("data-klinis");
    var nik               = btn.attr("data-nik");

    //Drawer
	$(":hidden[name='drawer_data_rkk_userid_add']").val(userid);
	$("input[name='drawer_data_rkk_name_add']").val(name);

    var $rkk = $('#drawer_data_rkk_rkkid_add').select2();
        $rkk.val(klinisid).trigger('change');
};

function masteremployee(){
    $.ajax({
        url        : url+"index.php/komiteperawat/rkk/masteremployee",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteremployee").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";
            var getvariabelsecodary = "";
            var color               = ['danger','warning','success','primary'];
            var jml                 = 0;

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    getvariabel =   "data-userid='"+result[i].user_id+"'"+
                                    "data-transid='"+result[i].transidprimary+"'"+
                                    "data-name='"+result[i].name+"'"+
                                    "data-positionprimary='"+result[i].positionprimary+"'"+
                                    "data-funsgionalprimary='"+result[i].funsgionalprimary+"'"+
                                    "data-atasanprimary='"+result[i].atasanprimary+"'"+
                                    "data-kategori='"+result[i].kategori+"'"+
                                    "data-klinisid='"+result[i].klinis_id+"'"+
                                    "data-klinis='"+result[i].klinis+"'"+
                                    "data-nik='"+result[i].nik+"'";

                    tableresult +="<tr>";
                    tableresult +="<td>";
                        tableresult +="<div class=' align-middle d-flex align-items-center ps-4'>";
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
                                tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].name+"</a>";
                                tableresult +="<span>"+(result[i].email ? result[i].email : "-")+"</span>";
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";
                    

                    tableresult +="<td><div>"+(result[i].nik ? result[i].nik : "")+"</div><div>" + (result[i].identity_no ? result[i].identity_no : "") + "</div></td>";
                    tableresult +="<td><div>"+(result[i].kategori ? result[i].kategori : "")+"</div><div>" + (result[i].klinis ? result[i].klinis : "") + "</div></td>";
                    tableresult +="<td><div>"+(result[i].positionprimary ? result[i].positionprimary : "")+" "+(result[i].funsgionalprimary ? result[i].funsgionalprimary : "")+"</div><div>"+(result[i].atasanprimary ? result[i].atasanprimary : "")+"</div></td>"

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_employee_rkk_add' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Clinical Authority</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultmasteremployee").html(tableresult);
            $("#info_list_employee").html(todesimal(jml)+" Staff");
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

$(document).on("submit", "#formupdaterkk", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/komiteperawat/rkk/updaterkk',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_rkk_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $('#drawer_employee_rkk_add_add_close').trigger('click');
				masteremployee();
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
                $("#btn_rkk_add").removeClass("disabled");
            }
		},
        complete: function () {
            toastr.clear();
            $("#btn_rkk_add").removeClass("disabled");
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