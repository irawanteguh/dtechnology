<!DOCTYPE html>
<html lang="en">
    <head>
        <?php          
			include_once(APPPATH."views/template/head.php");
		?>
    </head>
    <body>
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-column flex-center flex-column-fluid p-10">
                <img src="<?php echo base_url('assets/images/illustrations/sketchy-1/18.png'); ?>" alt="" class="mw-100 mb-10 h-lg-450px" />
                <h1 class="fw-bold mb-10" style="color: #A3A3C7">Seems there is nothing here</h1>
                <a href="../dashboard/dashboard" class="btn btn-primary">Return Home</a>
            </div>
        </div>
        <?php      
			include_once(APPPATH."views/template/script.php");
		?>
    </body>
</html>