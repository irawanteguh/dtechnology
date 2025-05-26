<div class="modal fade" id="modal_note_finance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Finance Note</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/paymentponew/paymentfinance/catatankeuangan" id="formcatatankeuangan">
                <input type="hidden" id="modal_note_finance_nopemesanan" name="modal_note_finance_nopemesanan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <textarea data-kt-autosize="true" class="form-control form-control-solid" name="modal_note_finance_catatan" id="modal_note_finance_catatan" placeholder="Silakan masukan catatan keuangan" required></textarea>
                        </div>                                        
                    </div>
                </div>
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_note_finance_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>
            </form> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal_finance_payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Payment</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/paymentponew/paymentfinance/payment" id="formpayment">
                <input type="hidden" id="modal_finance_payment_nopemesanan" name="modal_finance_payment_nopemesanan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Rekening Pengeluaran</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Rekening pengeluaran"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_finance_payment" data-placeholder="Please Select Rekening pengeluaran" class="form-select form-select-solid" name="modal_finance_payment_rekeningid" id="modal_finance_payment_rekeningid" required>
                                <?php echo $rekeningid;?>
                            </select>
                        </div>                                        
                    </div>
                </div>
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_finance_payment_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>
            </form> 
        </div>
    </div>
</div>