var todolistChart;

todolist();
charttodolist();
datastaff();

$('#modal-todolist').on('shown.bs.modal', function (e) {
    $('#todolist-kegiatan-tambah').val("");
    $('#todolist-duedate-tambah').val("");
    $('#todolist-prioritas-tambah').val("");
});

flatpickr('[name="todolist-duedate-tambah"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate: "today", // Mencegah pemilihan tanggal sebelum hari ini
    onChange: function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function todolist() {
    $.ajax({
        url: url + "index.php/dashboard/dashboard/todolist",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function() {
            $("#kt_activity_today").html("");
            $("#kt_activity_week").html("");
            $("#kt_activity_month").html("");
            $("#kt_activity_year").html("");
            $("#allcount").html("");
            $("#counttodolist").html("");
            $("#countwaiting").html("");
            $("#countoverdue").html("");
            $("#countdone").html("");
            $("#countoverduelabel").html("");
            $("#info_list_todo").html("");
        },
        success: function(data) {
            var result           = "";
            var tableresultToday = "";
            var tableresultWeek  = "";
            var tableresultMonth = "";
            var tableresultYear  = "";
            var assignby         = "";
            var allcount         = 0;
            var overduecount     = 0;
            var waiting          = 0;
            var done             = 0;

            if (data.responCode === "00") {
                result = data.responResult;

                for (var i in result) {

                    if(result[i].statusshow === "1"){
                        if(result[i].USER_ID === result[i].CREATED_BY){
                            assignby ="";
                        }else{
                            assignby ="Assign By <a href='#'>"+result[i].dibuatoleh+"</a>"
                        }
    
                        var tableresult = "<div class='d-flex align-items-center mb-8'>";
    
                        if (result[i].PRIORITY === "0") {
                            tableresult += "<span class='bullet bullet-vertical h-40px bg-success'></span>";
                        } else if (result[i].PRIORITY === "1") {
                            tableresult += "<span class='bullet bullet-vertical h-40px bg-primary'></span>";
                        } else if (result[i].PRIORITY === "2") {
                            tableresult += "<span class='bullet bullet-vertical h-40px bg-warning'></span>";
                        } else {
                            tableresult += "<span class='bullet bullet-vertical h-40px bg-danger'></span>";
                        }
    
                        tableresult += "<div class='form-check form-check-custom form-check-solid mx-5'>";
                        tableresult += "<input class='form-check-input' type='checkbox' value='"+result[i].TODO_ID+"' onclick='toggleStrikeThrough(this)' " + (result[i].STATUS === "1" ? "checked" : "") + ">";
                        tableresult += "</div>";
    
    
                        tableresult += "<div class='flex-grow-1'>";
    
                        if(result[i].STATUS === "0" ){
                            tableresult += "<a href='#' class='text-gray-800 text-hover-primary fw-bolder fs-6 todo-item'>" + result[i].TODO + "</a>";
                        }else{
                            tableresult += "<a href='#' class='text-gray-800 text-hover-primary fw-bolder fs-6 todo-item text-decoration-line-through'>" + result[i].TODO + "</a>";
                        }
                        
                        if(result[i].DAYS_DIFF < 0){
                            tableresult += "<span class='text-muted fw-bold d-block'>Late "+result[i].DAYS_DIFF+" Days</span>";
                        }else{
                            tableresult += "<span class='text-muted fw-bold d-block'>"+result[i].KETERANGAN+"</span>";
                        }
    
                        tableresult += "<span class='text-muted fw-bold d-block'>"+assignby+"</span>";
                        tableresult += "</div>";
    
                        if (result[i].PRIORITY === "0") {
                            tableresult += "<span class='badge badge-light-success fs-8 fw-bolder'>Low</span>";
                        } else if (result[i].PRIORITY === "1") {
                            tableresult += "<span class='badge badge-light-primary fs-8 fw-bolder'>Medium Low</span>";
                        } else if (result[i].PRIORITY === "2") {
                            tableresult += "<span class='badge badge-light-warning fs-8 fw-bolder'>Medium High</span>";
                        } else {
                            tableresult += "<span class='badge badge-light-danger fs-8 fw-bolder'>High</span>";
                        }
    
                        
                        tableresult += "<a class='btn btn-icon btn-active-color-danger btn-sm' data-id='"+result[i].TODO_ID+"'  onclick='deletetodolist(this)'><i class='bi bi-trash-fill'></i></a>";
                        tableresult += "</div>";
    
                        if (result[i].DUEDATE === "1") {
                            tableresultToday += tableresult;
                        } else if (result[i].DUEDATE === "2") {
                            tableresultWeek += tableresult;
                        } else if (result[i].DUEDATE === "3") {
                            tableresultMonth += tableresult;
                        } else if (result[i].DUEDATE === "4") {
                            tableresultYear += tableresult;
                        }
                    }

                    allcount ++;
                    if(result[i].countstatus==="1"){
                        overduecount ++;
                    }else{
                        if(result[i].countstatus==="2"){
                            waiting ++;
                        }else{
                            done ++;
                        }
                    }
                }
            }else{
                // Swal.fire({
                //     title: "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                //     html: "<b>" + data.responDesc + "</b>",
                //     icon: data.responHead,
                //     confirmButtonText: "Please Try Again",
                //     buttonsStyling: false,
                //     timerProgressBar: true,
                //     timer: 5000,
                //     customClass: { confirmButton: "btn btn-danger" },
                //     showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                //     hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                // });
            }

            $("#kt_activity_today").html(tableresultToday);
            $("#kt_activity_week").html(tableresultWeek);
            $("#kt_activity_month").html(tableresultMonth);
            $("#kt_activity_year").html(tableresultYear);

            $("#allcount").html(allcount);
            $("#counttodolist").html(allcount);
            $("#countwaiting").html(waiting);
            $("#countoverdue").html(overduecount);
            $("#countoverduelabel").html(overduecount+" Overdue Tasks");
            $("#countdone").html(done);

            $("#info_list_todo").html(allcount+" Task");
        },
        complete: function() {
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
}

function charttodolist() {
    $.ajax({
        url: url + "index.php/dashboard/dashboard/charttodolist",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function() {
        },
        success: function(data) {
            var label  = [];
            var nilai1 = [];

            var result  = data.responResult;
            
            for(var i in result){
                label.push(result[i].status); 
                nilai1.push(result[i].jml); 
            }

            var chartElement = document.getElementById("todolist-chart");
            if (chartElement) {
                var context = chartElement.getContext("2d");

                if (todolistChart) {
                    todolistChart.destroy(); // Destroy the previous chart instance if it exists
                }

                todolistChart = new Chart(context, {
                    type: "doughnut",
                    data: {
                        datasets: [{
                            data: nilai1,
                            backgroundColor: ["#50CD89","#F64E60","#B5B5C3"]
                        }],
                        labels: label
                    },
                    options: {
                        chart: {
                            fontFamily: "inherit"
                        },
                        cutout: "75%",
                        cutoutPercentage: 65,
                        responsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: false
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            enabled: true,
                            intersect: false,
                            mode: "nearest",
                            bodySpacing: 5,
                            yPadding: 10,
                            xPadding: 10,
                            caretPadding: 0,
                            displayColors: false,
                            backgroundColor: "#20D489",
                            titleFontColor: "#ffffff",
                            cornerRadius: 4,
                            footerSpacing: 0,
                            titleSpacing: 0
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        },
        complete: function() {
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

function datastaff() {
    $.ajax({
        url: url + "index.php/dashboard/dashboard/datastaff",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function() {
        },
        success: function(data) {
            var result      = "";
            var tableresult = "";
            var color       = ['danger','warning','success','primary'];


            if (data.responCode === "00") {
                result = data.responResult;
                for (var i in result) {
                    var randomIndex = Math.floor(Math.random() * color.length);
                    var randomColor = color[randomIndex];

                    tableresult +="<tr>";
                    tableresult +="<td>";
                        tableresult +="<div class='d-flex align-items-center'>";
                            tableresult +="<div class='symbol symbol-45px me-5'>";
                            if(result[i].image_profile==="N"){
                                tableresult +="<div class='symbol-label fs-3 bg-light-"+randomColor+" text-"+randomColor+"'>"+result[i].initial+"</div>";
                            }else{
                                tableresult +="<img src='"+url+"assets/images/avatars/"+result[i].user_id+".jpeg' alt='"+result[i].name+"'>";
                            }
                            tableresult +="</div>";

                            tableresult +="<div class='d-flex justify-content-start flex-column'>";
                            tableresult +="<a href='#' class='text-dark fw-bolder text-hover-primary fs-6'>"+result[i].name+"</a>";

                            if(result[i].kategori_id==="65f1ccae-3ae6-4209-a66e-d7920b5824f5" || result[i].kategori_id==="b9710449-f5e4-4553-a962-f3b0f574dbc4"){
                                tableresult +="<span class='text-muted fw-bold text-muted d-block fs-7'>"+(result[i].position ? result[i].position : "")+(result[i].fungsionalprimary ? " "+result[i].fungsionalprimary : "")+"</span>";
                            }else{
                                tableresult +="<span class='text-muted fw-bold text-muted d-block fs-7'>"+result[i].position+"</span>";
                            }
                            tableresult +="</div>";

                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="<td>"+(result[i].klinis ? result[i].klinis  : "")+"</td>";

                    tableresult +="<td class='text-end'>";
                    tableresult +="<div class='d-flex flex-column w-100 me-2'>";
                        tableresult +="<div class='d-flex flex-stack mb-2'>";
                            tableresult +="<span class='text-muted me-2 fs-7 fw-bold'>"+(result[i].resultkpi ? result[i].resultkpi : "0")+"%</span>";
                        tableresult +="</div>";
                        tableresult +="<div class='progress h-6px w-100'>";
                            tableresult +="<div class='progress-bar bg-primary' role='progressbar' style='width:"+(result[i].resultkpi ? result[i].resultkpi : "0")+"%' aria-valuenow='"+(result[i].resultkpi ? result[i].resultkpi : "0")+"' aria-valuemin='0' aria-valuemax='100'></div>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }else{
                // Swal.fire({
                //     title: "<h1 class='font-weight-bold' style='color:#234974;'>For Your Information</h1>",
                //     html: "<b>" + data.responDesc + "</b>",
                //     icon: data.responHead,
                //     confirmButtonText: "Please Try Again",
                //     buttonsStyling: false,
                //     timerProgressBar: true,
                //     timer: 5000,
                //     customClass: { confirmButton: "btn btn-danger" },
                //     showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                //     hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
                // });
            }

            $("#datastaff").html(tableresult);
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
        },
        complete: function() {
            toastr.clear();
        }
    });
    return false;
};

function toggleStrikeThrough(checkbox) {
    var status = checkbox.checked ? 1 : 0;
    var todoId = $(checkbox).val();

    $.ajax({
        url     : url+"index.php/dashboard/dashboard/updatetodolist",
        data    : {id:todoId,status:status},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        success: function(data) {
            if (data.responCode=== "00") {
                todolist();
                charttodolist();
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
}

function deletetodolist(element) {
    var todoId = $(element).data("id");
    $.ajax({
        url     : url+"index.php/dashboard/dashboard/deletetodolist",
        data    : {id:todoId},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        success : function(data) {
            if (data.responCode=== "00") {
                todolist();
                charttodolist();
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
}

$(document).on("submit", "#forminserttodolist", function (e) {
	e.preventDefault();
	var data = new  FormData(this);
	$.ajax({
        url        : url+'index.php/dashboard/dashboard/inserttodolist',
        data       : data,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: false,
        contentType: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success: function (data) {
			if(data.responCode === "00"){
				todolist();
			}

			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $('#modal_dashboard_todo_add').modal('hide');
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