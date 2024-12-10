mutasibarang();

function mutasibarang(){
    $.ajax({
        url       : url+"index.php/logistik/stockopname/mutasibarang",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultmutasibarang").html("");
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
                    tableresult +="<td class='ps-4'>"+result[i].transaksi_id+"</td>";
                    tableresult +="<td><div>"+(result[i].unit ? result[i].unit : "-")+"</div><div>"+(result[i].location ? result[i].location : "-")+"</div></td>";
                    tableresult +="<td>"+result[i].namabarang+"</td>";
                    tableresult +="<td class='text-center'>"+result[i].masuk+"</td>";
                    tableresult +="<td class='text-center'>"+result[i].keluar+"</td>";
                    tableresult +="<td class='text-center'>"+result[i].qty+"</td>";
                    tableresult +="<td>"+(result[i].dibuatoleh ? result[i].dibuatoleh : "-")+"</td>";
                    tableresult +="<td class='pe-4 text-end'>"+result[i].tgltransaksi+"</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultmutasibarang").html(tableresult);
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