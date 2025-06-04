<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #663259;background-size: auto 100%; background-image: url('<?php echo base_url();?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Laporan Piutang BPJS</h1>
                        <p class="text-white mb-0">
                            Menyajikan data piutang BPJS secara real-time untuk evaluasi finansial dan peningkatan pelayanan rumah sakit.
                        </p>
                    </div>
                </div>
                <div class="d-flex overflow-auto h-55px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabrekapitulasi" id="tab_rekapitulasi" style="color:#fff;">Rekapitulasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabhistory" id="tab_history" style="color:#fff;">History Pembayaran</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="tab-content p-0">
            <div id="tabrekapitulasi" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_date">
                <div class="card card-flush">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Laporan Piutang BPJS</span>
                            <span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Action</div>
                                </div>
                                <div class="menu-item px-3">
                                    <a data-bs-toggle="modal" data-bs-target="#modal_bpjs_invoice" class="menu-link px-3">Add Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="fw-bolder align-middle bg-light">
                                        <th class="ps-4 rounded-start">No invoice</th>
                                        <th>Jenis Tagihan</th>
                                        <th>Catatan</th>
                                        <th class="text-center">Tanggal Tagihan</th>
                                        <th class="text-center">Tagihan</th>
                                        <th class="text-center">Terbayar</th>
                                        <th class="text-center">Sisa Tagihan</th>
                                        <th class="pe-4 rounded-end text-end">Actions</th>
                                    </tr>
                                    
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultrekappiutang"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabhistory" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_month">
                <div class="card card-flush">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Laporan Pembayaran BPJS</span>
                            <span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="fw-bolder align-middle bg-light">
                                        <th class="ps-4 rounded-start">No invoice</th>
                                        <th>Jenis Tagihan</th>
                                        <th>Note</th>
                                        <th>Tagihan</th>
                                        <th>Januari</th>
                                        <th>Febuari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                        <th>Sisa Tagihan</th>
                                    </tr>
                                    
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultrekappembayaran"></tbody>
                                <tfoot id="footrekappembayaran"></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
