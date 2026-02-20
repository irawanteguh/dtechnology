totalkunjungan();

function totalkunjungan(){
    // var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url+"index.php/monev/kunjungandaily/totalkunjungan",
        // data      : {periode:periode},
        method    : "POST",
        dataType  : "JSON",
        beforeSend: function () {
            $("#chartkunjunganrjri").html("");
        },
        success : function(data){
            var label  = [];
            var rj     = [];
            var ri     = [];
            var result = data.responResult;
            
            for (var i in result) {
                label.push(result[i].periode);
                rj.push(result[i].jmlrj);
                ri.push(result[i].jmlri);
            }

            

            var rjri = {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing : 'easeinout',
                        speed  : 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    }
                },
                plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '40%',
                      endingShape: 'rounded'
                    },
                },
                series: [
                    {name:'Outpatients', data: rj},
                    {name:'Inpatients', data: ri}
                ],
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                fill: {
                    opacity: 1
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: label
                },
                yaxis: [
                    {
                        labels: {
                            show: true,
                            formatter: function (value) {
                                return todesimal(value);
                            }
                        },
                        title: {
                            text: 'Outpatient visits Last 30 Days Data'
                        }
                    },
                    {
                        labels: {
                            show: true,
                            formatter: function (value) {
                                return todesimal(value);
                            }
                        },
                        title: {
                            text: 'Inpatient visits Last 30 Days Data'
                        },
                        opposite: true
                    }
                ]
            };

            new ApexCharts(document.querySelector("#chartkunjunganrjri"),rjri).render();

        }
    });
    return false;
};