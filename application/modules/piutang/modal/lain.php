<div class="modal fade" id="modal_mcu_invoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/piutang/lain/newinvoice" id="formnewinvoice">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">New Invoice Lainnya</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">No Tagihan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_notagihan" name="modal_mcu_invoice_notagihan" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Tanggal Tagihan :</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_mcu_invoice_date" placeholder="Pick a date invoice" id="modal_mcu_invoice_date" type="text">
                            </div>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_note" name="modal_mcu_invoice_note" required>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Jumlah Tagihan :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_mcu_invoice_tagihan" name="modal_mcu_invoice_tagihan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_mcu_invoice_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_mcu_pembayaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/piutang/lain/pembayaran" id="formpembayaran">
                <input type="hidden" id="modal_mcu_pembayaran_piutangid" name="modal_mcu_pembayaran_piutangid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Pembayaran Piutang Lainnya</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Rekening</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Rekening"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_pembayaran" data-placeholder="Please Select Rekening" class="form-select form-select-solid" name="modal_mcu_pembayaran_rekeningid" id="modal_mcu_pembayaran_rekeningid" required>
                                <?php echo $rekening;?>
                            </select>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Department</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_pembayaran" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_mcu_pembayaran_departmentid" id="modal_mcu_pembayaran_departmentid" required>
                                <?php echo $department;?>
                            </select>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Tanggal Pembayaran :</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_mcu_pembayaran_date" placeholder="Pick a date payment" id="modal_mcu_pembayaran_date" type="text">
                            </div>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_pembayaran_note" name="modal_mcu_pembayaran_note" required>
                        </div>
                        
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Jumlah Pembayaran :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_mcu_pembayaran_in" name="modal_mcu_pembayaran_in" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_mcu_pembayaran_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>