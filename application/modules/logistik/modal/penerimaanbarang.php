
<div class="modal fade" id="modal_detail_barang" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="no_pemesanan" name="no_pemesanan">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Accept Goods Procurement Details</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-6 gy-2">
						<thead>
							<tr class="fw-bolder text-muted bg-light align-middle">
								<th class="ps-4 rounded-start">Item Name</th>
                                <th>Category</th>
                                <th>Purchase Unit</th>
                                <th>Unit of Use</th>
                                <th class="text-end">Qty Order</th>
                                <th class="text-end">Last Accept</th>
                                <th class="pe-4 text-end rounded-end">Accept Stock</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultdetail"></tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>