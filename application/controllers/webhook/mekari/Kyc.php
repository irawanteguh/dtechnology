<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Kyc extends REST_Controller{
        
        public function __construct(){
            parent::__construct();
            $this->load->model("Modelwebhook","md");
        }


        public function kyc_POST(){
            $data  = [];
            $input = [];
            $input = json_decode($this->input->raw_input_stream, true);

            if(empty($input)){
                return $this->response([
                    'status'  => false,
                    'message' => 'Request body kosong atau format tidak valid.'
                ], 400);
            };
            

            $data['org_id']        = ORG_ID;
            $data['transaksi_id']  = generateuuid();
            $data['id']            = $input['data']['id'] ?? '';
            $data['type']          = $input['data']['type'] ?? '';
            $data['email']         = $input['data']['attributes']['email'] ?? '';
            $data['status']        = $input['data']['attributes']['status'] ?? '';
            $data['tilaka_status'] = $input['data']['attributes']['tilaka_status'] ?? '';
            $data['tilaka_name']   = $input['data']['attributes']['tilaka_name'] ?? '';
            $data['created_date'] = !empty($input['data']['attributes']['created_at']) ? date('Y-m-d H:i:s', strtotime($input['data']['attributes']['created_at'])) : null;

            if($this->md->insertwebhookkyc($data)){
                $response['status']  = true;
                $response['message'] = "Success";
            }else{
                $response['status']  = false;
                $response['message'] = "Failed";
            }

            $this->response($response);

        }

    }
?>