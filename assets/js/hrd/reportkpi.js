

$(document).on("click",".btn-apply", function(e){            
    e.preventDefault();
    var periode    = $("select[name='toolbar_report_kpi']").val();

    liststaff(periode);
    kepatuhaninput(periode);
});

function liststaff(periode){
    $.ajax({
        url        : url+"index.php/hrd/reportkpi/reportkpi",
        data :{periode:periode},
        method     : "POST",
        dataType   : "JSON",
        cache      : false,
        processData: true,
        beforeSend : function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
            $("#resultkpi").html("");
        },
        success:function(data){
            toastr.clear();
            var result              = "";
            var tableresult         = "";

            if(data.responCode==="00"){
                result        = data.responResult;
                for(var i in result){
                    tableresult +="<tr>";
                    tableresult +="<td class='ps-4'>"+result[i].name+"</td>";
                    tableresult +="<td class='text-left'>"+(result[i].position ? result[i].position : "")+"</td>";
                    tableresult +="<td class='text-center'>"+result[i].presentasiactivity+"%</td>";
                    tableresult +="<td class='text-center'>"+result[i].presentasiperilaku+"%</td>";
                    tableresult +="<td class='text-center'>"+result[i].resultkpi+"%</td>";
                    tableresult +="<td class='pe-4 text-end'><a class='btn btn-primary btn-sm'>Detail</a></td>";
                    tableresult +="</tr>";
                }
            }

            $("#resultkpi").html(tableresult);
            toastr[data.responHead](data.responDesc, "INFORMATION");
        },
        complete: function () {

		},
        error: function(xhr, status, error) {
            Swal.fire({
                title            : "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
                html             : "<b>"+error+"</b>",
                icon             : "error",
                confirmButtonText: "Please Try Again",
                buttonsStyling   : false,
                timerProgressBar : true,
                timer            : 5000,
                customClass      : {
                    confirmButton: "btn btn-danger"
                },
                showClass: {popup: "animate__animated animate__fadeInUp animate__faster"},
                hideClass: {popup: "animate__animated animate__fadeOutDown animate__faster"}
            });
		}
    });
    return false;
};

function kepatuhaninput(periode){
    $.ajax({
        url: url + "index.php/hrd/reportkpi/kepatuhaninput",
        data :{periode:periode},
        method: "GET",
        dataType: "JSON",
        success: function (data) {
            var result = data.responResult;
            var chart  = am4core.create("responseauth", am4charts.GaugeChart);

            chart.innerRadius = -15;

            var axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = 0;
            axis.max = 100;
            axis.strictMinMax = true;

            var colorSet = new am4core.ColorSet();

            var range0 = axis.axisRanges.create();
            range0.value                = 0;
            range0.endValue             = 50;
            range0.axisFill.fillOpacity = 1;
            range0.axisFill.fill        = colorSet.getIndex(0);
            range0.axisFill.zIndex      = - 1;

            var range1 = axis.axisRanges.create();
            range1.value                = 50;
            range1.endValue             = 75;
            range1.axisFill.fillOpacity = 1;
            range1.axisFill.fill        = colorSet.getIndex(2);
            range1.axisFill.zIndex      = -1;

            var range2 = axis.axisRanges.create();
            range2.value                = 75;
            range2.endValue             = 100;
            range2.axisFill.fillOpacity = 1;
            range2.axisFill.fill        = colorSet.getIndex(4);
            range2.axisFill.zIndex      = -1;

            var label = chart.radarContainer.createChild(am4core.Label);
            label.isMeasured = false;
            label.fontSize = "1em";
            label.horizontalCenter = "middle";
            label.verticalCenter = "bottom";
            label.text = result[0].presentasi+" %";

            var hand = chart.hands.push(new am4charts.ClockHand());
            hand.innerRadius = am4core.percent(20);
            hand.pin.disabled = true;
            // hand.fill = am4core.color("#ffffff");
            // hand.stroke = am4core.color("#ffffff");
            hand.showValue(parseInt(result[0].presentasi));
        }
    });
    return false;
};