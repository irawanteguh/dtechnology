<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Unit Cost</span>
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Actions</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_unit_cost_add" class="menu-link px-3">Add Simulasi</a>
                        </div>
                    </div>
                </div>
			</div>
			<div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">Kategori</th>
                                <th>Nama Pelayanan</th>
                                <th class="text-end">Estimasi Lama Pengerjaan</th>
                                <th class="text-end">Cost</th>
                                <th class="text-end">Kompetitor 1</th>
                                <th class="text-end">Kompetitor 2</th>
                                <th class="text-end">Kompetitor 3</th>
                                <th class="text-end">Rata-rata</th>
                                <th>Analisa</th>
                                <th class="pe-4 text-end rounded-end">Action</th>
                            </tr>
                            <tr>
                                <th><input id="filterkategori" class="tagify form-control form-control-solid form-control-sm fs-8" placeholder="Filter Kategori"></th>
                                <th><input id="filternamapelayanan" class="tagify form-control form-control-solid form-control-sm fs-8" placeholder="Filter Nama Pelayanan"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatamasterlayanan"></tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
    <!-- <div class="col-xl-4">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Detail Component</span>
					<span class="text-muted mt-1 fw-bold fs-7" id="namapelayanan"></span>
				</h3>
			</div>
			<div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">Nama Komponen</th>
                                <th class="text-end">Beban Pasien</th>
                                <th class="pe-4 text-end rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatadetailcomponent"></tbody>
                    </table>
                </div>
			</div>
		</div>
	</div> -->
</div>
