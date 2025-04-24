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

                // Fungsi untuk menghitung rata-rata dari elemen yang != 0
                const averageNotZero = arr => {
                    const filtered = arr.filter(val => val !== 0);
                    return filtered.length > 0 ? filtered.reduce((a, b) => a + b, 0) / filtered.length : 0;
                };

                // Rata-rata pendapatan untuk tiap kategori, dihitung dari semua bulan yang nilainya > 0
                const avgUmum = averageNotZero([
                    ...dataMap.umumRSMS,
                    ...dataMap.umumRSIABM,
                    ...dataMap.umumRST
                ]);

                const avgAsuransi = averageNotZero([
                    ...dataMap.asuransiRSMS,
                    ...dataMap.asuransiRSIABM,
                    ...dataMap.asuransiRST
                ]);

                const avgBPJS = averageNotZero([
                    ...dataMap.bpjsRSMS,
                    ...dataMap.bpjsRSIABM,
                    ...dataMap.bpjsRST
                ]);

                const avgLain = averageNotZero([
                    ...dataMap.lainRSMS,
                    ...dataMap.lainRSIABM,
                    ...dataMap.lainRST
                ]);


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

                const totalRSMS = sum(dataMap.RSMS);
                const totalRSIABM = sum(dataMap.RSIABM);
                const totalRST = sum(dataMap.RST);
                const totalAll = totalRSMS + totalRSIABM + totalRST;

                const percentRSMS = ((totalRSMS / totalAll) * 100).toFixed(1);
                const percentRSIABM = ((totalRSIABM / totalAll) * 100).toFixed(1);
                const percentRST = ((totalRST / totalAll) * 100).toFixed(1);

                // Total Carousel Info
                $("#carousel-total-all").html(`
                <div>
                    <p><b>${formatCurrency(totalAll)}</b></p>
                    <small>Gabungan dari 3 rumah sakit (RSU Mutiasari, RSIA Budhi Mulia, RS Thursina)</small>
                </div>
                `);

                // RSU Mutiasari
                $("#carousel-total-rsms").html(`
                <div>
                    <p>Pendapatan RSU Mutiasari tahun ini: <b>${formatCurrency(totalRSMS)}</b></p>
                    <small class="badge badge-info mb-1">Kontribusi: ${percentRSMS}% dari total keseluruhan</small>
                </div>
                `);

                // RSIA Budhi Mulia
                $("#carousel-total-rsiabm").html(`
                <div>
                    <p>Pendapatan RSIA Budhi Mulia tahun ini: <b>${formatCurrency(totalRSIABM)}</b></p>
                    <small class="badge badge-info mb-1">Kontribusi: ${percentRSIABM}% dari total keseluruhan</small>
                </div>
                `);

                // RS Thursina
                $("#carousel-total-rst").html(`
                <div>
                    <p>Pendapatan RS Thursina tahun ini: <b>${formatCurrency(totalRST)}</b></p>
                    <small class="badge badge-info mb-1">Kontribusi: ${percentRST}% dari total keseluruhan</small>
                </div>
                `);


                const jumlahPeriodeValid = dataMap.RSMS.filter(val => val !== 0).length;

                // Menampilkan chart untuk Total Pendapatan
                createChart("grafikPendapatanRS", [
                    { name: "RSU Mutiasari", data: dataMap.RSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.RSIABM },
                    { name: "RS Thursina", data: dataMap.RST }
                ], "chartRS", totalAll / 3 / jumlahPeriodeValid);

                createChart("grafikPendapatanUmum", [
                    { name: "RSU Mutiasari", data: dataMap.umumRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.umumRSIABM },
                    { name: "RS Thursina", data: dataMap.umumRST }
                ], "chartUmum", avgUmum);
                
                createChart("grafikPendapatanAsuransi", [
                    { name: "RSU Mutiasari", data: dataMap.asuransiRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.asuransiRSIABM },
                    { name: "RS Thursina", data: dataMap.asuransiRST }
                ], "chartAsuransi", avgAsuransi);
                
                createChart("grafikPendapatanBPJS", [
                    { name: "RSU Mutiasari", data: dataMap.bpjsRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.bpjsRSIABM },
                    { name: "RS Thursina", data: dataMap.bpjsRST }
                ], "chartBPJS", avgBPJS);
                
                createChart("grafikPendapatanLain", [
                    { name: "RSU Mutiasari", data: dataMap.lainRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.lainRSIABM },
                    { name: "RS Thursina", data: dataMap.lainRST }
                ], "chartLain", avgLain);
                
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

const createChart = (elementId, seriesData, chartName, avgLine) => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height"));

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
            }
        },
        annotations: {
            yaxis: [{
                y: avgLine,
                borderColor: '#FF4560',
                label: {
                    borderColor: '#FF4560',
                    style: { color: '#fff', background: '#FF4560' },
                    text: 'Rata-rata: ' + formatCurrency(avgLine)
                }
            }]
        }
    });

    newChart.render();
    window[chartName] = newChart;
};

function formatCurrency(value) {
    return value.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
}

function sum(arr) {
    return arr.reduce((a, b) => a + b, 0);
}
