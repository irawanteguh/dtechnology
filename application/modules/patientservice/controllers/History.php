<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class History extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            // $this->load->model("Modelgroupingidrg","md");
        }

		public function index(){
			$this->template->load("template/template-header","v_history");
		}


	}
?>