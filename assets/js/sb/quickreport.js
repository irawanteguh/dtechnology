var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"
var todolistChart;

databulan();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    databulan();
});

flatpickr('[name="modal_quickreport_add_date"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

flatpickr('[name="modal_quickreport_add_date_kunjungan"]', {
    enableTime: false,
    dateFormat: "d.m.Y",
    maxDate: "today",
    onChange  : function(selectedDates, dateStr, instance) {
        instance.close();
    }
});

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
    var data_lain      = btn.attr("data_lain");
    var data_kurj      = btn.attr("data_kurj");
    var data_kuri      = btn.attr("data_kuri");
    var data_karj      = btn.attr("data_karj");
    var data_kari      = btn.attr("data_kari");
    var data_kbrj      = btn.attr("data_kbrj");
    var data_kbri      = btn.attr("data_kbri");

    $('#modal_quickreport_add_date').val(data_parameter);
    $('#modal_quickreport_add_date_kunjungan').val(data_parameter);

    $('#URJ').val(data_urj === "null" || data_urj === "" ? "" : formatRupiah(data_urj));
    $('#URI').val(data_uri === "null" || data_uri === "" ? "" : formatRupiah(data_uri));
    $('#ARJ').val(data_arj === "null" || data_arj === "" ? "" : formatRupiah(data_arj));
    $('#ARI').val(data_ari === "null" || data_ari === "" ? "" : formatRupiah(data_ari));
    $('#BRJ').val(data_brj === "null" || data_brj === "" ? "" : formatRupiah(data_brj));
    $('#BRI').val(data_bri === "null" || data_bri === "" ? "" : formatRupiah(data_bri));
    $('#LAIN').val(data_lain === "null" || data_lain === "" ? "" : formatRupiah(data_lain))
    ;
    $('#KURJ').val(data_kurj === "null" || data_kurj === "" ? "" : data_kurj);
    $('#KURI').val(data_kuri === "null" || data_kuri === "" ? "" : data_kuri);
    $('#KARJ').val(data_karj === "null" || data_karj === "" ? "" : data_karj);
    $('#KARI').val(data_kari === "null" || data_kari === "" ? "" : data_kari);
    $('#KBRJ').val(data_kbrj === "null" || data_kbrj === "" ? "" : data_kbrj);
    $('#KBRI').val(data_kbri === "null" || data_kbri === "" ? "" : data_kbri);

};

