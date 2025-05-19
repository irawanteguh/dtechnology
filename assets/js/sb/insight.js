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

                if(result.length > 0){

                    function lastdataorgid(orgId) {
                        const rows = result.filter(r => r.org_id === orgId);
                        return rows.length > 0 ? rows[rows.length - 1] : {};
                    }

                    const rmsData  = lastdataorgid("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
                    const rsiaData = lastdataorgid("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
                    const rstData  = lastdataorgid("a4633f72-4d67-4f65-a050-9f6240704151");

                    const totalRMS  = totalpendapatan(rmsData);
                    const totalRSIA = totalpendapatan(rsiaData);
                    const totalRST  = totalpendapatan(rstData);
                    const totalAll  = totalRMS + totalRSIA + totalRST;

                    const rms  = totalrincianpendapatan(rmsData);
                    const rsia = totalrincianpendapatan(rsiaData);
                    const rst  = totalrincianpendapatan(rstData);

                    const rmb = {
                        umum    : rms.umum + rsia.umum + rst.umum,
                        asuransi: rms.asuransi + rsia.asuransi + rst.asuransi,
                        bpjs    : rms.bpjs + rsia.bpjs + rst.bpjs,
                        mcu     : rms.mcu + rsia.mcu + rst.mcu,
                        obat    : rms.obat + rsia.obat + rst.obat,
                        lain    : rms.lain + rsia.lain + rst.lain,
                    };

                    $("#lastdatersms").html(rmsData.date || "-");
                    $("#lastdatersia").html(rsiaData.date || "-");
                    $("#lastdaterst").html(rstData.date || "-");

                    $("#totalrmblastday").html("Rp. "+todesimal(totalAll));
                    $("#totalrsmslastday").html("Rp. "+todesimal(totalRMS));
                    $("#totalrsialastday").html("Rp. "+todesimal(totalRSIA));
                    $("#totalrstlastday").html("Rp. "+todesimal(totalRST));

                    $("#rmbumumlastday").html("Rp. "+todesimal(rmb.umum));
                    $("#rmbasuransilastday").html("Rp. "+todesimal(rmb.asuransi));
                    $("#rmbbpjslastday").html("Rp. "+todesimal(rmb.bpjs));
                    $("#rmbmculastday").html("Rp. "+todesimal(rmb.mcu));
                    $("#rmbobatlastday").html("Rp. "+todesimal(rmb.obat));
                    $("#rmblainlastday").html("Rp. "+todesimal(rmb.lain));

                    $("#rsmsumumlastday").html("Rp. "+todesimal(rms.umum));
                    $("#rsmsasuransilastday").html("Rp. "+todesimal(rms.asuransi));
                    $("#rsmsbpjslastday").html("Rp. "+todesimal(rms.bpjs));
                    $("#rsmsmculastday").html("Rp. "+todesimal(rms.mcu));
                    $("#rsmsobatlastday").html("Rp. "+todesimal(rms.obat));
                    $("#rsmslainlastday").html("Rp. "+todesimal(rms.lain));

                    $("#rsiaumumlastday").html("Rp. "+todesimal(rsia.umum));
                    $("#rsiaasuransilastday").html("Rp. "+todesimal(rsia.asuransi));
                    $("#rsiabpjslastday").html("Rp. "+todesimal(rsia.bpjs));
                    $("#rsiamculastday").html("Rp. "+todesimal(rsia.mcu));
                    $("#rsiaobatlastday").html("Rp. "+todesimal(rsia.obat));
                    $("#rsialainlastday").html("Rp. "+todesimal(rsia.lain));

                    $("#rstumumlastday").html("Rp. "+todesimal(rst.umum));
                    $("#rstasuransilastday").html("Rp. "+todesimal(rst.asuransi));
                    $("#rstbpjslastday").html("Rp. "+todesimal(rst.bpjs));
                    $("#rstmculastday").html("Rp. "+todesimal(rst.mcu));
                    $("#rstobatlastday").html("Rp. "+todesimal(rst.obat));
                    $("#rstlainlastday").html("Rp. "+todesimal(rst.lain));
                }

                

                    function lastdataorgidmonth(orgId) {
                        const rows = result.filter(r => r.org_id === orgId);

                        if (rows.length === 0) return {};
                        const today = new Date();
                        const oneMonthAgo = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
                        const recentRows = rows.filter(r => {
                            const tgl = new Date(r.tanggal);
                            return tgl >= oneMonthAgo && tgl <= today;
                        });

                        if (recentRows.length === 0) return {};
                        recentRows.sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));
                        return recentRows[recentRows.length - 1];
                    }


                    const rmsDatax  = lastdataorgidmonth("10c84edd-500b-49e3-93a5-a2c8cd2c8524");
                    const rsiaData = lastdataorgidmonth("d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
                    const rstData  = lastdataorgidmonth("a4633f72-4d67-4f65-a050-9f6240704151");

                    console.log(rmsDatax);

                    // const totalRMS  = totalpendapatan(rmsData);
                    // const totalRSIA = totalpendapatan(rsiaData);
                    // const totalRST  = totalpendapatan(rstData);
                    // const totalAll  = totalRMS + totalRSIA + totalRST;

                    // const rms  = totalrincianpendapatan(rmsData);
                    // const rsia = totalrincianpendapatan(rsiaData);
                    // const rst  = totalrincianpendapatan(rstData);

                    // const rmb = {
                    //     umum    : rms.umum + rsia.umum + rst.umum,
                    //     asuransi: rms.asuransi + rsia.asuransi + rst.asuransi,
                    //     bpjs    : rms.bpjs + rsia.bpjs + rst.bpjs,
                    //     mcu     : rms.mcu + rsia.mcu + rst.mcu,
                    //     obat    : rms.obat + rsia.obat + rst.obat,
                    //     lain    : rms.lain + rsia.lain + rst.lain,
                    // };

                    // $("#totalrmbmonth").html("Rp. "+todesimal(totalAll));
                    // $("#totalrsmsmonth").html("Rp. "+todesimal(totalRMS));
                    // $("#totalrsiamonth").html("Rp. "+todesimal(totalRSIA));
                    // $("#totalrstmonth").html("Rp. "+todesimal(totalRST));

                    // $("#rmbumummonth").html("Rp. "+todesimal(rmb.umum));
                    // $("#rmbasuransimonth").html("Rp. "+todesimal(rmb.asuransi));
                    // $("#rmbbpjsmonth").html("Rp. "+todesimal(rmb.bpjs));
                    // $("#rmbmcumonth").html("Rp. "+todesimal(rmb.mcu));
                    // $("#rmbobatmonth").html("Rp. "+todesimal(rmb.obat));
                    // $("#rmblainmonth").html("Rp. "+todesimal(rmb.lain));

                    // $("#rsmsumummonth").html("Rp. "+todesimal(rms.umum));
                    // $("#rsmsasuransimonth").html("Rp. "+todesimal(rms.asuransi));
                    // $("#rsmsbpjsmonth").html("Rp. "+todesimal(rms.bpjs));
                    // $("#rsmsmcumonth").html("Rp. "+todesimal(rms.mcu));
                    // $("#rsmsobatmonth").html("Rp. "+todesimal(rms.obat));
                    // $("#rsmslainmonth").html("Rp. "+todesimal(rms.lain));

                    // $("#rsiaumummonth").html("Rp. "+todesimal(rsia.umum));
                    // $("#rsiaasuransimonth").html("Rp. "+todesimal(rsia.asuransi));
                    // $("#rsiabpjsmonth").html("Rp. "+todesimal(rsia.bpjs));
                    // $("#rsiamcumonth").html("Rp. "+todesimal(rsia.mcu));
                    // $("#rsiaobatmonth").html("Rp. "+todesimal(rsia.obat));
                    // $("#rsialainmonth").html("Rp. "+todesimal(rsia.lain));

                    // $("#rstumummonth").html("Rp. "+todesimal(rst.umum));
                    // $("#rstasuransimonth").html("Rp. "+todesimal(rst.asuransi));
                    // $("#rstbpjsmonth").html("Rp. "+todesimal(rst.bpjs));
                    // $("#rstmcumonth").html("Rp. "+todesimal(rst.mcu));
                    // $("#rstobatmonth").html("Rp. "+todesimal(rst.obat));
                    // $("#rstlainmonth").html("Rp. "+todesimal(rst.lain));
                

                for (let i in result) {
                    let row      = result[i];
                    let date     = row.date;
                    let tanggal  = row.tanggal;
                    let month    = new Date(date).getMonth() + 1;
                    let keyMonth = month < 10 ? '0' + month : '' + month;
                    let orgId    = row.org_id;
                    let rsCode   = rumahSakitMap[orgId] ?? null;

                    if (!rsCode) continue;

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

                                    <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri)}</td>
                                    <td class="text-end ${g.b_ri !== g.b_ri_compare ? "table-danger" : ""}">${todesimal(g.b_ri_compare)}</td>

                                    <td class="text-end">${todesimal(g.mcu_cash)}</td>
                                    <td class="text-end">${todesimal(g.mcu_inv)}</td>

                                    <td class="text-end ${g.mcu_cash + g.mcu_inv !== g.mcu_inv_compare ? "table-danger" : ""}">
                                        ${todesimal(g.mcu_inv_compare)}
                                    </td>

                                    <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob)}</td>
                                    <td class="text-end ${g.pob !== g.pob_compare ? "table-danger" : ""}">${todesimal(g.pob_compare)}</td>

                                    <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain)}</td>
                                    <td class="text-end ${g.lain !== g.lain_compare ? "table-danger" : ""}">${todesimal(g.lain_compare)}</td>
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