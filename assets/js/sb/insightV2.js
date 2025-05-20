dataharian();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    dataharian();
});

function dataharian() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url + "index.php/sb/insight/dataharian",
        data      : {periode: periode},
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        beforeSend: function () {
            Swal.fire({
                title            : 'Sending request...',
                text             : 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });

            for (let month = 1; month <= 12; month++) {
                let key = month < 10 ? '0' + month : '' + month;
                $("#resultpendapatanrmb" + key).html("");
                $("#resultpendapatanrsms" + key).html("");
                $("#resultpendapatanrsia" + key).html("");
                $("#resultpendapatanrst" + key).html("");
            }
        },
        success: function (data) {
            Swal.fire({
                title            : 'Memproses data...',
                text             : 'Menyiapkan tampilan data rumah sakit.',
                allowOutsideClick: false,
                allowEscapeKey   : false,
                didOpen          : () => Swal.showLoading()
            });

            const rumahSakitMap = {
                "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsia",
                "a4633f72-4d67-4f65-a050-9f6240704151": "rst"
            };

            const groupRMB = {};
            
            if (data.responCode === "00") {
                const result = data.responResult;
            
                function getdatalastday(orgId) {
                    const rows = result.filter(r => r.org_id === orgId);
                    return rows.length > 0 ? rows[rows.length - 1] : {};
                }
            
                function getSummaryYears(orgId) {
                    const rows = result.filter(r => r.org_id === orgId);
                    return sumFields(rows);
                }                
            
                function getSummaryLast30Days(orgId) {
                    const now = new Date();
                    const past30Days = new Date();
                    past30Days.setDate(now.getDate() - 30);
            
                    const rows = result.filter(r => {
                        const rowDate = new Date(r.date);
                        return r.org_id === orgId && rowDate >= past30Days && rowDate <= now;
                    });
            
                    return sumFields(rows);
                }
            
                function sumFields(rows) {
                    const summary = {
                        a_ri: 0, a_rj: 0,
                        b_ri: 0, b_rj: 0,
                        u_ri: 0, u_rj: 0,
                        lain: 0, pob: 0,
                        mcu_cash: 0, mcu_inv: 0
                    };
            
                    rows.forEach(r => {
                        for (const key in summary) {
                            summary[key] += parseInt(r[key] || 0);
                        }
                    });
            
                    return summary;
                }

                function totalpendapatan(data) {
                    return (
                        Number(data.u_rj || 0) +
                        Number(data.u_ri || 0) +
                        Number(data.a_rj || 0) +
                        Number(data.a_ri || 0) +
                        Number(data.b_rj || 0) +
                        Number(data.b_ri || 0) +
                        Number(data.mcu_cash || 0) +
                        Number(data.mcu_inv || 0) +
                        Number(data.pob || 0) +
                        Number(data.lain || 0)
                    );
                }

                function totalrincianpendapatan(data) {
                    return {
                        umum    : Number(data.u_rj || 0) + Number(data.u_ri || 0),
                        asuransi: Number(data.a_rj || 0) + Number(data.a_ri || 0),
                        bpjs    : Number(data.b_rj || 0) + Number(data.b_ri || 0),
                        mcu     : Number(data.mcu_cash || 0) + Number(data.mcu_inv || 0),
                        obat    : Number(data.pob || 0),
                        lain    : Number(data.lain || 0),
                    };
                }

                function totalrinciankunjungan(data) {
                    return {
                        umum    : Number(data.k_urj || 0) + Number(data.k_uri || 0),
                        asuransi: Number(data.k_arj || 0) + Number(data.k_ari || 0),
                        bpjs    : Number(data.k_brj || 0) + Number(data.k_bri || 0),
                        mcu     : Number(data.k_mcu_cash || 0) + Number(data.k_mcu_inv || 0)
                    };
                }
            
                const rmsDatalastday  = getdatalastday("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
                const rsiaDatalastday = getdatalastday("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
                const rstDatalastday  = getdatalastday("a4633f72-4d67-4f65-a050-9f6240704151");

                const totalRMSlastday  = totalpendapatan(rmsDatalastday);
                const totalRSIAlastday = totalpendapatan(rsiaDatalastday);
                const totalRSTlastday  = totalpendapatan(rstDatalastday);
                const totalAlllastday  = totalRMSlastday + totalRSIAlastday + totalRSTlastday;

                const rmslastday  = totalrincianpendapatan(rmsDatalastday);
                const rsialastday = totalrincianpendapatan(rsiaDatalastday);
                const rstlastday  = totalrincianpendapatan(rstDatalastday);

                const rmslastdaykunjungan  = totalrinciankunjungan(rmsDatalastday);
                const rsialastdaykunjungan = totalrinciankunjungan(rsiaDatalastday);
                const rstlastdaykunjungan  = totalrinciankunjungan(rstDatalastday);

                const rmblastday = {
                    umum    : rmslastday.umum + rsialastday.umum + rstlastday.umum,
                    asuransi: rmslastday.asuransi + rsialastday.asuransi + rstlastday.asuransi,
                    bpjs    : rmslastday.bpjs + rsialastday.bpjs + rstlastday.bpjs,
                    mcu     : rmslastday.mcu + rsialastday.mcu + rstlastday.mcu,
                    obat    : rmslastday.obat + rsialastday.obat + rstlastday.obat,
                    lain    : rmslastday.lain + rsialastday.lain + rstlastday.lain,
                };

                const kunjunganrmblastday = {
                    umum    : rmslastdaykunjungan.umum + rsialastdaykunjungan.umum + rstlastdaykunjungan.umum,
                    asuransi: rmslastdaykunjungan.asuransi + rsialastdaykunjungan.asuransi + rstlastdaykunjungan.asuransi,
                    bpjs    : rmslastdaykunjungan.bpjs + rsialastdaykunjungan.bpjs + rstlastdaykunjungan.bpjs,
                    mcu     : rmslastdaykunjungan.mcu + rsialastdaykunjungan.mcu + rstlastdaykunjungan.mcu,
                };

                $("#lastdatersms").html(rmsDatalastday.date || "-");
                $("#lastdatersia").html(rsiaDatalastday.date || "-");
                $("#lastdaterst").html(rstDatalastday.date || "-");

                $("#totalrmblastdate").html("Rp. "+todesimal(totalAlllastday));
                $("#totalrsmslastdate").html("Rp. "+todesimal(totalRMSlastday));
                $("#totalrsialastdate").html("Rp. "+todesimal(totalRSIAlastday));
                $("#totalrstlastdate").html("Rp. "+todesimal(totalRSTlastday));

                $("#rmbumumlastdate").html("Rp. "+todesimal(rmblastday.umum));
                $("#rmbasuransilastdate").html("Rp. "+todesimal(rmblastday.asuransi));
                $("#rmbbpjslastdate").html("Rp. "+todesimal(rmblastday.bpjs));
                $("#rmbmculastdate").html("Rp. "+todesimal(rmblastday.mcu));
                $("#rmbobatlastdate").html("Rp. "+todesimal(rmblastday.obat));
                $("#rmblainlastdate").html("Rp. "+todesimal(rmblastday.lain));

                $("#kunjunganrmbumumlastdate").html(kunjunganrmblastday.umum);
                $("#kunjunganrmbasuransilastdate").html(kunjunganrmblastday.asuransi);
                $("#kunjunganrmbbpjslastdate").html(kunjunganrmblastday.bpjs);
                $("#kunjunganrmbmculastdate").html(kunjunganrmblastday.mcu);

                $("#rsmsumumlastdate").html("Rp. "+todesimal(rmslastday.umum));
                $("#rsmsasuransilastdate").html("Rp. "+todesimal(rmslastday.asuransi));
                $("#rsmsbpjslastdate").html("Rp. "+todesimal(rmslastday.bpjs));
                $("#rsmsmculastdate").html("Rp. "+todesimal(rmslastday.mcu));
                $("#rsmsobatlastdate").html("Rp. "+todesimal(rmslastday.obat));
                $("#rsmslainlastdate").html("Rp. "+todesimal(rmslastday.lain));

                $("#kunjunganrsmsumumlastdate").html(rmslastdaykunjungan.umum);
                $("#kunjunganrsmsasuransilastdate").html(rmslastdaykunjungan.asuransi);
                $("#kunjunganrsmsbpjslastdate").html(rmslastdaykunjungan.bpjs);
                $("#kunjunganrsmsmculastdate").html(rmslastdaykunjungan.mcu);

                $("#rsiaumumlastdate").html("Rp. "+todesimal(rsialastday.umum));
                $("#rsiaasuransilastdate").html("Rp. "+todesimal(rsialastday.asuransi));
                $("#rsiabpjslastdate").html("Rp. "+todesimal(rsialastday.bpjs));
                $("#rsiamculastdate").html("Rp. "+todesimal(rsialastday.mcu));
                $("#rsiaobatlastdate").html("Rp. "+todesimal(rsialastday.obat));
                $("#rsialainlastdate").html("Rp. "+todesimal(rsialastday.lain));

                $("#kunjunganrsiaumumlastdate").html(rsialastdaykunjungan.umum);
                $("#kunjunganrsiaasuransilastdate").html(rsialastdaykunjungan.asuransi);
                $("#kunjunganrsiabpjslastdate").html(rsialastdaykunjungan.bpjs);
                $("#kunjunganrsiamculastdate").html(rsialastdaykunjungan.mcu);

                $("#rstumumlastdate").html("Rp. "+todesimal(rstlastday.umum));
                $("#rstasuransilastdate").html("Rp. "+todesimal(rstlastday.asuransi));
                $("#rstbpjslastdate").html("Rp. "+todesimal(rstlastday.bpjs));
                $("#rstmculastdate").html("Rp. "+todesimal(rstlastday.mcu));
                $("#rstobatlastdate").html("Rp. "+todesimal(rstlastday.obat));
                $("#rstlainlastdate").html("Rp. "+todesimal(rstlastday.lain));

                $("#kunjunganrstumumlastdate").html(rstlastdaykunjungan.umum);
                $("#kunjunganrstasuransilastdate").html(rstlastdaykunjungan.asuransi);
                $("#kunjunganrstbpjslastdate").html(rstlastdaykunjungan.bpjs);
                $("#kunjunganrstmculastdate").html(rstlastdaykunjungan.mcu);

                const rmsDatalast30day  = getSummaryLast30Days("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
                const rsiaDatalast30day = getSummaryLast30Days("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
                const rstDatalast30day  = getSummaryLast30Days("a4633f72-4d67-4f65-a050-9f6240704151");

                const totalRMSlast30day  = totalpendapatan(rmsDatalast30day);
                const totalRSIAlast30day = totalpendapatan(rsiaDatalast30day);
                const totalRSTlast30day  = totalpendapatan(rstDatalast30day);
                const totalAlllast30day  = totalRMSlast30day + totalRSIAlast30day + totalRSTlast30day;

                const rmslast30day  = totalrincianpendapatan(rmsDatalast30day);
                const rsialast30day = totalrincianpendapatan(rsiaDatalast30day);
                const rstlast30day  = totalrincianpendapatan(rstDatalast30day);

                const rmbmonth = {
                    umum    : rmslast30day.umum + rsialast30day.umum + rstlast30day.umum,
                    asuransi: rmslast30day.asuransi + rsialast30day.asuransi + rstlast30day.asuransi,
                    bpjs    : rmslast30day.bpjs + rsialast30day.bpjs + rstlast30day.bpjs,
                    mcu     : rmslast30day.mcu + rsialast30day.mcu + rstlast30day.mcu,
                    obat    : rmslast30day.obat + rsialast30day.obat + rstlast30day.obat,
                    lain    : rmslast30day.lain + rsialast30day.lain + rstlast30day.lain,
                };

                $("#totalrmbmonth").html("Rp. "+todesimal(totalAlllast30day));
                $("#totalrsmsmonth").html("Rp. "+todesimal(totalRMSlast30day));
                $("#totalrsiamonth").html("Rp. "+todesimal(totalRSIAlast30day));
                $("#totalrstmonth").html("Rp. "+todesimal(totalRSTlast30day));

                $("#rmbumummonth").html("Rp. "+todesimal(rmbmonth.umum));
                $("#rmbasuransimonth").html("Rp. "+todesimal(rmbmonth.asuransi));
                $("#rmbbpjsmonth").html("Rp. "+todesimal(rmbmonth.bpjs));
                $("#rmbmcumonth").html("Rp. "+todesimal(rmbmonth.mcu));
                $("#rmbobatmonth").html("Rp. "+todesimal(rmbmonth.obat));
                $("#rmblainmonth").html("Rp. "+todesimal(rmbmonth.lain));

                $("#rsmsumummonth").html("Rp. "+todesimal(rmslast30day.umum));
                $("#rsmsasuransimonth").html("Rp. "+todesimal(rmslast30day.asuransi));
                $("#rsmsbpjsmonth").html("Rp. "+todesimal(rmslast30day.bpjs));
                $("#rsmsmcumonth").html("Rp. "+todesimal(rmslast30day.mcu));
                $("#rsmsobatmonth").html("Rp. "+todesimal(rmslast30day.obat));
                $("#rsmslainmonth").html("Rp. "+todesimal(rmslast30day.lain));

                $("#rsiaumummonth").html("Rp. "+todesimal(rsialast30day.umum));
                $("#rsiaasuransimonth").html("Rp. "+todesimal(rsialast30day.asuransi));
                $("#rsiabpjsmonth").html("Rp. "+todesimal(rsialast30day.bpjs));
                $("#rsiamcumonth").html("Rp. "+todesimal(rsialast30day.mcu));
                $("#rsiaobatmonth").html("Rp. "+todesimal(rsialast30day.obat));
                $("#rsialainmonth").html("Rp. "+todesimal(rsialast30day.lain));

                $("#rstumummonth").html("Rp. "+todesimal(rstlast30day.umum));
                $("#rstasuransimonth").html("Rp. "+todesimal(rstlast30day.asuransi));
                $("#rstbpjsmonth").html("Rp. "+todesimal(rstlast30day.bpjs));
                $("#rstmcumonth").html("Rp. "+todesimal(rstlast30day.mcu));
                $("#rstobatmonth").html("Rp. "+todesimal(rstlast30day.obat));
                $("#rstlainmonth").html("Rp. "+todesimal(rstlast30day.lain));

                const rmsDatayears  = getSummaryYears("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
                const rsiaDatayears = getSummaryYears("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
                const rstDatayears  = getSummaryYears("a4633f72-4d67-4f65-a050-9f6240704151");

                const totalRMSyears  = totalpendapatan(rmsDatayears);
                const totalRSIAyears = totalpendapatan(rsiaDatayears);
                const totalRSTyears  = totalpendapatan(rstDatayears);
                const totalAllyears  = totalRMSyears + totalRSIAyears + totalRSTyears;

                const rmsyears  = totalrincianpendapatan(rmsDatayears);
                const rsiayears = totalrincianpendapatan(rsiaDatayears);
                const rstyears  = totalrincianpendapatan(rstDatayears);

                const rmbyears = {
                    umum    : rmsyears.umum + rsiayears.umum + rstyears.umum,
                    asuransi: rmsyears.asuransi + rsiayears.asuransi + rstyears.asuransi,
                    bpjs    : rmsyears.bpjs + rsiayears.bpjs + rstyears.bpjs,
                    mcu     : rmsyears.mcu + rsiayears.mcu + rstyears.mcu,
                    obat    : rmsyears.obat + rsiayears.obat + rstyears.obat,
                    lain    : rmsyears.lain + rsiayears.lain + rstyears.lain,
                };

                $("#totalrmbyears").html("Rp. "+todesimal(totalAllyears));
                $("#totalrsmsyears").html("Rp. "+todesimal(totalRMSyears));
                $("#totalrsiayears").html("Rp. "+todesimal(totalRSIAyears));
                $("#totalrstyears").html("Rp. "+todesimal(totalRSTyears));

                $("#rmbumumyears").html("Rp. "+todesimal(rmbyears.umum));
                $("#rmbasuransiyears").html("Rp. "+todesimal(rmbyears.asuransi));
                $("#rmbbpjsyears").html("Rp. "+todesimal(rmbyears.bpjs));
                $("#rmbmcuyears").html("Rp. "+todesimal(rmbyears.mcu));
                $("#rmbobatyears").html("Rp. "+todesimal(rmbyears.obat));
                $("#rmblainyears").html("Rp. "+todesimal(rmbyears.lain));

                $("#rsmsumumyears").html("Rp. "+todesimal(rmsyears.umum));
                $("#rsmsasuransiyears").html("Rp. "+todesimal(rmsyears.asuransi));
                $("#rsmsbpjsyears").html("Rp. "+todesimal(rmsyears.bpjs));
                $("#rsmsmcuyears").html("Rp. "+todesimal(rmsyears.mcu));
                $("#rsmsobatyears").html("Rp. "+todesimal(rmsyears.obat));
                $("#rsmslainyears").html("Rp. "+todesimal(rmsyears.lain));

                $("#rsiaumumyears").html("Rp. "+todesimal(rsiayears.umum));
                $("#rsiaasuransiyears").html("Rp. "+todesimal(rsiayears.asuransi));
                $("#rsiabpjsyears").html("Rp. "+todesimal(rsiayears.bpjs));
                $("#rsiamcuyears").html("Rp. "+todesimal(rsiayears.mcu));
                $("#rsiaobatyears").html("Rp. "+todesimal(rsiayears.obat));
                $("#rsialainyears").html("Rp. "+todesimal(rsiayears.lain));

                $("#rstumumyears").html("Rp. "+todesimal(rstyears.umum));
                $("#rstasuransiyears").html("Rp. "+todesimal(rstyears.asuransi));
                $("#rstbpjsyears").html("Rp. "+todesimal(rstyears.bpjs));
                $("#rstmcuyears").html("Rp. "+todesimal(rstyears.mcu));
                $("#rstobatyears").html("Rp. "+todesimal(rstyears.obat));
                $("#rstlainyears").html("Rp. "+todesimal(rstyears.lain));

                for (let i in result) {
                    let row      = result[i];
                    let date     = row.date;
                    let tanggal  = row.tanggal;
                    let month    = new Date(date).getMonth() + 1;
                    let keyMonth = month < 10 ? '0' + month : '' + month;
                    let orgId    = row.org_id;
                    let rsCode   = rumahSakitMap[orgId] ?? null;

                    if (!rsCode) continue;

                    const totalRowNow = [
                        row.u_rj, row.u_ri, row.a_rj, row.a_ri,
                        row.b_rj, row.b_ri, row.mcu_cash, row.mcu_inv,
                        row.pob, row.lain
                    ].reduce((sum, val) => sum + parseFloat(val || 0), 0);
                    
                    const totalRowCompare = [
                        row.u_rj_compare, row.u_ri_compare, row.a_rj_compare, row.a_ri_compare,
                        row.b_rj_compare, row.b_ri_compare, row.mcu_inv_compare, row.pob_compare,
                        row.lain_compare
                    ].reduce((sum, val) => sum + parseFloat(val || 0), 0);

                    let htmlRS = `
                        <tr>
                            <td class="ps-4">${new Date(date).toLocaleDateString('id-ID', { weekday: 'long' })}</td>
                            <td class='text-center'>${tanggal}</td>

                            <td class='text-end ${parseFloat(row.u_rj) !== parseFloat(row.u_rj_compare) ? "table-danger" : ""}'>${todesimal(row.u_rj)}</td>
                            <td class='text-end ${parseFloat(row.u_rj) !== parseFloat(row.u_rj_compare) ? "table-danger" : ""}'>${todesimal(row.u_rj_compare)}</td>

                            <td class='text-end ${parseFloat(row.u_ri) !== parseFloat(row.u_ri_compare) ? "table-danger" : ""}'>${todesimal(row.u_ri)}</td>
                            <td class='text-end ${parseFloat(row.u_ri) !== parseFloat(row.u_ri_compare) ? "table-danger" : ""}'>${todesimal(row.u_ri_compare)}</td>

                            <td class='text-end ${parseFloat(row.a_rj) !== parseFloat(row.a_rj_compare) ? "table-danger" : ""}'>${todesimal(row.a_rj)}</td>
                            <td class='text-end ${parseFloat(row.a_rj) !== parseFloat(row.a_rj_compare) ? "table-danger" : ""}'>${todesimal(row.a_rj_compare)}</td>

                            <td class='text-end ${parseFloat(row.a_ri) !== parseFloat(row.a_ri_compare) ? "table-danger" : ""}'>${todesimal(row.a_ri)}</td>
                            <td class='text-end ${parseFloat(row.a_ri) !== parseFloat(row.a_ri_compare) ? "table-danger" : ""}'>${todesimal(row.a_ri_compare)}</td>

                            <td class='text-end ${parseFloat(row.b_rj) !== parseFloat(row.b_rj_compare) ? "table-danger" : ""}'>${todesimal(row.b_rj)}</td>
                            <td class='text-end ${parseFloat(row.b_rj) !== parseFloat(row.b_rj_compare) ? "table-danger" : ""}'>${todesimal(row.b_rj_compare)}</td>

                            <td class='text-end'>${todesimal(row.claimbpjsrj)}</td>

                            <td class='text-end ${parseFloat(row.b_ri) !== parseFloat(row.b_ri_compare) ? "table-danger" : ""}'>${todesimal(row.b_ri)}</td>
                            <td class='text-end ${parseFloat(row.b_ri) !== parseFloat(row.b_ri_compare) ? "table-danger" : ""}'>${todesimal(row.b_ri_compare)}</td>

                            <td class='text-end'>${todesimal(row.claimbpjsri)}</td>

                            <td class='text-end'>${todesimal(row.mcu_cash)}</td>
                            <td class='text-end'>${todesimal(row.mcu_inv)}</td>
                            <td class='text-end'>${todesimal(parseFloat(row.mcu_cash) + parseFloat(row.mcu_inv))}</td>

                            <td class='text-end ${parseFloat(row.mcu_cash) + parseFloat(row.mcu_inv) !== parseFloat(row.mcu_inv_compare) ? "table-danger" : ""}'>${todesimal(row.mcu_inv_compare)}</td>

                            <td class='text-end ${parseFloat(row.pob) !== parseFloat(row.pob_compare) ? "table-danger" : ""}'>${todesimal(row.pob)}</td>
                            <td class='text-end ${parseFloat(row.pob) !== parseFloat(row.pob_compare) ? "table-danger" : ""}'>${todesimal(row.pob_compare)}</td>

                            <td class='text-end ${parseFloat(row.lain) !== parseFloat(row.lain_compare) ? "table-danger" : ""}'>${todesimal(row.lain)}</td>
                            <td class='text-end ${parseFloat(row.lain) !== parseFloat(row.lain_compare) ? "table-danger" : ""}'>${todesimal(row.lain_compare)}</td>

                            <td class='text-end ${totalRowNow !== totalRowCompare ? "table-danger" : ""}'>${todesimal(totalRowNow)}</td>
                            <td class='text-end ${totalRowNow !== totalRowCompare ? "table-danger" : ""}'>${todesimal(totalRowCompare)}</td>

                        </tr>
                    `;

                    $("#resultpendapatan" + rsCode + keyMonth).append(htmlRS);

                    if (!groupRMB[keyMonth]) groupRMB[keyMonth] = {};
                    if (!groupRMB[keyMonth][tanggal]) {
                        groupRMB[keyMonth][tanggal] = {
                            date: date,
                            u_rj: 0, u_rj_compare: 0,
                            u_ri: 0, u_ri_compare: 0,
                            a_rj: 0, a_rj_compare: 0,
                            a_ri: 0, a_ri_compare: 0,
                            b_rj: 0, b_rj_compare: 0,
                            b_ri: 0, b_ri_compare: 0,
                            mcu_cash: 0, mcu_inv: 0, mcu_inv_compare: 0,
                            pob: 0, pob_compare: 0,
                            lain: 0, lain_compare: 0
                        };
                    }

                    let g = groupRMB[keyMonth][tanggal];
                    g.u_rj += Number(row.u_rj); g.u_rj_compare += Number(row.u_rj_compare);
                    g.u_ri += Number(row.u_ri); g.u_ri_compare += Number(row.u_ri_compare);
                    g.a_rj += Number(row.a_rj); g.a_rj_compare += Number(row.a_rj_compare);
                    g.a_ri += Number(row.a_ri); g.a_ri_compare += Number(row.a_ri_compare);
                    g.b_rj += Number(row.b_rj); g.b_rj_compare += Number(row.b_rj_compare);
                    g.b_ri += Number(row.b_ri); g.b_ri_compare += Number(row.b_ri_compare);
                    g.mcu_cash += Number(row.mcu_cash);
                    g.mcu_inv += Number(row.mcu_inv);
                    g.mcu_inv_compare += Number(row.mcu_inv_compare);
                    g.pob += Number(row.pob); g.pob_compare += Number(row.pob_compare);
                    g.lain += Number(row.lain); g.lain_compare += Number(row.lain_compare);
                }

                for (let m = 1; m <= 12; m++) {
                    let key = m < 10 ? '0' + m : '' + m;
                    let rows = [];

                    if (groupRMB[key]) {
                        let tanggalKeys = Object.keys(groupRMB[key]).sort((a, b) => Number(a) - Number(b));

                        for (let t of tanggalKeys) {
                            let g = groupRMB[key][t];
                            let hari = new Date(g.date).toLocaleDateString('id-ID', { weekday: 'long' });

                            const totalRowNow = [
                                g.u_rj, g.u_ri, g.a_rj, g.a_ri,
                                g.b_rj, g.b_ri, g.mcu_cash, g.mcu_inv,
                                g.pob, g.lain
                            ].reduce((sum, val) => sum + parseFloat(val || 0), 0);
                            
                            const totalRowCompare = [
                                g.u_rj_compare, g.u_ri_compare, g.a_rj_compare, g.a_ri_compare,
                                g.b_rj_compare, g.b_ri_compare, g.mcu_inv_compare, g.pob_compare,
                                g.lain_compare
                            ].reduce((sum, val) => sum + parseFloat(val || 0), 0);

                            
                            let html = `
                                <tr>
                                    <td class="ps-4">${hari}</td>
                                    <td class="text-center">${t}</td>

                                    <td class="text-end ${g.u_rj !== g.u_rj_compare ? "table-danger" : ""}">${todesimal(g.u_rj)}</td>
                                    <td class="text-end ${g.u_rj !== g.u_rj_compare ? "table-danger" : ""}">${todesimal(g.u_rj_compare)}</td>

                                    <td class="text-end ${g.u_ri !== g.u_ri_compare ? "table-danger" : ""}">${todesimal(g.u_ri)}</td>
                                    <td class="text-end ${g.u_ri !== g.u_ri_compare ? "table-danger" : ""}">${todesimal(g.u_ri_compare)}</td>

                                    <td class="text-end ${g.a_rj !== g.a_rj_compare ? "table-danger" : ""}">${todesimal(g.a_rj)}</td>
                                    <td class="text-end ${g.a_rj !== g.a_rj_compare ? "table-danger" : ""}">${todesimal(g.a_rj_compare)}</td>

                                    <td class="text-end ${g.a_ri !== g.a_ri_compare ? "table-danger" : ""}">${todesimal(g.a_ri)}</td>
                                    <td class="text-end ${g.a_ri !== g.a_ri_compare ? "table-danger" : ""}">${todesimal(g.a_ri_compare)}</td>

                                    <td class="text-end ${g.b_rj !== g.b_rj_compare ? "table-danger" : ""}">${todesimal(g.b_rj)}</td>
                                    <td class="text-end ${g.b_rj !== g.b_rj_compare ? "table-danger" : ""}">${todesimal(g.b_rj_compare)}</td>

                                    <td class="text-end">${todesimal(g.claimbpjsrj)}</td>

                                    <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri)}</td>
                                    <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri_compare)}</td>

                                    <td class="text-end">${todesimal(g.claimbpjsri)}</td>

                                    <td class="text-end">${todesimal(g.mcu_cash)}</td>
                                    <td class="text-end">${todesimal(g.mcu_inv)}</td>
                                    <td class="text-end">${todesimal(g.mcu_cash + g.mcu_inv)}</td>

                                    <td class="text-end ${(g.mcu_cash + g.mcu_inv) !== g.mcu_inv_compare ? "table-danger" : ""}">${todesimal(g.mcu_inv_compare)}</td>

                                    <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob)}</td>
                                    <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob_compare)}</td>

                                    <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain)}</td>
                                    <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain_compare)}</td>

                                    <td class="text-end ${totalRowNow !== totalRowCompare ? "table-danger" : ""}">${todesimal(totalRowNow)}</td>
                                    <td class="text-end ${totalRowNow !== totalRowCompare ? "table-danger" : ""}">${todesimal(totalRowCompare)}</td>
                                </tr>
                                `;

                            rows.push(html);
                        }
                        $("#resultpendapatanrmb" + key).html(rows.join(""));
                    }
                }
            }
            

        },
        complete: function () {
            Swal.close();
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

// function dataharian() {
//     var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
//     $.ajax({
//         url       : url + "index.php/sb/insight/dataharian",
//         data      : {periode: periode},
//         method    : "POST",
//         dataType  : "JSON",
//         cache     : false,
//         beforeSend: function () {
//             Swal.fire({
//                 title            : 'Sending request...',
//                 text             : 'Please wait',
//                 allowOutsideClick: false,
//                 allowEscapeKey   : false,
//                 didOpen          : () => Swal.showLoading()
//             });

//             for (let month = 1; month <= 12; month++) {
//                 let key = month < 10 ? '0' + month : '' + month;
//                 $("#resultpendapatanrmb" + key).html("");
//                 $("#resultpendapatanrsms" + key).html("");
//                 $("#resultpendapatanrsia" + key).html("");
//                 $("#resultpendapatanrst" + key).html("");
//             }
//         },
//         success: function (data) {
//             Swal.fire({
//                 title            : 'Memproses data...',
//                 text             : 'Menyiapkan tampilan data rumah sakit.',
//                 allowOutsideClick: false,
//                 allowEscapeKey   : false,
//                 didOpen          : () => Swal.showLoading()
//             });

//             const rumahSakitMap = {
//                 "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
//                 "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsia",
//                 "a4633f72-4d67-4f65-a050-9f6240704151": "rst"
//             };

//             const groupRMB = {};

//             if (data.responCode === "00") {
//                 const result = data.responResult;

//                 function totalrincianpendapatan(data) {
//                     return {
//                         umum    : Number(data.u_rj || 0) + Number(data.u_ri || 0),
//                         asuransi: Number(data.a_rj || 0) + Number(data.a_ri || 0),
//                         bpjs    : Number(data.b_rj || 0) + Number(data.b_ri || 0),
//                         mcu     : Number(data.mcu_cash || 0) + Number(data.mcu_inv || 0),
//                         obat    : Number(data.pob || 0),
//                         lain    : Number(data.lain || 0),
//                     };
//                 }

//                 function totalpendapatan(data) {
//                     return (
//                         Number(data.u_rj || 0) +
//                         Number(data.u_ri || 0) +
//                         Number(data.a_rj || 0) +
//                         Number(data.a_ri || 0) +
//                         Number(data.b_rj || 0) +
//                         Number(data.b_ri || 0) +
//                         Number(data.mcu_cash || 0) +
//                         Number(data.mcu_inv || 0) +
//                         Number(data.pob || 0) +
//                         Number(data.lain || 0)
//                     );
//                 }

//                 if(result.length > 0){

//                     function lastdataorgid(orgId) {
//                         const rows = result.filter(r => r.org_id === orgId);
//                         return rows.length > 0 ? rows[rows.length - 1] : {};
//                     }

//                     const rmsData  = lastdataorgid("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
//                     const rsiaData = lastdataorgid("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
//                     const rstData  = lastdataorgid("a4633f72-4d67-4f65-a050-9f6240704151");

//                     const totalRMS  = totalpendapatan(rmsData);
//                     const totalRSIA = totalpendapatan(rsiaData);
//                     const totalRST  = totalpendapatan(rstData);
//                     const totalAll  = totalRMS + totalRSIA + totalRST;

//                     const rms  = totalrincianpendapatan(rmsData);
//                     const rsia = totalrincianpendapatan(rsiaData);
//                     const rst  = totalrincianpendapatan(rstData);

//                     const rmb = {
//                         umum    : rms.umum + rsia.umum + rst.umum,
//                         asuransi: rms.asuransi + rsia.asuransi + rst.asuransi,
//                         bpjs    : rms.bpjs + rsia.bpjs + rst.bpjs,
//                         mcu     : rms.mcu + rsia.mcu + rst.mcu,
//                         obat    : rms.obat + rsia.obat + rst.obat,
//                         lain    : rms.lain + rsia.lain + rst.lain,
//                     };

//                     $("#lastdatersms").html(rmsData.date || "-");
//                     $("#lastdatersia").html(rsiaData.date || "-");
//                     $("#lastdaterst").html(rstData.date || "-");

//                     $("#totalrmblastday").html("Rp. "+todesimal(totalAll));
//                     $("#totalrsmslastday").html("Rp. "+todesimal(totalRMS));
//                     $("#totalrsialastday").html("Rp. "+todesimal(totalRSIA));
//                     $("#totalrstlastday").html("Rp. "+todesimal(totalRST));

//                     $("#rmbumumlastday").html("Rp. "+todesimal(rmb.umum));
//                     $("#rmbasuransilastday").html("Rp. "+todesimal(rmb.asuransi));
//                     $("#rmbbpjslastday").html("Rp. "+todesimal(rmb.bpjs));
//                     $("#rmbmculastday").html("Rp. "+todesimal(rmb.mcu));
//                     $("#rmbobatlastday").html("Rp. "+todesimal(rmb.obat));
//                     $("#rmblainlastday").html("Rp. "+todesimal(rmb.lain));

//                     $("#rsmsumumlastday").html("Rp. "+todesimal(rms.umum));
//                     $("#rsmsasuransilastday").html("Rp. "+todesimal(rms.asuransi));
//                     $("#rsmsbpjslastday").html("Rp. "+todesimal(rms.bpjs));
//                     $("#rsmsmculastday").html("Rp. "+todesimal(rms.mcu));
//                     $("#rsmsobatlastday").html("Rp. "+todesimal(rms.obat));
//                     $("#rsmslainlastday").html("Rp. "+todesimal(rms.lain));

//                     $("#rsiaumumlastday").html("Rp. "+todesimal(rsia.umum));
//                     $("#rsiaasuransilastday").html("Rp. "+todesimal(rsia.asuransi));
//                     $("#rsiabpjslastday").html("Rp. "+todesimal(rsia.bpjs));
//                     $("#rsiamculastday").html("Rp. "+todesimal(rsia.mcu));
//                     $("#rsiaobatlastday").html("Rp. "+todesimal(rsia.obat));
//                     $("#rsialainlastday").html("Rp. "+todesimal(rsia.lain));

//                     $("#rstumumlastday").html("Rp. "+todesimal(rst.umum));
//                     $("#rstasuransilastday").html("Rp. "+todesimal(rst.asuransi));
//                     $("#rstbpjslastday").html("Rp. "+todesimal(rst.bpjs));
//                     $("#rstmculastday").html("Rp. "+todesimal(rst.mcu));
//                     $("#rstobatlastday").html("Rp. "+todesimal(rst.obat));
//                     $("#rstlainlastday").html("Rp. "+todesimal(rst.lain));
//                 }

                

//                     function lastdataorgidmonth(orgId) {
//                         const rows = result.filter(r => r.org_id === orgId);

//                         if (rows.length === 0) return {};
//                         const today = new Date();
//                         const oneMonthAgo = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
//                         const recentRows = rows.filter(r => {
//                             const tgl = new Date(r.tanggal);
//                             return tgl >= oneMonthAgo && tgl <= today;
//                         });

//                         if (recentRows.length === 0) return {};
//                         recentRows.sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));
//                         return recentRows[recentRows.length - 1];
//                     }


//                     const rmsDatax  = lastdataorgidmonth("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
//                     const rsiaData = lastdataorgidmonth("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
//                     const rstData  = lastdataorgidmonth("a4633f72-4d67-4f65-a050-9f6240704151");

//                     console.log(rmsDatax);

//                     // const totalRMS  = totalpendapatan(rmsData);
//                     // const totalRSIA = totalpendapatan(rsiaData);
//                     // const totalRST  = totalpendapatan(rstData);
//                     // const totalAll  = totalRMS + totalRSIA + totalRST;

//                     // const rms  = totalrincianpendapatan(rmsData);
//                     // const rsia = totalrincianpendapatan(rsiaData);
//                     // const rst  = totalrincianpendapatan(rstData);

//                     // const rmb = {
//                     //     umum    : rms.umum + rsia.umum + rst.umum,
//                     //     asuransi: rms.asuransi + rsia.asuransi + rst.asuransi,
//                     //     bpjs    : rms.bpjs + rsia.bpjs + rst.bpjs,
//                     //     mcu     : rms.mcu + rsia.mcu + rst.mcu,
//                     //     obat    : rms.obat + rsia.obat + rst.obat,
//                     //     lain    : rms.lain + rsia.lain + rst.lain,
//                     // };

//                     // $("#totalrmbmonth").html("Rp. "+todesimal(totalAll));
//                     // $("#totalrsmsmonth").html("Rp. "+todesimal(totalRMS));
//                     // $("#totalrsiamonth").html("Rp. "+todesimal(totalRSIA));
//                     // $("#totalrstmonth").html("Rp. "+todesimal(totalRST));

//                     // $("#rmbumummonth").html("Rp. "+todesimal(rmb.umum));
//                     // $("#rmbasuransimonth").html("Rp. "+todesimal(rmb.asuransi));
//                     // $("#rmbbpjsmonth").html("Rp. "+todesimal(rmb.bpjs));
//                     // $("#rmbmcumonth").html("Rp. "+todesimal(rmb.mcu));
//                     // $("#rmbobatmonth").html("Rp. "+todesimal(rmb.obat));
//                     // $("#rmblainmonth").html("Rp. "+todesimal(rmb.lain));

//                     // $("#rsmsumummonth").html("Rp. "+todesimal(rms.umum));
//                     // $("#rsmsasuransimonth").html("Rp. "+todesimal(rms.asuransi));
//                     // $("#rsmsbpjsmonth").html("Rp. "+todesimal(rms.bpjs));
//                     // $("#rsmsmcumonth").html("Rp. "+todesimal(rms.mcu));
//                     // $("#rsmsobatmonth").html("Rp. "+todesimal(rms.obat));
//                     // $("#rsmslainmonth").html("Rp. "+todesimal(rms.lain));

//                     // $("#rsiaumummonth").html("Rp. "+todesimal(rsia.umum));
//                     // $("#rsiaasuransimonth").html("Rp. "+todesimal(rsia.asuransi));
//                     // $("#rsiabpjsmonth").html("Rp. "+todesimal(rsia.bpjs));
//                     // $("#rsiamcumonth").html("Rp. "+todesimal(rsia.mcu));
//                     // $("#rsiaobatmonth").html("Rp. "+todesimal(rsia.obat));
//                     // $("#rsialainmonth").html("Rp. "+todesimal(rsia.lain));

//                     // $("#rstumummonth").html("Rp. "+todesimal(rst.umum));
//                     // $("#rstasuransimonth").html("Rp. "+todesimal(rst.asuransi));
//                     // $("#rstbpjsmonth").html("Rp. "+todesimal(rst.bpjs));
//                     // $("#rstmcumonth").html("Rp. "+todesimal(rst.mcu));
//                     // $("#rstobatmonth").html("Rp. "+todesimal(rst.obat));
//                     // $("#rstlainmonth").html("Rp. "+todesimal(rst.lain));
                

//                 for (let i in result) {
//                     let row      = result[i];
//                     let date     = row.date;
//                     let tanggal  = row.tanggal;
//                     let month    = new Date(date).getMonth() + 1;
//                     let keyMonth = month < 10 ? '0' + month : '' + month;
//                     let orgId    = row.org_id;
//                     let rsCode   = rumahSakitMap[orgId] ?? null;

//                     if (!rsCode) continue;

//                     let htmlRS = `
//                         <tr>
//                             <td class="ps-4">${new Date(date).toLocaleDateString('id-ID', { weekday: 'long' })}</td>
//                             <td class='text-center'>${tanggal}</td>

//                             <td class='text-end ${parseFloat(row.u_rj) !== parseFloat(row.u_rj_compare) ? "table-danger" : ""}'>${todesimal(row.u_rj)}</td>
//                             <td class='text-end ${parseFloat(row.u_rj) !== parseFloat(row.u_rj_compare) ? "table-danger" : ""}'>${todesimal(row.u_rj_compare)}</td>

//                             <td class='text-end ${parseFloat(row.u_ri) !== parseFloat(row.u_ri_compare) ? "table-danger" : ""}'>${todesimal(row.u_ri)}</td>
//                             <td class='text-end ${parseFloat(row.u_ri) !== parseFloat(row.u_ri_compare) ? "table-danger" : ""}'>${todesimal(row.u_ri_compare)}</td>

//                             <td class='text-end ${parseFloat(row.a_rj) !== parseFloat(row.a_rj_compare) ? "table-danger" : ""}'>${todesimal(row.a_rj)}</td>
//                             <td class='text-end ${parseFloat(row.a_rj) !== parseFloat(row.a_rj_compare) ? "table-danger" : ""}'>${todesimal(row.a_rj_compare)}</td>

//                             <td class='text-end ${parseFloat(row.a_ri) !== parseFloat(row.a_ri_compare) ? "table-danger" : ""}'>${todesimal(row.a_ri)}</td>
//                             <td class='text-end ${parseFloat(row.a_ri) !== parseFloat(row.a_ri_compare) ? "table-danger" : ""}'>${todesimal(row.a_ri_compare)}</td>

//                             <td class='text-end ${parseFloat(row.b_rj) !== parseFloat(row.b_rj_compare) ? "table-danger" : ""}'>${todesimal(row.b_rj)}</td>
//                             <td class='text-end ${parseFloat(row.b_rj) !== parseFloat(row.b_rj_compare) ? "table-danger" : ""}'>${todesimal(row.b_rj_compare)}</td>

//                             <td class='text-end'>${todesimal(row.claimbpjsrj)}</td>

//                             <td class='text-end ${parseFloat(row.b_ri) !== parseFloat(row.b_ri_compare) ? "table-danger" : ""}'>${todesimal(row.b_ri)}</td>
//                             <td class='text-end ${parseFloat(row.b_ri) !== parseFloat(row.b_ri_compare) ? "table-danger" : ""}'>${todesimal(row.b_ri_compare)}</td>

//                             <td class='text-end'>${todesimal(row.claimbpjsri)}</td>

//                             <td class='text-end'>${todesimal(row.mcu_cash)}</td>
//                             <td class='text-end'>${todesimal(row.mcu_inv)}</td>
//                             <td class='text-end'>${todesimal(parseFloat(row.mcu_cash) + parseFloat(row.mcu_inv))}</td>

//                             <td class='text-end ${parseFloat(row.mcu_cash) + parseFloat(row.mcu_inv) !== parseFloat(row.mcu_inv_compare) ? "table-danger" : ""}'>${todesimal(row.mcu_inv_compare)}</td>

//                             <td class='text-end ${parseFloat(row.pob) !== parseFloat(row.pob_compare) ? "table-danger" : ""}'>${todesimal(row.pob)}</td>
//                             <td class='text-end ${parseFloat(row.pob) !== parseFloat(row.pob_compare) ? "table-danger" : ""}'>${todesimal(row.pob_compare)}</td>

//                             <td class='text-end ${parseFloat(row.lain) !== parseFloat(row.lain_compare) ? "table-danger" : ""}'>${todesimal(row.lain)}</td>
//                             <td class='text-end ${parseFloat(row.lain) !== parseFloat(row.lain_compare) ? "table-danger" : ""}'>${todesimal(row.lain_compare)}</td>
//                         </tr>
//                     `;

//                     $("#resultpendapatan" + rsCode + keyMonth).append(htmlRS);

//                     if (!groupRMB[keyMonth]) groupRMB[keyMonth] = {};
//                     if (!groupRMB[keyMonth][tanggal]) {
//                         groupRMB[keyMonth][tanggal] = {
//                             date: date,
//                             u_rj: 0, u_rj_compare: 0,
//                             u_ri: 0, u_ri_compare: 0,
//                             a_rj: 0, a_rj_compare: 0,
//                             a_ri: 0, a_ri_compare: 0,
//                             b_rj: 0, b_rj_compare: 0,
//                             b_ri: 0, b_ri_compare: 0,
//                             mcu_cash: 0, mcu_inv: 0, mcu_inv_compare: 0,
//                             pob: 0, pob_compare: 0,
//                             lain: 0, lain_compare: 0
//                         };
//                     }

//                     let g = groupRMB[keyMonth][tanggal];
//                     g.u_rj += Number(row.u_rj); g.u_rj_compare += Number(row.u_rj_compare);
//                     g.u_ri += Number(row.u_ri); g.u_ri_compare += Number(row.u_ri_compare);
//                     g.a_rj += Number(row.a_rj); g.a_rj_compare += Number(row.a_rj_compare);
//                     g.a_ri += Number(row.a_ri); g.a_ri_compare += Number(row.a_ri_compare);
//                     g.b_rj += Number(row.b_rj); g.b_rj_compare += Number(row.b_rj_compare);
//                     g.b_ri += Number(row.b_ri); g.b_ri_compare += Number(row.b_ri_compare);
//                     g.mcu_cash += Number(row.mcu_cash);
//                     g.mcu_inv += Number(row.mcu_inv);
//                     g.mcu_inv_compare += Number(row.mcu_inv_compare);
//                     g.pob += Number(row.pob); g.pob_compare += Number(row.pob_compare);
//                     g.lain += Number(row.lain); g.lain_compare += Number(row.lain_compare);
//                 }

//                 for (let m = 1; m <= 12; m++) {
//                     let key = m < 10 ? '0' + m : '' + m;
//                     let rows = [];

//                     if (groupRMB[key]) {
//                         let tanggalKeys = Object.keys(groupRMB[key]).sort((a, b) => Number(a) - Number(b));

//                         for (let t of tanggalKeys) {
//                             let g = groupRMB[key][t];
//                             let hari = new Date(g.date).toLocaleDateString('id-ID', { weekday: 'long' });

//                             let html = `
//                                 <tr>
//                                     <td class="ps-4">${hari}</td>
//                                     <td class="text-center">${t}</td>

//                                     <td class="text-end ${g.u_rj !== g.u_rj_compare ? "table-danger" : ""}">${todesimal(g.u_rj)}</td>
//                                     <td class="text-end ${g.u_rj !== g.u_rj_compare ? "table-danger" : ""}">${todesimal(g.u_rj_compare)}</td>

//                                     <td class="text-end ${g.u_ri !== g.u_ri_compare ? "table-danger" : ""}">${todesimal(g.u_ri)}</td>
//                                     <td class="text-end ${g.u_ri !== g.u_ri_compare ? "table-danger" : ""}">${todesimal(g.u_ri_compare)}</td>

//                                     <td class="text-end ${g.a_rj !== g.a_rj_compare ? "table-danger" : ""}">${todesimal(g.a_rj)}</td>
//                                     <td class="text-end ${g.a_rj !== g.a_rj_compare ? "table-danger" : ""}">${todesimal(g.a_rj_compare)}</td>

//                                     <td class="text-end ${g.a_ri !== g.a_ri_compare ? "table-danger" : ""}">${todesimal(g.a_ri)}</td>
//                                     <td class="text-end ${g.a_ri !== g.a_ri_compare ? "table-danger" : ""}">${todesimal(g.a_ri_compare)}</td>

//                                     <td class="text-end ${g.b_rj !== g.b_rj_compare ? "table-danger" : ""}">${todesimal(g.b_rj)}</td>
//                                     <td class="text-end ${g.b_rj !== g.b_rj_compare ? "table-danger" : ""}">${todesimal(g.b_rj_compare)}</td>

//                                     <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri)}</td>
//                                     <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri_compare)}</td>

//                                     <td class="text-end">${todesimal(g.mcu_cash)}</td>
//                                     <td class="text-end">${todesimal(g.mcu_inv)}</td>

//                                     <td class="text-end ${g.mcu_cash + g.mcu_inv !== g.mcu_inv_compare ? "table-danger" : ""}">
//                                         ${todesimal(g.mcu_inv_compare)}
//                                     </td>

//                                     <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob)}</td>
//                                     <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob_compare)}</td>

//                                     <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain)}</td>
//                                     <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain_compare)}</td>
//                                 </tr>
//                             `;
//                             rows.push(html);
//                         }
//                         $("#resultpendapatanrmb" + key).html(rows.join(""));
//                     }
//                 }

                
//             }
//         },
//         complete: function () {
//             Swal.close();
//         },
//         error: function (xhr, status, error) {
//             Swal.fire({
//                 title: "<h1 class='font-weight-bold' style='color:#234974;'>I'm Sorry</h1>",
//                 html: "<b>" + error + "</b>",
//                 icon: "error",
//                 confirmButtonText: "Please Try Again",
//                 buttonsStyling: false,
//                 timerProgressBar: true,
//                 timer: 5000,
//                 customClass: { confirmButton: "btn btn-danger" },
//                 showClass: { popup: "animate__animated animate__fadeInUp animate__faster" },
//                 hideClass: { popup: "animate__animated animate__fadeOutDown animate__faster" }
//             });
//         }
//     });

//     return false;
// };