function databulan() {
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
            }

            am4core.useTheme(am4themes_animated);
        },       
        success: function (data) {
            var totalPerMonth = {};
            var countPerMonth = {};
        
            for (var m = 1; m <= 12; m++) {
                var key = m < 10 ? '0' + m : '' + m;
                totalPerMonth[key] = {
                    urj: 0, uri: 0, arj: 0, ari: 0, brj: 0, bri: 0, lain: 0
                };
                countPerMonth[key] = 0;
            }
        
            if (data.responCode === "00") {
                var result = data.responResult;
        
                for (var i in result) {
                    var item = result[i];
                    var month = item.bulan;
        
                    // Tambah nilai ke total per bulan
                    totalPerMonth[month].urj += parseFloat(item.urj || 0);
                    totalPerMonth[month].uri += parseFloat(item.uri || 0);
                    totalPerMonth[month].arj += parseFloat(item.arj || 0);
                    totalPerMonth[month].ari += parseFloat(item.ari || 0);
                    totalPerMonth[month].brj += parseFloat(item.brj || 0);
                    totalPerMonth[month].bri += parseFloat(item.bri || 0);
                    totalPerMonth[month].lain += parseFloat(item.lain || 0);
                    countPerMonth[month]++;
        
                    // Get variabel untuk edit
                    var getvariabel = " data_parameter='" + item.parameter + "'" +
                        " data_urj='" + item.urj + "'" +
                        " data_uri='" + item.uri + "'" +
                        " data_arj='" + item.arj + "'" +
                        " data_ari='" + item.ari + "'" +
                        " data_brj='" + item.brj + "'" +
                        " data_bri='" + item.bri + "'" +
                        " data_lain='" + item.lain + "'"+
                        " data_kurj='" + item.kurj + "'" +
                        " data_kuri='" + item.kuri + "'" +
                        " data_karj='" + item.karj + "'" +
                        " data_kari='" + item.kari + "'" +
                        " data_kbrj='" + item.kbrj + "'" +
                        " data_kbri='" + item.kbri + "'" ;
        
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
                    tableresult += "<td class='text-end'>" + todesimal(item.lain || 0) + "</td>";
        
                    var totalRajal = parseFloat(item.urj || 0) + parseFloat(item.arj || 0) + parseFloat(item.brj || 0);
                    var totalInap = parseFloat(item.uri || 0) + parseFloat(item.ari || 0) + parseFloat(item.bri || 0);
                    var totalAkhir = totalRajal + totalInap + parseFloat(item.lain || 0);
        
                    tableresult += "<td class='text-end'>" + todesimal(totalRajal) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalInap) + "</td>";
                    tableresult += "<td class='text-end'>" + todesimal(totalAkhir) + "</td>";
                    tableresult += "<td class='text-end pe-4'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_add'" + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a></td>";
                    tableresult += "</tr>";

                    var ktotalRajal = parseFloat(item.kurj || 0) + parseFloat(item.karj || 0) + parseFloat(item.kbrj || 0);
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
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalRajal) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalInap) + "</td>";
                        tablekunjungan += "<td class='text-center'>" + todesimal(ktotalAkhir) + "</td>";
                        tablekunjungan += "<td class='text-end pe-4'><a class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modal_quickreport_addkunjungan'" + getvariabel + " onclick='getdata($(this));'><i class='bi bi-pencil-fill'></i></a></td>";
                        tablekunjungan += "</tr>";
        
                    $("#resultbln" + month).append(tableresult);
                    $("#resultkunjungan" + month).append(tablekunjungan);
                }
        
                // Looping per bulan untuk buat average dan chart
                for (var m = 1; m <= 12; m++) {
                    var month = m < 10 ? '0' + m : '' + m;
                    var total = totalPerMonth[month];
                    var count = countPerMonth[month] || 1;
        
                    var avgRow = "<tr class='fw-bolder text-muted bg-light align-middle'>";
                    avgRow += "<td colspan='2' class='ps-4'>Average</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.urj / count)) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.uri / count)) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.arj / count)) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.ari / count)) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.brj / count)) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(Math.round(total.bri / count)) + "</td>";
                    avgRow += "<td class='text-end' rowspan='2'>" + todesimal(Math.round(total.lain / count)) + "</td>";
        
                    var avetotalRajal = Math.round((total.urj + total.arj + total.brj) / count);
                    var avetotalInap  = Math.round((total.uri + total.ari + total.bri) / count);
                    var totalRajal    = total.urj + total.arj + total.brj;
                    var totalInap     = total.uri + total.ari + total.bri;
                    var totalAkhir    = totalRajal + totalInap + total.lain;
        
                    avgRow += "<td class='text-end'>" + todesimal(avetotalRajal) + "</td>";
                    avgRow += "<td class='text-end'>" + todesimal(avetotalInap) + "</td>";
                    avgRow += "<td class='text-end' rowspan='2'>" + todesimal(totalAkhir) + "</td>";
                    avgRow += "<td class='text-end' rowspan='2'></td>";
                    avgRow += "</tr>";
        
                    avgRow += "<tr class='fw-bolder text-muted bg-light align-middle'>";
                    avgRow += "<td colspan='2' class='ps-4'>Total Average</td>";
                    avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.urj / count) + Math.round(total.uri / count)) + "</td>";
                    avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.arj / count) + Math.round(total.ari / count)) + "</td>";
                    avgRow += "<td class='text-center' colspan='2'>" + todesimal(Math.round(total.brj / count) + Math.round(total.bri / count)) + "</td>";
                    avgRow += "<td class='text-center' colspan='2'>" + todesimal(avetotalRajal + avetotalInap) + "</td>";
                    avgRow += "</tr>";
        
                    $("#resultbln" + month).append(avgRow);
        
                    // Update info summary
                    var asuransi = total.arj + total.ari;
                    var umum = total.urj + total.uri;
                    var bpjs = total.brj + total.bri;
        
                    $("#total" + month).html("Rp. " + todesimal(totalAkhir));
                    $("#umum" + month).html("Rp. " + todesimal(umum));
                    $("#asuransi" + month).html("Rp. " + todesimal(asuransi));
                    $("#bpjs" + month).html("Rp. " + todesimal(bpjs));
                    $("#lain" + month).html("Rp. " + todesimal(total.lain));
        
                    
                    var nilaiGroup = [
                        { "category": "UMUM", "value": total.urj + total.uri, "color": "#0D6EFD" },
                        { "category": "ASURANSI", "value": total.arj + total.ari, "color": "#DC3545" },
                        { "category": "BPJS", "value": total.brj + total.bri, "color": "#20C997" },
                        { "category": "LAIN-LAIN", "value": total.lain, "color": "#FFC107" }
                    ];
                
                    var nilaiDetail = [
                        { country: "UMUM Rajal", visits: total.urj, color: "#4A90E2" },
                        { country: "UMUM Ranap", visits: total.uri, color: "#50E3C2" },
                        { country: "Asuransi Rajal", visits: total.arj, color: "#F5A623" },
                        { country: "Asuransi Ranap", visits: total.ari, color: "#F8E71C" },
                        { country: "BPJS Rajal", visits: total.brj, color: "#7ED321" },
                        { country: "BPJS Ranap", visits: total.bri, color: "#417505" },
                        { country: "Lain-lain", visits: total.lain, color: "#BD10E0" }
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
                databulan();
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
                databulan();
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