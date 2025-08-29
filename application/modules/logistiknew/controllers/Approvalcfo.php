<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalcfo extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar","v_approvalcfo");
        }

        public function datapemesanan(){
            $status  = " 
                            and   a.method='11'
                            and   a.status in ('21','28','29','30','31')
                        ";
            $orderby = "order by created_date desc;";

            $result = $this->md->datapemesanan($_SESSION['orgid'],$status,$orderby);
            
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