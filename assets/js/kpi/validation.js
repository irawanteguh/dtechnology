liststaff();

$('#modal_validation_kegiatan').on('shown.bs.modal', function() {
    $('#checkall').prop('checked', false);
    $('#resultactivity input[type="checkbox"]').prop('checked', false);
});


document.getElementById('checkall').addEventListener('change', function() {
    var checkboxes = document.querySelectorAll('#resultactivity input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = this.checked;
    }, this);
});

$(document).on("click",".btn-validasi", function(e){            
    e.preventDefault();
    simpanvalidasi(this);
});

$(document).on("click",".btn-validation-kegiatan", function(e){            
    e.preventDefault();
    detailactivity($(this));
});


$('#modal_validation_perilaku').on('show.bs.modal', function (e) {
    listassement();
});

function getdata(btn){
    toastr.clear();

    var userid = btn.attr("data-userid");

    $(":hidden[name='modal_validation_perilaku_userid_add']").val(userid);
    $(":hidden[name='modal_validation_acivity_userid']").val(userid);
};

function liststaff(){
    $.ajax({
        url        : url+"index.php/kpi/validation/liststaff",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultlistvalidation").html("");
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
                    // const style       = "display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;";
                    var   randomIndex = Math.floor(Math.random() * color.length);
                    var   randomColor = color[randomIndex];


                    getvariabel =   "data-userid='"+result[i].user_id+"'";


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
                                if(result[i].position_primary==="Y"){
                                    tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].name+" <span class='svg-icon svg-icon-1 svg-icon-primary'></span><svg xmlns='http://www.w3.org/2000/svg' width='24px' height='24px' viewBox='0 0 24 24'><path d='M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z' fill='#00A3FF'></path><path class='permanent' d='M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z' fill='white'></path></svg></a>";
                                }else{
                                    tableresult +="<a class='text-gray-800 text-hover-primary mb-1' href='#'>"+result[i].name+"</a>";
                                }
                                tableresult +="<span>"+(result[i].email ? result[i].email : "-")+"</span>";
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";
                    
                    if(result[i].kategori_id==="65f1ccae-3ae6-4209-a66e-d7920b5824f5" || result[i].kategori_id==="b9710449-f5e4-4553-a962-f3b0f574dbc4"){
                        tableresult +="<td><div>"+(result[i].position ? result[i].position : "")+(result[i].fungsionalprimary ? " "+result[i].fungsionalprimary : "")+"</div><div>"+(result[i].klinis ? result[i].klinis : "")+"</div></td>";
                    }else{
                        tableresult +="<td>"+(result[i].position ? result[i].position : "")+(result[i].fungsionalprimary ? " "+result[i].fungsionalprimary : "")+"</td>";
                    }

                    if(result[i].position_primary==="Y"){
                        if(parseInt(result[i].jmldisetujui) >= parseInt(result[i].hours_month) ){
                            tableresult +="<td class='text-center'><i class='fa-solid fa-circle-check text-success fa-2x'></i></td>";
                        }else{
                            tableresult +="<td class='text-center'><i class='fa-solid fa-triangle-exclamation text-danger fa-2x fa-fade'></i></td>";
                        }
                        
                    }else{
                        tableresult +="<td class='text-center'><i class='fa-regular fa-circle-question text-warning fa-2x'></i></td>";
                    }
                    
                    
                    if(result[i].position_primary==="Y"){
                        tableresult +="<td>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Effective</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].hours_month ? todesimal(result[i].hours_month)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Create</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmldibuat ? todesimal(result[i].jmldibuat)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            if(result[i].jmlwait > 0){
                                tableresult +="<div class='d-flex text-danger fa-fade'>";
                                    tableresult +="<div class='text-start w-50'>Waiting</div>";
                                    tableresult +="<div class='text-center w-20'>:</div>";
                                    tableresult +="<div class='text-end w-25'>"+(result[i].jmlwait ? todesimal(result[i].jmlwait)  : "0")+"</div>";
                                    tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                                tableresult +="</div>";
                            }else{
                                tableresult +="<div class='d-flex'>";
                                    tableresult +="<div class='text-start w-50'>Waiting</div>";
                                    tableresult +="<div class='text-center w-20'>:</div>";
                                    tableresult +="<div class='text-end w-25'>"+(result[i].jmlwait ? todesimal(result[i].jmlwait)  : "0")+"</div>";
                                    tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                                tableresult +="</div>";
                            }
                            
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Approval</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmldisetujui ? todesimal(result[i].jmldisetujui)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            // tableresult +="<div class='d-flex'>";
                            //     tableresult +="<div class='text-start w-50'>Revision</div>";
                            //     tableresult +="<div class='text-center w-20'>:</div>";
                            //     tableresult +="<div class='text-end w-25'>"+(result[i].jmldirevisi ? todesimal(result[i].jmldirevisi)  : "0")+"</div>";
                            //     tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            // tableresult +="</div>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Reject</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmlditolak ? todesimal(result[i].jmlditolak)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }else{
                        tableresult +="<td>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Effective</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].hours_month ? todesimal(result[i].hours_month)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Create</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmldibuatsec ? todesimal(result[i].jmldibuatsec)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            if(result[i].jmlwaitsec > 0){
                                tableresult +="<div class='d-flex text-danger fa-fade'>";
                                    tableresult +="<div class='text-start w-50'>Waiting</div>";
                                    tableresult +="<div class='text-center w-20'>:</div>";
                                    tableresult +="<div class='text-end w-25'>"+(result[i].jmlwaitsec ? todesimal(result[i].jmlwaitsec)  : "0")+"</div>";
                                    tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                                tableresult +="</div>";
                            }else{
                                tableresult +="<div class='d-flex'>";
                                    tableresult +="<div class='text-start w-50'>Waiting</div>";
                                    tableresult +="<div class='text-center w-20'>:</div>";
                                    tableresult +="<div class='text-end w-25'>"+(result[i].jmlwaitsec ? todesimal(result[i].jmlwaitsec)  : "0")+"</div>";
                                    tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                                tableresult +="</div>";
                            }
                            
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Approval</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmldisetujuisec ? todesimal(result[i].jmldisetujuisec)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                            // tableresult +="<div class='d-flex'>";
                            //     tableresult +="<div class='text-start w-50'>Revision</div>";
                            //     tableresult +="<div class='text-center w-20'>:</div>";
                            //     tableresult +="<div class='text-end w-25'>"+(result[i].jmldirevisisec ? todesimal(result[i].jmldirevisisec)  : "0")+"</div>";
                            //     tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            // tableresult +="</div>";
                            tableresult +="<div class='d-flex'>";
                                tableresult +="<div class='text-start w-50'>Reject</div>";
                                tableresult +="<div class='text-center w-20'>:</div>";
                                tableresult +="<div class='text-end w-25'>"+(result[i].jmlditolaksec ? todesimal(result[i].jmlditolaksec)  : "0")+"</div>";
                                tableresult +="<div class='ps-5 w-10'>Minutes</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }
                    

                    // tableresult +="<td><div>Effective : "+(result[i].hours_month ? todesimal(result[i].hours_month)  : "")+" Minutes</div><div>Actual : "+(result[i].hours_month ? todesimal(result[i].hours_month)  : "")+" Minutes</div><div>Difference : "+(result[i].hours_month ? todesimal(result[i].hours_month)  : "")+" Minutes</div></td>";
                    tableresult +="<td class='text-center'>"+(result[i].presentasiactivity ? todesimal(result[i].presentasiactivity)  : "0")+"%</td>";
                    tableresult +="<td class='text-center'>"+(result[i].presentasiperilaku ? todesimal(result[i].presentasiperilaku)  : "0")+"%</td>";
                    tableresult +="<td class='text-center'>"+(result[i].resultkpi ? todesimal(result[i].resultkpi)  : "0")+"%</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm btn-validation-kegiatan' data-bs-toggle='modal' data-bs-target='#modal_validation_kegiatan' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil'></i> Validation Activites</a>";
                                if(result[i].position_primary==="Y"){
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_validation_perilaku' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-person-add'></i> Personal Assessment</a>";
                                }
                                
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";

                    jml ++;
                }
            }

            $("#resultlistvalidation").html(tableresult);
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

