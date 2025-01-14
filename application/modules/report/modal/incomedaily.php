<div class="modal fade" id="modal_detail_pasien" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="kd_dokter_listpasien" name="kd_dokter_listpasien">
                <div class="text-center mb-5">
                    <h1 class="mb-3">List Patient's</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                    <thead class="align-middle">
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 rounded-start">Tanggal</th>
                            <th>No Rawat / Billing</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Provider</th>
                            <th>Keterangan</th>
                            <th>Poli Klinik</th>
                            <th>Dokter</th>
                            <th class="text-end">Registrasi</th>
                            <th class="text-end">Farmasi</th>
                            <th class="text-end">Radiologi</th>
                            <th class="text-end">Laboratorium</th>
                            <th class="text-end">Tindakan</th>
                            <th class="pe-4 rounded-end">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold" id="resultbillingbpjsrjdetail"></tbody>
                    <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingbpjsrjdetail"></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_rincian_pasien" tabindex="-1" aria-hidden="true">
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
                <input type="hidden" id="no_rawat" name="no_rawat">
                <input type="hidden" id="kd_dokter" name="kd_dokter">
                <input type="hidden" id="type" name="type">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Rincian Billing Pasien</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                    <thead class="align-middle">
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 rounded-start">Name</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="pe-4 rounded-end text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold" id="resultrincianbilling"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>