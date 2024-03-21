<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."vendor/phpqrcode/qrlib.php";

    class Tilakaservice extends REST_Controller
    {
        public static $orgid;
        public static $clientid;
        public static $clientsecret;
        public static $coordinatex;
        public static $coordinatey;
        public static $height;
        public static $width;
        public static $page;

        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilakaservice","md");

            Tilaka::init();

            self::$orgid        = ORG_ID;
            self::$clientid     = CLIENT_ID;
            self::$clientsecret = CLIENT_SECRET;
            self::$coordinatex  = COORDINATE_X;
            self::$coordinatey  = COORDINATE_Y;
            self::$height       = HEIGHT;
            self::$width        = WIDTH;
            self::$page         = PAGE;
        }

        public function uploadallfile_POST(){
            $result = $this->md->dataupload(self::$orgid,"0");
            if(!empty($result)){
                foreach($result as $a){
                    $location = FCPATH."assets/fileapps/document/".$a->NO_FILE.".pdf";
                    if(file_exists($location)){
                        $response = Tilaka::uploadfile($location);
                        $data['FILENAME']    = $response['filename'];
                        $data['STATUS_SIGN'] = "1";
                        $this->md->updatefile($data,$a->NO_FILE);
                        $this->response($response,REST_Controller::HTTP_OK);
                    }
                }
            }
        }

        public function requestsign_POST(){
            $result = $this->md->dataupload(self::$orgid,"1");
            if(!empty($result)){
                $listpdf            = [];
                $sequence           = 1;
                $lastuseridentifier = "";

                foreach($result as $a){
                    $listpdf           = [];
                    $listpdfsignatures = [];

                    $listpdfsignatures['coordinate_x']    = self::$coordinatex;
                    $listpdfsignatures['coordinate_y']    = self::$coordinatey;
                    $listpdfsignatures['height']          = self::$height;
                    $listpdfsignatures['width']           = self::$width;
                    $listpdfsignatures['page_number']     = self::$page;
                    $listpdfsignatures['user_identifier'] = $a->useridentifier;
                    $listpdf['filename']                  = $a->FILENAME;
                    $listpdf['signatures'][]              = $listpdfsignatures;

                    $listpdfpost[]=$listpdf;

                    if($lastuseridentifier!=$a->useridentifier){
                        $filename             = "Assign by : ".$a->assignname;
                        $errorCorrectionLevel = "H";
                        $matrixPointSize      = 10;
                        $tempdir              = FCPATH."assets/fileapps/qrcode/";
                        $filename             = $tempdir.base64_encode($filename).'.png';
                        $pngAbsoluteFilePath  = $filename;

                        if(!file_exists($pngAbsoluteFilePath)){
                            // QRcode:: png("https://xxxxx/dtechnology/index.php/verification?token=".base64_encode($nik."|".$phass)."|".$timestamp,$filename,$errorCorrectionLevel,$matrixPointSize,2);
                            QRcode:: png("Assign by : ".$a->assignname,$filename,$errorCorrectionLevel,$matrixPointSize,2);
                        };

                        $qrcode        = file_get_contents($filename);
                        $qrcode_encode = base64_encode($qrcode);

                        $signatures['sequence']        = $sequence;
                        $signatures['signature_image'] = "data:image/png;base64,".$qrcode_encode;
                        $signatures['user_identifier'] = $a->useridentifier;

                        $sequence ++;
                        $lastuseridentifier = $a->useridentifier;

                        $signaturespost[]=$signatures;
                    }
                    
                }

                $requestid = Tilaka::uuid()['data'][0];

                $body['request_id']   = $requestid;
                foreach ($listpdfpost as $a) {
                    $body['list_pdf'][] = $a;
                }
                foreach ($signaturespost as $a) {
                    $body['signatures'][] = $a;
                }

                $response = Tilaka::requestsign(json_encode($body));

                if($response['success']){
                    foreach($result as $a){
                        if($a->STATUS_SIGN==="1"){
                            $data['REQUEST_ID']  = $requestid;
                            $data['STATUS_SIGN'] = "2";
                            $this->md->updatefile($data,$a->NO_FILE);
                        }
                    }
                    foreach($response['auth_urls'] as $a){
                        $dataurl['URL_ID']          = Tilaka::uuid()['data'][0];
                        $dataurl['REQUEST_ID']      = $requestid;
                        $dataurl['USER_IDENTIFIER'] = $a['user_identifier'];
                        $dataurl['URL']             = $a['url'];
                        $this->md->insertauthurl($dataurl);
                    }
                }

                $this->response($response,REST_Controller::HTTP_OK);
            }
        }

        public function statussign_POST(){
            $result = $this->md->dataexecutesign();
            if(!empty($result)){
                foreach($result as $a){
                    $body['request_id']      = $a->REQUEST_ID;
                    $body['user_identifier'] = $a->USER_IDENTIFIER;
                    $body['hmac_nonce']      = "";
                    $response = Tilaka::statusexcutesign(json_encode($body));

                    if($response['status']==="DONE"){
                        $dataupdate['STATUS']="2";
                        $this->md->updateauthurl($dataupdate,$a->URL_ID);
        
                        $bodydownload['request_id'] = $a->REQUEST_ID;
                        $response = Tilaka::download(json_encode($bodydownload));
        
                        if($response['success']){
                            $dataupdate['STATUS']="3";
                            $this->md->updateauthurl($dataupdate,$a->URL_ID);
        
                            foreach($response['list_pdf'] as $a){
                                $filename           = $a['filename'];

                                $updatefile['STATUS_SIGN'] = "3";
                                $updatefile['LINK']        = $a['presigned_url'];
        
                                $this->md->updatelinkdownload($updatefile,$filename);
                            }
                        }
                    }
                }

                $this->response($response,REST_Controller::HTTP_OK);
            }
        }

    }

?>