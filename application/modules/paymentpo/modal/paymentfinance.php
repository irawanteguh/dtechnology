<div class="modal fade" id="modal-upload-invoice" tabindex="-1" aria-hidden="true">
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
            <form action="<?php echo base_url();?>index.php/logistik/request/noinvoice" id="forminvoice">
                <input type="hidden" id="no_pemesanan_invoice" name="no_pemesanan_invoice">
                <div class="modal-body">
                    <div class="text-start mb-5">
                        <div class="text-muted fw-bold fs-5">Silakan Upload Invoice</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Invoce No :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_upload_invoice_no" name="modal_upload_invoice_no" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-form-label" for="filektp">Upload Invoice</label>
                            <div class="dropzone" id="file_invoice">
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
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="formlampiran" type="submit" value="SUBMIT" name="simpan" >			
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
            <input type="hidden" id="no_pemesanan_buktibayar" name="no_pemesanan_buktibayar">
            <div class="modal-body">
                <div class="text-start mb-5">
                    <div class="text-muted fw-bold fs-5">Silakan Upload Bukti Transfer / Bayar</div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="filektp">Upload Bukti Transfer / Bayar</label>
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

<div class="modal fade" id="modal_print_po" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="no_pemesanan_po" name="no_pemesanan_po">
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
                    
                <table class="table align-middle" id="tableheader">
                    <tbody>
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
                            <td class="align-middle min-w-100px"><h6 id="suppliers"></h6></td>
                            <td class="align-middle min-w-100px">Print Date</td>
                            <td class="align-middle min-w-10px">:</td>
                            <td class="align-middle min-w-100px"><?php echo date('d.m.Y H:i:s'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive" style="margin-top:50px;">
					<table class="table align-middle table-row-dashed fs-6 gy-2" id="tablemasterkaryawan">
						<thead>
							<tr class="fw-bolder text-muted bg-light align-middle">
								<th class="ps-4 rounded-start">Item Name</th>
                                <th class="text-end">Qty</th>
								<th class="pe-4 text-end rounded-end">Note</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultdetailpo"></tbody>
					</table>
				</div>
                <table class="table table-bordered" style="margin-top:50px;">
                    <tbody class="text-center">
                        <tr>
                            <td></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/director.png'); ?>" class="h-60px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/vice.png'); ?>" class="h-60px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/finance.png'); ?>" class="h-60px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/manager.png'); ?>" class="h-60px"/></td>
                            <td><img alt="Logo" src="<?php echo base_url('assets/speciment/kains.png'); ?>" class="h-60px"/></td>
                        </tr>
                        <tr>
                            <td>Elsa Asmelia, SE</td>
                            <td>dr. Abdul Robby Azhadi MARS FISQua</td>
                            <td>dr. Leo Pratama Agung</td>
                            <td>Awang Debyansyah, S. Ak. M.M</td>
                            <td id="ttdmanager"></td>
                            <td id="ttdkains"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Director</td>
                            <td>Vice Director</td>
                            <td>Finance</td>
                            <td>Manager</td>
                            <td>Head Division</td>
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