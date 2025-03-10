var calendar; // Declare calendar as a global variable
var currentViewDate; // Variable to store the current view date

dataok();
calendar();

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
    var data_mrpasien   = btn.attr("data_mrpasien");
    var data_operasiid   = btn.attr("data_operasiid");

    $("#kt_drawer_chat_reserve_namapasien").html(data_namapasien+" [ "+data_mrpasien+" ]");
    $('#operasiid').val(data_operasiid);
    $('#modal_cancelled_operasiid').val(data_operasiid);
    chat(data_operasiid);
};

function calendar() {
    var e = document.getElementById("kt_calendar_app");
    calendar = new FullCalendar.Calendar(e, {
        headerToolbar: {
            start : "prev,next today",
            center: "title",
            end   : "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },
        initialView: 'dayGridMonth',
        eventSources: [{
            url   : url + "index.php/ok/reserve/calender",
            method: 'POST'
        }],
        selectable    : true,
        editable      : true,
        firstDay      : 1,
        dayMaxEvents  : 5,
        fixedWeekCount: true,
        timeZone      : 'Asia/Jakarta',
        themeSystem   : "bootstrap5",
        // eventTimeFormat: { // Format for displaying time in 24-hour format
        //     hour: '2-digit',
        //     minute: '2-digit',
        //     hour12: false // Disable 12-hour (AM/PM) format
        // },
        select        : function (e) {},
        dateClick: function(info) {},
        eventDrop: function(info) {},
        eventClick: function(info) {},
        aspectRatio: 2.4
    });

    calendar.render();
    currentViewDate = calendar.getDate(); // Store the current view date after rendering
}

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
                                      " data_mrpasien='"+result[i].mrpasien+"'"+
                                      " data_operasiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                
                                if(result[i].status!="99"){
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-kt-drawer-show='true' data-kt-drawer-target='#kt_drawer_chat_reserve' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-send'></i> Follow Up</a>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_value='2' onclick='updatedata($(this));'><i class='bi bi-check2-circle text-success'></i> Agree</a>";
                                    tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_cancelled' "+getvariabel+" onclick='getdata($(this));'><i class='fa-solid fa-user-slash text-danger'></i> Cancelled</a>";
                                }
                                
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="<td><div><span class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</span></div><div><span class='badge badge-light-info'>" + (result[i].reason ? result[i].reason : "") + "</span></div></td>";
                    tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";
                    tableresult +="<td>"+(result[i].diagnosis ? result[i].diagnosis : "")+"</td>";
                    tableresult +="<td>";
                        tableresult +="<div>";
                            tableresult +="<div>"+(result[i].cito === "Y" ? "<span class='badge badge-light-danger mb-1'>CITO</span> " : "<span class='badge badge-light-primary mb-1'>ELEKTIF</span> ")+(result[i].package ? result[i].package : "")+"</div>";
                            tableresult +="<div class='small fst-italic'>"+(result[i].tindakan ? result[i].tindakan : "")+"</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="<td>"+(result[i].kelas ? result[i].kelas : "")+"</td>";
                    tableresult +="<td>"+(result[i].harga ? todesimal(result[i].harga) : "")+"</td>";
                    tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                    tableresult +="<td>"+(result[i].anastesi ? result[i].anastesi : "")+"</td>";
                    tableresult +="<td>"+(result[i].anak ? result[i].anak : "")+"</td>";
                    tableresult +="<td>"+(result[i].provider ? result[i].provider : "")+"</td>";
                    tableresult +="<td>"+(result[i].benefit ? result[i].benefit : "")+"</td>";
                    tableresult +="<td class='text-end pe-4'><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";

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

function chat(operasiid) {
    $.ajax({
        url: url + "index.php/ok/reserve/chat",
        data: { operasiid: operasiid },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            $("#chatfollowup").html("");
        },
        success: function (data) {
            var tableresult = "";
            var lastName = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                for (var i in result) {
                    var chatType = result[i].type === "in" ? "info" : "primary";
                    var isSameUser = lastName === result[i].name;
                    lastName = result[i].name;

                    tableresult += `<div class='d-flex justify-content-${result[i].type === "in" ? "start" : "end"}'>`;
                    tableresult += `<div class='d-flex flex-column align-items-${result[i].type === "in" ? "start" : "end"}'>`;

                    if (!isSameUser) {
                        tableresult += `<div class='d-flex align-items-center mb-2'>`;
                        if (result[i].type === "out") {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='d-flex flex-column me-3 text-end'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        } else {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='d-flex flex-column'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        }
                        tableresult += `</div>`;
                    }

                    tableresult += `<div class='p-5 rounded bg-light-${chatType} text-dark fw-bold mw-lg-400px text-${result[i].type === "in" ? "start" : "end"} mb-3' data-kt-element='message-text'>`;
                    tableresult += `${result[i].chat}`;
                    tableresult += `<div class='text-muted small mt-2'>${result[i].jambuat}</div>`;
                    tableresult += `</div>`;
                    
                    tableresult += `</div>`;
                    tableresult += `</div>`;
                }
            }

            $("#chatfollowup").html(tableresult);
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
    return false;
}

function updatedata(btn) {
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
            var data_operasiid = btn.attr("data_operasiid");
            var data_value     = btn.attr("data_value");

            $.ajax({
                url       : url+"index.php/ok/reserve/updatedata",
                data      : {data_operasiid:data_operasiid,data_value:data_value},
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
                    dataok();
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

$(document).on("click", "[data-kt-element='send']", function () {
    var operasiid = $("#operasiid").val();
    var message   = $("textarea[data-kt-element='input']").val();

    if (message.trim() === "") {
        Swal.fire({
            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
            html             : "<b>Pesan tidak boleh kosong</b>",
            icon             : "error",
            confirmButtonText: "Please Try Again",
            buttonsStyling   : false,
            timerProgressBar : true,
            timer            : 5000,
            customClass      : {confirmButton: "btn btn-danger"},
            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
        });

        return;
    }

    $.ajax({
        url: url + "index.php/ok/reserve/sendChat",
        method: "POST",
        data: { chat: message,operasiid:operasiid },
        dataType: "JSON",
        success: function (data) {

            if (data.responCode === "00") {
                $("textarea[data-kt-element='input']").val(""); // Kosongkan textarea
                chat(operasiid); // Muat ulang chat
            } else {
                alert("Gagal mengirim pesan!");
            }
        }
    });
});

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

$(document).on("submit", "#formcancelled", function (e) {
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
			$("#modal_cancelled_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_cancelled").modal("hide");
                dataok();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_cancelled_btn").removeClass("disabled");
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