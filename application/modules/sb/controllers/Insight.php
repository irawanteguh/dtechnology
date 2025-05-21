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
            $resultperiodebulan = $this->md->periodebulan();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $periodebulan="";
            foreach($resultperiodebulan as $a ){
                $periodebulan.="<option value='".$a->id."'>".$a->periode."</option>";
            }

            $data['periode'] = $periode;
            $data['periodebulan'] = $periodebulan;
            return $data;
		}

		public function dataharian(){
            $parameter = "and date(date)='".$this->input->post("startDate")."'";
            $result = $this->md->datainsight($parameter);
            
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

        public function databulanan(){
            $parameter = "and date_format(date,'%m.%Y')='".$this->input->post("startDate")."'";
            $result = $this->md->datainsight($parameter);
            
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

		public function datatahunan(){
            $parameter = "and date_format(date,'%Y')='".$this->input->post("startDate")."'";
            $result = $this->md->datainsight($parameter);
            
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