<button id="btn_riwayatkunjungan" class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0" title="Riwayat Kunjungan Pasien" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
    <span>History Visits</span>
</button>

<div id="kt_riwayatkunjungan" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="riwayatkunjungan" data-kt-drawer-activate="true" data-kt-drawer-overlay="true"  data-kt-drawer-width="43%" data-kt-drawer-direction="end" data-kt-drawer-toggle="#btn_riwayatkunjungan" data-kt-drawer-close="#btn_close_riwayatkunjungan">
    <div class="card shadow-none rounded-0 w-100">
        <div class="card-header" id="kt_riwayatkunjungan_header">
            <h3 class="card-title fw-bolder text-gray-700">History Visits</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="btn_close_riwayatkunjungan">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        <div class="card-body" id="kt_riwayatkunjungan_body">
            <div id="kt_riwayatkunjungan_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_riwayatkunjungan_body" data-kt-scroll-dependencies="#kt_riwayatkunjungan_header" data-kt-scroll-offset="5px">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">No Rawat</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nama Dokter</th>
                                <th class="pe-4 text-end rounded-end">Nama Poli</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatahistorykunjungan"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>