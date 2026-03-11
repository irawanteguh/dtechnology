<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    if(!function_exists('color')){
        function color($name = null){
            $colors = [
                'reset'          => "\033[0m",
                'black'          => "\033[30m",
                'red'            => "\033[31m",
                'green'          => "\033[32m",
                'yellow'         => "\033[33m",
                'blue'           => "\033[34m",
                'magenta'        => "\033[35m",
                'cyan'           => "\033[36m",
                'white'          => "\033[37m",
                'gray'           => "\033[90m",
                'light_red'      => "\033[91m",
                'light_green'    => "\033[92m",
                'light_yellow'   => "\033[93m",
                'light_blue'     => "\033[94m",
                'light_magenta'  => "\033[95m",
                'light_cyan'     => "\033[96m",
                'light_white'    => "\033[97m",
            ];

            return $colors[$name] ?? $colors['reset'];
        }
    }

    class SyncTTE extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("ModelSyncTTE","md");
            headerlog();
        }

        public function datatransaksi_POST(){
            $resultdatatransaksi = $this->md->datatransaksi();

            if(empty($resultdatatransaksi)){
                echo color('red')."Data Tidak Ditemukan";
                return;
            }

            foreach($resultdatatransaksi as $a){
                $data = [];

                $data['org_id']           = $a->org_id;
                $data['no_file']          = $a->no_file;
                $data['signer_id']        = $a->assign;
                $data['jenis_doc']        = $a->jenis_doc;
                $data['note_1']           = $a->pasien_idx;
                $data['note_2']           = $a->transaksi_idx;
                $data['from_in']          = $a->source_file;
                $data['storage_in']       = TYPESTORAGE;
                $data['provider_sign']    = PROVIDERSIGN;
                $data['type_of']          = TYPEOF;
                $data['type_certificate'] = TYPECERTIFICATE;
                $data['created_by']       = $a->assign;

                if($this->md->insertdocument($data)){
                    $statusColor = "green";
                    $statusMsg   = "Success";

                    $dataupdate['status_sign']='x';
                    $this->md->updatedocument($dataupdate,$a->no_file);

                    echo formatlog($a->no_file.".pdf",$a->assign,$statusMsg,'white','green',$statusColor);
                }else{
                    $statusColor = "red";
                    $statusMsg   = "Failed";

                    echo formatlog($a->no_file.".pdf",$a->assign,$statusMsg,'white','green',$statusColor);
                }

                continue;
            }
        }

    }
?>