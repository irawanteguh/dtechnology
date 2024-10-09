<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class RepodocumentV2 extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("ModelrepodocumentV2","md");
        }

		public function index(){
            $this->template->load("template/template-sidebar","v_repodocumentV2");
		}
	}

?>