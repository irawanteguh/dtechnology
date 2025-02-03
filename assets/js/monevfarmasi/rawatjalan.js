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
        
                // Variabel total untuk setiap poli-dokter
                var totalModal, totalJual, totalObat7, totalObat23;
                var tbodyContent = "";
        
                for (var i in result) {
                    var currentPoli = result[i].poliid + "-" + result[i].dokterid + "-" + result[i].norm;
        
                    if (lastpoli !== currentPoli) {
                        // Jika bukan pertama kali, masukkan tbodyContent sebelumnya sebelum membuat tabel baru
                        if (lastpoli !== null) {
                            tableresult += tbodyContent;
        
                            // Tambahkan total footer untuk poli sebelumnya
                            tableresult += "<tfoot class='text-gray-600 fw-bold table-warning'>";
                            tableresult += "<tr>";
                            tableresult += "<td class='text-center' colspan='3'>TOTAL</td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalModal) + "</td>";
                            tableresult += "<td class='text-end'></td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalJual) + "</td>";
                            tableresult += "<td class='text-end'>" + todesimal(totalObat7) + "</td>";
                            tableresult += "<td class='pe-4 rounded-end text-end'>" + todesimal(totalObat23) + "</td>";
                            tableresult += "</tr>";
                            tableresult += "</tfoot>";
        
                            tableresult += "</tbody></table>";

                            tableresult +="<div class='col-xl-6'>";
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
                                            tableresult +="<td>15.000</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td class='ps-4'>Klaim Rajal Biasa</td>";
                                            tableresult +="<td>0</td>";
                                            tableresult +="<td>Jasa Dokter</td>";
                                            tableresult +="<td>50.000</td>";
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
                                            tableresult +="<td>0</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>"; 
                                            tableresult +="<td class='ps-4'>Laboratorium</td>";
                                            tableresult +="<td>0</td>";
                                        tableresult +="</tr>";
                                        tableresult +="<tr>";
                                            tableresult +="<td></td>";
                                            tableresult +="<td></td>"; 
                                            tableresult +="<td class='ps-4'>Radiologi</td>";
                                            tableresult +="<td>0</td>";
                                        tableresult +="</tr>";
                                    tableresult +="</tbody>";
                                    tableresult +="<tfoot class='text-gray-600 fw-bold table-warning'>";
                                        tableresult +="<tr>";
                                            tableresult +="<td class='ps-4'>Total Klaim Per Episode</td>";
                                            tableresult +="<td class='ps-4 rounded-start'>0</td>";
                                            tableresult +="<td>Total Pengeluaran</td>";
                                            tableresult +="<td class='pe-4 rounded-end'>"+todesimal((parseFloat(totalModal)+50000+15000))+"</td>";
                                        tableresult +="</tr>";
                                    tableresult +="</tfoot>";
                                tableresult +="</table>";
                            tableresult +="</div>";
                        }
        
                        // Reset total dan tbodyContent untuk poli-dokter baru
                        totalModal = 0;
                        totalJual = 0;
                        totalObat7 = 0;
                        totalObat23 = 0;
                        tbodyContent = "";
        
                        tableresult += "<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                        tableresult += "<thead>";
                        tableresult += "<tr class='fw-bolder text-muted bg-light'>";
                        tableresult += "<th class='ps-4 rounded-start table-info' colspan='8'>" + result[i].namapoli + " [ " + result[i].namadokter + " ] Atasnama " + result[i].namapasien + " [" + result[i].norm + "]</th>";
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
        
                    tableresult += "<tfoot class='text-gray-600 fw-bold table-warning'>";
                    tableresult += "<tr>";
                    tableresult += "<td class='ps-4 rounded-start text-center' colspan='3'>TOTAL</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalModal) + "</td>";
                    tableresult += "<td class='text-end'></td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalJual) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalObat7) + "</td>";
                    tableresult += "<td class='pe-4 rounded-end text-end'>" + todesimal(totalObat23) + "</td>";
                    tableresult += "</tr>";
                    tableresult += "</tfoot>";
        
                    tableresult += "</tbody></table>";

                    tableresult +="<div class='col-xl-6'>";
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
                                    tableresult +="<td>15.000</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td class='ps-4'>Klaim Rajal Biasa</td>";
                                    tableresult +="<td>0</td>";
                                    tableresult +="<td>Jasa Dokter</td>";
                                    tableresult +="<td>50.000</td>";
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
                                    tableresult +="<td>0</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>"; 
                                    tableresult +="<td class='ps-4'>Laboratorium</td>";
                                    tableresult +="<td>0</td>";
                                tableresult +="</tr>";
                                tableresult +="<tr>";
                                    tableresult +="<td></td>";
                                    tableresult +="<td></td>"; 
                                    tableresult +="<td class='ps-4'>Radiologi</td>";
                                    tableresult +="<td>0</td>";
                                tableresult +="</tr>";
                            tableresult +="</tbody>";
                            tableresult +="<tfoot class='text-gray-600 fw-bold table-warning'>";
                                tableresult +="<tr>";
                                    tableresult +="<td class='ps-4'>Total Klaim Per Episode</td>";
                                    tableresult +="<td class='ps-4 rounded-start'>0</td>";
                                    tableresult +="<td>Total Pengeluaran</td>";
                                    tableresult +="<td class='pe-4 rounded-end'>"+todesimal((parseFloat(totalModal)+50000+15000))+"</td>";
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