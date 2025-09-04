<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalmanager extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar","v_appmanager");
        }

        public function datapemesanan(){
            $status = "
                        
                        and a.department_id in (
                            select department_id
                            from dt01_gen_department_ms d
                            where d.header_id in (
                                select department_id
                                from dt01_gen_department_ms
                                where user_id='" . $_SESSION['userid'] . "'
                            )
                            and ( (a.status='2' and d.head_koordinator='N') or (a.status<>'2') )
                        )
                            and a.status in ('2','3','4','5','6','19','20','21','26','27','28','29','30','31')
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