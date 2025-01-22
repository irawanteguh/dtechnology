<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Requestnew extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_requestnew");
        }

        public function datarequest(){
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and status in ('91') ";
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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

        public function detailbarangspu(){
            $nopemesanan = $this->input->post("nopemesanan");
            $result      = $this->md->detailbarangspu($_SESSION['orgid'],$nopemesanan);
            
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