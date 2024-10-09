<div class="modal fade" id="modal_sign_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/tilaka/repodocument/signdocument" id="formsigndocument">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Sign Document</h1>
                        <div class="text-muted fw-bold fs-5">Please Sign Document</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Document Type</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Document Type"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_sign_add" data-placeholder="Please Select Document Type" class="form-select form-select-solid" name="modal_sign_add_document_type" id="modal_sign_add_document_type" required>
								<?php echo $document;?>
							</select>
						</div>
                        <div class="col-md-12 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Assign</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Assign"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_sign_add" data-placeholder="Please Select Assign" class="form-select form-select-solid" name="modal_sign_add_assign" id="modal_sign_add_assign" required>
								<?php echo $assign;?>
							</select>
						</div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Information 1 :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sign_add_informasi1" name="modal_sign_add_informasi1" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Information 2 :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sign_add_informasi2" name="modal_sign_add_informasi2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_sign_document" type="submit" value="SAVE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_upload_document" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Upload Document</h1>
                    <div class="text-muted fw-bold fs-5">Please Upload Document</div>
                </div>
                <div class="row">
                    <div class="form-group col-xl-12">
                        <div class="dropzone" id="file_doc">
                            <div class="dz-message needsclick">
                                <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 12.6L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L8 12.6H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V12.6H16Z" fill="black" />
                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                    </svg>
                                </span>
                                <div class="ms-4">
                                    <h3 class="dfs-3 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fw-bold fs-8 text-muted">File Document Dalam Format .Pdf</span><br>
                                    <span class="fw-bold fs-8 text-muted">Max File Size 10 Mb</span>
                                </div>
                            </div>
                        </div>   
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>