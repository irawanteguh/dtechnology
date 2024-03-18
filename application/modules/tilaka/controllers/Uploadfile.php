<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Uploadfile extends CI_Controller {

        public static $clientid;
        public static $clientsecret;

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
            Tilaka::init();

			$this->load->model("Modeluploadfile","md");

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;
        }

		public function index()
		{
            $this->template->load("template/template-admin","v_uploadfile");
		}

        public function dataupload(){
            $result = $this->md->dataupload($_SESSION['orgid']);
            
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

        public function uploadallfile(){
            $result = $this->md->dataupload($_SESSION['orgid']);

            // foreach($result as $a){
            //     $location = FCPATH."assets/fileapps/document/".$a->NO_FILE.".pdf";
            //     if(file_exists($location)){
            //         $response = Tilaka::uploadfile($location);
            //         print_r($response);
            //     }
            // }

            // $requestsign = $this->md->dataupload($_SESSION['orgid']);
            // if(!empty($requestsign)){
            //     $body['request_id']=Tilaka::uuid();
            //     foreach($requestsign as $a){
            //         $signature['user_identifier']=$a->useridentifier;
            //     }
            //     $body['signatures'][]=$signature;
            // }
            
            // echo Tilaka::uuid()['data'][0];

            // $json["responCode"] = "00";
            // $json["responHead"] = "success";
            // $json["responDesc"] = "Data Berhasil Di Upload";

            // echo json_encode($json);
        }
	}

?>