<div class="modal fade" id="modal_new_eticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/support/overview/neweticket" id="formneweticket">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add New E-Ticket</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Issue Id :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_new_eticket_transid" name="modal_new_eticket_transid" required readonly>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Subject :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_new_eticket_subject" name="modal_new_eticket_subject" required>
                        </div>
                    </div>
                    <div class="col-xl-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Description :</label>
                        <textarea class="form-control form-control-solid" name="modal_new_eticket_description" id="modal_new_eticket_description"></textarea>
                    </div>
                    <div class="form-group col-xl-12">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">Upload Document :</label>
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
                                    <span class="fw-bold fs-8 text-muted">Max File Size 2 Mb</span>
                                </div>
                            </div>
                        </div>   
                    </div> 
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_new_eticket" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>