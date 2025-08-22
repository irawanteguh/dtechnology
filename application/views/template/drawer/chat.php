<div id="drawer_chat" class="bg-body drawer drawer-end" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close" style="width: 500px !important;">
	<div class="card w-100 rounded-0" id="kt_drawer_chat_messenger">
		<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
			<div class="card-title">
				<div class="d-flex justify-content-center flex-column me-3">
					<a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="drawer_chat_judul"></a>
					<div class="mb-0 lh-1">
						<span class="badge badge-success badge-circle w-10px h-10px me-1 fa fa-fade"></span>
						<span class="fs-7 fw-bold text-muted" id="drawer_chat_detail"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body" id="kt_drawer_chat_messenger_body">
			<div class="scroll-y me-n5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" style="height: 652px;" id="transaksichat"></div>
		</div>
		<div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
			<input type="hidden" id="drawer_chat_refid" name="drawer_chat_refid">
			<textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
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
</div>