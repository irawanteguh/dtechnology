<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Eticketlist extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeleticketlist","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_eticketlist");
		}
        
        public function dataeticket(){
            $result = $this->md->dataeticket($_SESSION['orgid'],$_SESSION['userid'],$this->md->cekdepartmentid($_SESSION['orgid'],$_SESSION['userid'])->department_id);
            
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

        public function validasi(){
            $data['status']      = $this->input->post("status");
            $data['atasan_id']   = $_SESSION['userid'];
            $data['atasan_date'] = date('Y-m-d H:i:s');

            if($this->md->updateeticket($this->input->post("transid"),$data)){
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