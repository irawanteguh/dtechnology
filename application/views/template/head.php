
<script> var url = '<?php echo base_url();?>'; </script>

<link rel = "icon" type             = "image/gif" href = "<?php echo base_url();?>assets/images/favicon/favicon.png">
<link rel = "apple-touch-icon" type = "image/gif" href = "<?php echo base_url();?>assets/images/favicon/favicon.png">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/bootstrap-4.1.3/dist/css/bootstrap.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/fontawesome-6.5.1/css/all.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/toastr/toastr.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/sweetalert2-11.10.3/sweetalert2.min.css">
<link rel = "stylesheet" type       = "text/css" href  = "<?php echo base_url(); ?>plugins/animate.css/animate.min.css">

<?php

    $countsegment = $this->uri->total_segments();
    $segment      = $this->uri->segment($this->uri->total_segments()-1);

    if($countsegment === 0){
        //!Landing Page
        // Google Fonts
        echo "<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>".PHP_EOL;
        // Vendor CSS Files
        echo "<link href='".base_url()."vendor/aos/aos.css' rel='stylesheet'>".PHP_EOL;
        echo "<link href='".base_url()."vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>".PHP_EOL;
        echo "<link href='".base_url()."vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>".PHP_EOL;
        echo "<link href='".base_url()."vendor/glightbox/css/glightbox.min.css' rel='stylesheet'>".PHP_EOL;
        echo "<link href='".base_url()."vendor/remixicon/remixicon.css' rel='stylesheet'>".PHP_EOL;
        echo "<link href='".base_url()."vendor/swiper/swiper-bundle.min.css' rel='stylesheet'>".PHP_EOL;
        // Template Main CSS File
        echo "<link href='".base_url()."assets/css/landingpage/style.css' rel='stylesheet'>".PHP_EOL;
    }else{
        $csspathmodules = FCPATH.'assets/css/root/';
        if (is_dir($csspathmodules)) {
            $cssfiles = glob($csspathmodules . '*.css');
            echo '<!-- Load CSS File Pada Folder Root System -->'.PHP_EOL;
            foreach ($cssfiles as $cssfile) {
                $cssfilename = basename($cssfile);
                echo "<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/root/".$cssfilename."'></link>".PHP_EOL;
            }
        }

        $csspathmodules = FCPATH.'assets/css/'.$segment.'/';
        if(is_dir($csspathmodules)) {
            $cssfiles = glob($csspathmodules . '*.css');
            echo PHP_EOL.'<!-- Load CSS Files Pada Modules '.$segment.' -->'.PHP_EOL;
            foreach ($cssfiles as $cssfile) {
                $cssfilename = basename($cssfile);
                echo "<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/".$segment."/".$cssfilename."'></link>".PHP_EOL;
            }
            echo PHP_EOL.PHP_EOL;
        }
    }

    // if(isset($_SESSION['loggedin']))
    // {
    //     echo "<title> ".$_SESSION['namars']."</title>".PHP_EOL;
    //     echo "<link rel='icon' type='image/gif' href='".base_url()."assets/images/favicon/".$_SESSION['lokasiid'].".png' >".PHP_EOL;
    // }else
    // {
    //     if($this->uri->segment(2)==="error404")
    //     {
    //         echo "<title>ERROR-404</title>".PHP_EOL;
    //         echo "<link rel='icon' type='image/gif' href='".base_url()."assets/images/favicon/default.png' >".PHP_EOL;
    //     }else
    //     {
    //         echo "<title> ".$title."</title>".PHP_EOL;
    //         echo "<link rel='icon' type='image/gif' href='".base_url()."assets/images/favicon/default.png' >".PHP_EOL;
    //     }
    // }
?>

<title>DTechnology</title>
