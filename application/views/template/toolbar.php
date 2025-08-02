<div class="toolbar" id="kt_toolbar">
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		
		<!-- <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
			<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
			<span class="h-20px border-gray-200 border-start mx-4"></span>
			<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
				<li class="breadcrumb-item text-muted">
					<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
				</li>
				<li class="breadcrumb-item">
					<span class="bullet bg-gray-200 w-5px h-2px"></span>
				</li>
				<li class="breadcrumb-item text-dark">Light Aside</li>
			</ul>
		</div> -->

		<div class="d-flex align-items-center me-5 mb-3 mb-md-0">
			<!-- <div class="d-flex align-items-center flex-shrink-0">
				<span class="fs-7 text-gray-700 fw-bolder pe-3">Actions:</span>
				<div class="d-flex flex-shrink-0">
					<div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Add a team member">
						<a href="#" class="btn btn-sm btn-icon btn-active-color-success" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
							<span class="svg-icon svg-icon-2x">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
									<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
									<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
								</svg>
							</span>
						</a>
					</div>
					<div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Create new account">
						<a href="#" class="btn btn-sm btn-icon btn-active-color-success" data-bs-toggle="modal" data-bs-target="#kt_modal_create_account">
							<span class="svg-icon svg-icon-2x">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="black" />
									<path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="black" />
								</svg>
							</span>
						</a>
					</div>
					<div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Invite friends">
						<a href="#" class="btn btn-sm btn-icon btn-active-color-success" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
							<span class="svg-icon svg-icon-2x">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black" />
									<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
									<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
									<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
								</svg>
							</span>
						</a>
					</div>
				</div>
			</div> -->

			<div class="d-flex align-items-center flex-shrink-0">
				<!-- <div class="bullet bg-secondary h-35px w-1px mx-5"></div> -->
				<?php
					$fileprogress = APPPATH . 'modules/' . $this->uri->segment(1) . '/progress/' . $this->uri->segment(2) . ".php";
					if(file_exists($fileprogress)){
						include_once($fileprogress);
					}
				?>
			</div>
		</div>

		<div class="d-flex align-items-center">
			<?php
				$filetoolbar        = APPPATH . 'modules/' . $this->uri->segment(1) . '/toolbar/' . $this->uri->segment(2) . ".php";
				$filefilter         = APPPATH . 'modules/' . $this->uri->segment(1) . '/filter/' . $this->uri->segment(2) . ".php";

				if(file_exists($filetoolbar)){
					echo '<div class="me-4">';
					if(file_exists($filefilter)){
						echo '
							<a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
								<span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
									</svg>
								</span>
								Filter
							</a>
							<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61484bf6e3ff8">
								<div class="px-7 py-5">
									<div class="fs-5 text-dark fw-bolder">Filter Options</div>
								</div>
								<div class="separator border-gray-200"></div>
								<div class="px-7 py-5">
						';
						include_once($filefilter);
						echo '
									<div class="d-flex justify-content-end">
										<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
										<button type="button" class="btn btn-sm btn-primary btn-apply" data-kt-menu-dismiss="true">Apply</button>
									</div>
								</div>
							</div>
						';
					}
					echo '</div>';
					if ($_SESSION['leveluser'] === "83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding'] === "Y") {
						?>
							<div class="d-flex align-items-center overflow-auto pt-3 pt-md-0 me-4">
								<div class="d-flex align-items-center">
									<span class="fs-7 fw-bolder text-gray-700 pe-4 text-nowrap">Rumah Sakit :</span>
									<select 
										data-control="select2" 
										data-placeholder="Please select" 
										class="form-select form-select-sm form-select-solid select2-hidden-accessible" 
										data-hide-search="true" 
										name="selectorganization" 
										id="selectorganization"
									>
										<?php echo $masterorganization; ?>
									</select>
								</div>
							</div>
						<?php
					}

					include_once($filetoolbar);
				} else {
					if(file_exists($filefilter)){
						echo '
							<a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
								<span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
									</svg>
								</span>
								Filter
							</a>
							<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61484bf6e3ff8">
								<div class="px-7 py-5">
									<div class="fs-5 text-dark fw-bolder">Filter Options</div>
								</div>
								<div class="separator border-gray-200"></div>
								<div class="px-7 py-5">
						';
						include_once($filefilter);
						echo '
									<div class="d-flex justify-content-end">
										<button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
										<button type="button" class="btn btn-sm btn-primary btn-apply" data-kt-menu-dismiss="true">Apply</button>
									</div>
								</div>
							</div>
						';
					}
				}
			?>
		</div>
	</div>
</div>
