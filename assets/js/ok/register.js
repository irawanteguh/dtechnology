refreshdata();

flatpickr('[name="modal_reserve_register_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    minDate   : "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function getdata(btn){
    var data_namapasien       = btn.attr("data_namapasien");
    var data_mrpasien         = btn.attr("data_mrpasien");
    var data_pasienid         = btn.attr("data_pasienid");
    var data_cito             = btn.attr("data_cito");
    var data_tgltindakan      = btn.attr("data_tgltindakan");
    var data_dokteropr        = btn.attr("data_dokteropr");
    var data_operasiid        = btn.attr("data_operasiid");
    var data_diagnosis        = btn.attr("data_diagnosis");
    var data_basicdiagnosis   = btn.attr("data_basicdiagnosis");
    var data_tindakan         = btn.attr("data_tindakan");
    var data_indikasitindakan = btn.attr("data_indikasitindakan");
    var data_procedures       = btn.attr("data_procedures");
    var data_purpose          = btn.attr("data_purpose");
    var data_risk             = btn.attr("data_risk");
    var data_prognosis        = btn.attr("data_prognosis");
    var data_alternative      = btn.attr("data_alternative");
    var data_save             = btn.attr("data_save");

    $("#kt_drawer_chat_reserve_namapasien").html(data_namapasien+" [ "+data_mrpasien+" ]");
    $('#operasiid').val(data_operasiid);
    $('#modal_cancelled_operasiid').val(data_operasiid);
    $('#modal_reserve_register_operasiid').val(data_operasiid);

    $('#modal_reserve_register_date').val(data_tgltindakan);

    var $pasienid = $('#modal_reserve_register_pasienid').select2();
    $pasienid.val(data_pasienid).trigger('change');

    chat(data_operasiid);
};

function refreshdata(){
    datarequest();
    datacancelled();
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/ok/reserve/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultrequest").html("");
        },
        success:function(data){
            var tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel = " data_namapasien='"+result[i].namepasien+"'"+
                                      " data_mrpasien='"+result[i].mrpasien+"'"+
                                      " data_operasiid='"+result[i].transaksi_id+"'"+
                                      " data_tgltindakan='"+result[i].tgltindakan+"'"+
                                      " data_pasienid='"+result[i].pasien_id+"'"+
                                      " data_cito='"+result[i].cito+"'"+
                                      " data_dokteropr='"+result[i].dokter_opr+"'"+
                                      " data_diagnosis='"+result[i].diagnosis+"'"+
                                      " data_basicdiagnosis='"+result[i].basic_diagnosis+"'"+
                                      " data_tindakan='"+result[i].tindakan+"'"+
                                      " data_indikasitindakan='"+result[i].indikasi_tindakan+"'"+
                                      " data_procedures='"+result[i].procedures+"'"+
                                      " data_purpose='"+result[i].purpose+"'"+
                                      " data_risk='"+result[i].risk+"'"+
                                      " data_prognosis='"+result[i].prognosis+"'"+
                                      " data_alternative='"+result[i].alternative+"'"+
                                      " data_save='"+result[i].save+"'";

                    tableresult +="<tr>";

                    
                    

                    tableresult +="<td class='ps-4'><div><span>"+(result[i].cito === "Y" ? "<span class='badge badge-light-danger mb-1'>CITO</span> " : "<span class='badge badge-light-primary mb-1'>ELEKTIF</span> ")+"</span></div><div><span class='badge badge-light-" + result[i].colorstatus + "'>" + result[i].namestatus + "</span></div><div><span class='badge badge-secondary'>" + (result[i].reason ? result[i].reason : "") + "</span></div></td>";
                    tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div><div>"+(result[i].phone ? result[i].phone : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].diagnosis ? result[i].diagnosis : "")+"</div><div class='separator my-2'></div><div>"+(result[i].tindakan ? result[i].tindakan : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";

                    if(result[i].status!="99"){
                        tableresult += "<td class='text-end'>";
                            tableresult += "<div class='btn-group' role='group'>";
                                tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-primary' data-kt-drawer-show='true' data-kt-drawer-target='#kt_drawer_chat_reserve' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-send text-primary'></i> Follow Up</a>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_reserve_register' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-pencil-square text-info'></i> Register</a>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-danger' data-bs-toggle='modal' data-bs-target='#modal_cancelled' "+getvariabel+" onclick='getdata($(this));'><i class='fa-solid fa-user-slash text-danger'></i> Cancelled</a>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }else{
                        tableresult +="<td></td>";
                    }

                    tableresult +="</tr>";
                }
            }


            $("#resultrequest").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
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
};

function datacancelled(){
    $.ajax({
        url       : url+"index.php/ok/reserve/datacancelled",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultcancelled").html("");
        },
        success:function(data){
            var tableresult ="";

            if(data.responCode==="00"){
                let result        = data.responResult;
                for(var i in result){
                    var getvariabel = " data_namapasien='"+result[i].namepasien+"'"+
                                      " data_mrpasien='"+result[i].mrpasien+"'"+
                                      " data_operasiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";

                    
                    

                    tableresult +="<td class='ps-4'><div><span>"+(result[i].cito === "Y" ? "<span class='badge badge-light-danger mb-1'>CITO</span> " : "<span class='badge badge-light-primary mb-1'>ELEKTIF</span> ")+"</span></div><div><span class='badge badge-secondary'>" + (result[i].reason ? result[i].reason : "") + "</span></div></td>";
                    tableresult +="<td><div>"+(result[i].mrpasien ? result[i].mrpasien : "")+"</div><div>"+(result[i].namepasien ? result[i].namepasien : "")+"</div><div>"+(result[i].phone ? result[i].phone : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].tgltindakan ? result[i].tgltindakan : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].diagnosis ? result[i].diagnosis : "")+"</div><div class='separator my-2'></div><div>"+(result[i].tindakan ? result[i].tindakan : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].operator ? result[i].operator : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "")+"</div><div>"+(result[i].tglbuat ? result[i].tglbuat : "")+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult += "<a class='dropdown-item btn btn-sm text-primary' data-kt-drawer-show='true' data-kt-drawer-target='#kt_drawer_chat_reserve' "+getvariabel+" onclick='getdata($(this));'><i class='bi bi-send text-primary'></i> Follow Up</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }


            $("#resultcancelled").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
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
};

function chat(operasiid) {
    $.ajax({
        url       : url + "index.php/ok/reserve/chat",
        data      : { operasiid: operasiid },
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
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
                    var chatType = result[i].type === "in" ? "info" : "primary";
                    var isSameUser = lastName === result[i].name;
                    lastName = result[i].name;

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

$(document).on("submit", "#formcancelled", function (e) {
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
			$("#modal_cancelled_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_cancelled").modal("hide");
                refreshdata();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_cancelled_btn").removeClass("disabled");
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