let startDate = null;
let endDate = null;

dataupload(startDate,endDate);

flatpickr('[name="dateperiode"]', {
    mode: "range", // Mengaktifkan mode range
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        // Mendapatkan tanggal sesuai dengan zona waktu lokal
        const formatDate = (date) => {
            if (!date) return null;
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`; // Format YYYY-MM-DD
        };

        startDate = selectedDates[0] ? formatDate(selectedDates[0]) : null;
        endDate = selectedDates[1] ? formatDate(selectedDates[1]) : null;
    }
});


$(document).on("click", ".btn-apply", function (e) {
    e.preventDefault();

    if (!startDate || !endDate) {
        toastr["warning"]("Please select a valid date range", "Warning");
        return;
    }

    dataupload(startDate, endDate);
});

$('#modal_upload_document').on('hidden.bs.modal', function (e) {
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }
    Dropzone.autoDiscover = false;
});

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

    // Menggunakan AJAX dengan metode GET untuk memeriksa apakah file ada
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


    // if (responsefile === 200) {
    //     var viewfile = "<embed src='" + filename + "' width='100%' height='100%' type='application/pdf' id='view'>";
    //     $("#viewdoc").html(viewfile);
        
    //     $('#openInNewTabButton').data('filename', filename);
    // } else {
    //     var viewfile = `
    //         <div class='alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
    //             <span class='svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0'>
    //                 <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
    //                     <path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
    //                     <path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
    //                 </svg>
    //             </span>
    //             <div class='d-flex flex-column pe-0 pe-sm-10'>
    //                 <h5 class='mb-1'>For Your Information</h5>
    //                 <span>File Tidak Di Temukan, Silakan Periksa Kembali</span>
    //             </div>
    //         </div>
    //     `;
    //     $("#viewdoc").html(viewfile);
    //     $('#openInNewTabButton').data('filename', '');
    // }
}

function dataupload(startDate,endDate){
    $.ajax({
        url       : url+"index.php/tilakaV2/repodocument/dataupload",
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

            // if(data.responCode==="00"){
            //     result = data.responResult;

            //     for(var i in result){

            //         if(result[i].status_sign==="5"){
            //             tablefinish +="<tr>";
            //             tablefinish +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>"+(result[i].descriptionstatus ? result[i].descriptionstatus : "")+"</div></td>";
                        
            //             if(result[i].status_sign==="0"){
            //                 if(result[i].source_file==="DTECHNOLOGY"){
            //                     if(result[i].status_sign==="0"){
            //                         tablefinish +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='"+result[i].no_file+"' onclick='uploadfile(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }else{
            //                         tablefinish +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }
            //                 }else{
            //                     tablefinish +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                 }
            //             }else{
            //                 if(result[i].source_file==="DTECHNOLOGY"){
            //                     tablefinish +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                 }else{
            //                     tablefinish +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                 }
            //             }
    
            //             tablefinish +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
            //             tablefinish +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";
            //             tablefinish +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+"</div></td>";
            //             tablefinish +="<td class='pe-4 text-end'><div>"+(result[i].createdby ? result[i].createdby : "By Integrated System")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
            //             tablefinish +="</tr>";
            //         }else{
            //             if(result[i].status_sign==="99"){
            //                 tablehold +="<tr>";
            //                 tablehold +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>"+(result[i].descriptionstatus ? result[i].descriptionstatus : "")+"</div></td>";
                            
            //                 if(result[i].status_sign==="0"){
            //                     if(result[i].source_file==="DTECHNOLOGY"){
            //                         if(result[i].status_sign==="0"){
            //                             tablehold +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='"+result[i].no_file+"' onclick='uploadfile(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                         }else{
            //                             tablehold +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                         }
            //                     }else{
            //                         tablehold +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }
            //                 }else{
            //                     if(result[i].source_file==="DTECHNOLOGY"){
            //                         tablehold +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }else{
            //                         tablehold +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }
            //                 }
        
            //                 tablehold +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
            //                 tablehold +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";
            //                 tablehold +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+"</div></td>";
            //                 tablehold +="<td class='pe-4 text-end'><div>"+(result[i].createdby ? result[i].createdby : "By Integrated System")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
            //                 tablehold +="</tr>";
            //             }else{
            //                 tableprocess +="<tr>";
            //                 if(result[i].status_file==="0"){
            //                     tableprocess +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>Please Upload File</div></td>";
            //                 }else{
            //                     tableprocess +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>"+(result[i].descriptionstatus ? result[i].descriptionstatus : "")+"</div></td>";
            //                 }
                            
                            
            //                 if(result[i].status_sign==="0"){
            //                     if(result[i].source_file==="DTECHNOLOGY"){
            //                         if(result[i].status_sign==="0"){
            //                             tableprocess +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='"+result[i].no_file+"' onclick='uploadfile(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                         }else{
            //                             tableprocess +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                         }
            //                     }else{
            //                         tableprocess +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }
            //                 }else{
            //                     if(result[i].source_file==="DTECHNOLOGY"){
            //                         tableprocess +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/document/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }else{
            //                         tableprocess +="<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+pathposttilaka+"/"+(result[i].no_file ? result[i].no_file : "")+".pdf' onclick='viewdoc(this)'>"+(result[i].no_file ? result[i].no_file : "-")+"</a></div><div>"+(result[i].filename ? result[i].filename : "-")+"</div></td>";
            //                     }
            //                 }
        
            //                 tableprocess +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
            //                 tableprocess +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";
            //                 tableprocess +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+"</div></td>";
            //                 tableprocess +="<td class='pe-4 text-end'><div>"+(result[i].createdby ? result[i].createdby : "By Integrated System")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
            //                 tableprocess +="</tr>";
            //             }
            //         }

            //         jml ++;
            //     }
            // }

            // $("#resultrepodocumentonprocess").html(tableprocess);
            // $("#resultrepodocumentfinish").html(tablefinish);
            // $("#resultrepodocumentonhold").html(tablehold);

            if (data.responCode === "00") {
                const result = data.responResult;
                let tableprocess = "", tablefinish = "", tablehold = "";

                // Fungsi bantu buat 1 row HTML
                const makeRow = (item) => {
                    const color     = item.colorstatus || "secondary";
                    const status    = item.status || "-";
                    const desc      = item.descriptionstatus || "";
                    const jenisDoc  = item.jenisdocument || "-";
                    const noFile    = item.no_file || "-";
                    const filename  = item.filename || "-";
                    const pasien    = item.pasien_idx || "-";
                    const trx       = item.transaksi_idx || "-";
                    const assign    = item.assignname || "";
                    const userId    = item.useridentifier || "<i class='bi bi-x-octagon text-danger'></i>";
                    const note      = item.note || "";
                    const createdby = item.createdby || "By Integrated System";
                    const tgljam    = item.tgljam || "";

                    let linkfile = "";
                    const filePath = item.source_file === "DTECHNOLOGY" 
                        ? `${url}assets/document/${noFile}.pdf`
                        : `${pathposttilaka}/${noFile}.pdf`;

                    // Tentukan link berdasarkan status_file & status_sign
                    if (item.status_sign === "0" && item.status_file === "0") {
                        linkfile = `<a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='${item.no_file}' onclick='uploadfile(this)'>${noFile}</a>`;
                    } else {
                        linkfile = `<a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='${filePath}' onclick='viewdoc(this)'>${noFile}</a>`;
                    }

                    const descText = item.status_file === "0" && item.status_sign !== "5" && item.status_sign !== "99"
                        ? "Please Upload File"
                        : desc;

                    return `
                        <tr>
                            <td class='ps-4'>
                                <div><span class='badge badge-light-${color} fs-7 fw-bold'>${status}</span></div>
                                <div class='fst-italic small'>${descText}</div>
                            </td>
                            <td>
                                <div>${jenisDoc}</div>
                                <div>${linkfile}</div>
                                <div>${filename}</div>
                            </td>
                            <td><div>${pasien}</div><div>${trx}</div></td>
                            <td><div>${assign}</div><div>${userId}</div></td>
                            <td><div class='badge badge-light-info'>${note}</div></td>
                            <td class='pe-4 text-end'><div>${createdby}</div><div>${tgljam}</div></td>
                        </tr>`;
                };

                // Loop utama
                result.forEach(item => {
                    switch (item.status_sign) {
                        case "5":  // selesai
                            tablefinish += makeRow(item);
                            break;
                        case "99": // hold
                            tablehold += makeRow(item);
                            break;
                        default:   // proses
                            tableprocess += makeRow(item);
                            break;
                    }

                    jml ++;
                });

                // Update DOM
                $("#resultrepodocumentonprocess").html(tableprocess);
                $("#resultrepodocumentfinish").html(tablefinish);
                $("#resultrepodocumentonhold").html(tablehold);
            }


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
            $("#btn_sign_document").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                dataupload();
                $('#modal_sign_add').modal('hide');
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            $("#btn_sign_document").removeClass("disabled");
        },
        error: function (xhr, status, error) {
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