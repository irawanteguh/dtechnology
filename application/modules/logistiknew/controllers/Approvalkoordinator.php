<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalkoordinator extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar","v_appkoordinator");
        }

        public function datapemesanan(){
            $status  = " 
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where level_id='5'
                                                    and   head_koordinator='Y'
                                                    and   header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where level_id='4'
                                                                            and   user_id='".$_SESSION['userid']."'
                                                                        )
                                                )
                            and   a.status in ('2','3','4','5','6','18','19','20','21','22','23','24','25','26','27','28','29','30','31')
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