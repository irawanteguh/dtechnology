<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Appvice extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelappvice", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_appvice");
        }

        public function datarequest(){
            $result = $this->md->datarequest($_SESSION['orgid']);
            
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