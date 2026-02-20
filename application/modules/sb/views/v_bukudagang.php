<?php
    $hospitalList = [
        "10c84edd-500b-49e3-93a5-a2c8cd2c8524" => "RSU Mutiasari",
        "a4633f72-4d67-4f65-a050-9f6240704151" => "RS Thursina",
        "d5e63fbc-01ec-4ba8-90b8-fb623438b99d" => "RSIA Budhi Mulia"
    ];
    $firstKey = array_key_first($hospitalList);
?>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
             style="background-color: #663259; background-size: auto 100%; background-image: url('<?php echo base_url(); ?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Buku Dagang</h1>
                        <p class="text-white mb-0">
                            Memberikan gambaran lengkap transaksi masuk dan keluar pada rekening untuk analisis keuangan dan pengambilan keputusan strategis.
                        </p>
                    </div>
                </div>
                <div class="d-flex overflow-auto min-h-30px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                        <?php foreach ($hospitalList as $id => $name): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($id === $firstKey) ? 'active' : '' ?>" data-bs-toggle="tab" href="#bukudagang_<?= $id ?>" id="tab_<?= strtolower(str_replace(' ', '', $name)) ?>" style="color:#fff;"><?= $name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-content mt-5" id="mutasiTabContent">
    <?php foreach ($hospitalList as $id => $name): ?>
        <?php $isActive = ($id === $firstKey) ? 'show active' : ''; ?>
        <div class="tab-pane fade <?= $isActive ?>" id="bukudagang_<?= $id ?>" role="tabpanel">
            <div class="row gy-5 g-xl-8 mb-xl-8">
                <div class="col-xl-12">
                    <div class="card card-flush">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-8 gy-2">
                                    <thead>
                                        <tr class="fw-bolder align-middle bg-primary text-white">
                                            <th class="ps-4 rounded-start" rowspan="2">Pendapatan</th>
                                            <th class="text-end" rowspan="2">Estimasi</th>
                                            <th class="text-center" colspan="2">Di terima</th>
                                            <th class="pe-4 rounded-end text-end" rowspan="2">Sisa Tagihan</th>
                                        </tr>
                                        <tr class="fw-bolder bg-primary text-white">
                                            <th class="text-end">Bulan Ini</th>
                                            <th class="text-end">Bulan Depan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-bold" id="resultdatabukudagang_<?= $id ?>"></tbody>
                                    <tfoot class="text-white fw-bold bg-primary" id="resulttotalbukudagang_<?= $id ?>"></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
