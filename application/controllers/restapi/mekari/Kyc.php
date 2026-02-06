<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Kyc extends REST_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->model("Modelmekari","md");
        }

        public function kycliststatus_get(){
            $result = $this->md->liststatus();
            foreach($result as $a){
                $datasimpan = [];
                $response   = Mekari::listregisterkyc($a->email);

                if(isset($response['data'][0]['id'])){
                    $datasimpan['org_id']       = ORG_ID;
                    $datasimpan['transaksi_id'] = generateuuid();
                    $datasimpan['id']           = $response['data'][0]['id'] ?? null;
                    $datasimpan['user_id']      = $a->user_id;
                    $datasimpan['email']        = $response['data'][0]['attributes']['email'] ?? null;
                    $datasimpan['url']          = $response['data'][0]['attributes']['ekyc_url'] ?? null;
                    $datasimpan['status']       = $response['data'][0]['attributes']['status'] ?? null;
                    $this->md->insertusermekari($datasimpan);
                };

                $this->response($response['data'],200);
            }
        }
        
    }

?>
