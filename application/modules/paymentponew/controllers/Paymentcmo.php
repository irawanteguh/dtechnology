<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentcmo extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentcmo");
        }

        public function datapemesanan(){
            $startDate = $this->input->post("startDate") ?: date("Y-m-d");
            $endDate   = $this->input->post("endDate")   ?: date("Y-m-d");

            $status="
                        and   a.method in ('5','8','9','11','12')
                        and   a.status in ('14','15','16','17','35','36','37')
                    ";
            $orderby = "
                ORDER BY 
                CASE WHEN a.status = '35' THEN a.inv_cfo_date END ASC,
                CASE WHEN a.status <> '35' THEN a.inv_cmo_date END DESC
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