datarequest();

function getdetail(btn){
    var $btn            = $(btn);
    var nopemesanan = $btn.attr("data_nopemesanan");
    var data_status     = $btn.attr("data_status");

    $(":hidden[name='no_pemesanan']").val(nopemesanan);
    datadetail(nopemesanan);
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/penerimaanbarang/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultdatarequest").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var cito = "";
                    var vice = "";
                    var dir  = "";
                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_suppliers='"+result[i].namasupplier+"'"+
                                      "data_createddate='"+result[i].tglbuat+"'"+
                                      "data_attachment_note='"+result[i].attachment_note+"'"+
                                      "data_status='"+result[i].status+"'";

                    if(result[i].cito==="Y"){
                        cito =" <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>";
                    }

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].no_pemesanan_unit+"</td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td>" + (result[i].namasupplier ? result[i].namasupplier : "") + " <div class='badge badge-light-info fw-bolder'>" + (result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : "Unknown") + "</div><div>"+(result[i].invoice_no ? "Invoice no : "+result[i].invoice_no : "")+"</div></td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    
                    tableresult +="<td></td>";

                    tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_detail_barang' onclick='getdetail($(this));'><i class='bi bi-pencil-square text-primary'></i> Accept Goods</a>";
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";

                    tableresult +="</tr>";
                }
            }

            $("#resultdatarequest").html(tableresult);
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

function datadetail(nopemesanan){
    $.ajax({
        url       : url + "index.php/logistik/requestnew/detailbarangspu",
        data      : { nopemesanan:nopemesanan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultdetail").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success: function (data) {
            let result      = "";
            let tableresult = "";

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {
                    const qty        = parseFloat(result[i].qty_minta) || 0;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
                    tableresult += "<td>" + (result[i].jenis ? result[i].jenis : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanbeli ? result[i].satuanbeli : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanpakai ? result[i].satuanpakai : "") + "</td>";
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='order_${result[i].barang_id}' name='order_${result[i].barang_id}' value='${todesimal(result[i].qty_minta)}' disabled></td>`;
                    tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='jmlmasuk_${result[i].barang_id}' name='jmlmasuk_${result[i].barang_id}' value='${todesimal(result[i].jmlmasuk)}' disabled></td>`;
                    if(result[i].qty_minta === result[i].jmlmasuk){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qtyterima_${result[i].barang_id}' name='qtyterima_${result[i].barang_id}' onchange='simpandata(this)' disabled></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qtyterima_${result[i].barang_id}' name='qtyterima_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }
                    
                    tableresult += "</tr>";

                }
            }

            $("#resultdetail").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
        },
        complete: function () {
            toastr.clear();
        }
    });
    return false;
};

function simpandata(input) {
    const barangid = input.id.split("_")[1];
    const value = input.value;

    if (isNaN(value) || value.trim() === "") {
        showAlert(
            "I'm Sorry",
            "Masukkan nilai numerik yang valid!",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
        input.value = "";
        return;
    }

    const qtyterima = document.getElementById(`qtyterima_${barangid}`);
    const jmlmasuk  = document.getElementById(`jmlmasuk_${barangid}`);
    const order     = document.getElementById(`order_${barangid}`);

    if (qtyterima && jmlmasuk && order) {
        const qtyTerimaValue = parseFloat(qtyterima.value) || 0;
        const jmlMasukValue = parseFloat(jmlmasuk.value) || 0;
        const orderValue = parseFloat(order.value) || 0;

        // Proteksi untuk mencegah nilai melebihi order_
        if (jmlMasukValue + qtyTerimaValue > orderValue) {
            showAlert(
                "Invalid Input",
                "Jumlah barang diterima melebihi jumlah yang dipesan!",
                "error",
                "Please Try Again",
                "btn btn-danger"
            );
            input.value = "";
            return 0;
        }

        const no_pemesanan = $("#no_pemesanan").val();

        $.ajax({
            url: url + "index.php/logistik/requestnew/terimabarang",
            method: "POST",
            dataType: "JSON",
            data: {
                no_pemesanan: no_pemesanan,
                barangid: barangid,
                qty: qtyTerimaValue
            },
            beforeSend: function () {
                toastr.clear();
                toastr.info("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                toastr.error("Terjadi kesalahan: " + error, "Error");
            }
        });
    } else {
        showAlert(
            "I'm Sorry",
            "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
};
