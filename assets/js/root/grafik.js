
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

const SortedBarAmChart5 = (chartId, chartData, sort = "asc") => {
    var root = am5.Root.new(chartId);

    root.setThemes([
        am5themes_Animated.new(root)
    ]);


    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX       : false,
        panY       : false,
        wheelX     : "none",
        wheelY     : "none",
        paddingLeft: 0
    }));

    chart.zoomOutButton.set("forceHidden", true);

    var yRenderer = am5xy.AxisRendererY.new(root, {
        minGridDistance: 10,
        minorGridEnabled: false
    });

    yRenderer.grid.template.setAll({
        visible: false
    });

    var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation : 0,
        categoryField: "category",
        renderer     : yRenderer,
    }));

    yAxis.get("renderer").labels.template.set("visible", false);
    yAxis.get("renderer").grid.template.set("visible", false);
    yAxis.get("renderer").ticks.template.set("visible", false);

    var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0,
        min: 1,
        logarithmic: true,
        numberFormatter: am5.NumberFormatter.new(root, {
            numberFormat: "#,###"
        }),
        extraMax: 1,
        renderer: am5xy.AxisRendererX.new(root, {
            strokeOpacity: 0.1,
            minGridDistance: 80
        })
    }));

    xAxis.get("renderer").labels.template.set("visible", false);
    xAxis.get("renderer").grid.template.set("visible", false);
    xAxis.get("renderer").ticks.template.set("visible", false);


    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name          : "Series 1",
        xAxis         : xAxis,
        yAxis         : yAxis,
        valueXField   : "value",
        categoryYField: "category",
        tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "left",
            labelText: "{categoryY} : {valueX}"
        })
    }));


    // Rounded corners for columns
    series.columns.template.setAll({
        cornerRadiusTR: 5,
        cornerRadiusBR: 5,
        strokeOpacity: 0
    });

    series.columns.template.adapters.add("fill", function (fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    series.columns.template.adapters.add("stroke", function (stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
    });


    yAxis.data.setAll(chartData);

    series.bullets.push(function () {
        return am5.Bullet.new(root, {
            locationX: 1, // posisi relatif di bar
            sprite: am5.Label.new(root, {
                text: "{categoryY} : {valueX}",   // tampilkan category + value
                populateText: true,
                centerY: am5.p50,   // vertikal tengah
                centerX: am5.p100,  // posisikan di dalam bar (kanan)
                paddingRight: 10,   // jarak dari tepi dalam bar
                fontSize: 12,
                fill: am5.color(0xffffff), // teks putih biar kontras
                fontWeight: "bold"
            })
        });
    });

    series.data.setAll(chartData);
    sortCategoryAxis();

    function getSeriesItem(category) {
        for (var i = 0; i < series.dataItems.length; i++) {
            var dataItem = series.dataItems[i];
            if (dataItem.get("categoryY") == category) {
                return dataItem;
            }
        }
    }

    chart.set("cursor", am5xy.XYCursor.new(root, {
        behavior: "none",
        xAxis: xAxis,
        yAxis: yAxis
    }));


    function sortCategoryAxis() {
        series.dataItems.sort(function (x, y) {
            return x.get("valueX") - y.get("valueX"); // descending
            //return y.get("valueY") - x.get("valueX"); // ascending
        })

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
                })
            }
        });

        yAxis.dataItems.sort(function (x, y) {
            return x.get("index") - y.get("index");
        });
    }

    series.appear(1000);
    chart.appear(1000, 100);
};