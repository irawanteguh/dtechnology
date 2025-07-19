<!-- <div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">List Assets</span>
					<span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
				</h3>
			</div>
			<div class="card-body py-3" style="overflow-y: auto;">
                <table class="table align-middle table-row-dashed fs-8 gy-2">
                    <thead>
                        <tr class="fw-bolder text-muted bg-light align-middle">
                            <th rowspan="2" class="ps-4 rounded-start">No Assets</th>
                            <th rowspan="2">Nama Barang</th>
                            <th rowspan="2">Kategori</th>
                            <th rowspan="2">Serial Number</th>
                            <th rowspan="2">Tahun Pembuatan</th>
                            <th rowspan="2">Tanggal Pembelian</th>
                            <th rowspan="2">Masa Ekonomis</th>
                            <th rowspan="2">Nilai Pembelian</th>
                            <th rowspan="2">Biaya Pemeliharaan</th>
                            <th rowspan="2">Masa Angsuran</th>
                            <th rowspan="2">Bunga Angsuran</th>
                            <th rowspan="2">Nilai Residu</th>
                            <th rowspan="2">Estimasi Penggunaan</th>
                            <th colspan="4" class="text-center bg-success text-white">Depresiasi</th>
                            <th colspan="4" class="text-center bg-primary text-white">Pemeliharaan</th>
                            <th colspan="4" class="text-center bg-info text-white">Bunga Angsuran</th>
                            <th rowspan="2" class="bg-danger text-white">Beban Per Pasien</th>
                            <th rowspan="2">Depresiasi Saat ini</th>
                            <th rowspan="2">Sisa Depresiasi</th>
                            <th rowspan="2">Created By</th>
                            <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                        </tr>
                        <tr class="fw-bolder text-muted bg-light align-middle">
                            <th class="text-center bg-success text-white">Tahunan</th>
                            <th class="text-center bg-success text-white">Bulanan</th>
                            <th class="text-center bg-success text-white">Harian</th>
                            <th class="text-center bg-success text-white">Pasien</th>
                            <th class="text-center bg-primary text-white">Tahunan</th>
                            <th class="text-center bg-primary text-white">Bulanan</th>
                            <th class="text-center bg-primary text-white">Harian</th>
                            <th class="text-center bg-primary text-white">Pasien</th>
                            <th class="text-center bg-info text-white">Tahunan</th>
                            <th class="text-center bg-info text-white">Bulanan</th>
                            <th class="text-center bg-info text-white">Harian</th>
                            <th class="text-center bg-info text-white">Pasien</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets"></tbody>
                </table>
			</div>
		</div>
	</div>
</div> -->


<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">List Assets</span>
					<span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
				</h3>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder m-5" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="bangunan_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#tab_bangunan" aria-selected="true">Bangunan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="alkes_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tab_alkes" aria-selected="false">Alat Kesehatan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="nonalkes_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tab_nonalkes" aria-selected="false">Alat Non Kesehatan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="rumahtangga_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tab_rumahtangga" aria-selected="false">Rumah Tangga</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="software_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tab_software" aria-selected="false">Software</a>
                        </li>
                    </ul>
                    <!-- <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Todo List</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_dashboard_todo_add" class="menu-link px-3">Create Todo List</a>
                        </div>
                    </div> -->
                </div>
			</div>
			<div class="card-body">
                <div class="tab-content">
                    <div id="tab_bangunan" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">No Assets</th>
                                    <th>Nama Bangunan</th>
                                    <th class="text-end">Luas (m²)</th>
                                    <th class="text-center">Tahun Perolehan</th>
                                    <th class="text-end">Nilai Asset</th>
                                    <th class="text-end">Bunga Pinjaman</th>
                                    <th class="text-end">Pemeliharaan</th>
                                    <th class="text-end">Harga Per (m²)</th>
                                    <th class="text-end">Depresiasi</th>
                                    <th class="text-end">Volume</th>
                                    <th class="text-end">Cost</th>
                                    <th>Created By</th>
                                    <th class="pe-4 text-end rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets_2"></tbody>
                        </table>
                    </div>
                    <div id="tab_alkes" class="card-body p-0 tab-pane" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">No Assets</th>
                                    <th>Nama Alat Kesehatan</th>
                                    <th>Lokasi</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-center">Tahun Perolehan</th>
                                    <th class="text-end">Nilai Asset</th>
                                    <th class="text-end">Bunga Pinjaman</th>
                                    <th class="text-end">Pemeliharaan</th>
                                    <th class="text-end">Depresiasi</th>
                                    <th class="text-end">Volume</th>
                                    <th class="text-end">Cost</th>
                                    <th>Created By</th>
                                    <th class="pe-4 text-end rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets_1"></tbody>
                        </table>
                    </div>
                    <div id="tab_nonalkes" class="card-body p-0 tab-pane" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">No Assets</th>
                                    <th>Nama Non Alat Kesehatan</th>
                                    <th>Lokasi</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-center">Tahun Perolehan</th>
                                    <th class="text-end">Nilai Asset</th>
                                    <th class="text-end">Bunga Pinjaman</th>
                                    <th class="text-end">Pemeliharaan</th>
                                    <th class="text-end">Depresiasi</th>
                                    <th class="text-end">Volume</th>
                                    <th class="text-end">Cost</th>
                                    <th>Created By</th>
                                    <th class="pe-4 text-end rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets_3"></tbody>
                        </table>
                    </div>
                    <div id="tab_rumahtangga" class="card-body p-0 tab-pane" role="tabpanel">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">No Assets</th>
                                    <th>Nama Non Alat Kesehatan</th>
                                    <th>Lokasi</th>
                                    <th class="text-end">Qty</th>
                                    <th class="text-center">Tahun Perolehan</th>
                                    <th class="text-end">Nilai Asset</th>
                                    <th class="text-end">Bunga Pinjaman</th>
                                    <th class="text-end">Pemeliharaan</th>
                                    <th class="text-end">Depresiasi</th>
                                    <th class="text-end">Volume</th>
                                    <th class="text-end">Cost</th>
                                    <th>Created By</th>
                                    <th class="pe-4 text-end rounded-end">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets_4"></tbody>
                        </table>
                    </div>
                    <div id="tab_software" class="card-body p-0 tab-pane" role="tabpanel"></div>
                </div>
                <!-- <table class="table align-middle table-row-dashed fs-8 gy-2">
                    <thead>
                        <tr class="fw-bolder text-muted bg-light align-middle">
                            <th class="ps-4 rounded-start">No Assets</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Serial Number</th>
                            <th class="text-center">Tahun Pembuatan</th>
                            <th class="text-center">Tanggal Perolehan</th>
                            <th>Masa Ekonomis</th>
                            <th>Masa Angsuran</th>
                            <th class="text-end">Nilai Perolehan</th>
                            <th class="text-end">Bunga Angsuran</th>
                            <th class="text-end">Biaya Pemeliharaan</th>
                            <th class="text-end">Biaya Perijinan</th>
                            <th class="text-end">Biaya Konsultan</th>
                            <th class="text-end">Pajak</th>
                            <th class="text-end">Nilai Residu</th>
                            <th class="text-end">Nilai Asset</th>
                            <th class="text-center">Estimasi Penggunaan</th>
                            <th>Created By</th>
                            <th class="pe-4 text-end rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold" id="resultdatamasterassets"></tbody>
                </table> -->
			</div>
		</div>
	</div>
</div>