<aside class="main-sidebar sidebar-light-primary elevation-4">
	<a href="#" class="brand-link">
		<img src="<?php echo base_url();?>assets/images/clients/<?php if(isset($_SESSION['orgid'])){echo $_SESSION['orgid'];}else{echo "default";}?>.png" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light"><strong class="font-weight-bold"><?php echo $_SESSION['hospitalname']?></span>
	</a>

	<div class="sidebar">
		<div class="user-panel mb-3 d-flex">
			<div class="image d-flex align-items-center">
				<?php
				    if($_SESSION['imgprofile']==="Y"){
						echo "<img src='".base_url().$_SESSION['fotoprofile']."' class='img-circle elevation-2'>";
					}else{
						echo "<div class='user-profile'><div class='user-initial'>".$_SESSION['initialuser']."</div></div>";
					}
				?>
			</div>
			<div class="info">
				<a class="d-block">Logged in as:</a>
				<strong>
					<a href="#" class="d-block text-truncate"><?php echo $_SESSION['name']?></a>
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
		<nav class="mt-2 text-sm">
			<?php echo $menu; ?>
		</nav>
	</div>
</aside>