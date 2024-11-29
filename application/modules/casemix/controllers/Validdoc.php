<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Validdoc extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelvaliddoc","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_validdoc");
		}
        
        public function datatransaksi(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $result = $this->md->datatransaksi($startDate,$endDate);
            
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