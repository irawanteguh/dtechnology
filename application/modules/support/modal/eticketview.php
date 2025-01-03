<div class="modal fade" id="modal_followup_eticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/support/eticketview/followup" id="formfollowup">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Follow Up E-Ticket</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Issue Id :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_followup_eticket_transid" name="modal_followup_eticket_transid" readonly>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Subject :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_followup_eticket_subject" name="modal_followup_eticket_subject" readonly>
                        </div>
                    </div>
                    <div class="col-xl-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Description :</label>
                        <textarea class="form-control form-control-solid" name="modal_followup_eticket_description" id="modal_followup_eticket_description" readonly></textarea>
                    </div>
                    <div class="col-xl-12 mb-5 row">
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Severity</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Severity"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_followup_eticket" data-placeholder="Please Select Severity" class="form-select form-select-solid" name="modal_followup_eticket_severity" id="modal_followup_eticket_severity" required>
                                <?php echo $masterseverity;?>
                            </select>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Category</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Category"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_followup_eticket" data-placeholder="Please Select Category" class="form-select form-select-solid" name="modal_followup_eticket_pic" id="modal_followup_eticket_pic" required>
                                <?php echo $masterpic;?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_followup_eticket" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>