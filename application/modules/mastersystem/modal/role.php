<div class="modal fade" id="modal_role_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/role/addrole" id="formaddrole">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add a Role</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Role</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Role name</label>
                            <input type="text" class="form-control form-control-solid" id="data_role_name_add" name="data_role_name_add" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_role_add" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>