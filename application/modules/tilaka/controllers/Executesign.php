<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    include FCPATH."vendor/phpqrcode/qrlib.php";

	class Executesign extends CI_Controller {

        public static $clientid;
        public static $clientsecret;

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
            Tilaka::init();

			$this->load->model("Modelexecutesign","md");

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;

        }

		public function index()
		{
            if(isset($_GET['urlid'])){
                $data['STATUS']="1";
                $this->md->updateauthurl($data,$_GET['urlid']);
                redirect("tilaka/executesign");
            }else{
                $this->template->load("template/template-admin","v_executesign");
            }
		}

        public function dataexecutesign(){
            $result = $this->md->dataexecutesign();
            
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

        // public function statusexecutesign(){
        //     $urlid          = $this->input->post("urlid");
        //     $requestid      = $this->input->post("requestid");
        //     $useridentifier = $this->input->post("useridentifier");

        //     $body['request_id']      = $requestid;
        //     $body['user_identifier'] = $useridentifier;
        //     $body['hmac_nonce']      = "";

        //     $response = Tilaka::statusexcutesign(json_encode($body));

        //     if($response['status']==="DONE"){
        //         $dataupdate['STATUS']="2";
        //         $this->md->updateauthurl($dataupdate,$urlid);

        //         $bodydownload['request_id'] = $requestid;

        //         $response = Tilaka::download(json_encode($bodydownload));

        //         if($response['success']){
        //             $dataupdate['STATUS']="3";
        //             $this->md->updateauthurl($dataupdate,$urlid);

        //             foreach($response['list_pdf'] as $a){
        //                 $filename           = $a['filename'];
                        
        //                 $updatefile['STATUS_SIGN'] = "3";
        //                 $updatefile['LINK']        = $a['presigned_url'];

        //                 $this->md->updatefile($updatefile,$filename);
        //             }
        //         }
        //     }
            
        //     $json["responCode"]   = "00";
        //     $json["responHead"]   = "success";
        //     $json["responDesc"]   = "Data Di Temukan";
        //     $json['responResult'] = $response;

        //     echo json_encode($json);
        // }

	}

?>