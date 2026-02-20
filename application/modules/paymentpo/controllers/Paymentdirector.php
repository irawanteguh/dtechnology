<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentdirector extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentmanager", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentdirector");
        }

        public function datarequest(){
            $status="
                        and   a.status in ('11')
                    ";
                    $parameter="order by inv_vice_date desc";
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

        public function decline(){
            $status="
                        and   a.status in ('12','14')
                    ";
                    $parameter="order by inv_dir_date desc";
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

        public function approve(){
            $status="
                        and   a.status in ('13','15','16','17')
                    ";
                    
                    $parameter="order by inv_dir_date desc";
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