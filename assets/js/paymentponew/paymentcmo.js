let today     = new Date();
let startDate = today.toISOString().split('T')[0];
let endDate   = today.toISOString().split('T')[0];

datapemesanan(startDate,endDate);

function datapemesanan(startDate,endDate){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentcmo/datapemesanan",
        data      : {startDate:startDate,endDate:endDate},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            showLoading("Mohon Tunggu...", "Permintaan sedang dikirim...");
            $("#resultdataonprocess").html("");
            $("#resultdataapprove").html("");
            $("#resultdatadecline").html("");
        },
        success:function(data){
            showLoading("Menyiapkan Data", "Sebentar ya, data sedang dimuat...");
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
                    rows +="<td class='text-end'>"+todesimal(result[i].subtotalterima)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].hargappnterima)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].totalterima)+"</td>";
                    rows +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    rows +="<td class='text-end'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    rows += "<td class='text-end'>";
                        rows +="<div class='btn-group' role='group'>";
                            rows +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            rows +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            
                            if(result[i].status==="35"){
                                rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='37' datavalidator='CMO_INV' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Invoice Approved</a>";
                                rows +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='36' datavalidator='CMO_INV' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Invoice Decline</a>";
                            }

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

                    if(result[i].status === "35"){
                        resultdataonprocess += rows;
                    }else{
                        if(result[i].status === "14" || result[i].status === "36"){
                            resultdatadecline += rows;
                        }else{
                            if(result[i].status === "15" || result[i].status === "16" || result[i].status === "17" || result[i].status === "36"){
                                resultdataapprove += rows;
                            }
                        }
                    }
                }
            }

            $("#resultdataonprocess").html(resultdataonprocess);
            $("#resultdatadecline").html(resultdatadecline);
            $("#resultdataapprove").html(resultdataapprove);
        },
        complete: function () {
			Swal.close();
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