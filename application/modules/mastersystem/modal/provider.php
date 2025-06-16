<div class="modal fade" id="modal_provider_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/provider/provideradd" id="provideradd">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Master Provider</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Master Provider</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Code</label>
                            <input type="text" class="form-control form-control-solid" id="modal_provider_add_code" name="modal_provider_add_code" placeholder="Please enter your code" required>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Name Provider</label>
                            <input type="text" class="form-control form-control-solid" id="modal_provider_add_provider" name="modal_provider_add_provider" placeholder="Please enter your type" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_provider_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>
