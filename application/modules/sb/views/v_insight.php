<div class="row gy-5 g-xl-8 mb-xl-8">

    <!-- <div class="col-xl-12">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Forecasting</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome">RSU Mutiasari</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income">
                        <div class="card-rounded-bottom" id="grafikpendapatanforecastrms" style="height: 300px"></div>
                    </div>
                    <div id="tabvisit" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_visit">
                        <div class="card-rounded-bottom" id="grafikKunjunganRS" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-xl-8">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Key Hospital Statistics (Last 12 Months)</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome">Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income">
                        <div class="card-rounded-bottom" id="grafikPendapatanRS" style="height: 300px"></div>
                    </div>
                    <div id="tabvisit" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_visit">
                        <div class="card-rounded-bottom" id="grafikKunjunganRS" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card flex-fill mb-5">
            <div class="card-body pt-5">
                <div id="kt_income_summary_carousel" class="carousel slide carousel-custom carousel-stretch" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="d-flex flex-stack align-items-center flex-wrap">
                        <h4 class="text-gray-400 fw-bold mb-0">Income Summary</h4>
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                            <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="0" class="ms-1 active" aria-current="true"></li>
                            <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="1" class="ms-1"></li>
                            <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="2" class="ms-1"></li>
                            <li data-bs-target="#kt_income_summary_carousel" data-bs-slide-to="3" class="ms-1"></li>
                        </ol>
                    </div>
                    <div class="carousel-inner pt-6">
                        <div class="carousel-item active">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">Total Revenue This Year</h5>
                                <p id="carousel-total-all" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">RSU Mutiasari Performance</h5>
                                <p id="carousel-total-rsms" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">RSIA Budhi Mulia Performance</h5>
                                <p id="carousel-total-rsiabm" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">RS Thursina Performance</h5>
                                <p id="carousel-total-rst" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card flex-fill d-flex flex-column">
            <div class="card-body flex-grow-1 pt-5">
                <div id="kt_visits_guidelines" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="d-flex flex-stack align-items-center flex-wrap">
                        <h4 class="text-gray-400 fw-bold mb-0 pe-2">Patient Visits</h4>
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                            <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="0" class="ms-1 active"></li>
                            <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="1" class="ms-1" aria-current="true"></li>
                            <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="2" class="ms-1"></li>
                            <li data-bs-target="#kt_visits_guidelines" data-bs-slide-to="3" class="ms-1"></li>
                        </ol>
                    </div>
                    <div class="carousel-inner pt-6">
                        <div class="carousel-item active">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">Total Patient Visits This Year</h5>
                                <p id="carousel-total-all-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">Patient Visits RSU Mutiasari</h5>
                                <p id="carousel-total-rsms-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">Patient Visits RSIA Budhi Mulia</h5>
                                <p id="carousel-total-rsiabm-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex flex-column">
                                <h5 class="text-dark fw-bolder">Patient Visits RS Thursina</h5>
                                <p id="carousel-total-rst-kunjungan" class="text-gray-600 fs-6 fw-bold pt-3 mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Distribusi Pendapatan dan Kunjungan</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_summary" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabsummary">Summary</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_detailpendapatan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailpendapat">Presentasi Pendapatan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_detailkunjungan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailkunjungan">Presentasi Kunjungan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabsummary" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_summary">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card-rounded-bottom" id="grafikDistribusiProvider" style="height: 250px"></div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card-rounded-bottom" id="grafikDistribusiProviderkunjungan" style="height: 250px"></div>
                            </div>
                        </div>
                    </div>
                    <div id="tabdetailpendapat" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_detailpendapatan">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasipendapatanrms" style="height: 345px"></div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasipendapatanrsiabm" style="height: 345px"></div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasipendapatanrst" style="height: 345px"></div>
                            </div>
                        </div>
                    </div>
                    <div id="tabdetailkunjungan" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_detailkunjungan">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasikunjunganrms" style="height: 345px"></div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasikunjunganrsiabm" style="height: 345px"></div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card-rounded-bottom" id="grafikpresentasikunjunganrst" style="height: 345px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">General Patient Service Statistics</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income_umum" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_umum">Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit_umum" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_umum">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome_umum" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_umum">
                        <div class="card-rounded-bottom" id="grafikPendapatanUmum" style="height: 250px"></div>
                    </div>
                    <div id="tabvisit_umum" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_umum">
                        <div class="card-rounded-bottom" id="grafikKunjunganUmum" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Insurance Patient Service Statistics</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income_asuransi" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_asuransi">Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit_asuransi" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_asuransi">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome_asuransi" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_asuransi">
                        <div class="card-rounded-bottom" id="grafikPendapatanAsuransi" style="height: 250px"></div>
                    </div>
                    <div id="tabvisit_asuransi" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_asuransi">
                        <div class="card-rounded-bottom" id="grafikKunjunganAsuransi" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">BPJS Patient Service Statistics</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income_bpjs" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_bpjs">Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit_bpjs" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_bpjs">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome_bpjs" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_bpjs">
                        <div class="card-rounded-bottom" id="grafikPendapatanBPJS" style="height: 250px"></div>
                    </div>
                    <div id="tabvisit_bpjs" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_bpjs">
                        <div class="card-rounded-bottom" id="grafikKunjunganBPJS" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Medical Check Up Patient Service Statistics</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income_mcu" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_mcu">Income</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit_mcu" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_mcu">Patient Visits</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome_mcu" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_mcu">
                        <div class="card-rounded-bottom" id="grafikPendapatanMCU" style="height: 250px"></div>
                    </div>
                    <div id="tabvisit_mcu" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_mcu">
                        <div class="card-rounded-bottom" id="grafikKunjunganMCU" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Others Patient Service Statistics</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_income_lain" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabincome_lain">Cooperation</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_visit_lain" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabvisit_lain">Drug Sales</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabincome_lain" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_income_lain">
                        <div class="card-rounded-bottom" id="grafikPendapatanLain" style="height: 250px"></div>
                    </div>
                    <div id="tabvisit_lain" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_income_lain">
                        <div class="card-rounded-bottom" id="grafikPendapatanPOB" style="height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
