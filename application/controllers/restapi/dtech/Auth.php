<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Auth extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelserviceapi","md");
            $this->resetresponse();
        }

        public function resetresponse(){
            $body    = [];
            $code    = 401;
            $status  = false;
            $message = "";
        }

        public function createdtoken_get(){
            $body        = json_decode($this->input->raw_input_stream, true);
            
            if(isset($body['orgid']) && isset($body['username']) && isset($body['password'])){
                $resultlogin = $this->md->login($body['orgid'],$body['username'],encodedata($body['password']));

                if(!empty($resultlogin)){
                    $datasession = $this->md->datasession($resultlogin->user_id);

                    $datatoken['orgid']     = $datasession->org_id;
                    $datatoken['userid']    = $datasession->user_id;
                    $datatoken['timestamp'] = date("YmdHis");
                    $datatoken['expired']   = time() + 6000;

                    $token = AUTHORIZATION::generateToken($datatoken);

                    $this->code    = 200;
                    $this->status  = true;
                    $this->message = "Authorized";
                    $this->data    = ['token' => $token]; // contoh token
                }else{
                    $this->code    = 401;
                    $this->status  = false;
                    $this->message = "Unauthorized access";
                }
            }else{
                $this->code    = 400;
                $this->status  = false;
                $this->message = "Organization, username and password required";
            }
            

            $response['code']    = $this->code;
            $response['status']  = $this->status;
            $response['message'] = $this->message;
            if(!empty($this->data))$response['data'] = $this->data;


            $this->response($response,$this->code);
        }
        
    }

?>