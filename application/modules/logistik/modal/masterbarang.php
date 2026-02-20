<div class="modal fade" id="modal_new_barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistik/masterbarang/additem" id="formadditem">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Add Item Master</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Item Name :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_new_item" name="modal_new_item" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_position_add" type="submit" value="SUBMIT" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/logistik/masterbarang/edititem" id="formedititem">
                <input type="hidden" name="modal_edit_itemid" id="modal_edit_itemid">
                <div class="modal-body">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Edit Item Master</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2 required">Item Name :</label>
                            <input type="text" class="form-control form-control-solid" id="modal_edit_item" name="modal_edit_item" required>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Item Type</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Item Type"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_edit_barang" data-placeholder="Please Select Item Type" class="form-select form-select-solid" name="modal_edit_itemtype" id="modal_edit_itemtype" required>
                                <?php echo $itemtype;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Category</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Category"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_edit_barang" data-placeholder="Please Select Category" class="form-select form-select-solid" name="modal_edit_category" id="modal_edit_category" required>
                                <?php echo $category;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Classification</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Classification"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_edit_barang" data-placeholder="Please Select Classification" class="form-select form-select-solid" name="modal_edit_classification" id="modal_edit_classification" required>
                                <?php echo $classification;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Purchase Unit</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Purchase Unit"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_edit_barang" data-placeholder="Please Select Purchase Unit" class="form-select form-select-solid" name="modal_edit_pu" id="modal_edit_pu" required>
                                <?php echo $pu;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Unit of Use</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Unit of Use"></i>
                            </label>
                            <select data-control="select2" data-dropdown-parent="#modal_edit_barang" data-placeholder="Please Select Unit of Use" class="form-select form-select-solid" name="modal_edit_uu" id="modal_edit_uu" required>
                                <?php echo $uu;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-1">				
                    <input class="btn btn-light-primary" id="btn_item_edit" type="submit" value="UPDATE" name="simpan" >
                </div>
            </form>
        </div>
    </div>
</div>