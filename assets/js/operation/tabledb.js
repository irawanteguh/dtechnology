mastertabledb();

function mastertabledb(){
    $.ajax({
        url     : url+"index.php/operation/tabledb/mastertabledb",
        method  : "POST",
        dataType: "JSON",
        cache   : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resulttabledb").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                   tableresult +="<tr>";
                   tableresult +="<td>"+result[i].TABLE_SCHEMA+"</td>";
                   tableresult +="<td>"+result[i].TABLE_NAME+"</td>";
                   tableresult +="<td class='text-center'>"+result[i].SIZE+" Mb</td>";
                   tableresult +="<td class='text-end'><a class='btn btn-sm btn-light-primary' data-tablename='"+result[i].TABLE_NAME+"' onclick='backuptable(this)'>Download</a></td>";

                   tableresult +="</tr>";
                }
            }

            $("#resulttabledb").html(tableresult);
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

function backuptable(btn){
    var tablename      = $(btn).data("tablename");
    $.ajax({
        url       : url+"index.php/operation/tabledb/backuptable",
        data      : {tablename:tablename},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){

            Swal.fire({
                position: "center",
                icon: data.responHead,
                title: "<h1 class='font-weight-bold' style='color:#37517e;'>"+"Information"+"</h1>",
                html: data.responDesc,
                timerProgressBar: true,
                showConfirmButton: false,
                timer: 5000,
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

            window.open(data.url, "_self");
        },
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		},
		complete: function () {
			
		}
    });
    return false;
};