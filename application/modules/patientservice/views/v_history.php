<div class="d-flex flex-column flex-xl-row">
    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
        <div class="card mb-5 mb-xl-8">
            <div class="card-body pt-15">
                <div class="d-flex flex-center flex-column mb-5">
                    <div class="symbol symbol-100px symbol-circle mb-7" id="intialnamapasien" name="intialnamapasien"></div>
                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1" id="namapasien" name="namapasien">n/a</a>
                    <div class="fs-5 fw-bold text-muted mb-6" id="nomr" name="nomr">n/a</div>
                </div>
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">Details
                        <span class="ms-2 rotate-180">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="separator separator-dashed my-3"></div>
                <div id="kt_customer_view_details" class="collapse show">
                    <div class="py-5 fs-6">
                        <div class="badge badge-light-success d-inline">Rawat Jalan</div>
                        <div class="fw-bolder mt-5">Tanggal Kunjungan</div>
                        <div class="text-gray-600">15 Oktober 2025</div>
                        <div class="fw-bolder mt-5">Unit / Poli Tujuan</div>
                        <div class="text-gray-600">Poli Penyakit Dalam</div>
                        <div class="fw-bolder mt-5">Dokter Penanggung Jawab</div>
                        <div class="text-gray-600">dr. Siti Rahma, Sp.PD</div>
                        <div class="fw-bolder mt-5">Cara Bayar</div>
                        <div class="text-gray-600">BPJS Kesehatan</div>
                        <div class="fw-bolder mt-5">Nomor SEP</div>
                        <div class="text-gray-600">1234-5678-9012</div>
                        <div class="fw-bolder mt-5">Diagnosa Awal</div>
                        <div class="text-gray-600">Hipertensi Esensial (I10)</div>
                        <div class="fw-bolder mt-5">Status Kunjungan</div>
                        <div class="text-gray-600">Selesai Diperiksa</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0">
                <div class="card-title">
                    <h3 class="fw-bolder m-0">Allergy</h3>
                </div>
            </div>
            <div class="card-body pt-2">
                <div id="areaalergi"></div>
            </div>
        </div>
    </div>

    <div class="flex-lg-row-fluid ms-lg-15">
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#tabsoapie">SOAPIE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#tabcatatanperawat">Catatan Perawat</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabsoapie" role="tabpanel">
                <div id="areasoapie"></div>
            </div>
            <div class="tab-pane fade" id="tabcatatanperawat" role="tabpanel">
                <div class="card">
                    <div class="card-body" id="areacatatanperawat">

                    </div>
                </div>
                <!-- <div id="areacatatanperawat"></div> -->
            </div>
        </div>
    </div>
</div>