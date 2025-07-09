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

        public function documenttte_post() {
            $responList = [];
            $resultdata = "";
            $limit      = "limit ".rand(1, 5).";";
            $resultdata = $this->md->documenttte(ORG_ID, $limit);

            if(!empty($resultdata)){
                foreach ($resultdata as $a) {
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
                        $to = "";
                        $to = $informasikunjunganpasien->nohp;

                        $text  = "*".$a->namars."*";
                        $text .= "%0a*RMB Hospital Group*";
                        $text .= "%0a%0aKepada Yth,.";
                        $text .= "%0a*".$informasikunjunganpasien->namapasien."*%0a";

                        if($a->typedocument==="LAB"){
                            $text .= "%0aBerikut kami sampaikan hasil pemeriksaan laboratorium";
                        }
                        $text .= "%0aNo Rekam Medis%09: ".$informasikunjunganpasien->no_rkm_medis;
                        $text .= "%0aNama Pasien%09: ".$informasikunjunganpasien->namapasien;
                        $text .= "%0aTanggal Lahir%09: ".$informasikunjunganpasien->bod;
                        $text .= "%0aAlamat%09%09: ".$informasikunjunganpasien->almt_pj;
                        // $text .= "%0aNo Transaksi%09: ".$norawat;
                        $text .= "%0aTanggal Berobat%09: ".$informasikunjunganpasien->tglkunjungan;
                        $text .= "%0aPoliklinik%09%09: ".$informasikunjunganpasien->politujuan;
                        $text .= "%0aDokter%09%09: ".$informasikunjunganpasien->namadokter;
                        $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                        $data['org_id']        = ORG_ID;
                        $data['transaksi_id']  = $transaksiid;
                        $data['body_1']        = $text;
                        $data['device_id']     = $deviceid;
                        $data['to']            = $to;
                        $data['type_file']     = "1";
                        $data['directory']     = $filepath;
                        $data['document_name'] = $nofile;
                        $data['ref_id']        = $nofile;

                        if ($informasikunjunganpasien->statusmiddleware === "TRUE") {
                            $responList[] = [
                                'status'        => $this->md->simpanboardcast($data),
                                'org_id'        => ORG_ID,
                                'transaksi_id'  => $transaksiid,
                                'device_id'     => $deviceid,
                                'to'            => $to,
                                'type_file'     => "1",
                                'directory'     => $filepath,
                                'document_name' => $nofile,
                                'ref_id'        => $nofile
                            ];
                        } else {
                            $responList[] = [
                                'status'        => false,
                                'org_id'        => ORG_ID,
                                'transaksi_id'  => $transaksiid,
                                'device_id'     => $deviceid,
                                'to'            => $to,
                                'type_file'     => "1",
                                'directory'     => null,
                                'document_name' => null,
                                'ref_id'        => null,
                                'note'          => 'Status middleware bukan TRUE, file tidak disimpan'
                            ];
                        }

                    }
                }
                $this->response(['status'  => true,'message' => 'Data berhasil diambil.','data'    => $responList], 200);
            } else {
                $this->response(['status'  => false,'message' => 'Tidak ada hasil laboratorium ditemukan.'], 200);
            }
        }

        public function approvalpodirector_post() {
            $responList = [];
            $resultdata = "";
            $parameter  = "and   a.status='6' and   a.status_dir is null";
            $limit      = "limit ".rand(1, 1).";";
            $resultdata = $this->md->approvalpo(ORG_ID,$parameter,$limit);

            if (!empty($resultdata)) {
                foreach ($resultdata as $a) {
                    $transaksiid = "";
                    $deviceid    = "";
                    $to          = "";
                    $refid       = "";
                    $data        = [];
                   
                    $transaksiid = generateuuid();
                    $deviceid    = "1234";
                    $to          = "6281266678881";
                    $refid       = $a->no_pemesanan;
                    
                    $text  = "*".$a->namars."*";
                    $text .= "%0a*RMB Hospital Group*";
                    $text .= "%0aKepada Yth,.";
                    $text .= "%0a*dr. Abdul Robby Azhadi, MARS, FISQua.*%0a";
                    $text .= "%0aBerikut kami sampaikan permohonan persetujuan purchase order direktur:";
                    $text .= "%0a%0aNo Pemesanan%09: ";
                    $text .= "%0a".$a->no_pemesanan_unit;
                    $text .= "%0a%0aJudul Pemesanan%09: ";
                    $text .= "%0a".$a->judul_pemesanan;
                    $text .= "%0a%0aCatatan%09: ";
                    $text .= "%0a".$a->note;
                    $text .= "%0a%0aDepartment%09: ";
                    $text .= "%0a".$a->departmen;
                    $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                    $data['org_id']       = ORG_ID;
                    $data['transaksi_id'] = $transaksiid;
                    $data['body_1']       = $text;
                    $data['device_id']    = $deviceid;
                    $data['to']           = $to;
                    $data['ref_id']       = $refid;
                    $data['type_file']    = "0";
                    $data['template_id']  = "APPROVAL PO DIRECTOR";
                    
                    $responList[] = [
                        'status'       => $this->md->simpanboardcast($data),
                        'org_id'       => ORG_ID,
                        'transaksi_id' => $transaksiid,
                        'device_id'    => $deviceid,
                        'to'           => $to,
                        'ref_id'       => $a->no_pemesanan,
                        'type_file'    => "0"
                    ];
                }
                $this->response(['status'  => true,'message' => 'Data berhasil diambil.','data'    => $responList], 200);
            } else {
                $this->response(['status'  => false,'message' => 'Tidak ada hasil laboratorium ditemukan.'], 200);
            }
        }

    }
?>