information();
disposisi();
informasipo();

function disposisi(){
    $.ajax({
        url        : url+"index.php/root/notification/disposisi",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#notificationdisposisi").html("");
            $("#jumlahnotification").html("");
        },
        success:function(data){
            let notification = "";

            if(data.responCode === "00"){
                let result       = data.responResult;

                for (let i in result){
                    notification+="<div class='d-flex flex-stack py-4'>";
                        notification+="<div class='d-flex align-items-center'>";

                            notification+="<div class='symbol symbol-35px me-4'>";
                                notification+="<div class='symbol-label bg-light-"+result[i].color+"'>";
                                notification+="<i class='"+result[i].icon+" text-"+result[i].color+" fa-2x'></i>"; 
                                notification+="</div>"; 
                            notification+="</div>";

                            notification+="<div class='mb-0 me-2'>";
                            notification+="<a href='../../index.php/surat/disposisi' class='fs-6 text-gray-800 text-hover-primary fw-bolder'>"+result[i].perihal+"</a>";
                            notification+="<div class='text-gray-400 fs-7'>"+result[i].ringkasan+"</div>";
                            notification+="</div>";

                        notification+="</div>";
                        notification+="<span class='badge badge-light fs-8'>"+result[i].fromdatetime+"</span>";
                    notification+="</div>";
                }

                $("#notificationdisposisi").html(notification);
                $("#jumlahnotification").html(result.length+" Reports");
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function information(){
    $.ajax({
        url        : url+"index.php/root/notification/informationkpi",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#informasiperiodeactivity").html("");
            $("#informasiperiodeassessment").html("");
            $("#informasibatasactivity").html("");
            $("#informasiperiodeassessmentmulai").html("");
            $("#informasiperiodeassessmentselesai").html("");
            
            $(":hidden[name='data_activity_periodeid_add']").val("");
        },
        success:function(data){
            var result = data.responResult;
            $("#informasiperiodeactivity").html(result[0].periodeketeranganactivity);
            $("#informasiperiodeassessment").html(result[0].periodeketeranganassessment);
            $("#informasibatasactivity").html(result[0].endactivity+" "+result[0].periodeketeranganbatassactivity+" 23:59:00");
            $("#informasiperiodeassessmentmulai").html(result[0].startassessment+" "+result[0].keteranganbatasassessment+" 00:00:00");
            $("#informasiperiodeassessmentselesai").html(result[0].endassessment+" "+result[0].keteranganbatasassessment+" 23:59:00");

            $(":hidden[name='data_activity_periodeid_add']").val(result[0].periodeidactivity);
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function selfreportkpi(){
    $.ajax({
        url        : url+"index.php/root/notification/selfreportkpi",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
        },
        success:function(data){
            var result = data.responResult;
            $("#presentasiactivity").attr("data-kt-countup-value", result[0].presentasiactivity).text(result[0].presentasiactivity + "%");
            $("#presentasiassessment").attr("data-kt-countup-value", result[0].presentasiperilaku).text(result[0].presentasiperilaku + "%");
            $("#resultkpidashboard").attr("data-kt-countup-value", result[0].resultkpi).text(result[0].resultkpi + "%");
            $("#presentasikpi").html(result[0].resultkpi+" %");
            $("#progresskpi").css("width", result[0].resultkpi + "%").attr("aria-valuenow", result[0].resultkpi);
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function informasipo(){
    $.ajax({
        url        : url+"index.php/root/notification/informasipo",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            $("#informasikoordinator").html("");
        },
        success:function(data){
            if(data.responCode === "00") {
                let result = data.responResult;
                let html = "<ul>";
                for (let i in result) {
                    if(result[i].head_koordinator==="Y"){
                        html += "<li>Proses persetujuan purchase order - <strong>" + result[i].department + " -> "+result[i].koordinator+" ("+result[i].nama+") -> "+result[i].manager+" ("+result[i].namamanager+")</strong></li>";
                    }else{
                        html += "<li>Proses persetujuan purchase order - <strong>" + result[i].department + " -> "+result[i].koordinator+" ("+result[i].nama+")</strong></li>";
                    }
                    
                }
                html += "</ul>";
                $("#informasikoordinator").html(html);
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};
