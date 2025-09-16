<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Payment Request</span>
                    <span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
                </h3>
            </div>
            <div class="card-body py-3">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-7 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabwaiting">On Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabapprove">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabdecline">Decline</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabwaiting" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">No Pemesanan</th>
                                        <th rowspan="2">Pengadaan</th>
                                        <th rowspan="2">Department</th>
                                        <th rowspan="2">Supplier</th>
                                        <th colspan="3" class="text-center">Pengajuan</th>
                                        <th colspan="3" class="text-center">Penerimaan</th>
                                        <th rowspan="2" class="text-end">Status</th>
                                        <th rowspan="2" class="text-end">Dibuat Oleh</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultdataonprocess"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabapprove" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">No Pemesanan</th>
                                        <th rowspan="2">Pengadaan</th>
                                        <th rowspan="2">Department</th>
                                        <th rowspan="2">Supplier</th>
                                        <th colspan="3" class="text-center">Pengajuan</th>
                                        <th colspan="3" class="text-center">Penerimaan</th>
                                        <th rowspan="2" class="text-end">Status</th>
                                        <th rowspan="2" class="text-end">Dibuat Oleh</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultdataapprove"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabdecline" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-8 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th rowspan="2" class="ps-4 rounded-start">No Pemesanan</th>
                                        <th rowspan="2">Pengadaan</th>
                                        <th rowspan="2">Department</th>
                                        <th rowspan="2">Supplier</th>
                                        <th colspan="3" class="text-center">Pengajuan</th>
                                        <th colspan="3" class="text-center">Penerimaan</th>
                                        <th rowspan="2" class="text-end">Status</th>
                                        <th rowspan="2" class="text-end">Dibuat Oleh</th>
                                        <th rowspan="2" class="pe-4 text-end rounded-end">Action</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-end">Sub Total</th>
                                        <th class="text-end">Ppn</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultdatadecline"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>