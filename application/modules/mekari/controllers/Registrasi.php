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

        public function registerkyc(){
            $userid      = $this->input->post("userid");
            $email       = $this->input->post("email");
            $expireddate = (new DateTime('+3 days', new DateTimeZone('UTC')))->format('Y-m-d H:i:s.u') . ' UTC';


            $body['email']        = $email;
            WEBHOOK_KYC         === true && ($body['callback_url'] = WEBHOOK_URL_KYC);
            $body['send_email']   = true;
            $body['expires_at']   = $expireddate;

            $response = Mekari::registerkyc(json_encode($body));


            // $response = [
            //     "data" => [
            //         "id"   => "5e19bde3-11c4-4f9b-b7a6-4d12bdd39a9b",
            //         "type" => "kyc",
            //         "attributes" => [
            //             "email"     => "john.doe@mekari.com",
            //             "ekyc_url"  => "https://app.esign.mekari.com/settings/ekyc?id=uuid",
            //             "status"    => "not_started"
            //         ]
            //     ]
            // ];


            if(isset($response['data']['id'])){
                $datasimpan['org_id']       = $_SESSION['orgid'];
                $datasimpan['transaksi_id'] = generateuuid();
                $datasimpan['id']           = $response['data']['id'] ?? null;
                $datasimpan['user_id']      = $userid;
                $datasimpan['email']        = $response['data']['attributes']['email'] ?? null;
                $datasimpan['url']          = $response['data']['attributes']['ekyc_url'] ?? null;
                $datasimpan['status']       = $response['data']['attributes']['status'] ?? null;
                $datasimpan['created_by']   = $_SESSION['userid'];

                $this->md->insertusermekari($datasimpan);
            };

            $json["responCode"]   = "00";
            $json["responHead"]   = "success";
            $json["responDesc"]   = "success";
            $json['responResult'] = $response;

            echo json_encode($json);
        }
	}

?>