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
                        tableresult +="<td></td>"; 
                    }else{
                        tableresult +="<td class='text-center'><i class='fa-solid fa-cloud-arrow-up text-primary'></i></td>";
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


function uploadallfile(){
    $.ajax({
        url     : url+"index.php/tilaka/uploadfile/uploadallfile",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            Swal.fire({
                position         : "center",
                icon             : data.responHead,
                title            : "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                html             : "<h5 class='small'>Process Upload And Request Sign Finish</h6>",
                timerProgressBar : true,
                showConfirmButton: false,
                timer            : 5000,
                showClass: {
                    popup: `
                    animate__animated
                    animate__fadeInUp
                    `
                },
                hideClass: {
                    popup: `
                    animate__animated
                    animate__fadeOutDown
                    `
                }
            });
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			
		}
    });
    return false;
};