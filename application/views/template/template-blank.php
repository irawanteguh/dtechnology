<!DOCTYPE html>
<html lang="en">
	<head>
		<?php          
			include_once(APPPATH."views/template/head.php");
		?>
	</head>
	<body id="kt_body" class="bg-body">        
        <div class="d-flex flex-column flex-root">
			<?php echo $contents ?>
		</div>
		<?php
			$dirmodal = APPPATH.'views/template/modal/';
			if (is_dir($dirmodal)) {
				$files = glob($dirmodal . '*.php');
				foreach ($files as $file){
					include($file);
				}
			}
		?>
		<?php    
			include_once(APPPATH."views/template/script.php");
		?>
	</body>
</html>