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
            <div class="modal-body">
                <input type="hidden" name="modal_disposisi_add_suratid" id="modal_disposisi_add_suratid">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Lembar Disposisi</h1>
                    <div class="text-muted fw-bold fs-5">
                        Input data surat masuk untuk keperluan administrasi dan dokumentasi internal.
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder m-5" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a id="lembardisposisi_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800 active" data-bs-toggle="tab" role="tab" href="#lembardisposisitab" aria-selected="true">Lembar Disposisi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="lampiran_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#lampirantab" aria-selected="false">Lampiran</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="lembardisposisitab" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="lembardisposisi_tab">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div id="kt_drawer_chat_messenger_body">
                                        <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" id="chatfollowup"></div>
                                    </div>
                                    <div class="pt-4" id="kt_drawer_chat_messenger_footer">
                                        <textarea class="form-control form-control-flush form-control-solid mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                                        <div class="d-flex flex-stack">
                                            <div class="d-flex align-items-center me-2">
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-paperclip fs-3"></i>
                                                </button>
                                                <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">
                                                    <i class="bi bi-upload fs-3"></i>
                                                </button>
                                            </div>
                                            <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 row" id="modal_disposisi_lembardisposisi" name="modal_disposisi_lembardisposisi"></div>
                            </div>
                        </div>
                        <div id="lampirantab" class="card-body p-0 tab-pane" role="tabpanel" aria-labelledby="lampiran_tab">
                            <div id="viewdoclembardisposisi" style="height:690px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>