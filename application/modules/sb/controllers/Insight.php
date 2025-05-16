<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Insight extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelinsight","md");
            $this->load->model("Modelsb","ms");
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

        public function databulanrsms(){
			$tahun = $this->input->post("periode");
            $result = $this->ms->databulan($tahun,"10c84edd-500b-49e3-93a5-a2c8cd2c8524");
            
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

        public function databulanrsia(){
			$tahun = $this->input->post("periode");
            $result = $this->ms->databulan($tahun,"d5e63fbc-01ec-4ba8-90b8-fb623438b99d");
            
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

        public function databulanrst(){
			$tahun = $this->input->post("periode");
            $result = $this->ms->databulan($tahun,"a4633f72-4d67-4f65-a050-9f6240704151");
            
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