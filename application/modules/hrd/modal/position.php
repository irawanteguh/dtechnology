<div class="modal fade" id="modal_position_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/position/addposition" id="formaddposition">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add Master Position</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Master Position</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Position Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_position_name_add" name="data_position_name_add" required>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Department</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department for position"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_position_add" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_position_add_departmentid_add" id="modal_position_add_departmentid_add" required>
                                <?php echo $masterdepartmentadd;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_position_add" type="submit" value="SIMPAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_position_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/position/editposition" id="formeditposition">
                <input type="hidden" id="data_positiion_id_edit" name="data_positiion_id_edit">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Master Position</h1>
                        <div class="text-muted fw-bold fs-5">Please Edit Master Position</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Position Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_position_name_edit" name="data_position_name_edit" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Department</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department for position"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_position_edit" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_position_edit_departmentid_edit" id="modal_position_edit_departmentid_edit" required>
                                <?php echo $masterdepartmentedit;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Part Of</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Part Of for position"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_position_edit" data-placeholder="Please Select Part of" class="form-select form-select-solid" name="modal_position_edit_bagianid_edit" id="modal_position_edit_bagianid_edit" required>
                                <?php echo $masterbagianedit;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Units</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Units for position"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_position_edit" data-placeholder="Please Select Units" class="form-select form-select-solid" name="modal_position_edit_unitid_edit" id="modal_position_edit_unitid_edit" required>
                                <?php echo $masterunitedit;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_position_edit" type="submit" value="UPDATE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>