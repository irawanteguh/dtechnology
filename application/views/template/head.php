    
    <script> var url            = '<?php echo base_url();?>'; </script>
    <script> var tilakabaseurl  = '<?php echo TILAKA_BASE_URL ?>'; </script>
    <script> var clientidtilaka = '<?php echo CLIENT_ID_TILAKA ?>'; </script>
    <script> var pathposttilaka = '<?php echo addslashes(PATHFILE_POST_TILAKA); ?>'.replace(/\\/g, '/').replace(/^[CDEcde]:\/xampp\/htdocs/, 'http://' + window.location.host); </script>





    <title>DTechnology</title>
    <link rel="icon" type="image/gif" href="<?php echo base_url();?>assets/favicon/favicon.png">
    <link rel="apple-touch-icon" type="image/gif" href="<?php echo base_url();?>assets/favicon/favicon.png">
    <link rel="stylesheet" type="text/css"  href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

<?php
    if($this->uri->total_segments() === 0){
        // ! Khusus Landing Page
        echo "\t\t<link href='".base_url('assets/vendors/bootstrap-4.1.3/dist/css/bootstrap.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/aos/aos.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/boxicons/css/boxicons.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/glightbox/css/glightbox.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/remixicon/remixicon.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/swiper/swiper-bundle.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/css/landingpage/style.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/css/root/scrollbars.css')."' rel='stylesheet'>".PHP_EOL;
    }else{

        echo "\t\t<link href='".base_url('assets/vendors/animate.css/animate.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/fontawesome-6.5.1/css/all.min.css')."' rel='stylesheet'>".PHP_EOL;
        echo "\t\t<link href='".base_url('assets/vendors/fullcalendar/fullcalendar.bundle.css')."' rel='stylesheet'>".PHP_EOL;

        $csspathmodules = FCPATH.'assets/css/root/';
        if (is_dir($csspathmodules)) {
            $cssfiles = glob($csspathmodules . '*.css');
            echo '<!-- Load CSS File Pada Folder Root System -->'.PHP_EOL;
            foreach ($cssfiles as $cssfile) {
                $cssfilename = basename($cssfile);
                echo "\t\t<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/root/".$cssfilename."'></link>".PHP_EOL;
            }
        }

        // $csspathmodules = FCPATH.'assets/css/'.$this->uri->segment($this->uri->total_segments()-1).'/';
        // if(is_dir($csspathmodules)) {
        //     $cssfiles = glob($csspathmodules . '*.css');
        //     echo PHP_EOL.'<!-- Load CSS Files Pada Modules '.$this->uri->segment($this->uri->total_segments()-1).' -->'.PHP_EOL;
        //     foreach ($cssfiles as $cssfile) {
        //         $cssfilename = basename($cssfile);
        //         echo "<link rel='stylesheet' type='text/css' href='".base_url()."assets/css/".$this->uri->segment($this->uri->total_segments()-1)."/".$cssfilename."'></link>".PHP_EOL;
        //     }
        //     echo PHP_EOL.PHP_EOL;
        // }
    }

    
?>