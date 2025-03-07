<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reserve extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelreserve","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_reserve",$data);
		}

        public function loadcombobox(){
            $resultmasterpatient = $this->md->masterpatient($_SESSION['orgid']);
            
            
            $patientid="";
            foreach($resultmasterpatient as $a ){
                $patientid.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
            }

            $data['patientid'] = $patientid;
            
            return $data;
		}

		public function dataok(){
            $result = $this->md->dataok($_SESSION['orgid']);
            
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