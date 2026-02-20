<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">List Attachment Claim</span>
					<span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
				</h3>
			</div>
			<div class="card-body py-3">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabwaiting">Outpatient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabapprove">Inpatient</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabwaiting" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start">No Transaction</th>
                                        <th>Date</th>
                                        <th>Medical Record</th>
                                        <th>Name</th>
                                        <th>Doctor</th>
                                        <th>Polyclinic</th>
                                        <th class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultattachmentclaimrj"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabapprove" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start">No Request</th>
                                        <th>Pengadaan</th>
                                        <th>Supplier</th>
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">%Vat</th>
                                        <th class="text-end">Vat</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultdataapprove"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
