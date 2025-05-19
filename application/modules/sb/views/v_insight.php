<?php
    function renderHospitalCard($nama, $bg, $idprefix, $totalid, $cardlabel) {
        $jenis = [
            'Umum'      => ['id' => 'umumlastday', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
            'Asuransi'  => ['id' => 'asuransilastday', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
            'BPJS'      => ['id' => 'bpjslastday', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
            'MCU'       => ['id' => 'mculastday', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
            'Obat'      => ['id' => 'obatlastday', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
            'Lain-lain' => ['id' => 'lainlastday', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
        ];
        ?>
        <div class="col-xl-3 animate__animated animate__fadeIn">
            <div class="card card-flush h-100 shadow-sm">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-275px w-100 <?php echo $bg; ?>">
                        <div class="d-flex flex-stack">
                            <h3 class="m-0 text-white fw-bolder fs-5"><?php echo $nama; ?></h3>
                            <h3 class="m-0 text-white fw-bolder fs-5" id="<?php echo $cardlabel.$idprefix; ?>"></h3>
                        </div>
                        <div class="d-flex text-center flex-column text-white pt-5">
                            <span class="fw-bold fs-5">You Balance</span>
                            <span class="fw-bolder fs-2x pt-1" id="<?php echo $totalid; ?>">NaN</span>
                        </div>
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-4 py-4 position-relative z-index-1" style="margin-top: -140px">
                        <?php foreach ($jenis as $label => $item): ?>
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label <?php echo $item['bg']; ?>">
                                        <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-7 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-7 text-gray-800 pe-1" id="<?php echo $idprefix . $item['id']; ?>">NaN</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    };

    $daftarRumahSakit = [
        'rmb'  => 'RMB Hospital Group',
        'rsms' => 'RS Mutiasari',
        'rsia' => 'RSIA Budhi Mulia',
        'rst'  => 'RS Thursina'
    ];

    $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $bulanSekarang = date('n');
?>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="card mb-3 mb-xxl-8">
        <div class="card-header card-header-stretch">
            <div class="card-title d-flex align-items-center">
                <h6 class="fw-bolder m-0 text-gray-800">Overview</h3>
            </div>
            <div class="card-toolbar m-0">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a id="tab_today" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabtoday">Last Day</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="tab_month" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabmonth">Month</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="tab_years" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabyears">Years</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body pt-9 pb-0">
            <div class="tab-content">
                <div id="tabtoday" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_today">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3 row">
                        <?php
                            renderHospitalCard("RMB Hospital Group", "bg-danger", "rmb", "totalrmblastday","lastdate");
                            renderHospitalCard("RSU Mutiasari", "bg-info", "rsms", "totalrsmslastday","lastdate");
                            renderHospitalCard("RSIA Budhi Mulia", "bg-primary", "rsia", "totalrsialastday","lastdate");
                            renderHospitalCard("RS Thursina", "bg-success", "rst", "totalrstlastday","lastdate");
                        ?>
                    </div>
                    <div class="d-flex overflow-auto h-55px">
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabrmb" id="tab_rmb">RMB Hospital Group</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsms" id="tab_rsms">RS Mutiasari</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsia" id="tab_rsia">RSIA Budhi Mulia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrst" id="tab_rst">RS Thursina</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="tabmonth" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_month">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3 row">
                        <?php
                            renderHospitalCard("RMB Hospital Group", "bg-danger", "rmb", "totalrmbmonth","lastmonth");
                            renderHospitalCard("RSU Mutiasari", "bg-info", "rsms", "totalrsmsmonth","lastmonth");
                            renderHospitalCard("RSIA Budhi Mulia", "bg-primary", "rsia", "totalrsiamonth","lastmonth");
                            renderHospitalCard("RS Thursina", "bg-success", "rst", "totalrstmonth","lastmonth");
                        ?>
                    </div>
                    <div class="d-flex overflow-auto h-55px">
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabrmb" id="tab_rmb">RMB Hospital Group</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsms" id="tab_rsms">RS Mutiasari</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsia" id="tab_rsia">RSIA Budhi Mulia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrst" id="tab_rst">RS Thursina</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="tabyears" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_years">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3 row">
                        <?php
                            renderHospitalCard("RMB Hospital Group", "bg-danger", "rmb", "totalrmbyears","lastyears");
                            renderHospitalCard("RSU Mutiasari", "bg-info", "rsms", "totalrsmsyears","lastyears");
                            renderHospitalCard("RSIA Budhi Mulia", "bg-primary", "rsia", "totalrsiayears","lastyears");
                            renderHospitalCard("RS Thursina", "bg-success", "rst", "totalrstyears","lastyears");
                        ?>
                    </div>
                    <div class="d-flex overflow-auto h-55px">
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabrmb" id="tab_rmb">RMB Hospital Group</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsms" id="tab_rsms">RS Mutiasari</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrsia" id="tab_rsia">RSIA Budhi Mulia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabrst" id="tab_rst">RS Thursina</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 mb-xxl-8">
        <div class="card-body pt-9 pb-0">

            <div class="alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade">
                <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                        <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"/>
                        <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"/>
                    </svg>
                </span>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1">For Your Information</h5>
                    <span>Silakan pilih bulan untuk pencarian rincian pendapatan</span>
                </div>
            </div>

            <div class="tab-content">
                <?php foreach ($daftarRumahSakit as $kode => $nama): ?>
                    <div id="tab<?= $kode ?>" class="card-body p-0 tab-pane fade<?= $kode === 'rmb' ? ' show active' : '' ?>" role="tabpanel" aria-labelledby="tab_<?= $kode ?>">
                        
                        <div class="d-flex overflow-auto h-55px">
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bolder flex-nowrap">
                                <?php foreach ($bulan as $index => $namaBulan): 
                                    $active = ($index + 1 == $bulanSekarang) ? 'active' : '';
                                    $tabId  = sprintf("#tabbln%s%02d", $kode, $index + 1);
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $active ?>" data-bs-toggle="tab" href="<?= $tabId ?>"><?= $namaBulan ?></a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>

                        <div class="tab-content pt-3">
                            <?php foreach ($bulan as $index => $namaBulan): 
                                $activeContent = ($index + 1 == $bulanSekarang) ? 'show active' : '';
                                $innerId = sprintf("tabbln%s%02d", $kode, $index + 1);
                                $resultId = sprintf("resultpendapatan%s%02d", $kode, $index + 1);
                            ?>
                                <div class="tab-pane fade <?= $activeContent ?>" id="<?= $innerId ?>">
                                    <div class="table-responsive">
                                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                                            <thead class="text-center">
                                                <tr class="fw-bolder align-middle">
                                                    <th class="bg-dark ps-4 rounded-start text-white" rowspan="3">Days</th>
                                                    <th class="bg-dark text-white" rowspan="3">Date</th>
                                                    <th class="bg-success text-white" colspan="4">Umum</th>
                                                    <th class="bg-primary text-white" colspan="4">Asuransi</th>
                                                    <th class="bg-info text-white" colspan="6">BPJS</th>
                                                    <th class="bg-danger text-white" colspan="4">MCU</th>
                                                    <th class="bg-warning text-white" colspan="2">POB</th>
                                                    <th class="bg-secondary rounded-end" colspan="2">Lain-lain</th>
                                                </tr>
                                                <tr class="fw-bolder align-middle">
                                                    <th class="bg-success text-white" colspan="2">Rajal</th>
                                                    <th class="bg-success text-white" colspan="2">Ranap</th>
                                                    <th class="bg-primary text-white" colspan="2">Rajal</th>
                                                    <th class="bg-primary text-white" colspan="2">Ranap</th>
                                                    <th class="bg-info text-white" colspan="3">Rajal</th>
                                                    <th class="bg-info text-white" colspan="3">Ranap</th>
                                                    <th class="bg-danger text-white" rowspan="2">Cash</th>
                                                    <th class="bg-danger text-white" rowspan="2">Invoice</th>
                                                    <th class="bg-danger text-white" rowspan="2">Total</th>
                                                    <th class="bg-danger text-white" rowspan="2">Sistem</th>
                                                    <th class="bg-warning text-white" rowspan="2">Manual</th>
                                                    <th class="bg-warning text-white" rowspan="2">Sistem</th>
                                                    <th class="bg-secondary" rowspan="2">Manual</th>
                                                    <th class="bg-secondary rounded-end" rowspan="2">Sistem</th>
                                                </tr>
                                                <tr class="fw-bolder align-middle text-white">
                                                    <th class="bg-success">Manual</th>
                                                    <th class="bg-success">Sistem</th>
                                                    <th class="bg-success">Manual</th>
                                                    <th class="bg-success">Sistem</th>
                                                    <th class="bg-primary">Manual</th>
                                                    <th class="bg-primary">Sistem</th>
                                                    <th class="bg-primary">Manual</th>
                                                    <th class="bg-primary">Sistem</th>
                                                    <th class="bg-info">Manual</th>
                                                    <th class="bg-info">Sistem</th>
                                                    <th class="bg-info">InaCBG</th>
                                                    <th class="bg-info">Manual</th>
                                                    <th class="bg-info">Sistem</th>
                                                    <th class="bg-info">InaCBG</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-bold" id="<?= $resultId ?>"></tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>