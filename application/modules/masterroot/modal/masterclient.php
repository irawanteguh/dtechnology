<div class="modal fade" id="modal_client_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/masterclient/addclient" id="formaddclient">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Master Client</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Master Client</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Organization Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_client_name_add" name="data_client_name_add" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Website</label>
                            <input type="text" class="form-control form-control-solid" id="data_client_website_add" name="data_client_website_add">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_client_add" type="submit" value="SIMPAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_client_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/masterclient/updateclient" id="formeditclient">
                <input type="hidden" id="data_client_orgid_edit" name="data_client_orgid_edit">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Edit Master Client</h1>
                        <div class="text-muted fw-bold fs-5">Are You Sure You Want to Make Data Changes ?</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Organization Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_client_name_edit" name="data_client_name_edit" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Website</label>
                            <input type="text" class="form-control form-control-solid" id="data_client_website_edit" name="data_client_website_edit">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_client_edit" type="submit" value="SIMPAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>