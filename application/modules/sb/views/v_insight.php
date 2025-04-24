<div class="row gy-5 g-xl-8 mb-xl-8">

    <div class="col-xl-8">
        <div class="card card-flush h-100">
            <div class="card-body flex-grow-1 d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Total Pendapatan Rumah Sakit Bulanan
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Ikhtisar pendapatan dari semua layanan rumah sakit.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanRS">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanRS" style="height: 350px"></div>
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
                <div id="kt_security_guidelines" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-interval="8000">
                    <div class="d-flex flex-stack align-items-center flex-wrap">
                        <h4 class="text-gray-400 fw-bold mb-0 pe-2">Patient Visits</h4>
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                            <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="0" class="ms-1"></li>
                            <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="1" class="ms-1 active" aria-current="true"></li>
                            <li data-bs-target="#kt_security_guidelines" data-bs-slide-to="2" class="ms-1"></li>
                        </ol>
                    </div>
                    <div class="carousel-inner pt-6">
                        <div class="carousel-item">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fs-5 fw-bolder text-dark text-hover-primary">Get Start Your Security</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">In the last year, you’ve probably had to adapt to new ways of living and working.</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="text-muted fw-bold fs-6 pe-2">34, Soho Avenue, Tokio</span>
                                    <a href="#" class="btn btn-sm btn-light">Register</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item active">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fw-bolder text-dark text-hover-primary">Security Policy Update</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">As we approach one year of working remotely, we wanted to take a look back and share some ways teams around the world have collaborated effectively.</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="badge badge-light-primary fs-7 fw-bolder me-2">Oct 05, 2021</span>
                                    <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bolder px-5">Explore</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-wrapper">
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="#" class="fw-bolder text-dark text-hover-primary">Terms Of Use Document</a>
                                    <p class="text-gray-600 fs-6 fw-bold pt-3 mb-0">Today we are excited to share an amazing certification opportunity which is designed to teach you everything</p>
                                </div>
                                <div class="d-flex flex-stack pt-8">
                                    <span class="badge badge-light-primary fs-7 fw-bolder me-2">Nov 10, 2021</span>
                                    <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-bolder px-5">Discover</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Distribusi Pendapatan By Provider
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Visualisasi proporsi pendapatan by provider
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalDistribusiProvider">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikDistribusiProvider" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6"></div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan Pasien Umum
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Total pendapatan bulanan dari pasien tanpa jaminan
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanUmum">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanUmum" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan Asuransi
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Pendapatan bulanan dari pasien pengguna asuransi swasta.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanAsuransi">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanAsuransi" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan BPJS
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Pendapatan dari layanan yang ditanggung oleh program BPJS.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanBPJS">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanBPJS" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan Lain-lain
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Pendapatan non-reguler seperti donasi, kerjasama, atau lainnya.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanLain">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanLain" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
