<div class="modal fade" id="kt_modal_new_contact" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">New Contact</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form id="formcontact" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" name="contact_primary" id="contact_primary" />
                                <label class="form-check-label" for="flexSwitchDefault">
                                    Primary
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Name</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" id="contact_name" name="contact_name">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Relationship</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_new_contact" data-placeholder="Select an option" id="contact_relationship" name="contact_relationship">
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Address</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <textarea class="form-control form-control-solid" id="contact_address" name="contact_address"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Phone Number</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <input type="number" class="form-control form-control-solid" id="contact_phone" name="contact_phone">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">
                    <button type="submit" id="kt_contact_submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_address" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">New Address</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form id="formaddress" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" name="address_primary" id="address_primary" />
                                <label class="form-check-label" for="flexSwitchDefault">
                                    Primary
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Label</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" id="address_label" name="address_label">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Address</div>
                        </div>
                        <div class="col-xl-8 fv-row fv-plugins-icon-container">
                            <textarea class="form-control form-control-solid" id="address" name="address"></textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">
                    <button type="submit" id="kt_address_submit" class="btn btn-lg btn-primary w-100 mb-5">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>