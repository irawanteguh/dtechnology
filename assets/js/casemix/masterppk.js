masterdatappk();

$("#modal_simulasi_idrg").on('show.bs.modal', function (event) {
    var button          = $(event.relatedTarget);
    var datatransaksiid = button ? button.attr("datatransaksiid") : null;
    var datastatus      = button ? button.attr("datastatus") : null;


    $("#resultdatadetaildiagnosappk").html("");
    $("#resultdatadetaildiagnosappkinacbg").html("");
    $("#resultgroupingidrg").html("");

    $("#btngroupingidrg").attr("datatransaksiid", datatransaksiid);
    $("#btnfinalidrg").attr("datatransaksiid", datatransaksiid);
    $("#btneditidrg").attr("datatransaksiid", datatransaksiid);
    $("#btnimportidrg").attr("datatransaksiid", datatransaksiid);    

    if(datastatus==="2"){
        setdiagnosaidrg(datatransaksiid);
        setprocedureidrg(datatransaksiid);
    }

    if(datastatus==="3"){
        setprocedureidrg(datatransaksiid);
    }

    if(datastatus==="4"){
        $("#btnfinalidrg").addClass("d-none");
        $("#btneditidrg").addClass("d-none");
        $("#btnimportidrg").addClass("d-none");
        detaildiagnosappk(datatransaksiid);
    }

    if(datastatus==="5"){
        $("#btneditidrg").addClass("d-none");
        $("#btnimportidrg").addClass("d-none");
        $("#btnfinalidrg").removeClass("d-none");
        detaildiagnosappk(datatransaksiid);
        groupingidrg();
    }

    if(datastatus==="6"){
        $("#btngroupingidrg").addClass("d-none");
        $("#btnfinalidrg").addClass("d-none");
        detaildiagnosappk(datatransaksiid);
        getgroupingidrg(datatransaksiid);
    }

    if(datastatus==="7"){
        $("#btngroupingidrg").addClass("d-none");
        $("#btnfinalidrg").addClass("d-none");
        detaildiagnosappk(datatransaksiid);
        getgroupingidrg(datatransaksiid);
        detaildiagnosappkinacbg(datatransaksiid);
    }
   
});

$('#modal_simulasi_idrg').on('hidden.bs.modal', function (e) {
    masterdatappk();
});

