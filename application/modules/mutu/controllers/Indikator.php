<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Indikator extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelindikator","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_indikator");
		}

        public function masterindikator(){
            $result = $this->md->masterindikator($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
                $json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }

	}
?>