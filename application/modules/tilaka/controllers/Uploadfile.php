<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    include FCPATH."vendor/phpqrcode/qrlib.php";

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

                foreach($requestsign as $a){
                    if($a->STATUS_SIGN==="1"){
                        $body              = [];
                        $listpdf           = [];
                        $signatures        = [];
                        $listpdfsignatures = [];

                        $filename             = "No Dokumen : ".$a->NO_FILE." Assign by : ".$a->assignname;
                        $errorCorrectionLevel = "H";
                        $matrixPointSize      = 10;
                        $tempdir              = FCPATH."assets/fileapps/qrcode/";
                        $filename             = $tempdir.base64_encode($filename).'.png';
                        $pngAbsoluteFilePath  = $filename;

                        if(!file_exists($pngAbsoluteFilePath)){
                            // QRcode:: png("https://xxxxx/dtechnology/index.php/verification?token=".base64_encode($nik."|".$phass)."|".$timestamp,$filename,$errorCorrectionLevel,$matrixPointSize,2);
                            QRcode:: png("No Dokumen : ".$a->NO_FILE." Assign by : ".$a->assignname,$filename,$errorCorrectionLevel,$matrixPointSize,2);
                        };

                        $qrcode        = file_get_contents($filename);
                        $qrcode_encode = base64_encode($qrcode);

                        $signatures['sequence']               = 1;
                        $signatures['signature_image']        = "data:image/png;base64,".$qrcode_encode;
                        $signatures['user_identifier']        = $a->useridentifier;
                        $listpdfsignatures['coordinate_x']    = self::$coordinatex;
                        $listpdfsignatures['coordinate_y']    = self::$coordinatey;
                        $listpdfsignatures['height']          = self::$height;
                        $listpdfsignatures['width']           = self::$width;
                        $listpdfsignatures['page_number']     = self::$page;
                        $listpdfsignatures['user_identifier'] = $a->useridentifier;

                        $listpdf['filename']     = $a->FILENAME;
                        $listpdf['signatures'][] = $listpdfsignatures;

                        // $body['request_id']   = Tilaka::uuid()['data'][0];
                        $body['request_id']   = "";
                        $body['list_pdf'][]   = $listpdf;
                        $body['signatures'][] = $signatures;

                        return var_dump(json_encode($body));
                        die();
                    }                    
                }               
            }
            
            // echo Tilaka::uuid()['data'][0];

            // $json["responCode"] = "00";
            // $json["responHead"] = "success";
            // $json["responDesc"] = "Data Berhasil Di Upload";

            // echo json_encode($json);
        }
	}

?>