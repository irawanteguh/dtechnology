<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Bpjs extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelbpjs", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_bpjs");
        }


    }
?>