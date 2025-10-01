<div class="modal fade" id="modal_simulasi_idrg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-light-primary"  id="btngroupingidrg" name="btngroupingidrg" onclick="groupingidrg()">Grouping</a>
                    </div>
                    <div class="table-responsive mt-5" id="resultgroupingidrg"></div>
                    <div class="d-flex justify-content-end mt-5">
                        <a class="btn btn-sm btn-light-primary"  id="btnfinalidrg" name="btnfinalidrg" onclick="finalidrg()">Final iDRG</a>
                    </div>
                    <div class="d-flex justify-content-end mt-5">
                        <a class="btn btn-sm btn-light-primary"  id="btneditidrg" name="btneditidrg" onclick="editidrg()">Edit Ulang iDRG</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>