<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentdirector extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentdirector", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentdirector");
        }

        public function dataonprocess(){
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

        public function dataapprove(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $status="
                        and   a.status in ('13','15','16','17')
                        and   date(a.inv_dir_date) between '".$startDate."' and '".$endDate."'
                    ";
                    
            $parameter = "order by inv_dir_date desc";
            $result    = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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

        public function updateheader(){
            $datanopemesanan = $this->input->post('datanopemesanan');
            $datastatus      = $this->input->post('datastatus');
            $datavalidator   = $this->input->post('datavalidator');
            
            if($datavalidator==="DIR"){
                $data['status']       = $datastatus;
                $data['inv_dir_id']   = $_SESSION['userid'];
                $data['inv_dir_date'] = date('Y-m-d H:i:s');
            }

            if($this->md->updateheader($datanopemesanan,$data)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Update successful";
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Failed to update database";
            }

            echo json_encode($json);
        }
        
    }
?>