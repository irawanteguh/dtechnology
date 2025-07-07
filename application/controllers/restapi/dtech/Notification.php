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
            $responList              = [];
            $resulthasillaboratorium = "";
            $limit                   = "limit ".rand(1, 5).";";
            $resulthasillaboratorium = $this->md->hasillaboratorium(ORG_ID, $limit);

            if (!empty($resulthasillaboratorium)) {
                foreach ($resulthasillaboratorium as $a) {
                    $transaksiid = "";
                    $deviceid    = "";
                    $nofile      = "";
                    $norawat     = "";
                    $filepath    = "";
                    $data        = [];

                    $transaksiid = generateuuid();
                    $deviceid    = "1234";
                    $nofile      = $a->no_file ?? '';
                    $norawat     = $a->transaksi_idx ?? '';
                    $filepath    = FCPATH."assets/document/".$nofile.".pdf";
                    
                    $informasikunjunganpasien = $this->md->informasikunjunganpasien($norawat);
                    if (!empty($informasikunjunganpasien)) {
                        $text  = "*".$a->namars."*";
                        $text .= "%0a*RMB Hospital Group*%0a";
                        $text .= "%0aKepada Yth,.";
                        $text .= "%0a*".$informasikunjunganpasien->namapasien."*%0a";
                        $text .= "%0aBerikut kami sampaikan hasil pemeriksaan laboratorium";
                        $text .= "%0aNo Rekam Medis%09: ".$informasikunjunganpasien->no_rkm_medis;
                        $text .= "%0aNama Pasien%09: ".$informasikunjunganpasien->namapasien;
                        $text .= "%0aTanggal Lahir%09: ".$informasikunjunganpasien->bod;
                        $text .= "%0aAlamat%09%09: ".$informasikunjunganpasien->almt_pj;
                        $text .= "%0aNo Transaksi%09: ".$norawat;
                        $text .= "%0aTanggal Berobat%09: ".$informasikunjunganpasien->tglkunjungan;
                        $text .= "%0aPoliklinik%09%09: ".$informasikunjunganpasien->politujuan;
                        $text .= "%0aDokter%09%09: ".$informasikunjunganpasien->namadokter;
                        $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                        $data['org_id']        = ORG_ID;
                        $data['transaksi_id']  = $transaksiid;
                        $data['body_1']        = $text;
                        $data['device_id']     = $deviceid;
                        // $data['to']            = $informasikunjunganpasien->nohp ?? '';
                        $data['to']            = "6281288646630";
                        $data['type_file']     = "1";
                        $data['directory']     = $filepath;
                        $data['document_name'] = $nofile;

                        $responList[] = [
                            'status'        => $this->md->simpanboardcast($data),
                            'org_id'        => ORG_ID,
                            'transaksi_id'  => $transaksiid,
                            'device_id'     => $deviceid,
                            'to'            => $informasikunjunganpasien->nohp ?? '',
                            'type_file'     => "1",
                            'directory'     => $filepath,
                            'document_name' => $nofile
                        ];
                    }
                }
                $this->response(['status'  => true,'message' => 'Data berhasil diambil.','data'    => $responList], 200);
            } else {
                $this->response(['status'  => false,'message' => 'Tidak ada hasil laboratorium ditemukan.'], 200);
            }
        }



    }
?>