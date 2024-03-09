    
<?php
    $countsegment = $this->uri->total_segments();
    if($countsegment === 0){
        // Vendor JS Files
        echo "<script type='text/javascript' src='".base_url('vendor/aos/aos.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/glightbox/js/glightbox.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/isotope-layout/isotope.pkgd.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/swiper/swiper-bundle.min.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/waypoints/noframework.waypoints.js')."'></script>".PHP_EOL; 
        echo "<script type='text/javascript' src='".base_url('vendor/waypoints/noframework.waypoints.js')."'></script>".PHP_EOL;

        // Template Main JS File
        echo "<script type='text/javascript' src='".base_url('assets/js/landingpage/landingpage.js')."'></script>".PHP_EOL;
    }
?>
    <!-- Jquery -->
    <script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="<?php echo base_url();?>vendor/bootstrap-4.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Adminlte -->
    <script type="text/javascript" src="<?php echo base_url();?>vendor/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>