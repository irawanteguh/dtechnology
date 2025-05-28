<?php
function rendertabbulan($orgid) {
    $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $bulanSekarang = date('n');
    ?>
    <div class="d-flex overflow-auto min-h-40px">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bolder flex-nowrap">
            <?php foreach ($bulan as $index => $namaBulan): 
                $bulanKe = $index + 1;
                $active  = ($bulanKe == $bulanSekarang) ? 'active' : '';
                $tabId   = "#tabbln{$orgid}{$bulanKe}";
            ?>
                <li class="nav-item">
                    <a class="nav-link <?= $active ?>" data-bs-toggle="tab" href="<?= $tabId ?>" style="color:#fff;">
                        <?= $namaBulan ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>

<!-- UI Container -->
<div class="row gy-5 g-xl-8 mb-xl-3 border">
    <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
         style="background-color: #663259; background-size: auto 100%; background-image: url('<?= base_url(); ?>assets/images/svg/misc/taieri.svg')">
        <div class="card-body pt-9 pb-0">

            <!-- Judul dan Deskripsi -->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                <div>
                    <h1 class="text-white">Detail Laporan Pendapatan</h1>
                    <p class="text-white mb-5">
                        Insight data real-time untuk memantau kinerja dan layanan rumah sakit dalam grup RMB.
                    </p>
                </div>
            </div>

            <!-- Tab Rumah Sakit -->
            <div class="d-flex overflow-auto min-h-30px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabrmb" id="tab_rmb" style="color:#fff;">RMB Hospital Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrsms" id="tab_rsms" style="color:#fff;">RSU Mutiasari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrsiabm" id="tab_rsiabm" style="color:#fff;">RSIA Budhi Mulia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrst" id="tab_rst" style="color:#fff;">RS Thursina</a>
                    </li>
                </ul>
            </div>

            <!-- Tab Bulanan Per RS -->
            <div class="d-flex overflow-auto min-h-40px">
                <div class="tab-content p-0">
                    <div id="tabrmb" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_rmb">
                        <?php rendertabbulan("rmb"); ?>
                    </div>
                    <div id="tabrsms" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_rsms">
                        <?php rendertabbulan("rsms"); ?>
                    </div>
                    <div id="tabrsiabm" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_rsiabm">
                        <?php rendertabbulan("rsiabm"); ?>
                    </div>
                    <div id="tabrst" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_rst">
                        <?php rendertabbulan("rst"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="tab-content p-0">

        <?php
        $orgs          = ['rmb' => 'RMB Hospital Group', 'rsms' => 'RSU Mutiasari', 'rsiabm' => 'RSIA Budhi Mulia', 'rst' => 'RS Thursina'];
        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulanSekarang = date('n');

        foreach ($orgs as $orgid => $namaRs) {
            for ($i = 1; $i <= 12; $i++) {
                $active = ($i == $bulanSekarang && $orgid == 'rmb') ? 'show active' : '';
                $tabId = "tabbln{$orgid}{$i}";
        ?>
            <div id="<?= $tabId ?>" class="tab-pane fade <?= $active ?>" role="tabpanel">
                <div class="card card-flush">
                    <div class="card-header">
                        <h1 class="card-title" style="color:#663259;"><?= $namaRs ?> - <?= $bulan[$i - 1] ?></h3>
                    </div>
                    <div class="card-body">
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
                                        <th class="bg-secondary" colspan="2">Lain-lain</th>
                                        <th class="bg-dark text-white" colspan="2">Total</th>
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
                                        <th class="bg-secondary" rowspan="2">Sistem</th>
                                        <th class="bg-dark text-white" rowspan="2">Manual</th>
                                        <th class="bg-dark text-white" rowspan="2">Sistem</th>
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
                                <tbody class="text-gray-600 fw-bold" id="resultpendapatan<?= $tabId ?>"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        ?>
    </div>
</div>
