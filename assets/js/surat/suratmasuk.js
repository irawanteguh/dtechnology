$('#modal_suratmasuk_add_asalsurat').on('change', function () {
    const value = $(this).val();
    if (value === 'E') {
        $('#input_pengirim_wrapper').removeClass('d-none');
        $('#select_pengirim_wrapper').addClass('d-none');
        $('#modal_suratmasuk_add_pengirimsurat_txt').prop('required', true);
        $('#modal_suratmasuk_add_pengirimsurat_id').prop('required', false);
    } else if (value === 'I') {
        $('#input_pengirim_wrapper').addClass('d-none');
        $('#select_pengirim_wrapper').removeClass('d-none');
        $('#modal_suratmasuk_add_pengirimsurat_txt').prop('required', false);
        $('#modal_suratmasuk_add_pengirimsurat_id').prop('required', true);
    } else {
        // default: sembunyikan keduanya
        $('#input_pengirim_wrapper').addClass('d-none');
        $('#select_pengirim_wrapper').addClass('d-none');
        $('#modal_suratmasuk_add_pengirimsurat_txt').prop('required', false);
        $('#modal_suratmasuk_add_pengirimsurat_id').prop('required', false);
    }
});

$('#modal_suratmasuk_add_asalsurat').trigger('change');

$('#modal_suratmasuk_add').on('shown.bs.modal', function () {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
});

