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
                        <div class="col-md-4 mb-5">
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
                        <div class="col-md-3 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Provider</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Primary Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_activity_add" data-placeholder="Select a Primary Activity..." class="form-select form-select-solid" name="data_activity_primaryactivity_add" id="data_activity_primaryactivity_add">
                                    <?php echo $activity;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Operator</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Primary Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Select a Primary Activity..." class="form-select form-select-solid" name="data_activity_primaryactivity_add" id="data_activity_primaryactivity_add">
                                    <?php echo $activity;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Anesthesiologist</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Primary Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Select a Primary Activity..." class="form-select form-select-solid" name="data_activity_primaryactivity_add" id="data_activity_primaryactivity_add">
                                    <?php echo $activity;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Pediatrician</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Primary Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_add_plan" data-placeholder="Select a Primary Activity..." class="form-select form-select-solid" name="data_activity_primaryactivity_add" id="data_activity_primaryactivity_add">
                                    <?php echo $activity;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Medical Treatment</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Masukan Detail Kegiatan Anda"></i>
                                </label>
                                <textarea data-kt-autosize="true" class="form-control form-control-solid" name="data_activity_description_add" id="data_activity_description_add" placeholder="Silakan masukan kegiatan anda secara detail"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Classification :</label>
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="Y" name="modal_new_request_cito" id="modal_new_request_cito" />
                                <label class="form-check-label">CITO</label>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="btn_activity_add" type="submit" value="SUBMIT" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>