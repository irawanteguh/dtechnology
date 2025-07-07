<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Forecasting extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelforecasting","md");
        }

		public function index(){
            // $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_forecasting");
		}

        public function dataforecasting(){
            $result = $this->md->dataforecasting();
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

	}
?>