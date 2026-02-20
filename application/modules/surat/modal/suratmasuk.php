<div class="modal fade" id="modal_suratmasuk_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/surat/suratmasuk/insertsuratmasuk" id="forminsertsuratmasuk" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add Surat Masuk</h1>
                        <div class="text-muted fw-bold fs-5">
                            Input data surat masuk untuk keperluan administrasi dan dokumentasi internal.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Nomor Urut :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_suratmasuk_add_nourut" name="modal_suratmasuk_add_nourut">
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Nomor Agenda :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_suratmasuk_add_noagenda" name="modal_suratmasuk_add_noagenda">
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">Kode Surat :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_suratmasuk_add_kodesurat" name="modal_suratmasuk_add_kodesurat">
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Tanggal Masuk :</label>
                            <input class="form-control form-control-solid flatpickr-input" name="modal_suratmasuk_add_tglmasuk" placeholder="Tanggal Masuk" id="modal_suratmasuk_add_tglmasuk" type="text" required>
                        </div>
                        <div class="col-xl-9 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nomor Surat :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_suratmasuk_add_nosurat" name="modal_suratmasuk_add_nosurat" required>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Tanggal Surat :</label>
                            <input class="form-control form-control-solid flatpickr-input" name="modal_suratmasuk_add_tglsurat" placeholder="Tanggal Surat" id="modal_suratmasuk_add_tglsurat" type="text" required>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Asal Surat</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Asal Surat External / Internal"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_suratmasuk_add" data-placeholder="Silakan Pilih Asal Surat" class="form-select form-select-solid" name="modal_suratmasuk_add_asalsurat" id="modal_suratmasuk_add_asalsurat" required>
                                <?php echo $asalsurat;?>
                            </select>
                        </div>
                        <div class="col-xl-9 mb-5" id="input_pengirim_wrapper">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Pengirim Surat :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_suratmasuk_add_pengirimsurat_txt" name="modal_suratmasuk_add_pengirimsurat_txt" required>
                        </div>

                        <div class="col-xl-9 mb-5 d-none" id="select_pengirim_wrapper">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Pengirim Surat</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Pengirim Surat"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_suratmasuk_add" data-placeholder="Silakan Pilih Pengirim Surat" class="form-select form-select-solid" name="modal_suratmasuk_add_pengirimsurat_id" id="modal_suratmasuk_add_pengirimsurat_id" required>
                                <?php echo $pengirimsurat;?>
                            </select>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Perihal :</label>
                            <textarea class="form-control form-control-lg form-control-solid" name="modal_suratmasuk_add_perihal" id="modal_suratmasuk_add_perihal" required></textarea>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Ringkasan Surat :</label>
                            <textarea class="form-control form-control-lg form-control-solid" name="modal_suratmasuk_add_ringkasan" id="modal_suratmasuk_add_ringkasan" required></textarea>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Upload Surat :</label>
                            <input type="file" class="form-control form-control-lg" name="modal_suratmasuk_add_file" id="modal_suratmasuk_add_file" accept=".pdf" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_suratmasuk_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>