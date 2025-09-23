// Dropzone.autoDiscover = false;
// let myDropzone;

// dataapprove();
// datadecline();
// dataonprocess();

// function viewdoc(btn) {
//     var filename     = $(btn).attr("data-dirfile");
//     var note         = $(btn).attr("data_attachment_note");
//     var filename     = filename.replace('/www/wwwroot/', 'http://');
//     var responsefile = jQuery.ajax({url: filename,type: 'HEAD',async: false}).status;

//     $("textarea[name='modal_view_pdf_note']").val(note === 'null' ? '' : note);

//     if(responsefile === 200){
//         var viewfile = "<embed src='"+filename+"' width='100%' height='100%' type='application/pdf' id='view'>";
//         $("#viewdocnote").html(viewfile);
//         $('#openInNewTabButton').data('filename', filename);
//     } else {
//         var viewfile = `
//             <div class='alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
//                 <span class='svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0'>
//                     <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
//                         <path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
//                         <path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
//                     </svg>
//                 </span>
//                 <div class='d-flex flex-column pe-0 pe-sm-10'>
//                     <h5 class='mb-1'>For Your Information</h5>
//                     <span>File Tidak Di Temukan, Silakan Periksa Kembali</span>
//                 </div>
//             </div>
//         `;
//         $("#viewdocnote").html(viewfile);
//         $('#openInNewTabButton').data('filename', '');
//     }
// };

// $("#modal_upload_invoice").on('show.bs.modal', function (event) {
//     var button          = $(event.relatedTarget);
//     var datanopemesanan = button.attr("datanopemesanan");
//     var datainvoiceno   = button.attr("datainvoiceno");

//     $("input[name='modal_upload_invoice_nopemesanan']").val(datanopemesanan);
//     $("input[name='modal_upload_invoice_invoiceno']").val(datainvoiceno === 'null' ? '' : datainvoiceno);

//     if(myDropzone){
//         myDropzone.destroy();
//     }

//     myDropzone = new Dropzone("#file_invoice", {
//         url               : url + "index.php/paymentponew/paymentrequest/uploadinvoice?datanopemesanan=" + datanopemesanan,
//         acceptedFiles     : '.pdf',
//         paramName         : "file",
//         dictDefaultMessage: "Drop files here or click to upload",
//         maxFiles          : 1,
//         maxFilesize       : 2,
//         addRemoveLinks    : true,
//         autoProcessQueue  : true,
//         accept: function (file, done) {
//             done();
//         }
//     });
// });

// $("#modal_print_po").on('show.bs.modal', function(event){
//     var button              = $(event.relatedTarget);
//     var datanopemesanan     = button.attr("datanopemesanan");
//     var datanopemesananunit = button.attr("datanopemesananunit");
//     var datasupplier        = button.attr("datasupplier");
//     var datatglorder        = button.attr("datatglorder");

//     $("#pono").html(datanopemesananunit);
//     $("#suppliers").html(datasupplier);
//     $("#orderdate").html(datatglorder);

//     printpo(datanopemesanan);
// });

// function printpo(nopemesanan){
//     $.ajax({
//         url       : url+"index.php/paymentponew/paymentrequest/detailbarangpemesanan",
//         data      : {nopemesanan:nopemesanan},
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultdetailpo").html("");
//         },
//         success: function (data) {
//             let result      = "";
//             let tableresult = "";
//             let ttdkains    = "";
//             let ttdmanager  = "";
//             let totalvat    = 0;
//             let grandtotal  = 0;

//             if (data.responCode === "00") {
//                 result = data.responResult;
//                 for (let i in result) {
//                     const stock      = parseFloat(result[i].stock) || 0;
//                     const qty        = parseFloat(result[i].qty_dir) || parseFloat(result[i].qty_wadir) || parseFloat(result[i].qty_keu) || parseFloat(result[i].qty_manager) ||parseFloat(result[i].qty_minta) || 0;
//                     const harga      = parseFloat(result[i].harga) || 0;
//                     const vatPercent = parseFloat(result[i].ppn) || 0;
//                     const vatAmount  = parseFloat((qty * (harga * vatPercent / 100)).toFixed(0));
//                     const subtotal   = parseFloat(((qty * harga) + vatAmount).toFixed(0));

//                     tableresult += "<tr>";
//                     tableresult += "<td class='ps-4'>" + result[i].namabarang + "</td>";
//                     tableresult += `<td>${result[i].note ? result[i].note : ""}</td>`;
//                     tableresult += `<td class='text-end pe-4'>${todesimal(qty)}</td>`;
//                     tableresult += "</tr>";

