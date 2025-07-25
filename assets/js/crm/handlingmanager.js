datahandling();

function viewdoc(btn) {
    var filename     = $(btn).attr("data-dirfile");
    var filename     = filename.replace('/www/wwwroot/', 'http://');
    var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

    if(responsefile === 200){
        var viewfile = "<embed src='"+filename+"' width='100%' height='100%' id='view'>";
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
};

function datahandling(){
    $.ajax({
        url       : url + "index.php/crm/handlingmanager/datahandling",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatahandling").html("");
        },
        success:function(data){
            let tableresult = "";

            if(data.responCode === "00"){
                let result = data.responResult;

                for (let i in result){
                    const getvariabel = " datatransid='" + result[i].trans_id + "'" +
                                        " datadepartmentid='" + result[i].department_id + "'" +
                                        " datanamapic='" + (result[i].namapic || "") + "'" +
                                        " datanohppic='" + result[i].nohppic + "'" +
                                        " datanamapasien='" + result[i].nama + "'" +
                                        " datacodelaporan='" + result[i].code + "'" +
                                        " datasaran='" + result[i].saran + "'" +
                                        " datajawaban='" + result[i].answer_instalasi + "'" +
                                        " dataorgname='" + result[i].nameorg + "'"+
                                        " datadeviceid='" + result[i].deviceid + "'" +
                                        " dataorgnamemarketing='" + result[i].namamarketing + "'"+
                                        " dataorghpmarketing='" + result[i].nohpmarketing + "'";

                    const timerId = "sla_timer_" + i;
                    const createdAt = result[i].tgldibuat;
                    const tglMarketing = result[i].tglmarketing;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].code + "</td>";
                    tableresult += "<td>" + result[i].nama + "</td>";
                    tableresult += "<td>" + result[i].no_identitas + "</td>";
                    tableresult += "<td>" + result[i].no_hp + "</td>";
                    tableresult += "<td><div><a href='#' data-bs-toggle='modal' data-bs-target='#modal_handling_update_department' " + getvariabel + ">" + result[i].department + "</a></div><div>" + (result[i].namapicunit || "") + "</div></td>";
                    tableresult += "<td>" + result[i].lantai + "</td>";
                    tableresult += "<td>" + result[i].nama_petugas + "</td>";
                    tableresult += "<td>" + result[i].saran + "</td>";
                    tableresult += "<td>" + (result[i].answer_instalasi || "") + "</td>";
                    tableresult += "<td><div class='badge badge-light-" + (result[i].statuscolor || "") + "'>" + (result[i].statusname || "") + "</div></td>";
                    if(result[i].status === "0"){
                        tableresult += "<td><div>" + createdAt + "</div><div><span class='badge fw-bold' id='" + timerId + "'>Loading...</span></div></td>";
                    } else if(result[i].status === "1"){
                        tableresult += "<td>" + result[i].tgldepartment + "</td>";
                    } else if(result[i].status === "2"){
                        tableresult += "<td>" + result[i].tglmanager + "</td>";
                    } else if(result[i].status === "3"){
                        tableresult += "<td><div>" + tglMarketing + "</div><div><span class='badge fw-bold' id='" + timerId + "'>Loading...</span></div></td>";
                    } else if(result[i].status === "4") {
                        const startParts = createdAt.split(" ");
                        const endParts   = result[i].tglpasien.split(" ");

                        const startDate = new Date(startParts[0].split(".").reverse().join("-") + "T" + startParts[1]);
                        const endDate   = new Date(endParts[0].split(".").reverse().join("-") + "T" + endParts[1]);

                        const diffMs = endDate - startDate;
                        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
                        const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                        const diffSeconds = Math.floor((diffMs % (1000 * 60)) / 1000);

                        const diffDisplay = diffMs > 0 ? `${diffHours} Jam : ${diffMinutes} Menit : ${diffSeconds} Detik` : "-";
                        tableresult += "<td><div>" + result[i].tglpasien + "</div><div><span class='badge badge-light-info fw-bold'>" + diffDisplay + "</span></div></td>";
                    }
                    

                    // Kolom Action
                    tableresult += "<td class='text-end'>";
                    tableresult += "<div class='btn-group' role='group'>";
                    tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                    tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";

                    if(result[i].status === "2"){
                        tableresult += "<a class='dropdown-item btn btn-sm text-danger' " + getvariabel + " datastatus='1' onclick='updatestatus($(this));'><i class='bi bi-check2-circle text-danger'></i> Decline Manager</a>";
                        tableresult += "<a class='dropdown-item btn btn-sm text-success' " + getvariabel + " datastatus='3' onclick='updatestatus($(this));'><i class='bi bi-check2-circle text-success'></i> Approved Manager</a>";
                    }

                    if(result[i].attachment === "1"){
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' " + getvariabel + " data-dirfile='" + url + "assets/crm/" + result[i].filename + "' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Bukti</a>";
                    }

                    if(result[i].bukti_tl === "1"){
                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' " + getvariabel + " data-dirfile='" + url + "assets/buktitl/" + result[i].filename + "' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Bukti Tindaklanjut</a>";
                    }

                    tableresult += "</div></div></td>";
                    tableresult += "</tr>";

                    // Jalankan Countdown Timer SLA
                    setCountdownSLA(result[i].tglmanager, timerId);
                }
            }

            $("#resultdatahandling").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
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

function setCountdownSLA(createdAtString, elementId) {
    const SLA_HOURS = 24;

    // Ubah format "15.07.2025 11:25:00" menjadi "2025-07-15T11:25:00"
    const parts = createdAtString.split(" ");
    const dateParts = parts[0].split(".");
    const timePart = parts[1];
    const isoDateString = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}T${timePart}`;

    const createdAt = new Date(isoDateString);
    const deadline = new Date(createdAt.getTime() + SLA_HOURS * 60 * 60 * 1000);

    const interval = setInterval(() => {
        const now = new Date();
        const diff = deadline - now;

        const el = document.getElementById(elementId);
        if (!el) {
            clearInterval(interval);
            return;
        }

        if (diff <= 0) {
            el.innerHTML = "Melewati SLA";
            el.className = "badge badge-light-danger fw-bold";
            clearInterval(interval);
        } else {
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            el.innerHTML = `${hours.toString().padStart(2, '0')} Jam : ${minutes.toString().padStart(2, '0')} Menit : ${seconds.toString().padStart(2, '0')} Detik`;
            el.className = "badge badge-light-success fw-bold";
        }
    }, 1000);
}

function updatestatus(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var datatransid          = btn.attr("datatransid");
            var datanamapic          = btn.attr("datanamapic");
            var datanohppic          = btn.attr("datanohppic");
            var datanamapasien       = btn.attr("datanamapasien");
            var datacodelaporan      = btn.attr("datacodelaporan");
            var datasaran            = btn.attr("datasaran");
            var datastatus           = btn.attr("datastatus");
            var datadeviceid         = btn.attr("datadeviceid");
            var datajawaban          = btn.attr("datajawaban");
            var dataorgname          = btn.attr("dataorgname");
            var dataorgnamemarketing = btn.attr("dataorgnamemarketing");
            var dataorghpmarketing   = btn.attr("dataorghpmarketing");

            $.ajax({
                url       : url+"index.php/crm/handlingmanager/updatesaran",
                data      : {
                                datatransid         : datatransid,
                                datastatus          : datastatus,
                                datanamapic         : datanamapic,
                                datanohppic         : datanohppic,
                                datanamapasien      : datanamapasien,
                                datacodelaporan     : datacodelaporan,
                                datasaran           : datasaran,
                                datajawaban         : datajawaban,
                                dataorgname         : dataorgname,
                                datadeviceid        : datadeviceid,
                                dataorgnamemarketing: dataorgnamemarketing,
                                dataorghpmarketing  : dataorghpmarketing
                            },
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    toastr.clear();
                    toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    toastr.clear();
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    datahandling();
                },
                error: function (xhr, status, error) {
                    showAlert(
                        "I'm Sorry",
                        error,
                        "error",
                        "Please Try Again",
                        "btn btn-danger"
                    );
                }
            });
        }
    });
    return false;
};