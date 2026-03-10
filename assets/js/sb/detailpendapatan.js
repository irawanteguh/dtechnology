dataharian();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    dataharian();
});

function dataharian() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();
    $.ajax({
        url       : url + "index.php/sb/detailpendapatan/dataharian",
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

            for (let i = 1; i <= 12; i++) {
                let key = i < 10 ? i : '' + i;
                $("#resultpendapatantabblnrsms" + key).html("");
                $("#resultpendapatantabblnrsiabm" + key).html("");
                $("#resultpendapatantabblnrst" + key).html("");
                $("#resultpendapatantabblnrmb" + key).html("");
            }
        },
        success: function(data){

            const rumahSakitMap = {
                "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsiabm",
                "a4633f72-4d67-4f65-a050-9f6240704151": "rst"
            };

            const groupRMB = {};

            if(data.responCode === "00"){
                const result = data.responResult;

                for (let i in result) {
                    let row      = result[i];
                    let date     = row.date;
                    let tanggal  = row.tanggal;
                    let month    = new Date(date).getMonth() + 1;
                    let keyMonth = month < 10 ? month : '' + month;
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

                    $("#resultpendapatantabbln"+rsCode+keyMonth).append(htmlRS);

                    if(!groupRMB[keyMonth]) groupRMB[keyMonth] = {};
                    if(!groupRMB[keyMonth][tanggal]){
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
                            lain: 0, lain_compare: 0,
                            claimbpjsrj: 0,
                            claimbpjsri: 0
                        };
                    }


                    let g = groupRMB[keyMonth][tanggal];
                    g.u_rj            += Number(row.u_rj); g.u_rj_compare += Number(row.u_rj_compare);
                    g.u_ri            += Number(row.u_ri); g.u_ri_compare += Number(row.u_ri_compare);
                    g.a_rj            += Number(row.a_rj); g.a_rj_compare += Number(row.a_rj_compare);
                    g.a_ri            += Number(row.a_ri); g.a_ri_compare += Number(row.a_ri_compare);
                    g.b_rj            += Number(row.b_rj); g.b_rj_compare += Number(row.b_rj_compare);
                    g.b_ri            += Number(row.b_ri); g.b_ri_compare += Number(row.b_ri_compare);
                    g.mcu_cash        += Number(row.mcu_cash);
                    g.mcu_inv         += Number(row.mcu_inv);
                    g.mcu_inv_compare += Number(row.mcu_inv_compare);
                    g.pob             += Number(row.pob); g.pob_compare   += Number(row.pob_compare);
                    g.lain            += Number(row.lain); g.lain_compare += Number(row.lain_compare);
                    g.claimbpjsrj     += Number(row.claimbpjsrj || 0);
                    g.claimbpjsri     += Number(row.claimbpjsri || 0);

                }

                for (let m = 1; m <= 12; m++) {
                    let key = m < 10 ? m : '' + m;
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

                        
                        $("#resultpendapatantabblnrmb"+key).html(rows.join(""));
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