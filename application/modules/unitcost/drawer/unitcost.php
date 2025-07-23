<div id="drawer_unitcost_detailcomponent" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="drawer_unitcost_detailcomponent" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="50%" data-kt-drawer-direction="end" data-kt-drawer-toggle="#drawer_unitcost_detailcomponent_toggle" data-kt-drawer-close="#drawer_unitcost_detailcomponent_close">
	<div class="card shadow-none rounded-0 w-100">
		<div class="card-header" id="drawer_unitcost_detailcomponent_header">
			<h3 class="card-title fw-bolder text-gray-700">Detail Component Unit Cost</h3>
			<div class="card-toolbar">
				<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="drawer_unitcost_detailcomponent_close"><span class="svg-icon svg-icon-2"><i class="bi bi-x-lg"></i></span></button>
			</div>
		</div>
		<div class="card-body" id="drawer_unitcost_detailcomponent_body">
			<div id="drawer_unitcost_detailcomponent_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#drawer_unitcost_detailcomponentd_body" data-kt-scroll-dependencies="#drawer_unitcost_detailcomponent_header" data-kt-scroll-offset="5px">
				<div class="mb-0">
					<div class="btn-group mb-15" role="group" aria-label="Add Component Group">
						<a data-bs-toggle="modal" data-bs-target="#modal_unit_cost_add_sdm" href="#" class="btn btn-sm btn-warning"><i class="bi bi-person-badge-fill me-2"></i>SDM</a>
						<a href="#" class="btn btn-sm btn-success"><i class="bi bi-building me-2"></i>Sarana</a>
						<a href="#" class="btn btn-sm btn-danger"><i class="bi bi-hospital me-2"></i>Alat Kesehatan</a>
						<a href="#" class="btn btn-sm btn-secondary"><i class="bi bi-tools me-2"></i>Alat Non Kesehatan</a>
						<a href="#" class="btn btn-sm btn-info"><i class="bi bi-house-gear me-2"></i>Rumah Tangga</a>
						<a href="#" class="btn btn-sm btn-dark"><i class="bi bi-pc-display-horizontal me-2"></i>Software</a>
					</div>

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
		</div>
	</div>
</div>