flatpickr('[name="modal_suratmasuk_add_tglmasuk"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_suratmasuk_add_tglsurat"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

$(document).on("submit", "#forminsertsuratmasuk", function (e) {
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
            $("#modal_suratmasuk_add_btn").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                suratmasuk();
                $('#modal_suratmasuk_add').modal('hide');
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            $("#modal_suratmasuk_add_btn").removeClass("disabled");
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
});

suratmasuk();

function suratmasuk(){
    $.ajax({
        url       : url + "index.php/surat/suratmasuk/suratmasuk",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatasuratmasuk").html("");
        },
        success: function(data) {
            let tableresult = "";

            if (data.responCode === "00") {
                let result = data.responResult;

                // ? Set jumlah notifikasi
                $("#jumlahnotification").html(result.length);

                for (let i in result) {
                    var getvariabel = " datatransid='" + result[i].trans_id + "'";

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>";
                    tableresult += "<table class='table'>";
                    tableresult += "<tbody class='text-gray-600 fw-bold'>";
                    tableresult += `<tr><td style='width: 40%;'>Asal Surat</td><td style='width: 5%;'>:</td><td style='width: 55%;'><span class="badge ${result[i].asal_surat === 'I' ? 'badge-light-primary">Surat Internal' : result[i].asal_surat === 'E' ? 'badge-light-success">Surat External' : 'badge-light-secondary">Tidak Diketahui'}</span></td></tr>`;
                    tableresult += "<tr><td>No Urut</td><td>:</td><td>" + result[i].no_urut + "</td></tr>";
                    tableresult += "<tr><td>No Agenda</td><td>:</td><td>" + result[i].no_agenda + "</td></tr>";
                    tableresult += "<tr><td>Kode Surat</td><td>:</td><td>" + result[i].kode_surat + "</td></tr>";
                    tableresult += "<tr><td>Tanggal Masuk</td><td>:</td><td>" + result[i].tglmasuksurat + "</td></tr>";
                    tableresult += "</tbody></table></td>";

                    tableresult += "<td><table class='table'><tbody class='text-gray-600 fw-bold'>";
                    tableresult += "<tr><td style='width: 40%;'>No Surat</td><td style='width: 5%;'>:</td><td style='width: 55%;'>" + result[i].nomor_surat + "</td></tr>";

                    if (result[i].namapengirimsurat === null) {
                        tableresult += "<tr><td>Instansi / Department</td><td>:</td><td>Staff</td></tr>";
                    } else {
                        tableresult += "<tr><td>Instansi / Department</td><td>:</td><td>" + result[i].pengirimsurat + "</td></tr>";
                    }

                    tableresult += "<tr><td>Pengirim Surat</td><td>:</td><td>" + (result[i].namapengirimsurat || result[i].pengirimsurat || "-") + "</td></tr>";
                    tableresult += "<tr><td>Tanggal Surat</td><td>:</td><td>" + result[i].tglsurat + "</td></tr>";
                    tableresult += "</tbody></table></td>";

                    tableresult += "<td>" + (result[i].perihal || "") + "</td>";
                    tableresult += "<td>" + (result[i].ringkasan || "") + "</td>";
                    tableresult += "<td><div>" + (result[i].dibuatoleh || "") + "<div>" + (result[i].tgldibuat || "") + "</div></td>";

                    tableresult += "<td class='text-end'><div class='btn-group' role='group'>";
                    tableresult += "<button id='btnGroupDropAction' type='button' class='btn btn-sm btn-light-primary dropdown-toggle' data-bs-toggle='dropdown'>Action</button>";
                    tableresult += "<ul class='dropdown-menu' aria-labelledby='btnGroupDropAction'>";
                    tableresult += "<li><a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='" + url + "assets/suratmasuk/" + result[i].trans_id + ".pdf' onclick='viewdocwithoutnote(this)'><i class='bi bi-eye text-primary'></i> View Lampiran</a></li>";
                    tableresult += "</ul>";
                    tableresult += "<button type='button' class='btn btn-sm btn-light btn-icon toggle' data-kt-table-widget-4='expand_row'>";
                    tableresult += "<i class='bi bi-chevron-double-up fs-4 m-0 toggle-off'></i>";
                    tableresult += "<i class='bi bi-chevron-double-down fs-4 m-0 toggle-on'></i>";
                    tableresult += "</button></div></td>";
                    tableresult += "</tr>";

                    // ? Tambahan Disposisi jika ada
                    if (result[i].disposisi != null) {
                        tableresult += "<tr class='d-none'>";
                        tableresult += "<td colspan='6'>";
                        tableresult += "<table class='table'>";
                        tableresult += "<thead>";
                        tableresult += "<tr class='fw-bolder text-white bg-info'><th class='rounded-top ps-4' colspan='6'>Penerima Disposisi Surat No : " + result[i].nomor_surat + "</th></tr>";
                        tableresult += "<tr class='fw-bolder text-white bg-info'>";
                        tableresult += "<th class='ps-4'>Status</th><th>Instansi / Department</th><th>Nama</th><th>Tanggal dan Jam</th><th>Waiting Time</th>";
                        tableresult += "</tr></thead><tbody class='text-gray-600 fw-bold'>";

                        let rincianArray = result[i].disposisi.split(";");

                        rincianArray.forEach(function(item, index) {
                            if (!item.trim()) return;

                            let parts = item.split("::");
                            let trans_id = parts[0] || '';
                            let response = parts[1] || '';
                            let disposisidatetime = parts[2] || '';
                            let responsedatetime = parts[3] || '';
                            let orgname = parts[4] || '';
                            let name = parts[5] || '';
                            const timerId = "sla_timer_" + i + "_" + index;

                            tableresult += "<tr>";
                            tableresult += "<td class='ps-4'><span class='badge " + 
                                (response === 'N' ? "badge-light-danger'>Waiting Read" : 
                                response === 'Y' ? "badge-light-success'>Read" : 
                                "badge-light-secondary'>" + response) + 
                                "</span></td>";
                            tableresult += "<td>" + orgname + "</td>";
                            tableresult += "<td>" + name + "</td>";
                            tableresult += "<td>" + disposisidatetime + "</td>";

                            if (response === "N") {
                                tableresult += "<td><span id='" + timerId + "'>" + setCountdownSLA(disposisidatetime, timerId, 24) + "</span></td>";
                            } else {
                                const startParts = disposisidatetime.split(" ");
                                const endParts = responsedatetime.split(" ");

                                const startDate = new Date(startParts[0].split(".").reverse().join("-") + "T" + startParts[1]);
                                const endDate = new Date(endParts[0].split(".").reverse().join("-") + "T" + endParts[1]);

                                const diffMs = endDate - startDate;
                                const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
                                const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                                const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);
                                const diffDisplay = diffMs > 0 ? `${diffHours} Jam : ${diffMinutes} Menit : ${diffSeconds} Detik` : "-";

                                tableresult += "<td><span class='badge badge-light-info'>" + diffDisplay + "</span></td>";
                            }

                            tableresult += "</tr>";
                        });

                        tableresult += "</tbody></table></td></tr>"; // ? Tutup semua elemen
                    }
                }
            }

            $("#resultdatasuratmasuk").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");

            // Ekspansi toggle baris disposisi
            document.querySelectorAll("[data-kt-table-widget-4='expand_row']").forEach(button => {
                button.addEventListener('click', function () {
                    const tr = this.closest('tr');
                    const nextTr = tr.nextElementSibling;
                    const isExpanded = !nextTr.classList.contains('d-none');

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