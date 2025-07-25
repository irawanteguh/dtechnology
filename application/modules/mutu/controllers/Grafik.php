<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Grafik extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelgrafik","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_grafik");
		}
		
        public function datagrafik(){
            $result = $this->md->datagrafik();
            
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