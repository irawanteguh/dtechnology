datarequest();

$("#modal_master_detail_spu").on('shown.bs.modal', function(){
    var nopemesanan  = $(":hidden[name='nopemesanan_item']").val();
    detailbarangspu(nopemesanan);
});

function getdetail(btn){
    var $btn                  = $(btn);
    var data_nopemesanan      = $btn.attr("data_nopemesanan");
    var data_fromdepartmentid = $btn.attr("data_fromdepartmentid");

    $(":hidden[name='no_pemesanan_upload']").val(data_nopemesanan);
    $(":hidden[name='nopemesanan_item']").val(data_nopemesanan);
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/request/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatarequest").html("");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel = " data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      " data_fromdepartmentid='"+result[i].from_department_id+"'";

                    cito = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
                    spu = result[i].type === "20" ? " <div class='badge badge-light-success fw-bolder'>SPU</div>" : "";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><div>"+(result[i].unit ? result[i].unit : "")+"</div><div>"+result[i].no_pemesanan_unit+"</div>"+spu+"</td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td><div>"+result[i].unitdituju+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }

            $("#resultdatarequest").html(tableresult);

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
			toastr.clear();
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
};

function detailbarangspu(nopemesanan){
    $.ajax({
        url       : url+"index.php/logistik/request/detailbarangspu",
        data      : {nopemesanan:nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdetailspu").html("");
        },
        success: function (data) {
            let result      = "";
            let tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {

                    const stock      = parseFloat(result[i].stock) || 0;
                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) || parseFloat(result[i].qty_minta) || parseFloat(result[i].qty_req) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";

                    // tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].item_id}' name='stock_${result[i].item_id}' value='${todesimal(stock)}' data-validasi='FINANCE' onchange='updateVatAndTotal(this)' disabled></td>`;

                    

                    tableresult += "</tr>";

                }

            }

            $("#resultdetailspu").html(tableresult);
            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
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
    return false;
};