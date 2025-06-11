<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
             style="background-color: #663259; background-size: auto 100%; background-image: url('<?php echo base_url(); ?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Buku Dagang</h1>
                        <p class="text-white mb-0">
                            Ringkasan transaksi masuk dan keluar untuk mendukung pemantauan keuangan dan keputusan bisnis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <tbody class="text-gray-600 fw-bold" id="resultdatabukudagang"></tbody>
                        <tfoot id="resulttotalbukudagang"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>