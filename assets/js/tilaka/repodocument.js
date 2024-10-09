dataupload();

// setInterval(() => {
//     dataupload();
// }, 10000);

function uploadfile(btn){
	var nofile  = $(btn).attr("data_dirfile");

    var myDropzone = new Dropzone("#file_doc", {
        url             : url + "index.php/tilaka/repodocument/uploadfile?nofile="+nofile,
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
      
    var responsefile = jQuery.ajax({
        url: filename,
        type: 'HEAD',
        async: false
    }).status;

    if (responsefile === 200) {
        var viewfile = "<embed src='" + filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
        $("#viewdoc").html(viewfile);
        
        $('#openInNewTabButton').data('filename', filename);
    } else {
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
}

$('#openInNewTabButton').on('click', function() {
    var filename = $(this).data('filename');
    if (filename) {
        window.open(filename, '_blank');
    }
});

function dataupload(){
    $.ajax({
        url     : url+"index.php/tilaka/repodocument/dataupload",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            $("#resultrepodocument").html("");
            $("#info_list_document").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            var jml = 0;

            if(data.responCode==="00"){
                result = data.responResult;

                for(var i in result){
                    tableresult +="<tr>";

                    

                    if(result[i].STATUS_SIGN==="0"){
                        if(result[i].STATUS_FILE==="0"){
                            tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Waiting Upload File</span></td>";
                        }else{
                            tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Waiting Request Upload Tilaka Lite</span></td>";
                        }
                    }else{
                        if(result[i].STATUS_SIGN==="1"){
                            tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Waiting Request Sign</span></td>"; 
                        }else{
                            if(result[i].STATUS_SIGN==="2"){
                                tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Request Sign</span></td>"; 
                            }else{
                                if(result[i].STATUS_SIGN==="3"){
                                    tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Request Execute File</span></td>";
                                }else{
                                    if(result[i].STATUS_SIGN==="4"){
                                        tableresult +="<td class='ps-4'><span class='badge badge-light-info fs-7 fw-bold'>Request Download File</span></td>"; 
                                    }else{
                                        if(result[i].STATUS_SIGN==="5"){
                                            tableresult +="<td class='ps-4'><span class='badge badge-light-success fs-7 fw-bold'>Finish</span></td>"; 
                                        }else{
                                            tableresult +="<td class='ps-4'><span class='badge badge-light-danger fs-7 fw-bold'>Unknown</span></td>";
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if(result[i].STATUS_SIGN==="0"){
                        if(result[i].SOURCE_FILE==="DTECHNOLOGY"){
                            if(result[i].STATUS_FILE==="0"){
                                tableresult +="<td><div>"+(result[i].jenisdocumen ? result[i].jenisdocumen : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='"+result[i].NO_FILE+"' onclick='uploadfile(this)'>"+(result[i].NO_FILE ? result[i].NO_FILE : "-")+"</a></div><div>"+(result[i].FILENAME ? result[i].FILENAME : "-")+"</div></td>";
                            }else{
                                tableresult +="<td><div>"+(result[i].jenisdocumen ? result[i].jenisdocumen : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].NO_FILE ? result[i].NO_FILE : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].NO_FILE ? result[i].NO_FILE : "-")+"</a></div><div>"+(result[i].FILENAME ? result[i].FILENAME : "-")+"</div></td>";
                            }
                        }else{
                            tableresult +="<td><div>"+(result[i].jenisdocumen ? result[i].jenisdocumen : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].NO_FILE ? result[i].NO_FILE : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].NO_FILE ? result[i].NO_FILE : "-")+"</a></div><div>"+(result[i].FILENAME ? result[i].FILENAME : "-")+"</div></td>";
                        }
                    }else{
                        if(result[i].SOURCE_FILE==="DTECHNOLOGY"){
                            tableresult +="<td><div>"+(result[i].jenisdocumen ? result[i].jenisdocumen : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].NO_FILE ? result[i].NO_FILE : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].NO_FILE ? result[i].NO_FILE : "-")+"</a></div><div>"+(result[i].FILENAME ? result[i].FILENAME : "-")+"</div></td>";
                        }else{
                            tableresult +="<td><div>"+(result[i].jenisdocumen ? result[i].jenisdocumen : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].NO_FILE ? result[i].NO_FILE : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].NO_FILE ? result[i].NO_FILE : "-")+"</a></div><div>"+(result[i].FILENAME ? result[i].FILENAME : "-")+"</div></td>";
                        }
                    }
                    
                    tableresult +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
                    tableresult +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";
                    tableresult +="<td><div>"+(result[i].createdby ? result[i].createdby : "")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
                    tableresult += "<td class='pe-4 text-end'>";
                    tableresult += "<button type='button' class='btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px' data-kt-table-widget-4='expand_row'>";
                    tableresult += "<i class='bi bi-plus fs-4 m-0 toggle-off'></i>";
                    tableresult += "<i class='bi bi-dash fs-4 m-0 toggle-on'></i>";
                    tableresult += "</button>";
                    tableresult +="</tr>";

                    tableresult += "<tr class='d-none'>";
                    tableresult += "<td colspan='7'>";
                    tableresult += "<div class='row col-md-12'>";
                    tableresult += "<h6>Response</h6>";
                    tableresult += "<textarea data-kt-autosize='true' class='form-control form-control-solid' readonly>" + (result[i].NOTE ? result[i].NOTE : "") + "</textarea>";
                    tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                    jml ++;
                }
            }

            $("#resultrepodocument").html(tableresult);
            $("#info_list_document").html(jml+" Document");

            document.querySelectorAll("[data-kt-table-widget-4='expand_row']").forEach(button => {
                button.addEventListener('click', function() {
                    const tr = this.closest('tr');
                    const nextTr = tr.nextElementSibling;
            
                    // Check if the next row is expanded
                    const isExpanded = !nextTr.classList.contains('d-none');
            
                    // Close any previously expanded rows if it's not the same row that is clicked
                    if (!isExpanded) {
                        document.querySelectorAll("[data-kt-table-widget-4='subtable_template']").forEach(openRow => {
                            openRow.classList.add('d-none');
                            openRow.removeAttribute('data-kt-table-widget-4');
            
                            const openButton = openRow.previousElementSibling.querySelector("[data-kt-table-widget-4='expand_row']");
                            if (openButton) {
                                openButton.classList.remove('active');
                                openButton.closest('tr').setAttribute('aria-expanded', 'false');
                            }
                        });
                    }
            
                    // Toggle the clicked row
                    if (!isExpanded || (isExpanded && tr.getAttribute('aria-expanded') === 'true')) {
                        if (isExpanded) {
                            nextTr.classList.add('d-none');
                            tr.setAttribute('aria-expanded', 'false');
                            nextTr.removeAttribute('data-kt-table-widget-4');
                            this.classList.remove('active'); // Remove the active class from the button
                        } else {
                            nextTr.classList.remove('d-none');
                            tr.setAttribute('aria-expanded', 'true');
                            nextTr.setAttribute('data-kt-table-widget-4', 'subtable_template');
                            this.classList.add('active'); // Add the active class to the button
                        }
                    }
                });
            });

            toastr[data.responHead](data.responDesc, "INFORMATION");

        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
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
			$("#btn_sign_document").addClass("disabled");
        },
		success: function (data) {
            toastr.clear();

            if(data.responCode == "00"){
                dataupload();
                $('#modal_sign_add').modal('hide');
			}
			toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_sign_document").removeClass("disabled");
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