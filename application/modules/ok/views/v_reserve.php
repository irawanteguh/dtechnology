<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Operation Plan</span>
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
                            <!-- <a href="" data-bs-toggle="modal" data-bs-target="#modal_add_plan" class="menu-link px-3">Add Planning</a> -->
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_reserve_request" class="menu-link px-3">Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-3">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabpotensial">Potensial</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#planning">Planning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ongoing">On Progress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabcancelled">Cancelled</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- <div class="tab-pane fade show active" id="tablist" role="tabpanel">
                        <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start">Actions</th>
                                        <th>Status</th>
                                        <th>Identity</th>
                                        <th>Doctor</th>
                                        <th>Polyclinic</th>
                                        <th>Diagnosis</th>
                                        <th class="pe-4 text-end rounded-end">Created</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold align-middle" id="resultpotensial"></tbody>
                            </table>
                        </div>
                    </div> -->
                    <div class="tab-pane fade show active" id="planning" role="tabpanel" sty>
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start">Status</th>
                                        <th>Identity</th>
                                        <th>Date</th>
                                        <th>Diagnosis / Medical Treatment</th>
                                        <th>Operator</th>
                                        <th>Created</th>
                                        <th class="pe-4 text-end rounded-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold align-middle" id="resultplanning"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabcancelled" role="tabpanel" sty>
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead>
                                    <tr class="fw-bolder text-muted bg-light align-middle">
                                        <th class="ps-4 rounded-start">Status</th>
                                        <th>Identity</th>
                                        <th>Date</th>
                                        <th>Diagnosis / Medical Treatment</th>
                                        <th>Operator</th>
                                        <th>Created</th>
                                        <th class="pe-4 text-end rounded-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold align-middle" id="resultcancelled"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>