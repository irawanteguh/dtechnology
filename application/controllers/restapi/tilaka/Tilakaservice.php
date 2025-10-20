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
            $this->load->model("Modeltilakaservice","md");
        }

        public function auth_GET(){
            $response = Tilaka::oauth();
            $this->response($response,REST_Controller::HTTP_OK);
        }


    }

?>