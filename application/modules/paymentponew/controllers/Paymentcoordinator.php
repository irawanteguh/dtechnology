<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentcoordinator extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentcoordinator");
        }

        public function datapemesanan(){
            $status="
                        and   a.status in ('7','8','9','10','11','12','13','32','33')
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
                    ";
            $orderby = "order by inv_kains_date desc;";

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