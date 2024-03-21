dataupload();

function dataupload(){
    var search = $("input[name='search']").val();
    $.ajax({
        url     : url+"index.php/tilaka/uploadfile/dataupload",
        data    : {search:search},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            $("#resultregistrasiusertilaka").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td></td>";
                    if(result[i].STATUS_SIGN==="0"){
                        tableresult +="<td>File Not Uploaded</td>"; 
                    }else{
                        if(result[i].STATUS_SIGN==="1"){
                            tableresult +="<td>Files Have Been Uploaded</td>"; 
                        }else{
                            if(result[i].STATUS_SIGN==="2"){
                                tableresult +="<td>Request Sign</td>"; 
                            }else{
                                tableresult +="<td><a class='btn btn-xs btn-primary' href='"+result[i].LINK+"' target='_blank'>LINK DOWNLOAD</a></td>"; 
                            }
                        }
                    }
                    tableresult +="<td>"+result[i].NO_FILE+".pdf</td>";
                    if(result[i].FILENAME===null){
                        tableresult +="<td></td>";
                    }else{
                        tableresult +="<td>"+result[i].FILENAME+"</td>";
                    }
                    
                    tableresult +="<td>"+result[i].jenisdocumen+"</td>";
                    tableresult +="<td>"+result[i].assignname+"</td>";
                    tableresult +="<td>"+result[i].useridentifier+"</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultuploadfile").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");

        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			toastr.clear();
		}
    });
    return false;
};