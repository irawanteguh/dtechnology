<div class="modal fade" id="modal_detail_barang" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="no_pemesanan" name="no_pemesanan">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Goods Procurement Details</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-6 gy-2" id="tablemasterkaryawan">
						<thead>
							<tr class="fw-bolder text-muted bg-light align-middle">
								<th class="ps-4 rounded-start">Item Name</th>
                                <th>Category</th>
                                <th>Purchase Unit</th>
                                <th>Unit of Use</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">% VAT</th>
                                <th class="text-end">VAT</th>
								<th class="text-end">Grand Total</th>
								<th class="pe-4 text-end rounded-end">Note</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultdetail"></tbody>
                        <tfoot class="fw-bolder text-muted bg-light" id="resultdetailfoot"></tfoot>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload-buktibayar" tabindex="-1" aria-hidden="true">
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