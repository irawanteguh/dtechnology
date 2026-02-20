<style>
    .table th.vertical {
        writing-mode: vertical-rl;   /* bikin teks vertikal dari atas ke bawah */
        transform: rotate(180deg);   /* biar bacaannya dari bawah ke atas */
        text-align: center;          /* rata tengah */
        vertical-align: middle;      /* posisikan di tengah cell */
        white-space: nowrap;         /* biar tidak patah baris */
        width: 40px;                 /* atur lebar kolom */
    }
</style>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Coordinator Approval</span>
                    <span class="text-muted mt-1 fw-bold fs-7" id="info_list_document"></span>
                </h3>
            </div>
            <div class="card-body py-3">
                 <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="ps-4 rounded-start" rowspan="2">No Pemesanan</th>
                                <th rowspan="2">Pengadaan</th>
                                <th rowspan="2">Department</th>
                                <th rowspan="2">Total</th>
                                <th class="text-end" rowspan="2">Status</th>
                                <th class="text-center" colspan="5">Rumah Sakit</th>
                                <th class="text-center" colspan="5">RMB GROUP</th>
                                <th class="text-end" rowspan="2">Dibuat Oleh</th>
                                <th class="pe-4 text-end rounded-end" rowspan="2">Action</th>
                            </tr>
                            <tr class="fw-bolder text-muted bg-light align-middle">
                                <th class="text-center vertical">Ka. Instalasi</th>
                                <th class="text-center vertical">Koordinator</th>
                                <th class="text-center vertical">Manager</th>
                                <th class="text-center vertical">Finance</th>
                                <th class="text-center vertical">Director</th>
                                <th class="text-center vertical">CPO</th>
                                <th class="text-center vertical">CMD</th>
                                <th class="text-center vertical">CTO</th>
                                <th class="text-center vertical">CFO</th>
                                <th class="text-center vertical">CMO</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatamonitoring"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
