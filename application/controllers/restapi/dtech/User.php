<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class User extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modeluser","md");
            $this->resetresponse();
        }

        public function resetresponse(){
            $body    = [];
            $code    = 401;
            $status  = false;
            $message = "";
        }

        public function datauser_get($nik) {
            $resultdata = $this->md->datauser($nik);
            if(!empty($resultdata)){
                $data['useridentifier'] = $resultdata->user_identifier;

                $message = "Data Di Temukan";
            }else{
                $message = "Data Tidak Di Temukan";
            }

            return $this->response([
                'status'  => true,
                'message' => $message,
                'data'    => $data
            ], 200);
        }

    }
?>