databulan();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    databulan();
});

flatpickr('[name="modal_quickreport_add_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function formatRupiah(angka, prefix = 'Rp ') {
    let numberString = angka.replace(/[^,\d]/g, '').toString();
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah ? prefix + rupiah : '';
}

document.querySelectorAll('.currency-rp').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let formatted = formatRupiah(e.target.value);
        e.target.value = formatted;
    });
});

function getdata(btn){
    var data_parameter = btn.attr("data_parameter");
    var data_urj       = btn.attr("data_urj");
    var data_uri       = btn.attr("data_uri");
    var data_arj       = btn.attr("data_arj");
    var data_ari       = btn.attr("data_ari");
    var data_brj       = btn.attr("data_brj");
    var data_bri       = btn.attr("data_bri");
    var data_lain      = btn.attr("data_lain");

    $('#modal_quickreport_add_date').val(data_parameter);

    $('#URJ').val(data_urj === "null" || data_urj === "" ? "" : formatRupiah(data_urj));
    $('#URI').val(data_uri === "null" || data_uri === "" ? "" : formatRupiah(data_uri));
    $('#ARJ').val(data_arj === "null" || data_arj === "" ? "" : formatRupiah(data_arj));
    $('#ARI').val(data_ari === "null" || data_ari === "" ? "" : formatRupiah(data_ari));
    $('#BRJ').val(data_brj === "null" || data_brj === "" ? "" : formatRupiah(data_brj));
    $('#BRI').val(data_bri === "null" || data_bri === "" ? "" : formatRupiah(data_bri));
    $('#LAIN').val(data_lain === "null" || data_lain === "" ? "" : formatRupiah(data_lain));

};

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
                    var getvariabel =   " data_parameter='"+result[i].parameter+"'"+
                                        " data_urj='"+result[i].urj+"'"+
                                        " data_uri='"+result[i].uri+"'"+
                                        " data_arj='"+result[i].arj+"'"+
                                        " data_ari='"+result[i].ari+"'"+
                                        " data_brj='"+result[i].brj+"'"+
                                        " data_bri='"+result[i].bri+"'"+
                                        " data_lain='"+result[i].lain+"'";

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
        
                    tableresult += "<td class='text-center'>" + (result[i].urj === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='UMUM' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='UMUM' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].urj) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].uri === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='UMUM' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='UMUM' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].uri) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].arj === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='ASURANSI' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='ASURANSI' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].arj) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].ari === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='ASURANSI' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='ASURANSI' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].ari) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].brj === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='BPJS' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='BPJS' data_jenis='RAJAL' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].brj) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].bri === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='BPJS' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='BPJS' data_jenis='INAP' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].bri) + "</a>") + "</td>";
                    tableresult += "<td class='text-center'>" + (result[i].lain === null ? "<a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='LAIN' data_jenis='LAIN' " + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a>" : "<a class='text-muted' style='text-decoration:none; cursor:pointer;' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add' data_provider='LAIN' data_jenis='LAIN' " + getvariabel + " onclick='getdata($(this));'>" + todesimal(result[i].lain) + "</a>") + "</td>";

        
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
};

$(document).on("submit", "#formquickreport", function (e) {
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
			$("#modal_quickreport_add_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_quickreport_add").modal("hide");
                databulan();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_quickreport_add_btn").removeClass("disabled");
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