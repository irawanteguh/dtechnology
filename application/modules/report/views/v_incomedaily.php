<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabtotal">Rekap Total</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabumum">Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabbpjs">BPJS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabasuransi">Asuransi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabmcu">MCU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabtransfer">Transfer</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade" id="tabtotal" role="tabpanel">
                    </div>
                    <div class="tab-pane fade show active" id="tabumum" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                                <thead class="align-middle">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Tanggal</th>
                                        <th>No Rawat / No Billing</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Cara Bayar</th>
                                        <th>Keterangan</th>
                                        <th>Poli Klinik / Kamar</th>
                                        <th>Dokter</th>
                                        <th class="pe-4 rounded-end">Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingumum"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingumum"></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabbpjs" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                                <thead class="align-middle">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Tanggal</th>
                                        <th>No Rawat / No Billing</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Cara Bayar</th>
                                        <th>Keterangan</th>
                                        <th>Poli Klinik / Kamar</th>
                                        <th>Dokter</th>
                                        <th class="pe-4 rounded-end">Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingbpjs"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingbpjs"></tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>