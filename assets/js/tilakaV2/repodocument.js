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

            if(data.responCode === "00"){
                result = data.responResult;
                for(var i in result){
                    var rows         = "";
                    const filePath = result[i].source_file === "DTECHNOLOGY" ? `${url}assets/document/${result[i].no_file}.pdf` : `${pathposttilaka}${result[i].no_file}.pdf`;
                    let badges = '';

                    if (result[i].assignname) {
                        let names = result[i].assignname.split(';');
                        let ids   = result[i].useridentifier
                            ? result[i].useridentifier.split(';')
                            : [];

                        badges += `<div class="d-flex flex-column align-items-start gap-1">`;

                        names.forEach((name, idx) => {
                            let uid = ids[idx] ? ids[idx] : '';

                            badges += `
                                <div class="badge badge-light-primary text-start">
                                    ${name.trim()}
                                    <i class="bi bi-info-circle-fill text-primary ms-1"
                                    data-bs-toggle="tooltip"
                                    data-bs-html="true"
                                    data-bs-placement="top"
                                    data-bs-custom-class="tooltip-dark"
                                    title="
                                            <div class='text-start'>
                                                <div><small>User Identifier</small></div>
                                                <b>${uid}</b>
                                            </div>
                                    ">
                                    </i>
                                </div>
                            `;
                        });

                        badges += `</div>`;
                    }


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
                    // rows +="<td><div>"+(result[i].assignname ? result[i].assignname : "")+"</div><div>"+(result[i].useridentifier ? result[i].useridentifier : "<i class='bi bi-x-octagon text-danger'></i>")+"</div></td>";

                    // rows +="<td>"+"<div class='badge badge-light-primary'>"+(result[i].assignname ? result[i].assignname : "")+" <i class='bi bi-info-circle-fill text-primary' data-bs-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-html='true' data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='top' title='<div class=\"text-start\">User Identifier : <b>"+(result[i].useridentifier ? result[i].useridentifier : "")+"</b></div>'></i></div>"+"</td>";
                    rows += `<td>${badges}</td>`;
                    rows +="<td><div class='badge badge-light-info'>"+(result[i].note ? result[i].note : "")+(result[i].useridentifier ? "" : "User Belum Terdaftar Pengguna TTE / Sertifikat Belum Aktif")+"</div></td>";
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
            KTApp.initBootstrapTooltips();
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