<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">List Claim</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Daftar klaim pasien berdasarkan iDRG untuk proses verifikasi dan analisis.</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">No SEP</th>
                                <th>No Kartu</th>
                                <th>No Medical Record</th>
                                <th>Nama Pasien</th>
                                <th>Jenis Pelayanan</th>
                                <th class="pe-4 text-end rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdataonprocess"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Grouping iDRG</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Pengelompokan kasus pasien sesuai standar iDRG untuk klaim dan analisis biaya.</span>
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Medical Record</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor rekam medis pasien"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" disabled>
                    </div>

                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Nama Pasien</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama lengkap pasien sesuai identitas"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" disabled>
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tanggal Lahir</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tanggal lahir pasien (dd-mm-yyyy)"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" disabled>
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Jenis Kelamin</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis kelamin pasien (Laki-laki / Perempuan)"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" disabled>
                    </div>

                    <h5 class="fw-bolder mt-5 mb-3">Penjaminan</h5>
                    <hr>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>No Kartu</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>No SEP</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tanggal Masuk</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tanggal Keluar</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
                    </div>

                    <h5 class="fw-bolder mt-5 mb-3">Tarif Rumah Sakit</h5>
                    <hr>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Prosedur Non Bedah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="prosedur_non_bedah">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Prosedur Bedah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="prosedur_bedah">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Konsultasi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Konsultasi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="konsultasi">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tenaga Ahli</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Tenaga Ahli"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="tenaga_ahli">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Keperawatan</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Keperawatan"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="keperawatan">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Penunjang</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Penunjang"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="penunjang">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" >
                            <span>Radiologi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Radiologi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="radiologi">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Laboratorium</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Laboratorium"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="laboratorium">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Pelayanan Darah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Pelayanan Darah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="pelayanan_darah">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Rehabilitasi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Rehabilitasi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="rehabilitasi">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Kamar</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Kamar"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="kamar">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Rawat Intensif</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Rawat Intensif"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="rawat_intensif">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Obat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="obat">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Obat Kronis</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat Kronis"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="obat_kronis">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Obat Kemoterapi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat Kemoterapi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="obat_kemoterapi">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Alkes</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Alkes"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="alkes">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>BMHP</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif BMHP"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="bmhp">
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Sewa Alat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Sewa Alat"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid currency-rp" id="sewa_alat">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-3">
                <a href="" class="btn btn-primary">SIMPAN</a>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-6">
        <div class="card card-flush h-100" id="diagnosisicd10im">
            <div class="card-header pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Diagnosis ICD-10 IM</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Klasifikasi diagnosis pasien berdasarkan standar iDRG.</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="row">
                    <div class="fv-row mb-10 col-xl-12">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Diagnosis</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Pilih diagnosis pasien sesuai kode ICD-10"></i>
                        </label>
                        <div class="d-flex align-items-center">
                            <select data-control="select2" data-dropdown-parent="#diagnosisicd10im" data-placeholder="Please Select Diagnosis" class="form-select form-select-solid" id="grouping_icd10" name="grouping_icd10">
                                <?php echo $mastericd10;?>
                            </select>
                            <a href="#" class="btn btn-primary ms-4">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Procedure ICD-9 IM</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Klasifikasi prosedur medis untuk mendukung penentuan biaya dan laporan klaim pasien.</span>
                </h3>
            </div>
            <div class="card-body mh-500px scroll-y me-n5 pe-5">
                
            </div>
        </div>
    </div>
</div>