<?php
function rendertabbulan($orgid) {
    $bulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
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
                    <h1 class="text-white">Detail Laporan Pengeluaran</h1>
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
                                    <tr class="fw-bolder align-middle bg-light">
                                        <th class="ps-4 rounded-start">Days</th>
                                        <th>Date</th>
                                        <th>No Pengeluaran</th>
                                        <th>Pengeluaran</th>
                                        <th>Department</th>
                                        <th>No Invoice</th>
                                        <th>Sub Total</th>
                                        <th>Ppn</th>
                                        <th class="rounded-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultpengeluaran<?= $tabId ?>"></tbody>
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
