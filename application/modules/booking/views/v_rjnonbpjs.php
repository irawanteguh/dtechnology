<div class="d-flex container">
    <div class="col-md-12">
        <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
            <div class="stepper-nav py-5">
                <div class="stepper-item current" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Identity</h3>
                </div>
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Confirmation</h3>
                </div>
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Booking</h3>
                </div>
                <div class="stepper-item" data-kt-stepper-element="nav">
                    <h3 class="stepper-title">Completed</h3>
                </div>
            </div>
            <form class="mx-auto mw-600px w-100 py-10" novalidate="novalidate" id="kt_create_account_form">
                <div class="current" data-kt-stepper-element="content">
                    <div class="w-100">
                        <div class="pb-10 pb-lg-12">
                            <h2 class="fw-bolder text-dark">Patient Identity</h2>
                            <div class="text-muted fw-bold fs-6">Please make sure to enter the patient's identity.</div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label required">No Medical Record / KTP / BPJS</label>
                            <input id="identitaspasien" name="identitaspasien" class="form-control form-control-lg form-control-solid" placeholder="Please Enter Your Number Medical Record / KTP / BPJS" />
                        </div>
                    </div>
                </div>

                <div data-kt-stepper-element="content">
                    <div class="w-100 row">
                        <div class="pb-10 pb-lg-12">
                            <h2 class="fw-bolder text-dark">Confirmation Patient Identity</h2>
                            <div class="text-muted fw-bold fs-6">Please make sure to enter the patient's identity.</div>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">No Medical Record</label>
                            <input id="nomr" name="nomr" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">No KTP</label>
                            <input id="noktp" name="noktp" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">No BPJS</label>
                            <input id="nobpjs" name="nobpjs" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-12">
                            <label class="form-label required">Name</label>
                            <input id="name" name="name" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">Birth Of Day</label>
                            <input id="identitaspasien" name="identitaspasien" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">Age</label>
                            <input id="identitaspasien" name="identitaspasien" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">Sex</label>
                            <input id="identitaspasien" name="identitaspasien" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label required">Address</label>
                            <input id="identitaspasien" name="identitaspasien" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>

                        <div class="fv-row mb-15 fv-plugins-icon-container">
                            <div class="d-flex flex-stack">
                                <div class="me-5">
                                    <label class="required fs-6 fw-bold">Confirmation</label>
                                    <div class="fs-7 fw-bold text-muted">Please make sure that the identity listed is correct.</div>
                                </div>
                                <div class="d-flex">
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px" type="checkbox" value="email" name="settings_notifications[]">
                                        <span class="form-check-label fw-bold">Correct</span>
                                    </label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-stack pt-15">
                    <div class="mr-2">
                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                            <span class="svg-icon svg-icon-4 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                                    <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black" />
                                </svg>
                            </span>
                            Back
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                            <span class="indicator-label">
                                Submit
                                <span class="svg-icon svg-icon-3 ms-2 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                    </svg>
                                </span>
                            </span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                            <span class="svg-icon svg-icon-4 ms-1 me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>                             
</div>