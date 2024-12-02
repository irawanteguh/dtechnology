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
                <input type="hidden" id="headerid" name="headerid">
                <input type="hidden" id="levelid" name="levelid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Sub Department</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Sub Department</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Department name</label>
                            <input type="text" class="form-control form-control-solid" id="department_name" name="department_name" required>
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
                        <table class="table align-middle gs-0 gy-4 table-bordered" id="tablemastermodules">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="ps-4 rounded-start">Username</th>
                                    <th>Name</th>
                                    <th class="pe-4 text-end rounded-end">Actions</th>
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