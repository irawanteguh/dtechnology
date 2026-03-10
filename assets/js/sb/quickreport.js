var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"


refreshdata();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    refreshdata();
});

flatpickr('[name="modal_quickreport_jurnal_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

function refreshdata(){
    databulan();
    akuncoa();
    jurnal();
}

$('#modal_quickreport_jurnal').on('hidden.bs.modal', function (e) {
    $('#modal_quickreport_jurnal_date').val("");
    $('#modal_quickreport_jurnal_debit').val("");
});

// flatpickr('[name="modal_quickreport_add_date"]', {
//     enableTime: false,
//     dateFormat: "d.m.Y",
//     maxDate: "today",
//     onChange  : function(selectedDates, dateStr, instance) {
//         instance.close();
//     }
// });

// flatpickr('[name="modal_quickreport_add_date_kunjungan"]', {
//     enableTime: false,
//     dateFormat: "d.m.Y",
//     maxDate: "today",
//     onChange  : function(selectedDates, dateStr, instance) {
//         instance.close();
//     }
// });

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
    var data_mcucash   = btn.attr("data_mcucash");
    var data_mcuinv    = btn.attr("data_mcuinv");
    var data_lain      = btn.attr("data_lain");
    var data_pob       = btn.attr("data_pob");
    var data_kurj      = btn.attr("data_kurj");
    var data_kuri      = btn.attr("data_kuri");
    var data_karj      = btn.attr("data_karj");
    var data_kari      = btn.attr("data_kari");
    var data_kmcucash  = btn.attr("data_kmcucash");
    var data_kmcuinv   = btn.attr("data_kmcuinv");
    var data_kbrj      = btn.attr("data_kbrj");
    var data_kbri      = btn.attr("data_kbri");

    var data_coaid   = btn.attr("data_coaid");
    var data_coaname = btn.attr("data_coaname");
    var data_coacode = btn.attr("data_coacode");

    $('#coaid').val(data_coaid);
    $('#data_coaname').val(data_coaname);
    $('#data_coacode').val(data_coacode);

    $('#modal_quickreport_add_date').val(data_parameter);
    $('#modal_quickreport_add_date_kunjungan').val(data_parameter);

    $('#URJ').val(data_urj === "null" || data_urj === "" ? "" : formatRupiah(data_urj));
    $('#URI').val(data_uri === "null" || data_uri === "" ? "" : formatRupiah(data_uri));
    $('#ARJ').val(data_arj === "null" || data_arj === "" ? "" : formatRupiah(data_arj));
    $('#ARI').val(data_ari === "null" || data_ari === "" ? "" : formatRupiah(data_ari));
    $('#BRJ').val(data_brj === "null" || data_brj === "" ? "" : formatRupiah(data_brj));
    $('#BRI').val(data_bri === "null" || data_bri === "" ? "" : formatRupiah(data_bri));
    $('#MCUCASH').val(data_brj === "null" || data_brj === "" ? "" : formatRupiah(data_mcucash));
    $('#MCUINV').val(data_bri === "null" || data_bri === "" ? "" : formatRupiah(data_mcuinv));
    $('#LAIN').val(data_lain === "null" || data_lain === "" ? "" : formatRupiah(data_lain));
    $('#POB').val(data_lain === "null" || data_lain === "" ? "" : formatRupiah(data_pob));

    $('#KURJ').val(data_kurj === "null" || data_kurj === "" ? "" : data_kurj);
    $('#KURI').val(data_kuri === "null" || data_kuri === "" ? "" : data_kuri);
    $('#KARJ').val(data_karj === "null" || data_karj === "" ? "" : data_karj);
    $('#KARI').val(data_kari === "null" || data_kari === "" ? "" : data_kari);
    $('#KBRJ').val(data_kbrj === "null" || data_kbrj === "" ? "" : data_kbrj);
    $('#KBRI').val(data_kbri === "null" || data_kbri === "" ? "" : data_kbri);
    $('#KMCUCASH').val(data_kbri === "null" || data_kmcucash === "" ? "" : data_kmcucash);
    $('#KMCUINV').val(data_kbri === "null" || data_kmcuinv === "" ? "" : data_kmcuinv);

};

