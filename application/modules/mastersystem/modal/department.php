<div class="modal fade" id="modal_department_addsubdepartment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/department/insertdepartment" id="forminsertdepartment">
                <input type="hidden" id="levelid" name="levelid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Sub Department</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Sub Department</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Department Header</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department Header"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_department_addsubdepartment" data-placeholder="Department Header" class="form-select form-select-solid" name="department_departmentheader" id="department_departmentheader" required>
								<?php echo $masterdepartment;?>
							</select>
						</div>
                        <div class="col-xl-6 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Department Name</label>
                            <input type="text" class="form-control form-control-solid" id="department_name" name="department_name">
                        </div>
                        <div class="col-xl-3 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Department Code</label>
                            <input type="text" class="form-control form-control-solid" id="department_code" name="department_code">
                        </div>
                        <div class="col-xl-9 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Position Name</label>
                            <input type="text" class="form-control form-control-solid" id="department_position" name="department_position">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_department_add" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_department_editsubdepartment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/department/editdepartment" id="formeditdepartment">
                <input type="hidden" id="departmentidedit" name="departmentidedit">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Edit Sub Department</h1>
                        <div class="text-muted fw-bold fs-5">Please Edit Sub Department</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Department Header</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department Header"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_department_editsubdepartment" data-placeholder="Department Header" class="form-select form-select-solid" name="department_departmentheader_edit" id="department_departmentheader_edit" required>
								<?php echo $masterdepartment;?>
							</select>
						</div>
                        <div class="col-xl-6 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Department Name</label>
                            <input type="text" class="form-control form-control-solid" id="department_name_edit" name="department_name_edit" required>
                        </div>
                        <div class="col-xl-3 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Department Code</label>
                            <input type="text" class="form-control form-control-solid" id="department_code_edit" name="department_code_edit">
                        </div>
                        <div class="col-xl-9 mb-2">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Position Name</label>
                            <input type="text" class="form-control form-control-solid" id="department_position_edit" name="department_position_edit" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_department_edit" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_department_adduser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <input type="hidden" id="departmentid" name="departmentid">
            <div class="modal-body">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Add User Department</h1>
                    <div class="text-muted fw-bold fs-5">Please Add User Department</div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-middle gs-0 gy-4 table-bordered" id="tablemasteruser">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="ps-4 rounded-start">Username</th>
                                    <th>Name</th>
                                    <th class="pe-4 text-end rounded-end">Actions</th>
                                </tr>
                                <tr>
                                    <th><input id="filterusername" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Username"></th>
                                    <th><input id="filtername" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Name"></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle" id="resultmasteruser"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>