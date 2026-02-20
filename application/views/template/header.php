<div id="kt_header" style="" class="header align-items-stretch">
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
				<span class="svg-icon svg-icon-2x mt-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
						<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
					</svg>
				</span>
			</div>
		</div>
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
			<a href='../dashboard/dashboard' class="d-lg-none">
				<img alt="Logo" src="<?php echo base_url();?>assets/images/logo/dtechnology.png" class="h-50px" />
			</a>
		</div>
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">

			<div class="d-flex align-items-stretch" id="kt_header_nav">
				<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
					<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
						<?php echo $menuheader; ?>
						<div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
							<span class="menu-link py-3">
								<span class="menu-title">Referensi</span>
								<span class="menu-arrow d-lg-none"></span>
							</span>
							<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown w-100 w-lg-600px p-5 p-lg-5">
								<div class="row" data-kt-menu-dismiss="true">
									<?php echo $referensi; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex align-items-stretch flex-shrink-0">
				<div class="d-flex align-items-stretch flex-shrink-0">

					<div class="d-flex align-items-center ms-1 ms-lg-3">
						<div class="btn btn-icon btn-active-light-primary position-relative w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black" />
									<path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black" />
									<path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black" />
									<path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black" />
								</svg>
							</span>
							<span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
						</div>

						<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
							<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('<?php echo base_url('assets/images/misc/pattern-1.jpg'); ?>')">
								<h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications
								<span class="fs-8 opacity-75 ps-3" id="jumlahnotification"></span></h3>
								<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-bold px-9">
									<li class="nav-item">
										<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#tab_disposisi">Disposisi</a>
									</li>
								</ul>
							</div>
							
							<div class="tab-content">
								<div class="tab-pane fade show active" id="tab_disposisi" role="tabpanel">
									<div class="scroll-y mh-325px my-5 px-8" id="notificationdisposisi"></div>
									<div class="py-3 text-center border-top">
										<a href="../../index.php/surat/disposisi" class="btn btn-color-gray-600 btn-active-color-primary">View All
											<span class="svg-icon svg-icon-5">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
													<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
												</svg>
											</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="d-flex align-items-center ms-1 ms-lg-3">
						<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
									<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
								</svg>
							</span>
						</div>

						<div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
							<div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('<?php echo base_url('assets/images/misc/pattern-1.jpg'); ?>')">
								<h3 class="text-white fw-bold mb-3">Quick Links</h3>
								<span class="badge bg-primary py-2 px-3">0 pending tasks</span>
							</div>
							<div class="row g-0">
								<?php echo $quicklink; ?>
							</div>
							<div class="py-2 text-center border-top">
								<a href="#" class="btn btn-color-gray-600 btn-active-color-primary">View All
									<span class="svg-icon svg-icon-5">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
											<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
										</svg>
									</span>
								</a>
							</div>
						</div>
					</div>

					<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
						<div class="btn btn-active-light d-flex align-items-center bg-hover-light py-2 px-2 px-md-3 show menu-dropdown" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
							<div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2">
								<span class="text-muted fs-7 fw-bold lh-1 mb-2">Hello</span>
								<span class="text-dark fs-base fw-bolder lh-1"><?php echo $_SESSION['name']?></span>
							</div>
							<div class="symbol symbol-30px symbol-md-40px">
								<?php
									$colors      = ['danger', 'warning', 'success', 'primary'];
									$randomIndex = array_rand($colors);
									$randomColor = $colors[$randomIndex];
									
									if($_SESSION['imgprofile']==="Y"){
										echo "<img src='".base_url()."assets/images/avatars/".$_SESSION['userid'].".jpeg' alt='user' />";
									}else{
										echo "<div class='symbol-label fs-3 bg-light-".$randomColor." text-".$randomColor."'>".$_SESSION['initial']."</div>";
									}
								?>
							</div>
						</div>

						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-400px" data-kt-menu="true">
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<div class="symbol symbol-50px me-5">
										<?php
											if($_SESSION['imgprofile']==="Y"){
												echo "<img src='".base_url()."assets/images/avatars/".$_SESSION['userid'].".jpeg' alt='user' />";
											}else{
												echo "<div class='symbol-label fs-3 bg-light-".$randomColor." text-".$randomColor."'>".$_SESSION['initial']."</div>";
											}
										?>
									</div>
									<div class="d-flex flex-column">
										<div class="fw-bolder d-flex align-items-center fs-5">
											<?php echo $_SESSION['name']?>
											
										</div>
										<div class="d-flex justify-content-start">
											<span class="badge badge-light-success fw-bolder fs-8"><?php echo $_SESSION['hospitalname']?></span>
										</div>
										
										<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?php echo $_SESSION['email']?></a>
									</div>
								</div>
							</div>
							<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
								<a href="../profile/overview" class="menu-link px-5">
									<span class="menu-title">My Profile</span>
									<span class="menu-arrow"></span>
								</a>
								<div class="menu-sub menu-sub-dropdown w-175px py-4" style="">
									<?php echo $menuprofileshortcut ?>
								</div>
							</div>
							<div class="separator my-2"></div>
							<div class="menu-item px-5">
								<a data-bs-toggle="modal" data-bs-target="#modal_root_change_password" class="menu-link px-5">Change Password</a>
							</div>
							<div class="menu-item px-5">
								<a data-bs-toggle="modal" data-bs-target="#modal-logout" class="menu-link px-5">Sign Out</a>
							</div>
						</div>
					</div>

					<!-- <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
						<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
									<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
								</svg>
							</span>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>