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
                        <!-- <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Sub Total :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_finance_payment_nominal" name="modal_finance_payment_nominal">
                        </div>
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Pajak :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_finance_payment_nominal" name="modal_finance_payment_nominal">
                        </div> -->
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Total :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_finance_payment_nominal" name="modal_finance_payment_nominal">
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

<div class="modal fade" id="modal_upload_buktibayar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Upload Bukti Transfer / Bayar</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <input type="hidden" id="modal_upload_buktibayar_nopemesanan" name="modal_upload_buktibayar_nopemesanan">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="filektp">Upload Bukti Transfer / Bayar :</label>
                        <div class="dropzone" id="file_bukti_bayar">
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
            </div> 
        </div>
    </div>
</div>