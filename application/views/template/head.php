
        <script> var url            = '<?php echo base_url();?>'; </script>
        <script> var tilakabaseurl  = '<?php echo TILAKA_BASE_URL ?>'; </script>
        <script> var clientidtilaka = '<?php echo CLIENT_ID_TILAKA ?>'; </script>
        <script> var pathposttilaka = '<?php echo addslashes(PATHFILE_POST_TILAKA); ?>'.replace(/\\/g, '/').replace(/^[CDEcde]:\/xampp\/htdocs/, 'http://' + window.location.host); </script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css"  href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<?php
    if($this->uri->total_segments() === 0){
        if($this->router->fetch_class()==="landingpage"){
            echo "<title>DTechnology</title>".PHP_EOL;
            echo "<link rel='icon' type='image/gif' href='".base_url('assets/favicon/favicon.png')."'>".PHP_EOL;
            echo "<link rel='apple-touch-icon' type='image/gif' href='".base_url('assets/favicon/favicon.png')."'>".PHP_EOL;

            echo "\t\t<link href='".base_url('assets/vendors/bootstrap-4.1.3/dist/css/bootstrap.min.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/boxicons/css/boxicons.min.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/glightbox/css/glightbox.min.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/remixicon/remixicon.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/swiper/swiper-bundle.min.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/vendors/aos/aos.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/css/landingpage/style.css')."' rel='stylesheet'>".PHP_EOL;
            echo "\t\t<link href='".base_url('assets/css/root/scrollbars.css')."' rel='stylesheet'>".PHP_EOL;
        }else{
            if($this->router->fetch_class()==="Mutiasari"){
                echo "<title>RSU Mutiasari</title>".PHP_EOL;
                echo "<link rel='icon' type='image/gif' href='".base_url('assets/favicon/10c84edd-500b-49e3-93a5-a2c8cd2c8524.png')."'>".PHP_EOL;
                echo "<link rel='apple-touch-icon' type='image/gif' href='".base_url('assets/favicon/10c84edd-500b-49e3-93a5-a2c8cd2c8524.png')."'>".PHP_EOL;

                echo "\t\t<link href='".base_url('assets/vendors/fontawesome-6.5.1/css/all.min.css')."' rel='stylesheet'>".PHP_EOL;
                // echo "\t\t<link href='".base_url('assets/vendors/animate.css/animate.min.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/aos/aos.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/bootstrap-5.3.0/css/bootstrap.min.css')."' rel='stylesheet'>".PHP_EOL;
                // echo "\t\t<link href='".base_url('assets/vendors/bootstrap/css/bootstrap.min.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/boxicons/css/boxicons.min.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/glightbox/css/glightbox.min.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/remixicon/remixicon.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/vendors/swiper/swiper-bundle.min.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/css/landingpage/mutiasari.css')."' rel='stylesheet'>".PHP_EOL;
                echo "\t\t<link href='".base_url('assets/css/root/scrollbars.css')."' rel='stylesheet'>".PHP_EOL;
            }else{
                if($this->router->fetch_class()==="Rmb"){
                    echo "<title>RMB Hospital Group</title>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/vendors/bootstrap-5.3.0/css/bootstrap.min.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/vendors/bootstrap-icons/bootstrap-icons.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/vendors/aos/aos.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/vendors/glightbox/css/glightbox.min.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/vendors/swiper/swiper-bundle.min.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/css/landingpage/rmb.css')."' rel='stylesheet'>".PHP_EOL;
                    echo "\t\t<link href='".base_url('assets/css/root/scrollbars.css')."' rel='stylesheet'>".PHP_EOL;
                }else{

                }
            }
        }
    }else{
        echo "<title>DTechnology</title>".PHP_EOL;
        echo "<link rel='icon' type='image/gif' href='".base_url('assets/favicon/favicon.png')."'>".PHP_EOL;
        echo "<link rel='apple-touch-icon' type='image/gif' href='".base_url('assets/favicon/favicon.png')."'>".PHP_EOL;

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
    }
?>