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

        public function uploadallfile_POST() {
            $status = "and a.status_sign ='1' order by note asc, created_date asc limit 10;";
            $result = $this->md->pencariandata(ORG_ID, $status);

            // Response otomatis
            if (!empty($result)) {
                $responseservice = [
                    'ResponseDTechnology' => [
                        'metaData' => [
                            'code'    => REST_Controller::HTTP_OK,
                            'message' => 'Data Ditemukan'
                        ],
                        'data' => $result
                    ]
                ];
                $httpCode = REST_Controller::HTTP_OK;
            } else {
                $responseservice = [
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

            // Kirim response sesuai kondisi
            $this->response($responseservice, $httpCode);
        }



    }

?>