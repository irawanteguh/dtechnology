<div class="modal fade" id="modal_activity_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/kpi/activity/insertactivity" id="forminsertactivity">
                <input type="hidden" id="userid-edit" name="userid-edit">
                <div class="modal-body">
                    <div class="mb-10 text-center">
                        <h1 class="mb-3">Create Your Activity</h1>
                        <div class="text-muted fw-bold fs-5">If you need more info, please check
                        <a href="" class="fw-bolder link-primary" data-bs-toggle="modal" data-bs-target="#modal_activity_userguides">User Guidelines</a>.</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-4 mb-5">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Activity Date</label>
                                <input class="form-control form-control-solid flatpickr-input" name="data_activity_date_add" placeholder="Pick a start date" id="data_activity_date_add" type="text">
                            </div>
                        </div>
                        <div class="col-md-4 mb-5" data-kt-calendar="datepicker">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Activity Start Time</label>
                                <input class="form-control form-control-solid flatpickr-input" name="data_activity_time_start_add" placeholder="Pick a start time" id="data_activity_time_start_add" type="text">
                            </div>
                        </div>
                        <div class="col-md-4 mb-5" data-kt-calendar="datepicker">
                            <div class="fv-row">
                                <label class="fs-6 fw-bold mb-2 required">Activity End Time</label>
                                <input class="form-control form-control-solid flatpickr-input" name="data_activity_time_end_add" placeholder="Pick a end time" id="data_activity_time_end_add" type="text">
                            </div>
                        </div>
                        <div class="col-md-10 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Primary Activity</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Primary Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_activity_add" data-placeholder="Select a Primary Activity..." class="form-select form-select-solid" name="data_activity_primaryactivity_add" id="data_activity_primaryactivity_add">
                                    <?php echo $activity;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Volume</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Pilih Volume Activity"></i>
                                </label>
                                <select data-control="select2" data-dropdown-parent="#modal_activity_add" data-placeholder="Volume..." class="form-select form-select-solid" name="data_activity_volume_add" id="data_activity_volume_add">
                                    <?php echo $volume;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <div class="fv-row">
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Activity Description</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan Masukan Detail Kegiatan Anda"></i>
                                </label>
                                <textarea data-kt-autosize="true" class="form-control form-control-solid" name="data_activity_description_add" id="data_activity_description_add" placeholder="Silakan masukan kegiatan anda secara detail"></textarea>
                            </div>
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

<div class="modal fade" id="modal_activity_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 justify-content-end">
                <!-- <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="" id="kt_modal_view_event_edit" data-bs-original-title="Edit Event">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                        </svg>
                    </span>
                </div> -->
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="" id="kt_modal_view_event_delete" data-bs-original-title="Delete Event">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                        </svg>
                    </span>
                </div>
                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="" data-bs-dismiss="modal" data-bs-original-title="Hide Event">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" id="transidactivityview" name="transidactivityview">
                <div class="d-flex">
                    <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
                            <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
                            <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
                        </svg>
                    </span>
                    <div class="mb-9">
                        <div class="d-flex align-items-center mb-2">
                            <span class="fs-3 fw-bolder me-3" data-kt-calendar="event_name" id="eventname" name="eventname"></span>
                            <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                        </div>
                        <div class="fs-6" data-kt-calendar="event_description" id="validator" name="validator"></div>
                        <div class="fs-6" data-kt-calendar="event_description" id="eventdescription" name="eventdescription"></div>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <circle fill="#000000" cx="12" cy="12" r="8"></circle>
                        </svg>
                    </span>
                    <div class="fs-6">
                        <span class="fw-bolder">Starts</span>
                        <span data-kt-calendar="event_start_date" id="eventstartdate" name="eventstartdate"></span>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-9">
                    <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <circle fill="#000000" cx="12" cy="12" r="8"></circle>
                        </svg>
                    </span>
                    <div class="fs-6">
                        <span class="fw-bolder">Ends</span>
                        <span data-kt-calendar="event_end_date" id="eventenddate" name="eventenddate"></span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_activity_userguides" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="mb-10 text-center">
                    <h1 class="mb-3">User Guidelines</h1>
                    <div class="text-muted fw-bold fs-5">If you need more info, please check
                    <a href="../support/faq" class="fw-bolder link-primary">User Guidelines</a>.</div>
                </div>
                <div class="text-start">
                    <div class="alert alert-dismissible bg-light-warning border border-warning border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade">
                        <span class="svg-icon svg-icon-2hx svg-icon-warning me-4 mb-5 mb-sm-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"></path>
                                <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"></path>
                            </svg>
                        </span>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="mb-1">For Your Information</h5>
                            <ul>
                                <strong class="text-danger">Cara Pengisian / Pembuatan Kegiatan E-Kinerja</strong>
                                <li>Silakan Masukan Jam Mulai dan Jam Selesai Kegiatan Anda</li>
                                <li>Silakan Pilih Kegiatan Utama Anda</li>
                                <li>
                                    Silakan Pilih Volume Kegiatan Anda<br>
                                    <strong class="font-italic text-danger small">Jika Pilihan Volume Tidak Muncul Silakan Periksa Kembali Jam Mulai, Jam Selesai dan Pilihan Kegiatan Utama</strong>
                                </li>
                                <li>Silakan Tuliskan Secara Rinci Kegiatan Anda</li>
                                <li>Silakan Klik Tombol Simpan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-1">				
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
            </div>  
        </div>
    </div>
</div>