function masterdatappk(){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/masterdatappk",
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
                    getvariabel =   "datatransaksiid='"+result[i].transaksi_id+"'"+
                                    "datastatus='"+result[i].status+"'";

                    tableresult +="<tr>";
                        tableresult +="<td class='ps-4'>"+result[i].name+"</td>";
                        tableresult +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
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
                        tableresult += "<tr><td class='fw-bold fs-7'>:: Procedure ICD-9 CM ::</td></tr>";
                        hasProc = true;
                    }
                    
                    tableresult +="<tr>";
                    tableresult += "<td class='ps-10'>"+(result[i].status==="1"?"<i class='bi bi-check-circle-fill text-success me-2'></i>":"<i class='bi-exclamation-circle-fill text-warning me-2'></i>")+result[i].description+" <span class='ps-4 badge badge-light-info'>"+result[i].icd_code+"</span><span class='fst-italic ps-4 text-primary'>"+(result[i].primary_code==='Y'?"Primary":"Secondary")+"</span></td>";
                    tableresult +="</tr>";
                }
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
            // toastr["info"]("Sending request...", "SET DIAGNOSA iDRG");
        },
        success:function(data){
            detaildiagnosappk(datatransaksiid);
            // if(data.responCode==="00"){
            //     setprocedureidrg(datatransaksiid);
            // }

            // toastr[data.responHead](data.responDesc, "SET DIAGNOSA iDRG");
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
            // toastr["info"]("Sending request...", "SET PROCEDURE iDRG");
        },
        success:function(data){
            detaildiagnosappk(datatransaksiid);
            // if(data.responCode==="00"){
            //     $("#btngroupingidrg").removeClass("disabled");
            // }

            // toastr[data.responHead](data.responDesc, "SET PROCEDURE iDRG");
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

function getgroupingidrg(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/getgroupingidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr["info"]("Sending request...", "GROUPING iDRG");
            $("#resultgroupingidrg").html("");
        },
        success:function(data){
            var result         = "";
            var resultgrouping = "";

            if(data.responCode==="00"){
                    result        = data.responResult;

                    resultgrouping +="<table class='table align-middle table-row-dashed fs-8 gy-2 table-success'>";
                        resultgrouping +="<thead>";
                            resultgrouping +="<tr class='fw-bolder text-muted align-middle'><th class='text-center rounded-start rounded-end'colspan='3'>:: Hasil Grouping iDRG ::</th></tr>";
                        resultgrouping +="</thead>";
                        resultgrouping +="<tbody class='text-gray-600 fw-bold'>";
                            resultgrouping +="<tr><td class='ps-4'>Info</td><td></td><td></td></tr>";
                            resultgrouping +="<tr><td class='ps-4'>Jenis Rawat</td><td></td><td></td></tr>";
                            resultgrouping +="<tr><td class='ps-4'>MDC</td><td>"+result[0].mdc_description+"</td><td>"+result[0].mdc_number+"</td></tr>";
                            resultgrouping +="<tr><td class='ps-4'>DRG</td><td>"+result[0].drg_description+"</td><td>"+result[0].drg_code+"</td></tr>";
                            resultgrouping +="<tr><td class='ps-4'>Status</td><td></td><td></td></tr>";
                        resultgrouping +="</tbody>";
                    resultgrouping +="</table>";
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

function detaildiagnosappkinacbg(datatransaksiid){
    $.ajax({
        url        : url+"index.php/casemix/masterppk/detaildiagnosappkinacbg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#resultdatadetaildiagnosappkinacbg").html("");
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
                        tableresult += "<tr><td class='fw-bold fs-7'>:: Procedure ICD-9 CM ::</td></tr>";
                        hasProc = true;
                    }
                    
                    tableresult +="<tr>";
                    tableresult += "<td class='ps-10'>"+(result[i].status==="1"?"<i class='bi bi-check-circle-fill text-success me-2'></i>":"<i class='bi-exclamation-circle-fill text-warning me-2'></i>")+result[i].description+" <span class='ps-4 badge badge-light-info'>"+result[i].icd_code+"</span><span class='fst-italic ps-4 text-primary'>"+(result[i].primary_code==='Y'?"Primary":"Secondary")+"</span></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatadetaildiagnosappkinacbg").html(tableresult);
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
            //
        },
        success:function(data){
            var result = "";
                result = data.responResult;


            if((result.metadata.code===200)){
                $("#resultgroupingidrg table").addClass("table-success");
                $("#btngroupingidrg").addClass("d-none");
                $("#btnfinalidrg").addClass("d-none");
                $("#btneditidrg").removeClass("d-none");
                $("#btnimportidrg").removeClass("d-none");
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
        beforeSend : function(){
            $("#resultgroupingidrg table").removeClass("table-success");
        },
        success:function(data){
            var result         = "";
           if(data.responCode==="00"){
                result        = data.responResult;
                if(result.metadata.code===200){
                    $("#btngroupingidrg").removeClass("d-none");
                    $("#btnfinalidrg").removeClass("d-none");
                    $("#btneditidrg").addClass("d-none");
                    $("#btnimportidrg").addClass("d-none");
                    detaildiagnosappkinacbg(datatransaksiid);
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

function importidrg(){
    var datatransaksiid = $("#btnimportidrg").attr("datatransaksiid");
    $.ajax({
        url        : url+"index.php/casemix/masterppk/importidrg",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function(){

        },
        success:function(data){
            var result         = "";
           if(data.responCode==="00"){
                result        = data.responResult;
                if(result.metadata.code===200){
                    $("#btngroupingidrg").addClass("d-none");
                    $("#btnfinalidrg").addClass("d-none");
                    $("#btneditidrg").removeClass("d-none");
                    $("#btnimportidrg").removeClass("d-none");

                    detaildiagnosappkinacbg(datatransaksiid);
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

$(document).on("submit", "#formaddppk", function (e) {
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
			$("#modal_add_ppk_btn").addClass("disabled");
        },
		success: function (data) {
            
            if (data.responCode == "00") {
                $("#modal_add_ppk").modal("hide");
                masterdatappk();
			};

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#modal_add_ppk_btn").removeClass("disabled");
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