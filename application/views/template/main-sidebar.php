<aside class="main-sidebar sidebar-light-olive elevation-4">
	<a href="#" class="brand-link bg-light">
		<img src="<?php echo base_url();?>assets/images/favicon/<?php if(isset($_SESSION['lokasiid'])){echo $_SESSION['lokasiid'];}else{echo "default";}?>.png" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light"><strong class="font-weight-bold">DTech</span>
	</a>

	<div class="sidebar">
		<div class="user-panel mb-3 d-flex">
			<div class="image d-flex align-items-center">
				<?php
				    if($_SESSION['imguser']==="Y"){
						echo "<img src='".base_url().$_SESSION['fotoprofile']."' class='img-circle elevation-2'>";
					}else{
						echo "<div class='user-profile'><div class='user-initial'>TE</div></div>";
					}
				?>
			</div>
			<div class="info">
				<a class="d-block">Logged in as:</a>
				<strong>
					<a href="#" class="d-block text-truncate">Teguh Irawan</a>
				</strong>
			</div>
		</div>

		<div class="form-inline">
			<div class="input-group" data-widget="sidebar-search">
				<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-sidebar">
						<i class="fas fa-search fa-fw"></i>
					</button>
				</div>
			</div>
		</div>

		<nav class="mt-2">
			<?php echo $menu; ?>
		</nav>
	</div>
</aside>