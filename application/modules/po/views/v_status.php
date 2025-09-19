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
                                <th class="ps-4 rounded-start">No Pemesanan</th>
                                <th>Pengadaan</th>
                                <th>Department</th>
                                <th class="text-center vertical">Ka. Instalasi / Ruangan</th>
                                <th class="text-center vertical">Koordinator</th>
                                <th>Supplier</th>
                                <th class="text-end">Sub Total</th>
                                <th class="text-end">Ppn</th>
                                <th class="text-end">Total</th>
                                <th class="text-end">Status</th>
                                <th class="text-end">Dibuat Oleh</th>
                                <th class="pe-4 text-end rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdatamonitoring"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
