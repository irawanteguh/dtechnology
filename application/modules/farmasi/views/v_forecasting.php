<?php

    function rendertab() {
        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulanSekarang = date('n');
        $html          = '';

        foreach ($bulan as $index => $namaBulan) {
            $bulanKe         = $index + 1;
            $active          = ($bulanKe == $bulanSekarang) ? 'show active' : '';
            $filterJenisId   = "filterjenis_" . $bulanKe;
            $filterPeriodeId = "filterperiode_" . $bulanKe;
            $filterRekananId = "filterrekanan_" . $bulanKe;

            // Ambil nama 3 bulan terakhir sebelum bulanKe
            $lastThreeMonths = getLastThreeMonths($bulanKe);

            $html .= '<div class="tab-pane fade ' . $active . '" id="tabbln' . $bulanKe . '">';
                $html .= '<div class="col-xl-12">';
                    $html .= '<div class="card card-flush">';
                        $html .= '<div class="card-body p-2">';
                            $html .= '<div class="table-responsive">';
                                $html .= '<table class="table align-middle table-row-dashed fs-8 gy-2" id="resultrekappiutang_'.$bulanKe.'">';
                                    $html .= '<thead>';
                                        $html .= '<tr class="fw-bolder align-middle bg-light text-muted">';
                                            $html .= '<th class="ps-4 rounded-start">Nama Barang</th>';
                                            $html .= '<th>Kategori</th>';

                                            // Tampilkan 3 bulan terakhir
                                            foreach ($lastThreeMonths as $monthName) {
                                                $html .= "<th>{$monthName}</th>";
                                            }
                                            $html .= '<th>Rata-rata</th>';
                                            $html .= '<th>Sisa Stok</th>';
                                            $html .= '<th>Pemesanan</th>';
                                            $html .= '<th>Jumlah Box Pemesanan</th>';
                                            $html .= '<th class="text-end">Total</th>';
                                            $html .= '<th class="pe-4 rounded-end text-end">Distributor</th>';
                                        $html .= '</tr>';
                                    $html .= '</thead>';
                                    $html .= '<tbody class="text-gray-600 fw-bold" id="resultdataforecasting_'.$bulanKe.'"></tbody>';
                                $html .= '</table>';
                            $html .= '</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }
?>

<!-- BAGIAN HTML -->
<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
             style="background-color: #663259; background-size: auto 100%; background-image: url('<?= base_url(); ?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Forecasting Farmasi</h1>
                        <p class="text-white mb-0">
                            Proyeksi kebutuhan obat untuk mendukung perencanaan stok, efisiensi pengadaan, dan pengendalian biaya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-8 gy-2">
                        <thead>
                            <tr class="fw-bolder align-middle bg-light text-muted">
                                <th class="ps-4 rounded-start">Nama Barang</th>
                                <th>Kategori</th>
                                <th class="bulan-dinamis text-end"></th>
                                <th class="bulan-dinamis text-end"></th>
                                <th class="bulan-dinamis text-end"></th>
                                <th class="bulan-dinamis text-end"></th>
                                <th class="text-end">Rata-rata</th>
                                <th class="text-end">Sisa Stok</th>
                                <th class="text-end">Pemesanan</th>
                                <th class="text-end">Total</th>
                                <th class="pe-4 rounded-end">Distributor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold" id="resultdataforecasting"></tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