function databulan(){
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

            for(var month = 1; month <= 12; month++){
                $("#resultbln" + (month < 10 ? '0' + month : month)).html("");
                $("#resultkunjungan" + (month < 10 ? '0' + month : month)).html("");

                $("#totalkunjunganumum" + (month < 10 ? '0' + month : month)).html("");
                $("#totalkunjunganasuransi" + (month < 10 ? '0' + month : month)).html("");
                $("#totalkunjunganbpjs" + (month < 10 ? '0' + month : month)).html("");
                $("#totalkunjunganmcu" + (month < 10 ? '0' + month : month)).html("");
                
                $("#kunjunganumum" + (month < 10 ? '0' + month : month)).html("");
                $("#kunjunganasuransi" + (month < 10 ? '0' + month : month)).html("");
                $("#kunjunganbpjs" + (month < 10 ? '0' + month : month)).html("");
                $("#kunjunganmcu" + (month < 10 ? '0' + month : month)).html("");
            }

            
            am4core.useTheme(am4themes_animated);
        },       
        success: function (data) {
            var totalPerMonth = {};
            var countPerMonth = {};
        
            for (var m = 1; m <= 12; m++) {
                var key = m < 10 ? '0' + m : '' + m;
                totalPerMonth[key] = {urj: 0, uri: 0, arj: 0, ari: 0, brj: 0, bri: 0, mcucash: 0, mcuinv : 0, lain: 0, pob: 0, k_urj: 0, k_uri: 0, k_arj: 0, k_ari: 0, k_brj: 0, k_bri: 0, k_mcucash: 0, k_mcuinv: 0,umum: 0, asuransi: 0, bpjs: 0, mcu: 0};
                countPerMonth[key] = 0;
            }
        
            if(data.responCode === "00"){
                var result = data.responResult;
        
                for (var i in result) {
                    var item = result[i];
                    var month = item.bulan;
        
                    // Tambah nilai ke total per bulan
                    totalPerMonth[month].urj       += parseFloat(item.urj || 0);
                    totalPerMonth[month].uri       += parseFloat(item.uri || 0);
                    totalPerMonth[month].arj       += parseFloat(item.arj || 0);
                    totalPerMonth[month].ari       += parseFloat(item.ari || 0);
                    totalPerMonth[month].brj       += parseFloat(item.brj || 0);
                    totalPerMonth[month].bri       += parseFloat(item.bri || 0);
                    totalPerMonth[month].mcucash   += parseFloat(item.mcucash || 0);
                    totalPerMonth[month].mcuinv    += parseFloat(item.mcuinv || 0);
                    totalPerMonth[month].lain      += parseFloat(item.lain || 0);
                    totalPerMonth[month].pob       += parseFloat(item.pob || 0);
                    totalPerMonth[month].k_urj     += parseFloat(item.kurj || 0);
                    totalPerMonth[month].k_uri     += parseFloat(item.kuri || 0);
                    totalPerMonth[month].k_arj     += parseFloat(item.karj || 0);
                    totalPerMonth[month].k_ari     += parseFloat(item.kari || 0);
                    totalPerMonth[month].k_brj     += parseFloat(item.kbrj || 0);
                    totalPerMonth[month].k_bri     += parseFloat(item.kbri || 0);
                    totalPerMonth[month].k_mcucash += parseFloat(item.kmcucash || 0);
                    totalPerMonth[month].k_mcuinv  += parseFloat(item.kmcuinv || 0);

                    totalPerMonth[month].umum     = totalPerMonth[month].k_urj + totalPerMonth[month].k_uri;
                    totalPerMonth[month].asuransi = totalPerMonth[month].k_arj + totalPerMonth[month].k_ari;
                    totalPerMonth[month].bpjs     = totalPerMonth[month].k_brj + totalPerMonth[month].k_bri;
                    totalPerMonth[month].mcu      = totalPerMonth[month].k_mcucash + totalPerMonth[month].k_mcuinv;

                    countPerMonth[month]++;

                    // Get variabel untuk edit
                    var getvariabel =   " data_parameter='" + item.parameter + "'" +
                                        " data_urj='" + item.urj + "'" +
                                        " data_uri='" + item.uri + "'" +
                                        " data_arj='" + item.arj + "'" +
                                        " data_ari='" + item.ari + "'" +
                                        " data_brj='" + item.brj + "'" +
                                        " data_bri='" + item.bri + "'" +
                                        " data_mcucash='" + item.mcucash + "'" +
                                        " data_mcuinv='" + item.mcuinv + "'" +
                                        " data_lain='" + item.lain + "'"+
                                        " data_pob='" + item.pob + "'"+
                                        " data_kurj='" + item.kurj + "'" +
                                        " data_kuri='" + item.kuri + "'" +
                                        " data_karj='" + item.karj + "'" +
                                        " data_kari='" + item.kari + "'" +
                                        " data_kbrj='" + item.kbrj + "'" +
                                        " data_kbri='" + item.kbri + "'" +
                                        " data_kmcucash='" + item.kmcucash + "'" +
                                        " data_kmcuinv='" + item.kmcuinv + "'" ;
        
                    var rowClass = item.nama_hari === "Minggu" ? "table-danger" : "";
        
                    var tableresult = "<tr class='" + rowClass + "'>";
                    tableresult += "<td class='ps-4'>" + item.nama_hari + "</td>";
                    tableresult += "<td class='text-center'>" + item.tanggal + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.urj || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.uri || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.arj || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.ari || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.brj || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.bri || 0) + "</td>";
                    
                    tableresult += "<td class='text-end'>" + todesimal(item.mcucash || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.mcuinv || 0) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(item.pob || 0) + "</td>";

                    tableresult += "<td class='text-end'>" + todesimal(item.lain || 0) + "</td>";
        
                    var totalRajal = parseFloat(item.urj || 0) + parseFloat(item.arj || 0) + parseFloat(item.brj || 0);
                    var totalInap = parseFloat(item.uri || 0) + parseFloat(item.ari || 0) + parseFloat(item.bri || 0);
                    var totalAkhir = totalRajal + totalInap + parseFloat(item.lain || 0) + parseFloat(item.pob || 0)+ parseFloat(item.mcucash || 0)+ parseFloat(item.mcuinv || 0);
        
                    tableresult += "<td class='text-end'>" + todesimal(totalRajal) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalInap) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalAkhir) + "</td>";
                    tableresult += "<td class='text-end pe-4'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add'" + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a></td>";
                    tableresult += "</tr>";

                    var ktotalRajal = parseFloat(item.kurj || 0) + parseFloat(item.karj || 0) + parseFloat(item.kbrj || 0) + parseFloat(item.kmcucash || 0) + parseFloat(item.kmcuinv || 0);
                    var ktotalInap = parseFloat(item.kuri || 0) + parseFloat(item.kari || 0) + parseFloat(item.kbri || 0);
                    var ktotalAkhir = ktotalRajal + ktotalInap;

                    var tablekunjungan = "<tr class='" + rowClass + "'>";
                        tablekunjungan += "<td class='ps-4'>" + item.nama_hari + "</td>";
                        tablekunjungan += "<td class='text-center'>" + item.tanggal + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kurj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kuri || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.karj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kari || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kbrj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kbri || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kmcucash || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(item.kmcuinv || 0) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalRajal) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalInap) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalAkhir) + "</td>";
                        tablekunjungan += "<td class='text-end pe-4'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_addkunjungan'" + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a></td>";
                        tablekunjungan += "</tr>";
        
                    $("#resultbln" + month).append(tableresult);
                    $("#resultkunjungan" + month).append(tablekunjungan);
                    $("#totalkunjunganumum" + month).html(todesimal(totalPerMonth[month].umum));
                    $("#totalkunjunganasuransi" + month).html(todesimal(totalPerMonth[month].asuransi));
                    $("#totalkunjunganbpjs" + month).html(todesimal(totalPerMonth[month].bpjs));
                    $("#totalkunjunganmcu" + month).html(todesimal(totalPerMonth[month].mcu));
                }

                let bulanan = {};
                result.forEach(item => {
                    const bulan = item.bulan;
                    const tanggal = parseInt(item.tanggal);

                    if(!bulanan[bulan]){
                        bulanan[bulan]={
                            kurj    : [],
                            kuri    : [],
                            karj    : [],
                            kari    : [],
                            kbrj    : [],
                            kbri    : [],
                            kmcucash: [],
                            kmcuinv : []
                        };
                    }

                    bulanan[bulan].kurj[tanggal - 1]     = parseInt(item.kurj || 0);
                    bulanan[bulan].kuri[tanggal - 1]     = parseInt(item.kuri || 0);
                    bulanan[bulan].karj[tanggal - 1]     = parseInt(item.karj || 0);
                    bulanan[bulan].kari[tanggal - 1]     = parseInt(item.kari || 0);
                    bulanan[bulan].kbrj[tanggal - 1]     = parseInt(item.kbrj || 0);
                    bulanan[bulan].kbri[tanggal - 1]     = parseInt(item.kbri || 0);
                    bulanan[bulan].kmcucash[tanggal - 1] = parseInt(item.kmcucash || 0);
                    bulanan[bulan].kmcuinv[tanggal - 1]  = parseInt(item.kmcuinv || 0);
                });
                
                const chartInstances = {};
                const createChart = (id, month, data1, data2, label1, label2) => {
                    const el = document.getElementById(id + month);
                    if (!el) return;

                    const height  = parseInt(KTUtil.css(el, "height"));
                    const gray800 = KTUtil.getCssVariableValue("--bs-gray-800");
                    const gray300 = KTUtil.getCssVariableValue("--bs-gray-300");
                    const primary = KTUtil.getCssVariableValue("--bs-primary");
                    const info    = KTUtil.getCssVariableValue("--bs-info");

                    const maxValue = Math.max(...data1.concat(data2));
                    const yAxisMax = maxValue + (maxValue * 0.2);

                    // Destroy old chart if exists
                    if (chartInstances[id + month]) {
                        chartInstances[id + month].destroy();
                    }

                    const chart = new ApexCharts(el, {
                        series: [
                            { name: label1, data: data1 },
                            { name: label2, data: data2 }
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "area",
                            height: height,
                            toolbar: { show: false },
                            zoom: { enabled: false },
                            sparkline: { enabled: true }
                        },
                        stroke: {
                            curve: "smooth",
                            width: 3,
                            colors: [primary, info]
                        },
                        xaxis: {
                            categories: data1.map((_, i) => `${i + 1}`),
                            labels: {
                                show: true,
                                style: { colors: gray800, fontSize: "12px" }
                            },
                            crosshairs: {
                                show: false,
                                stroke: { color: gray300, width: 1, dashArray: 3 }
                            }
                        },
                        yaxis: {
                            min: 0,
                            max: yAxisMax,
                            labels: {
                                show: true,
                                style: { colors: gray800, fontSize: "12px" }
                            }
                        },
                        tooltip: {
                            style: { fontSize: "12px" },
                            y: {
                                formatter: val => val + " kunjungan"
                            }
                        },
                        colors: [primary, info]
                    });

                    chart.render();
                    chartInstances[id + month] = chart;
                };

                for (let m = 1; m <= 12; m++) {
                    const month = m < 10 ? "0" + m : "" + m;
                    const data  = bulanan[month] || {};

                    createChart("kunjunganumum", month, data.kurj || [], data.kuri || [], "Rawat Jalan", "Rawat Inap");
                    createChart("kunjunganasuransi", month, data.karj || [], data.kari || [], "Rawat Jalan", "Rawat Inap");
                    createChart("kunjunganbpjs", month, data.kbrj || [], data.kbri || [], "Rawat Jalan", "Rawat Inap");
                    createChart("kunjunganmcu", month, data.kmcucash || [], data.kmcuinv || [], "Cash", "Invoice");
                }



                for (var m = 1; m <= 12; m++) {
                    var month = m < 10 ? '0' + m : '' + m;
                    var total = totalPerMonth[month];
                    var count = countPerMonth[month] || 1;
        
                    var avetotalRajal = Math.round((total.urj + total.arj + total.brj) / count);
                    var avetotalInap  = Math.round((total.uri + total.ari + total.bri) / count);
                    var totalRajal    = total.urj + total.arj + total.brj;
                    var totalInap     = total.uri + total.ari + total.bri;
                    var totalAkhir    = totalRajal + totalInap + total.lain + total.pob + total.mcucash + total.mcuinv;

                    var avekunjunganRajal  = Math.round((total.k_urj + total.k_arj + total.k_brj + total.k_mcucash + total.k_mcuinv) / count);
                    var avekunjunganInap   = Math.round((total.k_uri + total.k_ari + total.k_bri) / count);
                    var avekunjunganAkkhir = Math.round((total.k_urj + total.k_arj + total.k_brj + total.k_mcucash + total.k_mcuinv + total.k_uri + total.k_ari + total.k_bri) / count);

                    var asuransi = total.arj + total.ari;
                    var umum     = total.urj + total.uri;
                    var bpjs     = total.brj + total.bri;
                    var mcu      = total.mcucash + total.mcuinv;

                    var avgRow = "<tr class='fw-bolder text-muted bg-light align-middle'>";
                        avgRow += "<td colspan='2' class='ps-4'>Average</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.urj / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.uri / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.arj / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.ari / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.brj / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.bri / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.mcucash / count)) + "</td>";
                        avgRow += "<td class='text-end'>" + todesimal(Math.round(total.mcuinv / count)) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'>" + todesimal(Math.round(total.pob / count)) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'>" + todesimal(Math.round(total.lain / count)) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'>" + todesimal(avetotalRajal) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'>" + todesimal(avetotalInap) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'>" + todesimal(Math.round(totalAkhir / count)) + "</td>";
                        avgRow += "<td class='text-end' rowspan='2'></td>";
                        avgRow += "</tr>";
            
                        avgRow += "<tr class='fw-bolder text-muted bg-light align-middle'>";
                        avgRow += "<td colspan='2' class='ps-4'>Total Average</td>";
                        avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.urj / count) + Math.round(total.uri / count)) + "</td>";
                        avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.arj / count) + Math.round(total.ari / count)) + "</td>";
                        avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.brj / count) + Math.round(total.bri / count)) + "</td>";
                        avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.mcucash / count) + Math.round(total.mcuinv / count)) + "</td>";
                        avgRow += "</tr>";
                    
                    var avgRowkunjungan = "<tr class='fw-bolder text-muted bg-light align-middle'>";
                        avgRowkunjungan += "<td colspan='2' class='ps-4'>Average</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_urj / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_uri / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_arj / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_ari / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_brj / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_bri / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_mcucash / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(Math.round(total.k_mcuinv / count)) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(avekunjunganRajal) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(avekunjunganInap) + "</td>";
                        avgRowkunjungan += "<td class='text-center'>" + todesimal(avekunjunganAkkhir) + "</td>";
                        avgRowkunjungan += "<td class='text-center' colspan='2'></td>";
                        avgRowkunjungan += "</tr>";
        
                    $("#resultbln" + month).append(avgRow);
                    $("#resultkunjungan" + month).append(avgRowkunjungan);
                    
                    $("#total" + month).html("Rp. " + todesimal(totalAkhir));
                    $("#umum" + month).html("Rp. " + todesimal(umum));
                    $("#asuransi" + month).html("Rp. " + todesimal(asuransi));
                    $("#bpjs" + month).html("Rp. " + todesimal(bpjs));
                    $("#mcu" + month).html("Rp. " + todesimal(mcu));
                    $("#lain" + month).html("Rp. " + todesimal(total.lain));
                    $("#obat" + month).html("Rp. " + todesimal(total.pob));
                    
                    var nilaiGroup = [
                        { category: "UMUM",       value: umum,          color: "#0D6EFD" },  // Biru
                        { category: "ASURANSI",   value: asuransi,      color: "#DC3545" },  // Merah
                        { category: "BPJS",       value: bpjs,          color: "#20C997" },  // Hijau toska
                        { category: "MCU",        value: mcu,           color: "#FFC107" },  // Kuning
                        { category: "POB",        value: total.pob,     color: "#FD7E14" },  // Oranye
                        { category: "LAIN-LAIN",  value: total.lain,    color: "#6F42C1" }   // Ungu
                    ];                    
                
                    var nilaiDetail = [
                        { country: "UMUM Rajal", visits: total.urj, color: "#4A90E2" },
                        { country: "UMUM Ranap", visits: total.uri, color: "#50E3C2" },
                        { country: "Asuransi Rajal", visits: total.arj, color: "#F5A623" },
                        { country: "Asuransi Ranap", visits: total.ari, color: "#F8E71C" },
                        { country: "BPJS Rajal", visits: total.brj, color: "#7ED321" },
                        { country: "BPJS Ranap", visits: total.bri, color: "#417505" },
                        { country: "MCU Cash", visits: total.mcucash, color: "#7ED321" },
                        { country: "MCU Invoice", visits: total.mcuinv, color: "#417505" },
                        { country: "POB", visits: total.pob, color: "#BD10E0" },
                        { country: "Lain-lain", visits: total.lain, color: "#BD10E0" },
                    ];
                
                    // Urutkan dari nilai terbesar ke terkecil
                    nilaiDetail.sort((a, b) => a.visits - b.visits);
                
                    // Pie Chart (Group)
                    var chartgroup = am4core.create("chartprovidergroup" + month, am4charts.PieChart);
                    var chartseriesgroup = chartgroup.series.push(new am4charts.PieSeries());
                
                    chartgroup.innerRadius = am4core.percent(50);
                    chartgroup.data = nilaiGroup;
                
                    chartseriesgroup.dataFields.value = "value";
                    chartseriesgroup.dataFields.category = "category";
                    chartseriesgroup.alignLabels = false;
                    chartseriesgroup.labels.template.padding(0, 0, 0, 0);
                    chartseriesgroup.labels.template.bent = true;
                    chartseriesgroup.labels.template.radius = 10;
                    chartseriesgroup.labels.template.fill = am4core.color("#6c757d");
                    chartseriesgroup.slices.template.states.getKey("hover").properties.scale = 1.2;
                    chartseriesgroup.labels.template.states.create("hover").properties.fill = am4core.color("#fff");
                    chartseriesgroup.ticks.template.disabled = true;
                
                    chartseriesgroup.hiddenState.properties.opacity = 1;
                    chartseriesgroup.hiddenState.properties.endAngle = -90;
                    chartseriesgroup.hiddenState.properties.startAngle = -90;
                
                    // Chart Detail (Bar Chart)
                    var chartdetail = am4core.create("chartproviderdetail" + month, am4charts.XYChart);
                    chartdetail.data = nilaiDetail;
                
                    // Y-Axis (kategori)
                    var categoryAxis = chartdetail.yAxes.push(new am4charts.CategoryAxis());
                    categoryAxis.dataFields.category = "country";
                    categoryAxis.renderer.grid.template.location = 0;
                    categoryAxis.renderer.minGridDistance = 20;
                    categoryAxis.renderer.labels.template.fill = am4core.color("#6c757d");
                    categoryAxis.renderer.grid.template.disabled = true;
                
                    // X-Axis (nilai)
                    var valueAxis = chartdetail.xAxes.push(new am4charts.ValueAxis());
                    valueAxis.renderer.maxLabelPosition = 0.98;
                    valueAxis.renderer.labels.template.fill = am4core.color("#6c757d");
                
                    // Series (bar)
                    var series = chartdetail.series.push(new am4charts.ColumnSeries());
                    series.dataFields.categoryY = "country";
                    series.dataFields.valueX = "visits";
                    series.propertyFields.fill = "color";
                    series.tooltipText = "{categoryY}: [bold]{valueX}[/]";
                
                    // ANIMASI dari nilai terbesar ke terkecil
                    series.sequencedInterpolation = true;
                    series.sequencedInterpolationDelay = 150;
                    series.defaultState.transitionDuration = 1000;
                
                    series.columns.template.strokeOpacity = 0;
                    series.columns.template.cornerRadiusTopRight = 8;
                    series.columns.template.cornerRadiusBottomRight = 8;
                
                    // Cursor
                    chartdetail.cursor = new am4charts.XYCursor();
                    chartdetail.cursor.behavior = "panY";

                }
            }
        
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },        
        complete: function () {
            toastr.clear();
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
};

