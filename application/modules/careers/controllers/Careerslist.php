<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Careerslist extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			// $this->load->model("Modelactivity","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_careerslist");
		}

	}
?>