function detailactivity(btn){
    var userid   = btn.attr("data-userid");
    $.ajax({
        url        : url+"index.php/kpi/validation/detailactivity",
        data       : {userid:userid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#resultactivity").html("");
        },
        success:function(data){
            toastr.clear();
            var tableresult = "";

            if(data.responCode==="00"){
                var result = data.responResult;

                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><input class='form-check-input h-20px w-20px' type='checkbox' name='pilih["+result[i].trans_id+"]' value='"+result[i].trans_id+"'></td>";
                    tableresult +="<td><div class='font-weight-bold'>"+result[i].kegiatanutama+"</div><div class='font-italic'>"+result[i].activity+"</div></td>";
                    tableresult +="<td class='text-center'>"+result[i].qty+"</td>";
                    tableresult +="<td class='pe-4 text-end'><div>"+result[i].start_date+"</div><div class='font-italic'>"+result[i].start_time_in+" - "+result[i].start_time_out+"</div></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultactivity").html(tableresult);
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
}

function listassement(){
    $.ajax({
        url        : url+"index.php/kpi/validation/listassement",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#personalassessment").html("");
        },
        success:function(data){
            toastr.clear();
            var tableresult = "";
            var bodyContents = {};

            if(data.responCode==="00"){
                var result = data.responResult;

                // First pass: create headers and initialize bodyContents
                for(var i in result){
                    if(result[i].jenis === "H"){
                        tableresult += "<div class='accordion-item'>";
                        tableresult += "<h2 class='accordion-header' id='"+result[i].assessment_id+"'>";
                        tableresult += "<button class='accordion-button fs-4 fw-bold collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#accordion_body_"+result[i].assessment_id+"' aria-expanded='false' aria-controls='accordion_body_"+result[i].assessment_id+"'>"+result[i].assessment+"</button>";
                        tableresult += "</h2>";
                        tableresult += "<div id='accordion_body_"+result[i].assessment_id+"' class='accordion-collapse collapse' aria-labelledby='accordion_header_"+result[i].assessment_id+"' data-bs-parent='#personalassessment'>";
                        tableresult += "<div class='accordion-body' id='body_"+result[i].assessment_id+"'></div>";
                        tableresult += "</div>";
                        tableresult += "</div>";

                        bodyContents[result[i].assessment_id] = "";
                    }
                }

                // Second pass: add details to bodyContents
                for(var i in result){
                    if(result[i].jenis === "D"){
                        if(result[i].kategori_id === "+"){
                            if(result[i].jenis === "D" && bodyContents[result[i].header_id] !== undefined){
                                bodyContents[result[i].header_id] += "<label class='fw-bold fs-6 mb-1' for='"+result[i].assessment_id+"'>"+result[i].assessment+" :</label>";
                            }
                            bodyContents[result[i].header_id] += "<div class='d-flex flex-wrap justify-content-sm-between'>";
                            for (var j = 1; j <= 10; j++) {
                                bodyContents[result[i].header_id] += "<div class='form-check form-check-custom form-check-solid mb-10 me-3'>";
                                    bodyContents[result[i].header_id] += "<input class='form-check-input' name='"+result[i].assessment_id+"' type='radio' value='"+j+"' id='"+result[i].assessment_id+"_"+j+"'/>";
                                    bodyContents[result[i].header_id] += "<label class='form-check-label' for='"+result[i].assessment_id+"_"+j+"'>";
                                        bodyContents[result[i].header_id] += "<div class='fw-bolder text-gray-800'>"+j+"</div>";
                                    bodyContents[result[i].header_id] += "</label>";
                                bodyContents[result[i].header_id] += "</div>";
                            }
                            bodyContents[result[i].header_id] += "</div>";
                        }else{
                            if(result[i].jenis === "D" && bodyContents[result[i].header_id] !== undefined){
                                bodyContents[result[i].header_id] += "<label class='fw-bold fs-6 mb-1 text-danger' for='"+result[i].assessment_id+"'>"+result[i].assessment+" :</label>";
                            }
                            bodyContents[result[i].header_id] += "<div class='d-flex flex-wrap justify-content-sm-between'>";
                            for (var j = 10; j >= 1; j--) {
                                var value = 11 - j; // untuk membuat value dari 1 sampai 10
                                bodyContents[result[i].header_id] += "<div class='form-check form-check-custom form-check-solid mb-10 me-3'>";
                                    bodyContents[result[i].header_id] += "<input class='form-check-input' name='"+result[i].assessment_id+"' type='radio' value='"+value+"' id='"+result[i].assessment_id+"_"+value+"'/>";
                                    bodyContents[result[i].header_id] += "<label class='form-check-label' for='"+result[i].assessment_id+"_"+value+"'>";
                                        bodyContents[result[i].header_id] += "<div class='fw-bolder text-gray-800'>"+j+"</div>";
                                    bodyContents[result[i].header_id] += "</label>";
                                bodyContents[result[i].header_id] += "</div>";
                            }
                            bodyContents[result[i].header_id] += "</div>";
                            
                        }
                    }
                    
                }

                // Third pass: insert bodyContents into accordion-body
                for(var id in bodyContents){
                    tableresult = tableresult.replace("<div class='accordion-body' id='body_" + id + "'></div>", "<div class='accordion-body' id='body_" + id + "'>" + bodyContents[id] + "</div>");
                }
            }

            $("#personalassessment").html(tableresult);
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
}

$(document).on("submit", "#forminsertassessment", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var form = $(this);
    var url  = $(this).attr("action");

    // Collect all checked inputs
    var assessments = [];
    $("input[type=radio]:checked").each(function() {
        assessments.push({
            assessment_id: $(this).attr('name'),
            nilai: $(this).val()
        });
    });

    // Append assessment data to form data
    assessments.forEach(function(assessment) {
        form.append('<input type="hidden" name="assessment_ids[]" value="' + assessment.assessment_id + '">');
        form.append('<input type="hidden" name="nilai[]" value="' + assessment.nilai + '">');
    });

    $.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#btn_personalassessement_add").addClass("disabled");
        },
        success: function (data) {
            toastr.clear();

            if (data.responCode == "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_validation_perilaku").modal("hide");
                liststaff();
            } else {
                $("#btn_personalassessement_add").removeClass("disabled");
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
            $("#btn_personalassessement_add").removeClass("disabled");
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

function simpanvalidasi(button) {
    toastr["info"]('Mohon Menunggu Kami Sedang Melakukan Penyimpanan Data', "INFORMATION");
    var form = $("#fromvalidationactivity");
    var url = form.attr("action");
    var status = $(button).attr('name');

    var formData = form.serialize();
    formData += '&status=' + encodeURIComponent(status);

    $.ajax({
        url: url,
        data: formData,
        method: "POST",
        dataType: "JSON",
        cache: false,
        success: function (data, textStatus, jqXHR) {
    
            if (data.responCode === "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $('#modal_validation_kegiatan').modal('hide');
                liststaff();
            } else {
                $(".btn-validasi").removeClass("disabled");
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
}

