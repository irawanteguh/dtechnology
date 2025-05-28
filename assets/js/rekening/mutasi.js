datamutasi();

$(document).on("change", "select[name='mutasi_rekeningid']", function (e) {
    e.preventDefault();
    datamutasi();
});

function datamutasi(){
    var rekeningid = $("select[name='mutasi_rekeningid']").val();
    $.ajax({
        url       : url+"index.php/rekening/mutasi/datamutasi",
        data      : {rekeningid:rekeningid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatamutasi").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].rekeningname ? result[i].rekeningname : "")+"</div><div>"+(result[i].rekeningid ? result[i].rekeningid : "")+"</div></td>";
                    tableresult +="<td>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+(result[i].unit ? result[i].unit : "")+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";

                    if(result[i].status==="6"){
                        if(result[i].cash_in!=0){
                            tableresult +="<td><div><span class='badge badge-light-primary fs-8 fw-bold'>CR</span></div></td>";
                        }else{
                            tableresult +="<td><div><span class='badge badge-light-danger fs-8 fw-bold'>DB</span></div></td>";
                        }
                    }

                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td class='text-end pe-4'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatamutasi").html(tableresult);
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