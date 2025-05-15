datainsight();
databulan();

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
                        let pendapatanperbulanmcu      = '';
                        let pendapatanperbulanlain     = '';
                        let pendapatanperbulanpob      = '';
                        let kunjunganperbulan          = '';
                        let kunjunganperbulanumum      = '';
                        let kunjunganperbulanasuransi  = '';
                        let kunjunganperbulanbpjs      = '';
                        let kunjunganperbulanmcu       = '';
                        let pengeluranperbulan         = '';
                        let balanceperbulan            = '';
                        let targetperbulan             = '';

                        if(key === 'rsms'){
                            pendapatanperbulan         = 'pendapatantotalrsms';
                            pendapatanperbulanumum     = 'umumtotalrsms';
                            pendapatanperbulanasuransi = 'asuransitotalrsms';
                            pendapatanperbulanbpjs     = 'bpjstotalrsms';
                            pendapatanperbulanmcu      = 'mcutotalrsms';
                            pendapatanperbulanlain     = 'laintotalrsms';
                            pendapatanperbulanpob      = 'pobtotalrsms';
                            pengeluranperbulan         = 'pengelurantotalrsms';
                            balanceperbulan            = 'balancersms';
                            targetperbulan             = 'targetrsms';

                            kunjunganperbulan         = 'kunjungantotalrsms';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsms';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsms';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsms';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrsms';
                        }

                        if(key === 'rsiabm'){
                            pendapatanperbulan         = 'pendapatantotalrsiabm';
                            pendapatanperbulanumum     = 'umumtotalrsiabm';
                            pendapatanperbulanasuransi = 'asuransitotalrsiabm';
                            pendapatanperbulanbpjs     = 'bpjstotalrsiabm';
                            pendapatanperbulanmcu      = 'mcutotalrsiabm';
                            pendapatanperbulanlain     = 'laintotalrsiabm';
                            pendapatanperbulanpob      = 'pobtotalrsiabm';
                            pengeluranperbulan         = 'pengelurantotalrsiabm';
                            balanceperbulan            = 'balancersiabm';
                            targetperbulan             = 'targetrsiabm';

                            kunjunganperbulan         = 'kunjungantotalrsiabm';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrsiabm';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrsiabm';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrsiabm';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrsiabm';
                        }

                        if(key === 'rst'){
                            pendapatanperbulan         = 'pendapatantotalrst';
                            pendapatanperbulanumum     = 'umumtotalrst';
                            pendapatanperbulanasuransi = 'asuransitotalrst';
                            pendapatanperbulanbpjs     = 'bpjstotalrst';
                            pendapatanperbulanmcu      = 'mcutotalrst';
                            pendapatanperbulanlain     = 'laintotalrst';
                            pendapatanperbulanpob      = 'pobtotalrst';
                            pengeluranperbulan         = 'pengelurantotalrst';
                            balanceperbulan            = 'balancerst';
                            targetperbulan             = 'targetrst';

                            kunjunganperbulan         = 'kunjungantotalrst';
                            kunjunganperbulanumum     = 'kunjunganumumtotalrst';
                            kunjunganperbulanasuransi = 'kunjunganasuransitotalrst';
                            kunjunganperbulanbpjs     = 'kunjunganbpjstotalrst';
                            kunjunganperbulanmcu      = 'kunjunganmcutotalrst';
                        }

                        hospital.dataValue.push({
                            periode                   : item.periode,
                            pendapatanperbulan        : parseFloat(item[pendapatanperbulan]),
                            pendapatanperbulanumum    : parseFloat(item[pendapatanperbulanumum]),
                            pendapatanperbulanasuransi: parseFloat(item[pendapatanperbulanasuransi]),
                            pendapatanperbulanbpjs    : parseFloat(item[pendapatanperbulanbpjs]),
                            pendapatanperbulanmcu     : parseFloat(item[pendapatanperbulanmcu]),
                            pendapatanperbulanlain    : parseFloat(item[pendapatanperbulanlain]),
                            kunjunganperbulan         : parseFloat(item[kunjunganperbulan]),
                            kunjunganperbulanumum     : parseFloat(item[kunjunganperbulanumum]),
                            kunjunganperbulanasuransi : parseFloat(item[kunjunganperbulanasuransi]),
                            kunjunganperbulanbpjs     : parseFloat(item[kunjunganperbulanbpjs]),
                            kunjunganperbulanmcu      : parseFloat(item[kunjunganperbulanmcu]),
                            pendapatanperbulanpob     : parseFloat(item[pendapatanperbulanpob]),
                            pengeluranperbulan        : parseFloat(item[pengeluranperbulan]),
                            balanceperbulan           : parseFloat(item[balanceperbulan]),
                            targetperbulan            : parseFloat(item[targetperbulan])
                        });
                    }
                };

                result.forEach(item => {
                    pushToDataMap(item, 'rsms');
                    pushToDataMap(item, 'rsiabm');
                    pushToDataMap(item, 'rst');
                });

                const totalPendapatanRSMS         = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanRSIA         = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanRST          = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulan, 0);
                const totalPendapatanAll          = totalPendapatanRSMS + totalPendapatanRSIA + totalPendapatanRST;

                const totalPendapatanUmumRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanumum, 0);
                const totalPendapatanUmumAll      = totalPendapatanUmumRSMS + totalPendapatanUmumRSIA + totalPendapatanUmumRST;

                const totalPendapatanAsuransiRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapatanAsuransiRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapatanAsuransiRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanasuransi, 0);
                const totalPendapataAsuransimAll  = totalPendapatanAsuransiRSMS + totalPendapatanAsuransiRSIA + totalPendapatanAsuransiRST;
                
                const totalPendapatanBPJSRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanbpjs, 0);
                const totalPendapatanBPJSAll      = totalPendapatanBPJSRSMS + totalPendapatanBPJSRSIA + totalPendapatanBPJSRST;

                const totalPendapatanMCURSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanmcu, 0);
                const totalPendapatanMCURSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanmcu, 0);
                const totalPendapatanMCURST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanmcu, 0);
                const totalPendapatanMCUAll      = totalPendapatanMCURSMS + totalPendapatanMCURSIA + totalPendapatanMCURST;
                
                const totalPendapatanLainRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanlain, 0);
                const totalPendapatanLainAll      = totalPendapatanLainRSMS + totalPendapatanLainRSIA + totalPendapatanLainRST;

                const totalPendapatanPOBRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanpob, 0);
                const totalPendapatanPOBRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanpob, 0);
                const totalPendapatanPOBRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.pendapatanperbulanpob, 0);
                const totalPendapataPOBnAll      = totalPendapatanPOBRSMS + totalPendapatanPOBRSIA + totalPendapatanPOBRST;

                const totalKunjunganRSMS         = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRSIA         = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganRST          = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulan, 0);
                const totalKunjunganAll          = totalKunjunganRSMS + totalKunjunganRSIA + totalKunjunganRST;
                const totalKunjunganUmumRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanumum, 0);
                const totalKunjunganUmumAll      = totalKunjunganUmumRSMS + totalKunjunganUmumRSIA + totalKunjunganUmumRST;
                const totalKunjunganAsuransiRSMS = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiRSIA = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiRST  = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanasuransi, 0);
                const totalKunjunganAsuransiAll  = totalKunjunganAsuransiRSMS + totalKunjunganAsuransiRSIA + totalKunjunganAsuransiRST;

                const totalKunjunganBPJSRSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSRSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSRST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanbpjs, 0);
                const totalKunjunganBPJSAll      = totalKunjunganBPJSRSMS + totalKunjunganBPJSRSIA + totalKunjunganBPJSRST;

                const totalKunjunganMCURSMS     = dataMap.rsms.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanmcu, 0);
                const totalKunjunganMCURSIA     = dataMap.rsiabm.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanmcu, 0);
                const totalKunjunganMCURST      = dataMap.rst.dataValue.reduce((acc, cur) => acc + cur.kunjunganperbulanmcu, 0);
                const totalKunjunganMCUAll      = totalKunjunganMCURSMS + totalKunjunganMCURSIA + totalKunjunganMCURST;

                const jumlahPeriodeValid = dataMap.periode.filter((_, index) => {
                    return (
                        dataMap.rsms.dataValue[index].pendapatanperbulan > 0 ||
                        dataMap.rsiabm.dataValue[index].pendapatanperbulan > 0 ||
                        dataMap.rst.dataValue[index].pendapatanperbulan > 0
                    );
                }).length;

                const avgPendapatantotal    = Math.round(totalPendapatanAll / (jumlahPeriodeValid * 3));
                const avgKunjungantotal     = Math.round(totalKunjunganAll / (jumlahPeriodeValid * 3));
                const avgPendapatanumum     = Math.round(totalPendapatanUmumAll / (jumlahPeriodeValid * 3));
                const avgKunjunganumum      = Math.round(totalKunjunganUmumAll / (jumlahPeriodeValid * 3));
                const avgPendapatanasuransi = Math.round(totalPendapataAsuransimAll / (jumlahPeriodeValid * 3));
                const avgKunjunganasuransi  = Math.round(totalKunjunganAsuransiAll / (jumlahPeriodeValid * 3));
                const avgPendapatanbpjs     = Math.round(totalPendapatanBPJSAll / (jumlahPeriodeValid * 3));
                const avgKunjunganbpjs      = Math.round(totalKunjunganBPJSAll / (jumlahPeriodeValid * 3));
                const avgPendapatanmcu      = Math.round(totalPendapatanMCUAll / (jumlahPeriodeValid * 3));
                const avgKunjunganmcu       = Math.round(totalKunjunganMCUAll / (jumlahPeriodeValid * 3));
                const avgPendapatanlain     = Math.round(totalPendapatanLainAll / (jumlahPeriodeValid * 3));
                const avgPendapatanpob      = Math.round(totalPendapataPOBnAll / (jumlahPeriodeValid * 3));

                const avgtagetrms      = Math.round(dataMap.rsms.dataValue.map(item => item.pendapatanperbulan) / dataMap.rsms.dataValue.map(item => item.targetperbulan));

                createChartlinebartarget("grafiktargetrsms", [
                    {name: "Pendapatan",type: "area",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "Target",type: "line",data: dataMap.rsms.dataValue.map(item => item.targetperbulan)}
                ], "grafiktargetrsms", "Trends of Hospital Targets and Achievements");

                createChartlinebartarget("grafiktargetrsiabm", [
                    {name: "Pendapatan",type: "area",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "Target",type: "line",data: dataMap.rsiabm.dataValue.map(item => item.targetperbulan)}
                ], "grafiktargetrsiabm", "Trends of Hospital Targets and Achievements");

                createChartlinebartarget("grafiktargetrst", [
                    {name: "Pendapatan",type: "area",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "Target",type: "line",data: dataMap.rst.dataValue.map(item => item.targetperbulan)}
                ], "grafiktargetrst", "Trends of Hospital Targets and Achievements");

                createChartlinebar("grafikPendapatanRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulan)}
                ], "grafikPendapatanRS", avgPendapatantotal, 'area',"Annual Revenue Trends Across Hospitals");

                createChartlinebar("grafikPengeluranRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pengeluranperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pengeluranperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pengeluranperbulan)}
                ], "grafikPengeluranRS", avgPendapatantotal, 'area',"Expend Trends Across Hospitals");

                createChartlinebar("grafikBalanceRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.balanceperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.balanceperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.balanceperbulan)}
                ], "grafikBalanceRS", avgPendapatantotal, 'area',"Balance Trends Across Hospitals");

                createChartlinebar("grafikKunjunganRS", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulan)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulan)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulan)}
                ], "grafikKunjunganRS", avgKunjungantotal, 'bar',"Annual Patient Visits Across Hospitals");


                const seriesProvider = [
                    {name: 'RSU Mutiasari',data: [totalPendapatanUmumRSMS, totalPendapatanAsuransiRSMS, totalPendapatanBPJSRSMS, totalPendapatanLainRSMS, totalPendapatanPOBRSMS]},
                    {name: 'RSIA Budhi Mulia',data: [totalPendapatanUmumRSIA, totalPendapatanAsuransiRSIA, totalPendapatanBPJSRSIA, totalPendapatanLainRSIA, totalPendapatanPOBRSIA]},
                    {name: 'RS Thursina',data: [totalPendapatanUmumRST, totalPendapatanAsuransiRST, totalPendapatanBPJSRST, totalPendapatanLainRST, totalPendapatanPOBRST]}
                ];
                
                const seriesKunjungan = [
                    {name: 'RSU Mutiasari',data: [totalKunjunganUmumRSMS, totalKunjunganAsuransiRSMS, totalKunjunganBPJSRSMS, totalKunjunganMCURSMS]},
                    {name: 'RSIA Budhi Mulia',data: [totalKunjunganUmumRSIA, totalKunjunganAsuransiRSIA, totalKunjunganBPJSRSIA, totalKunjunganMCURSIA]},
                    {name: 'RS Thursina',data: [totalKunjunganUmumRST, totalKunjunganAsuransiRST, totalKunjunganBPJSRST, totalKunjunganMCURST]}
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
                            { category: "LAIN", value: totalPendapatanLainRSMS, color: "#6F42C1" },
                            { category: "POB", value: totalPendapatanLainRSMS, color: "#d63384" }
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
                            { category: "LAIN", value: totalPendapatanLainRSIA, color: "#6F42C1" },
                            { category: "POB", value: totalPendapatanLainRSIA, color: "#d63384" }
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
                            { category: "LAIN", value: totalPendapatanLainRST, color: "#6F42C1" },
                            { category: "POB", value: totalPendapatanLainRST, color: "#d63384" }
                        ]
                    }
                ];


                createRadarChart("grafikDistribusiProvider", seriesProvider, ['UMUM', 'ASURANSI', 'BPJS', 'LAIN-LAIN', 'POB']);
                createRadarChart("grafikDistribusiProviderkunjungan", seriesKunjungan, ['UMUM', 'ASURANSI', 'BPJS','MCU']);

                hospitalsData.forEach(hospital => {
                    createdchartpie(`grafikpresentasikunjungan${hospital.id.toLowerCase().replace(/\s+/g, '')}`,hospital.kunjungan,hospital.name);
                    createdchartpie(`grafikpresentasipendapatan${hospital.id.toLowerCase().replace(/\s+/g, '')}`,hospital.pendapatan,hospital.name);
                });

                $("#carousel-total-all").html(createCarouselItemPendapatan("All RMB Hospital Group", totalPendapatanAll, totalPendapatanAll));
                $("#carousel-total-rsms").html(createCarouselItemPendapatan("RSU Mutiasari", totalPendapatanRSMS, totalPendapatanAll));
                $("#carousel-total-rsiabm").html(createCarouselItemPendapatan("RSIA Budhi Mulia", totalPendapatanRSIA, totalPendapatanAll));
                $("#carousel-total-rst").html(createCarouselItemPendapatan("RS Thursina", totalPendapatanRST, totalPendapatanAll));

                $("#totalrmb").html("Rp. "+todesimal(totalPendapatanAll)+",-");
                $("#totalrsms").html("Rp. "+todesimal(totalPendapatanRSMS)+",-");
                $("#totalrsia").html("Rp. "+todesimal(totalPendapatanRSIA)+",-");
                $("#totalrst").html("Rp. "+todesimal(totalPendapatanRST)+",-");

                $("#rmbumum").html("Rp. "+todesimal(totalPendapatanUmumAll)+",-");
                $("#rmbasuransi").html("Rp. "+todesimal(totalPendapataAsuransimAll)+",-");
                $("#rmbbpjs").html("Rp. "+todesimal(totalPendapatanBPJSAll)+",-");
                $("#rmbmcu").html("Rp. "+todesimal(totalPendapatanMCUAll)+",-");
                $("#rmbobat").html("Rp. "+todesimal(totalPendapataPOBnAll)+",-");
                $("#rmblain").html("Rp. "+todesimal(totalPendapatanLainAll)+",-");

                $("#rsmsumum").html("Rp. "+todesimal(totalPendapatanUmumRSMS)+",-");
                $("#rsmsasuransi").html("Rp. "+todesimal(totalPendapatanAsuransiRSMS)+",-");
                $("#rsmsbpjs").html("Rp. "+todesimal(totalPendapatanBPJSRSMS)+",-");
                $("#rsmsmcu").html("Rp. "+todesimal(totalPendapatanMCURSMS)+",-");
                $("#rsmsobat").html("Rp. "+todesimal(totalPendapatanPOBRSMS)+",-");
                $("#rsmslain").html("Rp. "+todesimal(totalPendapatanLainRSMS)+",-");

                $("#rsiaumum").html("Rp. "+todesimal(totalPendapatanUmumRSIA)+",-");
                $("#rsiaasuransi").html("Rp. "+todesimal(totalPendapatanAsuransiRSIA)+",-");
                $("#rsiabpjs").html("Rp. "+todesimal(totalPendapatanBPJSRSIA)+",-");
                $("#rsiamcu").html("Rp. "+todesimal(totalPendapatanMCURSIA)+",-");
                $("#rsiaobat").html("Rp. "+todesimal(totalPendapatanPOBRSIA)+",-");
                $("#rsialain").html("Rp. "+todesimal(totalPendapatanLainRSIA)+",-");

                $("#rstumum").html("Rp. "+todesimal(totalPendapatanUmumRST)+",-");
                $("#rstasuransi").html("Rp. "+todesimal(totalPendapatanAsuransiRST)+",-");
                $("#rstbpjs").html("Rp. "+todesimal(totalPendapatanBPJSRST)+",-");
                $("#rstmcu").html("Rp. "+todesimal(totalPendapatanMCURST)+",-");
                $("#rstobat").html("Rp. "+todesimal(totalPendapatanPOBRST)+",-");
                $("#rstlain").html("Rp. "+todesimal(totalPendapatanLainRST)+",-");
    
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

                createChartlinebar("grafikPendapatanMCU", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanmcu)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanmcu)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanmcu)}
                ], "grafikPendapatanMCU", avgPendapatanmcu, 'area',"Hospital Earnings Trends");

                createChartlinebar("grafikKunjunganMCU", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.kunjunganperbulanmcu)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.kunjunganperbulanmcu)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.kunjunganperbulanmcu)}
                ], "grafikKunjunganMCU", avgKunjunganmcu, 'bar',"Hospital Visit Trends");

                createChartlinebar("grafikPendapatanLain", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanlain)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanlain)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanlain)}
                ], "grafikPendapatanLain", avgPendapatanlain, 'area',"Hospital Earnings Trends");

                createChartlinebar("grafikPendapatanPOB", [
                    {name: "RSU Mutiasari",data: dataMap.rsms.dataValue.map(item => item.pendapatanperbulanpob)},
                    {name: "RSIA Budhi Mulia",data: dataMap.rsiabm.dataValue.map(item => item.pendapatanperbulanpob)},
                    {name: "RS Thursina",data: dataMap.rst.dataValue.map(item => item.pendapatanperbulanpob)}
                ], "grafikPendapatanPOB", avgPendapatanpob, 'area',"Hospital Earnings Trends");
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

