<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Attendance extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelattendance","md");
        }

		public function index(){
			$this->template->load("template/template-public","v_attendance");
		}

		public function datauser(){
            $userid = $this->input->post("userid");
            $result = $this->md->datauser($userid);
            
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

        public function simpanabsen(){
            $data['org_id']       = $this->input->post("orgid");
            $data['transaksi_id'] = $this->input->post("transaksiid");
            $data['user_id']      = $this->input->post("userid");
            $data['tgl_jam']      = date("Y-m-d H:i:s");

            if($this->md->insertabsen($data)){
                $json['responCode']   = "00";
                $json['responHead']   = "success";
                $json['responDesc']   = "Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }
            
            echo json_encode($json);
        }

	}
?>