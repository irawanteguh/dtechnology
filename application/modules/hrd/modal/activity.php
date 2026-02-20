<div class="modal fade" id="modal_activity_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/activity/addactivity" id="formaddactivity">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add Master Activity</h1>
                        <div class="text-muted fw-bold fs-5">Silakan Melakukan Penambahan Master Activity</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Activity Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_name_add" name="data_activity_name_add" required>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Durasi</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_durasi_add" name="data_activity_durasi_add" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_activity_add" type="submit" value="SIMPAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_activity_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/activity/editactivity" id="formeditactivity">
                <input type="hidden" id="data_activity_id_edit" name="data_activity_id_edit">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Master Activity</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin melakukan perubahan aktivitas ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Activity Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_name_edit" name="data_activity_name_edit" required>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Durasi</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_durasi_edit" name="data_activity_durasi_edit" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_activity_edit" type="submit" value="PERUBAHAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_activity_hapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/activity/hapusactivity" id="formhapusactivity">
                <input type="hidden" id="data_activity_id_hapus" name="data_activity_id_hapus">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Hapus Master Activity</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin menghapus aktivitas ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Activity Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_name_hapus" name="data_activity_name_hapus" readonly>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Durasi</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_durasi_hapus" name="data_activity_durasi_hapus" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-danger" id="btn_activity_hapus" type="submit" value="HAPUS DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_activity_active" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/hrd/activity/aktifactivity" id="formaktifactivity">
                <input type="hidden" id="data_activity_id_aktif" name="data_activity_id_aktif">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Aktivasi Master Activity</h1>
                        <div class="text-muted fw-bold fs-5">Apakah anda yakin ingin mengaktifkan aktivitas ini ?</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Activity Name</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_name_aktif" name="data_activity_name_aktif" readonly>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Durasi</label>
                            <input type="text" class="form-control form-control-solid" id="data_activity_durasi_aktif" name="data_activity_durasi_aktif" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-success" id="btn_activity_aktif" type="submit" value="AKTIFKAN DATA" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>