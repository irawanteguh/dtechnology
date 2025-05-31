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
            <div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Laporan Mutasi Rekening</span>
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
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_rekening_pemasukan" class="menu-link px-3">Credit</a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_rekening_pengeluaran" class="menu-link px-3">Debit</a>
                        </div>
                    </div>
                </div>
			</div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-white bg-primary align-middle">
                                <th class="ps-4 rounded-start">Rekening</th>
                                <th colspan="4">Transaction</th>
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