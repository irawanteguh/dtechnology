<div class="modal fade" id="modal_rekening_pemasukan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/rekening/mutasi/newpemasukan" id="formnewpemasukan">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Credit</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Rekening</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_rekening_pemasukan" data-placeholder="Please Select Rekening" class="form-select form-select-solid" name="modal_rekening_pemasukan_rekeningid" id="modal_rekening_pemasukan_rekeningid" required>
                                <?php echo $rekening;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Department</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_rekening_pemasukan" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_rekening_pemasukan_department" id="modal_rekening_pemasukan_department" required>
                                <?php echo $department;?>
                            </select>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_rekening_pemasukan_note" name="modal_rekening_pemasukan_note" required>
                        </div>
                        
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Credit :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_rekening_pemasukan_in" name="modal_rekening_pemasukan_in" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_rekening_pemasukan_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_rekening_pengeluaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/rekening/mutasi/newpengeluaran" id="formnewpengeluaran">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Debit</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Rekening</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_rekening_pengeluaran" data-placeholder="Please Select Rekening" class="form-select form-select-solid" name="modal_rekening_pengeluaran_rekeningid" id="modal_rekening_pengeluaran_rekeningid" required>
                                <?php echo $rekening;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Department</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_rekening_pengeluaran" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_rekening_pengeluaran_department" id="modal_rekening_pengeluaran_department" required>
                                <?php echo $department;?>
                            </select>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_rekening_pengeluaran_note" name="modal_rekening_pengeluaran_note" required>
                        </div>
                        
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Debit :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_rekening_pengeluaran_out" name="modal_rekening_pengeluaran_out" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_rekening_pengeluaran_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>