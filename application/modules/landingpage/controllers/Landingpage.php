<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Landingpage extends CI_Controller{ 
        public function __construct(){
            parent:: __construct();
        }
        
        public function index(){
            $fileclient = "";
            $directory = FCPATH.'assets/images/clients/';
            if (is_dir($directory)) {
                $files = glob($directory . '*.png');
                foreach ($files as $file) {
                    $filename = basename($file); 
                    $fileclient .= "<div class='col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center'><img src='".base_url("assets/images/clients/".$filename)."' class='img-fluid' alt=''></div>";
                }
            }

            $data['clients']=$fileclient;

            $this->template->load("template/template-landingpage","v_landingpage",$data);
        }
    }
?>