function akuncoa() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/sb/quickreport/akuncoa",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            for (var month = 1; month <= 12; month++) {
                var monthStr = month < 10 ? '0' + month : month;
                $("#resultcoadata" + monthStr).html("");
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;

                for (var month = 1; month <= 12; month++) {
                    var monthStr = month < 10 ? '0' + month : month;

                    var tableresult = "";
                    for (var i in result) {
                        var fieldName = "debit_" + monthStr;
                        var debitValue = result[i][fieldName] !== undefined && result[i][fieldName] !== null ? result[i][fieldName] : 0;

                        var getvariabel =   " data_coaid='" + result[i].coa_id + "'" +
                                            " data_coaname='" + result[i].nama_akun + "'" +
                                            " data_coacode='" + result[i].kode_akun + "'";

                        tableresult += "<tr>";
                        tableresult += "<td class='ps-4 rounded-start'>" + result[i].kode_akun + "</td>";
                        tableresult += "<td>" + result[i].nama_akun + "</td>";
                        tableresult += "<td>" + result[i].kategori + "</td>";

                        if(result[i].coa_header_id === null){
                            tableresult += "<td></td>";
                            tableresult += "<td></td>";
                        }else{
                            tableresult += "<td class='text-end'>Rp. "+todesimal(debitValue)+"</td>";
                            tableresult += "<td class='pe-4 text-end rounded-end'><a class='btn btn-light-success btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_jurnal' "+getvariabel+" onclick='getdata($(this));'>Submit</a></td>";
                        }

                        tableresult += "</tr>";
                    }

                    $("#resultcoadata" + monthStr).html(tableresult);
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

function jurnal() {
    $.ajax({
        url: url + "index.php/sb/quickreport/jurnal",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            for(var month = 1; month <= 12; month++){
                $("#resultjurnal" + (month < 10 ? '0' + month : month)).html("");
            }
        },
        success: function (data) {
            if (data.responCode === "00") {
                var result = data.responResult;

                for (var i in result) {
                    var item = result[i];
                    var month = item.bulan;

                    var tableresult = "<tr>";
                        tableresult += "<td class='ps-4'>" + item.tanggal + "</td>";
                        tableresult += "<td>["+item.kodeakun+"] "+ item.namakun + "</td>";
                        tableresult += "<td class='pe-4 text-end rounded-end'>Rp. " + todesimal(item.debit) + "</td>";
                        tableresult +="</tr>";

                    $("#resultjurnal" + month).append(tableresult);
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
                refreshdata();
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

$(document).on("submit", "#formquickreportkunjungan", function (e) {
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
			$("#modal_quickreport_addkunjungan_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_quickreport_addkunjungan").modal("hide");
                refreshdata();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_quickreport_addkunjungan_btn").removeClass("disabled");
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

$(document).on("submit", "#formaddjurnal", function (e) {
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
			$("#modal_quickreport_jurnal_btn").addClass("disabled");
        },
		success: function (data) {

            if(data.responCode == "00"){
                $("#modal_quickreport_jurnal").modal("hide");
                refreshdata();
			}

            toastr.clear();
            toastr[data.responHead](data.responDesc, "INFORMATION");
		},
        complete: function () {
            $("#modal_quickreport_jurnal_btn").removeClass("disabled");
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