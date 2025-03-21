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
            <form class="mx-auto mw-600px w-100 py-10" id="formbooking">
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
                            <input id="booking_nomr" name="booking_nomr" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">No KTP</label>
                            <input id="booking_noktp" name="booking_noktp" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">No BPJS</label>
                            <input id="booking_nobpjs" name="booking_nobpjs" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-9">
                            <label class="form-label required">Name</label>
                            <input id="booking_name" name="booking_name" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-3">
                            <label class="form-label required">Sex</label>
                            <input id="booking_sex" name="booking_sex" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-4">
                            <label class="form-label required">Birth Of Day</label>
                            <input id="booking_bod" name="booking_bod" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10 col-md-8">
                            <label class="form-label required">Age</label>
                            <input id="booking_age" name="booking_age" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label required">Address</label>
                            <input id="booking_address" name="booking_address" class="form-control form-control-lg form-control-solid" disabled/>
                        </div>

                        <div class="fv-row mb-15 fv-plugins-icon-container">
                            <div class="d-flex flex-stack">
                                <div class="me-5">
                                    <label class="required fs-6 fw-bold">Confirmation</label>
                                    <div class="fs-7 fw-bold text-muted">Please make sure that the identity listed is correct.</div>
                                </div>
                                <div class="d-flex">
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px" type="checkbox" ID="booking_confirm" name="booking_confirm">
                                        <span class="form-check-label fw-bold">Correct</span>
                                    </label>
                                </div>
                            </div>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <div data-kt-stepper-element="content">
                    <div class="w-100 row">
                        <div class="pb-10 pb-lg-12">
                            <h2 class="fw-bolder text-dark">Selecting Clinic Date</h2>
                            <div class="text-muted fw-bold fs-6">Please make sure to choose the clinic date for the doctor.</div>
                        </div>
                        <div class="alert alert-dismissible bg-light-info border border-info border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade">
                            <span class="svg-icon svg-icon-2hx svg-icon-info me-4 mb-5 mb-sm-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"></path>
                                    <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1">For Your Information</h5>
                                <span>Please enter the visit date first</span>
                            </div>
                        </div>
                        <input type="hidden" id="booking_hariid" name="booking_hariid">
                        <div class="fv-row col-md-6 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Date</label>
                            <input class="form-control form-control-solid flatpickr-input" name="booking_date" id="booking_date" placeholder="Pick a date"  type="text">
                        </div>
                        <div class="fv-row col-md-6 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Provider</label>
                            <select data-control="select2" data-dropdown-parent="#formbooking" data-placeholder="Select a Provider..." class="form-select form-select-solid" name="booking_provider" id="booking_provider">
                                <?php echo $provider;?>
                            </select>
                        </div>
                        <div class="fv-row col-md-12 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Polyclinic</label>
                            <select data-control="select2" data-dropdown-parent="#formbooking" data-placeholder="Select a Polyclinic..." class="form-select form-select-solid" name="booking_poliid" id="booking_poliid">
                                <?php echo $poliklinik;?>
                            </select>
                        </div>
                        <div class="fv-row col-md-12 pb-10">
                            <label class="fs-6 fw-bold mb-2 required">Doctor</label>
                            <select data-control="select2" data-dropdown-parent="#formbooking" data-placeholder="Select a Doctor..." class="form-select form-select-solid" name="booking_doctorid" id="booking_doctorid">
                                <?php echo $doctor;?>
                            </select>
                        </div>
                        <div class="fv-row col-md-12 pb-10"><div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']" id="jadwaldokter"></div></div>
                    </div>
                </div>

                <div data-kt-stepper-element="content" class="text-center">
                    <div class="w-100 row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm p-5">
                                <div class="pb-5">
                                    <i class="fas fa-check-circle text-success fa-5x"></i>
                                </div>
                                <h2 class="fw-bolder text-dark">Booking Completed Successfully!</h2>
                                <p class="text-muted fw-bold fs-6">
                                    Your outpatient clinic booking has been successfully processed.  
                                    Please check your email or SMS for further details.
                                </p>
                                <a href="./RJNonBPJS" class="btn btn-primary mt-4" data-kt-element="complete-start">Back to Home</a>
                            </div>
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