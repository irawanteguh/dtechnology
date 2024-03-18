<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasiusertilaka extends CI_Controller {

        public static $clientid;
        public static $clientsecret;

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
            Tilaka::init();

			$this->load->model("Modelregistrasiusertilaka","md");

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;
        }

		public function index()
		{
            if(isset($_GET['userid']) && isset($_GET['registerid']) && isset($_GET['useridentifier'])){
                $body['user_identifier']=$_GET['useridentifier'];
                $response = Tilaka::checkcertificateuser(json_encode($body));
                if($response['success']){
                    $data['CERTIFICATE']=$response['status'];
                    $this->md->updatestatusktp($data,$_GET['userid']);
                    redirect("tilaka/registrasiusertilaka");
                }
            }else{
                if(isset($_GET['userid']) && isset($_GET['registerid']) ){
                    $body['register_id']=$_GET['registerid'];
    
                    $response = Tilaka::checkregistrasiuser(json_encode($body));
                    if($response['success']){
                        if($response['data']['summary_verification_result']){
                            $data['VERIFICATION']="Y";
                            $data['USER_IDENTIFIER']=$response['data']['tilaka_name'];
                            $this->md->updatestatusktp($data,$_GET['userid']);
                            redirect("tilaka/registrasiusertilaka");
                        }
                    }
                }else{
                    $this->template->load("template/template-admin","v_registrasi");
                }
            }
            
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

        public function registrasiuser(){
            $userid = $this->input->post("userid");
            $result = $this->md->dataregistrasi($_SESSION['orgid'],$userid);

            if(!empty($result)){
                $ktp_path = FCPATH."/assets/fileapps/ktp/".$result->IDENTITY_NO.".jpeg";

                if(file_exists($ktp_path)){
                    $data['IMAGE_IDENTITY']="Y";

                    $consent_timestamp = date("Y-m-d H:i:s");
                    $consent_text      = "Term And Contiion";
                    $version           = "TNT – v.1.0.1";

                    $datahash = self::$clientid.$consent_text.$version.$consent_timestamp;
                    $hash     = hash_hmac('sha256', $datahash, self::$clientsecret);

                    $ktp_data    = file_get_contents($ktp_path);
                    $ktp_encoded = base64_encode($ktp_data);
    
                    $body['registration_id']   = Tilaka::uuid()['data'][0];
                    $body['email']             = $result->EMAIL;
                    $body['name']              = $result->NAME;
                    $body['company_name']      = "Personal";
                    $body['date_expire']       = "2024-12-12 23:59";
                    $body['nik']               = $result->IDENTITY_NO;
                    $body['photo_ktp']         = "data:image/jpeg;base64,".$ktp_encoded;
                    $body['consent_text']      = $consent_text;
                    $body['is_approved']       = true;
                    $body['version']           = $version;
                    $body['hash_consent']      = $hash;
                    $body['consent_timestamp'] = $consent_timestamp;

                    $response = Tilaka::registerkyc(json_encode($body));
                    
                    if($response['success']){
                        $data['REGISTER_ID']=$response['data'][0];
                    }

                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Data Di Temukan";
                    $json['responResult']=$response;
                }else{
                    $data['IMAGE_IDENTITY']="N";

                    $json["responCode"]="01";
                    $json["responHead"]="info";
                    $json["responDesc"]="File KTP Tidak Di Temukan";
                }

                $this->md->updatestatusktp($data,$userid);
                
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function checknik(){
			$noktp = $this->input->post("noktp");
            $userid = $this->input->post("userid");
            
            $body['request_id']=Tilaka::uuid()['data'][0];
            $body['nik']=$noktp;

            $response = Tilaka::checkakunexist(json_encode($body));
            if($response['status']){
                $data['TILAKA_ID']=$response['tilaka_id'];

                $this->md->updatestatusktp($data,$userid);

                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
                $json['responResult']=$response;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="error";
                $json["responDesc"]="Data Di Temukan";
                $json['responResult']=$response;
            }

            echo json_encode($json);
        }

        public function useridentifier(){
            $userid = $this->input->post("userid");
			$useridentifier = $this->input->post("useridentifier");
            
            $body['user_identifier']=$useridentifier;

            $response = Tilaka::checkcertificateuser(json_encode($body));

            if($response['status']){
                $data['CERTIFICATE']=$response['status'];
                $this->md->updatestatusktp($data,$userid);
                
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
                $json['responResult']=$response;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="error";
                $json["responDesc"]="Data Di Temukan";
                $json['responResult']=$response;
            }

            echo json_encode($json);
        }
	}

?>