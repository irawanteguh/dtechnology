<div class="modal fade" id="modal_disposisi_add" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/surat/suratmasuk/insertsuratmasuk" id="forminsertsuratmasuk" enctype="multipart/form-data">
                <div class="modal-body" style="height: 900px;">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Lembar Disposisi</h1>
                        <div class="text-muted fw-bold fs-5">
                            Input data surat masuk untuk keperluan administrasi dan dokumentasi internal.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6 row" id="modal_disposisi_lembardisposisi" name="modal_disposisi_lembardisposisi"></div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_suratmasuk_add_btn" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>