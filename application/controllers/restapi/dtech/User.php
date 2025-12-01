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

        public function _remap($method, $arguments = []) {
            $headers = getallheaders();
            $response = [];

            if(isset($headers["x-token"])){
                try{
                    $decodedtoken = Authorization::validateToken($headers["x-token"]);
                    if($decodedtoken != false){
                        if(isset($decodedtoken->expired) && $decodedtoken->expired >= time()){
                            return parent::_remap($method, $arguments);
                        }else{
                            $response['code']    = 401;
                            $response['status']  = false;
                            $response['message'] = "Token expired";
                        }
                    } else {
                        $response['code']    = 406;
                        $response['status']  = false;
                        $response['message'] = "Not Acceptable: Token not valid";
                    }
                }catch(Exception $e){
                    $response['code']    = 406;
                    $response['status']  = false;
                    $response['message'] = "Not Acceptable: Token exception";
                }
            }else{
                $response['code']    = 406;
                $response['status']  = false;
                $response['message'] = "Not Acceptable: Header x-token not found";
            }

            return $this->response($response, $response['code']);
        }

        public function datauser_get($nik) {
            $resultdata = $this->md->datauser($nik);
            if(!empty($resultdata)){
                $data['useridentifier'] = $resultdata->user_identifier;
                $data['email'] = $resultdata->user_identifier;
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