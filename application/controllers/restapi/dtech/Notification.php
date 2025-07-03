<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Notification extends REST_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model("Modelnotification","md");
        }

        public function hasillaboratorium_post() {
            $limit = "limit ".rand(1, 5).";"; // Angka acak antara 1 dan 5
            $resulthasillaboratorium = $this->md->hasillaboratorium(ORG_ID, $limit);

            if(!empty($resulthasillaboratorium)){
                foreach($resulthasillaboratorium as $a){
                    $nofile      = "";
                    $notransaksi = "";
                    $nofile      = $a->no_file;
                    $notransaksi = $a->transaksi_idx;

                    $informasikunjunganpasien = $this->md->informasikunjunganpasien($notransaksi);
                    if(!empty($informasikunjunganpasien)){

                        $text   ="*".$a->namars."*";
                        $text  .="%0a*RMB Hospital Group*%0a";
                        $text  .="%0aKepada Yth,.";
                        $text  .="%0a*".$informasikunjunganpasien->namapasien."*%0a";
                        $text  .="%0aBerikut kami sampaikan hasil pemeriksaan laboratorium";
                        $text  .="%0aNo Rekam Medis%09: ".$informasikunjunganpasien->no_rkm_medis;
                        $text  .="%0aNama Pasien%09: ".$informasikunjunganpasien->namapasien;
                        $text  .="%0aTanggal Lahir%09: ".$informasikunjunganpasien->bod;
                        $text  .="%0aAlamat%09%09: ".$informasikunjunganpasien->almt_pj;
                        $text  .="%0aNo Transaksi%09: ".$notransaksi;
                        $text  .="%0aTanggal Berobat%09: ".$informasikunjunganpasien->tglkunjungan;
                        $text  .="%0aPoliklinik%09%09: ".$informasikunjunganpasien->politujuan;
                        $text  .="%0aDokter%09%09: ".$informasikunjunganpasien->namadokter;
                        $text  .="%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                        $data['org_id']        = ORG_ID;
                        $data['transaksi_id']  = generateuuid();
                        $data['body_1']        = $text;
                        $data['device_id']     = "4321";
                        // $data['to']            = $a->nohp;
                        $data['to']            = "6281288646630";
                        $data['directory']     = FCPATH."assets/document/".$nofile.".pdf";
                        $data['document_name'] = $nofile;

                        $this->md->simpanboardcast($data);

                        // $body = [
                        //     "session"       => "96b5612d-375f-41c2-b386-e2dd08a98596",
                        //     "to"            => "6285271374874",
                        //     "text"          => urldecode($text),
                        //     "document_url"  => FCPATH."/assets/document/".$nofile.".pdf",
                        //     "document_name" => $nofile.".pdf"
                        // ];

                        // $response = Whatsapp::sendWhatsAppDocument($body);

                        // if ($response['status'] === true) {
                        //     echo json_encode([
                        //         'status' => true,
                        //         'message' => 'Dokumen berhasil dikirim.'
                        //     ]);
                        // } else {
                        //     echo json_encode([
                        //         'status' => false,
                        //         'message' => $response['error'] ?? 'Gagal mengirim dokumen.'
                        //     ]);
                        // }
                    }

                }
            }
        }


    }
?>