dokumentteuser();


$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    dokumentteuser();
});

function dokumentteuser(){
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url: url + "index.php/tilakaV2/dashboard/dokumentteuser",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            if (am4core.registry.baseSprites.length) {
                am4core.disposeAllCharts();
            }
        },       
        success: function (data) {
            if(data.responCode === "00"){
                var nilaiDetail = [];
                var result = data.responResult;

                $.each(result, function (i, row) {
                    nilaiDetail.push({
                        user   : row.name,
                        jumlah : parseInt(row.jml)
                    });
                });

                // console.log(nilaiDetail);

                // ===============================
                // Chart Dokumen TTE per User
                // ===============================

                // Hindari double render
                if (am4core.registry.baseSprites.length) {
                    am4core.disposeAllCharts();
                }

                // Create chart
                var chartdetail = am4core.create(
                    "chartdokumentteuser",
                    am4charts.XYChart
                );

                chartdetail.data = nilaiDetail;
                chartdetail.padding(15, 15, 15, 15);

                // ===============================
                // Y-Axis (Nama User)
                // ===============================
                var categoryAxis = chartdetail.yAxes.push(
                    new am4charts.CategoryAxis()
                );
                categoryAxis.dataFields.category = "user";
                categoryAxis.renderer.grid.template.disabled = true;
                categoryAxis.renderer.minGridDistance = 25;
                categoryAxis.renderer.labels.template.fill = am4core.color("#6c757d");

                // Sort berdasarkan nilai terbesar
                categoryAxis.sortBySeries = chartdetail.series.values[0];

                // ===============================
                // X-Axis (Jumlah Dokumen)
                // ===============================
                var valueAxis = chartdetail.xAxes.push(
                    new am4charts.ValueAxis()
                );
                valueAxis.min = 0;
                valueAxis.renderer.labels.template.fill = am4core.color("#6c757d");
                valueAxis.title.text = "Jumlah Dokumen TTE";

                // ===============================
                // Series (Horizontal Bar)
                // ===============================
                var series = chartdetail.series.push(
                    new am4charts.ColumnSeries()
                );
                series.dataFields.categoryY = "user";
                series.dataFields.valueX = "jumlah";
                series.tooltipText = "{categoryY}: [bold]{valueX}[/] dokumen";

                series.columns.template.strokeOpacity = 0;
                series.columns.template.cornerRadiusTopRight = 8;
                series.columns.template.cornerRadiusBottomRight = 8;
                series.columns.template.height = am4core.percent(65);

                // ===============================
                // Label di ujung bar
                // ===============================
                // var labelBullet = series.bullets.push(
                //     new am4charts.LabelBullet()
                // );
                // labelBullet.label.text = "{valueX}";
                // labelBullet.label.horizontalCenter = "left";
                // labelBullet.label.dx = 10;

                // ===============================
                // Animasi (besar → kecil)
                // ===============================
                series.sequencedInterpolation = true;
                series.sequencedInterpolationDelay = 120;
                series.defaultState.transitionDuration = 900;

                // ===============================
                // Cursor
                // ===============================
                chartdetail.cursor = new am4charts.XYCursor();
                chartdetail.cursor.behavior = "panY";
                chartdetail.cursor.lineX.disabled = true;


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

function initTrafficChart(divId, statusValue) {

  var root = am5.Root.new(divId);
  root.setThemes([am5themes_Animated.new(root)]);
  root.numberFormatter.setAll({ numberFormat: "#,###" });

  var chart = root.container.children.push(
    am5xy.XYChart.new(root, {
      panX: true,
      wheelX: "panX",
      wheelY: "zoomX",
      pinchZoomX: true,
      paddingLeft: 0
    })
  );

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

  var series = chart.series.push(
    am5xy.LineSeries.new(root, {
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

  // 🔴 animated bullet
  series.bullets.push(function () {
    var circle = am5.Circle.new(root, {
      radius: 4,
      fill: series.get("stroke"),
      stroke: root.interfaceColors.get("background"),
      strokeWidth: 1
    });

    return am5.Bullet.new(root, { sprite: circle });
  });

  // cursor
  var cursor = chart.set("cursor",
    am5xy.XYCursor.new(root, { xAxis: xAxis })
  );
  cursor.lineY.set("visible", false);

  function loadData() {

    $.ajax({
      url: url + "index.php/tilakaV2/dashboard/traffictte",
      method: "POST",
      dataType: "JSON",
      success: function (res) {

        if (res.responCode !== "00") return;

        var now = Date.now();
        var value = 0;

        res.responResult.forEach(row => {
          if (row.status_sign === statusValue) {
            value = parseInt(row.jml);
          }
        });

        // sliding window (10 data terakhir)
        if (series.data.length >= 10) {
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

  loadData();
  setInterval(loadData, 5000);

  chart.appear(1000, 100);
}


am5.ready(function () {

  initTrafficChart("charttraffictte0", "0"); // Upload
  initTrafficChart("charttraffictte1", "1"); // Request Sign
  initTrafficChart("charttraffictte3", "3"); // Proses Signing
});




