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

        // public function senddocument() {
        //     $to            = "6285271374874";                                                                      // Ganti dengan nomor tujuan
        //     $session       = "mysession";                                                                          // Ganti dengan session aktif Anda
        //     $caption       = "Berikut kami lampirkan laporan quick report.";
        //     // $document_url  = "https://rsumutiasari.com/dtechnology/assets/document/202506300011620022502761.pdf";
        //     $document_url  = FCPATH . "/assets/whatsapp/0bde8d61-f6cc-4fdd-8e1a-3621756e722e.pdf";
        //     $document_name = "Laporan Quickreport.pdf";

        //     $payload = json_encode([
        //         "session" => $session,
        //         "to" => $to,
        //         "text" => $caption,
        //         "document_url" => $document_url,
        //         "document_name" => $document_name
        //     ]);

        //     $ch = curl_init("http://localhost:5001/message/send-document");
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //         "Content-Type: application/json",
        //         "Content-Length: " . strlen($payload)
        //     ]);

        //     $response = curl_exec($ch);
        //     $err = curl_error($ch);
        //     curl_close($ch);

        //     if ($err) {
        //         echo json_encode(["status" => false, "error" => $err]);
        //     } else {
        //         echo $response;
        //     }
        // }

        // public function senddocument_post() {
        //     $to            = "120363422251812300@g.us";                                                                      // Ganti dengan nomor tujuan
        //     $session       = "96b5612d-375f-41c2-b386-e2dd08a98596";                                                                          // Ganti dengan session aktif Anda
        //     $caption       = "Note : Pesan ini dibuat secara otomatis oleh *Smart Assisstant RMB Hospital Group*";
        //     // $document_url  = "https://rsumutiasari.com/dtechnology/assets/document/202506300011620022502761.pdf";
        //     $document_url  = FCPATH . "/assets/whatsapp/0bde8d61-f6cc-4fdd-8e1a-3621756e722e.pdf";
        //     $document_name = "Laporan Quickreport.pdf";

        //     $payload = json_encode([
        //         "session"       => $session,
        //         "to"            => $to,
        //         "text"          => $caption,
        //         "document_url"  => $document_url,
        //         "document_name" => $document_name
        //     ]);

        //     $ch = curl_init("http://localhost:5001/message/send-document");
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //         "Content-Type: application/json",
        //         "Content-Length: " . strlen($payload)
        //     ]);

        //     $response = curl_exec($ch);
        //     $err = curl_error($ch);
        //     curl_close($ch);

        //     if ($err) {
        //         echo json_encode(["status" => false, "error" => $err]);
        //     } else {
        //         echo $response;
        //     }
        // }


        // public function senddocument_post() {
        //     $session_id = "96b5612d-375f-41c2-b386-e2dd08a98596";
        //     $group_id   = "6281288646630";
        //     $caption    = "Note : Pesan ini dibuat secara otomatis oleh *Smart Assistant RMB Hospital Group*";
        //     $document_path = FCPATH . "assets/whatsapp/0bde8d61-f6cc-4fdd-8e1a-3621756e722e.pdf";
        //     $document_name = "Laporan Quickreport.pdf";

        //     return var_dump($document_path);

        //     $body = [
        //         "session"       => $session_id,
        //         "to"            => $group_id,
        //         "text"          => $caption,
        //         "document_url"  => $document_path,
        //         "document_name" => $document_name
        //     ];

        //     $res = Whatsapp::sendWhatsAppDocument($body);

        //     if ($res['status'] === true) {
        //         echo json_encode(['status' => true, 'message' => 'Dokumen berhasil dikirim.']);
        //     } else {
        //         echo json_encode([
        //             'status' => false,
        //             'message' => $res['error'] ?? 'Gagal mengirim dokumen.'
        //         ]);
        //     }
        // }

        public function broadcastwhatsapp_post() {
            $resultbroadcastwhatsapp = $this->md->broadcastwhatsapp(ORG_ID);

            if(!empty($resultbroadcastwhatsapp)){
                foreach($resultbroadcastwhatsapp as $a){
                    $body_parts = [];

                    $session_id    = $a->session;
                    $to            = $a->to;
                    for ($i = 1; $i <= 10; $i++) {
                        $key = "body_$i";
                        if (!empty($a->$key)) {
                            $body_parts[] = $a->$key . "%0a";
                        }
                    }

                    // Gabungkan semua bagian body yang tidak null
                    $body_text = implode("", $body_parts);

                    $footer        = "%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";
                    $text          = $body_text.$footer;
                    $document_path = $a->directory;
                    $document_name = $a->document_name;

                    $body = [
                        "session"       => $session_id,
                        "to"            => $to,
                        "text"          => urldecode($text),
                        "document_url"  => $document_path,
                        "document_name" => $document_name
                    ];
        
                    if($a->type_file==="1"){
                        $res = Whatsapp::sendWhatsAppDocument($body);
                    }

                    if ($res['status'] === true) {
                        $dataupdate['message_id'] = $res['result']['key']['id'];
                        $dataupdate['status']     = "1";

                        $this->md->updatestatusbroadcastwhatsapp($dataupdate,$a->transaksi_id);

                        echo json_encode(['status' => true, 'message' => 'Dokumen berhasil dikirim.']);
                    } else {
                        echo json_encode([
                            'status' => false,
                            'message' => $res['error'] ?? 'Gagal mengirim dokumen.'
                        ]);
                    }
                }
            }
        }



    }
?>