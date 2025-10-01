masterppk();

$("#modal_simulasi_idrg").on('show.bs.modal', function (event) {
    var button          = $(event.relatedTarget);
    var datatransaksiid = button ? button.attr("datatransaksiid") : null;

    $("#resultdatadetaildiagnosappk").html("");
    $("#resultgroupingidrg").html("");

    $("#btngroupingidrg").attr("datatransaksiid", datatransaksiid);
    $("#btnfinalidrg").attr("datatransaksiid", datatransaksiid);
    $("#btneditidrg").attr("datatransaksiid", datatransaksiid);

    $("#btngroupingidrg").addClass("disabled");
    $("#btnfinalidrg").addClass("d-none");
    $("#btneditidrg").addClass("d-none");
});

$("#modal_simulasi_idrg").on('shown.bs.modal', function (event) {
    var button          = $(event.relatedTarget);
    var datatransaksiid = button ? button.attr("datatransaksiid") : null;
    
    newclaim(datatransaksiid);
});

function masterppk(){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/masterppk",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamasterppk").html("");
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    getvariabel =   "datatransaksiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";
                        tableresult +="<td class='ps-4'>"+result[i].name+"</td>";
                        tableresult += "<td class='text-end'>";
                            tableresult +="<div class='btn-group' role='group'>";
                                tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult +="<a class='dropdown-item btn btn-sm' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_simulasi_idrg'><i class='bi bi-check2-circle text-success'></i> Simulasi iDRG</a>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatamasterppk").html(tableresult);
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

