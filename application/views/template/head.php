
<script> var url = '<?php echo base_url();?>'; </script>

<link rel = "stylesheet" type       = "text/css" href  = "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<link rel = "icon" type             = "image/gif" href = "<?php echo base_url();?>assets/images/favicon/favicon.png">
<link rel = "apple-touch-icon" type = "image/gif" href = "<?php echo base_url();?>assets/images/favicon/favicon.png">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/bootstrap-4.1.3/dist/css/bootstrap.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/fontawesome-6.5.1/css/all.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/toastr/toastr.min.css">
<link rel = "stylesheet" type       = "text/css"  href = "<?php echo base_url();?>vendor/sweetalert2-11.10.3/sweetalert2.min.css">
<link rel = "stylesheet" type       = "text/css" href  = "<?php echo base_url();?>vendor/animate.css/animate.min.css">

<?php
    if($this->uri->total_segments() === 0){
        //!Landing Page
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

        $csspathmodules = FCPATH.'assets/css/'.$this->uri->segment($this->uri->total_segments()-1).'/';
        if(is_dir($csspathmodules)) {
            $cssfiles = glob($csspathmodules . '*.css');
            echo PHP_EOL.'<!-- Load CSS Files Pada Modules '.$this->uri->segment($this->uri->total_segments()-1).' -->'.PHP_EOL;
            foreach ($cssfiles as $cssfile) {
                $cssfilename = basename($cssfile);
                echo "<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/".$this->uri->segment($this->uri->total_segments()-1)."/".$cssfilename."'></link>".PHP_EOL;
            }
            echo PHP_EOL.PHP_EOL;
        }
    }
?>

<title>DTechnology</title>
