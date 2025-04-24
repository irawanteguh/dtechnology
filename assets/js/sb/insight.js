// Gunakan window agar bisa diakses dinamis
window.chartRS = null;
window.chartUmum = null;
window.chartAsuransi = null;
window.chartBPJS = null;
window.chartLain = null;
window.chartProvider = null;

datainsight();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    datainsight();
});

function datainsight() {
    const periode = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url: url + "index.php/sb/insight/datainsight",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            // Kosongkan elemen container chart
            $("#grafikPendapatanRS").html("");
            $("#grafikPendapatanUmum").html("");
            $("#grafikPendapatanAsuransi").html("");
            $("#grafikPendapatanBPJS").html("");
            $("#grafikPendapatanLain").html("");
            $("#grafikDistribusiProvider").html("");

            // Destroy existing charts jika ada
            if (chartRS) chartRS.destroy();
            if (chartUmum) chartUmum.destroy();
            if (chartAsuransi) chartAsuransi.destroy();
            if (chartBPJS) chartBPJS.destroy();
            if (chartLain) chartLain.destroy();
            if (chartProvider) chartProvider.destroy();
        },
        success: function (data) {
            const labels = [];
            const dataMap = {
                RSMS: [], RSIABM: [], RST: [],
                umumRSMS: [], umumRSIABM: [], umumRST: [],
                asuransiRSMS: [], asuransiRSIABM: [], asuransiRST: [],
                bpjsRSMS: [], bpjsRSIABM: [], bpjsRST: [],
                lainRSMS: [], lainRSIABM: [], lainRST: []
            };

            if (data.responCode === "00") {
                const result = data.responResult;

                for (const item of result) {
                    labels.push(item.periode);
                    dataMap.RSMS.push(parseFloat(item.totalrsms));
                    dataMap.RSIABM.push(parseFloat(item.totalrsiabm));
                    dataMap.RST.push(parseFloat(item.totalrst));

                    dataMap.umumRSMS.push(parseFloat(item.umumtotalrsms));
                    dataMap.umumRSIABM.push(parseFloat(item.umumtotalrsiabm));
                    dataMap.umumRST.push(parseFloat(item.umumtotalrst));

                    dataMap.asuransiRSMS.push(parseFloat(item.asuransitotalrsms));
                    dataMap.asuransiRSIABM.push(parseFloat(item.asuransitotalrsiabm));
                    dataMap.asuransiRST.push(parseFloat(item.asuransitotalrst));

                    dataMap.bpjsRSMS.push(parseFloat(item.bpjstotalrsms));
                    dataMap.bpjsRSIABM.push(parseFloat(item.bpjstotalrsiabm));
                    dataMap.bpjsRST.push(parseFloat(item.bpjstotalrst));

                    dataMap.lainRSMS.push(parseFloat(item.laintotalrsms));
                    dataMap.lainRSIABM.push(parseFloat(item.laintotalrsiabm));
                    dataMap.lainRST.push(parseFloat(item.laintotalrst));
                }

                const average = arr => arr.reduce((a, b) => a + b, 0) / arr.length;

                const createChart = (elementId, seriesData, chartName) => {
                    const el = document.getElementById(elementId);
                    const height = parseInt(KTUtil.css(el, "height"));
                    const allData = seriesData.flatMap(s => s.data);
                    const avgAll = average(allData);

                    const newChart = new ApexCharts(el, {
                        series: seriesData,
                        chart: {
                            fontFamily: "inherit",
                            type: 'area',
                            height: height,
                            toolbar: { show: false },
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800,
                                animateGradually: { enabled: true, delay: 150 },
                                dynamicAnimation: { enabled: true, speed: 350 }
                            }
                        },
                        stroke: { curve: "smooth", width: 2, show: true },
                        dataLabels: { enabled: false },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: value => todesimal(value)
                            },
                            title: { text: 'Income this year' }
                        },
                        xaxis: {
                            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                            labels: { style: { colors: "#888", fontSize: "12px" } },
                            axisBorder: { show: true },
                            axisTicks: { show: true }
                        },
                        tooltip: {
                            y: {
                                formatter: val => val.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                })
                            },
                            x: { show: true, format: "MMM" }
                        },
                        annotations: {
                            yaxis: [{
                                y: avgAll,
                                borderColor: '#FF4560',
                                label: {
                                    borderColor: '#FF4560',
                                    style: { color: '#fff', background: '#FF4560' },
                                    text: 'Rata-rata: ' + avgAll.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    })
                                }
                            }]
                        }
                    });

                    newChart.render();
                    window[chartName] = newChart; // simpan ke variabel global
                };

                const sum = arr => arr.reduce((a, b) => a + b, 0);

                chartProvider = new ApexCharts(document.getElementById("grafikDistribusiProvider"), {
                    series: [
                        {
                            name: 'RSU Mutiasari',
                            data: [sum(dataMap.umumRSMS), sum(dataMap.asuransiRSMS), sum(dataMap.bpjsRSMS), sum(dataMap.lainRSMS)]
                        },
                        {
                            name: 'RSIA Budhi Mulia',
                            data: [sum(dataMap.umumRSIABM), sum(dataMap.asuransiRSIABM), sum(dataMap.bpjsRSIABM), sum(dataMap.lainRSIABM)]
                        },
                        {
                            name: 'RS Thursina',
                            data: [sum(dataMap.umumRST), sum(dataMap.asuransiRST), sum(dataMap.bpjsRST), sum(dataMap.lainRST)]
                        }
                    ],
                    chart: {
                        height: 330,
                        type: 'radar',
                        toolbar: { show: false },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: { enabled: true, delay: 150 },
                            dynamicAnimation: { enabled: true, speed: 350 }
                        }
                    },
                    colors: ['#1E90FF', '#28C76F', '#FF9F43'],
                    dataLabels: { enabled: false },
                    markers: {
                        size: 4,
                        colors: "#fff",
                        strokeColor: ['#1E90FF', '#28C76F', '#FF9F43'],
                        strokeWidth: 2
                    },
                    plotOptions: {
                        radar: {
                            size: 120,
                            polygons: {
                                strokeColors: '#e9e9e9',
                                fill: { colors: ['#f3f3f3', '#fff'] }
                            }
                        }
                    },
                    xaxis: {
                        categories: ['UMUM', 'ASURANSI', 'BPJS', 'LAIN-LAIN'],
                        labels: {
                            style: {
                                fontSize: '13px',
                                colors: ['#333']
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function (val, i) {
                                return i % 2 === 0 ? val.toLocaleString('id-ID') : '';
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: val => val.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            })
                        }
                    }
                });
                chartProvider.render();

                // ✅ Panggil chart sesuai dataMap
                createChart("grafikPendapatanRS", [
                    { name: "RSU Mutiasari", data: dataMap.RSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.RSIABM },
                    { name: "RS Thursina", data: dataMap.RST }
                ], "chartRS");

                createChart("grafikPendapatanUmum", [
                    { name: "RSU Mutiasari", data: dataMap.umumRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.umumRSIABM },
                    { name: "RS Thursina", data: dataMap.umumRST }
                ], "chartUmum");

                createChart("grafikPendapatanAsuransi", [
                    { name: "RSU Mutiasari", data: dataMap.asuransiRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.asuransiRSIABM },
                    { name: "RS Thursina", data: dataMap.asuransiRST }
                ], "chartAsuransi");

                createChart("grafikPendapatanBPJS", [
                    { name: "RSU Mutiasari", data: dataMap.bpjsRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.bpjsRSIABM },
                    { name: "RS Thursina", data: dataMap.bpjsRST }
                ], "chartBPJS");

                createChart("grafikPendapatanLain", [
                    { name: "RSU Mutiasari", data: dataMap.lainRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.lainRSIABM },
                    { name: "RS Thursina", data: dataMap.lainRST }
                ], "chartLain");
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
