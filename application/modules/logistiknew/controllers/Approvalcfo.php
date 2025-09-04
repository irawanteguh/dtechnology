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
                            AND (
                                (a.method = '7' AND a.total > 2000000)
                                OR(a.method = '10' AND a.total > 500000)
                                OR (a.method IN ('9','11','12'))
                            )
                            and   a.status in ('21','27','28','29','30','31')
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