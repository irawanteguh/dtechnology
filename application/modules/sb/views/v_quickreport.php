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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln02" role="tabpanel">
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body p-0">
                        <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                            <div class="d-flex flex-stack">
                                <h3 class="m-0 text-white fw-bolder fs-3">Income Summary</h3>
                            </div>
                            <div class="d-flex text-center flex-column text-white pt-8">
                                <span class="fw-bold fs-7">You Balance</span>
                                <span class="fw-bolder fs-2x pt-1" id="total02">n/a</span>
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
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1" id="umum02">n/a</div>
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
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1" id="asuransi02">n/a</div>
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
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1" id="bpjs02">n/a</div>
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
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1" id="lain02">n/a</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
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
                                        <th rowspan="2" >Date</th>
                                        <th colspan="2">Umum</th>
                                        <th colspan="2">Asuransi</th>
                                        <th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
            
        </div>
        <div class="tab-pane fade" id="tabbln03" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln04" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln05" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln06" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln07" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln08" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln09" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln10" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln11" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
        <div class="tab-pane fade" id="tabbln12" role="tabpanel">
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
                                    <th rowspan="2" >Date</th>
                                    <th colspan="2">Umum</th>
                                    <th colspan="2">Asuransi</th>
                                    <th colspan="2">BPJS</th>
                                    <th rowspan="2">Lain-lain</th>
                                    <th colspan="2">Total Harian</th>
                                    <th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
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
    </div>
</div>

<!-- <div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Income Report</span>
					<span class="text-muted mt-1 fw-bold fs-7">Daily Income Report</span>
				</h3>
				<div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                </g>
                            </svg>
                        </span>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Add Document</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_sign_add" class="menu-link px-3">Sign Document</a>
                        </div>
                    </div>
                </div>
			</div>
			<div class="card-body py-3">
				<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
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

				<div class="tab-content">
                    <div class="tab-pane fade show active" id="tabbln01" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln01"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln02" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln02"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln03" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln03"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln04" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln04"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln05" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln05"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln06" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln06"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln07" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln07"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln08" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln08"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln09" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln09"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln10" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln10"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln11" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln11"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabbln12" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-6 gy-2">
								<thead class="text-center">
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th rowspan="2" class="ps-4 rounded-start">Days</th>
										<th rowspan="2" >Date</th>
										<th colspan="2">Umum</th>
										<th colspan="2">Asuransi</th>
										<th colspan="2">BPJS</th>
                                        <th rowspan="2">Lain-lain</th>
                                        <th colspan="2">Total Harian</th>
										<th rowspan="2" class="pe-4 text-end rounded-end">Grand Total</th>
									</tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                        <th>Rajal</th>
                                        <th>Inap</th>
                                    </tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultbln12"></tbody>
							</table>
						</div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div> -->
