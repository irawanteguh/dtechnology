<div class="modal fade" id="modal_find_patient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                    <h1 class="mb-3">Find Patient</h1>
                    <div class="text-muted fw-bold fs-5">For more information, please refer to the details below.</div>
                </div>
                <div class="mb-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" id="searchPatientGlobal" class="form-control form-control-solid" placeholder="Search by name, medical record, or identity number...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2" id="tablemasterbarang">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">Patient Information</th>
                                <th>Identity No</th>
                                <th class="text-center">BOD</th>
                                <th class="text-center">Sex</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Mother Name</th>
								<th class="pe-4 text-end rounded-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600" id="resultdatadaftarpasien"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_triase_igd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
                    <h1 class="mb-3">Triase IGD</h1>
                    <div class="text-muted fw-bold fs-5">Triase dilakukan segera setelah pasien datang dan sebelum pasien/keluarga mendaftar di TPP IGD</div>
                </div>
                <div class="row">
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Tanggal Kunjungan :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Jam Kunjungan :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Cara Datang :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kasus :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-12">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Anamnesa :</label>
                        <textarea class="form-control form-control-solid" name="" id=""></textarea>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Suhu :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Tekanan Darah :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nadi :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Respiratory :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Saturasi :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-2">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nyeri :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Jalan Nafas :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Sirkulasi Dewasa :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nyeri Sedang Berat :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-3">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Plan :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-12">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Catatan :</label>
                        <textarea class="form-control form-control-solid" name="" id=""></textarea>
                    </div>
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Dokter / Petugas IGD :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                    <div class="fv-row mb-5 col-xl-6">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Tanggal dan Jam :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>