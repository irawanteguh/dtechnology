<div class="card mb-5 mb-xxl-8">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            
        </div>
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <?php
                $bulan = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];
                $bulanSekarang = date('n'); // 1 = Januari, 12 = Desember

                foreach ($bulan as $index => $namaBulan) {
                    $active = ($index + 1 == $bulanSekarang) ? 'active' : '';
                    $tabId = sprintf("#tabbln%02d", $index + 1); // Format tabbln01, tabbln02, dst
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link ' . $active . '" data-bs-toggle="tab" href="' . $tabId . '">' . $namaBulan . '</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="tab-content">
        <?php
            $bulan = [
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
            ];

            $currentMonth = date('m');
            
            foreach ($bulan as $kode => $nama) {
                $active = $kode == $currentMonth ? 'show active' : '';
            ?>

            <div class="tab-pane fade <?php echo $active; ?>" id="tabbln<?php echo $kode; ?>" role="tabpanel">
                <div class="card card card-flush h-100">
                    <div class="card-header">
                        <div class="card-title d-flex align-items-center">
                            <h6 class="fw-bolder m-0 text-gray-800">Quick Report Bulan <?php echo $nama; ?></h3>
                        </div>
                        <div class="card-toolbar m-0">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                <!-- <li class="nav-item" role="presentation">
                                    <a id="tab_target<?php echo $kode; ?>" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabtarget<?php echo $kode; ?>">Target</a>
                                </li> -->
                                <li class="nav-item" role="presentation">
                                    <a id="tab_kunjungan<?php echo $kode; ?>" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabkunjungan<?php echo $kode; ?>">Kunjungan</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="tab_pendapatan<?php echo $kode; ?>" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabpendapatan<?php echo $kode; ?>">Pendapatan</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="tab_pengeluaran<?php echo $kode; ?>" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabpengeluaran<?php echo $kode; ?>">Pengeluaran</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- <div id="tabtarget<?php echo $kode; ?>" class="card-body p-0 tab-pane fade " role="tabpanel" aria-labelledby="tab_target<?php echo $kode; ?>">
                                
                            </div> -->
                            <div id="tabkunjungan<?php echo $kode; ?>" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_kunjungan<?php echo $kode; ?>">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                            <div class="card-body d-flex flex-column p-0" style="position: relative;">
                                                <div class="flex-grow-1 card-p pb-0">
                                                    <div class="d-flex flex-stack flex-wrap">
                                                        <div class="me-2">
                                                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-5">
                                                                General Patient Visit Trends
                                                            </a>
                                                            <div class="text-muted fs-7 fw-bold">
                                                                Trends in general patient visits to support service insights.
                                                            </div>
                                                        </div>
                                                        <div class="fw-bolder fs-3 text-primary" id="totalkunjunganumum<?php echo $kode; ?>">NaN</div>
                                                    </div>
                                                    <div class="card-rounded-bottom" id="kunjunganumum<?php echo $kode; ?>" style="height: 150px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                            <div class="card-body d-flex flex-column p-0" style="position: relative;">
                                                <div class="flex-grow-1 card-p pb-0">
                                                    <div class="d-flex flex-stack flex-wrap">
                                                        <div class="me-2">
                                                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-5">
                                                                Insurance Patient Visit Trends
                                                            </a>
                                                            <div class="text-muted fs-7 fw-bold">
                                                                Monthly statistics of private and corporate insured patient visits.
                                                            </div>
                                                        </div>
                                                        <div class="fw-bolder fs-3 text-primary" id="totalkunjunganasuransi<?php echo $kode; ?>">NaN</div>
                                                    </div>
                                                    <div class="card-rounded-bottom" id="kunjunganasuransi<?php echo $kode; ?>" style="height: 150px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                            <div class="card-body d-flex flex-column p-0" style="position: relative;">
                                                <div class="flex-grow-1 card-p pb-0">
                                                    <div class="d-flex flex-stack flex-wrap">
                                                        <div class="me-2">
                                                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-5">
                                                                BPJS Patient Visit Trends
                                                            </a>
                                                            <div class="text-muted fs-7 fw-bold">
                                                                Monthly report of visits by JKN/BPJS Kesehatan participants, both outpatients and inpatients.
                                                            </div>
                                                        </div>
                                                        <div class="fw-bolder fs-3 text-primary" id="totalkunjunganbpjs<?php echo $kode; ?>">NaN</div>
                                                    </div>
                                                    <div class="card-rounded-bottom" id="kunjunganbpjs<?php echo $kode; ?>" style="height: 150px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="card card-xl-stretch mb-xl-8 shadow-sm">
                                            <div class="card-body d-flex flex-column p-0" style="position: relative;">
                                                <div class="flex-grow-1 card-p pb-0">
                                                    <div class="d-flex flex-stack flex-wrap">
                                                        <div class="me-2">
                                                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-5">
                                                                Medical Check Up Patient Visit Trends
                                                            </a>
                                                            <div class="text-muted fs-7 fw-bold">
                                                                Tracks how many patients come for medical check-ups each month.
                                                            </div>
                                                        </div>
                                                        <div class="fw-bolder fs-3 text-primary" id="totalkunjunganmcu<?php echo $kode; ?>">NaN</div>
                                                    </div>
                                                    <div class="card-rounded-bottom" id="kunjunganmcu<?php echo $kode; ?>" style="height: 150px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-2">
                                            <thead class="text-center">
                                                <tr class="fw-bolder text-muted bg-light align-middle">
                                                    <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                                    <th rowspan="2">Date</th>
                                                    <th colspan="2">Umum</th>
                                                    <th colspan="2">Asuransi</th>
                                                    <th colspan="2">BPJS</th>
                                                    <th colspan="2">MCU</th>
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
                                                    <th>Cash</th>
                                                    <th>Invoice</th>
                                                    <th>Rajal</th>
                                                    <th>Ranap</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold" id="resultkunjungan<?php echo $kode; ?>"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tabpendapatan<?php echo $kode; ?>" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_pendapatan<?php echo $kode; ?>">
                                <div class="row mb-5">
                                    <div class="col-xl-3">
                                        <div class="card card-flush h-100 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                                    <div class="d-flex flex-stack">
                                                        <h3 class="m-0 text-white fw-bolder fs-5">Income Summary</h3>
                                                    </div>
                                                    <div class="d-flex text-center flex-column text-white pt-5">
                                                        <span class="fw-bold fs-5">You Balance</span>
                                                        <span class="fw-bolder fs-2x pt-1" id="total<?php echo $kode; ?>">NaN</span>
                                                    </div>
                                                </div>
                                                <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                                                    <?php
                                                        $jenis = ['Umum' => 'umum', 'Asuransi' => 'asuransi', 'BPJS' => 'bpjs', 'MCU' => 'mcu', 'Obat' => 'obat', 'Lain-lain' => 'lain'];
                                                        foreach ($jenis as $label => $id) {
                                                    ?>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="symbol symbol-45px w-40px me-5">
                                                                <span class="symbol-label bg-lighten">
                                                                    <i class="bi bi-circle-fill fa-2x"></i>
                                                                </span>
                                                            </div>
                                                            <div class="d-flex align-items-center flex-wrap w-100">
                                                                <div class="mb-1 pe-3 flex-grow-1">
                                                                    <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="fw-bolder fs-5 text-gray-800 pe-1" id="<?php echo $id . $kode; ?>">NaN</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="card card-flush h-100 shadow-sm">
                                            <div class="card-header border-0 py-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bolder fs-5 mb-1">Income Base On Group</span>
                                                    <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pemasukan</span>
                                                </h3>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <div id="chartprovidergroup<?php echo $kode; ?>" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card card-flush h-100 shadow-sm">
                                            <div class="card-header border-0 py-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bolder fs-5 mb-1">Income Detail</span>
                                                    <span class="text-muted fw-bold fs-7">Visualisasi distribusi pemasukan dari berbagai kelompok pelayanan</span>
                                                </h3>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <div id="chartproviderdetail<?php echo $kode; ?>" style="width: 100%; max-height: 350px; height: 100vh;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-5">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-6 gy-2">
                                            <thead class="text-center">
                                                <tr class="fw-bolder text-muted bg-light align-middle">
                                                    <th rowspan="2" class="ps-4 rounded-start">Days</th>
                                                    <th rowspan="2">Date</th>
                                                    <th colspan="2">Umum</th>
                                                    <th colspan="2">Asuransi</th>
                                                    <th colspan="2">BPJS</th>
                                                    <th colspan="2">MCU</th>
                                                    <th rowspan="2">POB</th>
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
                                                    <th>Cash</th>
                                                    <th>Invoice</th>
                                                    <th>Rajal</th>
                                                    <th>Ranap</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold" id="resultbln<?php echo $kode; ?>"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tabpengeluaran<?php echo $kode; ?>" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_pengeluaran<?php echo $kode; ?>">
                                <div class="row">
                                    <div class="col-xl-7 mb-5">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                                <thead class="text-center">
                                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                                        <th colspan="2" class="ps-4 rounded-start">Kode COA</th>
                                                        <th>Nama Akun</th>
                                                        <th>Total</th>
                                                        <th class="pe-4 text-end rounded-end">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold" id="resultcoadata<?php echo $kode; ?>"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 mb-5">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                                <thead class="text-center">
                                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                                        <th class="ps-4 rounded-start">Date</th>
                                                        <th>Nama Akun</th>
                                                        <th class="pe-4 text-end rounded-end">Debit</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 fw-bold" id="resultjurnal<?php echo $kode; ?>"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