//                     totalvat   += vatAmount;
//                     grandtotal += subtotal;

//                     ttdkains   = result[i].createdby;
//                     ttdmanager = result[i].manager;
//                 }
//             }

//             $("#resultdetailpo").html(tableresult);
//             $("#ttdkains").html(ttdkains);
//             $("#ttdmanager").html(ttdmanager);

//             toastr.clear();
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
//             toastr.clear();
//         },
//         error: function (xhr, status, error) {
//             toastr["error"]("Terjadi kesalahan : " + error, "Opps !");
//         }
//     });
//     return false;
// };

// function printPDF() {
//     var printContents = document.querySelector('#modal_print_po .modal-body').innerHTML;
//     var printWindow = window.open('', '', 'height=700,width=900');
//     printWindow.document.write('<html>');
//         printWindow.document.write('<head>');
//             printWindow.document.write('<title>Purchase Request</title>');

//             printWindow.document.write('<style>');
//                 // Global styles
//                 printWindow.document.write('body, * { font-size: 10px; font-family: Arial, sans-serif; margin: 0; padding: 0; }');
//                 printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
//                 printWindow.document.write('th, td { padding: 5px; }');
//                 printWindow.document.write('h1 { font-size: 30px; text-align: center; }');
//                 printWindow.document.write('h6 { font-size: 10px; text-align: left; }');
//                 printWindow.document.write('img { height: 60px; display: block; margin: 0 auto; }');

//                 // Styles specific to the header table
//                 printWindow.document.write('#tableheader { border: none; }');
//                 printWindow.document.write('#tableheader th, #tableheader td { border: none; }');

//                 // Ensure other tables retain their borders
//                 printWindow.document.write('table:not(#tableheader), table:not(#tableheader) th, table:not(#tableheader) td { border: 1px solid black; }');

//                 // Full-page layout for print
//                 printWindow.document.write('@page { size: A4; margin: 0; }');
//                 printWindow.document.write('body { margin: 0; }');
//             printWindow.document.write('</style>');

//         printWindow.document.write('</head>');
//         printWindow.document.write('<body>');
        
//             // Konten untuk dicetak
//             printWindow.document.write(printContents);
        
//         printWindow.document.write('</body>');
//     printWindow.document.write('</html>');
//     printWindow.document.close();
//     printWindow.print();
// };

// function dataonprocess(){
//     $.ajax({
//         url       : url+"index.php/paymentponew/paymentrequest/dataonprocess",
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultdataonprocess").html("");
//         },
//         success:function(data){
//             var result      = "";
//             var tableresult = "";

//             if(data.responCode==="00"){
//                 result = data.responResult;
//                 for(var i in result){

//                     cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
//                     carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

//                     var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
//                                         " dataattachmentnote='"+result[i].attachment_note+"'"+
//                                         " datainvoiceno='"+result[i].invoice_no+"'"+
//                                         " datadepartmentid='"+result[i].department_id+"'";

//                     tableresult +="<tr>";
//                     tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
//                     tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
//                     tableresult +="<td>"+result[i].unitdituju+"</td>";
//                     tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
//                     tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
//                     tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
//                     tableresult += "<td class='text-end'>";
//                         tableresult +="<div class='btn-group' role='group'>";
//                             tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
//                             tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
//                             tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
//                             if(result[i].invoice==="1"){
//                                 tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
//                             }
//                             if(result[i].attachment==="1"){
//                                 tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
//                             }
//                             tableresult +="</div>";
//                         tableresult +="</div>";
//                     tableresult +="</td>";
//                     tableresult +="</tr>";
//                 }
//             }

//             $("#resultdataonprocess").html(tableresult);

//             toastr.clear();
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
// 			toastr.clear();
// 		},
//         error: function(xhr, status, error) {
//             showAlert(
//                 "I'm Sorry",
//                 error,
//                 "error",
//                 "Please Try Again",
//                 "btn btn-danger"
//             );
// 		}
//     });
//     return false;
// };

// function dataapprove(){
//     $.ajax({
//         url       : url+"index.php/paymentponew/paymentrequest/dataapprove",
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultdataapprove").html("");
//         },
//         success:function(data){
//             var result      = "";
//             var tableresult = "";

//             if(data.responCode==="00"){
//                 result = data.responResult;
//                 for(var i in result){

