databulanan();

function databulanan() {
    const tahun = $("select[name='toolbar_periode']").val();

    $.ajax({
        url: url + "index.php/crm/kunjungan/databulanan",
        method: "POST",
        data: { tahun: tahun },
        dataType: "JSON",
        beforeSend: function () {
            $("#grafikkunjunganbulanan").html("");
        },
        success: function (data) {
            const rsms = {
                total   : [],
                umum    : [],
                asuransi: [],
                bpjs    : [],
                mcu     : []
            };

            
            const periodeList = [];
            let totalKunjungan = 0;
            let validPeriodeCount = 0;

            (data.responResult || []).forEach(item => {
                const bulan = item.periode || '-';
                periodeList.push(bulan);

                const total    = parseInt(item.kunjungantotal)         || 0;
                const umum     = parseInt(item.kunjunganumumtotal)     || 0;
                const asuransi = parseInt(item.kunjunganasuransitotal) || 0;
                const bpjs     = parseInt(item.kunjunganbpjstotal)     || 0;
                const mcu      = parseInt(item.kunjunganmcutotal)      || 0;

                rsms.total.push(total);
                rsms.umum.push(umum);
                rsms.asuransi.push(asuransi);
                rsms.bpjs.push(bpjs);
                rsms.mcu.push(mcu);

                if (total > 0) {
                    totalKunjungan += total;
                    validPeriodeCount++;
                }
            });

            const avgKunjungan = validPeriodeCount > 0 
                ? Math.round(totalKunjungan / validPeriodeCount) 
                : 0;


            const seriesData1 = [
                { name: "Total", data: rsms.total }
            ];

            const seriesData2 = [
                { name: "Umum", data: rsms.umum },
                { name: "Asuransi", data: rsms.asuransi },
                { name: "BPJS", data: rsms.bpjs },
                { name: "MCU", data: rsms.mcu }
            ];

            createChartlinebarbulan("grafikkunjungantotal",periodeList,seriesData1,avgKunjungan,"area","Jumlah Kunjungan per Bulan", true);
            createChartlinebarbulan("grafikkunjunganbulanan",periodeList,seriesData2,avgKunjungan,"bar","Jumlah Kunjungan per Bulan", false);
        },
        error: function () {
            toastr.error("Gagal memuat data kunjungan bulanan.");
        }
    });
}

const createChartlinebarbulan = (elementId, periode, seriesData, avgLine = null, chartType = 'bar', titlechart = 'Nilai',showDataLabel = false) => {
    const el = document.getElementById(elementId);
    if (!el) return;

    const height = parseInt(KTUtil.css(el, "height")) || 350;

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
        plotOptions: {
            bar: {
                horizontal : false,
                columnWidth: '55%',
                endingShape: 'rounded'
            }
        },
        stroke: {
            curve: chartType === 'line' ? "smooth" : "straight",
            width: chartType === 'line' ? 3 : 2,
            show : true
        },
        dataLabels: {
            enabled: showDataLabel,
            formatter: val => todesimal(val) // ✅ tambahkan formatter todesimal
        },
        yaxis: {
            labels: {
                show     : true,
                formatter: val => todesimal(val)
            },
            title: { text: titlechart }
        },
        xaxis: {
            categories: periode,
            labels    : { style: { colors: "#888", fontSize: "12px" } },
            axisBorder: { show: true },
            axisTicks : { show: true }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: val => todesimal(val, 2)
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '12px'
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
