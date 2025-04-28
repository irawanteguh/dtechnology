datainsight();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    datainsight();
});

function datainsight() {
    const periode = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url: url + "index.php/sb/insight/datainsight",
        data: { periode: periode },
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            toastr.clear();
            toastr["info"]("Sending request...", "Please wait");
        },
        success: function (data) {
            const dataMap = {
                rsms: {
                    id: "rsms",
                    name: "RSU Mutiasari",
                    dataValue: []
                },
                rsiabm: {
                    id: "rsiabm",
                    name: "RSIA Budhi Mulia",
                    dataValue: []
                },
                rst: {
                    id: "rst",
                    name: "RS Thursina",
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

                    if (hospital) {
                        let pendapatanperbulan         = '';
                        let pendapatanperbulanumum     = '';
                        let pendapatanperbulanasuransi = '';
                        let pendapatanperbulanbpjs     = '';
                        let pendapatanperbulanlain     = '';
                        let kunjunganperbulan          = '';
                        let kunjunganperbulanumum      = '';
                        let kunjunganperbulanasuransi  = '';
                        let kunjunganperbulanbpjs      = '';

                        if(key === 'rsms'){
                            pendapatanperbulan         = 'pendapatantotalrsms';
                            pendapatanperbulanumum     = 'umumtotalrsms';
                            pendapatanperbulanasuransi = 'asuransitotalrsms';
                            pendapatanperbulanbpjs     = 'bpjstotalrsms';
                            pendapatanperbulanlain     = 'laintotalrsms';

                            kunjunganperbulan         = 'kunjungantotalrsms';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsms';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsms';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsms';
                        }

                        if(key === 'rsiabm'){
                            pendapatanperbulan         = 'pendapatantotalrsiabm';
                            pendapatanperbulanumum     = 'umumtotalrsiabm';
                            pendapatanperbulanasuransi = 'asuransitotalrsiabm';
                            pendapatanperbulanbpjs     = 'bpjstotalrsiabm';
                            pendapatanperbulanlain     = 'laintotalrsiabm';

                            kunjunganperbulan         = 'kunjungantotalrsiabm';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsiabm';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsiabm';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsiabm';
                        }

                        if(key === 'rst'){
                            pendapatanperbulan         = 'pendapatantotalrst';
                            pendapatanperbulanumum     = 'umumtotalrst';
                            pendapatanperbulanasuransi = 'asuransitotalrst';
                            pendapatanperbulanbpjs     = 'bpjstotalrst';
                            pendapatanperbulanlain     = 'laintotalrst';

                            kunjunganperbulan         = 'kunjungantotalrst';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrst';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrst';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrst';
                        }

                        hospital.dataValue.push({
                            periode                   : item.periode,
                            pendapatanperbulan        : parseFloat(item[pendapatanperbulan]),
                            pendapatanperbulanumum    : parseFloat(item[pendapatanperbulanumum]),
                            pendapatanperbulanasuransi: parseFloat(item[pendapatanperbulanasuransi]),
                            pendapatanperbulanbpjs    : parseFloat(item[pendapatanperbulanbpjs]),
                            pendapatanperbulanlain    : parseFloat(item[pendapatanperbulanlain]),
                            kunjunganperbulan         : parseFloat(item[kunjunganperbulan]),
                            kunjunganperbulanumum     : parseFloat(item[kunjunganperbulanumum]),
                            kunjunganperbulanasuransi : parseFloat(item[kunjunganperbulanasuransi]),
                            kunjunganperbulanbpjs     : parseFloat(item[kunjunganperbulanbpjs])
                        });
                    }
                };

                // Memasukkan data untuk setiap rumah sakit
                result.forEach(item => {
                    pushToDataMap(item, 'rsms');
                    pushToDataMap(item, 'rsiabm');
                    pushToDataMap(item, 'rst');
                });


                // Menghitung rata-rata dan total pendapatan
                const totalPendapatanRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanAll = totalPendapatanRSMS + totalPendapatanRSIA + totalPendapatanRST;

                const totalPendapatanUmumRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumAll = totalPendapatanUmumRSMS + totalPendapatanUmumRSIA + totalPendapatanUmumRST;


                const totalPendapatanAsuransiRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapatanAsuransiRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapatanAsuransiRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapataAsuransimAll = totalPendapatanAsuransiRSMS + totalPendapatanAsuransiRSIA + totalPendapatanAsuransiRST;


                const totalPendapatanBPJSRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSAll = totalPendapatanBPJSRSMS + totalPendapatanBPJSRSIA + totalPendapatanBPJSRST;


                const totalPendapatanLainRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainAll = totalPendapatanLainRSMS + totalPendapatanLainRSIA + totalPendapatanLainRST;

                // Menghitung rata-rata dan total kunjungan
                const totalKunjunganRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganAll = totalKunjunganRSMS + totalKunjunganRSIA + totalKunjunganRST;

                const totalKunjunganUmumRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumAll = totalKunjunganUmumRSMS + totalKunjunganUmumRSIA + totalKunjunganUmumRST;

                const totalKunjunganAsuransiRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiAll = totalKunjunganAsuransiRSMS + totalKunjunganAsuransiRSIA + totalKunjunganAsuransiRST;

                const totalKunjunganBPJSRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSAll = totalKunjunganBPJSRSMS + totalKunjunganBPJSRSIA + totalKunjunganBPJSRST;

                const jumlahPeriodeValid = dataMap.periode.filter((_, index) => {
                    return (
                        dataMap.rsms.dataValue[index].pendapatanperbulan > 0 ||
                        dataMap.rsiabm.dataValue[index].pendapatanperbulan > 0 ||
                        dataMap.rst.dataValue[index].pendapatanperbulan > 0
                    );
                }).length;

                // Menghitung rata-rata pendapatan total dan kunjungan total 
                const avgPendapatantotal    = Math.round(totalPendapatanAll / (jumlahPeriodeValid * 3));
                const avgKunjungantotal     = Math.round(totalKunjunganAll / (jumlahPeriodeValid * 3));
                const avgPendapatanumum     = Math.round(totalPendapatanUmumAll / (jumlahPeriodeValid * 3));
                const avgKunjunganumum      = Math.round(totalKunjunganUmumAll / (jumlahPeriodeValid * 3));
                const avgPendapatanasuransi = Math.round(totalPendapataAsuransimAll / (jumlahPeriodeValid * 3));
                const avgKunjunganasuransi  = Math.round(totalKunjunganAsuransiAll / (jumlahPeriodeValid * 3));
                const avgPendapatanbpjs     = Math.round(totalPendapatanBPJSAll / (jumlahPeriodeValid * 3));
                const avgKunjunganbpjs      = Math.round(totalKunjunganBPJSAll / (jumlahPeriodeValid * 3));
                const avgPendapatanlain     = Math.round(totalPendapatanLainAll / (jumlahPeriodeValid * 3));

                // Membuat chart dengan data
                createChartlinebar("grafikPendapatanRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulan)}
                ], "grafikPendapatanRS", avgPendapatantotal, 'area',"Annual Revenue Trends Across Hospitals");

                createChartlinebar("grafikKunjunganRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulan)}
                ], "grafikKunjunganRS", avgKunjungantotal, 'bar',"Annual Patient Visits Across Hospitals");


                const seriesProvider = [
                    {name: 'RSU Mutiasari',data: [totalPendapatanUmumRSMS, totalPendapatanAsuransiRSMS, totalPendapatanBPJSRSMS, totalPendapatanLainRSMS]},
                    {name: 'RSIA Budhi Mulia',data: [totalPendapatanUmumRSIA, totalPendapatanAsuransiRSIA, totalPendapatanBPJSRSIA, totalPendapatanLainRSIA]},
                    {name: 'RS Thursina',data: [totalPendapatanUmumRST, totalPendapatanAsuransiRST, totalPendapatanBPJSRST, totalPendapatanLainRST]}
                ];
                
                const seriesKunjungan = [
                    {name: 'RSU Mutiasari',data: [totalKunjunganUmumRSMS, totalKunjunganAsuransiRSMS, totalKunjunganBPJSRSMS]},
                    {name: 'RSIA Budhi Mulia',data: [totalKunjunganUmumRSIA, totalKunjunganAsuransiRSIA, totalKunjunganBPJSRSIA]},
                    {name: 'RS Thursina',data: [totalKunjunganUmumRST, totalKunjunganAsuransiRST, totalKunjunganBPJSRST]}
                ];

                const hospitalsData = [
                    { 
                        id:"rms",
                        name: "RSU Mutiasari",
                        kunjungan: [
                            { category: "UMUM", value: totalKunjunganUmumRSMS, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalKunjunganAsuransiRSMS, color: "#DC3545" },
                            { category: "BPJS", value: totalKunjunganBPJSRSMS, color: "#20C997" }
                        ],
                        pendapatan: [
                            { category: "UMUM", value: totalPendapatanUmumRSMS, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalPendapatanAsuransiRSMS, color: "#DC3545" },
                            { category: "BPJS", value: totalPendapatanBPJSRSMS, color: "#20C997" },
                            { category: "LAIN", value: totalPendapatanLainRSMS, color: "#6F42C1" }
                        ]
                    },
                    { 
                        id:"rsiabm",
                        name: "RSIA Budhi Mulia",
                        kunjungan: [
                            { category: "UMUM", value: totalKunjunganUmumRSIA, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalKunjunganAsuransiRSIA, color: "#DC3545" },
                            { category: "BPJS", value: totalKunjunganBPJSRSIA, color: "#20C997" }
                        ],
                        pendapatan: [
                            { category: "UMUM", value: totalPendapatanUmumRSIA, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalPendapatanAsuransiRSIA, color: "#DC3545" },
                            { category: "BPJS", value: totalPendapatanBPJSRSIA, color: "#20C997" },
                            { category: "LAIN", value: totalPendapatanLainRSIA, color: "#6F42C1" }
                        ]
                    },
                    { 
                        id:"rst",
                        name: "RS Thursina",
                        kunjungan: [
                            { category: "UMUM", value: totalKunjunganUmumRST, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalKunjunganAsuransiRST, color: "#DC3545" },
                            { category: "BPJS", value: totalKunjunganBPJSRST, color: "#20C997" }
                        ],
                        pendapatan: [
                            { category: "UMUM", value: totalPendapatanUmumRST, color: "#0D6EFD" },
                            { category: "ASURANSI", value: totalPendapatanAsuransiRST, color: "#DC3545" },
                            { category: "BPJS", value: totalPendapatanBPJSRST, color: "#20C997" },
                            { category: "LAIN", value: totalPendapatanLainRST, color: "#6F42C1" }
                        ]
                    }
                ];


                const chartProvider          = createRadarChart("grafikDistribusiProvider", seriesProvider, ['UMUM', 'ASURANSI', 'BPJS', 'LAIN-LAIN']);
                const chartProviderkunjungan = createRadarChart("grafikDistribusiProviderkunjungan", seriesKunjungan, ['UMUM', 'ASURANSI', 'BPJS']);

                hospitalsData.forEach(hospital => {
                    createdchartpie(`grafikpresentasikunjungan${hospital.id.toLowerCase().replace(/\s+/g, '')}`,hospital.kunjungan,hospital.name);
                    createdchartpie(`grafikpresentasipendapatan${hospital.id.toLowerCase().replace(/\s+/g, '')}`,hospital.pendapatan,hospital.name);
                });

                $("#carousel-total-all").html(createCarouselItemPendapatan("All RMB Hospital Group", totalPendapatanAll, totalPendapatanAll));
                $("#carousel-total-rsms").html(createCarouselItemPendapatan("RSU Mutiasari", totalPendapatanRSMS, totalPendapatanAll));
                $("#carousel-total-rsiabm").html(createCarouselItemPendapatan("RSIA Budhi Mulia", totalPendapatanRSIA, totalPendapatanAll));
                $("#carousel-total-rst").html(createCarouselItemPendapatan("RS Thursina", totalPendapatanRST, totalPendapatanAll));
    
                $("#carousel-total-all-kunjungan").html(createCarouselItemKunjungan("All RMB Hospital Group", totalKunjunganAll, totalKunjunganAll));
                $("#carousel-total-rsms-kunjungan").html(createCarouselItemKunjungan("RSU Mutiasari", totalKunjunganRSMS, totalKunjunganAll));
                $("#carousel-total-rsiabm-kunjungan").html(createCarouselItemKunjungan("RSIA Budhi Mulia", totalKunjunganRSIA, totalKunjunganAll));
                $("#carousel-total-rst-kunjungan").html(createCarouselItemKunjungan("RS Thursina", totalKunjunganRST, totalKunjunganAll));


                createChartlinebar("grafikPendapatanUmum", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanumum)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanumum)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanumum)}
                ], "grafikPendapatanUmum", avgPendapatanumum, 'area',"Hospital Earnings Trends");

                createChartlinebar("grafikKunjunganUmum", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulanumum)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulanumum)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulanumum)}
                ], "grafikKunjunganUmum", avgKunjunganumum, 'bar',"Hospital Visit Trends");

                createChartlinebar("grafikPendapatanAsuransi", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanasuransi)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanasuransi)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanasuransi)}
                ], "grafikPendapatanAsuransi", avgPendapatanasuransi, 'area',"Hospital Earnings Trends");

                createChartlinebar("grafikKunjunganAsuransi", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulanasuransi)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulanasuransi)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulanasuransi)}
                ], "grafikKunjunganAsuransi", avgKunjunganasuransi, 'bar',"Hospital Visit Trends");

                createChartlinebar("grafikPendapatanBPJS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanbpjs)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanbpjs)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanbpjs)}
                ], "grafikPendapatanBPJS", avgPendapatanbpjs, 'area',"Hospital Earnings Trends");

                createChartlinebar("grafikKunjunganBPJS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulanbpjs)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulanbpjs)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulanbpjs)}
                ], "grafikKunjunganBPJS", avgKunjunganbpjs, 'bar',"Hospital Visit Trends");

                createChartlinebar("grafikPendapatanLain", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanlain)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanlain)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanlain)}
                ], "grafikPendapatanUmum", avgPendapatanlain, 'area',"Hospital Earnings Trends");
            }

            toastr[data.responHead](data.responDesc, "INFORMATION");
            console.log(dataMap);
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

