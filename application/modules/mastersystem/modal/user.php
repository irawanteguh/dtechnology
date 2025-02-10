<div class="modal fade" id="modal_user_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/user/adduser" id="formadduser">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Master User</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Master User</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Username</label>
                            <input type="text" class="form-control form-control-solid" id="data_user_username_add" name="data_user_username_add" required>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_user_name_add" name="data_user_name_add" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_user_add" type="submit" value="SIMPAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_user_add_assistant" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <input type="hidden" id="userid" name="userid">
            <div class="modal-body">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Add Assistant User</h1>
                    <div class="text-muted fw-bold fs-5">Please Add Assistant User</div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-middle gs-0 gy-4 table-bordered" id="tablemasteruserassistant">
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
                            <tbody class="align-middle" id="resultmasteruserassistant"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>