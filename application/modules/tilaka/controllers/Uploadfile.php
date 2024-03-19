<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Uploadfile extends CI_Controller {

        public static $clientid;
        public static $clientsecret;
        public static $coordinatex;
        public static $coordinatey;
        public static $height;
        public static $width;
        public static $page;

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
            Tilaka::init();

			$this->load->model("Modeluploadfile","md");

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;

            self::$coordinatex = COORDINATE_X;
            self::$coordinatey = COORDINATE_Y;
            self::$height      = HEIGHT;
            self::$width       = WIDTH;
            self::$page        = PAGE;
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
            // $result = $this->md->dataupload($_SESSION['orgid']);

            // foreach($result as $a){
            //     if($a->STATUS_SIGN==="0"){
            //         $location = FCPATH."assets/fileapps/document/".$a->NO_FILE.".pdf";
            //         if(file_exists($location)){
            //             $response = Tilaka::uploadfile($location);
            //             $data['FILENAME']    = $response['filename'];
            //             $data['STATUS_SIGN'] = "1";
            //             $this->md->updatefile($data,$a->NO_FILE);
            //         }
            //     }
            // }

            $requestsign = $this->md->dataupload($_SESSION['orgid']);
            if(!empty($requestsign)){
                $listpdf            = [];
                $sequence           = 1;
                $lastuseridentifier = "";

                $body['request_id']=Tilaka::uuid()['data'][0];
                foreach($requestsign as $a){
                    if($a->STATUS_SIGN==="1"){
                        $listpdf           = [];
                        $listpdfsignatures = [];
                        

                        $listpdfsignatures['coordinate_x']    = self::$coordinatex;
                        $listpdfsignatures['coordinate_y']    = self::$coordinatey;
                        $listpdfsignatures['height']          = self::$height;
                        $listpdfsignatures['width']           = self::$width;
                        $listpdfsignatures['page_number']     = self::$page;
                        $listpdfsignatures['user_identifier'] = $a->useridentifier;

                        $listpdf['filename']     = $a->FILENAME;
                        $listpdf['signatures'][] = $listpdfsignatures;

                        if($lastuseridentifier!=$a->useridentifier){

                            $signatures['sequence']=$sequence;
                            $signatures['signature_image']="data:image/png;base64,";
                            $signatures['user_identifier']=$a->useridentifier;

                            $sequence ++;
                            $lastuseridentifier = $a->useridentifier;

                            $signaturespost[]=$signatures;
                        }
                    }
                    $listpdfpost[]=$listpdf;
                    
                }

                foreach ($listpdfpost as $a) {
                    $body['list_pdf'][] = $a;
                }
                foreach ($signaturespost as $a) {
                    $body['signatures'][] = $a;
                }

                return var_dump(json_encode($body));
                die();
            }
            
            // echo Tilaka::uuid()['data'][0];

            // $json["responCode"] = "00";
            // $json["responHead"] = "success";
            // $json["responDesc"] = "Data Berhasil Di Upload";

            // echo json_encode($json);
        }
	}

?>