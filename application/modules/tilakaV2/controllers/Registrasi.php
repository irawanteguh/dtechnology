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
            $userid         = $this->input->post("userid");
            $useridentifier = $this->input->post("useridentifier");
            $registerid     = $this->input->post("registerid");

            $body['user_identifier']=$useridentifier;
            $response = Tilaka::checkcertificateuser(json_encode($body));
            
            if($response['success']){
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