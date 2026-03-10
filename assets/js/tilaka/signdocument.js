datasigndocument();

function datasigndocument(){
    $.ajax({
        url     : url+"index.php/tilaka/signdocument/datasigndocument",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultsigndocument").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";
            
            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div><span class='badge badge-light-"+result[i].colorstatus+" fs-7 fw-bold'>"+result[i].status+"</span></div><div class='fst-italic small'>"+(result[i].descriptionstatus ? result[i].descriptionstatus : "")+"</div></td>";
                    tableresult +="<td class='text-center'>"+(result[i].jmlfile ? result[i].jmlfile : "")+"</td>";
                    tableresult +="<td>"+(result[i].user_identifier ? result[i].user_identifier : "")+"</td>";
                    tableresult +="<td><div>"+(result[i].name ? result[i].name : "")+"</div><div>"+(result[i].email ? result[i].email : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].request_id ? result[i].request_id : "")+"</td>";
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].status_sign==="2"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-primary pe-4' href='"+result[i].url+"&redirect_url="+url+"index.php/tilaka/signdocument?user_identifier="+result[i].user_identifier+"&quicksign=Y'><i class='bi bi-check-circle text-primary'></i> Sign</a>";
                                }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }

            $("#resultsigndocument").html(tableresult);

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