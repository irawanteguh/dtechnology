<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentmanager extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentmanager", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentmanager");
        }

        public function datarequest(){
            $status="
                        and   a.status in ('7')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                    ";
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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

        public function decline(){
            $status="
                        and   a.status in ('8','10','12')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                    ";
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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

        public function approve(){
            $status="
                        and   a.status in ('9','11','13')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                    ";
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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