<div class="modal fade" id="modal_buku_dagang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/bukudagang/bukudagang/updatedata" id="updatedata">
                <input type="hidden" id="modal_buku_dagang_bukuid" name="modal_buku_dagang_bukuid">
                <input type="hidden" id="modal_buku_dagang_periodeid" name="modal_buku_dagang_periodeid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Update Data Buku Dagang</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Estimasi :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_buku_dagang_estimasi" name="modal_buku_dagang_estimasi">
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Penerimaan :</label>
                            <input type="text" class="form-control form-control-solid currency-rp" id="modal_buku_dagang_penerimaan" name="modal_buku_dagang_penerimaan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_buku_dagang_btn" type="submit" value="UPDATE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_buku_dagang_detail" tabindex="-1" aria-hidden="true">
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
                    <h1 class="mb-3">Rincian Transaksi</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted align-middle bg-light">
                                <th class="ps-4 rounded-start">No invoice</th>
                                <th>Catatan</th>
                                <th>Rekanan</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Tanggal Tagihan</th>
                                <th class="text-end">Tagihan</th>
                                <th class="text-end">Terbayar</th>
                                <th class="text-end">Sisa Tagihan</th>
                                <th class="text-end pe-4">Diperbaharui Oleh</th>
                            </tr>
                            
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatadetail"></tbody>
                        <tfoot class="text-gray-600 fw-bold bg-light" id="resulttotaldetail"></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>