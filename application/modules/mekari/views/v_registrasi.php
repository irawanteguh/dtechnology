<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">User Data</span>
        </h3>
        <div class="card-toolbar my-1">
            <div class="d-flex align-items-center position-relative my-1 me-4">
                <span class="svg-icon svg-icon-3 position-absolute ms-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search" name="searchdatakaryawan" id="searchdatakaryawan"/>
            </div>
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
                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Master User</div>
                </div>
                <div class="menu-item px-3">
                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-adduser" class="menu-link px-3">Add User</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body py-3">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-8 gy-2" id="tablemasterkaryawan">
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 rounded-start">User</th>
                        <th>Identity No</th>
                        <th>Tilaka Name</th>
                        <th>Note</th>
                        <th class="pe-4 text-end rounded-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold" id="resultmasterkaryawan"></tbody>
            </table>
        </div>
    </div>
</div>