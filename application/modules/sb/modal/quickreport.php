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
            <form action="<?php echo base_url();?>index.php/sb/quickreport/addquickreport" id="formquickreport">
                <input type="hidden" id="modal_register_add_operasiid" name="modal_register_add_operasiid">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Quick Report Income</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label for="modal_quickreport_add_date" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Date:</label>
                            <input type="text" id="modal_quickreport_add_date" name="modal_quickreport_add_date" class="form-control form-control-solid flatpickr-input" placeholder="Pick a plan date" required>
                        </div>
                        <div class="col-xl-6 mb-5"></div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Umum:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="URJ" name="URJ" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="URI" name="URI" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Asuransi:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="ARJ" name="ARJ" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="ARI" name="ARI" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">BPJS:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="BRJ" name="BRJ" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="BRI" name="BRI" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Lain-lain:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Kerjasama</div>
                                    <input type="text" id="LAIN" name="LAIN" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_quickreport_add_btn" type="submit" value="UPDATE" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>