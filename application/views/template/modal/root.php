
<div class="modal fade" id="modal-logout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Confirmation</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-muted fw-bold fs-5">Hey <b><?php echo $_SESSION['name']?></b>, Anda Yakin Ingin Keluar Dari Sistem ?</div>
            </div>
            <div class="modal-footer p-1">				
                <a href="<?php echo base_url();?>index.php/auth/sign/logoutsystem">
                    <button type="button" class="btn btn-light-danger">LOGOUT</button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_root_change_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-color-primary" data-bs-toggle="tooltip" data-bs-dismiss="modal" title="" data-bs-original-title="Hide Change Password">
                    <span class="svg-icon svg-icon-1"><i class="bi bi-x-lg"></i></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Setup New Password</h1>
                    <div class="text-muted fw-bold fs-5">
                        Please change your password every 3 months<br>
                        Already have reset your password? <a href="../index.php/auth/sign" class="link-primary fw-bolder">Sign in here</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center row">
                    <form action="<?php echo base_url();?>auth/sign/changepassword" id="formnewpassword" method="post">
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="newpassword" id="newpassword" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                            </div>
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" id="confirm-password" autocomplete="off" />
                        </div>
                        <div class="modal-footer p-1">
                            <button type="submit" id="kt_new_password_submit" class="btn btn-light-danger">CHANGE PASSWORD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal_view_pdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">View File</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div id="viewdoc" style="height:600px;"></div>
            </div>
            <div class="modal-footer p-1">
                <!-- Button to open the file in a new tab -->
                <button type="button" class="btn btn-primary me-3" id="openInNewTabButton">Open File in New Tab</button>
                <!-- Close button -->
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
