<div class="modal fade" id="modal_sign_add_tilaka" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/tte/repodocument/adddocument" id="formadddocument" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Sign Document By Tilaka</h1>
                        <div class="text-muted fw-bold fs-5">Please Sign Document</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
							<label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span class="required">Signer :</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih User Yang Melakukan Tanda Tangan Dokumen"></i>
							</label>
							<select data-control="select2" data-dropdown-parent="#modal_sign_add_tilaka" data-placeholder="Please Select Assign" class="form-select form-select-solid" name="modal_sign_add_tilaka_assign" id="modal_sign_add_tilaka_assign" required>
								<?php echo $assign;?>
							</select>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span>Type Document :</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Masukan Jenis Dokumen Anda"></i>
							</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sign_add_tilaka_type" name="modal_sign_add_tilaka_type">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span>Informasi 1 :</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Tambahkan Informasi Terkait Dokumen"></i>
							</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sign_add_tilaka_informasi1" name="modal_sign_add_tilaka_informasi1">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
								<span>Informasi 2 :</span>
								<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Tambahkan Informasi Terkait Dokumen"></i>
							</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sign_add_tilaka_informasi2" name="modal_sign_add_tilaka_informasi2">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Upload Document</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Upload Dokumen Yang Akan Di Tanda Tangani"></i>
                            </label>
                            <input type="file" class="form-control" name="modal_sign_add_tilaka_document" id="modal_sign_add_tilaka_document" accept=".pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_sign_add_tilaka_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>