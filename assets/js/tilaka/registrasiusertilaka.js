datakaryawan();

$('#search').on('keypress', function (event) {
    if (event.which === 13) {
        datakaryawan();
    }
});

// function getdata(btn){
//     var userid   = btn.attr("data-userid");
//     var nik = btn.attr("data-nik");
//     var nama   = btn.attr("data-nama");
//     var noktp   = btn.attr("data-noktp");
//     var email   = btn.attr("data-email");

// }

// $(document).on("click",".btn-registrasi", function(e){            
//     e.preventDefault();
// 	registrasiuser();
// });

function registrasiuser(btn){
    var userid   = $(btn).attr("data-userid");
    $.ajax({
        url     : url+"index.php/tilaka/registrasiusertilaka/registrasiuser",
        data    : {userid:userid},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            
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
            var getvariabel     = "";
            

            if(data.responCode == "00"){
                result        = data.responResult;

                for(var i in result){
                    getvariabel =   "data-userid='"+result[i].USER_ID+"'"+
                                    "data-nik='"+result[i].NIK+"'"+
                                    "data-nama='"+result[i].NAME+"'"+
                                    "data-noktp='"+result[i].IDENTITY_NO+"'"+
                                    "data-email='"+result[i].EMAIL+"'";

                    tableresult +="<tr>";
                    if(result[i].IDENTITY_NO!=null&&result[i].EMAIL!=null){
                        tableresult +="<td><a class='btn btn-xs btn-primary' "+getvariabel+" onclick='registrasiuser(this)'><i class='fa-solid fa-user-plus'></i> REGISTRASI</a></td>";
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