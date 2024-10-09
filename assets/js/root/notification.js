
information();

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
            

            $(":hidden[name='modal_validation_perilaku_periodeid_add']").val("");
            $(":hidden[name='data_activity_periodeid_add']").val("");
            $(":text[name='data_assessment_periodeid_add']").val("");
        },
        success:function(data){
            var result = data.responResult;
            $("#informasiperiodeactivity").html(result[0].periodeketeranganactivity);
            $("#informasiperiodeassessment").html(result[0].periodeketeranganassessment);
            $("#informasibatasactivity").html(result[0].endactivity+" "+result[0].periodeketeranganbatassactivity+" 23:59:00");
            $("#informasiperiodeassessmentmulai").html(result[0].startassessment+" "+result[0].keteranganbatasassessment+" 00:00:00");
            $("#informasiperiodeassessmentselesai").html(result[0].endassessment+" "+result[0].keteranganbatasassessment+" 23:59:00");

            $(":hidden[name='modal_validation_perilaku_periodeid_add']").val(result[0].periodeidassessment);
            $(":hidden[name='data_activity_periodeid_add']").val(result[0].periodeidactivity);
            $(":text[name='data_assessment_periodeid_add']").val(result[0].periodeidassessment);
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