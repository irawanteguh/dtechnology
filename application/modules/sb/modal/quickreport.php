<div class="modal fade" id="modal_quickreport_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <h1 class="mb-3">Quick Report Income</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Date</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_register_add_date" id="modal_register_add_date" placeholder="Pick a plan date"  type="text" required>
                            </div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-6 mb-5">
                                <div class="fv-row">
                                    <label class="fs-6 fw-bold required">Umum</label>
                                    <div class="fw-bold text-muted">Rawat Jalan</div>
                                    <div class="position-relative" id="kt_modal_create_project_budget_setup" data-kt-dialer="true" data-kt-dialer-min="50" data-kt-dialer-max="50000" data-kt-dialer-step="100" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                        
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                                </svg>
                                            </span>
                                        </button>

                                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="budget_setup" readonly="readonly" value="Rp. 0">
                                        
                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                                </svg>
                                            </span>
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="fv-row">
                                    <label class="fs-6 fw-bold required">Umum</label>
                                    <div class="fw-bold text-muted">Rawat Inap</div>
                                    <input class="form-control form-control-solid" name="modal_register_add_timein" id="modal_register_add_timein" placeholder="Pick a time in"  type="text" required>
                                </div>
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