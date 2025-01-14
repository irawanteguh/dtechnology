<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Incomedaily extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelincomedaily","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_incomedaily.php");
		}

		public function billingcash(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");
            $provider  = "and a.kd_pj='A09'";
            $result = $this->md->billing($provider,$startDate,$endDate);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function billingbpjs(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");
            $provider  = "and a.kd_pj='BPJ'";
            $result = $this->md->billing($provider,$startDate,$endDate);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function billingbpjsrjdetail(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");
            $kd_dokter = $this->input->post("kd_dokter");
            $provider  = "and a.kd_pj='BPJ' and a.kd_dokter='".$kd_dokter."'";

            $result = $this->md->billing($provider,$startDate,$endDate);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function analisa(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");
            $result = $this->md->analisa($startDate,$endDate);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function rincianbilling(){
            $norawat = $this->input->post("norawat");
            $type    = $this->input->post("type");
            $result = $this->md->rincianbilling($norawat,$type);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

	}
?>