<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Notification extends REST_Controller {

        public function __construct() {
            parent::__construct();
            date_default_timezone_set('Asia/Jakarta');
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


        public function senddocument_post() {
            $session_id = "96b5612d-375f-41c2-b386-e2dd08a98596";
            $group_id   = "120363422251812300@g.us";
            $caption    = "Note : Pesan ini dibuat secara otomatis oleh *Smart Assistant RMB Hospital Group*";
            $document_path = FCPATH . "assets/whatsapp/0bde8d61-f6cc-4fdd-8e1a-3621756e722e.pdf";
            $document_name = "Laporan Quickreport.pdf";

            $body = [
                "session"       => $session_id,
                "to"            => $group_id,
                "text"          => $caption,
                "document_url"  => $document_path,
                "document_name" => $document_name
            ];

            $res = Whatsapp::sendWhatsAppDocument($body);

            if ($res['status'] === true) {
                echo json_encode(['status' => true, 'message' => 'Dokumen berhasil dikirim.']);
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => $res['error'] ?? 'Gagal mengirim dokumen.'
                ]);
            }
        }


    }
?>