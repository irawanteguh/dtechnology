<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Rmb extends CI_Controller{ 
        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelmutiasari","md");
        }
        
        public function index(){
            $this->template->load("template/template-landingpage","v_rmb");
        }
    }
?>