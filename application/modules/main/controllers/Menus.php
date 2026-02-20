<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    class Menus extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelmenus","md");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_menus");
        }

        public function datamenus(){
            $result = $this->md->datamenus($_SESSION['orgid']);
            
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