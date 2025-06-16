<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Provider extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelprovider","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_provider");
		}

        public function masterprovider(){
            $result = $this->md->masterprovider($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function provideradd(){

            $data['org_id']          = $_SESSION['orgid'];
            $data['provider_id']     = generateuuid();
            $data['provider_id_old'] = $this->input->post("modal_provider_add_code");
            $data['provider']        = $this->input->post("modal_provider_add_provider");
            $data['created_by']      = $_SESSION['userid'];
            $data['created_date']    = date("Y-m-d H:i:s");

            if($this->md->insertmasterprovider($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

		
	}
?>