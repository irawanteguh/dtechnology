

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3 row">
                <div class="col-xl-3">
                    <div class="card card-flush h-100 shadow-sm">
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-danger">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-5">RMB Hospital Group</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-5">
                                    <span class="fw-bold fs-5">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="totalrmb">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                                <?php
                                    $jenis = [
                                        'Umum' => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                        'Asuransi' => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                        'BPJS' => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                        'MCU' => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                        'Obat' => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                        'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
                                    ];
                                    foreach ($jenis as $label => $item) {
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-45px w-40px me-5">
                                            <span class="symbol-label <?php echo $item['bg']; ?>">
                                                <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap w-100">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="fw-bolder fs-5 text-gray-800 pe-1" id="rmb<?php echo $item['id']; ?>">NaN</div>
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
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-info">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-5">RSU Mutiasari</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-5">
                                    <span class="fw-bold fs-5">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="totalrsms">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                                <?php
                                    $jenis = [
                                        'Umum' => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                        'Asuransi' => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                        'BPJS' => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                        'MCU' => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                        'Obat' => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                        'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
                                    ];
                                    foreach ($jenis as $label => $item) {
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-45px w-40px me-5">
                                            <span class="symbol-label <?php echo $item['bg']; ?>">
                                                <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap w-100">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="fw-bolder fs-5 text-gray-800 pe-1" id="rsms<?php echo $item['id']; ?>">NaN</div>
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
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-primary">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-5">RSIA Budhi Mulia</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-5">
                                    <span class="fw-bold fs-5">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="totalrsia">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                                <?php
                                    $jenis = [
                                        'Umum' => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                        'Asuransi' => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                        'BPJS' => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                        'MCU' => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                        'Obat' => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                        'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
                                    ];
                                    foreach ($jenis as $label => $item) {
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-45px w-40px me-5">
                                            <span class="symbol-label <?php echo $item['bg']; ?>">
                                                <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap w-100">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="fw-bolder fs-5 text-gray-800 pe-1" id="rsia<?php echo $item['id']; ?>">NaN</div>
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
                        <div class="card-body p-0">
                            <div class="px-9 pt-7 card-rounded h-275px w-100 bg-success">
                                <div class="d-flex flex-stack">
                                    <h3 class="m-0 text-white fw-bolder fs-5">RS Thursina</h3>
                                </div>
                                <div class="d-flex text-center flex-column text-white pt-5">
                                    <span class="fw-bold fs-5">You Balance</span>
                                    <span class="fw-bolder fs-2x pt-1" id="totalrst">NaN</span>
                                </div>
                            </div>
                            <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                                <?php
                                    $jenis = [
                                        'Umum' => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                        'Asuransi' => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                        'BPJS' => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                        'MCU' => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                        'Obat' => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                        'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
                                    ];
                                    foreach ($jenis as $label => $item) {
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-45px w-40px me-5">
                                            <span class="symbol-label <?php echo $item['bg']; ?>">
                                                <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap w-100">
                                            <div class="mb-1 pe-3 flex-grow-1">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="fw-bolder fs-5 text-gray-800 pe-1" id="rst<?php echo $item['id']; ?>">NaN</div>
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
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabcompare" id="tab_compare">Compare</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabgrafik" id="tab_grafik">Visual</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content p-0">
        <div id="tabcompare" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_compare">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center">
                        <h6 class="fw-bolder m-0 text-gray-800">Summary Quick Report</h3>
                    </div>
                    <div class="card-toolbar m-0">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a id="tab_rsms" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabrsms">RSU Mutiasari</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="tab_rsiabm" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabrsiabm">RSIA Budhi Mulia</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="tab_thursina" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabthursina">RS Thursina</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-9 pb-0">
                    <div class="tab-content">
                        <div id="tabrsms" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_rsms">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        
                            </div>
                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <?php
                                        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                        $bulanSekarang = date('n');

                                        foreach ($bulan as $index => $namaBulan) {
                                            $active = ($index + 1 == $bulanSekarang) ? 'active' : '';
                                            $tabId = sprintf("#tabblnrsms%02d", $index + 1);

                                            echo '<li class="nav-item">';
                                            echo '<a class="nav-link ' . $active . '" data-bs-toggle="tab" href="' . $tabId . '">' . $namaBulan . '</a>';
                                            echo '</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="mb-3 mt-5">
                                <div class="tab-content">
                                    <?php
                                        $bulan        = ['01' => 'Januari', '02' => 'Februari', '03' => 'Maret','04' => 'April', '05' => 'Mei', '06' => 'Juni','07' => 'Juli', '08' => 'Agustus', '09' => 'September','10' => 'Oktober', '11' => 'November', '12' => 'Desember'];
                                        $currentMonth = date('m');
                                        
                                        foreach ($bulan as $kode => $nama) {
                                            $active = $kode == $currentMonth ? 'show active' : '';
                                        ?>

                                        <div class="tab-pane fade <?php echo $active; ?>" id="tabblnrsms<?php echo $kode; ?>" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-2">
                                                    <thead class="text-center">
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th rowspan="3" class="ps-4 rounded-start">Days</th>
                                                            <th rowspan="3">Date</th>
                                                            <th colspan="4">Umum</th>
                                                            <th colspan="4">Asuransi</th>
                                                            <th colspan="4">BPJS</th>
                                                            <th colspan="4" class="rounded-end">MCU</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Cash</th>
                                                            <th colspan="2">Invoice</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th class="rounded-end">Sistem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="resultkunjunganrsms<?php echo $kode; ?>"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="tabrsiabm" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_rsiabm">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        
                            </div>
                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <?php
                                        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                        $bulanSekarang = date('n');

                                        foreach ($bulan as $index => $namaBulan) {
                                            $active = ($index + 1 == $bulanSekarang) ? 'active' : '';
                                            $tabId = sprintf("#tabblnrsia%02d", $index + 1);

                                            echo '<li class="nav-item">';
                                            echo '<a class="nav-link ' . $active . '" data-bs-toggle="tab" href="' . $tabId . '">' . $namaBulan . '</a>';
                                            echo '</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="mb-3 mt-5">
                                <div class="tab-content">
                                    <?php
                                        $bulan        = ['01' => 'Januari', '02' => 'Februari', '03' => 'Maret','04' => 'April', '05' => 'Mei', '06' => 'Juni','07' => 'Juli', '08' => 'Agustus', '09' => 'September','10' => 'Oktober', '11' => 'November', '12' => 'Desember'];
                                        $currentMonth = date('m');
                                        
                                        foreach ($bulan as $kode => $nama) {
                                            $active = $kode == $currentMonth ? 'show active' : '';
                                        ?>

                                        <div class="tab-pane fade <?php echo $active; ?>" id="tabblnrsia<?php echo $kode; ?>" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-2">
                                                    <thead class="text-center">
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th rowspan="3" class="ps-4 rounded-start">Days</th>
                                                            <th rowspan="3">Date</th>
                                                            <th colspan="4">Umum</th>
                                                            <th colspan="4">Asuransi</th>
                                                            <th colspan="4">BPJS</th>
                                                            <th colspan="4" class="rounded-end">MCU</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Cash</th>
                                                            <th colspan="2">Invoice</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th class="rounded-end">Sistem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="resultkunjunganrsia<?php echo $kode; ?>"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div id="tabthursina" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_thursina">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        
                            </div>
                            <div class="d-flex overflow-auto h-55px">
                                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                                    <?php
                                        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                        $bulanSekarang = date('n');

                                        foreach ($bulan as $index => $namaBulan) {
                                            $active = ($index + 1 == $bulanSekarang) ? 'active' : '';
                                            $tabId = sprintf("#tabblnrst%02d", $index + 1);

                                            echo '<li class="nav-item">';
                                            echo '<a class="nav-link ' . $active . '" data-bs-toggle="tab" href="' . $tabId . '">' . $namaBulan . '</a>';
                                            echo '</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="mb-3 mt-5">
                                <div class="tab-content">
                                    <?php
                                        $bulan        = ['01' => 'Januari', '02' => 'Februari', '03' => 'Maret','04' => 'April', '05' => 'Mei', '06' => 'Juni','07' => 'Juli', '08' => 'Agustus', '09' => 'September','10' => 'Oktober', '11' => 'November', '12' => 'Desember'];
                                        $currentMonth = date('m');
                                        
                                        foreach ($bulan as $kode => $nama) {
                                            $active = $kode == $currentMonth ? 'show active' : '';
                                        ?>

                                        <div class="tab-pane fade <?php echo $active; ?>" id="tabblnrst<?php echo $kode; ?>" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-row-dashed fs-6 gy-2">
                                                    <thead class="text-center">
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th rowspan="3" class="ps-4 rounded-start">Days</th>
                                                            <th rowspan="3">Date</th>
                                                            <th colspan="4">Umum</th>
                                                            <th colspan="4">Asuransi</th>
                                                            <th colspan="4">BPJS</th>
                                                            <th colspan="4" class="rounded-end">MCU</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Rajal</th>
                                                            <th colspan="2">Ranap</th>
                                                            <th colspan="2">Cash</th>
                                                            <th colspan="2">Invoice</th>
                                                        </tr>
                                                        <tr class="fw-bolder text-muted bg-light align-middle">
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th>Sistem</th>
                                                            <th>Manual</th>
                                                            <th class="rounded-end">Sistem</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 fw-bold" id="resultkunjunganrst<?php echo $kode; ?>"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabgrafik" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_grafik">
            <div class="row gy-5">
                <div class="col-xl-12">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Analysis of Hospital Targets and Achievements This Year</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_rsms" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabrsms">RSU Mutiasari</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_rsiabm" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabrsiabm">RSIA Budhi Mulia</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_thursina" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabthursina">RS Thursina</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabrsms" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_rsms">
                                    <div class="card-rounded-bottom" id="grafiktargetrsms" style="height: 300px"></div>
                                </div>
                                <div id="tabrsiabm" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="tab_rsiabm">
                                    <div class="card-rounded-bottom" id="grafiktargetrsiabm" style="height: 300px"></div>
                                </div>
                                <div id="tabthursina" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="item">
                                    <div class="card-rounded-bottom" id="grafiktargetrst" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Key Hospital Statistics (Last 12 Months)</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_expend" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabexpend">Expend</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_balance" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabbalance">Balance</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit">Patient Visits</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabincome" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income">
                                    <div class="card-rounded-bottom" id="grafikPendapatanRS" style="height: 300px"></div>
                                </div>
                                <div id="tabexpend" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="tab_income">
                                    <div class="card-rounded-bottom" id="grafikPengeluranRS" style="height: 300px"></div>
                                </div>
                                <div id="tabbalance" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="tab_balance">
                                    <div class="card-rounded-bottom" id="grafikBalanceRS" style="height: 300px"></div>
                                </div>
                                <div id="tabvisit" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_visit">
                                    <div class="card-rounded-bottom" id="grafikKunjunganRS" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card flex-fill mb-5">
                        <div class="card-body pt-5">
                            <div id="kt_income_summary_carousel" class="carousel slide carousel-custom carousel-stretch" data-bs-ride="carousel" data-bs-interval="5000">
                                <div class="d-flex flex-stack align-items-center flex-wrap">
                                    <h4 class="text-gray-400 fw-bold mb-0">Income Summary</h4>
                                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                        <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="0" class="ms-1 active" aria-current="true"></li>
                                        <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="1" class="ms-1"></li>
                                        <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="2" class="ms-1"></li>
                                        <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="3" class="ms-1"></li>
                                    </ol>
                                </div>
                                <div class="carousel-inner pt-6">
                                    <div class="carousel-item active">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">Total Revenue This Year</h5>
                                            <p id="carousel-total-all" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">RSU Mutiasari Performance</h5>
                                            <p id="carousel-total-rsms" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">RSIA Budhi Mulia Performance</h5>
                                            <p id="carousel-total-rsiabm" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">RS Thursina Performance</h5>
                                            <p id="carousel-total-rst" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card flex-fill d-flex flex-column">
                        <div class="card-body flex-grow-1 pt-5">
                            <div id="kt_visits_guidelines" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-interval="5000">
                                <div class="d-flex flex-stack align-items-center flex-wrap">
                                    <h4 class="text-gray-400 fw-bold mb-0 pe-2">Patient Visits</h4>
                                    <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                        <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="0" class="ms-1 active"></li>
                                        <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="1" class="ms-1" aria-current="true"></li>
                                        <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="2" class="ms-1"></li>
                                        <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="3" class="ms-1"></li>
                                    </ol>
                                </div>
                                <div class="carousel-inner pt-6">
                                    <div class="carousel-item active">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">Total Patient Visits This Year</h5>
                                            <p id="carousel-total-all-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">Patient Visits RSU Mutiasari</h5>
                                            <p id="carousel-total-rsms-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">Patient Visits RSIA Budhi Mulia</h5>
                                            <p id="carousel-total-rsiabm-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="d-flex flex-column">
                                            <h5 class="text-dark fw-bolder">Patient Visits RS Thursina</h5>
                                            <p id="carousel-total-rst-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Distribusi Pendapatan dan Kunjungan</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_summary" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabsummary">Summary</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_detailpendapatan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailpendapat">Presentasi Pendapatan</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_detailkunjungan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailkunjungan">Presentasi Kunjungan</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabsummary" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_summary">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="card-rounded-bottom" id="grafikDistribusiProvider" style="height: 250px"></div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="card-rounded-bottom" id="grafikDistribusiProviderkunjungan" style="height: 250px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabdetailpendapat" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_detailpendapatan">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasipendapatanrms" style="height: 345px"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasipendapatanrsiabm" style="height: 345px"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasipendapatanrst" style="height: 345px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabdetailkunjungan" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_detailkunjungan">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasikunjunganrms" style="height: 345px"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasikunjunganrsiabm" style="height: 345px"></div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card-rounded-bottom" id="grafikpresentasikunjunganrst" style="height: 345px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Pasien Umum</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income_umum" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_umum">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit_umum" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_umum">Patient Visits</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabincome_umum" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_umum">
                                    <div class="card-rounded-bottom" id="grafikPendapatanUmum" style="height: 250px"></div>
                                </div>
                                <div id="tabvisit_umum" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_umum">
                                    <div class="card-rounded-bottom" id="grafikKunjunganUmum" style="height: 250px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Pasien Asuransi</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income_asuransi" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_asuransi">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit_asuransi" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_asuransi">Patient Visits</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabincome_asuransi" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_asuransi">
                                    <div class="card-rounded-bottom" id="grafikPendapatanAsuransi" style="height: 250px"></div>
                                </div>
                                <div id="tabvisit_asuransi" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_asuransi">
                                    <div class="card-rounded-bottom" id="grafikKunjunganAsuransi" style="height: 250px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Pasien BPJS</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income_bpjs" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_bpjs">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit_bpjs" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_bpjs">Patient Visits</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabincome_bpjs" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_bpjs">
                                    <div class="card-rounded-bottom" id="grafikPendapatanBPJS" style="height: 250px"></div>
                                </div>
                                <div id="tabvisit_bpjs" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_bpjs">
                                    <div class="card-rounded-bottom" id="grafikKunjunganBPJS" style="height: 250px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Pasien Medical Check Up</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income_mcu" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_mcu">Income</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit_mcu" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_mcu">Patient Visits</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabincome_mcu" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_mcu">
                                    <div class="card-rounded-bottom" id="grafikPendapatanMCU" style="height: 250px"></div>
                                </div>
                                <div id="tabvisit_mcu" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_mcu">
                                    <div class="card-rounded-bottom" id="grafikKunjunganMCU" style="height: 250px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title d-flex align-items-center">
                                <h6 class="fw-bolder m-0 text-gray-800">Lain-lain</h3>
                            </div>
                            <div class="card-toolbar m-0">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_visit_lain" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabvisit_lain">POB</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="tab_income_lain" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabincome_lain">Kerjasama</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div id="tabvisit_lain" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_lain">
                                    <div class="card-rounded-bottom" id="grafikPendapatanPOB" style="height: 250px"></div>
                                </div>
                                <div id="tabincome_lain" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_income_lain">
                                    <div class="card-rounded-bottom" id="grafikPendapatanLain" style="height: 250px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
