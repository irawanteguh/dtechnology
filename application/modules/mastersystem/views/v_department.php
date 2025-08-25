<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Struktur Organisasi</h3>
                    <div class="fs-6 fw-bold text-gray-400" id="info_list_todo"></div>
                </div>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder m-5" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_today_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#kt_activity_today" aria-selected="true">Version 1</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="kt_activity_week_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_week" aria-selected="false">Version 2</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active mh-500px scroll-y me-n5 pe-5" role="tabpanel" aria-labelledby="kt_activity_today_tab">
                        <div id="listdepartment"></div>
                    </div>
                    <div id="kt_activity_week" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="kt_activity_week_tab"><div id="tree" style="width:100%; height:700px;"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>