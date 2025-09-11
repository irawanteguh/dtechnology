const createPieChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);

    if (window[chartId] instanceof ApexCharts) {
        window[chartId].destroy();
    }

    const chart = new ApexCharts(el, {
        series: seriesData,
        chart: {
            height: 300,
            type: 'pie',
            toolbar: { show: false },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: { enabled: true, delay: 150 },
                dynamicAnimation: { enabled: true, speed: 350 }
            }
        },
        labels: categories,
        legend: {
            position: 'right'
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

const createRadarChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);

    if (window[chartId] instanceof ApexCharts) {
        window[chartId].destroy();
    }

    const chart = new ApexCharts(el, {
        series: [{
            name: 'Total',
            data: seriesData
        }],
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
        colors: ['#1E90FF'],
        dataLabels: { enabled: false },
        markers: {
            size: 4,
            colors: "#fff",
            strokeColors: ['#1E90FF'],
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

const createBarChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);

    // Hapus chart lama kalau ada
    if (window[chartId] instanceof ApexCharts) {
        window[chartId].destroy();
    }

    const chart = new ApexCharts(el, {
        series: [{
            data: seriesData
        }],
        chart: {
            type: 'bar',
            height: 500,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                barHeight: '100%',
                distributed: true,
                horizontal: true,
                dataLabels: {
                    position: 'bottom',
                    textAnchor: 'middle',
                },
            }
        },
        dataLabels: {
            enabled: true,
            textAnchor: 'bottom',
            style: { colors: ['#333'] },
            formatter: function (val, opt) {
                return categories[opt.dataPointIndex] + ": " + val.toLocaleString('id-ID');
            },
            offsetX: 0,
            dropShadow: { enabled: false }
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: categories,
            labels: {
                formatter: (val, i) => {
                    // tampilkan tiap 2 gridline saja
                    return i % 2 === 0 
                        ? "Rp " + val.toLocaleString('id-ID', { 
                            minimumFractionDigits: 2, 
                            maximumFractionDigits: 2 
                        }) 
                        : "";
                },
                style: { fontSize: '13px' }
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
