<div class="modal fade" id="modal_whatsapp_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/whatsapp/sessionwhatsapp/adddevice" id="formadddevice">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add New Device Mobile</h1>
                        <div class="text-muted fw-bold fs-5">
                            Add a new mobile device to manage WhatsApp session.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Device Name :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_whatsapp_add_name" name="modal_whatsapp_add_name" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_unit_cost_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_sessionwhatsapp_viewbarcode" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Scan QR dengan <i class="bi bi-whatsapp fa-1x text-success"></i> WhatsApp</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>

                <div class="text-center mb-5">
                    <h5 id="status">Status...</h5>
                    <!-- Wrapper untuk QR dan loader -->
                    <div id="qr-wrapper" class="position-relative d-inline-block mt-3">
                        <div id="qr"></div>
                        <div id="qr-loader"
                             class="position-absolute top-50 start-50 translate-middle"
                             style="z-index: 10; display: none;">
                            <div class="spinner-border text-success" role="status">
                                <span class="visually-hidden">Loading QR...</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
