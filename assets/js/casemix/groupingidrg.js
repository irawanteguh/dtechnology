dataklaim();

function dataklaim(){
    $.ajax({
        url        : url+"index.php/casemix/groupingidrg/dataklaim",
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatadataklaim").html("");
        },
        success:function(data){
            var result              = "";
            var tableresult         = "";
            var getvariabel         = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    var no = parseInt(i) + 1;

                    tableresult +="<tr>";
                        tableresult +="<td class='ps-4'>"+no+"</td>";
                        tableresult +="<td class='text-center'>"+result[i].tglmasuk+"</td>";
                        tableresult +="<td class='text-center'>"+result[i].tglpulang+"</td>";
                        tableresult +="<td>"+result[i].no_sep+"</td>";
                        tableresult +="<td><div>"+result[i].nama_pasien+"</div><div>"+result[i].no_rm+"</div></td>";
                        tableresult +="<td class='text-center'></td>";
                        tableresult +="<td class='text-center'></td>";
                        tableresult +="<td class='text-end'>"+todesimal(result[i].totalbillingrs)+"</td>";
                        tableresult +="<td>"+result[i].jenisrawat+"</td>";
                        tableresult +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                        tableresult += "<td class='text-end'>";
                            tableresult +="<div class='btn-group' role='group'>";
                                tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    tableresult +="<a class='dropdown-item btn btn-sm' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_simulasi_idrg'><i class='bi-stars text-primary'></i> Grouping Inacbg iDRG</a>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
        
                    tableresult +="</tr>";
                }
            }

            $("#resultdatadataklaim").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function randomgenerator() {
    $.ajax({
        url       : url+"index.php/casemix/groupingidrg/randomgenerator",
        type      : "GET",
        dataType  : "JSON",
        beforeSend: function(){

        },
        success: function(data) {
            if(data.responCode==="00"){
                dataklaim();
            }
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        }
    });
};
