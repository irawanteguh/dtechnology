<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Appvice extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_appvice");
        }

        public function datarequest(){
            $status = "
                        and   a.status in ('6')
                        and (
                                (
                                    a.status <> '6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
                                )
                                or
                                (
                                    a.status='6' 
                                    and (a.status_vice is null or a.status_vice = '')
                                )
                            )
                    ";
            $orderby ="order by manager_date asc;";
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

        public function approve(){
            $status = "
                            and   a.status in ('6')
                            and (
                                (
                                    a.status <> '6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
                                    and (a.status_com is null or a.status_com = '')
                                )
                                or
                                (
                                    a.status='6'
                                    and a.status_vice='Y'
                                )
                            )
                    ";
            $orderby ="order by wadir_date desc;";
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

        public function decline(){
            $status = "
                        and   a.status in ('6')
                        and (
                                (
                                    a.status <> '6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
                                    and (a.status_com is null or a.status_com = '')
                                )
                                or
                                (
                                    a.status = '6' 
                                    and a.status_vice='N'
                                )
                            )
                        
                    ";
            $orderby ="order by wadir_date desc;";
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