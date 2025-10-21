<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";
    include FCPATH."assets/vendors/pdfparse/Pdfparse.php";
    require 'vendor/autoload.php';
    use Smalot\PdfParser\Parser;
    use setasign\Fpdi\Fpdi;
    use setasign\Fpdi\PdfReader;

    class Tilakaservice extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modeltilaka","md");
        }

        private function sendResponse($data) {
            if (!empty($data)) {
                $response = [
                    'ResponseDTechnology' => [
                        'metaData' => [
                            'code'    => REST_Controller::HTTP_OK,
                            'message' => 'Data Ditemukan'
                        ],
                        'data' => $data
                    ]
                ];
                $httpCode = REST_Controller::HTTP_OK;
            } else {
                $response = [
                    'ResponseDTechnology' => [
                        'metaData' => [
                            'code'    => REST_Controller::HTTP_NOT_FOUND,
                            'message' => 'Data Tidak Ditemukan'
                        ],
                        'data' => null
                    ]
                ];
                $httpCode = REST_Controller::HTTP_NOT_FOUND;
            }

            // Kirim response ke client
            $this->response($response, $httpCode);
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response['access_token'],REST_Controller::HTTP_OK);
        }

        public function uploadallfile_POST(){
            header('Content-Type: text/plain');

            $status = "AND a.status_sign = '0' ORDER BY note ASC, created_date ASC LIMIT 10;";
            $result = $this->md->pencariandata(ORG_ID, $status);

            if(!empty($result)){
                foreach ($result as $a) {
                    $location           = "";
                    $listfile           = [];
                    $datasimpanhd       = [];
                    $responseuploadfile = [];
                    $filesize           = 0;

                    if($a->source_file==="DTECHNOLOGY"){
                        $location = FCPATH."assets/document/".$a->no_file.".pdf";
                    }else{
                        $location = PATHFILE_GET_TILAKA."/".$a->no_file.".pdf";
                    }

                    if(file_exists($location)){
                        $filesize = filesize($location);
                        if($filesize!=0){
                            $bodycheckcertificate['user_identifier']=$a->useridentifier;
                            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                            if(isset($responsecheckcertificate['success'])){
                                if($responsecheckcertificate['success']){
                                    if($responsecheckcertificate['status']===3){
                                        $responseuploadfile = Tilaka::uploadfile($location);
                                        if(isset($responseuploadfile['success'])){
                                            if($responseuploadfile['success']){
                                                $resultcheckfilename = $this->md->checkfilename(ORG_ID,$responseuploadfile['filename']);
                                                if(empty($resultcheckfilename)){
                                                    $datasimpanhd['filename']        = $responseuploadfile['filename'];
                                                    $datasimpanhd['user_identifier'] = $a->useridentifier;
                                                    $datasimpanhd['status_sign']     = "1";
                                                    $datasimpanhd['status_file']     = "1";
                                                    $datasimpanhd['note']            = "";
                                                    echo PHP_EOL."Filename: ".$responseuploadfile['filename']." Status: Uploaded Success";
                                                }
                                            }else{
                                                $datasimpanhd['note'] = $responseuploadfile['message'];
                                                echo PHP_EOL."No File: {$a->no_file}.pdf"." Status: ".$responseuploadfile['message'];
                                            }
                                        }
                                    }else{
                                        $datasimpanhd['note'] = $responsecheckcertificate['message']['info'];
                                        echo PHP_EOL."No File: {$a->no_file}.pdf"." Status: ".$responsecheckcertificate['message']['info'];
                                    }
                                }
                            }
                        }else{
                            $datasimpanhd['status_sign'] = "98";
                            $datasimpanhd['note']        = "File Corrupted";
                            echo PHP_EOL."No File: {$a->no_file}.pdf"." Status: File Corrupted, File Size : ".$filesize;
                        }
                    }else{
                        $datasimpanhd['status_sign']     = "99";
                        $datasimpanhd['note']            = "File not found";
                        $datasimpanhd['status_file']     = "0";
                        $datasimpanhd['user_identifier'] = "";
                        $datasimpanhd['url']             = "";
                        echo PHP_EOL."No File: {$a->no_file}.pdf"." Location: ".$location." Status: File not found";
                    }

                    if(!empty($datasimpanhd)){
                        $this->md->updatefile($datasimpanhd, $a->no_file);
                    }
                }
            } else {
                echo "Data Tidak Ditemukan";
            }
        }
    }

?>