<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Masterbarang extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmasterbarang", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_masterbarang");
        }

        public function masterbarang(){
            $result = $this->md->masterbarang($_SESSION['orgid']);
            
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
        
        public function nonactive(){
            $barangid = $this->input->post("barangid");
            $data['active'] = "0";

            if($this->md->updatemasterbarang($data,$barangid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }
    }
?>