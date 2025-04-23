<div class="row gy-5">
    <!-- Total Pendapatan Rumah Sakit -->
    <div class="col-xl-8">
        <div class="card card-xl-stretch">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Grafik Total Pendapatan Rumah Sakit (Bulanan)
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Ikhtisar pendapatan bulanan dari seluruh layanan rumah sakit, termasuk rawat jalan dan rawat inap.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanRS">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanRS" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Distribusi Provider -->
    <div class="col-xl-4">
        <div class="card card-xl-stretch">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Grafik Distribusi Pendapatan Berdasarkan Provider
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Visualisasi proporsi pendapatan dari BPJS, asuransi, dan pasien umum setiap bulannya.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalDistribusiProvider">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikDistribusiProvider" style="height: 150px"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan Pasien Umum -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan Pasien Umum
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Total pendapatan bulanan dari pasien tanpa jaminan, termasuk layanan rawat jalan dan inap.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanUmum">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanUmum" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan Asuransi -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch">
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

    <!-- Pendapatan BPJS -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan BPJS
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Pendapatan dari layanan yang ditanggung oleh program BPJS setiap bulannya.
                            </div>
                        </div>
                        <div class="fw-bolder fs-3 text-primary" id="totalPendapatanBPJS">NaN</div>
                    </div>
                    <div class="card-rounded-bottom" id="grafikPendapatanBPJS" style="height: 250px"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendapatan Lain-lain -->
    <div class="col-xl-6">
        <div class="card card-xl-stretch">
            <div class="card-body d-flex flex-column p-0">
                <div class="flex-grow-1 card-p pb-0">
                    <div class="d-flex flex-stack flex-wrap">
                        <div class="me-2">
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">
                                Pendapatan Lain-lain
                            </a>
                            <div class="text-muted fs-7 fw-bold">
                                Pendapatan dari sumber non-reguler seperti donasi, kerjasama, atau layanan khusus lainnya.
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
