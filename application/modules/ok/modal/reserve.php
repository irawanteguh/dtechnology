<div class="modal fade" id="modal_add_plan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/ok/reserve/newreserve" id="formnewreserve">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Add Planning Schedule Operating Room</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-3 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Date</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_add_plan_date" placeholder="Pick a plan date" id="modal_add_plan_date" type="text">
                            </div>
                        </div>
                        <div class="col-md-5 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Patient Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Patient Name"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Patient Name..." class="form-select form-select-solid" name="modal_add_plan_patientid" id="modal_add_plan_patientid">
                                    <?php echo $patientid;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Provider</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Provider"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Provider..." class="form-select form-select-solid" name="modal_add_plan_provider" id="modal_add_plan_provider">
                                    <?php echo $provider;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Operator</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Operator"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Doctor Operator..." class="form-select form-select-solid" name="modal_add_plan_dokter_opr" id="modal_add_plan_dokter_opr">
                                    <?php echo $dokteropr;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Anesthesiologist</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Anesthesiologist"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Doctor Anesthesiologist..." class="form-select form-select-solid" name="modal_add_plan_dokter_ans" id="modal_add_plan_dokter_ans">
                                    <?php echo $dokterans;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span>Pediatrician</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Doctor Pediatrician"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Doctor Pediatrician..." class="form-select form-select-solid" name="modal_add_plan_dokter_ank" id="modal_add_plan_dokter_ank">
                                    <?php echo $dokterank;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Diagnosis</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter diagnosis"></i>
                                </label>
                                <textarea data-kt-autosize="true" class="form-control form-control-solid" name="modal_add_plan_diagnosis" id="modal_add_plan_diagnosis" placeholder="Please Enter diagnosis"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Medical Treatment</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter the Type of Medical Treatment"></i>
                                </label>
                                <textarea data-kt-autosize="true" class="form-control form-control-solid" name="modal_add_plan_tindakan" id="modal_add_plan_tindakan" placeholder="Please Enter the Type of Medical Treatment"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span>Package Medical Treatment</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select Package Medical Treatment"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Please Select Package Medical Treatment..." class="form-select form-select-solid" name="modal_add_plan_package" id="modal_add_plan_package">
                                    <?php echo $package;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Benefit</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Enter benefit"></i>
                                </label>
                                <textarea data-kt-autosize="true" class="form-control form-control-solid" name="modal_add_plan_benefit" id="modal_add_plan_benefit" placeholder="Please Enter benefit"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Classification :</label>
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="Y" name="modal_add_plan_cito" id="modal_add_plan_cito" />
                                <label class="form-check-label">CITO</label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_add_plan_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>

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