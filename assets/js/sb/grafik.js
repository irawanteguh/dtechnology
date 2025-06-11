databulanan();
dataharian();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    databulanan();
    dataharian();
});

function databulanan() {
    const periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url      : url + "index.php/sb/grafik/databulanan",
        method   : "POST",
        data     : { periode },
        dataType : "JSON",
        cache    : false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success(data) {
            if (data.responCode !== "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                return;
            }

            const hospitals = {
                rsms  : { name: "RSU Mutiasari", data: [] },
                rsiabm: { name: "RSIA Budhi Mulia", data: [] },
                rst   : { name: "RS Thursina", data: [] }
            };
            const periodeList = [];
            const keys = {
                rsms  : 'rsms',
                rsiabm: 'rsiabm',
                rst   : 'rst'
            };

            data.responResult.forEach(item => {
                periodeList.push(item.periode);
                Object.keys(hospitals).forEach(key => {
                    const base = key;
                    hospitals[base].data.push({
                        periode : item.periode,
                        umum    : +item[`kunjunganumumtotal${base}`],
                        asuransi: +item[`kunjunganasuransitotal${base}`],
                        bpjs    : +item[`kunjunganbpjstotal${base}`],
                        mcu     : +item[`kunjunganmcutotal${base}`],
                        total   : +item[`kunjungantotal${base}`]
                    });
                });
            });

            const isValid = (item, idx) => Object.values(hospitals).some(h => h.data[idx].total > 0);
            const validPeriods = periodeList.filter((_, idx) => isValid(_, idx)).length;

            const totalKunjungan   = { all: 0, umum: 0, asuransi: 0, bpjs: 0, mcu: 0 };
            const chartSeriesBar   = [];
            const chartSeriesRadar = [];

            Object.entries(hospitals).forEach(([key, { name, data }]) => {
                const sum = {
                    total   : 0,
                    umum    : 0,
                    asuransi: 0,
                    bpjs    : 0,
                    mcu     : 0
                };

                const series = data.map(item => {
                    sum.total    += item.total;
                    sum.umum     += item.umum;
                    sum.asuransi += item.asuransi;
                    sum.bpjs     += item.bpjs;
                    sum.mcu      += item.mcu;
                    return item.total;
                });

                totalKunjungan.all     += sum.total;
                totalKunjungan.umum    += sum.umum;
                totalKunjungan.asuransi+= sum.asuransi;
                totalKunjungan.bpjs    += sum.bpjs;
                totalKunjungan.mcu     += sum.mcu;

                chartSeriesBar.push({ name, data: series });
                chartSeriesRadar.push({
                    name,
                    data: [sum.umum, sum.asuransi, sum.bpjs, sum.mcu]
                });
            });

            const avgTotal = Math.round(totalKunjungan.all / (validPeriods * 3));

            createChartlinebarbulan("grafikkunjunganbulanan", chartSeriesBar, avgTotal, "bar", "Kunjungan Pasien");
            createRadarChart("grafikDistribusiProviderkunjungan", chartSeriesRadar, ['UMUM', 'ASURANSI', 'BPJS', 'MCU']);

            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete() {
            toastr.clear();
        },
        error(xhr, status, error) {
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
}

function dataharian() {
    const periode = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url     : url + "index.php/sb/grafik/dataharian",
        method  : "POST",
        data    : { periode },
        dataType: "JSON",
        cache   : false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success(data) {
            if (data.responCode !== "00") {
                toastr[data.responHead](data.responDesc, "INFORMATION");
                return;
            }

            const hospitals = {
                rsms  : { name: "RSU Mutiasari", data: [] },
                rsiabm: { name: "RSIA Budhi Mulia", data: [] },
                rst   : { name: "RS Thursina", data: [] }
            };

            const parseTanggalToTimestamp = tanggal => {
                const [dd, mm, yyyy] = tanggal.split('.');
                return new Date(`${yyyy}-${mm}-${dd}`).getTime();
            };

            data.responResult.forEach(item => {
                const timestamp = parseTanggalToTimestamp(item.tanggal);

                hospitals.rsms.data.push([timestamp, +item.kunjungantotalrsms]);
                hospitals.rsiabm.data.push([timestamp, +item.kunjungantotalrsiabm]);
                hospitals.rst.data.push([timestamp, +item.kunjungantotalrst]);
            });

            const chartSeries = Object.values(hospitals).map(hosp => ({
                name: hosp.name,
                data: hosp.data
            }));

            createChartlinebarhari("grafikkunjunganharian", chartSeries, "area");
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete() {
            toastr.clear();
        },
        error(xhr, status, error) {
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
}

const createChartlinebarbulan = (elementId, seriesData, avgLine = null, chartType = 'bar', titlechart) => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height"));

    if (window[elementId] instanceof ApexCharts) {
        window[elementId].destroy();
    }

    const newChart = new ApexCharts(el, {
        series: seriesData,
        chart : {
            fontFamily: "inherit",
            type      : chartType,
            height    : height,
            toolbar   : { show: false },
            animations: {
                enabled         : true,
                easing          : 'easeinout',
                speed           : 800,
                animateGradually: { enabled: true, delay: 150 },
                dynamicAnimation: { enabled: true, speed: 350 }
            }
        },
        stroke    : { curve: "smooth", width: 2, show: true },
        dataLabels: { enabled: false },
        yaxis     : {
            labels: {
                show     : true,
                formatter: value => todesimal(value)
            },
            title: { text: titlechart }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            labels    : { style: { colors: "#888", fontSize: "12px" } },
            axisBorder: { show: true },
            axisTicks : { show: true }
        },
        tooltip: {
            y: {
                formatter: val => todesimal(val, 2)
            }
        },
        annotations: avgLine ? {
            yaxis: [{
                y          : avgLine,
                borderColor: '#FF4560',
                label      : {
                    borderColor: '#FF4560',
                    style      : { color: '#fff', background: '#FF4560' },
                    text       : 'Rata-rata : ' + todesimal(avgLine)
                }
            }]
        } : {}
    });

    newChart.render();
    window[elementId] = newChart;
};

const createChartlinebarhari = (elementId, seriesData, chartType = 'area', categories = []) => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height")) || 350;

    if (window[elementId] instanceof ApexCharts) {
        window[elementId].destroy();
    }

    const newChart = new ApexCharts(el, {
        series: seriesData,
        chart: {
            type: chartType,
            stacked: false,
            height: height,
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            },
            fontFamily: "inherit",
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: { enabled: true, delay: 150 },
                dynamicAnimation: { enabled: true, speed: 350 }
            }
        },
        stroke    : { curve: "smooth", width: 2, show: true },
        dataLabels: { enabled: false },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 90, 100]
            }
        },
        yaxis: {
            labels: {
                show     : true,
                formatter: value => todesimal(value)
            },
            title: {
                text: 'Jumlah Kunjungan'
            }
        },
        xaxis: {
            type: 'datetime',
            labels: {
                datetimeUTC: false,
                format: 'dd MMM'
            }
        },
        tooltip: {
            x: {
                format: 'dd MMM yyyy'
            },
            y: {
                formatter: val => todesimal(val, 2)
            }
        }
    });

    newChart.render();
    window[elementId] = newChart;
};


const createRadarChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);

    // Periksa apakah chart sudah ada dan merupakan instance dari ApexCharts
    if (window[chartId] instanceof ApexCharts) {
        window[chartId].destroy();  // Hancurkan chart yang ada
    }

    const chart = new ApexCharts(el, {
        series: seriesData,
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
            strokeColors: ['#1E90FF', '#28C76F', '#FF9F43'],
            strokeWidth: 2
        },
        plotOptions: {
            radar: {
                size: 120,
                polygons: {
                    strokeColors: '#e9e9e9',
                    fill: {
                        colors: ['#f3f3f3', '#fff']
                    }
                }
            }
        },
        xaxis: {
            categories: categories,
            labels: {
                style: {
                    fontSize: '13px',
                    colors: Array(categories.length).fill('#333')
                }
            }
        },
        yaxis: {
            labels: {
                formatter: (val, i) => i % 2 === 0 ? val.toLocaleString('id-ID') : ''
            }
        },
        tooltip: {
            y: {
                formatter: val => val.toLocaleString('id-ID')
            }
        }
    });

    chart.render();
    window[chartId] = chart;
};