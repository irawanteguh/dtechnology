dataeticket();

$('#modal_new_eticket').on('show.bs.modal', function (e) {
    $(":text[name='modal_new_eticket_transid']").val('');
    $(":text[name='modal_new_eticket_subject']").val('');
    $("textarea[name='modal_new_eticket_description']").val('');

    gettransid();

    // var myDropzone = new Dropzone("#file_doc", {
    //     url               : url + "index.php/support/overview/uploaddocument?no_pemesanan="+data_nopemesanan,
    //     acceptedFiles     : '.pdf',
    //     paramName         : "file",
    //     dictDefaultMessage: "Drop files here or click to upload",
    //     maxFiles          : 1,
    //     maxFilesize       : 2,
    //     addRemoveLinks    : true,
    //     autoProcessQueue  : true,
    //     accept            : function(file, done) {
    //         done();
    //     }
    // });
});

function dataeticket(){
    $.ajax({
        url        : url+"index.php/support/overview/dataeticket",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataeticket").html("");
        },
        success:function(data){
           
            var tableresult      = "";

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){
                    tableresult +="<div class='d-flex mb-10 animate__animated animate__fadeInUp'>";
                        if(result[i].status==="0"){
                            tableresult +="<i class='bi bi-file-earmark-plus text-warning fa-2x'></i>";
                        }
                        
                        tableresult +="<div class='d-flex flex-column'>";
                            tableresult +="<div class='d-flex align-items-center mb-2'>";
                                tableresult +="<a href='../../demo1/dist/apps/support-center/tickets/view.html' class='text-dark text-hover-primary fs-4 me-3 fw-bold'>"+result[i].subject+"</a>";
                                if(result[i].severity==="0"){
                                    tableresult +="<span class='badge badge-light-success my-1'>Low</span>";
                                }
                            tableresult +="</div>";
                            tableresult +="<span class='text-muted fw-bold fs-6'>"+result[i].description+"</span>";
                        tableresult +="</div>";
                       
                    tableresult +="</div>";
                }
            }

            $("#resultdataeticket").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
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
};

function gettransid(){
    $.ajax({
        url        : url+"index.php/support/overview/gettransid",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $(":text[name='modal_new_eticket_transid']").val('');
        },
        success:function(data){
            if(data.responCode==="00"){
                var result        = data.responResult;
                $(":text[name='modal_new_eticket_transid']").val(result);
            }
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
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
};

$(document).on("submit", "#formneweticket", function (e) {
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
			$("#btn_new_eticket").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_eticket").modal("hide");
                dataeticket();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_eticket").removeClass("disabled");
            toastr.clear();
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