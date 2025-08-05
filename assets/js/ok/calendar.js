var calendar;
var currentViewDate;

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
