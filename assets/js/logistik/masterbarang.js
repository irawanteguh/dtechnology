masterbarang();

function masterbarang(){
    $.ajax({
        url       : url+"index.php/logistik/masterbarang/masterbarang",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultmasterbarang").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].nama_barang+"</td>";
                    tableresult +="<td></td>";
                    tableresult +="<td></td>";
                    tableresult +="<td></td>";
                    tableresult +="<td class='text-center'>"+result[i].final_stok+"</td>";
                    tableresult +="<td></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultmasterbarang").html(tableresult);
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