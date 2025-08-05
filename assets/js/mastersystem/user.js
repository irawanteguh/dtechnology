masteruser();

const filterusername = new Tagify(document.querySelector("#filterusername"), { enforceWhitelist: true });
const filtername     = new Tagify(document.querySelector("#filtername"), { enforceWhitelist: true });

filterusername.on('change', filterTable);
filtername.on('change', filterTable);

function getdata(btn) {
    var data_userid        = btn.attr("data_userid");
    $(":hidden[name='userid']").val(data_userid);
    masteruserassistant();
};

function filterTable() {
    const usernamefilter = filterusername.value.map(tag => tag.value);
    const namefilter     = filtername.value.map(tag => tag.value);

    const table = document.getElementById("tablemasteruserassistant");
    const rows  = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (const row of rows) {
        const itemusername = row.getElementsByTagName("td")[0].textContent;
        const itemname     = row.getElementsByTagName("td")[1].textContent;

        const showRow = 
            (usernamefilter.length === 0 || usernamefilter.includes(itemusername)) &&
            (namefilter.length === 0 || namefilter.includes(itemname));

        row.style.display = showRow ? "" : "none";
    }
};

function masteruser(){
    $.ajax({
        url       : url+"index.php/mastersystem/user/masteruser",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteruser").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){

                    getvariabel =   "data_userid='" + result[i].user_id + "'";

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].username + "</td>";
                    tableresult += "<td>" + result[i].name + "</td>";
                    var userIdassisstant = result[i].asstantname ? result[i].asstantname.split(';') : [];

                    tableresult += "<td>";
                    for (var j = 0; j < userIdassisstant.length; j++) {
                        var assistantprofile = userIdassisstant[j].trim().split(':');
                        var userid = assistantprofile[0];
                        var name   = assistantprofile[1];

                        tableresult +="<div><a href='#'>"+name+"</a></div>";
                    }
                    tableresult += "</td>";

                    tableresult +="<td></td>";
                    tableresult +="<td></td>";
                    tableresult += "<td class='text-end pe-4'>";
                        tableresult += "<div class='fw-bold d-flex justify-content-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                        tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                        tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary'  data-bs-toggle='modal' data-bs-target='#modal_user_add_assistant' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-primary'></i> Add Assistant</a>";
                        tableresult +="</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";
                }
            }


            $("#resultmasteruser").html(tableresult);
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

function masteruserassistant(){
    $.ajax({
        url       : url+"index.php/mastersystem/user/masteruser",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasteruserassistant").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result   = data.responResult;
                var username = new Set();
                var name     = new Set();

                for(var i in result){
                    username.add(result[i].username);
                    name.add(result[i].name);

                    tableresult += "<tr>";
                    tableresult += "<td class='text-start ps-4'>" + result[i].username + "</td>";
                    tableresult += "<td>" + result[i].name + "</td>";
                    tableresult += "<td class='text-end pe-4'><a class='btn btn-sm btn-light-primary' data-useridassistant='"+result[i].user_id+"' onclick='adduser($(this));'>Pilih</a></td>";
                    tableresult += "</tr>";
                }
            }


            $("#resultmasteruserassistant").html(tableresult);

            filterusername.settings.whitelist = Array.from(username);
            filtername.settings.whitelist = Array.from(name);

            toastr.clear();
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

function adduser(btn){
    var useridassistant = btn.attr("data-useridassistant");
    var userid          = $("[name='userid']").val();
	$.ajax({
        url        : url+"index.php/mastersystem/user/adduserassistant",
        data       : {useridassistant:useridassistant,userid:userid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				masteruser();
                $('#modal_user_add_assistant').modal('hide');
			};

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
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

$(document).on("submit", "#formadduser", function (e) {
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
			$("#btn_user_add").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                masteruser();
                $('#modal_user_add').modal('hide');
			}else{

            }
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_user_add").removeClass("disabled");
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