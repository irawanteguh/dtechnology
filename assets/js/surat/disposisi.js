suratmasuk();

$('#modal_disposisi_add').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button      = $(event.relatedTarget);
    var datatransid = button.attr("datatransid");

    $("#modal_disposisi_add_suratid").val(datatransid);
    // $('textarea[data-kt-element="input"]').focus();
    chat(datatransid);

    $.ajax({
		url    : url + "index.php/surat/disposisi/lembardisposisi",
		data   : {datatransid:datatransid},
		method : "POST",
		cache  : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#modal_disposisi_lembardisposisi").html("");
        },
		success: function (data) {
            $("#modal_disposisi_lembardisposisi").html(data);
		}
	});
});

function suratmasuk(){
    $.ajax({
        url       : url + "index.php/surat/disposisi/suratmasuk",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatasuratmasuk").html("");
        },
        success:function(data){
            let tableresult = "";

            if(data.responCode === "00"){
                let result = data.responResult;

                for (let i in result){
                    var getvariabel =  " datatransid='" + result[i].trans_id + "'";

                    tableresult += "<tr>";

                    tableresult += "<td class='ps-4'>";
                        tableresult += "<table class='table'>";
                            tableresult += "<tbody class='text-gray-600 fw-bold'>";
                                tableresult += `<tr><td style='width: 40%;'>Asal Surat</td><td style='width: 5%;'>:</td><td style='width: 55%;'><span class="badge ${result[i].asal_surat === 'I' ? 'badge-light-primary">Surat Internal' : result[i].asal_surat === 'E' ? 'badge-light-success">Surat External' : 'badge-light-secondary">Tidak Diketahui'}</span></td></tr>`;
                                tableresult +="<tr><td>No Urut</td><td>:</td><td>"+result[i].no_urut+"</td></tr>";
                                tableresult +="<tr><td>No Agenda</td><td>:</td><td>"+result[i].no_agenda+"</td></tr>";
                                tableresult +="<tr><td>Kode Surat</td><td>:</td><td>"+result[i].kode_surat+"</td></tr>";
                                tableresult +="<tr><td>Tanggal Masuk</td><td>:</td><td>"+result[i].tglmasuksurat+"</td></tr>";
                            tableresult += "</tbody>";
                        tableresult += "</table>";
                    tableresult +=  "</td>";

                    tableresult += "<td>";
                        tableresult += "<table class='table'>";
                            tableresult += "<tbody class='text-gray-600 fw-bold'>";
                                tableresult +="<tr><td style='width: 40%;'>No Surat</td><td style='width: 5%;'>:</td><td style='width: 55%;'>"+result[i].nomor_surat+"</td></tr>";
                                if(result[i].namapengirimsurat===null){
                                    tableresult +="<tr><td>Instansi / Department</td><td>:</td><td>Staff</td></tr>";
                                }else{
                                    tableresult +="<tr><td>Instansi / Department</td><td>:</td><td>"+result[i].pengirimsurat+"</td></tr>";
                                }

                                
                                if(result[i].namapengirimsurat===null){
                                    tableresult +="<tr><td>Pengirim Surat</td><td>:</td><td>"+(result[i].pengirimsurat || "-")+"</td></tr>";
                                }else{
                                    tableresult +="<tr><td>Pengirim Surat</td><td>:</td><td>"+(result[i].namapengirimsurat || "-")+"</td></tr>";
                                }
                                
                                tableresult +="<tr><td>Tanggal Surat</td><td>:</td><td>"+result[i].tglsurat+"</td></tr>";
                            tableresult += "</tbody>";
                        tableresult += "</table>";
                    tableresult +=  "</td>";

                    tableresult +="<td>"+(result[i].perihal || "")+"</td>";
                    tableresult +="<td>"+(result[i].ringkasan || "")+"</td>";

                    tableresult += "<td><div>" + (result[i].dibuatoleh || "") + "<div>" + (result[i].tgldibuat || "" ) + "</div></td>";
                        tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<div class='btn-group' role='group'>";
                                tableresult += "<button id='btnGroupDropAction' type='button' class='btn btn-sm btn-light-primary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<ul class='dropdown-menu' aria-labelledby='btnGroupDropAction'>";
                                    tableresult += "<li><a class='dropdown-item btn btn-sm text-info' href='#' data-bs-toggle='modal' data-bs-target='#modal_disposisi_add' "+getvariabel+" data-dirfile='"+url+"assets/suratmasuk/"+result[i].trans_id+".pdf' onclick='viewdocdisposisiwithoutnote(this)'><i class='bi bi-send-check text-info'></i> Disposisi</a></li>";
                                    tableresult += "<li><a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/suratmasuk/"+result[i].trans_id+".pdf' onclick='viewdocwithoutnote(this)'><i class='bi bi-eye text-primary'></i> View Lampiran</a></li>";
                                tableresult += "</ul>";
                            tableresult += "</div>";
                            tableresult += "<button type='button' class='btn btn-sm btn-light btn-icon toggle' data-kt-table-widget-4='expand_row'>";
                                tableresult += "<i class='bi bi-chevron-double-up fs-4 m-0 toggle-off'></i>";
                                tableresult += "<i class='bi bi-chevron-double-down fs-4 m-0 toggle-on'></i>";
                            tableresult += "</button>";
                        tableresult += "</div>";
                    tableresult += "</td>";
                    tableresult += "</tr>";

                    if(result[i].disposisi != null){
                        tableresult +="<tr class='d-none'>";
                        tableresult +="<td colspan='6'>";
                        tableresult +="<table class='table'>";
                        tableresult +="<thead>";
                        tableresult +="<tr class='fw-bolder text-white bg-info'><th class='rounded-top ps-4' colspan='6'>Penerima Disposisi Surat No : "+result[i].nomor_surat+"</th></tr>";
                        tableresult +="<tr class='fw-bolder text-white bg-info'>";
                            tableresult +="<th class='ps-4'>Status</th>";
                            tableresult +="<th>Instansi / Department</th>";
                            tableresult +="<th>Nama</th>";
                            tableresult +="<th>Tanggal dan Jam</th>";
                            tableresult +="<th>Waiting Time</th>";
                        tableresult += "</tr></thead><tbody class='text-gray-600 fw-bold'>";
                        
                        let rincianArray = result[i].disposisi.split(";");

                        rincianArray.forEach(function(item, index) {
                            if (!item.trim()) return;  // skip jika kosong
                            
                            let parts = item.split("::");

                            let trans_id          = parts[0] || '';
                            let response          = parts[1] || '';
                            let disposisidatetime = parts[2] || '';
                            let responsedatetime  = parts[3] || '';
                            let orgname           = parts[4] || '';
                            let name              = parts[5] || '';

                            const timerId = "sla_timer_" + i + "_" + index;  // supaya unik

                            tableresult += "<tr>";
                            tableresult += "<td class='ps-4'><span class='badge " + 
                                (response === 'N' ? "badge-light-danger'>Waiting Read" : 
                                response === 'Y' ? "badge-light-success'>Read" : 
                                "badge-light-secondary'>" + response) + 
                                "</span></td>";
                            tableresult += "<td>" + orgname + "</td>";
                            tableresult += "<td>" + name + "</td>";
                            tableresult += "<td>" + disposisidatetime + "</td>";
                            if(response==="N"){
                                tableresult += "<td><span id='" + timerId + "'>" + setCountdownSLA(disposisidatetime, timerId, 24) + "</span></td>";
                            }else{
                                const startParts = disposisidatetime.split(" ");
                                const endParts   = responsedatetime.split(" ");

                                const startDate = new Date(startParts[0].split(".").reverse().join("-") + "T" + startParts[1]);
                                const endDate   = new Date(endParts[0].split(".").reverse().join("-") + "T" + endParts[1]);

                                const diffMs      = endDate - startDate;
                                const diffHours   = Math.floor(diffMs / (1000 * 60 * 60));
                                const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                                const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);

                                const diffDisplay = diffMs > 0 ? `${diffHours} Jam : ${diffMinutes} Menit : ${diffSeconds} Detik` : "-";
                                tableresult += "<td><span class='badge badge-light-info'>" + diffDisplay+ "</span></td>";
                            }
                            
                            tableresult += "</tr>";
                        });

                        tableresult += "</tbody></table></td></tr>";

                    }
                }
            }

            $("#resultdatasuratmasuk").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");

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
                            this.classList.remove('active');
                        } else {
                            nextTr.classList.remove('d-none');
                            tr.setAttribute('aria-expanded', 'true');
                            nextTr.setAttribute('data-kt-table-widget-4', 'subtable_template');
                            this.classList.add('active');
                        }
                    }
                });
            });
        },
        complete: function () {
            toastr.clear();
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
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
}

