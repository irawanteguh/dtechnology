<div class="modal fade" id="editmodules" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/mastermodules/editmastermodules" id="formeditmastermodules">
                <input type="hidden" id="modulesid-edit" name="modulesid-edit">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Edit Master Modules</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin memperbaharui modules ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Modules Header</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Header Modules"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#editmodules" data-placeholder="Select a Modules Header..." class="form-select form-select-sm form-select-solid" name="modulesheader-edit" id="modulesheader-edit">
                                <?php echo $modulesheader;?>
                            </select>
                        </div>
                        <div class="col-md-5 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Modules Header</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Modules Status"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#editmodules" data-placeholder="Select a Modules Status..." class="form-select form-select-sm form-select-solid" name="modulesstatus-edit" id="modulesstatus-edit">
                                <?php echo $modulesstatus;?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Parent</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Type Parent"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#editmodules" data-placeholder="Select a Type Parent..." class="form-select form-select-sm form-select-solid" name="modulesparent-edit" id="modulesparent-edit">
                                <?php echo $parent;?>
                            </select>
                        </div>
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Modules Name</span>
                            </label>
							<input class="form-control form-control-sm form-control-solid" placeholder="Silakan Masukan Modules Name" id="modulesname-edit" name="modulesname-edit" />
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Version</span>
                            </label>
							<input class="form-control form-control-sm form-control-solid" placeholder="Version" id="modulesversion-edit" name="modulesversion-edit" />
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Package</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-sm form-control-solid" id="modulespackage-edit" name="modulespackage-edit">
                                <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Modules Controllers</span>
                            </label>
							<input class="form-control form-control-sm form-control-solid" placeholder="Silakan Masukan Modules Controllers" id="modulescontrollers-edit" name="modulescontrollers-edit" />
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Modules Icon</span>
                            </label>
							<input class="form-control form-control-sm form-control-solid" placeholder="Silakan Masukan Modules Controllers" id="modulesicon-edit" name="modulesicon-edit" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn-modules-edit" type="submit" value="PERBAHARUI DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusmodules" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/mastermodules/hapusmastermodules" id="formhapusmastermodules">
                <input type="hidden" id="modulesid-hapus" name="modulesid-hapus">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Hapus Master Modules</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin menghapus modules ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Name</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesname-hapus" name="modulesname-hapus" readonly>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Version</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesversion-hapus" name="modulesversion-hapus" readonly>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Package</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-sm form-control-solid" id="modulespackage-hapus" name="modulespackage-hapus" readonly>
                                <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Controllers</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulescontrollers-hapus" name="modulescontrollers-hapus" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-danger" id="btn-modules-hapus" type="submit" value="HAPUS DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hidemodules" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/mastermodules/hidemastermodules" id="formhidemastermodules">
                <input type="hidden" id="modulesid-hide" name="modulesid-hide">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Hide Master Modules</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin hide modules ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Name</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesname-hide" name="modulesname-hide" readonly>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Version</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesversion-hide" name="modulesversion-hide" readonly>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Package</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-sm form-control-solid" id="modulespackage-hide" name="modulespackage-hide" readonly>
                                <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Controllers</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulescontrollers-hide" name="modulescontrollers-hide" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-danger" id="btn-modules-hide" type="submit" value="HIDE MODULES" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="unhidemodules" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/masterroot/mastermodules/unhidemastermodules" id="formunhidemastermodules">
                <input type="hidden" id="modulesid-unhide" name="modulesid-unhide">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Unhide Master Modules</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin Unhide modules ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Name</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesname-unhide" name="modulesname-unhide" readonly>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Version</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulesversion-unhide" name="modulesversion-unhide" readonly>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Package</label>
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-sm form-control-solid" id="modulespackage-hide" name="modulespackage-hide" readonly>
                                <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                    <i class="bi bi-box"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Modules Controllers</label>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="modulescontrollers-hide" name="modulescontrollers-hide" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-success" id="btn-modules-unhide" type="submit" value="UN HIDE MODULES" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>
