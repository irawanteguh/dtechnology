<div class="col-md-12" >    
    <div class="row g-5 g-xl-8">
        <div class="col-md-12">
            <div class="card card-flush">
                <div class="card-header pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">List Of Department</span>
                        <span class="text-muted mt-1 fw-bold fs-7" id="info_list_activity"></span>
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_activity_add" class="menu-link flex-stack px-3">Add Activity
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Add Activity" aria-label="Specify a target name for future usage and reference"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-2" id="tablemasterkaryawan">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="ps-4 rounded-start">Department</th>
                                    <th>Part Of</th>
                                    <th class="pe-4 text-end rounded-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultmasterdepartment"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>