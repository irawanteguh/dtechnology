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
                            <a id="tab_harian" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#tabharian">Summary</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="tab_bulanan" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#tabbulanan">Montly</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tabharian" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_harian">
                        <div class="card-rounded-bottom" id="grafikkunjungantotal" style="height: 300px"></div>
                    </div>
                    <div id="tabbulanan" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_bulanan">
                        <div class="card-rounded-bottom" id="grafikkunjunganbulanan" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>