databulan();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    databulan();
});

function databulan() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/sb/quickreport/databulan",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            for (var month = 1; month <= 12; month++) {
                $("#resultbln" + (month < 10 ? '0' + month : month)).html("");
            }
        },
        success: function (data) {
            var totalPerMonth = {};
            for (var m = 1; m <= 12; m++) {
                var key = m < 10 ? '0' + m : '' + m;
                totalPerMonth[key] = {
                    urj: 0, uri: 0, arj: 0, ari: 0, brj: 0, bri: 0, lain: 0
                };
            }
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    var month = result[i].bulan;
        
                    totalPerMonth[month].urj += parseFloat(result[i].urj || 0);
                    totalPerMonth[month].uri += parseFloat(result[i].uri || 0);
                    totalPerMonth[month].arj += parseFloat(result[i].arj || 0);
                    totalPerMonth[month].ari += parseFloat(result[i].ari || 0);
                    totalPerMonth[month].brj += parseFloat(result[i].brj || 0);
                    totalPerMonth[month].bri += parseFloat(result[i].bri || 0);
                    totalPerMonth[month].lain += parseFloat(result[i].lain || 0);
        
                    // Cek apakah hari Minggu
                    var rowClass = result[i].nama_hari === "Minggu" ? "table-danger" : "";
        
                    var tableresult = "<tr class='" + rowClass + "'>";
                    tableresult += "<td class='ps-4'>" + result[i].nama_hari + "</td>";
                    tableresult += "<td class='text-center'>" + result[i].tanggal + "</td>";
        
                    tableresult += result[i].urj === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='UMUM' data_jenis='RAJAL' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].urj) + "</td>";
        
                    tableresult += result[i].uri === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='UMUM' data_jenis='INAP' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].uri) + "</td>";
        
                    tableresult += result[i].arj === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='ASURANSI' data_jenis='RAJAL' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].arj) + "</td>";
        
                    tableresult += result[i].ari === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='ASURANSI' data_jenis='INAP' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].ari) + "</td>";
        
                    tableresult += result[i].brj === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='BPJS' data_jenis='RAJAL' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].brj) + "</td>";
        
                    tableresult += result[i].bri === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='BPJS' data_jenis='INAP' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].bri) + "</td>";
        
                    tableresult += result[i].lain === null
                        ? "<td class='text-center'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_client_edit' data_provider='LAIN' data_jenis='LAIN' data_parameter='" + result[i].parameter + "'><i class='bi bi-pencil-fill'></i></a></td>"
                        : "<td class='text-end'>" + todesimal(result[i].lain) + "</td>";
        
                    var totalRajal = parseFloat(result[i].urj || 0) + parseFloat(result[i].arj || 0) + parseFloat(result[i].brj || 0);
                    var totalInap  = parseFloat(result[i].uri || 0) + parseFloat(result[i].ari || 0) + parseFloat(result[i].bri || 0);
                    var totalAkhir = totalRajal + totalInap + parseFloat(result[i].lain || 0);
        
                    tableresult += "<td class='text-end'>" + todesimal(totalRajal) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalInap) + "</td>";
                    tableresult += "<td class='text-end pe-4'>" + todesimal(totalAkhir) + "</td>";
                    tableresult += "</tr>";
        
                    $("#resultbln" + month).append(tableresult);
                }
        
                // Tambahkan footer total
                // for (var m = 1; m <= 12; m++) {
                //     var month = m < 10 ? '0' + m : '' + m;
                //     var total = totalPerMonth[month];
        
                //     var totalRow = "<tr class='fw-bolder text-muted bg-light align-middle'>";
                //         totalRow += "<td colspan='2' class='ps-4'>Total</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.urj) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.uri) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.arj) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.ari) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.brj) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.bri) + "</td>";
                //         totalRow += "<td class='text-end'>" + todesimal(total.lain) + "</td>";
        
                //     var totalRajal = total.urj + total.arj + total.brj;
                //     var totalInap  = total.uri + total.ari + total.bri;
                //     var totalAkhir = totalRajal + totalInap + total.lain;

                //     var asuransi = total.arj+total.arj;
                //     var umum     = total.urj+total.uri;
                //     var bpjs     = total.brj+total.bri;
        
                //     totalRow += "<td class='text-end'>" + todesimal(totalRajal) + "</td>";
                //     totalRow += "<td class='text-end'>" + todesimal(totalInap) + "</td>";
                //     totalRow += "<td class='text-end pe-4'>" + todesimal(totalAkhir) + "</td>";
                //     totalRow += "</tr>";
        
                //     totalRow += "<tr class='fw-bolder text-muted bg-light align-middle'>";
                //     totalRow += "<td colspan='2' class='ps-4'>Sub Total Asuransi</td>";
                //     totalRow += "<td class='text-center' colspan='2'>" + todesimal(umum) + "</td>";
                //     totalRow += "<td class='text-center' colspan='2'>" + todesimal(asuransi) + "</td>";
                //     totalRow += "<td class='text-center' colspan='2'>" + todesimal(bpjs) + "</td>";
                //     totalRow += "<td class='text-end'>" + todesimal(total.lain) + "</td>";
        
                //     totalRow += "<td class='text-end'></td>";
                //     totalRow += "<td class='text-end'></td>";
                //     totalRow += "<td class='text-end pe-4'></td>";
                //     totalRow += "</tr>";
        
                //     $("#resultbln" + month).append(totalRow);
                // }

                for (var m = 1; m <= 12; m++) {
                    var month = m < 10 ? '0' + m : '' + m;
                    var total = totalPerMonth[month];
        
                    var totalRajal = total.urj + total.arj + total.brj;
                    var totalInap  = total.uri + total.ari + total.bri;
                    var totalAkhir = totalRajal + totalInap + total.lain;

                    var asuransi = total.arj+total.ari;
                    var umum     = total.urj+total.uri;
                    var bpjs     = total.brj+total.bri;
        
        
                    $("#total" + month).html("Rp. "+todesimal(totalAkhir));

                    $("#umum" + month).html("Rp. "+todesimal(umum));
                    $("#asuransi" + month).html("Rp. "+todesimal(asuransi));
                    $("#bpjs" + month).html("Rp. "+todesimal(bpjs));
                    $("#lain" + month).html("Rp. "+todesimal(total.lain));
                }
            }
        
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html: "<b>" + error + "</b>",
                icon: "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling: false,
                timerProgressBar: true,
                timer: 5000,
                customClass: { confirmButton: "btn btn-danger" },
                showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
                hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
            });
        }
    });
    return false;
}
