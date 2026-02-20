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
            $parameter1  = "and date(a.date)='".$this->input->post("startDate")."'";
            $parameter2 = "and date(h.inv_keu_date)='".$this->input->post("startDate")."'";
            $result = $this->md->datainsight($parameter1,$parameter2);
            
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
            $parameter1 = "and date_format(a.date,'%m.%Y')='".$this->input->post("startDate")."'";
            $parameter2 = "and date_format(h.inv_keu_date,'%m.%Y')='".$this->input->post("startDate")."'";

            $result = $this->md->datainsight($parameter1,$parameter2);
            
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
            $parameter1 = "and date_format(a.date,'%Y')='".$this->input->post("startDate")."'";
            $parameter2 = "and date_format(h.inv_keu_date,'%Y')='".$this->input->post("startDate")."'";
            $result = $this->md->datainsight($parameter1,$parameter2);
            
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