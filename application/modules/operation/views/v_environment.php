<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder">Setting Environment</h3>
                    <div class="fs-6 fw-bold text-gray-400">Konfigurasi alamat endpoint untuk setiap layanan, baik Development maupun Production. Pastikan pengaturan sesuai sebelum digunakan oleh sistem.</div>
                </div>
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder m-5" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="tilaka_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#tilaka" aria-selected="true">Tilaka</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="etc_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#etc" aria-selected="false">Etc</a>
                        </li>
                    </ul>
                </div>
            </div> 
            <div class="card-body">
                <div class="tab-content">
                    <div id="tilaka" class="card-body p-0 tab-pane fade show active scroll-y me-n5 pe-5" role="tabpanel" aria-labelledby="tilaka_tab">
                        <div class="row" id="resultdatatilaka"></div>
                    </div>
                    <div id="etc" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="etc_tab">
                        <div class="row" id="resultdataetc"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
