dataeticket();

function getdetail(btn){
    var data_transid     = btn.attr("data_transid");
    var data_subject     = btn.attr("data_subject");
    var data_severity    = btn.attr("data_severity");
    var data_category    = btn.attr("data_category");
    var data_description = btn.attr("data_description");

    $("textarea[name='modal_followup_eticket_description']").val(data_description);
    $("input[name='modal_followup_eticket_transid']").val(data_transid);
    $("input[name='modal_followup_eticket_subject']").val(data_subject);

    var $severity = $('#modal_followup_eticket_severity').select2();
    $severity.val(data_severity).trigger('change');

    var $pic = $('#modal_followup_eticket_pic').select2();
    $pic.val(data_category).trigger('change');
};

function dataeticket(){
    $.ajax({
        url        : url+"index.php/support/eticketview/dataeticket",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resulteticketview").html("");
        },
        success:function(data){
           
            var tableresult      = "";

            if(data.responCode==="00"){
                var result        = data.responResult;
                for(var i in result){
                    var getvariabel = "data_transid='"+result[i].trans_id+"'"+
                                      "data_subject='"+result[i].subject+"'"+
                                      "data_severity='"+result[i].severity_id+"'"+
                                      "data_category='"+result[i].category_id+"'"+
                                      "data_description='"+result[i].description+"'";

                    var severityClass = "";

                    if (result[i].severity_id === "9f642ff7-4b89-49ee-bca4-acdd258f4361") {
                        severityClass = "badge-light-success";
                    } else if (result[i].severity_id === "e4680723-0f36-4b6e-9092-4abc804b01f1") {
                        severityClass = "badge-light-warning";
                    } else if (result[i].severity_id === "24cdd330-d6d6-4380-bc37-0638da4e801f") {
                        severityClass = "badge-light-danger";
                    } else {
                        severityClass = "badge-light-secondary"; // Warna default abu-abu
                    }

                    tableresult +="<tr>";
                    if(result[i].status==="0"){
                        tableresult +="<td class='ps-4'><span class='badge badge-light-info'>New Eticket</span></td>";
                    }
                    if(result[i].status==="1"){
                        tableresult +="<td class='ps-4'><span class='badge badge-light-danger'>Reject Head Unit</span></td>";
                    }
                    if(result[i].status==="2"){
                        tableresult +="<td class='ps-4'><span class='badge badge-light-success'>Approve Head Unit</span></td>";
                    }
                    if(result[i].status==="3"){
                        tableresult +="<td class='ps-4'><span class='badge badge-light-danger'>Decline IT</span></td>";
                    }
                    if(result[i].status==="4"){
                        tableresult +="<td class='ps-4'><span class='badge badge-light-success'>Follow Up IT</span></td>";
                    }
                    tableresult +="<td><div class='text-gray-800 text-hover-primary'>"+result[i].subject+"</div><div>"+result[i].description+"</div></td>";
                    tableresult +="<td><span class='badge "+severityClass+" my-1'>"+result[i].severity+"</span></td>";
                    if(result[i].status==="2"){
                        tableresult +="<td><span class='badge badge-light-info my-1'>"+result[i].category+"</span></td>";
                    }else{
                        tableresult +="<td><div><span class='badge badge-light-info my-1'>"+result[i].category+"</span></div><div><span class='badge badge-light-info my-1'>"+result[i].problem+"</span></div></td>";
                    }
                    
                    if(result[i].attachment==="1"){
                        tableresult += "<td><a class='badge badge-light-info my-1' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='" + url + "assets/documentsupport/" + (result[i].trans_id ? result[i].trans_id : "") + ".pdf' onclick='viewdoc(this)'>View Attachment</a></td>";
                    }else{
                        tableresult +="<td></td>";
                    }
                    tableresult +="<td>"+result[i].department+"</td>";
                    tableresult +="<td><div class='text-gray-800 text-hover-primary'>"+result[i].dibuatoleh+"</div><div>"+result[i].createddate+"</div></td>";
                    tableresult +="<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            if(result[i].status==="2"){
                                tableresult += "<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_followup_eticket' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Follow Up</a>";
                            }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resulteticketview").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
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
};

$(document).on("click",".btn-followup", function(e){            
    e.preventDefault();
    followup(this);
});

function followup(button) {
    var form   = $("#formfollowup");
    var url    = form.attr("action");
    var status = $(button).attr('name');

    var formData = form.serialize();
    formData += '&status=' + encodeURIComponent(status);

    $.ajax({
        url       : url,
        data      : formData,
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#btn_followup_eticket").addClass("disabled");
        },
        success: function (data) {
            if(data.responCode == "00"){
                $("#modal_followup_eticket").modal("hide");
                dataeticket();
            }
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            $("#btn_followup_eticket").removeClass("disabled");
            toastr.clear();
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
}

