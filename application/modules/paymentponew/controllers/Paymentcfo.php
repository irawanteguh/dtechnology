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

            $status = "
                        and a.method in ('5','6','8','9','10','11','12')
                        and (
                            (a.status = '6'  and a.total > 2000000)
                            or (a.status = '10' and a.total > 500000)
                            or (a.status in ('15','34','35','36','37'))
                        )
                    ";

            $orderby = "
                ORDER BY 
                CASE WHEN a.status = '15' THEN a.inv_keu_date END ASC,
                CASE WHEN a.status in ('36','37') THEN a.cmo_date END ASC
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