datagrafik();

function datagrafik() {
    $.ajax({
        url: url + "index.php/mutu/grafik/datagrafik",
        method: "POST",
        dataType: "JSON",
        cache: false,
        beforeSend() {
            toastr.clear();
            toastr["info"]("Mengambil data grafik...", "Please wait");
        },
        success(response) {
            if (response.responCode === "00") {
                const data = response.responResult;

                // === Persiapan data ===
                const bulanUnik = [...new Set(data.map(item => item.BULAN))].sort();
                const indikatorMap = {};
                const seriesMap = {};

                data.forEach(item => {
                    if (!indikatorMap[item.MUTU]) indikatorMap[item.MUTU] = {};
                    indikatorMap[item.MUTU][item.BULAN] = {
                        capaian: parseFloat(item.CAPAIAN_PERSEN).toFixed(2) + '%',
                        numerator: item.TOTAL_NUMERATOR,
                        denumerator: item.TOTAL_DENUMERATOR
                    };

                    if (!seriesMap[item.MUTU]) seriesMap[item.MUTU] = {};
                    seriesMap[item.MUTU][item.BULAN] = parseFloat(item.CAPAIAN_PERSEN);
                });

                // === Tabel ===
                let header1 = `
                    <tr class="fw-bolder align-middle bg-primary text-white">
                        <th rowspan="2" class="align-middle text-center rounded-start">No</th>
                        <th rowspan="2" class="align-middle">Indikator</th>`;
                bulanUnik.forEach((b, i) => {
                    const d = new Date(b + "-01");
                    const namaBulan = d.toLocaleString("id-ID", { month: "long", year: "numeric" });
                    const isLast = i === bulanUnik.length - 1;
                    const roundedClass = isLast ? " rounded-end" : "";
                    header1 += `<th colspan="2" class="text-center${roundedClass}">${namaBulan}</th>`;
                });
                header1 += `</tr>`;

                let header2 = `<tr class="fw-bolder align-middle bg-primary text-white">`;
                bulanUnik.forEach((_, i) => {
                    const isLast = i === bulanUnik.length - 1;
                    const denumClass = isLast ? " rounded-end" : "";
                    header2 += `<th class="text-center">Num</th><th class="text-center${denumClass}">Denum</th>`;
                });
                header2 += `</tr>`;

                let tbody = '';
                let no = 1;
                Object.keys(indikatorMap).forEach(mutu => {
                    let row1 = `<tr>
                        <td rowspan="2" class="text-center">${no++}</td>
                        <td rowspan="2">${mutu}</td>`;
                    let row2 = `<tr>`;

                    bulanUnik.forEach(b => {
                        const val = indikatorMap[mutu][b] || { capaian: '-', numerator: '-', denumerator: '-' };
                        row1 += `<td colspan="2" class="text-center fw-bold">${val.capaian}</td>`;
                        row2 += `<td class="text-center">${val.numerator}</td><td class="text-center">${val.denumerator}</td>`;
                    });

                    row1 += `</tr>`;
                    row2 += `</tr>`;
                    tbody += row1 + row2;
                });

                $("#tableMutuBulanan").html(`
                    <thead>
                        ${header1}${header2}
                    </thead>
                    <tbody class="text-gray-600 fw-bold">${tbody}</tbody>
                `);

                // === ApexCharts LINE ===
                const series = Object.keys(seriesMap).map(mutu => ({
                    name: mutu,
                    data: bulanUnik.map(b => seriesMap[mutu][b] || 0)
                }));

                const options = {
                    chart: {
                        type: 'line',
                        height: 400,
                        zoom: { enabled: true },
                        toolbar: { show: true }
                    },
                    stroke: { curve: 'smooth', width: 2 },
                    markers: { size: 4 },
                    series: series,
                    xaxis: {
                        categories: bulanUnik.map(b => {
                            const d = new Date(b + "-01");
                            return d.toLocaleString("id-ID", { month: "short", year: "2-digit" });
                        }),
                        title: { text: 'Bulan' }
                    },
                    yaxis: {
                        title: { text: 'Capaian (%)' }
                    },
                    tooltip: {
                        y: { formatter: val => val.toFixed(2) + '%' }
                    },
                    legend: { position: 'bottom' },
                    colors: [
                        "#1E90FF", "#28a745", "#ffc107", "#dc3545", "#6f42c1",
                        "#20c997", "#fd7e14", "#6610f2", "#e83e8c", "#17a2b8",
                        "#343a40", "#007bff", "#ff073a"
                    ]
                };

                // Hapus grafik sebelumnya jika ada
                if (window.chartMutu instanceof ApexCharts) {
                    window.chartMutu.destroy();
                }

                window.chartMutu = new ApexCharts(document.querySelector("#chartMutu"), options);
                window.chartMutu.render();

            } else {
                $("#tableMutuBulanan").html(`<tr><td colspan="100%" class="text-center text-muted">Data tidak ditemukan.</td></tr>`);
                $("#chartMutu").html(`<div class="text-center text-muted mt-3">Data tidak tersedia</div>`);
            }
        },
        complete() {
            toastr.clear();
        },
        error(xhr, status, error) {
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






