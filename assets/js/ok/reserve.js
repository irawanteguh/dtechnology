dataok();

flatpickr('[name="modal_add_plan_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$('#modal_add_plan').on('show.bs.modal', function (e) {
    $('#modal_add_plan_date').val("");
    $('#modal_add_plan_tindakan').val("");
    $('#modal_add_plan_cito').prop('checked', false); 
});

function getdata(btn){
    var data_namapasien = btn.attr("data_namapasien");
    var data_mrpasien = btn.attr("data_mrpasien");

    $("#kt_drawer_chat_reserve_namapasien").html(data_namapasien+" [ "+data_mrpasien+" ]");

    chat();
};

function dataok(){
    $.ajax({
        url       : url+"index.php/ok/reserve/dataok",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataok").html("");
        },
        success:function(data){
            let tableresult;

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel = " data_namapasien='"+result[i].namepasien+"'"+
                                      " data_mrpasien='"+result[i].mrpasien+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div></td>";
                    tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";
                    tableresult +="<td>"+(result[i].tindakan ? result[i].tindakan : "")+"</td>";
                    tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                    tableresult +="<td>"+(result[i].anastesi ? result[i].anastesi : "")+"</td>";
                    tableresult +="<td>"+(result[i].anak ? result[i].anak : "")+"</td>";
                    tableresult +="<td>"+(result[i].provider ? result[i].provider : "")+"</td>";
                    tableresult +="<td class='text-end pe-4'><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";
                    
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#kt_drawer_chat_reserve' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-send'></i> Follow Up</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }


            $("#resultdataok").html(tableresult);
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

function chat(){
    $.ajax({
        url       : url+"index.php/ok/reserve/chat",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#chatfollowup").html("");
        },
        success:function(data){
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){
                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    tableresult += `<div class='d-flex justify-content-${result[i].type === "in" ? "start" : "end"} mb-10'>`;
                        tableresult += `<div class='d-flex flex-column align-items-${result[i].type === "in" ? "start" : "end"}'>`;
                            tableresult += `<div class='d-flex align-items-center mb-2'>`;

                            if (result[i].type === "out") {
                                tableresult += `<div class='d-flex align-items-center'>`;
                                    tableresult += `<div class='d-flex flex-column me-3 text-end'>`;
                                        tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                                        tableresult += `<span class='text-muted fs-7 mb-1'>${result[i].jambuat}</span>`;
                                    tableresult += `</div>`;
                                    tableresult += `<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>`;
                                        tableresult += `<div class='symbol-label fs-3 bg-light-${randomColor} text-${randomColor}'>${result[i].initial}</div>`;
                                    tableresult += `</div>`;
                                tableresult += `</div>`;
                            } else {
                                tableresult += `<div class='d-flex align-items-center'>`;
                                    tableresult += `<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>`;
                                        tableresult += `<div class='symbol-label fs-3 bg-light-${randomColor} text-${randomColor}'>${result[i].initial}</div>`;
                                    tableresult += `</div>`;
                                    tableresult += `<div class='d-flex flex-column'>`;
                                        tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                                        tableresult += `<span class='text-muted fs-7 mb-1'>${result[i].jambuat}</span>`;
                                    tableresult += `</div>`;
                                tableresult += `</div>`;
                            }
                            

                            tableresult += `</div>`;
                            tableresult += `<div class='p-5 rounded bg-light-${result[i].type === "in" ? "info" : "primary"} text-dark fw-bold mw-lg-400px text-${result[i].type === "in" ? "start" : "end"}' data-kt-element='message-text'>${result[i].chat}</div>`;

                        tableresult += `</div>`;
                    tableresult += `</div>`;

                }
            }


            $("#chatfollowup").html(tableresult);
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

$(document).on("submit", "#formnewreserve", function (e) {
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
			$("#modal_add_plan_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_add_plan").modal("hide");
                dataok();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_add_plan_btn").removeClass("disabled");
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