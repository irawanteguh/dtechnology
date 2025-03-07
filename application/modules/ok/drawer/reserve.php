<div id="kt_drawer_chat_reserve" class="bg-body drawer drawer-end" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close" style="width: 500px !important;">
	<div class="card w-100 rounded-0" id="kt_drawer_chat_messenger">
		<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
			<div class="card-title">
				<div class="d-flex justify-content-center flex-column me-3">
					<a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="kt_drawer_chat_reserve_namapasien"></a>
					<div class="mb-0 lh-1">
						<span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
						<span class="fs-7 fw-bold text-muted">Active</span>
					</div>
				</div>
			</div>
			<!-- <div class="card-toolbar">
				<div class="me-2">
					<button class="btn btn-sm btn-icon btn-active-light-primary show menu-dropdown" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
						<i class="bi bi-three-dots fs-3"></i>
					</button>
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3 show" data-kt-menu="true" data-popper-placement="bottom-end" style="z-index: 111; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-57px, 51px);">
						<div class="menu-item px-3">
							<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Contacts</div>
						</div>
						<div class="menu-item px-3">
							<a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Add Contact</a>
						</div>
						<div class="menu-item px-3">
							<a href="#" class="menu-link flex-stack px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">Invite Contacts
							<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify a contact email to send an invitation" aria-label="Specify a contact email to send an invitation"></i></a>
						</div>
						<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
							<a href="#" class="menu-link px-3">
								<span class="menu-title">Groups</span>
								<span class="menu-arrow"></span>
							</a>
							<div class="menu-sub menu-sub-dropdown w-175px py-4" style="">
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">Create Group</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">Invite Members</a>
								</div>
								<div class="menu-item px-3">
									<a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">Settings</a>
								</div>
							</div>
						</div>
						<div class="menu-item px-3 my-1">
							<a href="#" class="menu-link px-3" data-bs-toggle="tooltip" title="" data-bs-original-title="Coming soon">Settings</a>
						</div>
					</div>
				</div>
				<div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
					<span class="svg-icon svg-icon-2">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
						</svg>
					</span>
				</div>
			</div> -->
		</div>

		<div class="card-body" id="kt_drawer_chat_messenger_body">
			<div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px" style="height: 652px;" id="chatfollowup"></div>
		</div>
		<div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
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


<div class="d-flex justify-content-start mb-10">
	<div class="d-flex flex-column align-items-start">
		<div class="d-flex align-items-center mb-2">
			<div class="symbol symbol-35px symbol-circle">
				<img alt="Pic" src="assets/media/avatars/150-15.jpg">
			</div>
			<div class="ms-3">
				<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Brian Cox</a>
				<span class="text-muted fs-7 mb-1">2 mins</span>
			</div>
		</div>
		<div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">How likely are you to recommend our company to your friends and family ?</div>
	</div>
</div>