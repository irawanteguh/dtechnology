<div class="modal fade" id="modal_edituser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Perbaharui Data Karyawan</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/bsre/registrasi/edituser" id="formedituser">
                <input type="hidden" id="userid-edit" name="userid-edit">
                <div class="modal-body">
                    <div class="text-start mb-5">
                        <div class="text-muted fw-bold fs-5">Silakan memperbaharui data karyawan</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 row">
                            <div class="col-md-2">
                                <div class="col-md-12 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span>Avatar</span>
                                    </label>
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?php echo base_url()?>assets/images/avatars/blank.png)">
                                        <?php                                            
                                            if($_SESSION['imgprofile']==="Y"){
                                                $imageUrl = base_url() . "assets/images/avatars/".$_SESSION['userid'].".jpeg";
                                            }else{
                                                $imageUrl = base_url() . "assets/images/avatars/blank.png";
                                            }
                                            echo "<div class='image-input-wrapper w-125px h-125px' style='background-image: url(".$imageUrl.")'></div>";
                                        ?>

                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="avatar" id="avatar" accept=".jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-10 row">
                                <div class="col-md-12 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">NIK Rumah Sakit</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="nikrs-edit" name="nikrs-edit" readonly>
                                </div>                                  
                                <div class="col-md-6 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nama Karyawan</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="namakaryawan-edit" name="namakaryawan-edit" readonly>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nama Sesuai KTP</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan masukan nama sesuai KTP"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="namaktp-edit" name="namaktp-edit">
                                </div>  
                                <div class="col-md-4 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nomor Kartu Tanda Penduduk</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan no KTP anda yang aktif"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Silakan Masukan Nomor KTP" id="noktp-edit" name="noktp-edit" minlength="16" maxlength="16" required>
                                    <span class="fs-9 text-muted">Nomor Kartu Tanda Penduduk Maksimal 16 Digit</span>
                                </div>                                
                                <div class="col-md-8 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Email Address</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan alamat email anda yang aktif"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Silakan Masukan Alamat Email Anda" id="email-edit" name="email-edit" required>
                                </div>
                            </div>
                        </div>                                        
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="modal_edituser_btn" type="submit" value="UPDATE" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>