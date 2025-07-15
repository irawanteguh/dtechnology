<div class="modal fade" id="modal_handling_update_department" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/crm/handling/updatedepartment" id="formupdatedepartment">
                <input type="hidden" id="modal_handling_update_department_transid" name="modal_handling_update_department_transid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Update Department</h1>
                        <div class="text-muted fw-bold fs-5">Please Update Department</div>
                    </div>
                    <div class="row">
                        <div class="fv-row col-md-12 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Department</label>
                            <select data-control="select2" data-dropdown-parent="#modal_handling_update_department" data-placeholder="Select a Department..." class="form-select form-select-solid" name="modal_handling_update_department_departmentid" id="modal_handling_update_department_departmentid">
                                <?php echo $department;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_handling_update_department_btn" type="submit" value="UPDATE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_handling_response" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/crm/handling/response" id="formresponse">
                <input type="hidden" id="modal_handling_response_transid" name="modal_handling_response_transid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Response Saran dan Masukan</h1>
                        <div class="text-muted fw-bold fs-5">Silakan response saran dan masukan</div>
                    </div>
                    <div class="row">
                        <div class="fv-row col-md-12 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Response</label>
                            <textarea name="modal_handling_response_response" id="modal_handling_response_response"  rows="5" class="form-control form-control-lg form-control-solid" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_handling_response_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>