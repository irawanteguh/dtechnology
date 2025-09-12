// const createPieChart = (chartId, seriesData, categories) => {
//     const el = document.getElementById(chartId);

//     if (window[chartId] instanceof ApexCharts) {
//         window[chartId].destroy();
//     }

//     const chart = new ApexCharts(el, {
//         series: seriesData,
//         chart: {
//             height: 300,
//             type: 'pie',
//             toolbar: { show: false },
//             animations: {
//                 enabled: true,
//                 easing: 'easeinout',
//                 speed: 800,
//                 animateGradually: { enabled: true, delay: 150 },
//                 dynamicAnimation: { enabled: true, speed: 350 }
//             }
//         },
//         labels: categories,
//         legend: {
//             position: 'right'
//         },
//         tooltip: {
//             y: {
//                 formatter: val => val.toLocaleString('id-ID')
//             }
//         }
//     });

//     chart.render();
//     window[chartId] = chart;
// };

// const createRadarChart = (chartId, seriesData, categories) => {
//     const el = document.getElementById(chartId);

//     if (window[chartId] instanceof ApexCharts) {
//         window[chartId].destroy();
//     }

//     const chart = new ApexCharts(el, {
//         series: [{
//             name: 'Total',
//             data: seriesData
//         }],
//         chart: {
//             height: 330,
//             type: 'radar',
//             toolbar: { show: false },
//             animations: {
//                 enabled: true,
//                 easing: 'easeinout',
//                 speed: 800,
//                 animateGradually: { enabled: true, delay: 150 },
//                 dynamicAnimation: { enabled: true, speed: 350 }
//             }
//         },
//         colors: ['#1E90FF'],
//         dataLabels: { enabled: false },
//         markers: {
//             size: 4,
//             colors: "#fff",
//             strokeColors: ['#1E90FF'],
//             strokeWidth: 2
//         },
//         plotOptions: {
//             radar: {
//                 size: 120,
//                 polygons: {
//                     strokeColors: '#e9e9e9',
//                     fill: { colors: ['#f3f3f3', '#fff'] }
//                 }
//             }
//         },
//         xaxis: {
//             categories: categories,
//             labels: {
//                 style: {
//                     fontSize: '13px',
//                     colors: Array(categories.length).fill('#333')
//                 }
//             }
//         },
//         yaxis: {
//             labels: {
//                 formatter: (val, i) => i % 2 === 0 ? val.toLocaleString('id-ID') : ''
//             }
//         },
//         tooltip: {
//             y: {
//                 formatter: val => val.toLocaleString('id-ID')
//             }
//         }
//     });

//     chart.render();
//     window[chartId] = chart;
// };

// const createBarChart = (chartId, seriesData, categories) => {
//     const el = document.getElementById(chartId);

//     // Hapus chart lama kalau ada
//     if (window[chartId] instanceof ApexCharts) {
//         window[chartId].destroy();
//     }

//     const chart = new ApexCharts(el, {
//         series: [{
//             data: seriesData
//         }],
//         chart: {
//             type: 'bar',
//             height: 500,
//             toolbar: { show: false }
//         },
//         plotOptions: {
//             bar: {
//                 barHeight: '100%',
//                 distributed: true,
//                 horizontal: true,
//                 dataLabels: {
//                     position: 'bottom',
//                     textAnchor: 'middle',
//                 },
//             }
//         },
//         dataLabels: {
//             enabled: true,
//             textAnchor: 'bottom',
//             style: { colors: ['#333'] },
//             formatter: function (val, opt) {
//                 return categories[opt.dataPointIndex] + ": " + val.toLocaleString('id-ID');
//             },
//             offsetX: 0,
//             dropShadow: { enabled: false }
//         },
//         stroke: {
//             width: 1,
//             colors: ['#fff']
//         },
//         xaxis: {
//             categories: categories,
//             labels: {
//                 formatter: (val, i) => {
//                     // tampilkan tiap 2 gridline saja
//                     return i % 2 === 0 
//                         ? "Rp " + val.toLocaleString('id-ID', { 
//                             minimumFractionDigits: 2, 
//                             maximumFractionDigits: 2 
//                         }) 
//                         : "";
//                 },
//                 style: { fontSize: '13px' }
//             }
//         },
//         yaxis: {
//             labels: {
//                 formatter: (val, i) => i % 2 === 0 ? val.toLocaleString('id-ID') : ''
//             }
//         },
//         tooltip: {
//             y: {
//                 formatter: val => val.toLocaleString('id-ID')
//             }
//         }
//     });

//     chart.render();
//     window[chartId] = chart;
// };

const PieAmChart5 = (chartId, seriesData, categories) => {
    var root = am5.Root.new(chartId);

    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(
        am5percent.PieChart.new(root, {
            endAngle: 270
        })
    );

    var series = chart.series.push(
        am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            endAngle: 270
        })
    );

    series.states.create("hidden", {
        endAngle: -90
    });

    let chartData = categories.map((cat, i) => ({
        category: cat,
        value: seriesData[i] ?? 0
    }));

    series.data.setAll(chartData);

    series.appear(1000, 100);
};

