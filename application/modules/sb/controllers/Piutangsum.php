<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Piutangsum extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelpiutangsum","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_piutangsum");
		}

        public function rekappiutang(){
            $result = $this->md->rekappiutang();
            
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