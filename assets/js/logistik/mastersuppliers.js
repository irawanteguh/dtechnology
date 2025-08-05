mastersuppliers();

function mastersuppliers(){
    $.ajax({
        url       : url+"index.php/logistik/mastersuppliers/mastersuppliers",
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

                    getvariabel =   "data-supplierid='"+result[i].supplier_id+"'";

                    tableresult +="<tr>";

                    tableresult +="<td class='ps-4'>"+result[i].supplier+"</td>";
                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                // tableresult += "<a class='dropdown-item btn btn-sm' data-bs-toggle='modal' data-bs-target='#modal_print_po' onclick='getdetail($(this));'><i class='bi bi-printer text-primary'></i> Edit</a>";
                                tableresult += "<a class='dropdown-item btn btn-sm btn-light-danger' "+getvariabel+" onclick='nonactive($(this));'><i class='bi bi-trash'></i> Non Active</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }

            $("#resultmastersuppliers").html(tableresult);
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
    var supplierid = btn.attr("data-supplierid");
	$.ajax({
        url        : url+"index.php/logistik/mastersuppliers/nonactive",
        data       : {supplierid:supplierid},
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
				mastersuppliers();
			};

            toastr[data.responHead](data.responDesc, "INFORMATION");
		}
	});
	return false;
};

$(document).on("submit", "#formaddsuppliers", function (e) {
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
                $("#modal_new_suppliers").modal("hide");
                mastersuppliers();
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