function newclaim(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/newclaim",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            toastr["info"]("Sending request...", "NEW CLAIM");
        },
        success:function(data){
            var result = "";
                result = data.responResult;

            if(data.responCode==="00" || data.responCode==="02"){
                newclaimdata(datatransaksiid);
            }

            toastr[data.responHead](data.responDesc, "NEW CLAIM");
        },
        complete: function(){
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

function newclaimdata(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/newclaimdata",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            toastr["info"]("Sending request...", "NEW CLAIM DATA");
        },
        success:function(data){

            if(data.responCode==="00" || data.responCode==="01"){
                detaildiagnosappk(datatransaksiid);
            }

            if(data.responCode==="01"){
                editidrg();
                groupingidrg();
                finalidrg();
            }

            toastr[data.responHead](data.responDesc, "NEW CLAIM DATA");
        },
        complete: function(){
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

function detaildiagnosappk(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/detaildiagnosappk",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#resultdatadetaildiagnosappk").html("");
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";

            if(data.responCode==="00"){
                    result  = data.responResult;
                let hasDiag = false, hasProc = false;
                for(var i in result){
                    getvariabel =   "datatransaksiid='"+result[i].transaksi_id+"'";

                    if(result[i].jenis_id==='1' && !hasDiag){
                        tableresult += "<tr><td class='fw-bold fs-7'>:: Diagnosa ICD-10 ::</td></tr>";
                        hasDiag = true;
                    }
                    if(result[i].jenis_id==='2' && !hasProc){
                        tableresult += "<tr><td class='fw-bold fs-7'>:: Procedure ICD-9-CM ::</td></tr>";
                        hasProc = true;
                    }
                    
                    tableresult +="<tr>";
                    tableresult += "<td class='ps-10'>- "+result[i].description+" <span class='ps-4 badge badge-light-info'>"+result[i].icd_code+"</span>"+"<span class='fst-italic ps-4 text-primary'>"+(result[i].primary_code==='Y'?"Primary":"Secondary")+"</span></td>";
                    tableresult +="</tr>";
                }

                setdiagnosaidrg(datatransaksiid);
            }

            $("#resultdatadetaildiagnosappk").html(tableresult);
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

function setdiagnosaidrg(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/setdiagnosaidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            toastr["info"]("Sending request...", "SET DIAGNOSA iDRG");
        },
        success:function(data){

            if(data.responCode==="00"){
                setprocedureidrg(datatransaksiid);
            }

            toastr[data.responHead](data.responDesc, "SET DIAGNOSA iDRG");
        },
        complete: function(){
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

function setprocedureidrg(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/setprocedureidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){
            toastr["info"]("Sending request...", "SET PROCEDURE iDRG");
        },
        success:function(data){

            if(data.responCode==="00"){
                $("#btngroupingidrg").removeClass("disabled");
            }

            toastr[data.responHead](data.responDesc, "SET PROCEDURE iDRG");
        },
        complete: function(){
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

function groupingidrg(){
    var datatransaksiid = $("#btngroupingidrg").attr("datatransaksiid");
    $.ajax({
        url        : url+"index.php/casemix/masterppk/groupingidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr["info"]("Sending request...", "GROUPING iDRG");
            $("#resultgroupingidrg").html("");
            $("#btnfinalidrg").addClass("d-none");
        },
        success:function(data){
            var result         = "";
            var resultgrouping = "";

           if(data.responCode==="00"){
                result        = data.responResult;

                resultgrouping +="<table class='table align-middle table-row-dashed fs-8 gy-2'>";
                    resultgrouping +="<thead>";
                        resultgrouping +="<tr class='fw-bolder text-muted align-middle'><th class='text-center rounded-start rounded-end'colspan='3'>:: Hasil Grouping iDRG ::</th></tr>";
                    resultgrouping +="</thead>";
                    resultgrouping +="<tbody class='text-gray-600 fw-bold'>";
                        resultgrouping +="<tr><td class='ps-4'>Info</td><td></td><td></td></tr>";
                        resultgrouping +="<tr><td class='ps-4'>Jenis Rawat</td><td></td><td></td></tr>";
                        resultgrouping +="<tr><td class='ps-4'>MDC</td><td>"+result.response_idrg.mdc_description+"</td><td>"+result.response_idrg.mdc_number+"</td></tr>";
                        resultgrouping +="<tr><td class='ps-4'>DRG</td><td>"+result.response_idrg.drg_description+"</td><td>"+result.response_idrg.drg_code+"</td></tr>";
                        resultgrouping +="<tr><td class='ps-4'>Status</td><td></td><td></td></tr>";
                    resultgrouping +="</tbody>";
                resultgrouping +="</table>";

                $("#btnfinalidrg").removeClass("d-none");
           }

           $("#resultgroupingidrg").html(resultgrouping);
        },
        complete: function () {
            Swal.close();
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

function finalidrg(){
    var datatransaksiid = $("#btnfinalidrg").attr("datatransaksiid");
    $.ajax({
        url        : url+"index.php/casemix/masterppk/finalidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr["info"]("Sending request...", "FINAL GROUPING iDRG");
        },
        success:function(data){
            var result         = "";
            var resultgrouping = "";

            result        = data.responResult;

            if((result.metadata.code===200) || (result.metadata.code===400 && result.metadata.error_no==="E2102")){
                // $("#resultgroupingidrg").html(resultgrouping);
                $("#resultgroupingidrg table").addClass("table-success");
                $("#btngroupingidrg").addClass("d-none");
                $("#btnfinalidrg").addClass("d-none");
                $("#btneditidrg").removeClass("d-none");
            }
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

function editidrg(){
    var datatransaksiid = $("#btnfinalidrg").attr("datatransaksiid");
    $.ajax({
        url        : url+"index.php/casemix/masterppk/editidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr["info"]("Sending request...", "EDIT GROUPING iDRG");
            $("#resultgroupingidrg table").removeClass("table-success");
        },
        success:function(data){
            var result         = "";
            var resultgrouping = "";

           if(data.responCode==="00"){
                result        = data.responResult;

                if(result.metadata.code===200){
                    $("#btngroupingidrg").removeClass("d-none");
                    $("#btnfinalidrg").removeClass("d-none");
                    $("#btneditidrg").addClass("d-none");
                }
           }
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