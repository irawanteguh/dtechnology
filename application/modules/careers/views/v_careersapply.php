<div class="card">
    <div class="card-body p-lg-17">
        <div class="position-relative mb-17">
            <div class="overlay overlay-show">
                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('<?php echo base_url('assets/images/stock/2000x800/1.jpg'); ?>')"></div>
                <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
            </div>
            <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                <h3 class="fs-2qx fw-bolder mb-3 m text-white">Careers at <?php echo $_SESSION['hospitalname']?></h3>
                <div class="fs-5 fw-bold">You sit down. You stare at your screen. The cursor blinks.</div>
            </div>
        </div>
        <div class="d-flex flex-column flex-lg-row mb-17">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="kt_careers_form">
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">First Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="first_name">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--end::Label-->
                            <label class="required fs-5 fw-bold mb-2">Last Name</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="last_name">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="" name="email">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                        <div class="col-md-6 fv-row">
                            <!--end::Label-->
                            <label class="fs-5 fw-bold mb-2">Mobile No</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="mobileno">
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">Age</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="age">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--end::Label-->
                            <label class="required fs-5 fw-bold mb-2">City</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="city">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Position</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Your payment statements may very based on selected position" aria-label="Your payment statements may very based on selected position"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select name="position" data-control="select2" data-placeholder="Select a position..." class="form-select form-select-solid select2-hidden-accessible" data-select2-id="select2-data-10-jj6w" tabindex="-1" aria-hidden="true">
                            <option value="Web Developer" data-select2-id="select2-data-12-nb0i">Web Developer</option>
                            <option value="Web Designer">Web Designer</option>
                            <option value="Art Director">Art Director</option>
                            <option value="Finance Manager">Finance Manager</option>
                            <option value="Project Manager">Project Manager</option>
                            <option value="System Administrator">System Administrator</option>
                        </select>
                        <!--end::Select-->
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    <!--end::Input group-->
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">Expected Salary</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="" name="salary">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <!--end::Label-->
                            <label class="required fs-5 fw-bold mb-2">Srart Date</label>
                            <!--end::Label-->
                            <!--end::Input-->
                            <input type="text" class="form-control form-control-solid flatpickr-input" placeholder="" name="start_date" readonly="readonly">
                            <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-5 fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold mb-2">Website (If Any)</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="" name="website">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-5">
                        <label class="fs-6 fw-bold mb-2">Experience (Optional)</label>
                        <textarea class="form-control form-control-solid" rows="2" name="experience" placeholder=""></textarea>
                    </div>
                    <!--end::Input group-->
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Application</label>
                        <textarea class="form-control form-control-solid" rows="4" name="application" placeholder=""></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="fs-6 fw-bold mb-2">Upload Document</label>
                        <div class="dropzone" id="file_doc">
                            <div class="dz-message needsclick">
                                <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 12.6L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L8 12.6H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V12.6H16Z" fill="black" />
                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                    </svg>
                                </span>
                                <div class="ms-4">
                                    <h3 class="dfs-3 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fw-bold fs-8 text-muted">File Document Dalam Format .Jpeg</span><br>
                                    <span class="fw-bold fs-8 text-muted">Max File Size 2 Mb</span>
                                </div>
                            </div>
                        </div>   
                    </div>   
                    <!--end::Input group-->
                    <!--begin::Separator-->
                    <div class="separator mb-8"></div>
                    <!--end::Separator-->
                    <!--begin::Submit-->
                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                        <!--begin::Indicator-->
                        <span class="indicator-label">Apply Now</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator-->
                    </button>
                    <!--end::Submit-->
                <div></div></form>
                <!--end::Form-->
                <!--begin::Job-->
                <div class="mb-10 mb-lg-0">
                    <!--begin::Description-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <h4 class="fs-1 text-gray-800 w-bolder mb-6">Job Details</h4>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <p class="fw-bold fs-4 text-gray-600 mb-2">First, a disclaimer – the entire process of writing a blog post often takes more than a couple of hours, even if you can type eighty words as per minute and your writing skills are sharp.</p>
                        <!--end::Text-->
                    </div>
                    <!--end::Description-->
                    <!--begin::Accordion-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_3_1">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Requirements</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_3_1" class="collapse show fs-6 ms-1">
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_3_2">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">What is your job role?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_3_2" class="collapse fs-6 ms-1">
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_3_3">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Job Candidate Benefits</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_3_3" class="collapse fs-6 ms-1">
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_3_4">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Application Terms</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_3_4" class="collapse fs-6 ms-1">
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10 mb-n1">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Experience with REST API</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center ps-10">
                                    <!--begin::Bullet-->
                                    <span class="bullet me-3"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-600 fw-bold fs-6">Git knowledge is a plus</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Section-->
                    <!--end::Accordion-->
                </div>
                <!--end::Job-->
            </div>


            <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="mb-7">
                            <h2 class="fs-1 text-gray-800 w-bolder mb-6">About Us</h2>
                            <p class="fw-bold fs-6 text-gray-600">First, a disclaimer – the process of becoming a nurse often takes significant time and dedication, involving rigorous training and education.</p>
                        </div>
                        <div class="mb-8">
                            <h4 class="text-gray-700 w-bolder mb-0">Requirements</h4>
                            <div class="my-2">
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Bachelor's degree in Nursing (BSN) or Associate's degree in Nursing (ADN)</div>
                                </div>
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Valid nursing license (RN)</div>
                                </div>
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">CPR certification</div>
                                </div>
                                <div class="d-flex align-items-center"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Excellent communication and interpersonal skills</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-8">
                            <h4 class="text-gray-700 w-bolder mb-0">Our Achievements</h4>
                            <div class="my-2">
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Awarded Best Healthcare Provider 2023</div>
                                </div>
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Accredited by National Nursing Association</div>
                                </div>
                                <div class="d-flex align-items-center mb-3"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Recognized for Excellence in Patient Care</div>
                                </div>
                                <div class="d-flex align-items-center"><span class="bullet me-3"></span><div class="text-gray-600 fw-bold fs-6">Recipient of the 2022 Community Service Award</div>
                                </div>
                            </div>
                        </div>
                        <a href="../../demo1/dist/pages/careers/apply.html" class="link-primary fs-6 fw-bold">Explore More</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="mb-19">
            <div class="text-center mb-12">
                <h3 class="fs-2hx text-dark mb-5">Publications</h3>
                <div class="fs-5 text-muted fw-bold">Our goal is to provide a complete and robust theme solution
                <br>to boost all of our customer’s project deployments</div>
            </div>
            <div class="row g-10">
                <div class="col-md-4">
                    <div class="card-xl-stretch me-md-6">
                        <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-73.jpg">
                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-73.jpg')"></div>
                            <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                            </div>
                        </a>
                        <div class="m-0">
                            <a href="../../demo1/dist/pages/profile/overview.html" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">Metronic Admin - How To Started the Dashboard Tutorial</a>
                            <div class="fw-bold fs-5 text-gray-600 text-dark mt-3 mb-5">We’ve been focused on making a the from also not been afraid to and step away been focused create eye</div>
                            <div class="fs-6 fw-bolder">
                                <a href="../../demo1/dist/pages/projects/users.html" class="text-gray-700 text-hover-primary">Jane Miller</a>
                                <span class="text-muted">on Mar 21 2021</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-xl-stretch mx-md-3">
                        <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-74.jpg">
                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-74.jpg')"></div>
                            <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                            </div>
                        </a>
                        <div class="m-0">
                            <a href="../../demo1/dist/pages/profile/overview.html" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">Metronic Admin - How To Started the Dashboard Tutorial</a>
                            <div class="fw-bold fs-5 text-gray-600 text-dark mt-3 mb-5">We’ve been focused on making the from v4 to v5 but we have also not been afraid to step away been focused</div>
                            <div class="fs-6 fw-bolder">
                                <a href="../../demo1/dist/pages/projects/users.html" class="text-gray-700 text-hover-primary">Cris Morgan</a>
                                <span class="text-muted">on Apr 14 2021</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-xl-stretch ms-md-6">
                        <a class="d-block overlay mb-4" data-fslightbox="lightbox-hot-sales" href="assets/media/stock/600x400/img-47.jpg">
                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('assets/media/stock/600x400/img-47.jpg')"></div>
                            <div class="overlay-layer bg-dark card-rounded bg-opacity-25">
                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                            </div>
                        </a>
                        <div class="m-0">
                            <a href="../../demo1/dist/pages/profile/overview.html" class="fs-4 text-dark fw-bolder text-hover-primary text-dark lh-base">Metronic Admin - How To Started the Dashboard Tutorial</a>
                            <div class="fw-bold fs-5 text-gray-600 text-dark mt-3 mb-5">We’ve been focused on making the from v4 to v5 but we’ve also not been afraid to step away been focused</div>
                            <div class="fs-6 fw-bolder">
                                <a href="../../demo1/dist/pages/projects/users.html" class="text-gray-700 text-hover-primary">Carles Nilson</a>
                                <span class="text-muted">on May 14 2021</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="card mb-4 bg-light text-center">
            <div class="card-body py-12">
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/github.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/behance.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/pinterest-p.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="">
                </a>
                <a href="#" class="mx-4">
                    <img src="<?php echo base_url();?>assets/images/svg/brand-logos/dribbble-icon-1.svg" class="h-30px my-2" alt="">
                </a>
            </div>
        </div>
    </div>

</div>