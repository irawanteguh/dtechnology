<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Repository Document</span>
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Add Document</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_sign_add" class="menu-link px-3">Sign Document</a>
                        </div>
                    </div>
                </div>
			</div>
			<div class="card-body py-3">
				<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabonprocess">On Process</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabfinish">Finish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabhold">Failed</a>
                    </li>
                </ul>

				<div class="tab-content">
                    <div class="tab-pane fade show active" id="tabonprocess" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">Status</th>
										<th>Filename</th>
										<th>Information</th>
										<th>Assign By</th>
										<th>Response</th>
										<th class="pe-4 text-end rounded-end">Created</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultrepodocumentonprocess"></tbody>
							</table>
						</div>
                    </div>
					<div class="tab-pane fade show" id="tabfinish" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">Status</th>
										<th>Filename</th>
										<th>Information</th>
										<th>Assign By</th>
										<th>Response</th>
										<th class="pe-4 text-end rounded-end">Created</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultrepodocumentfinish"></tbody>
							</table>
						</div>
                    </div>
                    <div class="tab-pane fade" id="tabhold" role="tabpanel">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">Status</th>
										<th>Filename</th>
										<th>Information</th>
										<th>Assign By</th>
										<th>Response</th>
										<th class="pe-4 text-end rounded-end">Created</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultrepodocumentonhold"></tbody>
							</table>
						</div>
                    </div>
                </div>

				
			</div>
		</div>
	</div>
</div>
