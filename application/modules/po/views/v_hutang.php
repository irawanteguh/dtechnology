<?php
function rendertabbulan() {
    $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $bulanSekarang = date('n');
    ?>
    <div class="d-flex overflow-auto min-h-40px mb-3">
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bolder flex-nowrap">
            <?php foreach ($bulan as $index => $namaBulan): 
                $bulanKe = $index + 1;
                $active  = ($bulanKe == $bulanSekarang) ? 'active' : '';
                $tabId   = "#tabbln{$bulanKe}";
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

<div class="row gy-5 g-xl-8 mb-xl-3 border">
    <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
         style="background-color: #663259; background-size: auto 100%; background-image: url('<?= base_url(); ?>assets/images/svg/misc/taieri.svg')">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                <div>
                    <h1 class="text-white">Detail Laporan Hutang</h1>
                    <p class="text-white mb-1">
                        Menampilkan data hutang pengadaan yang sudah diajukan invoice namun belum dilakukan pembayaran.
                    </p>
                </div>
            </div>
            <?php rendertabbulan(); ?>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="tab-content p-0">
        <?php
        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulanSekarang = date('n');

        for ($i = 1; $i <= 12; $i++):
            $active = ($i == $bulanSekarang) ? 'show active' : '';
            $tabId  = "tabbln{$i}";
        ?>
            <div id="<?= $tabId ?>" class="tab-pane fade <?= $active ?>" role="tabpanel">
                <div class="card card-flush">
                    <div class="card-header">
                        <h4 class="card-title" style="color:#663259;">
                            <?= $bulan[$i - 1] ?>
                        </h4>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead class="text-center">
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start text-start">Hari</th>
                                        <th>Tanggal</th>
                                        <th>No Pengadaan</th>
                                        <th>Pengadaan</th>
                                        <th>Department</th>
                                        <th>No Invoice</th>
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="rounded-end text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resulthutang<?= $tabId ?>"></tbody>
                                <tfoot class="text-gray-600 fw-bold" id="resulthutangtfoot<?= $tabId ?>"></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
