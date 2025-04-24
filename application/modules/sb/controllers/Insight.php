<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Insight extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelinsight","md");
        }

		public function index(){
			$data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_insight",$data);
		}


        public function loadcombobox(){
            $resultperiode = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $data['periode'] = $periode;
            return $data;
		}

        public function datainsight(){
            $tahun = $this->input->post("periode");
            $result = $this->md->datainsight($tahun);
            
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