<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabrawatjalan">Outpatient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrawatinap">Inpatient</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabrawatjalan" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 hea">
                                <thead class="align-middle text-center">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start" rowspan="2">Date</th>
                                        <th rowspan="2">Patient Information</th>
                                        <th rowspan="2">Billing Id</th>
                                        <th rowspan="2">Polyclinic</th>
                                        <th rowspan="2">Provider</th>
                                        <th rowspan="2">REG</th>
                                        <th colspan="3">PENUNJANG</th>
                                        <th colspan="2">TINDAKAN</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th>FRM</th>
                                        <th>LAB</th>
                                        <th>RAD</th>
                                        <th>PARAMEDIC</th>
                                        <th>DOCTOR</th>
                                    </tr> 
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingrawatjalan"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingrawatjalan"></tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabrawatinap" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2">
                                <thead class="align-middle text-center">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start" rowspan="2">Date</th>
                                        <th rowspan="2">Patient Information</th>
                                        <th rowspan="2">Billing Id</th>
                                        <th rowspan="2">Room</th>
                                        <th rowspan="2">Provider</th>
                                        <th rowspan="2">REG</th>
                                        <th colspan="3">PENUNJANG</th>
                                        <th colspan="2">TINDAKAN</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th>FRM</th>
                                        <th>LAB</th>
                                        <th>RAD</th>
                                        <th>PARAMEDIC</th>
                                        <th>DOCTOR</th>
                                    </tr> 
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingrawatinap"></tbody>
                                <tfoot class="fw-bolder text-muted bg-light" id="footresultbillingrawatinap"></tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- <div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabrawatjalanasuransi">Rawat Jalan Asuransi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrawatjalanbpjs">Rawat Jalan BPJS</a>
                    </li>
                </ul>

               
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabrawatjalanasuransi" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 table-bordered" id="tablemasterkaryawan">
                                <thead class="align-middle text-center">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start" rowspan="2">Date</th>
                                        <th rowspan="2">Patient Information</th>
                                        <th rowspan="2">Polyclinic</th>
                                        <th rowspan="2">Provider</th>
                                        <th rowspan="2">REG</th>
                                        <th colspan="3">PENUNJANG</th>
                                        <th colspan="2">TINDAKAN</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th>FRM</th>
                                        <th>LAB</th>
                                        <th>RAD</th>
                                        <th>PARAMEDIC</th>
                                        <th>DOCTOR</th>
                                    </tr>
                                
                                </thead>
                                
                                <tbody class="text-gray-600 fw-bold" id="resultbillingrawatinap"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabrawatjalanbpjs" role="tabpanel">
                    <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 table-bordered" id="tablemasterkaryawan">
                                <thead class="align-middle text-center">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start" rowspan="2">Date</th>
                                        <th rowspan="2">Patient Information</th>
                                        <th rowspan="2">Polyclinic</th>
                                        <th rowspan="2">Provider</th>
                                        <th rowspan="2">REG</th>
                                        <th colspan="3">PENUNJANG</th>
                                        <th colspan="2">TINDAKAN</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th>FRM</th>
                                        <th>LAB</th>
                                        <th>RAD</th>
                                        <th>PARAMEDIC</th>
                                        <th>DOCTOR</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="resultbillingbpjs"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tabrawatinap">Pasien Rawat Inap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tabrawatinap">MUCHSIN</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabcoba" role="tabpanel">
                        <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                            <table class="table align-middle table-row-dashed fs-6 gy-2 table-bordered" id="tablemasterkaryawan">
                                <thead class="align-middle text-center">
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th class="ps-4 rounded-start" rowspan="2">Date</th>
                                        <th rowspan="2">Patient Information</th>
                                        <th rowspan="2">Polyclinic</th>
                                        <th rowspan="2">Provider</th>
                                        <th rowspan="2">REG</th>
                                        <th colspan="3">PENUNJANG</th>
                                        <th colspan="2">TINDAKAN</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <tr class="fw-bolder text-muted bg-light">
                                        <th>FRM</th>
                                        <th>LAB</th>
                                        <th>RAD</th>
                                        <th>PARAMEDIC</th>
                                        <th>DOCTOR</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-bold" id="rstrozi"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabcoba" role="tabpanel">
                    </div>
                </div>

               

            </div>

            
        </div>
    </div>
</div> -->