<div class="modal fade" id="modal-edituser" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbaharui Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo base_url();?>index.php/tilaka/registrasiusertilaka/edituser" id="formedituser">
                <input type="hidden" id="userid-edit" name="userid-edit">
                <div class="modal-body">
                    <div class="col-md-12 row">   
                        <div class="form-group col-md-3">
                            <label class="col-form-label" for="nikrs-edit">NIK Rumah Sakit</label>
                            <input type="text" class="form-control form-control-sm" id="nikrs-edit" name="nikrs-edit" readonly>
                        </div>                                  
                        <div class="form-group col-md-9">
                            <label class="col-form-label" for="namakryawan-edit">Nama Karyawan</label>
                            <input type="text" class="form-control form-control-sm" id="namakryawan-edit" name="namakryawan-edit" readonly>
                        </div>   
                        <div class="form-group col-md-3">
                            <label class="col-form-label" for="noktp-edit">NO KTP</label>
                            <input type="text" class="form-control form-control-sm" id="noktp-edit" name="noktp-edit">
                        </div>                                  
                        <div class="form-group col-md-9">
                            <label class="col-form-label" for="email-edit">Email Address</label>
                            <input type="text" class="form-control form-control-sm" id="email-edit" name="email-edit">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-form-label" for="filektp">Upload KTP</label>
                            <div class="custom-file" id="filektp">
                                <input type="file" class="custom-file-input" id="file_doc" name="file_doc">
                                <label class="custom-file-label" for="file_doc">Format Jpeg</label>
                            </div>
                            <small class="form-text text-muted font-italic">File Document Dalam Format .Jpeg</small>
                        </div>                                          
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-outline-primary" id="btnproses" type="submit" value="SIMPAN" name="simpan" >			
                </div>  
            </form>  
            
        </div>
    </div>
</div>