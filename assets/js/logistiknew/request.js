
// Dropzone.autoDiscover = false;
// let myDropzone;

const filteritemname = new Tagify(document.querySelector("#filteritemname"), { enforceWhitelist: true });
const filtercategory = new Tagify(document.querySelector("#filtercategory"), { enforceWhitelist: true });
const filterunit     = new Tagify(document.querySelector("#filterunit"), { enforceWhitelist: true });

datapemesanan();

filteritemname.on('change', filterTable);
filtercategory.on('change', filterTable);
filterunit.on('change', filterTable);

function filterTable() {
    const itemnamefilter = filteritemname.value.map(tag => tag.value);
    const categoryfilter = filtercategory.value.map(tag => tag.value);
    const unitfilter     = filterunit.value.map(tag => tag.value);

    const table = document.getElementById("tablemasterbarang");
    const rows  = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    for (const row of rows) {
        const itemname = row.getElementsByTagName("td")[0].textContent;
        const category = row.getElementsByTagName("td")[1].textContent;
        const unit     = row.getElementsByTagName("td")[2].textContent;

        const showRow = 
            (itemnamefilter.length === 0 || itemnamefilter.includes(itemname)) &&
            (categoryfilter.length === 0 || categoryfilter.includes(category)) &&
            (unitfilter.length === 0 || unitfilter.includes(unit));

        row.style.display = showRow ? "" : "none";
    }
};

$('#modal_new_po').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
});

$('#modal_add_item').on('shown.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');

    var button           = $(event.relatedTarget);
    var datanopemesanan  = button.attr("datanopemesanan");
    var datadepartmentid = button.attr("datadepartmentid");
    var datastatus       = button.attr("datastatus");

    $("input[name='modal_add_item_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_add_item_departmentid']").val(datadepartmentid);

    masterbarang(datanopemesanan,datadepartmentid,datastatus);
    
});

$("#modal_upload_lampiran").on('show.bs.modal', function (event) {
    var button             = $(event.relatedTarget);
    var datanopemesanan    = button.attr("datanopemesanan");
    var dataattachmentnote = button.attr("dataattachmentnote");

    $("input[name='modal_upload_lampiran_nopemesanan']").val(datanopemesanan);
    $("textarea[name='modal_upload_lampiran_note']").val(dataattachmentnote === 'null' ? '' : dataattachmentnote);
});

$("#modal_upload_invoice").on('show.bs.modal', function (event) {
    $(this).find('input[type="text"], input[type="number"], input[type="file"], textarea').val('');
    $(this).find('select').prop('selectedIndex', 0).trigger('change');
    $(this).find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
    
    var button          = $(event.relatedTarget);
    var datanopemesanan = button.attr("datanopemesanan");
    var datainvoiceno   = button.attr("datainvoiceno");

    $("input[name='modal_upload_invoice_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_upload_invoice_invoiceno']").val(datainvoiceno === 'null' ? '' : datainvoiceno);
});

$('#modal_add_item').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

$('#modal_upload_lampiran').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

$('#modal_upload_invoice').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

$('#modal_penerimaan_barang').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

$("#modal_penerimaan_barang").on('show.bs.modal', function (event) {
    var button           = $(event.relatedTarget);
    var datanopemesanan  = button ? button.attr("datanopemesanan") : null;
    var datadepartmentid = button ? button.attr("datadepartmentid") : null;

    if(datanopemesanan){
        $("input[name='no_pemesanan_penerimaan']").val(datanopemesanan);
        $("input[name='no_pemesanan_department']").val(datadepartmentid);
        datapenerimaan(datanopemesanan);
    }
});

$('#modal_add_penerimaan_barang').on('hidden.bs.modal', function () {
    var datanopemesanan= $("input[name='no_pemesanan_penerimaan']").val();
    datapenerimaan(datanopemesanan);
    $('#modal_penerimaan_barang').modal('show');
});

$("#modal_penerimaan_item").on('show.bs.modal', function (event) {
    var button           = $(event.relatedTarget);
    var datanopemesanan  = button ? button.attr("datanopemesanan") : null;
    var datanopenerimaan = button ? button.attr("datanopenerimaan") : null;

    $("input[name='modal_add_item_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_add_item_nopenerimaan']").val(datanopenerimaan);

    detailpembelianitem(datanopemesanan,datanopenerimaan);
});

