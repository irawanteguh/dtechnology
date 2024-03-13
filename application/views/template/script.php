    
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/jquery/jquery-3.7.1.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/moment/moment.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/bootstrap-4.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/toastr/toastr.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/sweetalert2/sweetalert2.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/selectize/js/standalone/selectize.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();?>vendor/selectize/js/standalone/selectize.min.js"></script>

<?php
    $countsegment = $this->uri->total_segments();
    
    if($countsegment === 0){
        echo "<script type='text/javascript' src='".base_url('vendor/aos/aos.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/glightbox/js/glightbox.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/isotope-layout/isotope.pkgd.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/swiper/swiper-bundle.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/waypoints/noframework.waypoints.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/waypoints/noframework.waypoints.js')."'></script>".PHP_EOL;
        echo "<script type='text/javascript' src='".base_url('assets/js/landingpage/landingpage.js')."'></script>".PHP_EOL;
    }

    $jspathroot = FCPATH.'assets/js/root/';
    if (is_dir($jspathroot)) {
        $jsFiles = glob($jspathroot . '*.js');
        echo PHP_EOL.'<!-- Load Js Root System -->'.PHP_EOL;
        foreach ($jsFiles as $jsFile) {
            $jsFilename = basename($jsFile);
            echo "<script type='text/javascript' src='".base_url('assets/js/root/'.$jsFilename)."'></script>".PHP_EOL; // Menyertakan file JavaScript
        }
    };

    echo PHP_EOL.'<!-- Load JS Files Folder '.$this->uri->segment(1).'/'.$this->uri->segment(2).' -->'.PHP_EOL;
    echo "<script type='text/javascript' src='".base_url('assets/js/'.$this->uri->segment(1)."/".$this->uri->segment(2).".js")."'></script>".PHP_EOL;
?>
   