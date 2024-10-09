masteruser();

function getdata(btn) {
    var $btn       = $(btn);
    var userid = $btn.attr("data_userid");
    var name   = $btn.attr("data_name");

    $(":hidden[name='userid_mapping']").val(userid);
    $("#headerlistrole").html("List Detail User : " + name);
    masterrole();
};

function masteruser(){
    $.ajax({
        url       : url+"index.php/operation/useraccess/masteruser",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#listmasterrole").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel = "";
                    getvariabel =   "data_userid='" + result[i].user_id + "'" +
                                    "data_name='" + result[i].name + "'";

                    tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-hover border border-dashed border-gray-300 cursor-pointer mb-1' data-kt-search-element='customer' title='Klik Untuk Memilih' " + getvariabel + ">";
                    tableresult += "<div class='fw-bold'><span class='fs-6 text-gray-800 me-2'>"+result[i].name+"</span></div>";
                    tableresult += "</div>";
                }
            }


            $("#listuser").html(tableresult);

            $("#listuser div").on('click', function () {
                getdata(this);
            });

            // toastr[data.responHead](data.responDesc, "INFORMATION");
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

function masterrole() {
    var userid = $("input[name='userid_mapping']").val();
    $.ajax({
        url       : url + "index.php/operation/useraccess/masterrole",
        data      : { userid: userid },
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#listrole").html("");
        },
        success: function (data) {
            var result = "";
            var tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {

                    tableresult += "<div class='d-flex align-items-center p-3 rounded-3 border-2 border-dashed border-gray-300 mb-1 d-flex justify-content-between' data-kt-search-element='customer'>";
                    tableresult += "<div class='fw-bold'>";
                    tableresult += "<span class='fs-6 text-gray-800 me-2'>" + result[i].role + "</span>";
                    tableresult += "</div>";
                    tableresult += "<div class='fw-bold d-flex justify-content-end'>";

                    if (result[i].transidmapping != null) {
                        tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].role_id + "' checked='checked' /></div>";
                    } else {
                        tableresult += "<div class='form-check form-switch form-check-custom form-check-solid'><input class='form-check-input h-20px w-30px' type='checkbox' id='" + result[i].role_id + "' /></div>";
                    }
                    
                    tableresult += "</div>";
                    tableresult += "</div>";
                }
            }

            $("#listrole").html(tableresult);
        },
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
};

$(document).on("change", ".form-check-input", function (e) {
    e.preventDefault();
    var switchId = $(this).attr('id');
    var switchValue = $(this).prop('checked');
    var userid = $("input[name='userid_mapping']").val()
    $.ajax({
        url       : url + "index.php/operation/useraccess/mappingrole",
        data      : { switchId: switchId, switchValue: switchValue, userid: userid },
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            //
        },
        success: function (data) {
            if (data.responCode === "00") {
                masterrole();
            } else {
                Swal.fire({
                    title: "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                    html: "<b>" + data.responDesc + "</b>",
                    icon: data.responHead,
                    confirmButtonText: "Please Try Again",
                    buttonsStyling: false,
                    timerProgressBar: true,
                    timer: 5000,
                    customClass: { confirmButton: "btn btn-danger" },
                    showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                    hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                });
            }
        },
        complete: function () {
            //
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
});