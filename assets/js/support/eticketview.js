dataeticket();

function getdetail(btn){
    var data_transid     = btn.attr("data_transid");
    var data_subject     = btn.attr("data_subject");
    var data_description = btn.attr("data_description");

    $("textarea[name='modal_followup_eticket_description']").val(data_description);
    $("input[name='modal_followup_eticket_transid']").val(data_transid);
    $("input[name='modal_followup_eticket_subject']").val(data_subject);
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
                                      "data_description='"+result[i].description+"'";

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
                    tableresult +="<td><div class='text-gray-800 text-hover-primary'>"+result[i].subject+"</div><div>"+result[i].description+"</div></td>";
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