//                     cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
//                     carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

//                     var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
//                                         " datanopemesananunit='"+result[i].no_pemesanan_unit+"'"+
//                                         " dataattachmentnote='"+result[i].attachment_note+"'"+
//                                         " datainvoiceno='"+result[i].invoice_no+"'"+
//                                         " datadepartmentid='"+result[i].department_id+"'"+
//                                         " datajudulpemesanan='"+result[i].judul_pemesanan+"'"+
//                                         " datacatatanpemesanan='"+result[i].note+"'"+
//                                         " datacatatankeuangan='"+result[i].inv_keu_note+"'"+
//                                         " datasupplier='"+result[i].namasupplier+"'"+
//                                         " datatglorder='"+result[i].tglorder+"'"+
//                                         " datanominal='"+result[i].total+"'";

//                     tableresult +="<tr>";
//                     tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
//                     tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
//                     tableresult +="<td>"+result[i].unitdituju+"</td>";
//                     tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
//                     tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
//                     if(result[i].status==="11"){
//                         tableresult +="<td><div>"+result[i].vicename+"<div>"+result[i].tglvice+"</div></td>";
//                     }else{
//                         if(result[i].status==="13"){
//                             tableresult +="<td><div>"+result[i].dirname+"<div>"+result[i].tgldir+"</div></td>";
//                         }else{
//                             if(result[i].status==="15"){
//                                 tableresult +="<td><div>"+result[i].disetujuikeuoleh+"<div>"+result[i].tglkeuangan+"</div></td>";
//                             }else{
//                                 if(result[i].status==="16" || result[i].status==="17"){
//                                     tableresult +="<td><div>"+(result[i].dibayarkanoleh || result[i].disetujuikeuoleh)+"<div>"+(result[i].tgldibayar || result[i].tglkeuangan)+"</div></td>";
//                                 }else{
//                                     tableresult +="<td><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
//                                 }
//                             }
//                         }
                        
//                     }
                    
                    
                    
//                     tableresult += "<td class='text-end'>";
//                         tableresult +="<div class='btn-group' role='group'>";
//                             tableresult +="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
//                             tableresult +="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
//                             tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
//                             tableresult +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print Purchase Order</a>";
//                             if(result[i].status==="17"){
//                                 tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].inv_keu_note+"' data-dirfile='"+url+"assets/buktitransfer/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View File Transfer</a>";
//                             }
//                             if(result[i].invoice==="1"){
//                                 tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='"+result[i].invoice_no+"' data-dirfile='"+url+"assets/invoice/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View invoice</a>";
//                             }
//                             if(result[i].attachment==="1"){
//                                 tableresult +="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' "+getvariabel+" data_attachment_note='"+result[i].attachment_note+"' data-dirfile='"+url+"assets/documentpo/"+result[i].no_pemesanan+".pdf' onclick='viewdoc(this)'><i class='bi bi-eye text-primary'></i> View Document</a>";
//                             }
//                             tableresult +="</div>";
//                         tableresult +="</div>";
//                     tableresult +="</td>";
//                     tableresult +="</tr>";
//                 }
//             }

//             $("#resultdataapprove").html(tableresult);

//             toastr.clear();
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
// 			toastr.clear();
// 		},
//         error: function(xhr, status, error) {
//             showAlert(
//                 "I'm Sorry",
//                 error,
//                 "error",
//                 "Please Try Again",
//                 "btn btn-danger"
//             );
// 		}
//     });
//     return false;
// };

// function datadecline(){
//     $.ajax({
//         url       : url+"index.php/paymentponew/paymentrequest/datadecline",
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
//             $("#resultdatadecline").html("");
//         },
//         success:function(data){
//             var result      = "";
//             var tableresult = "";

//             if(data.responCode==="00"){
//                 result = data.responResult;
//                 for(var i in result){

//                     cito      = result[i].cito === "Y" ? " <div class='badge badge-light-danger fw-bolder fa-fade'>CITO</div>" : "";
//                     carabayar = result[i].method ? `<div class='badge badge-light-info fw-bolder'>${result[i].method === "1" ? "Invoice" : result[i].method === "2" ? "Cash / Bon" : result[i].method === "3" ? "Invoice dan Cash / Bon" : result[i].method === "4" ? "On The Spot (BBM / Snack / Etc)" : "Unknown"}</div>` : "";

