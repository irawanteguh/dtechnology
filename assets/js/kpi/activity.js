var calendar; // Declare calendar as a global variable
var currentViewDate; // Variable to store the current view date

calendar();

$('#modal_activity_userguides').on('hidden.bs.modal', function (e) {
    $('#modal_activity_add').modal('show');
});

$('#modal_activity_add').on('show.bs.modal', function (e) {
    $("input[name='data_activity_time_start_add']").val(new Date().getHours() + ":" + ('0' + new Date().getMinutes()).slice(-2));
    $("input[name='data_activity_time_end_add']").val(new Date().getHours() + ":" + ('0' + new Date().getMinutes()).slice(-2));
    $('#data_activity_description_add').val("");
    volume();
});

flatpickr('[name="data_activity_date_add"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="data_activity_time_start_add"]', {
    enableTime   : true,
    time_24hr    : true,
    noCalendar   : true,
    dateFormat   : "H:i",
    defaultHour  : new Date().getHours(),
    defaultMinute: new Date().getMinutes(),
    allowInput   : true, // Mengizinkan input manual
    minuteIncrement  : 1,
    onChange: function(selectedDates, dateStr, instance) {
        checkTime();
    },
    onClose: function(selectedDates, dateStr, instance) {
        // Validasi input manual
        var timeFormat = /^([01]\d|2[0-3]):([0-5]\d)$/;
        if (!timeFormat.test(dateStr)) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>Format waktu tidak valid. Harap gunakan format HH:mm.</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
            instance.clear(); // Menghapus input jika format tidak valid
        }
    }
});

flatpickr('[name="data_activity_time_end_add"]', {
    enableTime   : true,
    time_24hr    : true,
    noCalendar   : true,
    dateFormat   : "H:i",
    defaultHour  : new Date().getHours(),
    defaultMinute: new Date().getMinutes(),
    allowInput   : true, 
    minuteIncrement  : 1,
    onChange: function(selectedDates, dateStr, instance) {
        checkTime();
    },
    onClose: function(selectedDates, dateStr, instance) {
        var timeFormat = /^([01]\d|2[0-3]):([0-5]\d)$/;
        if (!timeFormat.test(dateStr)) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>Format waktu tidak valid. Harap gunakan format HH:mm.</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });

            instance.clear(); // Menghapus input jika format tidak valid
        }
    }
});

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
            url   : url + "index.php/kpi/activity/calender",
            method: 'POST'
        }],
        selectable    : true,
        editable      : true,
        firstDay      : 1,
        dayMaxEvents  : 5,
        fixedWeekCount: true,
        timeZone      : 'Asia/Jakarta',
        themeSystem   : "bootstrap5",
        eventTimeFormat: { // Format for displaying time in 24-hour format
            hour: '2-digit',
            minute: '2-digit',
            hour12: false // Disable 12-hour (AM/PM) format
        },
        select        : function (e) {},
        dateClick: function(info) {
            var today = new Date();
            var clickedDate = new Date(info.dateStr);

            if (clickedDate > today) {
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html             : "<b>You cannot select a date beyond today.</b>",
                    icon             : "error",
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : {confirmButton: "btn btn-danger"},
                    showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                    hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                });
            } else {
                var batasperiodeid = $("input[name='data_activity_periodeid_add']").val();

                var pilihtgl  = info.dateStr;
                    pilihtgl  = String(pilihtgl);
                    pilihtgl  = pilihtgl.substr(8,2)+'.'+pilihtgl.substr(5,2)+'.'+pilihtgl.substr(0,4);
                var periodeid = pilihtgl.substr(3,7);

                if (batasperiodeid === periodeid || periodeid > batasperiodeid) {
                    $(":input[name='data_activity_date_add']").val(pilihtgl);
                    $('#modal_activity_add').modal('show');
                } else {
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                        html             : "<b>Input has exceeded the specified time limit.</b>",
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
            }
        },
        eventDrop: function(info) {},
        eventClick: function(info) {
            var startDate       = new Date(info.event.start);
            var endDate         = new Date(info.event.end);
            var startDateString = startDate.toISOString().replace('T', ' ').substring(0, 19);
            var endDateString   = endDate.toISOString().replace('T', ' ').substring(0, 19);

            $(":hidden[name='transidactivityview']").val(info.event.extendedProps.transid);
            $('#eventname').html(info.event.title);
            $('#eventdescription').html(info.event.extendedProps.kegiatandetail);
            $('#validator').html("Validator Activity : "+info.event.extendedProps.validator);
            $('#eventstartdate').html(startDateString);
            $('#eventenddate').html(endDateString);
            $('#modal_activity_view').modal('show');
        },
        aspectRatio: 2.4
    });

    calendar.render();
    currentViewDate = calendar.getDate(); // Store the current view date after rendering
}

