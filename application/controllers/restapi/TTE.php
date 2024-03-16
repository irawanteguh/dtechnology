<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class TTE extends REST_Controller
    {
        public static $clientid;
        public static $clientsecret;

        public function __construct(){
            parent::__construct();

            $reqbody     = $this->input->raw_input_stream;  //Tarik Data Body
            $reqbodyjson = json_decode($reqbody, true);     // Ubah Jadi JSON

            Tilaka::init();

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;
        }

        public function oauth_POST(){
            $response = Tilaka::oauth();
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function uuid_POST(){
            $response = Tilaka::uuid();
            $this->response($response,REST_Controller::HTTP_OK);
        }

        function fileToBase64($filePath) {
            if (file_exists($filePath)) {
                $fileContent = file_get_contents($filePath);
                if ($fileContent !== false) {
                    return base64_encode($fileContent);
                } else {
                    // Gagal membaca file
                    return false;
                }
            } else {
                // File tidak ditemukan
                return false;
            }
        }

        public function registerkyc_post(){
            $consent_timestamp = date("Y-m-d H:i:s");
            $consent_text = "Term";
            $version ="TNT – v.1.0.1";

            $datahash = self::$clientid.$consent_text.$version.$consent_timestamp;
            $hash = hash_hmac('sha256', $datahash, self::$clientsecret);

            $ktp_path = FCPATH."/assets/fileapps/ktp/1403092306954271.jpeg";
            $ktp_data = file_get_contents($ktp_path);
            $ktp_encoded = base64_encode($ktp_data);

            $body['registration_id'] = Tilaka::uuid()['data'][0];
            $body['email'] = "teguhirawan.rsudpasarminggu@gmail.com";
            $body['name'] = "Teguh Irawan";
            $body['company_name'] = "Personal";
            $body['date_expire'] = "2024-12-12 23:59";
            $body['nik'] = "1403092306954271";
            $body['photo_ktp'] = "data:image/jpeg;base64,".$ktp_encoded;
            $body['consent_text'] = $consent_text;
            $body['is_approved'] = true;
            $body['version'] = $version;
            $body['hash_consent'] = $hash;
            $body['consent_timestamp'] = $consent_timestamp;
            
            $response = Tilaka::registerkyc(json_encode($body));
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function webviewregistrasi_POST(){
            $requestid = Tilaka::generateuuid();
            $redirect  = "https://www.google.com/";

            $parameter = "request_id=".$requestid."&redirect_url=".$redirect;
            $response = Tilaka::webviewregistrasi($parameter);
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function checkregistrasiuser_POST(){
            $body['register_id']=Tilaka::generateuuid();

            $response = Tilaka::checkregistrasiuser(json_encode($body));
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function checkcertificateuser_POST(){
            $body['register_id']=Tilaka::generateuuid();

            $response = Tilaka::checkcertificateuser(json_encode($body));
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function checkakunpenautan_POST(){
            $body['register_id'] = Tilaka::generateuuid();
            $body['nik']         = "1403092306954271";

            $response = Tilaka::checkakunpenautan(json_encode($body));
            $this->response($response,REST_Controller::HTTP_OK);
        }

        public function webviewpenautan_POST(){
            $requestid = Tilaka::generateuuid();
            $redirect  = "https://www.google.com/";

            $parameter = "setting=1&channel_id=".self::$clientid."&request_id".$requestid."&redirect_url".$redirect;
            $response  = Tilaka::webviewpenautan($parameter);
            $this->response($response,REST_Controller::HTTP_OK);
        }

    }

?>