let today     = new Date();
let startDate = today.toISOString().split('T')[0];
let endDate   = today.toISOString().split('T')[0];

dataupload(startDate,endDate);

$('#modal_upload_document').on('hidden.bs.modal', function (e) {
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;
});

function uploadfile(btn){
	var nofile  = $(btn).attr("data_dirfile");
    var myDropzone = new Dropzone("#file_doc", {
        url             : url + "index.php/bsre/repodocument/uploadfile?nofile="+nofile,
        acceptedFiles   : '.PDF',
        paramName       : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles        : 1,
        maxFilesize     : 10,
        addRemoveLinks  : true,
        autoProcessQueue: true,
        accept: function(file, done) {
            done();
        }
    });

    myDropzone.on("success", function(file, response) {
        dataupload(); 
        $('#modal_upload_document').modal('hide');
    });
};

function viewdoc(btn) {
    var filename = $(btn).attr("data-dirfile");
        filename = filename.replace('/www/wwwroot/', 'http://');

    jQuery.ajax({
        url: filename,
        type: 'GET',
        async: false,
        success: function(data, textStatus, jqXHR) {
            var viewfile = "<embed src='" +filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
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

function signingdocument(btn){
    var noktp  = $(btn).attr("data-noktp");
    var nofile = $(btn).attr("data-nofile");
    var tag    = $(btn).attr("data-tag");
    $.ajax({
        url       : url+"index.php/bsre/repodocument/signingdocument",
        data      : {nofile:nofile,noktp:noktp,tag:tag},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            toastr.clear();
            var result = data.responResult;

            
        },
        complete: function () {
			dataupload();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

function dataupload(startDate,endDate){
    $.ajax({
        url       : url+"index.php/bsre/repodocument/dataupload",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultrepodocumentonprocess").html("");
            $("#resultrepodocumentonhold").html("");
            $("#info_list_document").html("");
        },
        success:function(data){
            var result       = "";
            var tableprocess = "";
            var tablehold    = "";
            var tablefinish  = "";
            var jml          = 0;

            if(data.responCode==="00"){
                result = data.responResult;

                for(var i in result){

                    getvariabel =   "data-noktp='"+result[i].assign+"'"+
                                    "data-nofile='"+result[i].no_file+"'"+
                                    "data-tag='"+result[i].filename+"'";

                    tableprocess +="<tr>";
                    tableprocess +="<td class='ps-4'><div><span class='badge badge-light-" + result[i].colorstatus + " fs-7 fw-bold'>" + result[i].status + "</span></div><div class='fst-italic small'>" + (result[i].status_file === "0" ? "Please Upload File" : (result[i].descriptionstatus ? result[i].descriptionstatus : "")) + "</div></td>";
                    tableprocess +="<td><div>" + (result[i].jenisdocument ? result[i].jenisdocument : "-") + "</div><div><a href='#' data-bs-toggle='modal' data-bs-target='" + (result[i].status_sign === "0" ? "#modal_upload_document' data_dirfile='" + result[i].no_file + "' onclick='uploadfile(this)" : "#modal_view_pdf' data-dirfile='" + url + "assets/document/" + (result[i].no_file ? result[i].no_file : "") + ".pdf' onclick='viewdoc(this)") + "'>" + (result[i].no_file ? result[i].no_file : "-") + "</a></div></td>";
                    tableprocess +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
                    tableprocess +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].assign ? result[i].assign : "")+"</div></td>";
                    tableprocess +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+"</div></td>";
                    tableprocess +="<td><div>"+(result[i].createdby ? result[i].createdby : "By Integrated System")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
                    tableprocess +="<td class='pe-4 text-end'><a class='btn btn-light-primary btn-sm' "+getvariabel+" onclick='signingdocument(this)'>Signing Visible</a></td>";
                    tableprocess +="</tr>";

                    jml ++;
                }
            }

            $("#resultrepodocumentonprocess").html(tableprocess);
            $("#resultrepodocumentfinish").html(tablefinish);
            $("#resultrepodocumentonhold").html(tablehold);
            $("#info_list_document").html(jml+" Document");

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
    });
    return false;
};

$(document).on("submit", "#formsigndocument", function (e) {
	e.preventDefault();
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
			$("#modal_sign_add_btn").addClass("disabled");
        },
		success: function (data) {
            if(data.responCode == "00"){
                dataupload(startDate,endDate);
                $('#modal_sign_add').modal('hide');
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete:function(){
            toastr.clear();
            $("#modal_sign_add_btn").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}		
	});
    return false;
});