function chat(refid) {
    $.ajax({
        url: url + "index.php/surat/disposisi/chat",
        data: { refid: refid },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            $("#chatfollowup").html("");
        },
        success: function (data) {
            var tableresult = "";
            var lastName = "";

            if (data.responCode === "00") {
                var result = data.responResult;
                for (var i in result) {
                    var chatType   = result[i].type === "in" ? "info" : "primary";
                    var isSameUser = lastName       === result[i].name;
                        lastName   = result[i].name;

                    tableresult += `<div class='d-flex justify-content-${result[i].type === "in" ? "start" : "end"}'>`;
                    tableresult += `<div class='d-flex flex-column align-items-${result[i].type === "in" ? "start" : "end"}'>`;

                    if (!isSameUser) {
                        tableresult += `<div class='d-flex align-items-center mb-2'>`;
                        if (result[i].type === "out") {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='d-flex flex-column me-3 text-end'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        } else {
                            tableresult += `<div class='d-flex align-items-center'>`;
                            tableresult += `<div class='symbol symbol-circle symbol-35px overflow-hidden me-3'>`;
                            tableresult += `<div class='symbol-label fs-3 bg-light-${chatType} text-${chatType}'>${result[i].initial}</div>`;
                            tableresult += `</div>`;
                            tableresult += `<div class='d-flex flex-column'>`;
                            tableresult += `<a href='#' class='fs-5 fw-bolder text-gray-900 text-hover-primary'>${result[i].name}</a>`;
                            tableresult += `</div>`;
                            tableresult += `</div>`;
                        }
                        tableresult += `</div>`;
                    }

                    tableresult += `<div class='p-5 rounded bg-light-${chatType} text-dark fw-bold mw-lg-400px text-${result[i].type === "in" ? "start" : "end"} mb-3' data-kt-element='message-text'>`;
                    tableresult += `${result[i].chat}`;
                    tableresult += `<div class='text-muted small mt-2'>${result[i].jambuat}</div>`;
                    tableresult += `</div>`;
                    
                    tableresult += `</div>`;
                    tableresult += `</div>`;
                }
            }

            $("#chatfollowup").html(tableresult);
        },
        complete: function () {
            //
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
};

$(document).on('change', '.form-check-input', function() {
    let isChecked    = $(this).is(':checked');
    let departmentId = $(this).attr('data-departmentid');
    let orgId        = $(this).attr('data-orgid');
    let userId       = $(this).attr('data-userid');
    let suratId      = $(this).attr('data-suratid');

    if (isChecked) {
        $.ajax({
            url     : url + "index.php/surat/disposisi/disposisisurat_insert",
            method  : "POST",
            dataType: "JSON",
            cache   : false,
            data    : {department_id: departmentId,org_id: orgId,user_id: userId,surat_id: suratId},
            success : function(data) {
                $.ajax({
                    url    : url + "index.php/surat/disposisi/lembardisposisi",
                    data   : {datatransid:suratId},
                    method : "POST",
                    cache  : false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                        $("#modal_disposisi_lembardisposisi").html("");
                    },
                    success: function (data) {
                        $("#modal_disposisi_lembardisposisi").html(data);
                    }
                });
                
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Gagal mengirim disposisi.');
            }
        });
    } else {
        // Jika uncheck dan perlu delete:
        $.ajax({
            url     : url + "index.php/surat/disposisi/disposisisurat_delete",
            method  : "POST",
            dataType: "JSON",
            cache   : false,
            data    : {department_id:departmentId,surat_id:suratId,user_id:userId},
            success: function(data) {
                $.ajax({
                    url    : url + "index.php/surat/disposisi/lembardisposisi",
                    data   : {datatransid:suratId},
                    method : "POST",
                    cache  : false,
                    beforeSend: function () {
                        toastr.clear();
                        toastr["info"]("Sending request...", "Please wait");
                        $("#modal_disposisi_lembardisposisi").html("");
                    },
                    success: function (data) {
                        $("#modal_disposisi_lembardisposisi").html(data);
                    }
                });
                
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function(xhr, status, error) {
                console.error('Error saat delete:', error);
            }
        });
    }
});

$(document).on("click", "[data-kt-element='send']", function () {
    var refid   = $("#modal_disposisi_add_suratid").val();
    var message = $("textarea[data-kt-element='input']").val();

    if (message.trim() === "") {
        Swal.fire({
            title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
            html             : "<b>Pesan tidak boleh kosong</b>",
            icon             : "error",
            confirmButtonText: "Please Try Again",
            buttonsStyling   : false,
            timerProgressBar : true,
            timer            : 5000,
            customClass      : {confirmButton: "btn btn-danger"},
            showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
            hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
        });

        return;
    }

    $.ajax({
        url     : url + "index.php/surat/disposisi/sendchat",
        method  : "POST",
        data    : {chat:message,refid:refid},
        dataType: "JSON",
        success : function (data) {
            if(data.responCode === "00"){
                $("textarea[data-kt-element='input']").val("");
                $('textarea[data-kt-element="input"]').focus();
                chat(refid);
            }else{
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html             : "<b>Gagal mengirim pesan!</b>",
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
        }
    });
});