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
                    'message' => 'Device info updated',
                    'data'    => $data
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status'  => 'error',
                    'message' => 'Missing required fields',
                    'debug'   => compact('session_id', 'status', 'phone')
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function broadcastwhatsapp_post() {
            $limit                   = "limit ".rand(1, 2).";";
            $resultbroadcastwhatsapp = $this->md->broadcastwhatsapp(ORG_ID,$limit);

            if(!empty($resultbroadcastwhatsapp)){
                foreach($resultbroadcastwhatsapp as $a){
                    $body_parts = [];
                    $extensions = "";

                    $session_id    = $a->session;
                    $to            = $a->to;
                    for ($i = 1; $i <= 10; $i++) {
                        $key = "body_$i";
                        if (!empty($a->$key)) {
                            $body_parts[] = $a->$key;
                        }
                    }

                    $body_text = implode("", $body_parts);
                    $document_path = $a->directory;
                    $document_name = $a->document_name;

                    if($a->type_file==="1"){
                        $extensions =".pdf";
                    };

                    $body = [
                        "session" => $session_id,
                        "to"      => $to,
                        "text"    => urldecode($body_text)
                    ];

                    if ($a->type_file !== "0") {
                        $body["document_url"]  = $document_path;
                        $body["document_name"] = $document_name . $extensions;
                    }
        
                    if($a->type_file === "0") {
                        $res  = Gatewaywhatsapp::sendWhatsAppText($body);
                        $type = "text";
                    } else {
                        $res  = Gatewaywhatsapp::sendWhatsAppDocument($body);
                        $type = "document";
                    }

                    if (!empty($res)) {
                        if (isset($res['status']) && $res['status'] === true) {
                            $dataupdate['message_id']   = $res['result']['key']['id'];
                            $dataupdate['senddatetime'] = date('Y-m-d H:i:s', $res['result']['messageTimestamp']);
                            $dataupdate['status']       = "1";

                            $this->md->updatestatusbroadcastwhatsapp($dataupdate, $a->transaksi_id);

                            echo json_encode([
                                'status'            => true,
                                'message'           => 'Broadcast message sent successfully',
                                'type'              => $type,
                                'remoteJid'         => $res['result']['key']['remoteJid'] ?? null,
                                'id'                => $res['result']['key']['id'] ?? null,
                                'mimetype'          => $res['result']['message']['documentMessage']['mimetype'] ?? null,
                                'fileName'          => $res['result']['message']['documentMessage']['fileName'] ?? null,
                                'messageTimestamp'  => $res['result']['messageTimestamp'] ?? null
                            ]);
                        } else {
                            echo json_encode([
                                'status'  => false,
                                'message' => $res['error'] ?? 'Gagal mengirim dokumen'
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'status'  => false,
                            'message' => 'Respon kosong dari gateway'
                        ]);
                    }
                }
            }
        }
    }
?>