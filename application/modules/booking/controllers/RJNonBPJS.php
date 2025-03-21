<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class RJNonBPJS extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelrjnonbpjs","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-blank","v_rjnonbpjs",$data);
		}

        public function loadcombobox(){
            $resultmasterprovider   = $this->md->masterprovider(ORG_ID);
            $resultmasterpoliklinik = $this->md->masterpoliklinik();
    
            $provider       = "";
            foreach ($resultmasterprovider as $a) {
                $provider .= "<option value='" . $a->providerid . "'>" . $a->provider . "</option>";
            }

            $poliklinik       = "";
            foreach ($resultmasterpoliklinik as $a) {
                $poliklinik .= "<option value='" . $a->kd_poli . "'>" . $a->nm_poli . "</option>";
            }
    
            $data['provider']   = $provider;
            $data['poliklinik'] = $poliklinik;
            return $data;
        }

        public function datapasien(){
            $parameter = $this->input->post("identitaspasien");
            $result = $this->md->datapasien($parameter);
            
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