dataharian();

$(document).on("change", "select[name='toolbar_kunjunganyears_periode']", function (e) {
    e.preventDefault();
    dataharian();
});

function dataharian() {
    var periode = $("select[name='toolbar_kunjunganyears_periode']").val();

    $.ajax({
        url       : url + "index.php/sb/detailpengeluaran/dataharian",
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
                $("#resultpengeluarantabblnrsms" + key).html("");
                $("#resultpengeluarantabblnrsiabm" + key).html("");
                $("#resultpengeluarantabblnrst" + key).html("");
                $("#resultpengeluarantabblnrmb" + key).html("");
            }
        },
        success: function(data){
            const rumahSakitMap = {
                "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
                "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsiabm",
                "a4633f72-4d67-4f65-a050-9f6240704151": "rst"
            };

            const groupRMB = {};
            const groupPerRS = { rsms: {}, rsia: {}, rst: {} };

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

                    let htmlRS = `
                        <tr>
                            <td class="ps-4">${new Date(date).toLocaleDateString('id-ID', { weekday: 'long' })}</td>
                            <td class='text-center'>${tanggal}</td>
                            <td>${row.no_pemesanan_unit}</td>
                            <td><div>${row.judul_pemesanan}</div><div>${row.note}</div></td>
                            <td>${row.namasupplier}</td>
                            <td>${row.unitpemohon}</td>
                            <td>${row.invoice_no}</td>
                            <td>${row.inv_keu_note || ''}</td>
                            <td class='text-end'>${todesimal(row.subtotal)}</td>
                            <td class='text-end'>${todesimal(row.harga_ppn)}</td>
                            <td class='text-end pe-4'>${todesimal(row.total)}</td>
                        </tr>
                    `;

                    $("#resultpengeluarantabbln" + rsCode + keyMonth).append(htmlRS);

                    // Total per RS per bulan
                    if (!groupPerRS[rsCode][keyMonth]) {
                        groupPerRS[rsCode][keyMonth] = {
                            subtotal: 0,
                            harga_ppn: 0,
                            total: 0
                        };
                    }

                    groupPerRS[rsCode][keyMonth].subtotal += Number(row.subtotal || 0);
                    groupPerRS[rsCode][keyMonth].harga_ppn += Number(row.harga_ppn || 0);
                    groupPerRS[rsCode][keyMonth].total += Number(row.total || 0);

                    // Group untuk RMB
                    if (!groupRMB[keyMonth]) groupRMB[keyMonth] = {};
                    if (!groupRMB[keyMonth][tanggal]) {
                        groupRMB[keyMonth][tanggal] = {
                            date: date,
                            rows: []
                        };
                    }

                    groupRMB[keyMonth][tanggal].rows.push({
                        no_pemesanan_unit: row.no_pemesanan_unit,
                        judul_pemesanan  : row.judul_pemesanan,
                        note             : row.note,
                        unitpemohon      : row.unitpemohon,
                        namasupplier     : row.namasupplier,
                        invoice_no       : row.invoice_no,
                        inv_keu_note     : row.inv_keu_note,
                        subtotal         : Number(row.subtotal || 0),
                        harga_ppn        : Number(row.harga_ppn || 0),
                        total            : Number(row.total || 0)
                    });
                }

                // Render RMB
                for (let m = 1; m <= 12; m++) {
                    let key = m < 10 ? m : '' + m;
                    let rows = [];
                    let totalSubtotal = 0, totalPPN = 0, totalAll = 0;

                    if (groupRMB[key]) {
                        let tanggalKeys = Object.keys(groupRMB[key]).sort((a, b) => Number(a) - Number(b));

                        for (let t of tanggalKeys) {
                            let g = groupRMB[key][t];
                            let hari = new Date(g.date).toLocaleDateString('id-ID', { weekday: 'long' });

                            for (let item of g.rows) {
                                rows.push(`
                                    <tr>
                                        <td class="ps-4">${hari}</td>
                                        <td class='text-center'>${t}</td>
                                        <td>${item.no_pemesanan_unit}</td>
                                        <td><div>${item.judul_pemesanan}</div><div>${item.note}</div></td>
                                        <td>${item.namasupplier}</td>
                                        <td>${item.unitpemohon}</td>
                                        <td>${item.invoice_no}</td>
                                        <td>${item.inv_keu_note || ''}</td>
                                        <td class='text-end'>${todesimal(item.subtotal)}</td>
                                        <td class='text-end'>${todesimal(item.harga_ppn)}</td>
                                        <td class='text-end pe-4'>${todesimal(item.total)}</td>
                                    </tr>
                                `);

                                totalSubtotal += item.subtotal;
                                totalPPN += item.harga_ppn;
                                totalAll += item.total;
                            }
                        }

                        rows.push(`
                                <tr class="fw-bold bg-light">
                                    <td colspan="6" class="text-center">Total Bulan Ini</td>
                                    <td class='text-end'>${todesimal(totalSubtotal)}</td>
                                    <td class='text-end'>${todesimal(totalPPN)}</td>
                                    <td class='text-end pe-4'>${todesimal(totalAll)}</td>
                                </tr>
                        `);

                        $("#resultpengeluarantfoottabblnrmb" + key).html(rows.join(""));
                    }
                }

                // Render <tfoot> untuk RSMS, RSIA, RST
                for (let m = 1; m <= 12; m++) {
                    let key = m < 10 ? m : '' + m;

                    for (let rsCode of ["rsms", "rsia", "rst"]) {
                        if (groupPerRS[rsCode][key]) {
                            let t = groupPerRS[rsCode][key];
                            let tfoot = `
                                    <tr class="fw-bold bg-light">
                                        <td colspan="6" class="text-center">Total Bulan Ini</td>
                                        <td class='text-end'>${todesimal(t.subtotal)}</td>
                                        <td class='text-end'>${todesimal(t.harga_ppn)}</td>
                                        <td class='text-end pe-4'>${todesimal(t.total)}</td>
                                    </tr>
                            `;

                            $("#resultpengeluarantfoottabbln" + rsCode + key).html(tfoot);
                        }
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
//         url       : url + "index.php/sb/detailpengeluaran/dataharian",
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

//             for (let i = 1; i <= 12; i++) {
//                 let key = i < 10 ? i : '' + i;
//                 $("#resultpengeluarantabblnrsms" + key).html("");
//                 $("#resultpengeluarantabblnrsia" + key).html("");
//                 $("#resultpengeluarantabblnrst" + key).html("");
//                 $("#resultpengeluarantabblnrmb" + key).html("");
//             }
//         },
//         success: function(data){

//             const rumahSakitMap = {
//                 "10c84edd-500b-49e3-93a5-a2c8cd2c8524": "rsms",
//                 "d5e63fbc-01ec-4ba8-90b8-fb623438b99d": "rsia",
//                 "a4633f72-4d67-4f65-a050-9f6240704151": "rst"
//             };

//             const groupRMB = {};

//             if(data.responCode === "00"){
//                 const result = data.responResult;

//                 for (let i in result) {
//                     let row      = result[i];
//                     let date     = row.date;
//                     let tanggal  = row.tanggal;
//                     let month    = new Date(date).getMonth() + 1;
//                     let keyMonth = month < 10 ? month : '' + month;
//                     let orgId    = row.org_id;
//                     let rsCode   = rumahSakitMap[orgId] ?? null;

//                     if (!rsCode) continue;

//                     let htmlRS = `
//                         <tr>
//                             <td class="ps-4">${new Date(date).toLocaleDateString('id-ID', { weekday: 'long' })}</td>
//                             <td class='text-center'>${tanggal}</td>
//                             <td>${row.no_pemesanan_unit}</td>
//                             <td><div>${row.judul_pemesanan}</div><div>${row.note}</div></td>
//                             <td>${row.unitpemohon}</td>
//                             <td>${row.invoice_no}</td>
//                             <td class='text-end'>${todesimal(row.subtotal)}</td>
//                             <td class='text-end'>${todesimal(row.harga_ppn)}</td>
//                             <td class='text-end pe-4'>${todesimal(row.total)}</td>
//                         </tr>
//                     `;

//                     $("#resultpengeluarantabbln"+rsCode+keyMonth).append(htmlRS);

//                     if(!groupRMB[keyMonth]) groupRMB[keyMonth] = {};
//                     if(!groupRMB[keyMonth][tanggal]){
//                         groupRMB[keyMonth][tanggal] = {
//                             date: date,
//                             rs: row.rs || '', // nama rumah sakit kalau ada
//                             no_pemesanan_unit: row.no_pemesanan_unit || '',
//                             judul_pemesanan: row.judul_pemesanan || '',
//                             note: row.note || '',
//                             unitpemohon: row.unitpemohon || '',
//                             invoice_no: row.invoice_no || '',
//                             subtotal: Number(row.subtotal || 0),
//                             harga_ppn: Number(row.harga_ppn || 0),
//                             total: Number(row.total || 0)
//                         };
//                     }

//                 }

//                 for (let m = 1; m <= 12; m++) {
//                     let key = m < 10 ? m : '' + m;
//                     let rows = [];

//                     if (groupRMB[key]) {
//                         let tanggalKeys = Object.keys(groupRMB[key]).sort((a, b) => Number(a) - Number(b));

//                         for (let t of tanggalKeys) {
//                             let g = groupRMB[key][t];
//                             let hari = new Date(g.date).toLocaleDateString('id-ID', { weekday: 'long' });
                            
//                             let htmlRS = `
//                                 <tr>
//                                     <td class="ps-4">${hari}</td>
//                                     <td class="text-center">${t}</td>
//                                     <td>${g.no_pemesanan_unit}</td>
//                                     <td><div>${g.judul_pemesanan}</div><div>${g.note}</div></td>
//                                     <td>${g.unitpemohon}</td>
//                                     <td>${g.invoice_no}</td>
//                                     <td class='text-end'>${todesimal(g.subtotal)}</td>
//                                     <td class='text-end'>${todesimal(g.harga_ppn)}</td>
//                                     <td class='text-end pe-4'>${todesimal(g.total)}</td>
//                                 </tr>
//                             `;
//                             rows.push(htmlRS);
//                         }

                        
//                         $("#resultpengeluarantabblnrmb"+key).html(rows.join(""));
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