const createChartlinebar = (elementId, seriesData, chartName, avgLine = null, chartType = 'bar', titlechart) => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height"));

    const newChart = new ApexCharts(el, {
        series: seriesData,
        chart: {
            fontFamily: "inherit",
            type: chartType,
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
        stroke: { curve: "smooth", width: 2, show: true },
        dataLabels: { enabled: false },
        yaxis: {
            labels: {
                show: true,
                formatter: value => todesimal(value)
            },
            title: { text: titlechart }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            labels: { style: { colors: "#888", fontSize: "12px" } },
            axisBorder: { show: true },
            axisTicks: { show: true }
        },
        tooltip: {
            y: {
                formatter: val => val.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                })
            }
        },
        annotations: avgLine ? {
            yaxis: [{
                y: avgLine,
                borderColor: '#FF4560',
                label: {
                    borderColor: '#FF4560',
                    style: { color: '#fff', background: '#FF4560' },
                    text: 'Average: ' + todesimal(avgLine)
                }
            }]
        } : {}
    });

    newChart.render();
    window[chartName] = newChart;
};

const createdchartpie = (elementId, nilaiGroup, namers) => {
    let chart = am4core.create(elementId, am4charts.PieChart);

    let title          = chart.titles.create();
        title.text     = namers;
        title.fontSize = 15;
        title.fill     = am4core.color("#6c757d");

    chart.innerRadius = am4core.percent(50);
    chart.data        = nilaiGroup;

    let pieSeries                     = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value    = "value";
        pieSeries.dataFields.category = "category";

    pieSeries.alignLabels = false;
    pieSeries.labels.template.padding(0, 0, 0, 0);
    pieSeries.labels.template.bent   = true;
    pieSeries.labels.template.radius = 10;
    pieSeries.labels.template.fill   = am4core.color("#6c757d");

    pieSeries.slices.template.states.getKey("hover").properties.scale = 1.2;
    pieSeries.labels.template.states.create("hover").properties.fill  = am4core.color("#ffffff");

    pieSeries.ticks.template.disabled = true;

    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.startAngle = -90;
    pieSeries.hiddenState.properties.endAngle = -90;
};

const createRadarChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);
    const chart = new ApexCharts(el, {
        series: seriesData,
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
        colors: ['#1E90FF', '#28C76F', '#FF9F43'],
        dataLabels: { enabled: false },
        markers: {
            size: 4,
            colors: "#fff",
            strokeColors: ['#1E90FF', '#28C76F', '#FF9F43'],
            strokeWidth: 2
        },
        plotOptions: {
            radar: {
                size: 120,
                polygons: {
                    strokeColors: '#e9e9e9',
                    fill: {
                        colors: ['#f3f3f3', '#fff']
                    }
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
    return chart;
};

const createCarouselItemPendapatan = (hospitalName, totalPendapatan, totalAll) => {
    return `
        <div>
            <p>Pendapatan ${hospitalName} tahun ini: <b>${formatCurrency(totalPendapatan)}</b></p>
            <small class="badge badge-info mb-1">Kontribusi: ${(totalPendapatan / totalAll * 100).toFixed(2)}%</small>
        </div>
    `;
};

const createCarouselItemKunjungan = (hospitalName, totalPendapatan, totalAll) => {
    return `
        <div>
            <p>Pendapatan ${hospitalName} tahun ini: <b>${todesimal(totalPendapatan)} Kunjungan</b></p>
            <small class="badge badge-info mb-1">Kontribusi: ${(totalPendapatan / totalAll * 100).toFixed(2)}%</small>
        </div>
    `;
};