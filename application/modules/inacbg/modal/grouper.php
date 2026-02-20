<div class="modal fade" id="modal-grouper" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Grouper Inacbg's</h1>
                    <div class="text-muted fw-bold fs-5">Worklist Grouper Inacbg's</div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="row d-flex justify-content-center">

                        <div class="row">
                            <h1 class="mb-5">Patient Information</h1>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Medical Record <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor Medical Record Pasien"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-mr" name="modal-grouper-mr" readonly>
                            </div>
                            <div class="col-md-4 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Patient Name <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama Lengkap Pasien"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-name" name="modal-grouper-name" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Sex <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis Kelamin Pasien"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-sex" name="modal-grouper-sex" readonly>
                            </div>
                            <div class="col-md-4 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Address <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Alamat Tempat Tinggal Pasien"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-address" name="modal-grouper-address" readonly>
                            </div>
                        </div>
                        <div class="mt-5 row">
                            <h1 class="mb-5">Transaction Information</h1>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">No Transaction</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-norawat" name="modal-grouper-norawat" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Transaction Date</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-tanggal" name="modal-grouper-tanggal" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Type</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-type" name="modal-grouper-type" readonly>
                            </div>
                            <div class="col-md-3 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Polyclinic / Room</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-poliklinik" name="modal-grouper-poliklinik" readonly>
                            </div>
                            <div class="col-md-3 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Doctor Name</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-dokter" name="modal-grouper-dokter" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Provider</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-provider" name="modal-grouper-provider" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Insurance No</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-peserta" name="modal-grouper-peserta" readonly>
                            </div>
                            <div class="col-md-4 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Insurance Policy Approval Letter</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-nosep" name="modal-grouper-nosep" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Class</label>
                                <select data-control="select2" data-dropdown-parent="#modal-grouper" data-placeholder="Nursing Class" class="form-select form-select-solid" name="modal-grouper-kelas" id="modal-grouper-kelas"></select>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Discharge Date</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">ADL Sub Acute</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">ADL Chronic</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">ICU Indikator</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">ICU LOS</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Ventilator</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Indikator Upgrade Kelas</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Naik Kelas</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Lama Naik Kelas</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Biaya Tambahan</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Berat Saat Lahir</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Sistol</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Diastol</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Status Pulang</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Diagnosa</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                            <div class="col-md-8 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">procedure</label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-" name="modal-grouper-" required>
                            </div>
                        </div>
                        <div class="mt-5 row">
                            <h1 class="mb-5">Hospital Fee Bills</h1>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Non Surgical Procedure <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Prosedur Non Bedah"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-nonbedah" name="modal-grouper-nonbedah" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Surgical Procedures <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Prosedur Bedah"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-bedah" name="modal-grouper-bedah" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Consultation <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Konsultasi"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-konsultasi" name="modal-grouper-konsultasi">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Experts <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Tenaga Ahli"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-ahli" name="modal-grouper-ahli">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nursing <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Keperawatan"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-perawat" name="modal-grouper-perawat" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Support <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Penunjang"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-penunjang" name="modal-grouper-penunjang">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Radiology <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Radiologi"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-rad" name="modal-grouper-rad" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Laboratory <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Laboratorium"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-lab" name="modal-grouper-lab" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Pharmacy / Medicine <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Obat"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-obat" name="modal-grouper-obat" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Chronic Medicine <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Obat Kronis"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-obatkronis" name="modal-grouper-obatkronis" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Chemotherapy Drugs <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Obat Kemoterapi"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-obatkemo" name="modal-grouper-obatkemo" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Blood Transfusion <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Pelayanan Darah"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-darah" name="modal-grouper-darah">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Rehabilitation <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Rehabilitasi"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-rehab" name="modal-grouper-rehab" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Room <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Kamar"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-kamar" name="modal-grouper-kamar" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Intensive Care <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Rawat Intensif"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-cc" name="modal-grouper-cc">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Medical devices <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Alkes"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-alkes" name="modal-grouper-alkes">
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Medical Consumables <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya BMHP"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-bmhp" name="modal-grouper-bmhp" readonly>
                            </div>
                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Equipment Rental <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Sewa Alat"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-sewa" name="modal-grouper-sewa" readonly>
                            </div>

                            <div class="col-md-2 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Polyclinic Executive <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya Poliklinik Esekutif"></i></label>
                                <input type="text" class="form-control form-control-solid" id="modal-grouper-poliesekutif" name="modal-grouper-poliesekutif">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer p-1">	
                <input class="btn btn-light-primary" id="btnproses" type="submit" value="SAVE" name="simpan" >
            </div>
        </div>
    </div>
</div>