$('#modal_penerimaan_item').on('hidden.bs.modal', function () {
    var datanopemesanan= $("input[name='no_pemesanan_penerimaan']").val();

    datapenerimaan(datanopemesanan);
    $('#modal_penerimaan_barang').modal('show');
});

function datapemesanan(){
    $.ajax({
        url       : url+"index.php/logistiknew/request/datapemesanan",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdataonprocess").html("");
            $("#resultdataapprove").html("");
            $("#resultdatadecline").html("");
        },
        success:function(data){
            var result              = "";
            var resultdataonprocess = "";
            var resultdataapprove   = "";
            var resultdatadecline   = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " datanopemesananunit='"+result[i].no_pemesanan_unit+"'"+
                                        " datajudulpemesanan='"+result[i].judul_pemesanan+"'"+
                                        " dataattachmentnote='"+result[i].attachment_note+"'"+
                                        " datainvoiceno='"+result[i].invoice_no+"'"+
                                        " datadepartmentid='"+result[i].department_id+"'";

                let rows  ="<tr>";
                    rows +="<td class='ps-4'><div>"+result[i].no_pemesanan_unit+"</div>"+(result[i].cito==="Y"?"<div class='badge badge-light-danger fw-bolder fa-fade me-2'>CITO</div>":"")+"<div class='badge badge-light-"+result[i].colorjenis+"'>"+result[i].namejenis+"</div></td>";
                    rows +="<td><div class='fw-bolder'>"+result[i].judul_pemesanan+"</div><div class='small fst-italic'>"+result[i].note+"</div></td>";
                    rows +="<td>"+result[i].unitpelaksana+"</td>";
                    rows +="<td>"+result[i].namasupplier+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";

                    if(result[i].status === "2" || result[i].status === "4" || result[i].status === "6" || result[i].status === "19" || result[i].status === "21" || result[i].status === "23" || result[i].status === "25" || result[i].status === "27" || result[i].status === "29" || result[i].status === "31"){
                        rows +="<td class='text-end'>"+todesimal(result[i].subtotalterima)+"</td>";
                        rows +="<td class='text-end'>"+todesimal(result[i].hargappnterima)+"</td>";
                        rows +="<td class='text-end'>"+todesimal(result[i].totalterima)+"</td>";
                    }
                    

                    rows +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    rows +="<td class='text-end'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    rows += "<td class='text-end'>";
                        rows +="<div class='btn-group' role='group'>";
                            rows +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            rows +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            
                            if(result[i].status==="0"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_add_item'><i class='bi bi-pencil-square text-primary'></i> Add Item</a>";
                            }

                            if(result[i].methodid==="4"){
                                if(result[i].status==="0"){
                                    if(result[i].invoice==="1"){
                                        rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='2' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    }

                                    if(result[i].jmlitem!="0"){
                                        if(result[i].itemhargakosong==="0"){
                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                        }
                                    }
                                }

                                if(result[i].status==="2"){
                                    rows +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" datastatus='0' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-arrow-counterclockwise text-info'></i> Cancel Approved</a>";
                                }

                                if(result[i].status==="6"){
                                    if(result[i].nopenerimaan!=null){
                                        if(result[i].totalterima!=0){
                                            rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='7' datavalidator='KAINS_INV' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Submission</a>";
                                        }
                                    }
                                    
                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_penerimaan_barang'><i class='bi bi-box-seam text-primary'></i> Penerimaan Barang</a>";
                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                }
                            }

                            if(result[i].methodid==="5" || result[i].methodid==="6" || result[i].methodid==="7" || result[i].methodid==="8" || result[i].methodid==="9" || result[i].methodid==="10" || result[i].methodid==="11" || result[i].methodid==="12" || result[i].methodid==="13" || result[i].methodid==="14"){
                                if(result[i].status==="0"){
                                    if(result[i].jmlitem!="0"){
                                        if(result[i].itemhargakosong==="0"){
                                            rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='2' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                        }
                                    }
                                }

                                if(result[i].status==="2"){
                                    rows +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" datastatus='0' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-arrow-counterclockwise text-info'></i> Cancel Approved</a>";
                                }

                                if(result[i].status==="21" || result[i].status==="29" || result[i].status==="31"){
                                    if(result[i].invoice==="1"){
                                        if(result[i].nopenerimaan!=null){
                                            if(result[i].totalterima!=0){
                                                rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='7' datavalidator='KAINS_INV' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Submission</a>";
                                            }
                                        }
                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_penerimaan_barang'><i class='bi bi-box-seam text-primary'></i> Penerimaan Barang</a>";
                                    }

                                    if(result[i].methodid==="5"){
                                        if(result[i].status==="31"){
                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                        } 
                                    }else{
                                        if(result[i].methodid==="6"){
                                            if(result[i].status==="21"){
                                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                            }
                                        }else{
                                            if(result[i].methodid==="7"){
                                                if(parseFloat(result[i].total)<=2000000){
                                                    if(result[i].status==="21"){
                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                    }
                                                }else{
                                                    if(parseFloat(result[i].total)<=5000000){
                                                        if(result[i].status==="29"){
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                        }  
                                                    }else{
                                                        if(result[i].status==="31"){
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                        }  
                                                    }
                                                }
                                            }else{
                                                if(result[i].methodid==="8"){
                                                    if(result[i].status==="31"){
                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                    }
                                                }else{
                                                    if(result[i].methodid==="9"){
                                                        if(result[i].status==="31"){
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                        }
                                                    }else{
                                                        if(result[i].methodid==="10"){
                                                            if(parseFloat(result[i].total)<=500000){
                                                                if(result[i].status==="21"){
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                }
                                                            }else{
                                                                if(result[i].status==="31"){
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                }
                                                            }
                                                        }else{
                                                            if(result[i].methodid==="11"){
                                                                if(result[i].status==="31"){
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                    rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                }
                                                            }else{
                                                                if(result[i].methodid==="12"){
                                                                    if(result[i].status==="31"){
                                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                        rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                    }
                                                                }else{
                                                                    if(result[i].methodid==="13"){
                                                                        if(result[i].status==="21"){
                                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                        }
                                                                    }else{
                                                                        if(result[i].methodid==="14"){
                                                                            if(result[i].status==="29"){
                                                                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                                                                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }   
                                                    }
                                                }
                                                
                                            }
                                        }
                                    }
                                }
                            }
                            
                            if(result[i].status != "1" && result[i].status != "3" && result[i].status != "5" && result[i].status != "18" && result[i].status != "20" && result[i].status != "28" && result[i].status != "30"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_lampiran' data_attachment_note='"+result[i].attachment_note+"'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload Document</a>";
                            }

                            if(result[i].status==="0"){
                                rows +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='1' datavalidator='KAINS' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Deleted Permanently</a>";
                            }

                            rows +="<div class='separator my-2'></div>";
                            if(result[i].attachment==="1"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdocwithnote(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            }
                            if(result[i].invoice==="1"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdocwithnote(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                            }
                            rows +="<a class='dropdown-item btn btn-sm text-primary' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_chat' "+getvariabel+" onclick='getdatachat($(this));'><i class='bi bi-send text-primary'></i> Pesan Singkat</a>";

                            rows +="</div>";
                        rows +="</div>";
                    rows +="</td>";
                    rows +="</tr>";

                    if(result[i].status === "0"){
                        resultdataonprocess += rows;
                    }else{
                        if(result[i].status === "1" || result[i].status === "3" || result[i].status === "5" || result[i].status === "18" || result[i].status === "20" || result[i].status === "22" || result[i].status === "24" || result[i].status === "26" || result[i].status === "28" || result[i].status === "30"){
                            resultdatadecline += rows;
                        }else{
                            if(result[i].status === "2" || result[i].status === "4" || result[i].status === "6" || result[i].status === "19" || result[i].status === "21" || result[i].status === "23" || result[i].status === "25" || result[i].status === "27" || result[i].status === "29" || result[i].status === "31"){
                                resultdataapprove += rows;
                            }
                        }
                    }
                }
            }

            $("#resultdataonprocess").html(resultdataonprocess);
            $("#resultdatadecline").html(resultdatadecline);
            $("#resultdataapprove").html(resultdataapprove);

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

function datapenerimaan(nopenerimaan){
    $.ajax({
        url       : url+"index.php/logistiknew/request/datapenerimaan",
        data      : {nopenerimaan:nopenerimaan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdatapenerimaan").html("");
        },
        success:function(data){
            var result          = "";
            var resultdatatable = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
                                        " datanopenerimaan='"+result[i].transaksi_id+"'";

                    resultdatatable +="<tr>";
                    resultdatatable +="<td class='ps-4'>"+(result[i].no_penerimaan_unit || "")+"</td>";
                    resultdatatable +="<td>"+result[i].surat_jalan+"</td>";
                    resultdatatable +="<td>"+result[i].note+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    resultdatatable +="<td class='text-end'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
                    resultdatatable +="<td class='text-end'><a href='#' class='btn btn-sm btn-light-primary' data-bs-toggle='modal' data-bs-target='#modal_penerimaan_item' "+getvariabel+"><i class='bi bi-pencil-square'></i> Add Item</a></td>";
                    resultdatatable +="</tr>";
                }
            }

            $("#resultdatapenerimaan").html(resultdatatable);

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

function detailpembelianitem(nopemesanan,nopenerimaan){
    $.ajax({
        url       : url+"index.php/logistiknew/request/detailpembelianitem",
        data      : {nopemesanan:nopemesanan,nopenerimaan:nopenerimaan},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultdetailpembelian").html("");
        },
        success:function(data){
            var result          = "";
            var resultdatatable = "";

            if(data.responCode==="00"){
                result = data.responResult;
                for(var i in result){
                    resultdatatable +="<tr>";
                    resultdatatable +="<td class='ps-4'>"+result[i].namabarang+"</td>";
                    resultdatatable +="<td class='text-end'>"+result[i].qty+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].harga)+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].ppn)+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    resultdatatable +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    resultdatatable +="<td>"+result[i].note+"</td>";

                    if(result[i].qtyterima!=null){
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimaqty_"+result[i].barang_id+"' name='terimaqty_"+result[i].barang_id+"' value='"+todesimal(result[i].qtyterima)+"' onchange='simpanpenerimaan(this)'></td>";
                    }else{
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimaqty_"+result[i].barang_id+"' name='terimaqty_"+result[i].barang_id+"' onchange='simpanpenerimaan(this)'></td>";
                    }

                    if(result[i].hargaterima!=null){
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimaharga_"+result[i].barang_id+"' name='terimaharga_"+result[i].barang_id+"' value='"+todesimal(result[i].hargaterima)+"' onchange='simpanpenerimaan(this)'></td>";
                    }else{
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimaharga_"+result[i].barang_id+"' name='terimaharga_"+result[i].barang_id+"' value='"+todesimal(result[i].harga)+"' onchange='simpanpenerimaan(this)'></td>";
                    }

                    if(result[i].ppnterima!=null){
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimavat_"+result[i].barang_id+"' name='terimavat_"+result[i].barang_id+"'  value='"+result[i].ppnterima+"' onchange='simpanpenerimaan(this)'></td>";
                    }else{
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimavat_"+result[i].barang_id+"' name='terimavat_"+result[i].barang_id+"'  value='"+result[i].ppn+"' onchange='simpanpenerimaan(this)'></td>";
                    }

                    if(result[i].hargappnterima!=null){
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimavatamount_"+result[i].barang_id+"' name='terimavatamount_"+result[i].barang_id+"' value='"+todesimal(result[i].hargappnterima)+"' disabled></td>";
                    }else{
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimavatamount_"+result[i].barang_id+"' name='terimavatamount_"+result[i].barang_id+"' disabled></td>";
                    }

                    if(result[i].totalterima!=null){
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimasubtotal_"+result[i].barang_id+"' name='terimasubtotal_"+result[i].barang_id+"' value='"+todesimal(result[i].totalterima)+"' disabled></td>";
                    }else{
                        resultdatatable +="<td class='text-end'><input class='form-control form-control-sm text-end' id='terimasubtotal_"+result[i].barang_id+"' name='terimasubtotal_"+result[i].barang_id+"' disabled></td>";
                    }
                    
                    resultdatatable +="</tr>";
                }
            }

            $("#resultdetailpembelian").html(resultdatatable);

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

function masterbarang(datanopemesanan,datadepartmentid,datastatus){
    $.ajax({
        url       : url+"index.php/logistiknew/request/masterbarang",
        data      : {datanopemesanan:datanopemesanan,datadepartmentid:datadepartmentid},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultmasterbarang").html("");
        },
        success:function(data){
            var tableresult = "";

            if(data.responCode==="00"){
                var result     = data.responResult;
                var namabarang = new Set();
                var jenis      = new Set();
                var satuan     = new Set();

                for(var i in result){

                    namabarang.add(result[i].nama_barang);
                    jenis.add(result[i].jenis);
                    satuan.add(result[i].satuanbeli);

                    const stock      = parseFloat(result[i].stock) || 0;
                    const qty        = parseFloat(result[i].qty) || 0;
                    const harga      = parseFloat(result[i].harga) || 0;
                    const vatPercent = parseFloat(result[i].ppn) || 0;
                    const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
                    const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));


                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].nama_barang+"</td>";
                    tableresult +="<td>"+(result[i].jenis ? result[i].jenis : "")+"</td>";
                    tableresult +="<td>"+(result[i].satuanbeli ? result[i].satuanbeli : "")+"</td>";


                    if(result[i].stock!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].barang_id}' value='${todesimal(result[i].stock)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='stock_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    if(datastatus==="updateharga"){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].barang_id}' value='${todesimal(result[i].qty)}' disabled></td>`;
                    }else{
                        if(result[i].qty!=null){
                            tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].barang_id}' value='${todesimal(result[i].qty)}' onchange='simpandata(this)'></td>`;
                        }else{
                            tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='qty_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                        }
                    }
                    
                    if(result[i].harga!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].barang_id}' value='${todesimal(result[i].harga)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='harga_${result[i].barang_id}' value='${todesimal(result[i].harga_terakhir)}' onchange='simpandata(this)'></td>`;
                    }

                    if(result[i].ppn!=null){
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].barang_id}' value='${todesimal(result[i].ppn)}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end'><input class='form-control form-control-sm text-end' id='vat_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    tableresult += `<td class='text-end' id='vatamount_${result[i].barang_id}'>${todesimal(vatAmount)}</td>`;
                    tableresult += `<td class='text-end' id='subtotal_${result[i].barang_id}'>${todesimal(subtotal)}</td>`;

                    if(result[i].note!=null){
                        tableresult += `<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='note_${result[i].barang_id}' value='${result[i].note}' onchange='simpandata(this)'></td>`;
                    }else{
                        tableresult += `<td class='text-end pe-4'><input class='form-control form-control-sm text-end' id='note_${result[i].barang_id}' onchange='simpandata(this)'></td>`;
                    }

                    tableresult +="</tr>";
                }
            }

            filteritemname.settings.whitelist = Array.from(namabarang);
            filtercategory.settings.whitelist = Array.from(jenis);
            filterunit.settings.whitelist     = Array.from(satuan);

            $("#resultmasterbarang").html(tableresult);

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

function simpandata(input) {
    const barangid = input.id.split("_")[1];
    const value    = input.value;

    
    if (input.id !== `note_${barangid}` && (isNaN(value) || value.trim() === "")) {
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

    const stockInput       = document.getElementById(`stock_${barangid}`);
    const qtyInput         = document.getElementById(`qty_${barangid}`);
    const hargaInput       = document.getElementById(`harga_${barangid}`);
    const vatElement       = document.getElementById(`vat_${barangid}`);
    const vatAmountElement = document.getElementById(`vatamount_${barangid}`);
    const subtotalElement  = document.getElementById(`subtotal_${barangid}`);
    const note             = document.getElementById(`note_${barangid}`);

    // console.log("DEBUG INPUT ELEMENTS:");
    // console.log("stockInput:", stockInput?.id, "value:", stockInput?.value);
    // console.log("qtyInput:", qtyInput?.id, "value:", qtyInput?.value);
    // console.log("hargaInput:", hargaInput?.id, "value:", hargaInput?.value);
    // console.log("vatElement:", vatElement?.id, "value:", vatElement?.value);
    // console.log("vatAmountElement:", vatAmountElement?.id, "innerText:", vatAmountElement?.innerText);
    // console.log("subtotalElement:", subtotalElement?.id, "innerText:", subtotalElement?.innerText);
    // console.log("note:", note?.id, "value:", note?.value);

    if (stockInput && qtyInput && hargaInput && vatElement && vatAmountElement) {
        const stock = parseFloat(stockInput.value);
        const qty   = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn   = parseFloat(vatElement.value) / 100;

        if (isNaN(qty) || isNaN(harga) || isNaN(ppn)) {
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        const newVat    = parseFloat((qty * (harga * ppn)).toFixed(0));
        const itemTotal = parseFloat(((qty * harga) + newVat).toFixed(0));


        vatAmountElement.innerText = todesimal(newVat);
        subtotalElement.innerText  = todesimal(itemTotal);

        let totalVat   = 0;
        let grandTotal = 0;

        document.querySelectorAll("[id^='vat_amount_']").forEach((vat) => {
            totalVat += parseFloat(vat.innerText.replace(/\./g, "").replace(",", ".")) || 0;
        });

        document.querySelectorAll("[id^='qty_']").forEach((qtyElem) => {
            const id        = qtyElem.id.split("_")[1];
            const hargaElem = document.getElementById(`harga_${id}`);
            const vatElem   = document.getElementById(`vat_${id}`);

            const qtyVal   = parseFloat(qtyElem.value);
            const hargaVal = parseFloat(hargaElem.value.replace(/\./g, "").replace(",", "."));
            const ppnVal   = parseFloat(vatElem.value) / 100;

            if (!isNaN(qtyVal) && !isNaN(hargaVal) && !isNaN(ppnVal)) {
                const vatAmount = qtyVal * (hargaVal * ppnVal);
                const itemTotal = (qtyVal * hargaVal) + vatAmount;

                grandTotal += itemTotal;
            }
        });

        const no_pemesanan = $("#modal_add_item_nopemesanan").val();
        
        $.ajax({
            url     : url + "index.php/logistiknew/request/additem",
            method  : "POST",
            dataType: "JSON",
            data    :
            {
                no_pemesanan: no_pemesanan,
                barangid    : barangid,
                note        : note ? note.value: "",
                stock       : stock,
                qty         : qty,
                harga       : harga,
                ppn         : ppn,
                subtotal    : itemTotal,
                vat_amount  : newVat
            },
            beforeSend: function () {
                toastr.clear();
                toastr.info("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr.clear();
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                    html             : "<b>" + error + "</b>",
                    icon             : "error",
                    confirmButtonText: "Please Try Again",
                    buttonsStyling   : false,
                    timerProgressBar : true,
                    timer            : 5000,
                    customClass      : { confirmButton: "btn btn-danger" },
                    showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                    hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
                });
            }
        });
    }else{
        showAlert(
            "I'm Sorry",
            "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
};

function simpanpenerimaan(input) {
    const barangid     = input.id.split("_")[1];
    const value        = input.value;
    const nopemesanan  = $("#modal_add_item_nopemesanan").val();
    const nopenerimaan = $("#modal_add_item_nopenerimaan").val();

    if ((isNaN(value) || value.trim() === "")) {
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

    const qtyInput         = document.getElementById(`terimaqty_${barangid}`);
    const hargaInput       = document.getElementById(`terimaharga_${barangid}`);
    const vatElement       = document.getElementById(`terimavat_${barangid}`);
    const vatAmountElement = document.getElementById(`terimavatamount_${barangid}`);
    const subtotalElement  = document.getElementById(`terimasubtotal_${barangid}`);

    if(qtyInput && hargaInput && vatElement && vatAmountElement){
        const qty   = parseFloat(qtyInput.value);
        const harga = parseFloat(hargaInput.value.replace(/\./g, "").replace(",", "."));
        const ppn   = parseFloat(vatElement.value) / 100;

        if(isNaN(qty) || isNaN(harga) || isNaN(ppn)){
            console.error("Nilai qty, harga, atau VAT tidak valid.");
            return;
        }

        const newVat    = parseFloat((qty * (harga * ppn)).toFixed(0));
        const itemTotal = parseFloat(((qty * harga) + newVat).toFixed(0));

        vatAmountElement.innerText = todesimal(newVat);
        subtotalElement.innerText  = todesimal(itemTotal);

        let totalVat   = 0;
        let grandTotal = 0;

        // Hitung total PPN dari semua item
        document.querySelectorAll("[id^='terimavatamount_']").forEach((vat) => {
            totalVat += parseFloat(vat.value.replace(/\./g, "").replace(",", ".")) || 0;
        });

        // Hitung subtotal tiap item lalu jumlahkan ke grand total
        document.querySelectorAll("[id^='terimaqty_']").forEach((qtyElem) => {
            const id        = qtyElem.id.split("_")[1];
            const hargaElem = document.getElementById(`terimaharga_${id}`);
            const vatElem   = document.getElementById(`terimavat_${id}`);
            const subtotalElem = document.getElementById(`terimasubtotal_${id}`);
            const vatAmountElem = document.getElementById(`terimavatamount_${id}`);

            const qtyVal   = parseFloat(qtyElem.value) || 0;
            const hargaVal = parseFloat(hargaElem.value.replace(/\./g, "").replace(",", ".")) || 0;
            const ppnVal   = parseFloat(vatElem.value) / 100 || 0;

            if (qtyVal > 0 && hargaVal > 0) {
                const vatAmount = Math.round(qtyVal * (hargaVal * ppnVal));
                const itemTotal = Math.round((qtyVal * hargaVal) + vatAmount);

                // Masukkan ke input value
                vatAmountElem.value = todesimal(vatAmount);
                subtotalElem.value  = todesimal(itemTotal);

                // Tambahkan ke total keseluruhan
                grandTotal += itemTotal;
            }
        });


        $.ajax({
            url     : url + "index.php/logistiknew/request/penerimaanadditem",
            method  : "POST",
            dataType: "JSON",
            data    :
            {
                nopenerimaan:nopenerimaan,
                nopemesanan: nopemesanan,
                barangid   : barangid,
                qty        : qty,
                harga      : harga,
                ppn        : ppn,
                subtotal   : itemTotal,
                vat_amount : newVat
            },
            beforeSend: function () {
                toastr.clear();
                toastr.info("Updating data...", "Please wait");
            },
            success: function (data) {
                toastr.clear();
                toastr[data.responHead](data.responDesc, "INFORMATION");
            },
            error: function (xhr, status, error) {
                showAlert(
                    "I'm Sorry",
                    "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
                    "error",
                    "Please Try Again",
                    "btn btn-danger"
                );
            }
        });

    }else{
        showAlert(
            "I'm Sorry",
            "Element Stock, qty, harga, VAT, atau VAT Amount tidak ditemukan.",
            "error",
            "Please Try Again",
            "btn btn-danger"
        );
    }
    
};

$(document).on("submit", "#formnewpurchaseorder", function (e) {
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
			$("#modal_new_po_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                datapemesanan();
                $("#modal_new_po").modal("hide");
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function(){
            toastr.clear();
            $("#modal_new_po_btn").removeClass("disabled");
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

$(document).on("submit", "#formnewsuratjalan", function (e) {
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
			$("#modal_add_penerimaan_barang_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_add_penerimaan_barang").modal("hide");
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function(){
            toastr.clear();
            $("#modal_add_penerimaan_barang_btn").removeClass("disabled");
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

$(document).on("submit", "#formnotelampiran", function (e) {
    e.preventDefault();

    var form = $(this);
    var url  = form.attr("action");
    var formData = new FormData(this);

    $.ajax({
        url        : url,
        data       : formData,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        contentType: false,
        processData: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#modal_upload_lampiran_btn").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                $('#modal_upload_lampiran').modal('hide');
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            $("#modal_upload_lampiran_btn").removeClass("disabled");
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
});

$(document).on("submit", "#formuploadinvoice", function (e) {
    e.preventDefault();

    var form = $(this);
    var url  = form.attr("action");
    var formData = new FormData(this); // penting!

    $.ajax({
        url        : url,
        data       : formData,
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        contentType: false,
        processData: false,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#modal_upload_invoice_btn").addClass("disabled");
        },
        success: function (data) {
            if (data.responCode == "00") {
                $('#modal_upload_invoice').modal('hide');
            }

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {
            toastr.clear();
            $("#modal_upload_invoice_btn").removeClass("disabled");
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>" + error + "</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : { confirmButton: "btn btn-danger" },
                showClass        : { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass        : { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });

    return false;
});

document.addEventListener("DOMContentLoaded", function() {
    if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
        document.getElementById("modal_upload_invoice_file").removeAttribute("required");
        document.querySelector("label[for=modal_upload_invoice_file]")?.classList.remove("required");
    }
});