<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #663259;background-size: auto 100%; background-image: url('<?php echo base_url();?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Laporan Mutasi Rekening</h1>
                        <p class="text-white mb-0">
                            Memberikan gambaran lengkap transaksi masuk dan keluar pada rekening untuk analisis keuangan dan pengambilan keputusan strategis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card card-flush">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-white bg-primary align-middle">
                                <th class="ps-4 rounded-start">Rekening</th>
                                <th colspan="2">Transaction</th>
                                <th class="text-end">Credit</th>
                                <th class="text-end">Debit</th>
                                <th class="text-end">Balance</th>
                                <th class="pe-4 text-end rounded-end">Transaction By</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatamutasi"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>