<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Canister extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelcanister","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_canister");
		}

        public function canister(){
            $result = $this->md->canister($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="We Get The Data You Want";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }
	}
?>