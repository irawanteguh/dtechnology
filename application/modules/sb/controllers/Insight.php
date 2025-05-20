<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Insight extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            // $this->load->model("Modelinsight","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_insight");
		}



	}
?>