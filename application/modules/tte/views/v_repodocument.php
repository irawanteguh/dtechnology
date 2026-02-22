<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12 border">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #ffffff; background-size: auto 100%; background-image: url('http://localhost/dtechnology/assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1>Repository Document Elektonic Sign</h1>
                        <p class="mb-0">
                            Sistem repositori dokumen elektronik bertanda tangan digital yang memastikan keamanan, keabsahan, dan kemudahan akses dokumen secara terpusat.
                        </p>
                    </div>
                </div>
                <div class="d-flex overflow-auto min-h-30px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
						<li class="nav-item">
							<a class="nav-link text-muted active" data-bs-toggle="tab" href="#alldocument">All Document</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" data-bs-toggle="tab" href="#voiddocument">Void</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" data-bs-toggle="tab" href="#faileddocument">Failed</a>
						</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-content mt-5">
	<div class="tab-pane fade active show" id="alldocument" role="tabpanel">
		<div class="row gy-5 g-xl-8 mb-xl-8">
			<div class="col-xl-12">
				<div class="card card-flush">
					<div class="card-body p-8">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">#</th>
										<th>Document Information</th>
										<th>Information</th>
										<th>Signer Id</th>
										<th>Status</th>
										<th>Created</th>
										<th class="pe-4 text-end rounded-end">Actions</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultdatadocumentall"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="voiddocument" role="tabpanel">
		<div class="row gy-5 g-xl-8 mb-xl-8">
			<div class="col-xl-12">
				<div class="card card-flush">
					<div class="card-body p-8">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">#</th>
										<th>Document Information</th>
										<th>Information</th>
										<th>Signer Id</th>
										<th>Status</th>
										<th>Created</th>
										<th class="pe-4 text-end rounded-end">Actions</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultdatadocumentvoid"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="faileddocument" role="tabpanel">
		<div class="row gy-5 g-xl-8 mb-xl-8">
			<div class="col-xl-12">
				<div class="card card-flush">
					<div class="card-body p-8">
						<div class="table-responsive">
							<table class="table align-middle table-row-dashed fs-8 gy-2">
								<thead>
									<tr class="fw-bolder text-muted bg-light align-middle">
										<th class="ps-4 rounded-start">#</th>
										<th>Document Information</th>
										<th>Information</th>
										<th>Signer Id</th>
										<th>Status</th>
										<th>Created</th>
										<th class="pe-4 text-end rounded-end">Actions</th>
									</tr>
								</thead>
								<tbody class="text-gray-600 fw-bold" id="resultdatadocumentfailed"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>