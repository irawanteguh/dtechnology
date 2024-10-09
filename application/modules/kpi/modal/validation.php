<div class="modal fade" id="modal_validation_perilaku" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/kpi/validation/insertassessment" id="forminsertassessment">
                <input type="hidden" id="modal_validation_perilaku_userid_add" name="modal_validation_perilaku_userid_add">
                <input type="hidden" id="modal_validation_perilaku_periodeid_add" name="modal_validation_perilaku_periodeid_add">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Personal Assessment</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="accordion" id="personalassessment"></div>
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="btn_personalassessement_add" type="submit" value="SIMPAN DATA" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>

<div class="modal fade" id="modal_validation_kegiatan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/kpi/validation/validationactivity" method="POST" id="fromvalidationactivity">
                <input type="hidden" id="modal_validation_acivity_userid" name="modal_validation_acivity_userid">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Personal Activity</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="table-responsive mh-550px scroll-y me-n5 pe-5">
                        <table class="table align-middle table-row-dashed fs-6 gy-2">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="ps-4 rounded-start"><input class="form-check-input h-20px w-20px" type="checkbox" id="checkall" name="checkall"> Select</th>
                                    <th>Activity</th>
                                    <th class="text-center">Volume</th>
                                    <th class="pe-4 text-end rounded-end">Date Time</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold" id="resultactivity"></tbody>
                        </table>
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <button type="submit" class="btn btn-light-danger btn-validasi" name="decline" value="DECLINE">DECLINE</button>
                    <button type="submit" class="btn btn-light-primary btn-validasi" name="approve" value="APPROVE">APPROVE</button>			
                </div>  
            </form>
        </div>
    </div>
</div>