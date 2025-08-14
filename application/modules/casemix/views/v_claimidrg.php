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
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Nomor SEP</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nomor Surat Eligibilitas Peserta"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="UJICOBA1">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Nomor Kartu</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nomor Kartu BPJS"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="0000097208276">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tanggal Masuk</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tanggal & Jam Masuk"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="2024-11-09 08:55:00">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Tanggal Pulang</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tanggal & Jam Pulang"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="2024-11-09 09:55:00">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Cara Masuk</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Cara Pasien Masuk RS"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="gp">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Jenis Rawat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Jenis Rawat Inap/Jalan"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="2">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span>Kelas Rawat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kelas Rawat Pasien"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" placeholder="3">
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="adl_sub_acute">
                            <span>ADL Sub Acute</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nilai ADL Sub Acute"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="adl_sub_acute" placeholder="15">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="adl_chronic">
                            <span>ADL Chronic</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nilai ADL Chronic"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="adl_chronic" placeholder="12">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="icu_indikator">
                            <span>ICU Indikator</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Indikator ICU"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="icu_indikator" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="icu_los">
                            <span>ICU LOS</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Lama Hari ICU"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="icu_los" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="upgrade_class_ind">
                            <span>Upgrade Class Ind</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Indikator Upgrade Kelas"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="upgrade_class_ind" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="add_payment_pct">
                            <span>Additional Payment %</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Persentase Tambahan Pembayaran"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="add_payment_pct" placeholder="10">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="birth_weight">
                            <span>Birth Weight</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Berat Lahir (gram)"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="birth_weight" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="sistole">
                            <span>Sistole</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tekanan Darah Sistole"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="sistole" placeholder="110">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="diastole">
                            <span>Diastole</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tekanan Darah Diastole"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="diastole" placeholder="60">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="discharge_status">
                            <span>Discharge Status</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Status Pulang Pasien"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="discharge_status" placeholder="1">
                    </div>
                </div>

                <h5 class="fw-bolder mt-5 mb-3">Tarif Rumah Sakit</h5>
                <div class="row">
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="prosedur_non_bedah">
                            <span>Prosedur Non Bedah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Prosedur Non Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_non_bedah" placeholder="300000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="prosedur_bedah">
                            <span>Prosedur Bedah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Prosedur Bedah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="prosedur_bedah" placeholder="20000000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="konsultasi">
                            <span>Konsultasi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Konsultasi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="konsultasi" placeholder="300000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="tenaga_ahli">
                            <span>Tenaga Ahli</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Tenaga Ahli"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="tenaga_ahli" placeholder="200000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="keperawatan">
                            <span>Keperawatan</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Keperawatan"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="keperawatan" placeholder="80000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="penunjang">
                            <span>Penunjang</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Penunjang"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="penunjang" placeholder="1000000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="radiologi">
                            <span>Radiologi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Radiologi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="radiologi" placeholder="500000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="laboratorium">
                            <span>Laboratorium</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Laboratorium"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="laboratorium" placeholder="600000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="pelayanan_darah">
                            <span>Pelayanan Darah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Pelayanan Darah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="pelayanan_darah" placeholder="150000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="rehabilitasi">
                            <span>Rehabilitasi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Rehabilitasi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="rehabilitasi" placeholder="100000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="kamar">
                            <span>Kamar</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Kamar"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="kamar" placeholder="6000000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="rawat_intensif">
                            <span>Rawat Intensif</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Rawat Intensif"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="rawat_intensif" placeholder="2500000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="obat">
                            <span>Obat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Obat"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="obat" placeholder="100000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="obat_kronis">
                            <span>Obat Kronis</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Obat Kronis"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="obat_kronis" placeholder="1000000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="obat_kemoterapi">
                            <span>Obat Kemoterapi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Obat Kemoterapi"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="obat_kemoterapi" placeholder="5000000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="alkes">
                            <span>Alkes</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Alkes"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="alkes" placeholder="500000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="bmhp">
                            <span>BMHP</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif BMHP"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="bmhp" placeholder="400000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="sewa_alat">
                            <span>Sewa Alat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Sewa Alat"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="sewa_alat" placeholder="210000">
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="pemulasaraan_jenazah">
                            <span>Pemulasaraan Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Pemulasaraan Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="pemulasaraan_jenazah" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="kantong_jenazah">
                            <span>Kantong Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kantong Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="kantong_jenazah" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="peti_jenazah">
                            <span>Peti Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Peti Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="peti_jenazah" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="plastik_erat">
                            <span>Plastik Erat</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Plastik Erat"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="plastik_erat" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="desinfektan_jenazah">
                            <span>Desinfektan Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Desinfektan Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="desinfektan_jenazah" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="mobil_jenazah">
                            <span>Mobil Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Mobil Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="mobil_jenazah" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="desinfektan_mobil_jenazah">
                            <span>Desinfektan Mobil Jenazah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Desinfektan Mobil Jenazah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="desinfektan_mobil_jenazah" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="covid19_status_cd">
                            <span>COVID-19 Status</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Status COVID-19"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="covid19_status_cd" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="nomor_kartu_t">
                            <span>Nomor Kartu T</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nomor Kartu T"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="nomor_kartu_t" placeholder="nik">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="episodes">
                            <span>Episodes</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Episodes"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="episodes" placeholder="1;12#2;3#6;5">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="akses_naat">
                            <span>Akses NAAT</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Akses NAAT"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="akses_naat" placeholder="C">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="isoman_ind">
                            <span>Isoman Ind</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Indikator Isoman"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="isoman_ind" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="bayi_lahir_status_cd">
                            <span>Bayi Lahir Status</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Status Bayi Lahir"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="bayi_lahir_status_cd" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="dializer_single_use">
                            <span>Dializer Single Use</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Dializer Single Use"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="dializer_single_use" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="kantong_darah">
                            <span>Kantong Darah</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kantong Darah"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="kantong_darah" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="alteplase_ind">
                            <span>Alteplase Ind</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Alteplase Ind"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="alteplase_ind" placeholder="1">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="tarif_poli_eks">
                            <span>Tarif Poli Eks</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Tarif Poli Eks"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="tarif_poli_eks" placeholder="100000">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="nama_dokter">
                            <span>Nama Dokter</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Nama Dokter Penanggung Jawab"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="nama_dokter" placeholder="BAMBANG, DR">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="kode_tarif">
                            <span>Kode Tarif</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kode Tarif"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="kode_tarif" placeholder="AP">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="payor_id">
                            <span>Payor ID</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="ID Penanggung Biaya"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="payor_id" placeholder="3">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="payor_cd">
                            <span>Payor Code</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kode Penanggung Biaya"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="payor_cd" placeholder="JKN">
                    </div>

                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="cob_cd">
                            <span>COB Code</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="Kode COB"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="cob_cd" placeholder="0">
                    </div>

                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="coder_nik">
                            <span>Coder NIK</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" title="NIK Coder"></i>
                        </label>
                        <input type="text" class="form-control form-control-sm form-control-solid" id="coder_nik" placeholder="123123123123">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>