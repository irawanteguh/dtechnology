<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            // $this->load->model("Modelhistory","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_dashboard");
		}


	}
?>