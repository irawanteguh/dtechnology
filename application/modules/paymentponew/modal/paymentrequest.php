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

<!-- <div class="modal fade" id="modal_print_po" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="modal_print_po_nopemesanan" name="modal_print_po_nopemesanan">
                <div class="text-center mb-5">
                    <div class="col-md-12 row">
                        <div class="col-md-4 d-flex justify-content-start">
                            <img alt="Logo" src="<?php echo base_url('assets/images/clients/'.ORG_ID.'.png'); ?>" class="h-60px"/>
                        </div>
                        <div class="col-md-4">
                            <h1 class="mb-3">Purchase Request</h1>
                            <div class="text-muted fw-bold fs-5"></div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
                    
                <table class="table align-middle fs-8 gy-2">
                    <tbody class="text-gray-600 fw-bold">
                        <tr>
                            <td class="align-middle min-w-100px">Purchase No</td>
                            <td class="align-middle min-w-10px">:</td>
                            <td class="align-middle min-w-100px" id="pono"></td>
                            <td class="align-middle min-w-100px">Order Date</td>
                            <td class="align-middle min-w-10px">:</td>
                            <td class="align-middle min-w-100px" id="orderdate"></td>
                        </tr>
                        <tr>
                            <td class="align-middle min-w-100px">Suppliers</td>
                            <td class="align-middle min-w-10px">:</td>
                            <td class="align-middle min-w-100px" id="suppliers"></td>
                            <td class="align-middle min-w-100px">Print Date</td>
                            <td class="align-middle min-w-10px">:</td>
                            <td class="align-middle min-w-100px"><?php echo date('d.m.Y H:i:s'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive" style="margin-top:50px;">
					<table class="table align-middle table-row-dashed fs-8 gy-2">
						<thead>
							<tr class="fw-bolder text-muted bg-light align-middle">
								<th class="ps-4 rounded-start">Item Name</th>
                                <th>Note</th>
								<th class="pe-4 text-end rounded-end">Qty</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultdetailpo"></tbody>
					</table>
				</div>
                <table class="table table-bordered fs-8" style="margin-top:50px;">
                    <tbody class="text-center align-content-center">
                        <tr>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/commissioner.png'); ?>" class="h-50px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/director.png'); ?>" class="h-50px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/vice.png'); ?>" class="h-50px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/finance.png'); ?>" class="h-50px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/manager.png'); ?>" class="h-50px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/kains.png'); ?>" class="h-50px"/></td>
                        </tr>
                        <tr>
                            <td>Elsa Asmelia, SE<br>Commissioner</td>
                            <td>dr. Abdul Robby Azhadi MARS FISQua<br>Director</td>
                            <td>dr. Leo Pratama Agung<br>Vice Director</td>
                            <td>Awang Debyansyah, S. Ak. M.M<br>Finance</td>
                            <td><div id="ttdmanager"></div>Manager</td>
                            <td><div id="ttdkains"></div>Head Division</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer p-1">	
                <button class="btn btn-light-primary" onclick="printPDF()">PRINT PDF</button>
            </div>
        </div>
    </div>
</div> -->

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