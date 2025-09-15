datahutang();

$(document).on("change", "select[name='selectorganization']", function (e) {
    e.preventDefault();
    datahutang();
});

$(document).on("change", "select[name='filterperiode']", function (e) {
    e.preventDefault();
    datahutang();
});

function datahutang() {
    const filterperiode      = $("select[name='filterperiode']").val();
    const selectorganization = $("select[name='selectorganization']").val();
    $.ajax({
        url       : url + "index.php/po/hutang/datahutang",
        data      : {filterperiode:filterperiode,selectorganization:selectorganization},
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
                $("#resulthutangtabbln" + key).html("");
                $("#resulthutangtfoottabbln" + key).html("");
            }
        },
        success: function(data){
            if(data.responCode === "00"){
                const result = data.responResult;
                const groupBulan = {};

                for (let i in result) {
                    let row      = result[i];
                    let date     = row.date;
                    let tanggal  = row.tanggal;
                    let month    = new Date(date).getMonth() + 1;
                    let keyMonth = month < 10 ? month : '' + month;

                    if (!groupBulan[keyMonth]) groupBulan[keyMonth] = {};
                    if (!groupBulan[keyMonth][tanggal]) {
                        groupBulan[keyMonth][tanggal] = {
                            date: date,
                            rows: []
                        };
                    }

                    groupBulan[keyMonth][tanggal].rows.push({
                        no_pemesanan_unit: row.no_pemesanan_unit,
                        judul_pemesanan  : row.judul_pemesanan,
                        note             : row.note,
                        unitpemohon      : row.unitpemohon,
                        invoice_no       : row.invoice_no,
                        subtotal         : Number(row.subtotal || 0),
                        harga_ppn        : Number(row.harga_ppn || 0),
                        total            : Number(row.total || 0)
                    });
                }

                // Render per bulan
                for (let m = 1; m <= 12; m++) {
                    let key           = m < 10 ? m : '' + m;
                    let rows          = [];
                    let totalSubtotal = 0, totalPPN = 0, totalAll = 0;

                    if (groupBulan[key]) {
                        let tanggalKeys = Object.keys(groupBulan[key]).sort((a, b) => Number(a) - Number(b));

                        for (let t of tanggalKeys) {
                            let g = groupBulan[key][t];
                            let hari = new Date(g.date).toLocaleDateString('id-ID', { weekday: 'long' });

                            for (let item of g.rows) {
                                rows.push(`
                                    <tr>
                                        <td class="ps-4">${hari}</td>
                                        <td class='text-center'>${t}</td>
                                        <td>${item.no_pemesanan_unit}</td>
                                        <td><div>${item.judul_pemesanan}</div><div>${item.note}</div></td>
                                        <td>${item.unitpemohon}</td>
                                        <td>${item.invoice_no || ''}</td>
                                        <td class='text-end'>${todesimal(item.subtotal)}</td>
                                        <td class='text-end'>${todesimal(item.harga_ppn)}</td>
                                        <td class='text-end pe-4'>${todesimal(item.total)}</td>
                                    </tr>
                                `);

                                totalSubtotal += item.subtotal;
                                totalPPN      += item.harga_ppn;
                                totalAll      += item.total;
                            }
                        }

                        // total per bulan
                        let tfoot = `
                            <tr class="fw-bold bg-light">
                                <td colspan="6" class="text-center">Total Bulan Ini</td>
                                <td class='text-end'>${todesimal(totalSubtotal)}</td>
                                <td class='text-end'>${todesimal(totalPPN)}</td>
                                <td class='text-end pe-4'>${todesimal(totalAll)}</td>
                            </tr>
                        `;

                        $("#resulthutangtabbln" + key).html(rows.join(""));
                        $("#resulthutangtfoottabbln" + key).html(tfoot);

                        console.log(("#resulthutangtabbln" + key));
                    }
                }
            }
        },
        complete: function () {
            Swal.close();
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
