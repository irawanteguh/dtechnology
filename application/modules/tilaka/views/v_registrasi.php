<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Data Karyawan</span>
        </h3>
        <div class="card-toolbar my-1">
            <!-- <div class="me-4 my-1">
                <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                    <option value="All" selected="selected">All Orders</option>
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
                    <option value="In Progress">In Progress</option>
                    <option value="In Transit">In Transit</option>
                </select>
            </div> -->
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-3 position-absolute ms-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search" name="teguh" id="searchtablemasterkaryawan"/>
            </div>
        </div>
    </div>
    <div class="card-body py-3">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-2" id="tablemasterkaryawan">
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