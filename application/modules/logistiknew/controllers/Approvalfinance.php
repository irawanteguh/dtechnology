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
            $startDate = $this->input->post("startDate") ?: date("Y-m-d");
            $endDate   = $this->input->post("endDate")   ?: date("Y-m-d");

            $orgid = "and a.org_id='".$_SESSION['orgid']."'";
            $status  = " 
                            and (
                            a.status = '4'
                            OR (
                                a.status in ('5','6','20','21','22','23','24','25','26','27','28','29','30','31')
                                and date(a.created_date) between '".$startDate."' and '".$endDate."'
                            )
                        )

                        ";
            $orderby = "
                            ORDER BY 
                            CASE WHEN a.status = '4' THEN a.koordinator_date END ASC,
                            CASE WHEN a.status = '6' THEN a.keu_date END DESC

                        ";

            $result = $this->md->datapemesanan($orgid,$status,$orderby);
            
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