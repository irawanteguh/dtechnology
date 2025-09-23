<div class="modal fade" id="modal_new_po" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistiknew/request/newpurchaseorder" id="formnewpurchaseorder">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add New Purchase Order</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nama Pengadaan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_new_request_nama" name="modal_new_request_nama" required>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Unit Pelaksana</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Department"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_new_po" data-placeholder="Please Select Department" class="form-select form-select-solid" name="modal_new_request_department" id="modal_new_request_department" required>
                                <?php echo $department;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Supplier</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Suppliers"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_new_po" data-placeholder="Please Select Suppliers" class="form-select form-select-solid" name="modal_new_request_supplier" id="modal_new_request_supplier" required>
                                <?php echo $mastersupplier;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Jenis Pengadaan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Method"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_new_po" data-placeholder="Please Select Method" class="form-select form-select-solid" name="modal_new_request_method" id="modal_new_request_method" required>
                                <?php echo $jenispengadaan;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Note :</label>
                        <textarea class="form-control form-control-solid" name="modal_new_request_note" id="modal_new_request_note"></textarea>
                    </div>
                    <div class="col-xl-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">Classification :</label>
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="Y" name="modal_new_request_cito" id="modal_new_request_cito" />
                            <label class="form-check-label">CITO</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_new_po_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_upload_lampiran" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Upload Document</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistiknew/request/uploadlampiran" id="formnotelampiran" enctype="multipart/form-data">
                <input type="hidden" id="modal_upload_lampiran_nopemesanan" name="modal_upload_lampiran_nopemesanan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="col-form-label required">Note :</label>
                            <textarea class="form-control form-control-solid" name="modal_upload_lampiran_note" id="modal_upload_lampiran_note"></textarea>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="col-form-label required">Upload Document :</label>
                            <input type="file" class="form-control form-control-lg" name="modal_upload_doc_file" id="modal_upload_doc_file" accept=".pdf" required>
                        </div>                                         
                    </div>
                </div>
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_upload_lampiran_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>
            </form> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal_upload_invoice" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Upload Invoice</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistiknew/request/uploadinvoice" id="formuploadinvoice" enctype="multipart/form-data">
                <input type="hidden" id="modal_upload_invoice_nopemesanan" name="modal_upload_invoice_nopemesanan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="col-form-label required">Invoce No :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_upload_invoice_invoiceno" name="modal_upload_invoice_invoiceno" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="col-form-label required">Upload Invoice :</label>
                            <input type="file" class="form-control form-control-lg" name="modal_upload_invoice_file" id="modal_upload_invoice_file" accept=".pdf" required>
                        </div>                                       
                    </div>
                </div>
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_upload_invoice_btn" type="submit" value="SUBMIT" name="simpan" >			
                </div>
            </form> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modal_add_item_nopemesanan" name="modal_add_item_nopemesanan">
                <input type="hidden" id="modal_add_item_departmentid" name="modal_add_item_departmentid">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Add Item</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2" id="tablemasterbarang">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">Item Name</th>
                                <th>Category</th>
                                <th>Purchase Unit</th>
                                <th class="text-end">Stock</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">% Vat</th>
                                <th class="text-end">Vat</th>
                                <th class="text-end">Grand Total</th>
								<th class="pe-4 text-end rounded-end">Note</th>
                            </tr>
                            <tr>
                                <th><input id="filteritemname" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Item Name"></th>
                                <th><input id="filtercategory" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Category"></th>
                                <th><input id="filterunit"     class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Purchase Unit"></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600" id="resultmasterbarang"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_print_po" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="no_pemesanan_po" name="no_pemesanan_po">
                <div class="text-center mb-4">
                    <div class="row align-items-center">
                        <div class="col-3 text-start">
                            <img alt="Logo" src="<?php echo base_url('assets/images/clients/'.ORG_ID.'.png'); ?>" class="h-70px"/>
                        </div>
                        <div class="col-6">
                            <h2 class="fw-bolder mb-1">PURCHASE REQUEST</h2>
                            <div class="text-muted fs-6" id="orgname"></div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <td class="fw-bold">Purchase No</td>
                            <td id="pono"></td>
                            <td class="fw-bold">Order Date</td>
                            <td id="orderdate"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Supplier</td>
                            <td><span id="suppliers"></span></td>
                            <td class="fw-bold">Print Date</td>
                            <td><?php echo date('d.m.Y H:i:s'); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead class="bg-light text-center">
                            <tr>
                                <th class="text-start ps-4" style="width:50%">Item Name</th>
                                <th class="text-end" style="width:15%">Qty</th>
                                <th class="text-end pe-4" style="width:35%">Note</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdetailpo"></tbody>
                    </table>
                </div>

                <table class="table table-bordered text-center mt-5 align-middle">
                    <tbody>
                        <tr>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/director.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/vice.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/director.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/vice.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/finance.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/manager.png'); ?>" class="h-60px"/></td>
                            <td><div style="height:70px"></div><img src="<?php echo base_url('assets/speciment/kains.png'); ?>" class="h-60px"/></td>
                        </tr>
                        <tr class="fw-bold">
                            <td><span id="ttdcmo"></span><br><small>Chief Medical Officer</small></td>
                            <td><span id="ttdcfo"></span><br><small>Chief Financial Officer</small></td>
                            <td><span id="ttddirector"></span><br><small>Director</small></td>
                            <td><span id="ttdfinance"></span><br><small>Finance</small></td>
                            <td><span id="ttdmanager"></span><br><small>Manager</small></td>
                            <td><span id="ttdcoordinator"></span><br><small>Coordinator</small></td>
                            <td><span id="ttdkains"></span><br><small>Head Division</small></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer p-1">	
                <button class="btn btn-light-primary" onclick="printPDF()">PRINT PDF</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_penerimaan_barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Penerimaan Barang</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="text-end mb-5">
                    <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal_add_penerimaan_barang">Tambah Penerimaaan Barang</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2" id="tablemasterbarang">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start">No Penerimaan</th>
                                <th>No Surat Jalan</th>
                                <th>Catatan</th>
                                <th class="text-end">Sub Total</th>
                                <th class="text-end">Ppn</th>
                                <th class="text-end">Total</th>
                                <th class="text-end">Di terima oleh</th>
								<th class="pe-4 text-end rounded-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600" id="resultdatapenerimaan"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_penerimaan_barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistiknew/request/newsuratjalan" id="formnewsuratjalan">
                <div class="modal-body">
                    <input type="hidden" id="no_pemesanan_penerimaan" name="no_pemesanan_penerimaan">
                    <input type="hidden" id="no_pemesanan_department" name="no_pemesanan_department">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Penerimaan Surat Jalan Supplier</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">No Surat Jalan :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_add_penerimaan_barang_nosurat" name="modal_add_penerimaan_barang_nosurat" required>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Catatan :</label>
                            <textarea class="form-control form-control-solid" name="modal_add_penerimaan_barang_note" id="modal_add_penerimaan_barang_note" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_add_penerimaan_barang_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_penerimaan_item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modal_add_item_nopemesanan" name="modal_add_item_nopemesanan">
                <input type="hidden" id="modal_add_item_nopenerimaan" name="modal_add_item_nopenerimaan">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Penerimaan Item Barang</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-8 gy-2">
						<thead>
                            <tr class="fw-bolder bg-light align-middle text-center">
                                <th class="bg-dark text-white ps-4 rounded-start" rowspan="2">Item Name</th>
                                <th class="bg-primary text-white" colspan="6">Pengajuan</th>
                                <th class="bg-danger text-white" rowspan="2">Total Penerimaan</th>
                                <th class="bg-success text-white rounded-end" colspan="6">Penerimaan</th>
                            </tr>
							<tr class="fw-bolder text-white bg-light align-middle">
                                <th class="bg-primary text-end">Qty</th>
                                <th class="bg-primary text-end">Harga</th>
                                <th class="bg-primary text-end">Ppn</th>
                                <th class="bg-primary text-end">Harga Ppn</th>
                                <th class="bg-primary text-end">Total</th>
                                <th class="bg-primary">Catatan</th>
                                <th class="bg-success text-end">Qty</th>
                                <th class="bg-success text-end">Harga</th>
                                <th class="bg-success text-end">Ppn</th>
                                <th class="bg-success text-end">Harga Ppn</th>
                                <th class="bg-success pe-4 text-end rounded-end">Total</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultdetailpembelian"></tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>