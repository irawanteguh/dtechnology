flatpickr('[name="modal_repository_add_datestart"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_repository_add_dateend"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

documentlegal();

function documentlegal(){
    $.ajax({
        url       : url + "index.php/document/documentlegal/documentlegal",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatadocumentlegal").html("");
        },
        success: function(data) {
            let tableresult = "";

            if (data.responCode === "00") {
                let result = data.responResult;

                for (let i in result) {

                    tableresult += "<tr>";
                    tableresult += "<td class='text-center'>"+ (parseInt(i) + 1) +"</td>";
                    tableresult += "<td>"+result[i].judul+"</td>";
                    tableresult += "<td>"+result[i].keterangan+"</td>";
                    tableresult += "<td>"+result[i].jenisdocument+"</td>";
                    tableresult += "<td class='text-center'>"+result[i].berlakumulai+"</td>";
                    tableresult += "<td class='text-center'>"+result[i].sampaidengan+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult +="<div class='btn-group' role='group'>";
                            tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf'  data-dirfile='"+url+"assets/documentlegal/"+result[i].transaksi_id+".pdf' onclick='viewdocwithoutnote(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult += "</tr>";

                }
            }

            $("#resultdatadocumentlegal").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
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

$(document).on("submit", "#formadddocumentlegal", function (e) {
    e.preventDefault();

    var form = $(this);
    var url  = form.attr("action");
    var formData = new FormData(this); // penting!

    $.ajax({
        url       : url,
        data      : formData,
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        contentType: false, // WAJIB untuk FormData
        processData: false, // WAJIB untuk FormData
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#modal_repository_add_btn").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                location.reload();
                $('#modal_repository_add').modal('hide');
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            $("#modal_repository_add_btn").removeClass("disabled");
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
});

calendar();

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
            url   : url + "index.php/document/documentlegal/calender",
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
        // select        : function (e) {},
        // dateClick: function(info) {
        //     var today = new Date();
        //     var clickedDate = new Date(info.dateStr);

        //     if (clickedDate > today) {
        //         Swal.fire({
        //             title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
        //             html             : "<b>You cannot select a date beyond today.</b>",
        //             icon             : "error",
        //             confirmButtonText: "Please Try Again",
        //             buttonsStyling   : false,
        //             timerProgressBar : true,
        //             timer            : 5000,
        //             customClass      : {confirmButton: "btn btn-danger"},
        //             showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
        //             hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
        //         });
        //     }else{
        //         var batasperiodeid = $("input[name='data_activity_periodeid_add']").val();

        //         var pilihtgl  = info.dateStr;
        //             pilihtgl  = String(pilihtgl);
        //             pilihtgl  = pilihtgl.substr(8,2) + '.' + pilihtgl.substr(5,2) + '.' + pilihtgl.substr(0,4);
        //         var periodeid = pilihtgl.substr(3,7);

        //         // Konversi periode menjadi angka untuk perbandingan
        //         var periodeidNum      = parseInt(periodeid.split('.').reverse().join(''));
        //         var batasperiodeidNum = parseInt(batasperiodeid.split('.').reverse().join(''));

        //         if (periodeidNum >= batasperiodeidNum) { // Jika periodeid lebih besar atau sama dengan batasperiodeid 
        //             $(":input[name='data_activity_date_add']").val(pilihtgl);
        //             $('#modal_activity_add').modal('show');
        //         } else {
        //             Swal.fire({
        //                 title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
        //                 html             : "<b>Input has exceeded the specified time limit.</b>",
        //                 icon             : "error",
        //                 confirmButtonText: "Please Try Again",
        //                 buttonsStyling   : false,
        //                 timerProgressBar : true,
        //                 timer            : 5000,
        //                 customClass      : {confirmButton: "btn btn-danger"},
        //                 showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
        //                 hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
        //             });
        //         }
        //     }
        // },
        // eventDrop: function(info) {},
        // eventClick: function(info) {
        //     var startDate       = new Date(info.event.start);
        //     var endDate         = new Date(info.event.end);
        //     var startDateString = startDate.toISOString().replace('T', ' ').substring(0, 19);
        //     var endDateString   = endDate.toISOString().replace('T', ' ').substring(0, 19);

        //     $(":hidden[name='transidactivityview']").val(info.event.extendedProps.transid);
        //     $('#eventname').html(info.event.title);
        //     $('#eventdescription').html(info.event.extendedProps.kegiatandetail);
        //     $('#validator').html("Validator Activity : "+info.event.extendedProps.validator);
        //     $('#eventstartdate').html(startDateString);
        //     $('#eventenddate').html(endDateString);
        //     $('#modal_activity_view').modal('show');
        // },
        aspectRatio: 2.4
    });

    calendar.render();
    currentViewDate = calendar.getDate(); // Store the current view date after rendering
}