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
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Quick Report Income</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label for="modal_quickreport_add_date" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Date:</label>
                            <input type="text" id="modal_quickreport_add_date" name="modal_quickreport_add_date" class="form-control form-control-solid flatpickr-input" placeholder="Pick a plan date" readonly>
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
                            <label class="d-flex align-items-center fs-6 fw-bold required">Medical Check Up:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Cash</div>
                                    <input type="text" id="MCUCASH" name="MCUCASH" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Invoice</div>
                                    <input type="text" id="MCUINV" name="MCUINV" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Lain-lain:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Penjualan Obat Bebas</div>
                                    <input type="text" id="POB" name="POB" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                                </div>
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

<div class="modal fade" id="modal_quickreport_addkunjungan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/sb/quickreport/addquickreportkunjungan" id="formquickreportkunjungan">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Quick Report Patient Visits</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label for="modal_quickreport_add_date" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Date:</label>
                            <input type="text" id="modal_quickreport_add_date_kunjungan" name="modal_quickreport_add_date_kunjungan" class="form-control form-control-solid flatpickr-input" placeholder="Pick a plan date" readonly>
                        </div>
                        <div class="col-xl-6 mb-5"></div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Umum:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="KURJ" name="KURJ" class="form-control form-control-solid" placeholder="0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="KURI" name="KURI" class="form-control form-control-solid" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Asuransi:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="KARJ" name="KARJ" class="form-control form-control-solid" placeholder="0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="KARI" name="KARI" class="form-control form-control-solid" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">BPJS:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Jalan</div>
                                    <input type="text" id="KBRJ" name="KBRJ" class="form-control form-control-solid" placeholder="0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Rawat Inap</div>
                                    <input type="text" id="KBRI" name="KBRI" class="form-control form-control-solid" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Medical Check Up:</label>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Cash</div>
                                    <input type="text" id="KMCUCASH" name="KMCUCASH" class="form-control form-control-solid" placeholder="0">
                                </div>
                                <div class="col-xl-6">
                                    <div class="fw-bold text-muted mb-2">Invoice</div>
                                    <input type="text" id="KMCUINV" name="KMCUINV" class="form-control form-control-solid" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_quickreport_addkunjungan_btn" type="submit" value="UPDATE" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>

<div class="modal fade" id="modal_quickreport_jurnal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/sb/quickreport/addjurnal" id="formaddjurnal">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Quick Report Pengeluaran</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="row">
                        <input type="hidden" id="coaid" name="coaid">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold required">Chart Of Accounting:</label>
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="fw-bold text-muted mb-2">Code</div>
                                    <input type="text" id="data_coacode" name="data_coacode" class="form-control form-control-solid">
                                </div>
                                <div class="col-xl-9">
                                    <div class="fw-bold text-muted mb-2">Name</div>
                                    <input type="text" id="data_coaname" name="data_coaname" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label for="modal_quickreport_jurnal_date" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Date:</label>
                            <input type="text" id="modal_quickreport_jurnal_date" name="modal_quickreport_jurnal_date" class="form-control form-control-solid flatpickr-input">
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label for="modal_quickreport_jurnal_debit" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Debit:</label>
                            <input type="text" id="modal_quickreport_jurnal_debit" name="modal_quickreport_jurnal_debit" class="form-control form-control-solid currency-rp" placeholder="Rp 0">
                        </div>
                    </div>

                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_quickreport_jurnal_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>