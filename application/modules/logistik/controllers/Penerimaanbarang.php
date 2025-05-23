<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Penerimaanbarang extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_penerimaanbarang");
        }
        
        public function datarequest(){
            $status = "
                        and   a.status = '6'
                        and   a.status_vice='Y'
                        and   a.status_dir='Y'
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where user_id='".$_SESSION['userid']."'
                                                )
                    ";
            $orderby ="order by created_date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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