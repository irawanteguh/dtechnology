<div class="modal fade" id="modal_standart_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/akreditasi/selfassessment/addstandart" id="formaddstandart">
                <input type="hidden" id="modal_standart_babid" name="modal_standart_babid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Tambah Standar Penilaian</h1>
                        <div class="text-muted fw-bold fs-5">
                            Tambahkan standar penilaian baru untuk evaluasi dan monitoring mutu layanan.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Standart Penilaian :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_standart_add_penilaian" name="modal_standart_add_penilaian" required>
                        </div>
                        <div class="col-md-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Definisi Operasional</label>
                            <textarea class="form-control form-control-lg form-control-solid" name="modal_standart_add_do" id="modal_standart_add_do" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_standart_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_element_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/akreditasi/selfassessment/addelement" id="formaddelement">
                <input type="hidden" id="modal_element_babid" name="modal_element_babid">
                <input type="hidden" id="modal_element_standartid" name="modal_element_standartid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Tambah Elemen Penilaian</h1>
                        <div class="text-muted fw-bold fs-5">
                            Tambahkan elemen penilaian baru untuk evaluasi dan monitoring mutu layanan.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Elemen Penilaian :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_element_add_penilian" name="modal_element_add_penilian" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_standart_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_sub_element_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/akreditasi/selfassessment/addsubelement" id="formaddsubelement">
                <input type="hidden" id="modal_sub_element_babid" name="modal_sub_element_babid">
                <input type="hidden" id="modal_sub_element_standartid" name="modal_sub_element_standartid">
                <input type="hidden" id="modal_sub_element_elementid" name="modal_sub_element_elementid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Tambah Sub Elemen Penilaian</h1>
                        <div class="text-muted fw-bold fs-5">
                            Tambahkan elemen penilaian baru untuk evaluasi dan monitoring mutu layanan.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Sub Elemen Penilaian :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_sub_element_add_penilian" name="modal_sub_element_add_penilian" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_sub_element_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_penilaian" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/akreditasi/selfassessment/addsubelement" id="formaddsubelement">
                <input type="hidden" id="modal_penilaian_babid" name="modal_penilaian_babid">
                <input type="hidden" id="modal_penilaian_standartid" name="modal_penilaian_standartid">
                <input type="hidden" id="modal_penilaian_elementid" name="modal_penilaian_elementid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Penilaian Elemen</h1>
                        <div class="text-muted fw-bold fs-5">
                            Kelola dan tambahkan elemen penilaian untuk pemantauan serta peningkatan mutu layanan.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nilai :</label>
                            <select data-control="select2" data-dropdown-parent="#modal_penilaian" data-placeholder="Silakan Pilih Nilai" class="form-select form-select-solid" id="modal_penilaian_nilaiid" name="modal_penilaian_nilaiid" required>
                                <?php echo $masternilai;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_sub_element_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_upload_document" tabindex="-1" aria-hidden="true" enctype="multipart/form-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/akreditasi/selfassessment/adddocument" id="formadddocument">
                <input type="hidden" id="modal_upload_document_babid" name="modal_upload_document_babid">
                <input type="hidden" id="modal_upload_document_standartid" name="modal_upload_document_standartid">
                <input type="hidden" id="modal_upload_document_elementid" name="modal_upload_document_elementid">

                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Upload Document</h1>
                        <div class="text-muted fw-bold fs-5">Please fill in this form</div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Nama Dokumen</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <input class="form-control form-control-solid" name="modal_upload_document_name" id="modal_upload_document_name"/>
                        </div>
                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Catatan</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <input class="form-control form-control-solid" name="modal_upload_document_note" id="modal_upload_document_note"/>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Upload Document</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <input type="file" class="form-control" name="modal_upload_document_file" id="modal_upload_document_file" accept=".pdf">
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_upload_document_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>