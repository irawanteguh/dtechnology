<?php
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
            
            $html .= '<div class="tab-pane fade ' . $active . '" id="tabbln' . $bulanKe . '">';
                $html .= '<div class="col-xl-12">';
                    $html .= '<div class="card card-flush">';
                        $html .= '<div class="card-body p-2">';
                            $html .= '<div class="table-responsive">';
                                $html .= '<table class="table align-middle table-row-dashed fs-8 gy-2" id="resultrekappiutang_'.$bulanKe.'">';
                                    $html .= '<thead>';
                                        $html .= '<tr class="fw-bolder align-middle bg-light text-muted">';
                                            $html .= '<th class="ps-4 rounded-start">Jenis Piutang</th>';
                                            $html .= '<th>Periode</th>';
                                            $html .= '<th>Rekanan</th>';
                                            $html .= '<th class="text-end">Nilai Piutang</th>';
                                            $html .= '<th class="text-end">Terbayar</th>';
                                            $html .= '<th class="pe-4 rounded-end text-end">Sisa Tagihan</th>';
                                        $html .= '</tr>';
                                        $html .= '<tr>';
                                            $html .= '<th><input id="' . $filterJenisId . '" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Jenis Piutang"></th>';
                                            $html .= '<th><input id="' . $filterPeriodeId . '" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Periode"></th>';
                                            $html .= '<th><input id="' . $filterRekananId . '" class="tagify form-control form-control-solid form-control-sm" placeholder="Filter Rekanan"></th>';
                                        $html .= '</tr>';

                                    $html .= '</thead>';
                                    $html .= '<tbody class="text-gray-600 fw-bold" id="resultdatapiutang_'.$bulanKe.'"></tbody>';
                                    $html .= '<tfoot class="text-gray-600 fw-bold" id="resulttotaldatapiutang_'.$bulanKe.'"></tfoot>';
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

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover"
             style="background-color: #663259; background-size: auto 100%; background-image: url('<?= base_url(); ?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Summary Piutang</h1>
                        <p class="text-white mb-0">
                            Ikhtisar piutang yang membantu pemantauan arus kas dan efisiensi keuangan.
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