datapettycash();
decline();
approved();

function datapettycash(){
    $.ajax({
        url       : url+"index.php/pettycash/pettycashfinance/datapettycash",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapettycash").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel = " data_transaksiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";

                    if(result[i].status==="4"){
                         tableresult +="<td><div><span class='badge badge-light-primary fs-7 fw-bold'>Approval Manager</span></div></td>";
                    }else{
                        if(result[i].cash_in!=0){
                            tableresult +="<td><div><span class='badge badge-light-primary fs-7 fw-bold'>Cash In</span></div></td>";
                        }else{
                            tableresult +="<td><div><span class='badge badge-light-danger fs-7 fw-bold'>Cash Out</span></div></td>";
                        }
                    }

                    
                    
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td>"+result[i].tglbuat+"</td>";
                    tableresult +="<td>"+result[i].dibuatoleh+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";

                                if(result[i].status==="4"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data_cashout='"+parseFloat(result[i].cash_out)+"' data_validasi='6' onclick='updatepettycash($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    tableresult +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='5' onclick='updatepettycash($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";   
                                }

                                tableresult += "</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatapettycash").html(tableresult);
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

function approved(){
    $.ajax({
        url       : url+"index.php/pettycash/pettycashfinance/approved",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapettycashapproved").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel = " data_transaksiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";

                    if(result[i].status==="6"){
                        if(result[i].cash_in!=0){
                            tableresult +="<td><div><span class='badge badge-light-primary fs-7 fw-bold'>Cash In</span></div></td>";
                        }else{
                            tableresult +="<td><div><span class='badge badge-light-danger fs-7 fw-bold'>Cash Out</span></div></td>";
                        }
                    }

                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td>"+result[i].tglbuat+"</td>";
                    tableresult +="<td>"+result[i].dibuatoleh+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";

                                if(result[i].status==="2"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='0' onclick='updatepettycash($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Approved</a>";
                                }

                                tableresult += "</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatapettycashapproved").html(tableresult);
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

function decline(){
    $.ajax({
        url       : url+"index.php/pettycash/pettycashfinance/decline",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapettycashdecline").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel = " data_transaksiid='"+result[i].transaksi_id+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+(result[i].no_kwitansi ? result[i].no_kwitansi : "")+"</td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td>"+(result[i].note ? result[i].note : "")+"</td>";

                    if(result[i].status==="5"){
                        tableresult +="<td><div><span class='badge badge-light-danger fs-7 fw-bold'>Decline Finance</span></div></td>";
                    }else{
                        if(result[i].cash_in!=0){
                            tableresult +="<td><div><span class='badge badge-light-primary fs-7 fw-bold'>Cash In</span></div></td>";
                        }else{
                            tableresult +="<td><div><span class='badge badge-light-danger fs-7 fw-bold'>Cash Out</span></div></td>";
                        }
                    }

                    
                    
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_in)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].cash_out)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].balance)+"</td>";
                    tableresult +="<td>"+result[i].tglbuat+"</td>";
                    tableresult +="<td>"+result[i].dibuatoleh+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";

                                if(result[i].status==="5"){
                                    tableresult +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" data_validasi='4' onclick='updatepettycash($(this));'><i class='bi bi-check2-circle text-info'></i> Cancelled Decline</a>";
                                }

                                tableresult += "</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultdatapettycashdecline").html(tableresult);
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

$(document).on("submit", "#formnewpengeluaran", function (e) {
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
			$("#btn_new_pengeluaran").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_pettycash_pengeluaran").modal("hide");
                datapettycash();
                decline();
                approved();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_pengeluaran").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
    return false;
});

$(document).on("submit", "#formnewpemasukan", function (e) {
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
			$("#btn_new_pemasukan").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_pettycash_pemasukan").modal("hide");
                datapettycash();
                decline();
                approved();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#btn_new_pemasukan").removeClass("disabled");
		},
        error: function(xhr, status, error) {
            showAlert(
                "I'm Sorry",
                error,
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
		}
	});
    return false;
});

function updatepettycash(btn) {
    Swal.fire({
        title             : 'Are you sure?',
        text              : "You won't be able to revert this!",
        icon              : 'warning',
        showCancelButton  : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        confirmButtonText : 'Yes, proceed!',
        cancelButtonText  : 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            var data_transaksiid = btn.attr("data_transaksiid");
            var data_validasi    = btn.attr("data_validasi");
            var data_cashout     = btn.attr("data_cashout");
            $.ajax({
                url       : url+"index.php/pettycash/pettycashit/updatepettycash",
                data      : {data_transaksiid:data_transaksiid,data_validasi:data_validasi,data_cashout:data_cashout},
                method    : "POST",
                dataType  : "JSON",
                cache     : false,
                beforeSend: function () {
                    toastr.clear();
                    toastr["info"]("Sending request...", "Please wait");
                },
                success: function (data) {
                    toastr.clear();
                    toastr[data.responHead](data.responDesc, "INFORMATION");
                },
                complete: function () {
                    datapettycash();
                    decline();
                    approved();
                },
                error: function (xhr, status, error) {
                    showAlert(
                        "I'm Sorry",
                        error,
                        "error",
                        "Please Try Again",
                        "btn btn-danger"
                    );
                }
            });
        }
    });
    return false;
};