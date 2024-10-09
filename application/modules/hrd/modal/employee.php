<div class="modal fade" id="modal_employee_registrationposition_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary " data-bs-toggle='modal'   data-bs-dismiss="click" title="" data-bs-original-title="Edit Position"   id="kt_modal_view_event_edit" data-bs-target="#modal_employee_registrationposition_edit"><span class="svg-icon svg-icon-2"><i class="bi bi-pencil-square"></i></span></div>
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger"   data-bs-toggle="tooltip" data-bs-dismiss="click" title="" data-bs-original-title="Non Active Position" id="modal_employee_registrationposition_nonactive" ><span class="svg-icon svg-icon-2"><i class="bi bi-bookmark-x"></i></span></div>
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger"   data-bs-toggle="tooltip" data-bs-dismiss="click" title="" data-bs-original-title="Delete Position" id="modal_employee_registrationposition_delete" ><span class="svg-icon svg-icon-2"><i class="bi bi-trash"></i></span></div>
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-color-primary" data-bs-toggle="tooltip" data-bs-dismiss="modal" title="" data-bs-original-title="Hide Registration Position"><span class="svg-icon svg-icon-1"><i class="bi bi-x-lg"></i></span></div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="modal_data_employee_registrationposition_transid_view" name="modal_data_employee_registrationposition_transid_view">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Registration Position</h1>
                    <div class="text-muted fw-bold fs-5">Please make changes to your position registration</div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">NIK</label>
                        <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_nik_view" name="modal_data_employee_registrationposition_nik_view" readonly>
                    </div>
                    <div class="col-md-9 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">Name</label>
                        <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_name_view" name="modal_data_employee_registrationposition_name_view" readonly>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">Position</label>
                        <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_position_view" name="modal_data_employee_registrationposition_position_view" readonly>
                    </div>
                    <div class="col-md-12 mb-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">Direct supervisor/performance validator</label>
                        <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_atasan_view" name="modal_data_employee_registrationposition_atasan_view" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_employee_registrationposition_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-color-primary" data-bs-toggle="tooltip" data-bs-dismiss="modal" title="" data-bs-original-title="Hide Registration Position"><span class="svg-icon svg-icon-1"><i class="bi bi-x-lg"></i></span></div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/employee/editpenempatan" id="formeditpenempatan">
                <div class="modal-body">
                    <input type="hidden" id="modal_data_employee_registrationposition_transid_edit" name="modal_data_employee_registrationposition_transid_edit">
                    <input type="hidden" id="modal_data_employee_registrationposition_userid_edit" name="modal_data_employee_registrationposition_userid_edit">
                    
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Registration Position</h1>
                        <div class="text-muted fw-bold fs-5">Please make changes to your position registration</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">NIK</label>
                            <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_nik_edit" name="modal_data_employee_registrationposition_nik_edit" readonly>
                        </div>
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Name</label>
                            <input type="text" class="form-control form-control-solid" id="modal_data_employee_registrationposition_name_edit" name="modal_data_employee_registrationposition_name_edit" readonly>
                        </div>
                        <div class="col-md-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Position</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Position for the employee"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_employee_registrationposition_edit" data-placeholder="Please Select Position" class="form-select form-select-solid" name="modal_data_employee_registrationposition_positionid_edit" id="modal_data_employee_registrationposition_positionid_edit" required>
                                <?php echo $position;?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Direct supervisor/performance validator</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Direct supervisor/performance validator"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_employee_registrationposition_edit" data-placeholder="Please Select the Name of the Person in Charge" class="form-select form-select-solid" name="modal_data_employee_registrationposition_atasanid_edit" id="modal_data_employee_registrationposition_atasanid_edit" required>
                                <?php echo $namaatasan;?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Type</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Type of Job, Main Duties / Additional Duties"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_employee_registrationposition_edit" data-placeholder="Please Placement Type." class="form-select form-select-solid" name="modal_data_employee_registrationposition_type_edit" id="modal_data_employee_registrationposition_type_edit" required>
								<?php echo $type;?>
							</select>
						</div>
                        <div class="col-md-6 mb-5">
                            <label class="required fs-6 fw-bold mb-2">Join Date</label>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Please Select a Joining Start Date"></i>
                            <div class="position-relative d-flex align-items-center">
                                <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
                                        <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
                                        <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
                                    </svg>
                                </span>
                                <input class="form-control form-control-solid ps-12" placeholder="Select a date" name="drawer_data_employee_registrationposition_date_edit" id="drawer_data_employee_registrationposition_date_edit" value="<?php $d=strtotime("now"); echo date('d.m.Y', $d);?>" required/>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_employee_edit" type="submit" value="PERUBAHAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>