<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Grafik extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelgrafik","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_grafik",$data);
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

        public function databulanan(){
            $tahun  = $this->input->post("periode");
            $result = $this->md->databulanan($tahun);
            
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

        public function databulananpiutang(){
            $tahun  = $this->input->post("periode");
            $result = $this->md->databulananpiutang($tahun);
            
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

        public function dataharian(){
            $tahun  = $this->input->post("periode");
            $result = $this->md->dataharian($tahun);
            
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