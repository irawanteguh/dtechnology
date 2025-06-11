<div class="row gy-5 g-xl-8 mb-xl-8">

    <div class="col-xl-12">
        <div class="card card card-flush h-100">
            <div class="card-header">
                <div class="card-title d-flex align-items-center">
                    <h6 class="fw-bolder m-0 text-gray-800">Trend Kunjungan Pasien</h3>
                </div>
                <div class="card-toolbar m-0">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tab_bulanan" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabbulanan">Bulanan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_harian" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabharian">Harian</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabbulanan" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_bulanan">
                        <div class="card-rounded-bottom" id="grafikkunjunganbulanan" style="height: 300px"></div>
                    </div>
                    <div id="tabharian" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_harian">
                        <div class="card-rounded-bottom" id="grafikkunjunganharian" style="height: 300px"></div>
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
                        <!-- <li class="nav-item" role="presentation">
                            <a id="tab_detailpendapatan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailpendapat">Presentasi Pendapatan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_detailkunjungan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabdetailkunjungan">Presentasi Kunjungan</a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabsummary" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_summary">
                        <div class="row">
                            <!-- <div class="col-xl-6">
                                <div class="card-rounded-bottom" id="grafikDistribusiProvider" style="height: 250px"></div>
                            </div> -->
                            <div class="col-xl-12">
                                <div class="card-rounded-bottom" id="grafikDistribusiProviderkunjungan" style="height: 250px"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="tabdetailpendapat" class="card-body p-0 tab-pane fade show" role="tabpanel" aria-labelledby="tab_detailpendapatan">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>