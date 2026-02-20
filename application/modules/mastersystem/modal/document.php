<div class="modal fade" id="modal_document_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/mastersystem/document/documentadd" id="formdocumentadd">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Master Type Document</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Master Type Document</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Code</label>
                            <input type="text" class="form-control form-control-solid" id="modal_document_add_code" name="modal_document_add_code" placeholder="Please enter your code">
                        </div>
                        <div class="col-xl-9 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Type Document</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Type Document"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_document_add" data-placeholder="Type Document" class="form-select form-select-solid" name="modal_document_add_type" id="modal_document_add_type" required>
								<?php echo $mastertypedocument;?>
							</select>
						</div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Type Document</label>
                            <input type="text" class="form-control form-control-solid" id="modal_document_add_name" name="modal_document_add_name" placeholder="Please enter your type" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_document_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>