function checkTime() {
    var startTime = document.getElementById("data_activity_time_start_add").value;
    var endTime   = document.getElementById("data_activity_time_end_add").value;
    var startDate = new Date("2000-01-01T" + startTime + ":00");
    var endDate   = new Date("2000-01-01T" + endTime + ":00");

    if (startDate > endDate) {
        Swal.fire({
            icon : 'error',
            title: 'Oops...',
            text : 'Waktu mulai tidak boleh melebihi atau sama dengan waktu selesai!',
        });
    }else{
        volume();
    }
}

function volume(){
	var kegiatan        = $("select[name='data_activity_primaryactivity_add']").val();
	var mulaikegiatan   = $("input[name='data_activity_time_start_add']").val();
	var selesaikegiatan = $("input[name='data_activity_time_end_add']").val();
	$.ajax({
		url     : url+"index.php/kpi/activity/volume",
		data    : {'kegiatan': kegiatan, 'mulaikegiatan': mulaikegiatan, 'selesaikegiatan': selesaikegiatan},
		method  : "POST",
		dataType: "html",
		cache   : false,
		success : function (data) {
			$("select[name='data_activity_volume_add']").html(data);
		}
	});
	return false;
};

$(document).on("change", "select[name='data_activity_primaryactivity_add']", function (e) {
    e.preventDefault();
    volume();
});

$(document).on("submit", "#forminsertactivity", function (e) {
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
            $("#btn_activity_add").addClass("disabled");
        },
        success: function (data) {
            toastr.clear();

            if (data.responCode == "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                $("#modal_activity_add").modal("hide");
                currentViewDate = calendar.getDate(); // Update the current view date
                calendar.refetchEvents(); // Refetch events to update the calendar
            } else {
                $("#btn_activity_add").removeClass("disabled");
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
            }
        },
        complete: function () {
            toastr.clear();
            $("#btn_activity_add").removeClass("disabled");
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

document.getElementById('kt_modal_view_event_delete').addEventListener('click', function() {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var transid = document.getElementById('transidactivityview').value;
            $.ajax({
                url        : url + "index.php/kpi/activity/hapusactivity",
                data       : { transid: transid },
                type       : 'POST',
                dataType   : "JSON",
                cache      : false,
                processData: true,
                success: function(data) {
                    if (data.responCode === "00") {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>Success</h1>",
                            html             : "<b>The position has been deleted.</b>",
                            icon             : data.responHead,
                            confirmButtonText: 'Yeah, got it!',
                            customClass      : {confirmButton: 'btn btn-success'},
                            timerProgressBar : true,
                            timer            : 2000,
                            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
                        }).then(() => {
                            $("#modal_activity_view").modal("hide"); // Hide the modal
                            currentViewDate = calendar.getDate(); // Update the current view date
                            calendar.refetchEvents(); // Refetch events to update the calendar
                        });
                    } else {
                        Swal.fire({
                            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                            html             : "<b>The position could not be deleted.</b>",
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
                },
                error: function() {
                    Swal.fire({
                        title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                        html             : "<b>There was a problem with the server.</b>",
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
        }
    });
});
