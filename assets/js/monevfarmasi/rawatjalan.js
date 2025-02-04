datamonev();

function datamonev(){
    $.ajax({
        url       : url+"index.php/monevfarmasi/rawatjalan/datamonev",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#dataanalyst").html("");
        },
        success: function (data) {
            var tableresult = "";
            var lastpoli = null;
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                var totalModal, totalJual, totalObat7, totalObat23;
                var tbodyContent = "";
        
                for (var i in result) {
                    var currentPoli = result[i].poliid + "-" + result[i].dokterid + "-" + result[i].norm;
        
                    if (lastpoli !== currentPoli) {
                        if (lastpoli !== null) {
                            tableresult += tbodyContent;
        
                            tableresult += "</tbody><tfoot class='text-gray-600 fw-bold table-warning'>";
                            tableresult += "<tr>";
                            tableresult += "<td class='text-center' colspan='3'>TOTAL</td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalModal) + "</td>";
                            tableresult += "<td class='text-end'></td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalJual) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalObat7) + "</td>";
                            tableresult += "<td class='pe-4 rounded-end text-end'>" + todesimal(totalObat23) + "</td>";
                            tableresult += "</tr>";
                            tableresult += "</tfoot>";
                            tableresult += "</table>";

                            tableresult +="<div class='col-xl-6 mb-20'>";
                                tableresult +="<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                                    tableresult +="<thead>";
                                        tableresult +="<tr class='fw-bolder text-muted bg-light'>";
                                            tableresult +="<th class='text-center ps-4 rounded-start' colspan='2'>Pendapatan</th>";
                                            tableresult +="<th class='text-center pe-4 rounded-end' colspan='2'>Pengeluaran</th>";
                                        tableresult +="</tr>";
                                    tableresult +="</thead>";
                                    tableresult +="<tbody class='text-gray-600 fw-bold'>";
                                        tableresult +="<tr>";
                                            tableresult +="<td class='ps-4'>Klaim Obat Kronis</td>";
                                            tableresult +="<td>"+todesimal(totalObat23)+"</td>";
                                            tableresult +="<td>Registrasi</td>";
                                            tableresult +="<td>"+todesimal(biaya_reg)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td class='ps-4'>Klaim Rajal Biasa</td>";
                                            tableresult +="<td>"+todesimal(biaya_klaim)+"</td>";
                                            tableresult +="<td>Jasa Dokter</td>";
                                            tableresult +="<td>"+todesimal(biaya_dokter)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td>Total Modal Obat</td>";
                                            tableresult +="<td>"+todesimal(totalModal)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>"; 
                                            tableresult +="<td class='ps-4'>Tindakan</td>";
                                            tableresult +="<td>"+todesimal(biaya_tindakan)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>"; 
                                            tableresult +="<td class='ps-4'>Laboratorium</td>";
                                            tableresult +="<td>"+todesimal(biaya_lab)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>"; 
                                            tableresult +="<td class='ps-4'>Radiologi</td>";
                                            tableresult +="<td>"+todesimal(biaya_rad)+"</td>";
                                        tableresult +="</tr>";
                                    tableresult +="</tbody>";
                                    tableresult +="<tfoot class='text-gray-600 fw-bold table-warning'>";
                                        tableresult +="<tr>";
                                            tableresult +="<td class='ps-4'>Total Klaim Per Episode</td>";
                                            tableresult +="<td class='ps-4'>"+todesimal(parseFloat(totalObat23)+parseFloat(biaya_klaim))+"</td>";
                                            tableresult +="<td class='pe-4'>Total Pengeluaran</td>";
                                            tableresult +="<td class='pe-4'>"+todesimal(biaya_totalbiiling)+"</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                        if(parseFloat(biaya_totalbiiling) <  (parseFloat(totalObat23)+parseFloat(biaya_klaim))){
                                            tableresult +="<td class='ps-4 table-success rounded-start rounded-end' colspan='4'>Potensi Keuntungan : "+todesimal(((parseFloat(totalObat23)+parseFloat(biaya_klaim))-biaya_totalbiiling))+"</td>";
                                        }else{
                                            tableresult +="<td class='ps-4 table-danger rounded-start rounded-end' colspan='4'>Potensi Kerugian : - "+todesimal(((parseFloat(totalObat23)+parseFloat(biaya_klaim))-biaya_totalbiiling))+"</td>";
                                        }  
                                        tableresult +="</tr>";
                                    tableresult +="</tfoot>";
                                tableresult +="</table>";
                            tableresult +="</div>";
                        }
        
                        totalModal   = 0;
                        totalJual    = 0;
                        totalObat7   = 0;
                        totalObat23  = 0;
                        tbodyContent = "";
        
                        tableresult += "<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                        tableresult += "<thead>";
                        tableresult += "<tr class='fw-bolder text-muted bg-light align-middle table-info'>";
                        tableresult += "<th class='ps-4 rounded-start min-w-100px' rowspan='2'>Transaction</th>";
                        tableresult += "<th class='text-start' rowspan='2'>Medical Record</th>";
                        tableresult += "<th class='text-start min-w-250px' rowspan='2'>Patient Name</th>";
                        tableresult += "<th class='text-start min-w-250px' rowspan='2'>Doctor</th>";
                        tableresult += "<th class='pe-4 rounded-end text-center' colspan='7'>Bills</th>";
                        tableresult += "</tr>";
        
                        tableresult += "<tr class='fw-bolder text-muted bg-light align-middle table-info'>";
                        tableresult += "<th class='text-end'>Registration</th>";
                        tableresult += "<th class='text-end'>Consultation</th>";
                        tableresult += "<th class='text-end'>Treatment</th>";
                        tableresult += "<th class='text-end'>Pharmacy</th>";
                        tableresult += "<th class='text-end'>Laboratory</th>";
                        tableresult += "<th class='text-end'>Radiology</th>";
                        tableresult += "<th class='pe-4 rounded-end text-end'>Total</th>";
                        tableresult += "</tr>";
                        tableresult += "</thead>";
        
                        tableresult += "<tbody class='text-gray-600 fw-bold'>";
                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4'><div>" + result[i].tgl_perawatan + "</div><div>" + result[i].no_rawat + "</div></td>";
                        tableresult += "<td>" + result[i].norm + "</td>";
                        tableresult += "<td>" + result[i].namapasien + "</td>";
                        tableresult += "<td>" + result[i].namadokter + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].reg) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].dokter) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].tindakan) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].obat) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].lab) + "</td>";
                        tableresult += "<td class='text-end'>" + todesimal(result[i].rad) + "</td>";
                        tableresult += "<td class='pe-4 text-end'>" + todesimal(result[i].totalbilling) + "</td>";
                        tableresult += "</tr>";
                        tableresult += "</tbody>";
                        tableresult += "</table>";

                        tableresult += "<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                        tableresult += "<thead>";
                        tableresult += "<tr class='fw-bolder text-muted bg-light'>";
                        tableresult += "<th class='ps-4 rounded-start rounded-end table-info' colspan='8'>Pharmacy Analyst</th>";
                        tableresult += "</tr>";
                        tableresult += "<tr class='fw-bolder text-muted bg-light'>";
                        tableresult += "<th class='ps-4 rounded-start align-middle' rowspan='2'>Nama Obat</th>";
                        tableresult += "<th class='text-center' rowspan='2'>Qty</th>";
                        tableresult += "<th class='text-center' colspan='2'>Modal</th>";
                        tableresult += "<th class='text-center' colspan='2'>Jual</th>";
                        tableresult += "<th class='text-end align-middle' rowspan='2'>Obat 7 Hari</th>";
                        tableresult += "<th class='rounded-end text-end pe-4 align-middle' rowspan='2'>Obat 23 Hari</th>";
                        tableresult += "</tr>";
                        tableresult += "<tr class='fw-bolder text-muted bg-light'>";
                        tableresult += "<th class='text-end'>Satuan</th>";
                        tableresult += "<th class='text-end'>Total</th>";
                        tableresult += "<th class='text-end'>Satuan</th>";
                        tableresult += "<th class='text-end'>Total</th>";
                        tableresult += "</tr>";
                        tableresult += "</thead>";
                        tableresult += "<tbody class='text-gray-600 fw-bold' id='" + currentPoli + "'>";

                        biaya_reg          = result[i].reg;
                        biaya_dokter       = result[i].dokter;
                        biaya_tindakan     = result[i].tindakan;
                        biaya_obat         = result[i].obat;
                        biaya_lab          = result[i].lab;
                        biaya_rad          = result[i].rad;
                        biaya_totalbiiling = result[i].totalbilling;
                        biaya_klaim        = result[i].hargaklaim;
                    }
        
                    // Update total per poli-dokter
                    totalModal  += parseFloat(result[i].totalmodal) || 0;
                    totalJual   += parseFloat(result[i].totaljual) || 0;
                    totalObat7  += parseFloat(result[i].obat_7) || 0;
                    totalObat23 += parseFloat(result[i].obat_23) || 0;

                    
        
                    // Tambahkan detail obat ke tbodyContent
                    tbodyContent += "<tr>";
                    tbodyContent += "<td class='ps-4 min-w-350px'>" + result[i].namaobat + "</td>";
                    tbodyContent += "<td class='text-center'>" + (todesimal(result[i].jml) || '0') + "</td>";
                    tbodyContent += "<td class='text-end'>" + (todesimal(result[i].hargamodal) || '0') + "</td>";
                    tbodyContent += "<td class='text-end'>" + (todesimal(result[i].totalmodal) || '0') + "</td>";
                    tbodyContent += "<td class='text-end'>" + (todesimal(result[i].hargajual) || '0') + "</td>";
                    tbodyContent += "<td class='text-end'>" + (todesimal(result[i].totaljual) || '0') + "</td>";
                    tbodyContent += "<td class='text-end'>" + (todesimal(result[i].obat_7) || '0') + "</td>";
                    tbodyContent += "<td class='text-end pe-4'>" + (todesimal(result[i].obat_23) || '0') + "</td>";
                    tbodyContent += "</tr>";
        
                    lastpoli = currentPoli;
                }
        
                // Tambahkan data terakhir
                if (tbodyContent !== "") {
                    tableresult += tbodyContent;
        
                    tableresult += "</tbody><tfoot class='text-gray-600 fw-bold table-info'>";
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4 rounded-start text-center' colspan='3'>TOTAL</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalModal) + "</td>";
                    tableresult += "<td class='text-end'></td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalJual) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalObat7) + "</td>";
                    tableresult += "<td class='pe-4 rounded-end text-end'>" + todesimal(totalObat23) + "</td>";
                    tableresult += "</tr>";
                    tableresult += "</tfoot>";
        
                    tableresult += "</table>";

                    tableresult +="<div class='col-xl-6 mb-20'>";
                        tableresult +="<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                            tableresult +="<thead>";
                                tableresult +="<tr class='fw-bolder text-muted bg-light'>";
                                    tableresult +="<th class='text-center ps-4 rounded-start' colspan='2'>Pendapatan</th>";
                                    tableresult +="<th class='text-center pe-4 rounded-end' colspan='2'>Pengeluaran</th>";
                                tableresult +="</tr>";
                            tableresult +="</thead>";
                            tableresult +="<tbody class='text-gray-600 fw-bold'>";
                                tableresult +="<tr>";
                                    tableresult +="<td class='ps-4'>Klaim Obat Kronis</td>";
                                    tableresult +="<td>"+todesimal(totalObat23)+"</td>";
                                    tableresult +="<td>Registrasi</td>";
                                    tableresult +="<td>"+todesimal(biaya_reg)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td class='ps-4'>Klaim Rajal Biasa</td>";
                                    tableresult +="<td>"+todesimal(biaya_klaim)+"</td>";
                                    tableresult +="<td>Jasa Dokter</td>";
                                    tableresult +="<td>"+todesimal(biaya_dokter)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td>Total Modal Obat</td>";
                                    tableresult +="<td>"+todesimal(totalModal)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>"; 
                                    tableresult +="<td class='ps-4'>Tindakan</td>";
                                    tableresult +="<td>"+todesimal(biaya_tindakan)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>"; 
                                    tableresult +="<td class='ps-4'>Laboratorium</td>";
                                    tableresult +="<td>"+todesimal(biaya_lab)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>"; 
                                    tableresult +="<td class='ps-4'>Radiologi</td>";
                                    tableresult +="<td>"+todesimal(biaya_rad)+"</td>";
                                tableresult +="</tr>";
                            tableresult +="</tbody>";
                            tableresult +="<tfoot class='text-gray-600 fw-bold table-warning'>";
                                tableresult +="<tr>";
                                    tableresult +="<td class='ps-4'>Total Klaim Per Episode</td>";
                                    tableresult +="<td class='ps-4'>"+todesimal(parseFloat(totalObat23)+parseFloat(biaya_klaim))+"</td>";
                                    tableresult +="<td class='pe-4'>Total Pengeluaran</td>";
                                    tableresult +="<td class='pe-4'>"+todesimal(biaya_totalbiiling)+"</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                if(parseFloat(biaya_totalbiiling) <  (parseFloat(totalObat23)+parseFloat(biaya_klaim))){
                                    tableresult +="<td class='ps-4 table-success rounded-start rounded-end' colspan='4'>Potensi Keuntungan : "+todesimal(((parseFloat(totalObat23)+parseFloat(biaya_klaim))-biaya_totalbiiling))+"</td>";
                                }else{
                                    tableresult +="<td class='ps-4 table-danger rounded-start rounded-end' colspan='4'>Potensi Kerugian : - "+todesimal(((parseFloat(totalObat23)+parseFloat(biaya_klaim))-biaya_totalbiiling))+"</td>";
                                }  
                                tableresult +="</tr>";
                            tableresult +="</tfoot>";
                        tableresult +="</table>";
                    tableresult +="</div>";
                    
                }
            }
        
            $("#dataanalyst").html(tableresult);
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