<style>
    .nav-line-tabs .nav-link {
        color: rgba(255, 255, 255, 0.6); /* warna tab normal */
    }

    .nav-line-tabs .nav-link.active {
        color: #ffffff !important; /* warna tab aktif putih */
        border-color: #ffffff !important; /* garis bawah tab aktif putih */
    }

</style>

<?php
    function renderHospitalCard($cardtittle,$orgid,$type,$bgcolor,$groupcard){
        $jenis = [
            'Umum'      => ['id' => 'umum', 'icon' => 'bi-cash-stack', 'text' => 'text-success', 'bg' => 'bg-light-success'],
            'Asuransi'  => ['id' => 'asuransi', 'icon' => 'bi-file-medical', 'text' => 'text-primary', 'bg' => 'bg-light-primary'],
            'BPJS'      => ['id' => 'bpjs', 'icon' => 'bi-person-badge', 'text' => 'text-info', 'bg' => 'bg-light-info'],
            'MCU'       => ['id' => 'mcu', 'icon' => 'bi-heart-pulse', 'text' => 'text-danger', 'bg' => 'bg-light-danger'],
            'Obat'      => ['id' => 'obat', 'icon' => 'bi-capsule', 'text' => 'text-warning', 'bg' => 'bg-light-warning'],
            'Lain-lain' => ['id' => 'lain', 'icon' => 'bi-box', 'text' => 'text-dark', 'bg' => 'bg-light']
        ];

?>
    <div class="col-6 col-sm-3 col-lg-3 animate__animated animate__fadeIn">
        <div class="card card-flush h-100 shadow-sm">
            <div class="card-body p-0">
                <div class="px-9 pt-7 card-rounded h-275px w-100 <?php echo $bgcolor; ?>">
                    <div class="d-flex flex-stack">
                        <h3 class="m-0 text-white fw-bolder fs-5"><?php echo $cardtittle; ?></h3>
                    </div>
                    <div class="d-flex text-center flex-column text-white pt-5">
                        <span class="fw-bold fs-5"><?php echo $groupcard;?></span>
                        <span class="fw-bolder fs-2x pt-1" id="<?php echo $orgid.$type;?>">NaN</span>
                    </div>
                </div>
                <div class="bg-body shadow-sm card-rounded mx-5 mb-5 px-3 py-3 position-relative z-index-1" style="margin-top: -140px">
                    <?php foreach ($jenis as $label => $item): ?>
                        <div class="d-flex align-items-center mb-2">
                            <div class="symbol symbol-40px w-40px me-5">
                                <span class="symbol-label <?php echo $item['bg']; ?>">
                                    <i class="bi <?php echo $item['icon']; ?> fa-2x <?php echo $item['text']; ?>"></i>
                                </span>
                            </div>
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <a href="#" class="fs-7 text-gray-800 text-hover-primary fw-bolder"><?php echo $label; ?></a>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="fw-bolder fs-7 text-gray-800 pe-1" id="">NaN</div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>

<div class="row gy-5 g-xl-8 mb-xl-3 border">
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
                        <a class="text-warning nav-link active" data-bs-toggle="tab" href="#tabdate" id="tab_date">Date</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-warning nav-link" data-bs-toggle="tab" href="#tabmonth" id="tab_month">Month</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-warning nav-link" data-bs-toggle="tab" href="#tabyears" id="tab_years">Years</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="tab-content p-0">
        <div id="tabdate" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="tab_date">
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-wrap my-2">
                    <div class="d-flex align-items-center my-2">
                        <label for="dateperiode" class="form-label fw-bold me-3 mb-0">Date:</label>
                        <input class="form-control flatpickr-input form-control-sm w-auto" name="dateperiode" id="dateperiode" placeholder="Pick a date"  type="text" style="min-width: 200px;">
                    </div>
                </div>
            </div>
            <div class="row g-4 mb-3">
                <?php
                    renderHospitalCard("RMB Hospital Group","rmb","date","bg-danger","Income");
                    renderHospitalCard("RSU Mutiasari","rsms","date","bg-info","Income");
                    renderHospitalCard("RSIA Budhi Mulia","rsiabm","date","bg-primary","Income");
                    renderHospitalCard("RS Thursina","rst","date","bg-success","Income");
                ?>
            </div>
        </div>
        <div id="tabmonth" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_month">
            y
        </div>
        <div id="tabyears" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="tab_years">
            z
        </div>
    </div>
</div>