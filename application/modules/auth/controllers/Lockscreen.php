<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Lockscreen extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_lockscreen");
        }

    }
?>