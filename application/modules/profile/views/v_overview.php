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
                        <form id="formoverview" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                            <div class="row mb-5">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Photo Profile</div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?php echo base_url() ?>assets/images/avatars/blank.png)">
                                        <?php
                                        if ($_SESSION['imgprofile'] === "Y") {
                                            $imageUrl = base_url() . "assets/images/avatars/" . $_SESSION['userid'] . ".jpeg";
                                        } else {
                                            $imageUrl = base_url() . "assets/images/avatars/blank.png";
                                        }
                                        echo "<div class='image-input-wrapper w-125px h-125px bgi-position-center' style='image-input-wrapper w-125px h-125px bgi-position-center; background-image: url(" . $imageUrl . ")'></div>";
                                        ?>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="avatar_remove">
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Identity Number</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="number" class="form-control form-control-solid" id="identity_no" name="identity_no">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Name</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" id="name" name="name">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Name Identity</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="name_identity">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Place of Birth</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="pob">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Date of Birth</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid kt_inputmask_1" name="dob" onchange="calculateAge()">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Ages</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" readonly name="ages" readonly>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Gender</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <div class="d-flex">
                                        <div class="form-check form-check-custom form-check-solid me-10">
                                            <input class="form-check-input" type="radio" value="L" name="gender" id="gender1" />
                                            <label class="form-check-label" for="gender1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid me-10">
                                            <input class="form-check-input" type="radio" value="P" name="gender" id="gender2" />
                                            <label class="form-check-label" for="gender2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Marital Status</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" id="marital_status" name="marital_status">
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Religion</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" id="religion" name="religion">
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Blood Type</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" id="blood_type" name="blood_type">
                                        <option></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Rhesus</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container d-flex">
                                    <div class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input" type="radio" name="rhesus" value="+" id="rhesus1" />
                                        <label class="form-check-label" for="rhesus1">
                                            <i class="fa-solid fa-plus"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input" type="radio" name="rhesus" value="-" id="rhesus2" />
                                        <label class="form-check-label" for="rhesus2">
                                            <i class="fa-solid fa-minus"></i>
                                        </label>
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Ethnic</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" id="ethnic" name="ethnic">
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Clothes Size</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" id="clothes_size" name="clothes_size">
                                        <option></option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                        <option value="4XL">4XL</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Phone Number</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="number" class="form-control form-control-solid" name="phone">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Email</div>
                                </div>
                                <div class="col-xl-4 fv-row fv-plugins-icon-container">
                                    <input type="email" class="form-control form-control-solid" name="email">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="separator mb-6"></div>
                            <div>
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