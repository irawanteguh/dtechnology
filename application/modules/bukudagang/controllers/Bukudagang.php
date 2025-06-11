<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Bukudagang extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelbukudagang","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_bukudagang",$data);
		}

        public function loadcombobox(){
            $resultperiode = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode_indonesia."</option>";
            }

            $data['periode'] = $periode;
            return $data;
		}

        public function rekapbukudagang(){
            $periode = $this->input->post("periode");
            $result = $this->md->rekapbukudagang($periode);
            
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