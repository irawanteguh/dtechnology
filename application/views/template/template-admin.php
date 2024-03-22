<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php          
            include_once(APPPATH."views/template/head.php");
        ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div class="wrapper">
            
            <?php          
                include_once(APPPATH."views/template/preloader.php");
                include_once(APPPATH."views/template/main-head.php");
                include_once(APPPATH."views/template/main-sidebar.php");
            ?>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 text-sm">
                                <?php echo $contents ?>   
                            </div>             
                        </div>
                    </div>
                    <?php
                        if(file_exists(APPPATH."views/modal/root.php")){
                            include_once(APPPATH."views/modal/root.php");
                        }

                        $segment = $this->uri->segment(1);
                        $directory = APPPATH.'modules/'.$segment.'/modal/';
                        if (is_dir($directory)) {
                            $files = glob($directory . '*.php');
                            foreach ($files as $file){
                                include($file);
                            }
                        }
                    ?>
                </section>
                <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                    <i class="fas fa-chevron-up"></i>
                </a>
            </div>
            <footer class="main-footer">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; DTechnology For Use <a href="<?php echo $_SESSION['website'] ?>" target="_blank"><?php echo $_SESSION['hospitalname'] ?></a> 2024 | Page rendered in <strong>{elapsed_time}</strong> seconds. | Ip Address : <strong><?php echo $_SERVER['REMOTE_ADDR']?></strong></div>
                    <div><a href="#">Privacy Policy</a>&middot;<a href="#">Terms &amp; Conditions</a></div>
                </div>
            </footer>
        </div>
        <?php          
            include_once(APPPATH."views/template/script.php");
        ?>
    </body>
</html>