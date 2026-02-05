<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasi","md");
        }

		public function index(){
            $this->template->load("template/template-sidebar","v_registrasi");
		}

        public function datakaryawan(){
            $result = $this->md->datakaryawan($_SESSION['orgid']);
            
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

        public function pengajuantte(){
            $userid      = $this->input->post("userid");
            $email       = $this->input->post("email");
            $expireddate = date("Y-m-d", strtotime("+3 days"))." 23:59";

            $body['email']        = $email;
            WEBHOOK_KYC         === true && ($body['callback_url'] = WEBHOOK_URL);
            $body['send_email']   = true;
            $body['expires_at']   = $expireddate;

            $response = Mekari::registerkyc(json_encode($body));

            
            
            echo json_encode($json);
        }
	}

?>