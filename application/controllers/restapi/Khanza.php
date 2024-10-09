<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";

    class Khanza extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelkhanza","md");
        }

        public function pegawai_GET(){
            $result = $this->md->datapegawai();
            if(!empty($result)){
                foreach($result as $a){
                    $resultcheckdata = $this->md->checkdata(ORG_ID,$a->nik);

                    $data['ORG_ID']      = ORG_ID;
                    $data['NIK']         = $a->nik;
                    $data['USERNAME']    = $a->nik;
                    $data['NAME']        = $a->nama;
                    $data['IDENTITY_NO'] = $a->no_ktp;
                    $data['SEX_ID']      = $a->sexid;
                    $data['ADDRESS']     = $a->alamat;
                    $data['SUSPENDED']   = $a->susspended;
                    $data['CREATED_BY']  = "55b16625-efca-4093-8df0-20fc838f21b1";

                    if(empty($resultcheckdata)){
                        $data['USER_ID']     = generateuuid();
                        $this->md->insertdatauser($data);
                    }
                }
            }
        }

    }

?>