dataexecutesign();

function dataexecutesign(){
    $.ajax({
        url     : url+"index.php/tilaka/executesign/dataexecutesign",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            $("#resultexecutesign").html("");
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
                    tableresult +="<td><a class='btn btn-xs btn-primary' href='"+result[i].URL+"' target='_blank'>LINK</a></td>";
                    tableresult +="<td>"+result[i].USER_IDENTIFIER+"</td>";
                    tableresult +="<td>"+result[i].nik+"</td>";
                    tableresult +="<td>"+result[i].name+"</td>";
                    tableresult +="<td>"+result[i].noktp+"</td>";
                    tableresult +="<td>"+result[i].email+"</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultexecutesign").html(tableresult);
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