//                     var getvariabel =   " datanopemesanan='"+result[i].no_pemesanan+"'"+
//                                         " dataattachmentnote='"+result[i].attachment_note+"'"+
//                                         " datainvoiceno='"+result[i].invoice_no+"'"+
//                                         " datadepartmentid='"+result[i].department_id+"'";

//                     tableresult +="<tr>";
//                     tableresult += "<td class='ps-2'><div>" + result[i].no_pemesanan_unit + "</div><div class='badge badge-light-primary fw-bolder'>"+(result[i].type === "1" ? "Invoice" : "Purchase order") + "</div></td>";
//                     tableresult +="<td><div>"+result[i].judul_pemesanan+cito+"<div class='small fst-italic'>"+result[i].note+"</div></td>"; 
//                     tableresult +="<td>"+result[i].unitdituju+"</td>";
//                     tableresult +="<td><div>"+result[i].namasupplier+"</div><div>"+carabayar+"</div></td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].subtotal)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].harga_ppn)+"</td>";
//                     tableresult +="<td class='text-end'>"+todesimal(result[i].total)+"</td>";
//                     tableresult +="<td><div class='badge badge-light-"+result[i].colorstatus+"'>"+result[i].namestatus+"</div></td>";
//                     tableresult +="<td class='text-end pe-4'><div>"+result[i].dibuatoleh+"<div>"+result[i].tglbuat+"</div></td>";
//                     tableresult +="</tr>";
//                 }
//             }

//             $("#resultdatadecline").html(tableresult);

//             toastr.clear();
//             toastr[data.responHead](data.responDesc, "INFORMATION");
//         },
//         complete: function () {
// 			toastr.clear();
// 		},
//         error: function(xhr, status, error) {
//             showAlert(
//                 "I'm Sorry",
//                 error,
//                 "error",
//                 "Please Try Again",
//                 "btn btn-danger"
//             );
// 		}
//     });
//     return false;
// };

// $(document).on("submit", "#formnoinvoice", function (e) {
// 	e.preventDefault();
//     e.stopPropagation();
// 	var form = $(this);
//     var url  = $(this).attr("action");
// 	$.ajax({
//         url       : url,
//         data      : form.serialize(),
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Sending request...", "Please wait");
// 			$("#modal_upload_invoice_btn").addClass("disabled");
//         },
// 		success: function (data) {

//             if(data.responCode == "00"){
//                 $("#modal_upload_invoice").modal("hide");
//                 dataonprocess();
//                 dataapprove();
// 			}

//             toastr.clear();
//             toastr[data.responHead](data.responDesc, "INFORMATION");
// 		},
//         complete: function () {
//             $("#modal_upload_invoice_btn").removeClass("disabled");
// 		},
//         error: function(xhr, status, error) {
//             showAlert(
//                 "I'm Sorry",
//                 error,
//                 "error",
//                 "Please Try Again",
//                 "btn btn-danger"
//             );
// 		}
// 	});
//     return false;
// });

datapemesanan();

$("#modal_upload_invoice").on('show.bs.modal', function (event) {
    var button          = $(event.relatedTarget);
    var datanopemesanan = button.attr("datanopemesanan");
    var datainvoiceno   = button.attr("datainvoiceno");

    $("input[name='modal_upload_invoice_nopemesanan']").val(datanopemesanan);
    $("input[name='modal_upload_invoice_invoiceno']").val(datainvoiceno === 'null' ? '' : datainvoiceno);
});

$('#modal_upload_invoice').on('hidden.bs.modal', function (e) {
    datapemesanan();
});

function datapemesanan(){
    $.ajax({
        url       : url+"index.php/paymentponew/paymentrequest/datapemesanan",
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
                            rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_print_po'><i class='bi bi-printer text-primary'></i> Print PO</a>";
                            if(result[i].status==="7" || result[i].status==="13"){
                                rows +="<a class='dropdown-item btn btn-sm text-primary' "+getvariabel+" data-bs-toggle='modal' data-bs-target='#modal_upload_invoice'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload invoice</a>";
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

                    if(result[i].status === "7"){
                        resultdataonprocess += rows;
                    }else{
                        if(result[i].status === "8" || result[i].status === "10" || result[i].status === "12" || result[i].status === "32" || result[i].status === "34" || result[i].status === "36"){
                            resultdatadecline += rows;
                        }else{
                            if(result[i].status === "9" || result[i].status === "11" || result[i].status === "13" || result[i].status === "33" || result[i].status === "35" || result[i].status === "37"){
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