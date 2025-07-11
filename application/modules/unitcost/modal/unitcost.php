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

                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_unit_cost_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>