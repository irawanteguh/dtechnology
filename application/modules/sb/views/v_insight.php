<style>
    .nav-line-tabs .nav-link {
        color: rgba(255, 255, 255, 0.6); /* warna tab normal */
    }

    .nav-line-tabs .nav-link.active {
        color: #ffffff !important; /* warna tab aktif putih */
        border-color: #ffffff !important; /* garis bawah tab aktif putih */
    }

    @media (max-width: 707px) {
        .card-sm-font * {
            font-size: 100% !important;
        }
        .responsive-padding {
            padding-left: 0.5rem !important; /* px-2 = 0.5rem */
            padding-right: 0.5rem !important;
        }
        .responsive-margin {
            margin-left: 0.25rem !important;  /* mx-2 = 0.5rem */
            margin-right: 0.25rem !important;
            margin-top: -170px !important;
        }
        .stack-on-sm {
            flex-direction: column !important;
            align-items: flex-start !important;
        }
    }
</style>

<?php
    function renderHospitalCard($orgid,$orgname,$bgcolor,$tabid){
?>
    <div class="row g-4 mb-5">
        <div class="col-sm-4 col-lg-4 animate__animated animate__fadeIn">
            <div class="card card-flush h-100 shadow-sm card-sm-font">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-275px w-100 <?php echo $bgcolor; ?> responsive-padding">
                        <div class="d-flex flex-stack">
                            <h3 class="m-0 text-white fw-bolder fs-5"><?php echo $orgname; ?></h3>
                            <h3 class="m-0 text-white fw-bolder fs-5" id="<?php echo $orgid.$tabid;?>pendapatanlabel"></h3>
                        </div>
                        <div class="d-flex text-center flex-column text-white pt-5">
                            <span class="fw-bold fs-5">Pendapatan</span>
                            <span class="fw-bolder fs-2x pt-1" id="<?php echo $orgid.$tabid;?>pendapatantotal">NaN</span>
                        </div>
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-5 py-5 position-relative z-index-1 responsive-margin" style="margin-top: -140px">
                        <?php
                            $jenis = [
                                'Umum'      => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                'Asuransi'  => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                'BPJS'      => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                'MCU'       => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                'Obat'      => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
                            ];
                        ?>
                        <?php foreach ($jenis as $label => $item): ?>
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-40px w-40px me-5 hide-on-sm">
                                    <span class="symbol-label <?php echo $item['bg']; ?>">
                                        <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap w-100 stack-on-sm">
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-7 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-7 text-gray-800 pe-1" id="<?php echo $orgid.$item['id'].$tabid;?>pendapatan">NaN</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 animate__animated animate__fadeIn">
            <div class="card card-flush h-100 shadow-sm card-sm-font">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-275px w-100 <?php echo $bgcolor; ?> responsive-padding">
                        <div class="d-flex flex-stack">
                            <h3 class="m-0 text-white fw-bolder fs-5"><?php echo $orgname; ?></h3>
                            <h3 class="m-0 text-white fw-bolder fs-5" id="<?php echo $orgid.$tabid;?>pengeluaranlabel"></h3>
                        </div>
                        <div class="d-flex text-center flex-column text-white pt-5">
                            <span class="fw-bold fs-5">Pengeluaran</span>
                            <span class="fw-bolder fs-2x pt-1" id="<?php echo $orgid.$tabid;?>pengeluarantotal">NaN</span>
                        </div>
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-5 py-5 position-relative z-index-1 responsive-margin" style="margin-top: -140px">
                        <?php
                            $jenis = [
                                'Medis'                  => ['id' => 'medis', 'icon' => 'bi-hospital', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
                                'Rumah Tangga'           => ['id' => 'rumah_tangga', 'icon' => 'bi-house-door', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                'ATK & Percetakan'       => ['id' => 'atk_percetakan', 'icon' => 'bi-printer', 'text' => 'text-info', 'bg' => 'bg-light-info'],
                                'IT'                     => ['id' => 'it', 'icon' => 'bi-pc-display', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
                                'Gizi & Dapur'           => ['id' => 'gizi_dapur', 'icon' => 'bi-egg-fried', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                'Farmasi'                => ['id' => 'farmasi', 'icon' => 'bi-capsule', 'text' => 'text-dark', 'bg' => 'bg-light']
                            ];
                        ?>
                        <?php foreach ($jenis as $label => $item): ?>
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-40px w-40px me-5 hide-on-sm">
                                    <span class="symbol-label <?php echo $item['bg']; ?>">
                                        <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap w-100 stack-on-sm">
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-7 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-7 text-gray-800 pe-1" id="<?php echo $orgid.$item['id'].$tabid;?>pengeluaran">NaN</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 animate__animated animate__fadeIn">
            <div class="card card-flush h-100 shadow-sm card-sm-font">
                <div class="card-body p-0">
                    <div class="px-9 pt-7 card-rounded h-275px w-100 <?php echo $bgcolor; ?> responsive-padding">
                        <div class="d-flex flex-stack">
                            <h3 class="m-0 text-white fw-bolder fs-5"><?php echo $orgname; ?></h3>
                            <h3 class="m-0 text-white fw-bolder fs-5" id="<?php echo $orgid.$tabid;?>selisihlabel"></h3>
                        </div>
                        <div class="d-flex text-center flex-column text-white pt-5">
                            <span class="fw-bold fs-5">Saldo Akhir</span>
                            <span class="fw-bolder fs-2x pt-1" id="<?php echo $orgid.$tabid;?>selisihtotal">NaN</span>
                        </div>
                    </div>
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-5 py-5 position-relative z-index-1 responsive-margin" style="margin-top: -140px">
                        <?php
                            $jenis = [
                                'Pendapatan'  => ['id' => 'total_pendapatan', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
                                'Pengeluaran' => ['id' => 'total_pengeluaran', 'icon' => 'bi-cash-coin', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
                                'Saldo Akhir' => ['id' => 'saldo_akhir','icon' => 'bi-cash-stack','text' => 'text-dark','bg'   => 'bg-light']
                            ];
                        ?>
                        <?php foreach ($jenis as $label => $item): ?>
                            <div class="d-flex align-items-center mb-2">
                                <div class="symbol symbol-40px w-40px me-5 hide-on-sm">
                                    <span class="symbol-label <?php echo $item['bg']; ?>">
                                        <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap w-100 stack-on-sm">
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-7 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-7 text-gray-800 pe-1" id="<?php echo $item['id'].$orgid.$tabid;?>">NaN</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>

<div class="row gy-5 g-xl-8 mb-xl-3 border">
    <div class="col-xl-12">
        <div class="card rounded bgi-no-repeat bgi-position-x-end bgi-size-cover" style="background-color: #663259;background-size: auto 100%; background-image: url('<?php echo base_url();?>assets/images/svg/misc/taieri.svg')">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                    <div>
                        <h1 class="text-white">Hospital Insight RMB Hospital Group</h1>
                        <p class="text-white mb-0">
                            Insight data real-time untuk memantau kinerja dan layanan rumah sakit dalam grup RMB.
                        </p>
                    </div>
                </div>
                <div class="d-flex overflow-auto h-55px">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabdate" id="tab_date" style="color:#fff;">Date</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabmonth" id="tab_month" style="color:#fff;">Month</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabyears" id="tab_years" style="color:#fff;">Years</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="tab-content p-0">
            <div id="tabdate" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_date">
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-wrap my-2">
                        <div class="d-flex align-items-center my-2">
                            <span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap">Date :</span>
                            <input class="form-control flatpickr-input form-control-sm w-auto" name="dateperiode" id="dateperiode" placeholder="Pick a date"  type="text" style="min-width: 200px;">
                        </div>
                    </div>
                </div>
                <?php
                    renderHospitalCard("rmb","RMB Hospital Group","bg-danger","date");
                    renderHospitalCard("rsms","RSU Mutiasari","bg-info","date");
                    renderHospitalCard("rsiabm","RSIA Budhi Mulia","bg-primary","date");
                    renderHospitalCard("rst","RS Thursina","bg-success","date");
                ?>
            </div>
            <div id="tabmonth" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_month">
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-wrap my-2">
                        <div class="d-flex align-items-center my-2">
                            <span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap">Periode :</span>
                            <select data-control="select2" data-placeholder="Please select" class="form-select form-select-sm select2-hidden-accessible" data-hide-search="true" name="monthperiode" id="monthperiode">
                                <?php echo $periodebulan;?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                    renderHospitalCard("rmb","RMB Hospital Group","bg-danger","month");
                    renderHospitalCard("rsms","RSU Mutiasari","bg-info","month");
                    renderHospitalCard("rsiabm","RSIA Budhi Mulia","bg-primary","month");
                    renderHospitalCard("rst","RS Thursina","bg-success","month");
                ?>
            </div>
            <div id="tabyears" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_years">
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-wrap my-2">
                        <div class="d-flex align-items-center my-2">
                            <span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap">Periode :</span>
                            <select data-control="select2" data-placeholder="Please select" class="form-select form-select-sm select2-hidden-accessible" data-hide-search="true" name="yearsperiode" id="yearsperiode">
                                <?php echo $periode;?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                    renderHospitalCard("rmb","RMB Hospital Group","bg-danger","years");
                    renderHospitalCard("rsms","RSU Mutiasari","bg-info","years");
                    renderHospitalCard("rsiabm","RSIA Budhi Mulia","bg-primary","years");
                    renderHospitalCard("rst","RS Thursina","bg-success","years");
                ?>
            </div>
        </div>
    </div>
</div>