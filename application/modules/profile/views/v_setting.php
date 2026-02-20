<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
        <div class="card card-flush h-lg-100">
            <div class="card-body">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap mb-10">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#emergency_contact">Emergency Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Address</a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Office Information</a>
                        </li> -->
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                        <form action="<?php echo base_url();?>index.php/profile/setting/updatepersonalinformasi" id="formpersonalinformasi" enctype="multipart/form-data">
                            <div class="row mb-5">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Photo Profile</div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?php echo base_url() ?>assets/images/avatars/blank.png)">
                                        <?php
                                        if ($_SESSION['imgprofile'] === "Y") {
                                            $imageUrl = base_url() . "assets/images/avatars/".$_SESSION['userid'].".jpeg";
                                        } else {
                                            $imageUrl = base_url() . "assets/images/avatars/blank.png";
                                        }
                                        echo "<div class='image-input-wrapper w-125px h-125px bgi-position-center' style='image-input-wrapper w-125px h-125px bgi-position-center; background-image: url(" . $imageUrl . ")'></div>";
                                        ?>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="avatar" accept=".jpeg">
                                            <input type="hidden" name="avatar_remove">
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Allowed file types: jpeg.</div>
                                </div>
                            </div>
                            <div class="separator mb-4"></div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="kt_overview_submit" class="btn btn-lg btn-primary">
                                    <span class="indicator-label">Save Changes</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="emergency_contact" role="tabpanel">
                        <div class="row g-5" id="listcontact"></div>
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                        <div class="row g-5" id="listaddress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>