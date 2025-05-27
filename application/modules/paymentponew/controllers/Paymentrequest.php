<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentrequest extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentrequest");
        }

        public function dataapprove(){
            $status    = "and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('7','9','11','13','15','16','17')";
            $parameter = "order by created_date desc";

            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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

        public function datadecline(){
            $status    = "and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('8','10','12','14')";
            $parameter = "order by created_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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