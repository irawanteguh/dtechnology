canister();

function canister(){
    $.ajax({
        url       : url+"index.php/md/canister/canister",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#resultcanisterdata").html("");
        },
        success: function (data) {
            var tableresult = "";
            
        
            if (data.responCode === "00") {
                var result = data.responResult;

                for (var i in result) {
                    tableresult +="<div class='col-md-6 col-xl-3'>";
                        tableresult +="<div class='card card-flush h-100'>";
                            tableresult +="<div class='card-header flex-nowrap border-0'>";
                                tableresult +="<div class='card-title m-0'>";
                                    tableresult +="<h6>"+result[i].canister_no+"</h6>";
                                tableresult +="</div>";
                                tableresult +="<div class='card-toolbar m-0'>";
                                    tableresult += "<span class='badge badge-light-" + (parseInt(result[i].stok) === 0 ? 'danger fa-fade' : parseInt(result[i].stok) < parseInt(result[i].min_stok) ? 'warning' : 'success') + " fw-bolder me-auto px-4 py-3'>" + (parseInt(result[i].stok) === 0 ? 'Out Of Stock' : parseInt(result[i].stok) < parseInt(result[i].min_stok) ? 'Stock Below Minimum' : 'Stock Available') + "</span>";
                                    tableresult +="<button type='button' class='btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3' data-kt-menu-trigger='click' data-kt-menu-placement='bottom-end'>";
                                        tableresult +="<span class='svg-icon svg-icon-3 svg-icon-primary'>";
                                            tableresult +="<svg xmlns='http://www.w3.org/2000/svg' width='24px' height='24px' viewBox='0 0 24 24'>";
                                                tableresult +="<g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>";
                                                tableresult +="<rect x='5' y='5' width='5' height='5' rx='1' fill='#000000'></rect>";
                                                tableresult +="<rect x='14' y='5' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                tableresult +="<rect x='5' y='14' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                tableresult +="<rect x='14' y='14' width='5' height='5' rx='1' fill='#000000' opacity='0.3'></rect>";
                                                tableresult +="</g>";
                                            tableresult +="</svg>";
                                        ;tableresult +="</span>"
                                    tableresult +="</button>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                            tableresult +="<div class='card-body d-flex flex-column px-5 py-2'>";
                                tableresult +="<div class='fw-bold text-gray-400'>"+(result[i].namaobat ? result[i].namaobat : "Undefine")+"</div>";
                                tableresult +="<div class='fs-2 fw-bolder fs-2tx fw-bolder "+(result[i].stok == 0 ? 'text-danger fa-fade' : '')+"'>"+todesimal(result[i].stok)+"</div>";
                                tableresult +="<div class='d-flex align-items-center fw-bold'>";
                                    tableresult +="<span class='badge bg-light text-gray-700 px-3 py-2 me-2'>Minimum stock "+result[i].min_stok+"</span>";
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</div>";
                    
                }
            }
        
            $("#resultcanisterdata").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
		},
        error: function(xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : "+error, "Opps !");
		}
    });
    return false;
};