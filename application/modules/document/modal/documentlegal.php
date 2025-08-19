<div class="modal fade" id="modal_repository_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/document/documentlegal/adddocumentlegal" id="formadddocumentlegal">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Repository Document</h1>
                        <div class="text-muted fw-bold fs-5">Please fill in this form</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Jenis Dokumen</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Document Type"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_repository_add" data-placeholder="Please Select Document Type" class="form-select form-select-solid" name="modal_repository_add_type" id="modal_repository_add_type" required>
								<?php echo $document;?>
							</select>
						</div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Nama Dokumen</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <input class="form-control form-control-solid" name="modal_repository_add_name" id="modal_repository_add_name"/>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Catatan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_repository_add_catatan" name="modal_repository_add_catatan" required>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="fs-6 fw-bold mb-2">Tanggal Berlaku</label>
                            <input class="form-control form-control-solid flatpickr-input" name="modal_repository_add_datestart" id="modal_repository_add_datestart" type="text">
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="fs-6 fw-bold mb-2">Berlaku Sampai Dengan</label>
                            <input class="form-control form-control-solid flatpickr-input" name="modal_repository_add_dateend" id="modal_repository_add_dateend" type="text">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Upload Dokumen :</label>
                            <input type="file" class="form-control" name="modal_repository_add_file" id="modal_repository_add_file" accept=".pdf" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_repository_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>