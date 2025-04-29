<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabanalisa">Analisa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabtotal">Rekap Total</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabumum">Umum</a>
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
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabdownload">Download Report</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabanalisa" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="align-middle">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Poli Klinik</th>
                                        <th>Nama Dokter</th>
                                        <th class="text-center">Jml Pasien</th>
                                        <th class="text-end">Beban Rumah Sakit</th>
                                        <th class="text-end">Estimasi Klaim</th>
                                        <th class="text-end">Obat Kronis</th>
                                        <th class="rounded-end pe-4 text-end">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultanalisa"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultanalisa"></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabtotal" role="tabpanel">
                    </div>
                    <div class="tab-pane fade" id="tabumum" role="tabpanel">
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
                                        <th class="ps-4 rounded-start rounded-end table-info" colspan="9">OutPatient / Rawat Jalan</th>
                                    </tr>
                                    <tr>
                                        <th colspan="9"></th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Tanggal</th>
                                        <th>No Rawat / Billing</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Provider</th>
                                        <th>Keterangan</th>
                                        <th>Poli Klinik</th>
                                        <th>Dokter</th>
                                        <th class="pe-4 rounded-end">Estimasi Klaim</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingbpjsrj"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingbpjsrj"></tfoot>
                            </table>
                        </div>
                        <br>
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                                <thead class="align-middle">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start rounded-end table-info" colspan="9">InPatient / Rawat Inap</th>
                                    </tr>
                                    <tr>
                                        <th colspan="9"></th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Tanggal Perawatan</th>
                                        <th>No Rawat / Billing</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Provider</th>
                                        <th>Keterangan</th>
                                        <th>Ruangan</th>
                                        <th>Dokter</th>
                                        <th class="pe-4 rounded-end">Estimasi Klaim</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingbpjsri"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingbpjsri"></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabdownload" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2" id="financereportdownload">
                                <thead class="align-middle">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start rounded-end table-info" colspan="17">OutPatient / Rawat Jalan</th>
                                    </tr>
                                    <tr>
                                        <th colspan="17"></th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start">Tanggal</th>
                                        <th>No Rawat / Billing</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Provider</th>
                                        <th>Keterangan</th>
                                        <th>Poli Klinik</th>
                                        <th>Dokter</th>
                                        <th class="text-end">Registrasi</th>
                                        <th class="text-end">Farmasi</th>
                                        <th class="text-end">Radiologi</th>
                                        <th class="text-end">Laboratorium</th>
                                        <th class="text-end">Tindakan</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Estimasi Klaim</th>
                                        <th class="text-end">Selisih</th>
                                        <th class="pe-4 rounded-end text-end">Note</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultdownload"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultdownload"></tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>