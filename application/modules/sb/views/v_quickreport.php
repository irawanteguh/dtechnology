<div class="card mb-5 mb-xxl-8">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            
        </div>
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabbln01">Januari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln02">Febuari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln03">Maret</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln04">April</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln05">Mei</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln06">Juni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln07">Juli</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln08">Agustus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln09">September</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln10">Oktober</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln11">November</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabbln12">Desember</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tabbln01" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum01">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum01" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi01">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi01" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs01">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs01" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total01">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum01">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi01">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs01">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain01">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup01" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail01" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln01"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan01"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln02" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum02">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum02" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi02">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi02" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs02">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs02" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total02">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum02">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi02">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs02">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain02">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup02" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail02" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln02"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan02"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln03" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum03">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum03" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi03">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi03" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs03">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs03" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total03">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum03">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi03">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs03">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain03">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup03" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail03" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln03"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan03"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln04" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum04">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum04" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi04">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi04" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs04">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs04" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total04">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum04">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi04">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs04">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain04">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup04" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail04" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln04"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan04"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln05" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum05">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum05" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi05">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi05" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs05">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs05" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total05">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum05">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi05">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs05">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain05">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup05" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail05" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln05"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan05"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln06" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum06">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum06" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi06">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi06" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs06">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs06" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total06">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum06">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi06">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs06">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain06">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup06" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail06" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln06"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan06"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln07" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum07">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum07" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi07">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi07" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs07">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs07" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total07">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum07">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi07">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs07">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain07">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup07" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail07" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln07"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan07"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln08" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum08">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum08" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi08">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi08" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs08">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs08" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total08">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum08">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi08">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs08">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain08">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup08" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail08" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln08"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan08"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln09" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum09">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum09" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi09">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi09" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs09">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs09" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total09">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum09">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi09">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs09">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain09">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup09" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail09" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln09"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan09"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln10" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum10">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum10" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi10">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi10" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs10">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs10" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total10">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum10">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi10">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs10">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain10">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup10" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail10" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln10"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan10"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln11" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum11">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum11" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi11">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi11" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs11">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs11" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total11">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum11">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi11">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs11">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain11">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup11" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail11" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln11"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan11"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tabbln12" role="tabpanel">
            <div class="row mb-5">
                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Umum
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Rekapitulasi kunjungan pasien tanpa jaminan, termasuk rawat jalan dan rawat inap selama 1 bulan.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum12">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganumum12" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien Asuransi
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Statistik bulanan kunjungan pasien dengan penjamin asuransi swasta dan perusahaan (non-BPJS).
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi12">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganasuransi12" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card card-xl-stretch mb-xl-8">
                        <div class="card-body d-flex flex-column p-0" style="position: relative;">
                            <div class="flex-grow-1 card-p pb-0">
                                <div class="d-flex flex-stack flex-wrap">
                                    <div class="me-2">
                                        <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                            Kunjungan Pasien BPJS
                                        </a>
                                        <div class="text-muted fs-7 fw-bold">
                                            Laporan bulanan kunjungan pasien peserta JKN/BPJS Kesehatan baik rawat jalan maupun rawat inap.
                                        </div>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs12">NaN</div>
                                </div>
                                <div class="card-rounded-bottom" id="kunjunganbpjs12" style="height: 150px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="total12">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-cash fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Umum</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum12">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <span class="svg-icon svg-icon-1">
                                                <i class="bi bi-file-earmark-medical fa-2x"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Asuransi</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi12">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-6">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-journal-medical fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">BPJS</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs12">NaN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-45px w-40px me-5">
                                        <span class="symbol-label bg-lighten">
                                            <i class="bi bi-file-earmark-font fa-2x"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap w-100">
                                        <div class="mb-1 pe-3 flex-grow-1">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Lain-lain</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain12">NaN</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Base On Group</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartprovidergroup12" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Income Detail</span>
                                <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div id="chartproviderdetail12" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Pendapatan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbln12"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-100">
                    <div class="card-header align-items-center border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-muted">Detail Laporan Kunjungan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                        <th rowspan="2">Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2">Grand Total</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                        <th>Rajal</th>
                                        <th>Ranap</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultkunjungan12"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
