datarequest();

function getdetail(btn){
    var $btn             = $(btn);
    var data_nopemesanan = $btn.attr("data_nopemesanan");
    var data_status      = $btn.attr("data_status");

    $(":hidden[name='no_pemesanan']").val(data_nopemesanan);
    $(":hidden[name='no_pemesanan_buktibayar']").val(data_nopemesanan);

    datadetail(data_nopemesanan,data_status);

    var myDropzone = new Dropzone("#file_bukti_bayar", {
        url               : url + "index.php/logistik/request/uploadbuktibayar?no_pemesanan="+data_nopemesanan,
        acceptedFiles     : '.pdf',
        paramName         : "file",
        dictDefaultMessage: "Drop files here or click to upload",
        maxFiles          : 1,
        maxFilesize       : 2,
        addRemoveLinks    : true,
        autoProcessQueue  : true,
        accept            : function(file, done) {
            done();
            $('#modal-upload-buktibayar').modal('hide');
        }
    });
};

function datarequest(){
    $.ajax({
        url       : url+"index.php/logistik/appfinance/datarequest",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            $("#resultappfinance").html("");
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success:function(data){
            var result      = "";
            var tableresult = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){

                    var getvariabel = "data_nopemesanan='"+result[i].no_pemesanan+"'"+
                                      "data_status='"+result[i].status+"'";

                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'><a href='#' data-bs-toggle='modal' data-bs-target='#modal_detail_barang' "+getvariabel+" onclick='getdetail(this)'>"+result[i].no_pemesanan+"</a></td>";
                    tableresult +="<td><div>"+result[i].judul_pemesanan+"<div class='small fst-italic'>"+result[i].note+"</div></td>";
                    tableresult +="<td>"+result[i].unit+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";

                    tableresult += "<td class='text-end'>";
                        tableresult += "<div class='btn-group' role='group'>";
                            tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>View Document</button>";
                            tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                if(result[i].attachment==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>Data Pendukung</a>";
                                }
                                if(result[i].invoice==="1"){
                                    tableresult +="<a class='dropdown-item btn btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>Invoice</a>";
                                }
                                if(result[i].status==="21"){
                                    tableresult +="<a class='dropdown-item btn btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'>Bukti Transfer / Bayar</a>";
                                }
                            tableresult +="</div>";
                        tableresult +="</div>";
                    tableresult +="</td>";
                    
                    tableresult += getStatusBadge(result[i].decoded_status);

                    tableresult += "<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    
                    if(result[i].status!="21"){
                        tableresult += "<td class='text-end'>";
                            tableresult += "<div class='btn-group' role='group'>";
                                tableresult += "<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                                tableresult += "<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                                    if(result[i].status==="4"){
                                        tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+"data_validasi='6' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='5' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled</a>";
                                    }else{
                                        if(result[i].status==="17"){
                                            tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+"data_validasi='19' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved Invoice</a>";
                                            tableresult += "<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" data_validasi='18' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Cancelled Invoice</a>";
                                        }else{
                                            if(result[i].status==="19"){
                                                tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+"data_validasi='20' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Payment Success</a>";
                                            }else{
                                                if(result[i].status==="20"){
                                                    tableresult += "<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal-upload-buktibayar' onclick='getdetail($(this));'><i class='bi bi-cloud-arrow-up text-success'></i> Upload Bukti Transfer / Bayar</a>";
                                                }
                                            }
                                        }
                                    }
                                tableresult +="</div>";
                            tableresult +="</div>";
                        tableresult +="</td>";
                    }else{
                        tableresult +="<td></td>";
                    }
                    

                    tableresult +="</tr>";
                }
            }

            $("#resultappfinance").html(tableresult);
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

function datadetail(data_nopemesanan,data_status) {
    $.ajax({
        url       : url + "index.php/logistik/request/detailbarang",
        data      : { data_nopemesanan: data_nopemesanan },
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
            let tfoot       = "";
            let totalvat    = 0;
            let grandtotal  = 0;

            if (data.responCode === "00") {
                result = data.responResult;
                for (let i in result) {

                    const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) ||parseFloat(result[i].qty_minta) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = qty*(harga*vatPercent/100);
                    const subtotal   = (qty*harga)+vatAmount;

                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
                    tableresult += "<td>" + (result[i].jenis ? result[i].jenis : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanbeli ? result[i].satuanbeli : "") + "</td>";
                    tableresult += "<td>" + (result[i].satuanpakai ? result[i].satuanpakai : "") + "</td>";

                    if(data_status==="4"){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].item_id}' name='qty_${result[i].item_id}' value='${todesimal(qty)}' data-validasi='FINANCE' onchange='updateVatAndTotal(this)'></td>`;
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].item_id}' name='harga_${result[i].item_id}' value='${todesimal(result[i].harga)}' data-validasi='FINANCE' onchange='updateVatAndTotal(this)'></td>`;
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].item_id}' name='vat_${result[i].item_id}' value='${todesimal(vatPercent)}' data-validasi='FINANCE' onchange='updateVatAndTotal(this)'></td>`;
                    } else {
                        tableresult += `<td class='text-end'>${todesimal(qty)}</td>`;
                        tableresult += `<td class='text-end'>${todesimal(result[i].harga)}</td>`;
                        tableresult += `<td class='text-end'>${todesimal(vatPercent)}</td>`;
                    }

                    tableresult += `<td class='text-end' id='vat_amount_${result[i].item_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end pe-4' id='subtotal_${result[i].item_id}'>${todesimal(subtotal)}</td>`;

                    if(data_status === "4"){
                        if(result[i].note!=null){
                            tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' value='${result[i].note}' onchange='updateVatAndTotal(this)'></td>`;
                        }else{
                            tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='note_${result[i].item_id}' onchange='updateVatAndTotal(this)'></td>`;
                        }
                    }else{
                        tableresult += `<td class='text-end'>${result[i].note ? result[i].note : ""}</td>`;
                    }

                    tableresult += "</tr>";

                    totalvat   += vatAmount;
                    grandtotal += subtotal;
                }

                tfoot = `<tr><th class='ps-4' colspan='7'>Grand Total</th><th class='text-end' id='total_vat'>${todesimal(totalvat)}</th><th class='text-end pe-4' id='grand_total'>${todesimal(grandtotal)}</th></tr>`;
            }

            $("#resultdetail").html(tableresult);
            $("#resultdetailfoot").html(tfoot);
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
}