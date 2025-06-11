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
            <form action="<?php echo base_url();?>index.php/piutang/mcu/newinvoicemcu" id="formnewinvoicemcu">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">New Invoice Medical Check Up</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">No Tagihan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_notagihan" name="modal_mcu_invoice_notagihan" required>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Tanggal Tagihan :</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_mcu_invoice_date" placeholder="Pick a date invoice" id="modal_mcu_invoice_date" type="text">
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Periode Penagihan :</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Periode"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_invoice" data-placeholder="Please Select Periode" class="form-select form-select-solid" name="modal_mcu_invoice_periodeid" id="modal_mcu_invoice_periodeid" required>
                                <?php echo $periode;?>
                            </select>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_note" name="modal_mcu_invoice_note" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Provider :</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_invoice" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_mcu_invoice_provider" id="modal_mcu_invoice_provider" required>
                                <?php echo $provider;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
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

<div class="modal fade" id="modal_mcu_invoice_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/piutang/mcu/editinvoicemcu" id="editinvoicemcu">
                <input type="hidden" id="modal_mcu_invoice_edit_piutangid" name="modal_mcu_invoice_edit_piutangid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Invoice Medical Check Up</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">No Tagihan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_edit_notagihan" name="modal_mcu_invoice_edit_notagihan" required>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Tanggal Tagihan :</label>
                                <input class="form-control form-control-solid flatpickr-input" name="modal_mcu_invoice_edit_date" placeholder="Pick a date invoice" id="modal_mcu_invoice_edit_date" type="text" required>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Periode Penagihan :</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Periode"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_invoice_edit" data-placeholder="Please Select Periode" class="form-select form-select-solid" name="modal_mcu_invoice_edit_periodeid" id="modal_mcu_invoice_edit_periodeid" required>
                                <?php echo $periode;?>
                            </select>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_mcu_invoice_edit_note" name="modal_mcu_invoice_edit_note" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Provider :</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Provider"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_mcu_invoice_edit" data-placeholder="Please Select Provider" class="form-select form-select-solid" name="modal_mcu_invoice_edit_provider" id="modal_mcu_invoice_edit_provider" required>
                                <?php echo $provider;?>
                            </select>
                        </div>
                        
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Jumlah Tagihan :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_mcu_invoice_edit_tagihan" name="modal_mcu_invoice_edit_tagihan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_bpjs_invoice_edit_btn" type="submit" value="UPDATE" name="simpan" >
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
            <form action="<?php echo base_url();?>index.php/piutang/mcu/pembayaran" id="formpembayaran">
                <input type="hidden" id="modal_mcu_pembayaran_piutangid" name="modal_mcu_pembayaran_piutangid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Pembayaran Piutang Medical Check Up</h1>
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

<div class="modal fade" id="modal_mcu_upload_invoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Upload Invoice Medical Check Up</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="dropzone" id="file_invoice_mcu">
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