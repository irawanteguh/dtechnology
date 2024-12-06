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

                    getvariabel =   "data-barangid='"+result[i].barang_id+"'";

                    var type = "";
                    if(result[i].type===null){
                        type = "<div class='badge badge-light-danger fs-7 fw-bolder me-2'>unclassified</div>";
                    }

                    if(result[i].type==="1"){
                        type = "<div class='badge badge-light-primary fs-7 fw-bolder me-2'>consumable</div>";
                    }

                    if(result[i].type==="2"){
                        type = "<div class='badge badge-light-success fs-7 fw-bolder me-2'>assets</div>";
                    }

                    tableresult +="<tr>";

                    tableresult +="<td class='ps-4'>"+result[i].nama_barang+" "+type+"</td>";
                    tableresult +="<td>"+(result[i].jenis ? result[i].jenis : "")+"</td>";
                    tableresult +="<td>"+(result[i].satuanbeli ? result[i].satuanbeli : "")+"</td>";
                    tableresult +="<td>"+(result[i].satuanpakai ? result[i].satuanpakai : "")+"</td>";
                    tableresult +="<td class='text-center'>"+result[i].final_stok+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_edit_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square'></i> Edit</a>";
                                tableresult += "<a class='dropdown-item btn btn-sm btn-light-danger' "+getvariabel+" onclick='nonactive($(this));'><i class='bi bi-trash'></i> Non Active</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

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

function nonactive(btn){
    var barangid = btn.attr("data-barangid");
	$.ajax({
        url        : url+"index.php/logistik/masterbarang/nonactive",
        data       : {barangid:barangid},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
		success : function (data) {
			if(data.responCode === "00"){
                toastr[data.responHead](data.responDesc, "INFORMATION");
				masterbarang();
			};

            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

$(document).on("submit", "#formadditem", function (e) {
	e.preventDefault();
    e.stopPropagation();
	var form = $(this);
    var url  = $(this).attr("action");
	$.ajax({
        url       : url,
        data      : form.serialize(),
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
			$("#btn_position_add").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_new_barang").modal("hide");
                masterbarang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            toastr.clear();
            $("#btn_position_add").removeClass("disabled");
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
                customClass      : {confirmButton: "btn btn-danger"},
                showClass        : {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass        : {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
	});
    return false;
});