<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentcfo extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentcfo");
        }

        public function datapemesanan(){
            $startDate = $this->input->post("startDate") ?: date("Y-m-d");
            $endDate   = $this->input->post("endDate")   ?: date("Y-m-d");

            $status="
                        and   a.method in ('5','8','9','11','12')
                        and   a.status in ('13','14','15','16','17','34','35','36','37')
                    ";
            $orderby = "
                ORDER BY 
                CASE WHEN a.status = '9' THEN a.inv_manager_date END ASC,
                CASE WHEN a.status <> '9' THEN a.inv_dir_date END DESC
            ";

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