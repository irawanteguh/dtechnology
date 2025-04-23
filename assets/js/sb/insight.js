datainsight();

function datainsight() {
    $.ajax({
        url       : url + "index.php/sb/insight/datainsight",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");

            $("#grafikPendapatanRS").html("");
        },       
        success: function (data) {
            const labels = [];
            const dataMap = {
                RSMS: [], RSIABM: [], RST: [],
                umumRSMS: [], umumRSIABM: [], umumRST: [],
                asuransiRSMS: [], asuransiRSIABM: [], asuransiRST: [],
                bpjsRSMS: [], bpjsRSIABM: [], bpjsRST: [],
                lainRSMS: [], lainRSIABM: [], lainRST: []
            };
        
            if (data.responCode === "00") {
                const result = data.responResult;
        
                for (const item of result) {
                    labels.push(item.periode);
        
                    dataMap.RSMS.push(parseFloat(item.totalrsms));
                    dataMap.RSIABM.push(parseFloat(item.totalrsiabm));
                    dataMap.RST.push(parseFloat(item.totalrst));
        
                    dataMap.umumRSMS.push(parseFloat(item.umumtotalrsms));
                    dataMap.umumRSIABM.push(parseFloat(item.umumtotalrsiabm));
                    dataMap.umumRST.push(parseFloat(item.umumtotalrst));
        
                    dataMap.asuransiRSMS.push(parseFloat(item.asuransitotalrsms));
                    dataMap.asuransiRSIABM.push(parseFloat(item.asuransitotalrsiabm));
                    dataMap.asuransiRST.push(parseFloat(item.asuransitotalrst));
        
                    dataMap.bpjsRSMS.push(parseFloat(item.bpjstotalrsms));
                    dataMap.bpjsRSIABM.push(parseFloat(item.bpjstotalrsiabm));
                    dataMap.bpjsRST.push(parseFloat(item.bpjstotalrst));
        
                    dataMap.lainRSMS.push(parseFloat(item.laintotalrsms));
                    dataMap.lainRSIABM.push(parseFloat(item.laintotalrsiabm));
                    dataMap.lainRST.push(parseFloat(item.laintotalrst));
                }
        
                // Fungsi hitung rata-rata
                const average = (arr) => arr.reduce((a, b) => a + b, 0) / arr.length;
        
                // Fungsi buat chart dengan 1 rata-rata gabungan
                const createChart = (elementId, seriesData) => {
                    const el = document.getElementById(elementId);
                    const height = parseInt(KTUtil.css(el, "height"));
        
                    const allData = seriesData.flatMap(s => s.data);
                    const avgAll = average(allData);
        
                    const chart = new ApexCharts(el, {
                        series: seriesData,
                        chart: {
                            fontFamily: "inherit",
                            type: 'area',
                            height: height,
                            toolbar: { show: false },
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800,
                                animateGradually: { enabled: true, delay: 150 },
                                dynamicAnimation: { enabled: true, speed: 350 }
                            }
                        },
                        stroke: {
                            curve: "smooth",
                            width: 2,
                            show: true
                        },
                        dataLabels: {
                            enabled: false
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: function (value) {
                                    return todesimal(value);
                                }
                            },
                            title: {
                                text: 'Income this year'
                            }
                        },
                        xaxis: {
                            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                            labels: {
                                style: { colors: "#888", fontSize: "12px" }
                            },
                            axisBorder: { show: true },
                            axisTicks: { show: true }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    });
                                }
                            },
                            x: {
                                show: true,
                                format: "MMM"
                            }
                        },
                        annotations: {
                            yaxis: [{
                                y: avgAll,
                                borderColor: '#FF4560',
                                label: {
                                    borderColor: '#FF4560',
                                    style: {
                                        color: '#fff',
                                        background: '#FF4560'
                                    },
                                    text: 'Rata-rata: ' + avgAll.toLocaleString('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    })
                                }
                            }]
                        }
                    });
        
                    chart.render();
                };
        
                // Chart Pendapatan Total
                createChart("grafikPendapatanRS", [
                    { name: "RSU Mutiasari", data: dataMap.RSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.RSIABM },
                    { name: "RS Thursina", data: dataMap.RST }
                ]);
        
                // Chart Umum
                createChart("grafikPendapatanUmum", [
                    { name: "RSU Mutiasari", data: dataMap.umumRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.umumRSIABM },
                    { name: "RS Thursina", data: dataMap.umumRST }
                ]);
        
                // Chart Asuransi
                createChart("grafikPendapatanAsuransi", [
                    { name: "RSU Mutiasari", data: dataMap.asuransiRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.asuransiRSIABM },
                    { name: "RS Thursina", data: dataMap.asuransiRST }
                ]);
        
                // Chart BPJS
                createChart("grafikPendapatanBPJS", [
                    { name: "RSU Mutiasari", data: dataMap.bpjsRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.bpjsRSIABM },
                    { name: "RS Thursina", data: dataMap.bpjsRST }
                ]);
        
                // Chart Lain-lain
                createChart("grafikPendapatanLain", [
                    { name: "RSU Mutiasari", data: dataMap.lainRSMS },
                    { name: "RSIA Budhi Mulia", data: dataMap.lainRSIABM },
                    { name: "RS Thursina", data: dataMap.lainRST }
                ]);
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
