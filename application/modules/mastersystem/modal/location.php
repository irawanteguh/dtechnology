<div class="modal fade" id="modal_department_addsublocation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/location/insertlocation" id="forminsertlocation">
                <input type="hidden" id="headerid" name="headerid">
                <input type="hidden" id="levelid" name="levelid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Sub Location</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Sub Location</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Location Name</label>
                            <input type="text" class="form-control form-control-solid" id="location_name" name="location_name" required>
                        </div>
                        <div class="col-xl-12 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Personal In Charge</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Personal In Charge"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_department_addsublocation" data-placeholder="Please Select Personal In Charge" class="form-select form-select-solid" name="location_pic" id="location_pic">
								<?php echo $pic;?>
							</select>
						</div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_location_add" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>