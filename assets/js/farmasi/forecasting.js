dataforecasting();

function dataforecasting() {
    $.ajax({
        url       : url + "index.php/farmasi/forecasting/dataforecasting",
        method    : "POST",
        dataType  : "JSON",
        cache     : false,
        success: function (data) {
            const rows = data.responResult || [];
            const bulanKeys = ["jan", "feb", "mar", "apr", "mei", "jun", "jul", "ags", "sep", "okt", "nov", "des"];
            const totalBulan = 12;

            for (let bulanKe = 1; bulanKe <= totalBulan; bulanKe++) {
                const tableBodyId = `#resultdataforecasting_${bulanKe}`;
                let html = "";

                // Tentukan indeks 3 bulan terakhir
                const idx1 = (bulanKe - 4 + 12) % 12;
                const idx2 = (bulanKe - 3 + 12) % 12;
                const idx3 = (bulanKe - 2 + 12) % 12;
                const idx4 = (bulanKe - 1 + 12) % 12;

                if (rows.length === 0) {
                    html = `<tr><td colspan="12" class="text-center">Tidak ada data</td></tr>`;
                } else {
                    rows.forEach(item => {
                        const val1 = parseFloat(item[bulanKeys[idx1]]) || 0;
                        const val2 = parseFloat(item[bulanKeys[idx2]]) || 0;
                        const val3 = parseFloat(item[bulanKeys[idx3]]) || 0;
                        const val4 = parseFloat(item[bulanKeys[idx4]]) || 0;
                        const rata = ((val1 + val2 + val3 + val4) / 4).toFixed(2);

                        const warnClass = (parseFloat(rata) === 0) ? 'table-warning' : '';

                        html += `
                            <tr class="${warnClass}">
                                <td class="ps-4">${item.nama_brng}</td>
                                <td>-</td>
                                <td>${todesimal(val1)}</td>
                                <td>${todesimal(val2)}</td>
                                <td>${todesimal(val3)}</td>
                                <td>${todesimal(val4)}</td>
                                <td>${todesimal(rata)}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td class="text-end">0</td>
                                <td class="text-end pe-4">-</td>
                            </tr>
                        `;
                    });
                }

                $(tableBodyId).html(html);
            }
        },
        error: function () {
            for (let bulanKe = 1; bulanKe <= 12; bulanKe++) {
                const tableBodyId = `#resultdataforecasting_${bulanKe}`;
                $(tableBodyId).html('<tr><td colspan="12" class="text-center text-danger">Gagal memuat data</td></tr>');
            }
        }
    });
}
