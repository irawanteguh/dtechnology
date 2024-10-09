

<!-- <div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div id="kt_security_recent_alerts" class="carousel carousel-custom carousel-stretch slide pointer-event" data-bs-ride="carousel" data-bs-interval="8000">
                    <div class="d-flex flex-stack align-items-center flex-wrap">
                        <h4 class="text-gray-400 fw-bold mb-0 pe-2">Recent Information</h4>
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                            <li data-bs-target="#kt_security_recent_alerts" data-bs-slide-to="0" class="ms-1 active" aria-current="true"></li>
                            <li data-bs-target="#kt_security_recent_alerts" data-bs-slide-to="1" class="ms-1"></li>
                            <li data-bs-target="#kt_security_recent_alerts" data-bs-slide-to="2" class="ms-1"></li>
                        </ol>
                    </div>
                    <div class="carousel-inner pt-6">
                        <div class="carousel-item active">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">Latest Announcements</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">In the last year, you’ve probably had to adapt to new ways of living and working.</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="badge badge-light-primary fs-7 fw-bolder me-2">Jun 10, 2021</span>
                                    <a href="#" class="btn btn-sm btn-light">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fw-bolder text-dark text-hover-primary">Login Attempt Failed</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">As we approach one year of working remotely, we wanted to take a look back and share some ways teams around the world have collaborated effectively.</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="badge badge-light-primary fs-7 fw-bolder me-2">Oct 05, 2021</span>
                                    <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bolder px-5">Join</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fw-bolder text-dark text-hover-primary">Top Picks For You</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">Today we are excited to share an amazing certification opportunity which is designed to teach you everything</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="badge badge-light-primary fs-7 fw-bolder me-2">Sep 11, 2021</span>
                                    <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bolder px-5">Collaborate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4"></div>
</div> -->

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Todo List Summary</h3>
                    <div class="fs-6 fw-bold text-gray-400" id="countoverduelabel"></div>
                </div>
            </div>
            <div class="card-body">
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"></rect>
                        </svg>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">We need your attention!</h4>
                            <div class="fs-6 text-gray-700">
                                <a href="#" class="fw-bolder me-1">View Detailed Task Report</a> for more insights on your team's progress.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                        <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                            <span class="fs-2qx fw-bolder" id="allcount"></span>
                            <span class="fs-6 fw-bold text-gray-400">Active</span>
                        </div>
                        <canvas id="todolist-chart" width="262" height="262" style="display: block; box-sizing: border-box; height: 174.667px; width: 174.667px;"></canvas>
                    </div>
                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                        <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                            <div class="bullet bg-primary me-3"></div>
                            <div class="text-gray-400">Active</div>
                            <div class="ms-auto fw-bolder text-gray-700" id="counttodolist"></div>
                        </div>
                        <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                            <div class="bullet bg-success me-3"></div>
                            <div class="text-gray-400">Completed</div>
                            <div class="ms-auto fw-bolder text-gray-700" id="countdone"></div>
                        </div>
                        <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                            <div class="bullet bg-danger me-3"></div>
                            <div class="text-gray-400">Overdue</div>
                            <div class="ms-auto fw-bolder text-gray-700" id="countoverdue"></div>
                        </div>
                        <div class="d-flex fs-6 fw-bold align-items-center">
                            <div class="bullet bg-gray-300 me-3"></div>
                            <div class="text-gray-400">Yet to start</div>
                            <div class="ms-auto fw-bolder text-gray-700" id="countwaiting"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Todo List Yourself</h3>
                    <div class="fs-6 fw-bold text-gray-400" id="info_list_todo"></div>
                </div>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder m-5" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_today_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#kt_activity_today" aria-selected="true">Today</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_week_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_week" aria-selected="false">Week</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_month_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_month" aria-selected="false">Month</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_year_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_year" aria-selected="false">Year</a>
                        </li>
                    </ul>
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Todo List</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal_dashboard_todo_add" class="menu-link px-3">Create Todo List</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_activity_today_tab"></div>
                    <div id="kt_activity_week" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="kt_activity_week_tab"></div>
                    <div id="kt_activity_month" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="kt_activity_month_tab"></div>
                    <div id="kt_activity_year" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="kt_activity_year_tab"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Performance Staff</h3>
                </div>
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
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Report</div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-todolist" class="menu-link px-3">Download Excel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle fs-6 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th>Name</th>
                                <th>Clinical Authority</th>
                                <th>Result KPI</th>
                            </tr>
                        </thead>
                        <tbody id="datastaff"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>