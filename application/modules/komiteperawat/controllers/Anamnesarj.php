<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Anamnesarj extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			// $this->load->model("Modeldashboard","md");
        }

		public function index(){
			$this->template->load("template/template-header","v_anamnesarj");
		}
        

	}
?>