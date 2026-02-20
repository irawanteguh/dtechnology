<div class="modal fade" id="modal_cancelled" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Cancelled Planning Schedule Operating Room</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/ok/reserve/cancelled" id="formcancelled">
                <input type="hidden" id="modal_cancelled_operasiid" name="modal_cancelled_operasiid">
                <div class="modal-body">
                    <div class="text-start mb-5">
                        <div class="text-muted fw-bold fs-5">Please Select a Reason</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 row">
                            <div class="col-md-12 mb-5">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Reason</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Reason Cancelled"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_cancelled" data-placeholder="Please Select Reason Cancelled" class="form-select form-select-solid" name="modal_cancelled_reason" id="modal_cancelled_reason" required>
                                    <?php echo $reason;?>
                                </select>
                            </div>
                        </div>                                        
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-danger" id="modal_cancelled_btn" type="submit" value="CANCELLED" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>

<div class="modal fade" id="modal_register_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/ok/reserve/editrequest" id="formeditrequest">
                <input type="hidden" id="modal_register_add_operasiid" name="modal_register_add_operasiid">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Register Operating Room</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-2 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Date</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_register_add_date" id="modal_register_add_date" placeholder="Pick a plan date"  type="text" required>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Time In</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_register_add_timein" id="modal_register_add_timein" placeholder="Pick a time in"  type="text" required>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Time Out</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_register_add_timeout" id="modal_register_add_timeout" placeholder="Pick a time out"  type="text" required>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Room</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Patient Name"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_reserve_register" data-placeholder="Please Select Patient Name..." class="form-select form-select-solid" name="modal_reserve_register_pasienid" id="modal_reserve_register_pasienid" disabled>
                                    <?php echo $pasienid;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Patient Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Patient Name"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_reserve_register" data-placeholder="Please Select Patient Name..." class="form-select form-select-solid" name="modal_reserve_register_pasienid" id="modal_reserve_register_pasienid" disabled>
                                    <?php echo $pasienid;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Operator</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Operator"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_reserve_edit" data-placeholder="Please Select Doctor Operator..." class="form-select form-select-solid" name="modal_reserve_request_dokteropr_edit" id="modal_reserve_request_dokteropr_edit">
                                    <?php echo $dokteropr;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Anesthesiologist</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Operator"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_reserve_edit" data-placeholder="Please Select Doctor Operator..." class="form-select form-select-solid" name="modal_reserve_request_dokteropr_edit" id="modal_reserve_request_dokteropr_edit">
                                    <?php echo $dokteropr;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Pediatrician</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Operator"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_reserve_edit" data-placeholder="Please Select Doctor Operator..." class="form-select form-select-solid" name="modal_reserve_request_dokteropr_edit" id="modal_reserve_request_dokteropr_edit">
                                    <?php echo $dokteropr;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Diagnosis</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter diagnosis"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_diagnosis_edit" id="modal_reserve_request_diagnosis_edit" placeholder="Please Enter diagnosis"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Basic Diagnosis</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter basic diagnosis"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_basicdiagnosis_edit" id="modal_reserve_request_basicdiagnosis_edit" placeholder="Please Enter basic diagnosis"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Medical Treatment</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Medical Treatment"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_medicaltreatment_edit" id="modal_reserve_request_medicaltreatment_edit" placeholder="Please Enter Medical Treatment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Indication for Medical Treatment</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Indication for Medical Treatment"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_indicationmedicaltreatment_edit" id="modal_reserve_request_indicationmedicaltreatment_edit" placeholder="Please Enter Indication for Medical Treatment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Medical Procedures</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Medical Procedures"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_procedures_edit" id="modal_reserve_request_procedures_edit" placeholder="Please Enter Medical Procedures"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Purpose of Medical Action</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Purpose of Medical Action"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_purpose_edit" id="modal_reserve_request_purpose_edit" placeholder="Please Enter Purpose of Medical Action"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Risks and Complications</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Risks and Complications"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_risk_edit" id="modal_reserve_request_risk_edit" placeholder="Please Enter Risks and Complications"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Prognosis</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Prognosis"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_prognosis_edit" id="modal_reserve_request_prognosis_edit" placeholder="Please Enter Prognosis"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Alternatives and Risks</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Alternatives and Risks"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_alternatives_edit" id="modal_reserve_request_alternatives_edit" placeholder="Please Enter Alternatives and Risks"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Things to save the patient</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter Things to save the patient"></i>
                                </label>
                                <textarea rows="5" class="form-control form-control-solid" name="modal_reserve_request_save_edit" id="modal_reserve_request_save_edit" placeholder="Please Enter Things to save the patient"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Classification :</label>
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="Y" name="modal_reserve_request_cito_edit" id="modal_reserve_request_cito_edit" />
                                <label class="form-check-label">CITO</label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_reserve_edit_btn" type="submit" value="UPDATE" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>