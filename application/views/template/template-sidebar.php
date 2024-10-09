<!DOCTYPE html>
<html lang="en">
	<head>
		<?php          
			include_once(APPPATH."views/template/head.php");
		?>
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<?php 
					include_once(APPPATH."views/template/aside.php");  
				?>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?php 
						include_once(APPPATH."views/template/header.php");  
					?>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<?php 
							include_once(APPPATH."views/template/toolbar.php");  
						?>
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-fluid">
								<?php
									if($_SESSION['trial']==="Y"){
										echo 	"<div class='alert alert-dismissible bg-light-danger border border-danger border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 fa-fade'>
													<span class='svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0'>
														<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
															<path opacity='0.3' d='M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z' fill='black'></path>
															<path d='M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z' fill='black'></path>
														</svg>
													</span>
													<div class='d-flex flex-column pe-0 pe-sm-10'>
														<h5 class='mb-1'>For Your Information</h5>
														<span>Saat Ini <b>".$_SESSION['hospitalname']."</b> Anda Menggunakan Free Trial System</span>
													</div>
												</div>";
									}

									$segment   = $this->uri->segment(1);
									$directory = APPPATH.'modules/'.$segment.'/notification/'.$this->uri->segment(2).".php";
									if(file_exists($directory)){
										include($directory);
									}

									if($this->uri->segment(1) === "profile"){
										include(APPPATH."views/template/profile.php");
									}

									echo $contents
								?>
							</div>
						</div>
					</div>
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
								<div class="text-muted"> 2024© Copyright &copy; DTechnology For Use <a href="<?php echo $_SESSION['website'] ?>" target="_blank"><?php echo $_SESSION['hospitalname'] ?></a> | Page rendered in <strong>{elapsed_time}</strong> seconds. | Ip Address : <strong><?php echo $_SERVER['REMOTE_ADDR']?></strong></div>
							</div>
							<div><a href="#">Privacy Policy</a>&middot;<a href="#">Terms &amp; Conditions</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <button id="kt_explore_toggle" class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0" title="Explore Metronic" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
			<span id="kt_explore_toggle_label">Explore</span>
		</button> -->

		<?php
			$dirdrawer = APPPATH.'views/template/drawer/';
			if (is_dir($dirdrawer)) {
				$files = glob($dirdrawer . '*.php');
				foreach ($files as $file){
					include($file);
				}
			}
			
			$dirmodal = APPPATH.'views/template/modal/';
			if (is_dir($dirmodal)) {
				$files = glob($dirmodal . '*.php');
				foreach ($files as $file){
					include($file);
				}
			}

			$directory = APPPATH.'modules/'.$this->uri->segment(1).'/modal/'.$this->uri->segment(2).".php";
			if(file_exists($directory)){
				include($directory);
			}

			$directory = APPPATH.'modules/'.$this->uri->segment(1).'/drawer/'.$this->uri->segment(2).".php";
			if(file_exists($directory)){
				include($directory);
			}
			
		?>
		
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
		</div>
		<?php      
			include_once(APPPATH."views/template/script.php");
		?>
	</body>
</html>