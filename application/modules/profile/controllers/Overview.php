<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	class Overview extends CI_Controller{

		public function __construct(){
			parent::__construct();
			rootsystem::system();
			$this->load->model("Modeloverview", "md");
		}

		public function index(){
			$this->template->load("template/template-sidebar", "v_overview");
		}
		
		public function summarykpi(){
			$result = $this->md->summarykpi($_SESSION['orgid'], $_SESSION['userid']);

			if (!empty($result)) {
				$json["responCode"] = "00";
				$json["responHead"] = "success";
				$json["responDesc"] = "Data Found";
				$json['responResult'] = $result;
			} else {
				$json["responCode"] = "01";
				$json["responHead"] = "info";
				$json["responDesc"] = "Data Not Found";
			}

			echo json_encode($json);
		}
	}
?>
