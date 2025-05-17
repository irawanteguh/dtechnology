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

        public function quickreportkunjungan_post(){
            $resultdataquickreport = $this->md->dataquickreportkunjungan();

            if(!empty($resultdataquickreport)){
                foreach($resultdataquickreport as $a){
                    $body['orgid']                  = ORG_ID;
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

                    $responsequickreport = Dtech::quickreportkunjungan(json_encode($body));
                    $this->response($responsequickreport,200);
                }
            }
        }

        public function quickreportpendapatan_post(){
            $resultdataquickreport = $this->md->dataquickreportpendapatan();

            if(!empty($resultdataquickreport)){
                foreach($resultdataquickreport as $a){
                    $body['orgid']                  = ORG_ID;
                    $body['quickreport']['tanggal'] = $a->tgl_byr;

                    $body['quickreport']['pendapatan']['rawatjalan'] = [
                        'umum'      => (int)$a->umum_rajal,
                        'asuransi'  => (int)$a->asuransi_rajal,
                        'bpjs'      => (int)$a->bpjs_rajal,
                        'mcu_cash'  => 0,
                        'mcu_inv'   => (int)$a->total_mcu,
                        'lain'      => 0,
                        'pob'       => (int)$a->pob,
                    ];

                    $body['quickreport']['pendapatan']['rawatinap'] = [
                        'umum'      => (int)$a->umum_ranap,
                        'asuransi'  => (int)$a->asuransi_ranap,
                        'bpjs'      => (int)$a->bpjs_ranap
                    ];

                    $responsequickreport = Dtech::quickreportpendapatan(json_encode($body));
                    $this->response($responsequickreport,200);
                }
            }
        }

    }

?>