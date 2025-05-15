<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";

    class Sb extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelsb","md");
        }

        public function quickreport_post(){
            $resultdataquickreport = $this->md->dataquickreport();

            if(!empty($resultdataquickreport)){
                foreach($resultdataquickreport as $a){
                    $body['orgid'] = ORG_ID;
                    $body['quickreport']['tanggal'] = $a->tgl_registrasi;

                    $body['quickreport']['kunjungan']['rawatjalan'] = [
                        'umum'      => (int)$a->kunjunganumumrj,
                        'asuransi'  => (int)$a->kunjunganasuransirj,
                        'bpjs'      => (int)$a->kunjunganbpjsrj,
                        'mcu_cash'  => 0,
                        'mcu_inv'   => 0
                    ];

                    $body['quickreport']['kunjungan']['rawatinap'] = [
                        'umum'      => (int)$a->kunjunganumumri,
                        'asuransi'  => (int)$a->kunjunganasuransiri,
                        'bpjs'      => (int)$a->kunjunganbpjsri
                    ];

                    $body['quickreport']['pendapatan']['rawatjalan'] = [
                        'umum'      => 0,
                        'asuransi'  => 0,
                        'bpjs'      => 0,
                        'mcu_cash'  => 0,
                        'mcu_inv'   => 0,
                        'lain'      => 0,
                        'pob'       => 0
                    ];

                    $body['quickreport']['pendapatan']['rawatinap'] = [
                        'umum'      => 0,
                        'asuransi'  => 0,
                        'bpjs'      => 0
                    ];


                    $responsequickreport = Dtech::quickreport(json_encode($body));
                    $this->response($responsequickreport,200);
                }
            }
        }

        
    }

?>