<div class="modal fade" id="modal_unit_cost_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/unitcost/unitcost/addsimulation" id="formaddsimulation">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add New Simulation Unit Cost</h1>
                        <div class="text-muted fw-bold fs-5">
                            Add a unit cost simulation for service cost analysis.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nama Pelayanan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_unit_cost_add_name" name="modal_unit_cost_add_name" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Kategori</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Category"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_unit_cost_add" data-placeholder="Please Select Category" class="form-select form-select-solid" name="modal_unit_cost_add_kategori" id="modal_unit_cost_add_kategori" required>
                                <?php echo $masterkategori;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Estimasi Lama Pengerjaan :</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-solid pe-10" id="modal_unit_cost_add_durasi" name="modal_unit_cost_add_durasi" required>
                                <span id="menit-label" class="position-absolute top-50 end-0 translate-middle-y me-4 text-muted">Menit</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 1</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_add_com1" name="modal_unit_cost_add_com1" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 2</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_add_com2" name="modal_unit_cost_add_com2" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 3</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_add_com3" name="modal_unit_cost_add_com3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_unit_cost_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_unit_cost_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/unitcost/unitcost/editsimulation" id="formeditsimulation">
                <input type="hidden" id="modal_unit_cost_edit_type" name="modal_unit_cost_edit_type">
                <input type="hidden" id="modal_unit_cost_edit_layanid" name="modal_unit_cost_edit_layanid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Simulation Unit Cost</h1>
                        <div class="text-muted fw-bold fs-5">
                            Edit a unit cost simulation for service cost analysis.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nama Pelayanan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_unit_cost_edit_name" name="modal_unit_cost_edit_name" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Kategori</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Category"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_unit_cost_edit" data-placeholder="Please Select Category" class="form-select form-select-solid" name="modal_unit_cost_edit_kategori" id="modal_unit_cost_edit_kategori" required>
                                <?php echo $masterkategori;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Estimasi Lama Pengerjaan :</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-solid pe-10" id="modal_unit_cost_edit_durasi" name="modal_unit_cost_edit_durasi" required>
                                <span id="menit-label" class="position-absolute top-50 end-0 translate-middle-y me-4 text-muted">Menit</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 1</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_edit_com1" name="modal_unit_cost_edit_com1" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 2</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_edit_com2" name="modal_unit_cost_edit_com2" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Kompetitor 3</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_unit_cost_edit_com3" name="modal_unit_cost_edit_com3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_unit_cost_edit_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_unit_cost_add_sdm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <input type="hidden" id="modal_unit_cost_add_sdm_layanid" name="modal_unit_cost_add_sdm_layanid">
            <div class="modal-body">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Penambahan SDM</h1>
                    <div class="text-muted fw-bold fs-5">Sebagai komponen perhitungan unit cost</div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">Jabatan</th>
                                    <th class="text-end">Gaji</th>
                                    <th class="text-end">Remunerasi</th>
                                    <th class="pe-4 text-end rounded-end" style="10px;">Jumlah</th>
                                </tr>
                                <tr>
                                    <th><input id="filterjabatan" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Jabatan"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600" id="resultmasterdm"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_unit_cost_add_rumahtangga" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <input type="hidden" id="modal_unit_cost_add_sdm_layanid" name="modal_unit_cost_add_sdm_layanid">
            <div class="modal-body">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Penambahan ATK dan Rumah Tangga</h1>
                    <div class="text-muted fw-bold fs-5">Sebagai komponen perhitungan unit cost</div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light align-middle">
                                    <th class="ps-4 rounded-start">Component</th>
                                    <th class="text-end">Satuan</th>
                                    <th class="text-end">Harga</th>
                                    <th class="pe-4 text-end rounded-end" style="10px;">Jumlah</th>
                                </tr>
                                <tr>
                                    <th><input id="filtercomponent" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Nama Component"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600" id="resultmasterrumahtangga"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>