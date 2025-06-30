<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller {

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

    public function senddocument() {
        $to            = "120363422251812300@g.us";                                                                      // Ganti dengan nomor tujuan
        $session       = "mysession";                                                                          // Ganti dengan session aktif Anda
        $caption       = "Note : Pesan ini dibuat secara otomatis oleh *Smart Assisstant RMB Hospital Group*";
        // $document_url  = "https://rsumutiasari.com/dtechnology/assets/document/202506300011620022502761.pdf";
        $document_url  = FCPATH . "/assets/whatsapp/0bde8d61-f6cc-4fdd-8e1a-3621756e722e.pdf";
        $document_name = "Laporan Quickreport.pdf";

        $payload = json_encode([
            "session" => $session,
            "to" => $to,
            "text" => $caption,
            "document_url" => $document_url,
            "document_name" => $document_name
        ]);

        $ch = curl_init("http://localhost:5001/message/send-document");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($payload)
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo json_encode(["status" => false, "error" => $err]);
        } else {
            echo $response;
        }
    }
}
