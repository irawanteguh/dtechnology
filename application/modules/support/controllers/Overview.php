<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Overview extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeloverview","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_overview");
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

        public function gettransid(){
            
			$json["responCode"]   = "00";
            $json["responHead"]   = "success";
            $json["responDesc"]   = "We Get The Data You Want";
            $json['responResult'] = generateuuid();

            echo json_encode($json);
        }

        public function neweticket(){
            $data['org_id']      = $_SESSION['orgid'];
            $data['trans_id']    = $this->input->post("modal_new_eticket_transid");
            $data['subject']     = $this->input->post("modal_new_eticket_subject");
            $data['description'] = $this->input->post("modal_new_eticket_description");
            $data['created_by']  = $_SESSION['userid'];

            if($this->md->inserteticket($data)){
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