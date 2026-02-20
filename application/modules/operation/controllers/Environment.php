<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Environment extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelenvironment","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_environment");
		}

        public function masterenvironment(){
            $result = $this->md->masterenvironment($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="We Get The Data You Want";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function updateenvironment() {
            $input = json_decode(file_get_contents('php://input'), true);
        
            $envid = $input['envid'];
            $dev = $input['dev'];
            $prod = $input['prod'];
        
            // Prepare the data to update
            $data = [
                'dev'  => $dev,
                'prod' => $prod
            ];
        
            // Update the environment settings
            if ($this->md->updateenvironment($envid, $data)) {
                $json["responCode"] = "00";
                $json["responHead"] = "success";
                $json["responDesc"] = "Data Updated Successfully";
            } else {
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "Data Failed to Update";
            }
        
            echo json_encode($json);
        }
        

	}
?>