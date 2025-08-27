<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar","v_approvalfinance");
        }

        public function datapemesanan(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $status  = " 
                            and   a.status in ('4','5','6')
                            and   date(a.created_date) between '".$startDate."' and '".$endDate."'
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