const PartitionedBarAmChart5 = (chartId, data) => {
    var root = am5.Root.new(chartId);

    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "none",
        wheelY: "none",
        layout: root.horizontalLayout,
        paddingLeft: 0
    }));

    var legendData = [];
    var legend = chart.children.push(
        am5.Legend.new(root, {
            nameField  : "name",
            fillField  : "color",
            strokeField: "color",
            marginLeft : 20,
            y          : 20,
            layout     : root.verticalLayout,
            clickTarget: "none"
        })
    );

    // === Y Axis ===
    var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "state",
        renderer: am5xy.AxisRendererY.new(root, {
            minGridDistance: 10,
            minorGridEnabled: true
        }),
        tooltip: am5.Tooltip.new(root, {})
    }));

    yAxis.get("renderer").labels.template.setAll({
        fontSize: 12,
        location: 0.5
    });

    yAxis.data.setAll(data);

    // === X Axis ===
    var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererX.new(root, {}),
        tooltip: am5.Tooltip.new(root, {})
    }));

    // === Series ===
    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        xAxis: xAxis,
        yAxis: yAxis,
        valueXField: "sales",
        categoryYField: "state",
        tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "horizontal"
        })
    }));

    series.columns.template.setAll({
        tooltipText: "{categoryY}: [bold]{valueX}[/]",
        width: am5.percent(90),
        strokeOpacity: 0
    });

    // Warna berdasarkan region
    series.columns.template.adapters.add("fill", function (fill, target) {
        if (target.dataItem) {
            const region = target.dataItem.dataContext.region;
            const colorIndex = [...new Set(data.map(d => d.region))].indexOf(region);
            return chart.get("colors").getIndex(colorIndex);
        }
        return fill;
    });

    series.data.setAll(data);

    // === Buat Legend otomatis berdasarkan region ===
    const uniqueRegions = [...new Set(data.map(d => d.region))];
    uniqueRegions.forEach((region, i) => {
        legendData.push({
            name: region,
            color: chart.get("colors").getIndex(i)
        });
    });

    legend.data.setAll(legendData);

    // === Cursor ===
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        xAxis: xAxis,
        yAxis: yAxis
    }));

    series.appear();
    chart.appear(1000, 100);
};


const SortedBarAmChart5 = (chartId, chartData, sort = "asc") => {
    var root = am5.Root.new(chartId);

    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // Chart
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "none",
        wheelY: "none",
        paddingLeft: 0
    }));

    chart.zoomOutButton.set("forceHidden", true);

    // Renderer Y (kategori)
    var yRenderer = am5xy.AxisRendererY.new(root, {
        minGridDistance: 20
    });

    // Hilangkan garis grid Y
    yRenderer.grid.template.setAll({
        visible: false
    });

    var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "category",
        renderer: yRenderer,
        tooltip: am5.Tooltip.new(root, { themeTags: ["axis"] })
    }));

    // Renderer X (value)
    var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        min: 0,
        numberFormatter: am5.NumberFormatter.new(root, {
            numberFormat: "#,###"
        }),
        extraMax: 0.1,
        renderer: am5xy.AxisRendererX.new(root, {
            strokeOpacity: 0.1,
            minGridDistance: 50
        })
    }));

    // Series
    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueXField: "value",
        categoryYField: "category",
        tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "left",
            labelText: "{categoryY}: {valueX.formatNumber('#,###')}"
        })
    }));

    // Styling kolom
    series.columns.template.setAll({
        cornerRadiusTR: 6,
        cornerRadiusBR: 6,
        strokeOpacity: 0
    });

    series.columns.template.adapters.add("fill", function (fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    series.columns.template.adapters.add("stroke", function (stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    // Set data
    yAxis.data.setAll(chartData);
    series.data.setAll(chartData);

    // Sorting kategori
    function getSeriesItem(category) {
        return series.dataItems.find(dataItem => dataItem.get("categoryY") === category);
    }

    function sortCategoryAxis() {
        // Pilih sorting
        series.dataItems.sort(function (a, b) {
            return sort === "asc"
                ? a.get("valueX") - b.get("valueX")
                : b.get("valueX") - a.get("valueX");
        });

        am5.array.each(yAxis.dataItems, function (dataItem) {
            var seriesDataItem = getSeriesItem(dataItem.get("category"));
            if (seriesDataItem) {
                var index = series.dataItems.indexOf(seriesDataItem);
                var deltaPosition = (index - dataItem.get("index", 0)) / series.dataItems.length;
                dataItem.set("index", index);
                dataItem.set("deltaPosition", -deltaPosition);
                dataItem.animate({
                    key: "deltaPosition",
                    to: 0,
                    duration: 1000,
                    easing: am5.ease.out(am5.ease.cubic)
                });
            }
        });

        yAxis.dataItems.sort(function (a, b) {
            return a.get("index") - b.get("index");
        });
    }

    sortCategoryAxis();

    chart.set("cursor", am5xy.XYCursor.new(root, {
        behavior: "none",
        xAxis: xAxis,
        yAxis: yAxis
    }));

    series.appear(1000);
    chart.appear(1000, 100);
};



