rekapbukudagang();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    rekapbukudagang();
});

$("#modal_buku_dagang").on('show.bs.modal', function(event){
    var button     = $(event.relatedTarget);
    var bukuid     = button.attr("bukuid");
    var periodeid  = button.attr("periodeid");
    var estimasi   = button.attr("estimasi");
    var penerimaan = button.attr("penerimaan");

    $("#modal_buku_dagang_bukuid").val(bukuid);
    $("#modal_buku_dagang_periodeid").val(periodeid);
    $("#modal_buku_dagang_estimasi").val(formatRupiah(estimasi));
    $("#modal_buku_dagang_penerimaan").val(formatRupiah(penerimaan));
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

// function rekapbukudagang() {
//     var tahun = $("select[name='toolbar_kunjunganyears_periode']").val(); // pastikan ini ambil tahun
//     $.ajax({
//         url: url + "index.php/bukudagang/bukudagang/rekapbukudagang",
//         data: { periode: tahun },
//         method: "POST",
//         dataType: "JSON",
//         cache: false,
//         beforeSend: function () {
//             toastr.clear();
//             toastr["info"]("Mengambil data...", "Mohon tunggu");

//             for (var i = 1; i <= 12; i++) {
//                 $("#resultdatabukudagang_" + i).html("");
//                 $("#resulttotalbukudagang_" + i).html("");
//             }
//         },
//         success: function (data) {
//             if (data.responCode === "00") {
//                 var result = data.responResult;

//                 for (var bulan = 1; bulan <= 12; bulan++) {
//                     var tableresult   = "";
//                     var totalEstimasi = 0;
//                     var totalBayar1   = 0;
//                     var totalSelisih  = 0;

//                     for (var i in result) {
//                         var estimasi = parseFloat(result[i]['estimasi_' + bulan]) || 0;
//                         var bayar1   = parseFloat(result[i]['penerimaan_' + bulan]) || 0;
//                         var selisih  = estimasi - bayar1;
//                         var bulanStr = bulan.toString().padStart(2, '0');

//                         totalEstimasi += estimasi;
//                         totalBayar1   += bayar1;
//                         totalSelisih  += selisih;

//                         var getvariabel = " bukuid='" + result[i].buku_id + "'"+
//                                           " periodeid='" +bulanStr + "."+tahun+"'"+
//                                           " estimasi='" + estimasi + "'"+
//                                           " penerimaan='" + bayar1 + "'";

//                         tableresult += "<tr>";
//                         tableresult += "<td class='ps-4'>" + result[i].buku + (result[i].manual === "N" ? "" : " <a class='btn btn-sm btn-light-primary p-1' data-bs-toggle='modal' data-bs-target='#modal_buku_dagang' "+getvariabel+"><i class='bi bi-pencil-square'></i> Update data</a>") + "</td>";
//                         tableresult += "<td class='text-end'>" + todesimal(estimasi) + "</td>";
//                         tableresult += "<td class='text-end'>" + todesimal(bayar1) + "</td>";
//                         tableresult += "<td class='text-end pe-4'>" + todesimal(selisih) + "</td>";
//                         tableresult += "</tr>";
//                     }

//                     $("#resultdatabukudagang_" + bulan).html(tableresult);

//                     var tfoot = "<tr class='fw-bolder align-middle bg-primary text-white'>";
//                     tfoot += "<td class='ps-4 text-end rounded-start'>Total</td>";
//                     tfoot += "<td class='text-end'>" + todesimal(totalEstimasi) + "</td>";
//                     tfoot += "<td class='text-end'>" + todesimal(totalBayar1) + "</td>";
//                     tfoot += "<td class='text-end pe-4 rounded-end'>" + todesimal(totalSelisih) + "</td>";
//                     tfoot += "</tr>";

//                     $("#resulttotalbukudagang_" + bulan).html(tfoot);
//                 }

//                 toastr.success("Data berhasil dimuat", "Sukses");
//             } else {
//                 toastr.warning(data.responDesc || "Data tidak ditemukan", "Peringatan");
//             }
//         },
//         error: function (xhr, status, error) {
//             toastr["error"]("Terjadi kesalahan: " + error, "Opps !");
//         },
//         complete: function () {
//             toastr.clear();
//         }
//     });

//     return false;
// };


function rekapbukudagang() {
    var tahun = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/bukudagang/bukudagang/rekapbukudagang",
        data: { periode: tahun },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Mengambil data...", "Mohon tunggu");

            for (var i = 1; i <= 12; i++) {
                $("#resultdatabukudagang_" + i).html("");
                $("#resulttotalbukudagang_" + i).html("");
                $("#resultdatabukudagangpengeluaran_" + i).html("");
                $("#resulttotalbukudagangpengeluaran_" + i).html("");
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;

                for (var bulan = 1; bulan <= 12; bulan++) {
                    var tableresultMasuk = "", tableresultKeluar = "";
                    var totalMasukEstimasi = 0, totalMasukBayar1 = 0, totalMasukSelisih = 0;
                    var totalKeluarEstimasi = 0, totalKeluarBayar1 = 0, totalKeluarSelisih = 0;

                    for (var i in result) {
                        var estimasi = parseFloat(result[i]['estimasi_' + bulan]) || 0;
                        var bayar1   = parseFloat(result[i]['penerimaan_' + bulan]) || 0;
                        var selisih  = estimasi - bayar1;
                        var bulanStr = bulan.toString().padStart(2, '0');

                        var getvariabel = " bukuid='" + result[i].buku_id + "'" +
                                          " periodeid='" + bulanStr + "." + tahun + "'" +
                                          " estimasi='" + estimasi + "'" +
                                          " penerimaan='" + bayar1 + "'";

                        var baris = "<tr>";
                        baris += "<td class='ps-4'>" + (result[i].manual === "P" ? "<a href='#'>" + result[i].buku + "</a>" : result[i].buku) + (result[i].manual === "Y" ? " <a class='btn btn-sm btn-light-primary p-1' data-bs-toggle='modal' data-bs-target='#modal_buku_dagang' " + getvariabel + "><i class='bi bi-pencil-square'></i> Update data</a>" : "") + "</td>";
                        baris += "<td class='text-end'>" + todesimal(estimasi) + "</td>";
                        baris += "<td class='text-end'>" + todesimal(bayar1) + "</td>";
                        baris += "<td class='text-end pe-4'>" + todesimal(selisih) + "</td>";
                        baris += "</tr>";

                        if (result[i].jenis_id === '1') {
                            tableresultMasuk += baris;
                            totalMasukEstimasi += estimasi;
                            totalMasukBayar1   += bayar1;
                            totalMasukSelisih  += selisih;
                        } else if (result[i].jenis_id === '2') {
                            tableresultKeluar += baris;
                            totalKeluarEstimasi += estimasi;
                            totalKeluarBayar1   += bayar1;
                            totalKeluarSelisih  += selisih;
                        }
                    }

                    // Data Masuk (jenis_id = 1)
                    $("#resultdatabukudagang_" + bulan).html(tableresultMasuk);
                    $("#resulttotalbukudagang_" + bulan).html(
                        "<tr class='fw-bolder align-middle bg-primary text-white'>" +
                        "<td class='ps-4 text-end rounded-start'>Total</td>" +
                        "<td class='text-end'>" + todesimal(totalMasukEstimasi) + "</td>" +
                        "<td class='text-end'>" + todesimal(totalMasukBayar1) + "</td>" +
                        "<td class='text-end pe-4 rounded-end'>" + todesimal(totalMasukSelisih) + "</td>" +
                        "</tr>"
                    );

                    // Data Keluar (jenis_id = 2)
                    $("#resultdatabukudagangpengeluaran_" + bulan).html(tableresultKeluar);
                    $("#resulttotalbukudagangpengeluaran_" + bulan).html(
                        "<tr class='fw-bolder align-middle bg-danger text-white'>" +
                        "<td class='ps-4 text-end rounded-start'>Total</td>" +
                        "<td class='text-end'>" + todesimal(totalKeluarEstimasi) + "</td>" +
                        "<td class='text-end'>" + todesimal(totalKeluarBayar1) + "</td>" +
                        "<td class='text-end pe-4 rounded-end'>" + todesimal(totalKeluarSelisih) + "</td>" +
                        "</tr>"
                    );
                }

                toastr.success("Data berhasil dimuat", "Sukses");
            } else {
                toastr.warning(data.responDesc || "Data tidak ditemukan", "Peringatan");
            }
        },
        error: function (xhr, status, error) {
            toastr["error"]("Terjadi kesalahan: " + error, "Opps !");
        },
        complete: function () {
            toastr.clear();
        }
    });

    return false;
}

$(document).on("submit", "#updatedata", function (e) {
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
			$("#modal_buku_dagang_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_buku_dagang").modal("hide");
                rekapbukudagang();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_buku_dagang_btn").removeClass("disabled");
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