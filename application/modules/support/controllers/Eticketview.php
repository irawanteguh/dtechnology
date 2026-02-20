<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Eticketview extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeleticketview","md");
        }

		public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_eticketview",$data);
		}

        public function loadcombobox(){
            $resultmasterseverity = $this->md->masterseverity($_SESSION['orgid']);
            $resultmasterpic      = $this->md->masterpic($_SESSION['orgid']);
            $resultmasterproblem  = $this->md->masterproblem($_SESSION['orgid']);
            

            $masterseverity="";
            foreach($resultmasterseverity as $a ){
                $masterseverity.="<option value='".$a->master_id."'>".$a->master_name."</option>";
            }

            $masterpic="";
            foreach($resultmasterpic as $a ){
                $masterpic.="<option value='".$a->master_id."'>".$a->master_name."</option>";
            }

            $masterproblem="";
            foreach($resultmasterproblem as $a ){
                $masterproblem.="<option value='".$a->master_id."'>".$a->master_name."</option>";
            }

            $data['masterseverity'] = $masterseverity;
            $data['masterpic']      = $masterpic;
            $data['masterproblem']  = $masterproblem;
            
            return $data;
		}
        
        public function dataeticket(){
            $result = $this->md->dataeticket($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = "We Get The Data You Want";
				$json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function followup(){
            $status = $this->input->post('status');
            $valid  = ($status === 'approve') ? '4' : '3';

            $data['severity_id']   = $this->input->post("modal_followup_eticket_severity");
            $data['category_id']   = $this->input->post("modal_followup_eticket_pic");
            $data['problem_id']    = $this->input->post("modal_followup_eticket_problem");
            $data['note']          = $this->input->post("modal_followup_eticket_note");
            $data['followup_id']   = $_SESSION['userid'];
            $data['followup_date'] = date('Y-m-d H:i:s');
            $data['status']        = $valid;

            if($this->md->updateeticket($this->input->post("modal_followup_eticket_transid"),$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Berhasil Di Tambah";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Gagal Di Tambah";
            }
            
            echo json_encode($json);
        }
	}
?>