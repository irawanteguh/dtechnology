datainsight();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    datainsight();
});

function datainsight() {
    const periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url + "index.php/sb/grafik/datainsight",
        data      : {periode: periode},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success: function (data) {
            const dataMap = {
                rsms: {
                    id       : "rsms",
                    name     : "RSU Mutiasari",
                    dataValue: []
                },
                rsiabm: {
                    id       : "rsiabm",
                    name     : "RSIA Budhi Mulia",
                    dataValue: []
                },
                rst: {
                    id       : "rst",
                    name     : "RS Thursina",
                    dataValue: []
                },
                periode: [],
            };

            if(data.responCode === "00"){
                const result = data.responResult;

                result.forEach(item => {
                    dataMap.periode.push(item.periode);
                });

                const pushToDataMap = (item, key) => {
                    const hospital = dataMap[key];

                    if(hospital){
                        let kunjunganperbulan          = '';
                        let kunjunganperbulanumum      = '';
                        let kunjunganperbulanasuransi  = '';
                        let kunjunganperbulanbpjs      = '';
                        let kunjunganperbulanmcu       = '';

                        if(key === 'rsms'){
                            kunjunganperbulan         = 'kunjungantotalrsms';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsms';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsms';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsms';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrsms';
                        }

                        if(key === 'rsiabm'){
                            kunjunganperbulan         = 'kunjungantotalrsiabm';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsiabm';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsiabm';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsiabm';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrsiabm';
                        }

                        if(key === 'rst'){
                            kunjunganperbulan         = 'kunjungantotalrst';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrst';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrst';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrst';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrst';
                        }

                        hospital.dataValue.push({
                            periode                   : item.periode,
                            kunjunganperbulan         : parseFloat(item[kunjunganperbulan]),
                            kunjunganperbulanumum     : parseFloat(item[kunjunganperbulanumum]),
                            kunjunganperbulanasuransi : parseFloat(item[kunjunganperbulanasuransi]),
                            kunjunganperbulanbpjs     : parseFloat(item[kunjunganperbulanbpjs]),
                            kunjunganperbulanmcu      : parseFloat(item[kunjunganperbulanmcu])
                        });
                    }
                };

                result.forEach(item => {
                    pushToDataMap(item, 'rsms');
                    pushToDataMap(item, 'rsiabm');
                    pushToDataMap(item, 'rst');
                });

                const jumlahPeriodeValid = dataMap.periode.filter((_, index) => {
                    return (
                        dataMap.rsms.dataValue[index].kunjunganperbulan > 0 ||
                        dataMap.rsiabm.dataValue[index].kunjunganperbulan > 0 ||
                        dataMap.rst.dataValue[index].kunjunganperbulan > 0
                    );
                }).length;

                const totalKunjunganRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganAll  = totalKunjunganRSMS + totalKunjunganRSIA + totalKunjunganRST;

                const avgKunjungantotal     = Math.round(totalKunjunganAll / (jumlahPeriodeValid * 3));

                createChartlinebar("grafikKunjunganRS",
                    [
                        {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulan)},
                        {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulan)},
                        {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulan)}
                    ],
                avgKunjungantotal, 'bar',"Kunjungan Pasien");
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
}

const createChartlinebar = (elementId, seriesData, avgLine = null, chartType = 'bar', titlechart) => {
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