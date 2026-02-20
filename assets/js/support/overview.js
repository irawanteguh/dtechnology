dataeticket();

$('#modal_new_eticket').on('show.bs.modal', function (e) {
    $(":text[name='modal_new_eticket_transid']").val('');
    $(":text[name='modal_new_eticket_subject']").val('');
    $("textarea[name='modal_new_eticket_description']").val('');

    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;

    gettransid();    
});

function viewdoc(btn) {
    var filename = $(btn).attr("data-dirfile");
        filename = filename.replace('/www/wwwroot/', 'http://');

    jQuery.ajax({
        url: filename,
        type: 'GET',
        async: false,
        success: function(data, textStatus, jqXHR) {
            var viewfile = "<embed src='"+filename+"' width='100%' height='100%' type='application/pdf' id='view'>";
            
            $("#viewdoc").html(viewfile);
            $('#openInNewTabButton').data('filename', filename);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var viewfile = `
                <div class='alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
                    <span class='svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                            <path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
                            <path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
                        </svg>
                    </span>
                    <div class='d-flex flex-column pe-0 pe-sm-10'>
                        <h5 class='mb-1'>For Your Information</h5>
                        <span>File Tidak Di Temukan, Silakan Periksa Kembali</span>
                    </div>
                </div>
            `;
            $("#viewdoc").html(viewfile);
            $('#openInNewTabButton').data('filename', '');
        }
    });
};

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
                                tableresult +="<a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' class='text-dark text-hover-primary fs-4 me-3 fw-bold' data-dirfile='"+url+"assets/documentsupport/"+(result[i].trans_id ? result[i].trans_id : "")+".pdf' onclick='viewdoc(this)'>"+result[i].subject+"</a>";
                                if(result[i].severity_id==="0"){
                                    tableresult +="<span class='badge badge-light-success my-1'>Low</span>";
                                }
                                if(result[i].attachment==="1"){
                                    tableresult += "<a class='badge badge-light-info my-1' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='" + url + "assets/documentsupport/" + (result[i].trans_id ? result[i].trans_id : "") + ".pdf' onclick='viewdoc(this)'>View Attachment</a>";
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

                var myDropzone = new Dropzone("#file_doc", {
                    url               : url + "index.php/support/overview/uploaddocument?transid="+result,
                    acceptedFiles     : '.pdf',
                    paramName         : "file",
                    dictDefaultMessage: "Drop files here or click to upload",
                    maxFiles          : 1,
                    maxFilesize       : 2,
                    addRemoveLinks    : true,
                    autoProcessQueue  : true,
                    accept            : function(file, done) {
                        done();
                    }
                });
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