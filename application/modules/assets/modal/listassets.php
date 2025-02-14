<div class="modal fade" id="modal_assets_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/assets/listassets/insertassets" id="forminsertassets">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Assets Department</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Assets Department</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Assets Name</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Assets Name"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_assets_add" data-placeholder="Please Select Assets Name" class="form-select form-select-solid" name="modal_assets_add_barangid" id="modal_assets_add_barangid">
								<?php echo $masterbarang;?>
							</select>
						</div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Serial Number</label>
                            <input type="text" class="form-control form-control-solid" id="modal_assets_add_sn" name="modal_assets_add_sn" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Spesifikasi :</label>
                            <textarea class="form-control form-control-solid" name="modal_assets_add_spek" id="modal_assets_add_spek"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_assets_add" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>