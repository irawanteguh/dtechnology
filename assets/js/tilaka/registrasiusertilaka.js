datakaryawan();

$('#search').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

function datakaryawan(){
    var search = $("input[name='search']").val();
    $.ajax({
        url     : url+"index.php/tilaka/registrasiusertilaka/datakaryawan",
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
            var result     = "";
            var tableresult     = "";
            

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    tableresult +="<tr>";
                    if(result[i].IDENTITY_NO!=null&&result[i].EMAIL!=null){
                        tableresult +="<td><a class='btn btn-xs btn-primary'><i class='fa-solid fa-user-plus'></i> REGISTRASI</a></td>";
                    }else{
                        tableresult +="<td></td>";
                    }
                    tableresult +="<td class='text-center align-middle'>"+result[i].NIK+"</td>";
                    tableresult +="<td class='text-left align-middle'>"+result[i].NAME+"</td>";

                    if(result[i].IDENTITY_NO===null){
                        tableresult +="<td></td>";
                    }else{
                        tableresult +="<td class='text-center align-middle'>"+result[i].IDENTITY_NO+"</td>";
                    }

                    if(result[i].EMAIL===null){
                        tableresult +="<td></td>";
                    }else{
                        tableresult +="<td class='text-left align-middle'>"+result[i].EMAIL+"</td>";
                    }
                    
                    tableresult +="</tr>";
                }
            }

            $("#resultregistrasiusertilaka").html(tableresult);

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