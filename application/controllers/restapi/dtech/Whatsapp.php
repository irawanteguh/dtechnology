<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Whatsapp extends REST_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelwhatsapp","md");
        }

        public function updatedevice_post() {
            $post = $this->post();

            $session_id = $post['session_id'] ?? null;
            $username   = $post['username'] ?? null;
            $phone      = $post['phone'] ?? null;
            $status     = $post['status'] ?? null;


            if ($session_id && $status) {
                $data = [
                    'username' => $username,
                    'phone'    => ($status === 'connected') ? $phone : "",
                    'status'   => $status
                ];

                $this->md->updatedevice($data, $session_id);

                $this->response([
                    'status'  => 'success',
                    'message' => 'Device info updated.',
                    'data'    => $data
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status'  => 'error',
                    'message' => 'Missing required fields.',
                    'debug'   => compact('session_id', 'status', 'phone')
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }


    }
?>