function databulan(){
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
                $("#resultkunjungan" + (month < 10 ? '0' + month : month)).html("");
            }

            
            am4core.useTheme(am4themes_animated);
        },       
        success: function (data) {
            var totalPerMonth = {};
            var countPerMonth = {};
        
            for (var m = 1; m <= 12; m++) {
                var key = m < 10 ? '0' + m : '' + m;
                totalPerMonth[key] = {
                    urj: 0,
                    uri: 0,
                    arj: 0,
                    ari: 0,
                    brj: 0,
                    bri: 0,
                    mcucash: 0,
                    mcuinv : 0,
                    lain: 0,
                    pob: 0,
                    k_urj: 0,
                    k_uri: 0,
                    k_arj: 0,
                    k_ari: 0,
                    k_brj: 0,
                    k_bri: 0,
                    k_mcucash: 0,
                    k_mcuinv: 0,

                    k_urjcompare: 0,
                    k_uricompare: 0,
                    k_arjcompare: 0,
                    k_aricompare: 0,
                    k_brjcompare: 0,
                    k_bricompare: 0,
                    k_mcucashcompare: 0,
                    k_mcuinvcompare: 0,

                    umum: 0,
                    asuransi: 0,
                    bpjs: 0,
                    mcu: 0
                };
                countPerMonth[key] = 0;
            }
        
            if(data.responCode === "00"){
                var result = data.responResult;
        
                for (var i in result) {
                    var item = result[i];
                    var month = item.bulan;
        
                    // Tambah nilai ke total per bulan
                    totalPerMonth[month].urj       += parseFloat(item.urj || 0);
                    totalPerMonth[month].uri       += parseFloat(item.uri || 0);
                    totalPerMonth[month].arj       += parseFloat(item.arj || 0);
                    totalPerMonth[month].ari       += parseFloat(item.ari || 0);
                    totalPerMonth[month].brj       += parseFloat(item.brj || 0);
                    totalPerMonth[month].bri       += parseFloat(item.bri || 0);
                    totalPerMonth[month].mcucash   += parseFloat(item.mcucash || 0);
                    totalPerMonth[month].mcuinv    += parseFloat(item.mcuinv || 0);
                    totalPerMonth[month].lain      += parseFloat(item.lain || 0);
                    totalPerMonth[month].pob       += parseFloat(item.pob || 0);
                    totalPerMonth[month].k_urj     += parseFloat(item.kurj || 0);
                    totalPerMonth[month].k_uri     += parseFloat(item.kuri || 0);
                    totalPerMonth[month].k_arj     += parseFloat(item.karj || 0);
                    totalPerMonth[month].k_ari     += parseFloat(item.kari || 0);
                    totalPerMonth[month].k_brj     += parseFloat(item.kbrj || 0);
                    totalPerMonth[month].k_bri     += parseFloat(item.kbri || 0);
                    totalPerMonth[month].k_mcucash += parseFloat(item.kmcucash || 0);
                    totalPerMonth[month].k_mcuinv  += parseFloat(item.kmcuinv || 0);

                    totalPerMonth[month].k_urjcompare     += parseFloat(item.kurjcompare || 0);
                    totalPerMonth[month].k_uricompare     += parseFloat(item.kuricompare || 0);
                    totalPerMonth[month].k_arjcompare     += parseFloat(item.karjcompare || 0);
                    totalPerMonth[month].k_aricompare     += parseFloat(item.karicompare || 0);
                    totalPerMonth[month].k_brjcompare     += parseFloat(item.kbrjcompare || 0);
                    totalPerMonth[month].k_bricompare     += parseFloat(item.kbricompare || 0);
                    totalPerMonth[month].k_mcucashcompare += parseFloat(item.kmcucashcompare || 0);
                    totalPerMonth[month].k_mcuinvcompare  += parseFloat(item.kmcuinvcompare || 0);

                    countPerMonth[month]++;
        
                    var tablekunjungan = "<tr>";

                        tablekunjungan += "<td class='ps-4'>" + item.nama_hari + "</td>";
                        tablekunjungan += "<td class='text-center'>" + item.tanggal + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kurj != item.kurjcompare ? "table-danger" : "") + "'>" + todesimal(item.kurj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kurj != item.kurjcompare ? "table-danger" : "") + "'>" + todesimal(item.kurjcompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kuri != item.kuricompare ? "table-danger" : "") + "'>" + todesimal(item.kuri || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kuri != item.kuricompare ? "table-danger" : "") + "'>" + todesimal(item.kuricompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.karj != item.karjcompare ? "table-danger" : "") + "'>" + todesimal(item.karj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.karj != item.karjcompare ? "table-danger" : "") + "'>" + todesimal(item.karjcompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kari != item.karicompare ? "table-danger" : "") + "'>" + todesimal(item.kari || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kari != item.karicompare ? "table-danger" : "") + "'>" + todesimal(item.karicompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kbrj != item.kbrjcompare ? "table-danger" : "") + "'>" + todesimal(item.kbrj || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kbrj != item.kbrjcompare ? "table-danger" : "") + "'>" + todesimal(item.kbrjcompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kbri != item.kbricompare ? "table-danger" : "") + "'>" + todesimal(item.kbri || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kbri != item.kbricompare ? "table-danger" : "") + "'>" + todesimal(item.kbricompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kmcucash != item.kmcucashcompare ? "table-danger" : "") + "'>" + todesimal(item.kmcucash || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kmcucash != item.kmcucashcompare ? "table-danger" : "") + "'>" + todesimal(item.kmcucashcompare || 0) + "</td>";

                        tablekunjungan += "<td class='text-center " + (item.kmcuinv != item.kmcuinvcompare ? "table-danger" : "") + "'>" + todesimal(item.kmcuinv || 0) + "</td>";
                        tablekunjungan += "<td class='text-center " + (item.kmcuinv != item.kmcuinvcompare ? "table-danger" : "") + "'>" + todesimal(item.kmcuinvcompare || 0) + "</td>";


                        tablekunjungan += "</tr>";
        
                    $("#resultkunjungan" + month).append(tablekunjungan);
                }
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

const createChartlinebar = (elementId, seriesData, chartName, avgLine = null, chartType = 'bar', titlechart) => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height"));

    // Periksa apakah chart sudah ada dan merupakan instance dari ApexCharts
    if (window[chartName] instanceof ApexCharts) {
        window[chartName].destroy();  // Hancurkan chart yang ada
    }

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
                formatter: val => todesimal(val, 2)
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

const createChartlinebartarget = (elementId, seriesData, chartName, titlechart = '') => {
    const el = document.getElementById(elementId);
    const height = parseInt(KTUtil.css(el, "height"));

    if (window[chartName] instanceof ApexCharts) {
        window[chartName].destroy();
    }

    const newChart = new ApexCharts(el, {
        series: seriesData,
        chart: {
            fontFamily: "inherit",
            type: 'line', // base chart type tetap line (karena mix)
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
        dataLabels: {
            enabled: true,
            formatter: function (val, opts) {
                return todesimal(val, 2); // format angka desimal 2 digit, sesuaikan fungsi todesimal kamu
            },
            style: {
                fontSize: '9px'
            }
        },        
        colors: ['#00BFFF', '#FF4560'], // warna: pendapatan biru, target merah
        yaxis: {
            labels: {
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
                formatter: val => todesimal(val, 2)
            }
        },
        fill: {
            type: ['gradient', 'solid'], // Pendapatan pakai gradient (area), Target solid (line)
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.4,
                opacityTo: 0,
                stops: [0, 90, 100]
            }
        },
        markers: {
            size: [0, 5] // pendapatan tanpa marker, target ada marker
        }
    });

    newChart.render();
    window[chartName] = newChart;
};

const createdchartpie = (elementId, nilaiGroup, namers) => {
    // Reset / Hapus chart lama jika ada
    if (am4core.registry.baseSprites) {
        am4core.registry.baseSprites
            .filter(x => x.dom && x.dom.id === elementId)
            .forEach(x => x.dispose());
    }

    // Buat chart baru
    let chart = am4core.create(elementId, am4charts.PieChart);

    let title = chart.titles.create();
    title.text = namers;
    title.fontSize = 15;
    title.fill = am4core.color("#6c757d");

    chart.innerRadius = am4core.percent(50);
    chart.data = nilaiGroup;

    let pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "value";
    pieSeries.dataFields.category = "category";

    pieSeries.alignLabels = false;
    pieSeries.labels.template.padding(0, 0, 0, 0);
    pieSeries.labels.template.bent = true;
    pieSeries.labels.template.radius = 10;
    pieSeries.labels.template.fill = am4core.color("#6c757d");

    pieSeries.slices.template.states.getKey("hover").properties.scale = 1.2;
    pieSeries.labels.template.states.create("hover").properties.fill = am4core.color("#ffffff");

    pieSeries.ticks.template.disabled = true;

    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.startAngle = -90;
    pieSeries.hiddenState.properties.endAngle = -90;
};

const createRadarChart = (chartId, seriesData, categories) => {
    const el = document.getElementById(chartId);

    // Periksa apakah chart sudah ada dan merupakan instance dari ApexCharts
    if (window[chartId] instanceof ApexCharts) {
        window[chartId].destroy();  // Hancurkan chart yang ada
    }

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
    window[chartId] = chart; // Simpan di window dengan nama chartId
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
