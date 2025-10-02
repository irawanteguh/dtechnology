<div class="modal fade" id="modal_add_ppk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/casemix/masterppk/addppk" id="formaddppk">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add Panduan Praktek Klinis</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Nama Panduan Praktek Klinis :</label>
                        <input type="text" class="form-control form-control-solid" id="modal_add_ppk_name" name="modal_add_ppk_name" required>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="modal_add_ppk_btn" name="modal_add_ppk_btn" type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_simulasi_idrg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body py-3">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Simulasi Perhitungan Coding iDRG</h1>
                    <div class="text-muted fw-bold fs-5"></div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <tbody class="text-gray-600 fw-bold" id="resultdatadetaildiagnosappk"></tbody>
                        </table>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary"  id="btngroupingidrg" name="btngroupingidrg" onclick="groupingidrg()">Grouping</a>
                    </div>
                    <div class="table-responsive mt-5" id="resultgroupingidrg"></div>
                    <div class="separator my-2"></div>
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-8 gy-2">
                            <tbody class="text-gray-600 fw-bold" id="resultdatadetaildiagnosappkinacbg"></tbody>
                        </table>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-info"  id="btnimportidrg" name="btnimportidrg" onclick="importidrg()">Import Coding</a>
                        <a class="btn btn-sm btn-warning ms-4"  id="btneditidrg" name="btneditidrg" onclick="editidrg()">Edit Ulang iDRG</a>
                        <a class="btn btn-sm btn-success"  id="btnfinalidrg" name="btnfinalidrg" onclick="finalidrg()">Final iDRG</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>