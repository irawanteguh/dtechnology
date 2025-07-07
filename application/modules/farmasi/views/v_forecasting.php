<?php
    function getLastThreeMonths($currentMonth) {
        $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $result = [];

        for ($i = 3; $i >= 0; $i--) { // dari 3 bulan lalu s/d bulan sekarang
            $monthIndex = ($currentMonth - $i - 1 + 12) % 12;
            $result[] = strtoupper($months[$monthIndex]);
        }

        return $result;
    }

    function renderbulan() {
        $bulan         = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulanSekarang = date('n');
        $html          = '';

        foreach ($bulan as $index => $namaBulan) {
            $bulanKe = $index + 1;
            $active  = ($bulanKe == $bulanSekarang) ? 'active' : '';
            $tabId   = "#tabbln{$bulanKe}";

            $html .= '<li class="nav-item">';
            $html .= '<a class="nav-link ' . $active . '" data-bs-toggle="tab" href="' . $tabId . '" style="color:#fff;">' . $namaBulan . '</a>';
            $html .= '</li>';
        }

        return $html;
    }

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
                                            $html .= '<th>RATA-RATA</th>';
                                            $html .= '<th>SISA STOK</th>';
                                            $html .= '<th>PEMESANAN</th>';
                                            $html .= '<th>JUMLAH BOX PEMESANAN</th>';
                                            $html .= '<th class="text-end">TOTAL</th>';
                                            $html .= '<th class="pe-4 rounded-end text-end">DISTRIBUTOR</th>';
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
                <div class="d-flex overflow-auto min-h-30px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-7 fw-bolder flex-nowrap">
                        <?= renderbulan(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="tab-content p-0">
            <?= rendertab(); ?>
        </div>
    </div>
</div>
