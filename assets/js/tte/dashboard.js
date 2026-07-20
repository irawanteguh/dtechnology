function initTrafficChart(divId, statusValue) {

  var root = am5.Root.new(divId);
  root.setThemes([am5themes_Animated.new(root)]);
  root.numberFormatter.setAll({ numberFormat: "#,###" });

  // ===============================
  // CHART
  // ===============================
  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      panX: true,
      wheelX: "panX",
      wheelY: "zoomX",
      pinchZoomX: true,
      paddingLeft: 0
    })
  );

  // ===============================
  // AXES
  // ===============================
  var xAxis = chart.xAxes.push(
    am5xy.DateAxis.new(root, {
      baseInterval: { timeUnit: "second", count: 5 },
      renderer: am5xy.AxisRendererX.new(root, { minGridDistance: 60 }),
      tooltip: am5.Tooltip.new(root, {})
    })
  );

  var yAxis = chart.yAxes.push(
    am5xy.ValueAxis.new(root, {
      renderer: am5xy.AxisRendererY.new(root, {})
    })
  );

  // ===============================
  // SERIES (SMOOTH LINE - OFFICIAL)
  // ===============================
  var series = chart.series.push(
    am5xy.SmoothedXLineSeries.new(root, {
      name: "Status " + statusValue,
      xAxis: xAxis,
      yAxis: yAxis,
      valueXField: "date",
      valueYField: "value",
      tooltip: am5.Tooltip.new(root, {
        labelText: "{name}: {valueY.formatNumber('#,###')}"
      })
    })
  );

  // garis
  series.strokes.template.setAll({ strokeWidth: 2 });

  // ===============================
  // BULLET (POINT)
  // ===============================
  series.bullets.push(function () {
    return am5.Bullet.new(root, {
      sprite: am5.Circle.new(root, {
        radius: 4,
        fill: series.get("stroke"),
        stroke: root.interfaceColors.get("background"),
        strokeWidth: 1
      })
    });
  });

  // ===============================
  // CURSOR
  // ===============================
  var cursor = chart.set(
    "cursor",
    am5xy.XYCursor.new(root, { xAxis: xAxis })
  );
  cursor.lineY.set("visible", false);

  // ===============================
  // LOAD DATA
  // ===============================
  function loadData() {
    $.ajax({
      url: url + "index.php/tte/dashboard/traffictte",
      method: "POST",
      dataType: "JSON",
      success: function (res) {

        if (res.responCode !== "00") return;

        var now   = Date.now();
        var value = 0;

        res.responResult.forEach(row => {
          if (row.status_sign === statusValue) {
            value = parseInt(row.jml || 0);
          }
        });

        // sliding window (max 50 point)
        if (series.data.length >= 50) {
          series.data.removeIndex(0);
        }

        series.data.push({ date: now, value: value });

        series.dataItems.at(-1).animate({
          key: "valueYWorking",
          to: value,
          duration: 600,
          easing: am5.ease.linear
        });
      }
    });
  }

  // ===============================
  // START
  // ===============================
  loadData();
  setInterval(loadData, 5000);
  chart.appear(1000, 100);
}

am5.ready(function () {

  initTrafficChart("charttraffictte0", "0"); // Upload
  initTrafficChart("charttraffictte1", "1"); // Request Sign
  initTrafficChart("charttraffictte2", "2"); // Waiting OTP
  initTrafficChart("charttraffictte3", "3"); // Proses Signing
});




