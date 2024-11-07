<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasi","md");
        }

		public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_registrasi",$data);
		}

        public function loadcombobox(){
            $resultalasanrevoke = $this->md->alasanrevoke();

            $revoke="";
            foreach($resultalasanrevoke as $a ){
                $revoke.="<option value='".$a->keterangan."'>".$a->keterangan."</option>";
            }

            $data['revoke'] = $revoke;
            return $data;
		}

        public function datakaryawan(){
			$search = $this->input->post("search");
            $result = $this->md->datakaryawan($_SESSION['orgid'],$search);
            
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

        public function certificatestatus(){
            // - status 1 → registrasi sertifikat masih dalam proses verifikator/validator (belum final),
            // - status 2 → sertifikat registered (telah diterbitkan),
            // - status 3 → sertifikat aktif (user telah memvalidasi data pada sertifikat, atau telah melewati masa validasi 9 hari sehingga dianggap valid by system),
            // - status 4 → registrasi sertifikat ditolak (final) oleh verifikator/validator.

            $userid         = $this->input->post("userid");
            $useridentifier = $this->input->post("useridentifier");
            $registerid     = $this->input->post("registerid");

            $body['user_identifier']=$useridentifier;
            $response = Tilaka::checkcertificateuser(json_encode($body));
            
            if($response['success']){
                if($response['success']){

                    $data['CERTIFICATE']      = $response['status'];
                    $data['CERTIFICATE_INFO'] = $response['message']['info'];

                    if($response['status']==="4"){
                        $data['USER_IDENTIFIER']  = "";
                        $data['REGISTER_ID']      = "";
                        $data['REVOKE_ID']        = "";
                        $data['ISSUE_ID']         = "";
                    }else{
                        $data['REVOKE_ID']   = "";
                        $data['ISSUE_ID']    = "";

                        if($response['status']==="3"){
                            // $data['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['start_active_date']);
                            // $data['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['expiry_date']);
                            $data['START_ACTIVE'] = "x";
                        }
                    }

                    $this->md->updatedatauserid($data,$userid);
                }

                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "success";
                $json['responResult'] = $response;
            }else{
                $json["responCode"]   = "01";
                $json["responHead"]   = "info";
                $json["responDesc"]   = "Connection Service Tilaka Failed";
            }
            

            echo json_encode($json);
        }
		
	}

?>