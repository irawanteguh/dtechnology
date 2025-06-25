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
                const indikatorList = [...new Set(data.map(d => d.MUTU_ID))];
                const container = $("#kontainerMutu").empty();

                indikatorList.forEach((mutuId, i) => {
                    const indikatorData = data.filter(d => d.MUTU_ID === mutuId);
                    const namaIndikator = indikatorData[0].MUTU;
                    const definisi = indikatorData[0].definisi_operasional;

                    const chartId = `chart_${mutuId}`;
                    const tableId = `table_${mutuId}`;

                    const bulanUnik = [...new Set(indikatorData.map(d => d.BULAN))].sort();
                    const dataMap = {};
                    const seriesData = [];

                    bulanUnik.forEach(b => {
                        const item = indikatorData.find(d => d.BULAN === b);
                        if (item) {
                            dataMap[b] = {
                                numerator: item.TOTAL_NUMERATOR,
                                denumerator: item.TOTAL_DENUMERATOR,
                                target: item.target_num,
                                capaian: parseFloat(item.CAPAIAN_PERSEN).toFixed(2) + '%'
                            };
                            seriesData.push(parseFloat(item.CAPAIAN_PERSEN));
                        } else {
                            seriesData.push(0);
                        }
                    });

                    // Ambil 1 nilai target dari dataMap
                    const firstTarget = bulanUnik.find(b => dataMap[b]?.target);
                    const targetValue = firstTarget ? parseFloat(dataMap[firstTarget].target) : null;

                    // Tambahkan Card
                    container.append(`
                        <div class="col-xl-12">
                            <div class="card card-flush shadow-sm mb-5">
                                <div class="card-header border-0 d-flex flex-stack">
                                    <div class="card-title flex-column">
                                        <h6 class="fw-bolder mb-1">${i + 1}. ${namaIndikator} [${targetValue}%]</h6>
                                        <div class="fs-8 fw-bold text-gray-400">${definisi}</div>
                                    </div>
                                    <div class="card-toolbar">
                                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a id="tab_chart_${i}" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#tab_content_chart_${i}" aria-selected="true">Grafik</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a id="tab_table_${i}" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tab_content_table_${i}" aria-selected="false">Rencana Tindaklanjut</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content">
                                        <div id="tab_content_chart_${i}" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab_chart_${i}">
                                            <div id="${chartId}" style="height: 300px;"></div>
                                        </div>
                                        <div id="tab_content_table_${i}" class="tab-pane fade" role="tabpanel" aria-labelledby="tab_table_${i}">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-8 gy-2" id="${tableId}">
                                                    <thead class="bg-light">
                                                        <tr class="fw-bolder align-middle bg-primary text-white">
                                                            <th>Bulan</th>
                                                            <th>Numerator</th>
                                                            <th>Denumerator</th>
                                                            <th>Capaian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    // Render Chart
                    const chart = new ApexCharts(document.querySelector(`#${chartId}`), {
                        chart: {
                            type: 'area',
                            height: 300,
                            toolbar: { show: false },
                            fontFamily: "inherit"
                        },
                        stroke: { curve: 'smooth', width: 2 },
                        markers: { size: 4 },
                        series: [{
                            name: 'Capaian',
                            data: seriesData
                        }],
                        xaxis: {
                            categories: bulanUnik.map(b => {
                                const d = new Date(b + "-01");
                                return d.toLocaleString("id-ID", { month: "short", year: "2-digit" });
                            }),
                            title: { text: 'Periode Pelaporan' }
                        },
                        yaxis: {
                            title: { text: 'Capaian (%)' }
                        },
                        tooltip: {
                            y: { formatter: val => val.toFixed(2) + '%' }
                        },
                        annotations: {
                            yaxis: targetValue ? [{
                                y: targetValue,
                                borderColor: '#FF4560',
                                label: {
                                    borderColor: '#FF4560',
                                    style: { color: '#fff', background: '#FF4560' },
                                    text: 'Target: ' + targetValue.toFixed(2) + '%'
                                }
                            }] : []
                        }
                    });
                    chart.render();

                    // Render Table
                    const tbody = $(`#${tableId} tbody`).empty();
                    bulanUnik.forEach(b => {
                        const val = dataMap[b] || { numerator: '-', denumerator: '-', capaian: '-' };
                        tbody.append(`
                            <tr>
                                <td>${new Date(b + "-01").toLocaleString("id-ID", { month: "long", year: "numeric" })}</td>
                                <td>${val.numerator}</td>
                                <td>${val.denumerator}</td>
                                <td>${val.capaian}</td>
                            </tr>
                        `);
                    });
                });
            } else {
                $("#kontainerMutu").html(`<div class="text-center text-muted">Data tidak ditemukan.</div>`);
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

