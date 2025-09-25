<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Simulasi Klaim Inacbg's iDRG</span>
                    <span class="text-muted mt-1 fw-bold fs-7">
                        Perhitungan simulasi tarif klaim rumah sakit berbasis INA-CBG's dan iDRG untuk mendukung evaluasi biaya pelayanan pasien.
                    </span>
                </h3>
            </div>
            <form action="<?php echo base_url();?>index.php/casemix/claimidrg/setklaim" id="formsetklaim">
                <div class="card-body">
                    <div class="row">
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Medical Record</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor rekam medis pasien"></i>
                            </label>
                            <input type="text" id="claim_mr" name="claim_mr" class="form-control form-control-sm form-control-solid" readonly>
                        </div>

                        <div class="fv-row mb-5 col-xl-6">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Nama Pasien</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama lengkap pasien sesuai identitas"></i>
                            </label>
                            <input type="text" id="claim_name" name="claim_name" class="form-control form-control-sm form-control-solid" readonly>
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
                            <input type="text" id="claim_nokartu" name="claim_nokartu" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
                        </div>

                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>No SEP</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Non Bedah"></i>
                            </label>
                            <input type="text" id="claim_nosep" name="claim_nosep" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah">
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
                            <input type="text" id="claim_tindakannonbedah" name="claim_tindakannonbedah" class="form-control form-control-sm form-control-solid currency-rp" id="prosedur_non_bedah">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Prosedur Bedah</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Prosedur Bedah"></i>
                            </label>
                            <input type="text" id="claim_tindakanbedah" name="claim_tindakanbedah" class="form-control form-control-sm form-control-solid currency-rp" id="prosedur_bedah">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Konsultasi</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Konsultasi"></i>
                            </label>
                            <input type="text" id="claim_konsultasi" name="claim_konsultasi" class="form-control form-control-sm form-control-solid currency-rp" id="konsultasi">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Tenaga Ahli</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Tenaga Ahli"></i>
                            </label>
                            <input type="text" id="claim_tenagaahli" name="claim_tenagaahli" class="form-control form-control-sm form-control-solid currency-rp" id="tenaga_ahli">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Keperawatan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Keperawatan"></i>
                            </label>
                            <input type="text" id="claim_keperawatan" name="claim_keperawatan" class="form-control form-control-sm form-control-solid currency-rp" id="keperawatan">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Penunjang</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Penunjang"></i>
                            </label>
                            <input type="text" id="claim_penunjang" name="claim_penunjang" class="form-control form-control-sm form-control-solid currency-rp" id="penunjang">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2" >
                                <span>Radiologi</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Radiologi"></i>
                            </label>
                            <input type="text" id="claim_radiologi" name="claim_radiologi" class="form-control form-control-sm form-control-solid currency-rp" id="radiologi">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Laboratorium</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Laboratorium"></i>
                            </label>
                            <input type="text" id="claim_laboratorium" name="claim_laboratorium" class="form-control form-control-sm form-control-solid currency-rp" id="laboratorium">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Pelayanan Darah</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Pelayanan Darah"></i>
                            </label>
                            <input type="text" id="claim_darah" name="claim_darah" class="form-control form-control-sm form-control-solid currency-rp" id="pelayanan_darah">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Rehabilitasi</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Rehabilitasi"></i>
                            </label>
                            <input type="text" id="claim_rehab" name="claim_rehab" class="form-control form-control-sm form-control-solid currency-rp" id="rehabilitasi">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Kamar</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Kamar"></i>
                            </label>
                            <input type="text" id="claim_kamar" name="claim_kamar" class="form-control form-control-sm form-control-solid currency-rp" id="kamar">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Rawat Intensif</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Rawat Intensif"></i>
                            </label>
                            <input type="text" id="claim_intensif" name="claim_intensif" class="form-control form-control-sm form-control-solid currency-rp" id="rawat_intensif">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Obat</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat"></i>
                            </label>
                            <input type="text" id="claim_obat" name="claim_obat" class="form-control form-control-sm form-control-solid currency-rp" id="obat">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Obat Kronis</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat Kronis"></i>
                            </label>
                            <input type="text" id="claim_obatkronis" name="claim_obatkronis" class="form-control form-control-sm form-control-solid currency-rp" id="obat_kronis">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Obat Kemoterapi</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Obat Kemoterapi"></i>
                            </label>
                            <input type="text" id="claim_obatkemo" name="claim_obatkemo" class="form-control form-control-sm form-control-solid currency-rp" id="obat_kemoterapi">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Alkes</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Alkes"></i>
                            </label>
                            <input type="text" id="claim_alkes" name="claim_alkes" class="form-control form-control-sm form-control-solid currency-rp" id="alkes">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>BMHP</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif BMHP"></i>
                            </label>
                            <input type="text" id="claim_bmhp" name="claim_bmhp" class="form-control form-control-sm form-control-solid currency-rp" id="bmhp">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Sewa Alat</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tarif Sewa Alat"></i>
                            </label>
                            <input type="text" id="claim_alat" name="claim_alat" class="form-control form-control-sm form-control-solid currency-rp" id="sewa_alat">
                        </div>
                        <div class="fv-row mb-5 col-xl-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Total Tarif Rumah Sakit</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Total Tarif Rumah Sakit"></i>
                            </label>
                            <input type="text" id="claim_totaltarifrs" name="claim_totaltarifrs" class="form-control form-control-sm form-control-solid currency-rp" id="sewa_alat">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-3">
                    <input class="btn btn-light-primary" id="setklaim_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
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