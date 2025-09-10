datapemesanan();

$("#modal_master_detail_spu").on('shown.bs.modal', function(event){
    var button           = $(event.relatedTarget);
    var datanopemesanan  = button.attr("datanopemesanan");
    
    $(":hidden[name='nopemesanan_item']").val(datanopemesanan);
    detailbarangspu(datanopemesanan,"KOORDINATOR");
});

$('#modal_master_detail_spu').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

function datapemesanan(){
    $.ajax({
        url       : url+"index.php/logistiknew/approvalkoordinator/datapemesanan",
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
                    rows +="<td class='ps-4'>"+result[i].no_pemesanan_unit+"</td>";
                    rows += "<td>"+(result[i].cito==="Y"?"<div class='badge badge-light-danger fw-bolder fa-fade me-2'>CITO</div>":"")+"<div class='badge badge-light-"+result[i].colorjenis+"'>"+result[i].namejenis+"</div><div class='fw-bolder'>"+result[i].judul_pemesanan+"</div><div class='small fst-italic'>"+result[i].note+"</div></td>";
                    rows +="<td>"+result[i].unitpelaksana+"</td>";
                    rows +="<td>"+result[i].namasupplier+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
                    rows +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
                    rows +="<td class='text-end'><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
                    rows +="<td class='text-end'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";

                    rows += "<td class='text-end'>";
                        rows +="<div class='btn-group' role='group'>";
                            rows +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            rows +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";

                            if(result[i].status==="2"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_master_detail_spu'><i class='bi bi-pencil-square text-primary'></i> Update Item</a>";
                            }

                            if(result[i].methodid==="4"){
                                if(result[i].status==="2"){
                                    rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='19' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    rows +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='18' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="19"){
                                    rows +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" datastatus='2' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-arrow-counterclockwise text-info'></i> Cancel Approved</a>";
                                }
                            }

                            if(result[i].methodid==="5" || result[i].methodid==="6" || result[i].methodid==="7" || result[i].methodid==="8" || result[i].methodid==="9" || result[i].methodid==="10" || result[i].methodid==="11" || result[i].methodid==="12" || result[i].methodid==="13" || result[i].methodid==="14"){
                                if(result[i].status==="2"){
                                    rows +="<a class='dropdown-item btn btn-sm text-success' "+getvariabel+" datastatus='19' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-check2-circle text-success'></i> Approved</a>";
                                    rows +="<a class='dropdown-item btn btn-sm text-danger' "+getvariabel+" datastatus='18' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-trash-fill text-danger'></i> Decline</a>";
                                }

                                if(result[i].status==="19"){
                                    rows +="<a class='dropdown-item btn btn-sm text-info' "+getvariabel+" datastatus='2' datavalidator='KOORDINATOR' onclick='validasi($(this));'><i class='bi bi-arrow-counterclockwise text-info'></i> Cancel Approved</a>";
                                }
                            }

                            

                            rows +="<div class='separator my-2'></div>";
                            if(result[i].attachment==="1"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdocwithnote(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
                            }
                            if(result[i].invoice==="1"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdocwithnote(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
                            }
                            rows += "<a class='dropdown-item btn btn-sm text-primary' data-kt-drawer-show='true' data-kt-drawer-target='#drawer_chat' "+getvariabel+" onclick='getdatachat($(this));'><i class='bi bi-send text-primary'></i> Pesan Singkat</a>";
                            
                            rows +="</div>";
                        rows +="</div>";
                    rows +="</td>";
                    rows +="</tr>";

                    if(result[i].status === "2"){
                        resultdataonprocess += rows;
                    }else{
                        if(result[i].status === "3" || result[i].status === "5" || result[i].status === "18" || result[i].status === "20" || result[i].status === "22" || result[i].status === "24" || result[i].status === "26" || result[i].status === "28" || result[i].status === "30"){
                            resultdatadecline += rows;
                        }else{
                            if(result[i].status === "4" || result[i].status === "6" ||result[i].status === "19" || result[i].status === "21" || result[i].status === "23" || result[i].status === "25" || result[i].status === "27" || result[i].status === "29" || result[i].status === "31"){
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