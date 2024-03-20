dataexecutesign();

function statusexecutesign(btn){
    var urlid      = $(btn).attr("data-urlid");
    var requestid      = $(btn).attr("data-requestid");
    var useridentifier = $(btn).attr("data-useridentifier");
    $.ajax({
        url     : url+"index.php/tilaka/executesign/statusexecutesign",
        data    : {urlid:urlid,requestid:requestid,useridentifier:useridentifier},
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            result        = data.responResult;
            
            Swal.fire({
                position         : "center",
                icon             : data.responHead,
                title            : "<h1 class='font-weight-bold' style='color:#fff;'>"+"Information"+"</h1>",
                html             : "<h6 class='small'>"+result['status']+"</h6>"+"<h6 class='small'>"+result['message']+"</h6>",
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
			dataexecutesign();
		}
    });
    return false;
};

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
            var getvariabel = "";
            
            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    getvariabel =   "data-urlid='"+result[i].URL_ID+"'"+
                                    "data-requestid='"+result[i].REQUEST_ID+"'"+
                                    "data-useridentifier='"+result[i].USER_IDENTIFIER+"'";

                    tableresult +="<tr>";
                    tableresult +="<td></td>";
                    if(result[i].STATUS==="0"){
                        tableresult +="<td><a class='btn btn-xs btn-primary' href='"+result[i].URL+"&redirect_url=http://localhost/dtechnology/index.php/tilaka/executesign?urlid="+result[i].URL_ID+"'>LINK</a></td>";
                    }else{
                        tableresult +="<td><a class='btn btn-xs btn-primary' "+getvariabel+" onclick='statusexecutesign(this)'>CHECK STATUS</a></td>";
                    }
                    
                    tableresult +="<td>"+result[i].USER_IDENTIFIER+"</td>";
                    tableresult +="<td>"+result[i].nik+"</td>";
                    tableresult +="<td>"+result[i].name+"</td>";
                    tableresult +="<td>"+result[i].noktp+"</td>";
                    tableresult +="<td>"+result[i].email+"</td>";
                    tableresult +="<td>"+result[i].tgljam+"</td>";
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