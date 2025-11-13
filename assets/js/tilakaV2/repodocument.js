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
            $("#resultrepodocumentfinish").html("");
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

            // // if (data.responCode === "00") {
            // //     const result = data.responResult;
            // //     let tableprocess = "", tablefinish = "", tablehold = "";

            // //     // Fungsi bantu buat 1 row HTML
            // //     const makeRow = (item) => {
            // //         const color     = item.colorstatus || "secondary";
            // //         const status    = item.status || "-";
            // //         const desc      = item.descriptionstatus || "";
            // //         const jenisDoc  = item.jenisdocument || "-";
            // //         const noFile    = item.no_file || "-";
            // //         const filename  = item.filename || "-";
            // //         const pasien    = item.pasien_idx || "-";
            // //         const trx       = item.transaksi_idx || "-";
            // //         const assign    = item.assignname || "";
            // //         const userId    = item.useridentifier || "<i class='bi bi-x-octagon text-danger'></i>";
            // //         const note      = item.note || "";
            // //         const createdby = item.createdby || "By Integrated System";
            // //         const tgljam    = item.tgljam || "";

            // //         let linkfile = "";
            // //         const filePath = item.source_file === "DTECHNOLOGY" ? `${url}assets/document/${noFile}.pdf` : `${url}/${pathposttilaka}/${noFile}.pdf`;

            // //         // Tentukan link berdasarkan status_file & status_sign
            // //         if (item.status_sign === "0" && item.status_file === "0") {
            // //             linkfile = `<a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='${item.no_file}' onclick='uploadfile(this)'>${noFile}</a>`;
            // //         } else {
            // //             linkfile = `<a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='${filePath}' onclick='viewdocwithoutnote(this)'>${noFile}</a>`;
            // //         }

            // //         const descText = item.status_file === "0" && item.status_sign !== "5" && item.status_sign !== "99" ? "Please Upload File" : desc;

            // //         return `
            // //             <tr>
            // //                 <td class='ps-4'>
            // //                     <div><span class='badge badge-light-${color} fs-7 fw-bold'>${status}</span></div>
            // //                     <div class='fst-italic small'>${descText}</div>
            // //                 </td>
            // //                 <td>
            // //                     <div>${jenisDoc}</div>
            // //                     <div>${linkfile}</div>
            // //                     <div>${filename}</div>
            // //                 </td>
            // //                 <td><div>${pasien}</div><div>${trx}</div></td>
            // //                 <td><div>${assign}</div><div>${userId}</div></td>
            // //                 <td><div class='badge badge-light-info'>${note}</div></td>
            // //                 <td class='pe-4 text-end'><div>${createdby}</div><div>${tgljam}</div></td>
            // //             </tr>`;
            // //     };

            // //     // Loop utama
            // //     result.forEach(item => {
            // //         switch (item.status_sign) {
            // //             case "5":
            // //                 tablefinish += makeRow(item);
            // //                 break;
            // //             case "99": // hold
            // //                 tablehold += makeRow(item);
            // //                 break;
            // //             default:   // proses
            // //                 tableprocess += makeRow(item);
            // //                 break;
            // //         }

            // //         jml ++;
            // //     });

            // //     // Update DOM
            // //     $("#resultrepodocumentonprocess").html(tableprocess);
            // //     $("#resultrepodocumentfinish").html(tablefinish);
            // //     $("#resultrepodocumentonhold").html(tablehold);
            // // }


            // // $("#info_list_document").html(jml+" Document");


            if(data.responCode === "00"){
                result = data.responResult;
                for(var i in result){
                    var rows         = "";
                    const filePath = result[i].source_file === "DTECHNOLOGY" ? `${url}assets/document/${result[i].no_file}.pdf` : `${url}assets/document/${result[i].no_file}.pdf`;

                    rows +="<tr>";
                    if(result[i].status_file==="0"){
                        rows +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>Please Upload File</div></td>";
                    }else{
                        rows +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>"+(result[i].descriptionstatus ? result[i].descriptionstatus : "")+"</div></td>";
                    }

                    if (result[i].status_sign === "0" && result[i].status_file === "0") {
                        rows += "<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_upload_document' data_dirfile='"+result[i].no_file+"' onclick='uploadfile(this)'>"+result[i].no_file+"</a></div></td>";
                    } else {
                        rows += "<td><div>"+(result[i].jenisdocument ? result[i].jenisdocument : "-")+"</div><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+filePath+"' onclick='viewdocwithoutnote(this)'>"+result[i].no_file+"</a></div></td>";
                    }
                    
                    rows +="<td><div>"+(result[i].pasien_idx ? result[i].pasien_idx : "-")+"</div><div>"+(result[i].transaksi_idx ? result[i].transaksi_idx : "-")+"</div></td>";
                    rows +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";
                    rows +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+"</div></td>";
                    rows +="<td class='pe-4 text-end'><div>"+(result[i].createdby ? result[i].createdby : "By Integrated System")+"</div><div>"+(result[i].tgljam ? result[i].tgljam : "")+"</div></td>";
                    rows +="</tr>";

                    

                    switch (result[i].status_sign) {
                        case "0":
                        case "1":
                        case "2":
                        case "3":
                        case "4":
                            tableprocess += rows;
                            break;
                        case "5":
                            tablefinish += rows;
                            break;
                        case "99":
                            tablehold += rows;
                            break;
                    }
                }
            }

            


            $("#resultrepodocumentonprocess").html(tableprocess);
            $("#resultrepodocumentfinish").html(tablefinish);
            $("#resultrepodocumentonhold").html(tablehold);

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