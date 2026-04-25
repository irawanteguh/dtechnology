alldocument();

function voiddocument(btn){
    var datatransaksiid = btn.attr("datatransaksiid");
	$.ajax({
        url        : url+"index.php/tte/repodocument/voiddocument",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				alldocument();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

function resend(btn){
    var datatransaksiid = btn.attr("datatransaksiid");
	$.ajax({
        url        : url+"index.php/tte/repodocument/resend",
        data       : {datatransaksiid:datatransaksiid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
				alldocument();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

function uploadtotilaka(btn){
    var datatransaksiid  = btn.attr("datatransaksiid");
    var datafilelocation = btn.attr("datafilelocation");
	$.ajax({
        url        : url+"index.php/tte/repodocument/uploadtotilaka",
        data       : {datatransaksiid:datatransaksiid,datafilelocation:datafilelocation},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			alldocument();
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

function requestsign(btn){
	$.ajax({
        url        : url+"index.php/tte/repodocument/requestsign",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			alldocument();
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

function alldocument(){
    $.ajax({
        url       : url+"index.php/tte/repodocument/alldocument",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultdatadocumentall").html("");
            $("#resultdatadocumentvoid").html("");
            $("#resultdatadocumentfailed").html("");
            $("#resultdatadocumentotp").html("");
        },
        success: function(data) {

            let tableAll    = "";
            let tableVoid   = "";
            let tableFailed = "";
            let tableOTP    = "";

            if (data.responCode === "00") {
                let result = data.responResult;

                let noAll    = 1;
                let noVoid   = 1;
                let noFailed = 1;
                let noOTP    = 1;

                let filePath = "";
                let seenRequestOTP = new Set(); // untuk tracking request_id status_sign=2

                for (let i in result) {
                    // skip duplikat untuk status_sign = 2
                    if (result[i].status_sign === "2") {
                        if (seenRequestOTP.has(result[i].request_id)) continue;
                        seenRequestOTP.add(result[i].request_id);
                    }

                    let getvariabel = " datatransaksiid='" + result[i].transaksi_id + "'" +
                                    " datafilelocation='" + filePath + "'";

                    let row = "";
                    row += "<tr>";
                    row += "<td class='ps-4 text-start'></td>"; // nomor nanti
                    row += "<td>";
                    row += "<div class='fw-bolder'>" + result[i].no_file + ".pdf ";
                    row += "<i class='bi bi-info-circle-fill' data-bs-toggle='tooltip' data-bs-html='true' ";
                    row += "data-bs-custom-class='tooltip' data-bs-trigger='hover' data-bs-placement='right' ";
                    row += "title='<div class=\"text-start\"><b>" + result[i].transaksi_id + "</b></div>'></i></div>";

                    if (result[i].jenis_doc) {
                        let jenisArray = result[i].jenis_doc.split(";");
                        for (let j = 0; j < jenisArray.length; j++) {
                            row += "<div class='badge badge-light-primary me-2 mb-1'>" + jenisArray[j].trim() + "</div>";
                        }
                        row += "<br>";
                    }

                    row += "<div class='badge badge-light-dark me-2'>" + (result[i].provider_sign || "Unknown Provider") + "</div>";
                    row += "<div class='badge badge-light-info me-2'>" + (result[i].type_of || "Unknown Type Of Service") + "</div>";
                    row += "<div class='badge badge-light-warning me-2'>" + (result[i].type_certificate || "Unknown Type Of Certificate") + "</div>";
                    row += `<div class='badge badge-light-success me-2'>${result[i].quick_sign == 0 ? '' : result[i].quick_sign == 1 ? "Reguler Sign" : result[i].quick_sign == 2 ? "Auto Sign" : "Undefined"}</div>`;
                    row += "<div class='badge badge-light-danger me-2'>" + (result[i].from_in || "Unknown Source") + "</div>";
                    row += "</td>";

                    row += "<td><div>" + (result[i].note_1 || "") + "</div><div>" + (result[i].note_2 || "") + "</div></td>";
                    row += "<td><div>" + (result[i].name || "") + "</div><div>" + (result[i].email || "") + "</div></td>";
                    row += "<td><div class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</div><div class='fst-italic'>" + (result[i].descriptionstatus || "") + "</div></td>";
                    row += "<td><div>" + (result[i].dibuatoleh || "") + "</div><div>" + result[i].tglbuat + "</div></td>";

                    // ===================================
                    // Tombol dropdown
                    // ===================================
                    row += "<td class='text-end'>";
                    row += "<div class='btn-group'>";
                    row += "<button type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown'>Action</button>";
                    row += "<div class='dropdown-menu'>";

                    // View Document
                    let fileBtn = "";
                    if (result[i].status_sign === "5") {
                        fileBtn = result[i].from_in === "Dtechnology" ? result[i].storage_out + result[i].transaksi_id + ".pdf" : result[i].storage_out + result[i].no_file + ".pdf";
                    } else {
                        fileBtn = result[i].from_in === "Dtechnology" ? result[i].storage_in + result[i].transaksi_id + ".pdf" : result[i].storage_in + result[i].no_file + ".pdf";
                    }
                    row += `<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='${fileBtn}' onclick='viewdocwithoutnote(this)'>
                                <i class='bi bi-file-earmark-pdf text-primary'></i> View Document</a>`;

                    // Void
                    if (result[i].status_sign === "0") {
                        row += `<a class='dropdown-item btn btn-sm text-danger' ${getvariabel} onclick='voiddocument($(this));'>
                                    <i class='bi bi-trash3 text-danger'></i> Void</a>`;
                    }

                    // Request OTP
                    if (result[i].status_sign === "2") {
                        row += `<a class='dropdown-item btn btn-sm text-info' href='${result[i].url}&redirect_url=${url}index.php/tte/repodocument'>
                                    <i class='bi bi-fingerprint text-info'></i> Request OTP</a>`;
                    }

                    // Resend
                    if (result[i].status_sign === "80" || result[i].status_sign === "99") {
                        row += `<a class='dropdown-item btn btn-sm text-info' ${getvariabel} onclick='resend($(this));'>
                                    <i class='bi bi-arrow-counterclockwise text-info'></i> Resend</a>`;
                    }

                    row += "</div></div></td>";
                    row += "</tr>";

                    // ============================
                    // PEMISAHAN STATUS
                    // ============================
                    if (result[i].status_sign === "2") {
                        tableOTP += row.replace("<td class='ps-4 text-start'></td>", "<td class='ps-4 text-start'>" + noOTP + "</td>");
                        noOTP++;
                    } else if (result[i].status_sign === "80") {
                        tableVoid += row.replace("<td class='ps-4 text-start'></td>", "<td class='ps-4 text-start'>" + noVoid + "</td>");
                        noVoid++;
                    } else if (["95","96","98","99"].includes(result[i].status_sign)) {
                        tableFailed += row.replace("<td class='ps-4 text-start'></td>", "<td class='ps-4 text-start'>" + noFailed + "</td>");
                        noFailed++;
                    } else {
                        tableAll += row.replace("<td class='ps-4 text-start'></td>", "<td class='ps-4 text-start'>" + noAll + "</td>");
                        noAll++;
                    }

                } // end loop result
            } // end if responCode

            $("#resultdatadocumentall").html(tableAll);
            $("#resultdatadocumentvoid").html(tableVoid);
            $("#resultdatadocumentfailed").html(tableFailed);
            $("#resultdatadocumentotp").html(tableOTP);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            KTApp.initBootstrapTooltips();
        },
        error: function(error) {
            showAlert(
                "I'm Sorry",
                "<b>"+error+"</b>",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
        }
    });
}

$(document).on("submit", "#formadddocument", function (e) {
    e.preventDefault();

    var form     = $(this);
    var url      = form.attr("action");
    var formData = new FormData(this);

    $.ajax({
        url        : url,
        data       : formData,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        contentType: false,
        processData: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#modal_sign_add_tilaka_btn").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                $('#modal_sign_add_tilaka').modal('hide');
                alldocument();
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            $("#modal_sign_add_tilaka_btn").removeClass("disabled");
            toastr.clear();
        },
        error: function (error) {
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