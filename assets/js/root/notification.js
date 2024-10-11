information();
selfreportkpi();

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