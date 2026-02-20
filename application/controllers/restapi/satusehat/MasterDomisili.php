<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";

    class Masterdomisili extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelmasterdomisili","md");
        }

        public function domisili_GET(){
            $parameter = "provinces";
            $response  = Satusehat::masterdomisili($parameter);

            if($response['status']===200){
                foreach($response['data'] as $a){
                    $cekdata =$this->md->cekdata($a['code']);

                    if(empty($cekdata)){
                        $data['CODE']        = $a['code'];
                        $data['PARENT_CODE'] = $a['parent_code'];
                        $data['BPS_CODE']    = $a['bps_code'];
                        $data['NAME']        = $a['name'];
                        $data['JENIS']       = "1";
                        $data['CREATED_BY']  = "ac55c7c3-bf4a-48cb-86b8-f1d02de32c7c";
                        $this->md->insertdata($data);
    
    
                        $parameter = "cities?province_codes=".$a['code'];
                        $response  = Satusehat::masterdomisili($parameter);
                        if($response['status']===200){
                            foreach($response['data'] as $a){
                                $cekdata =$this->md->cekdata($a['code']);
                                
                                if(empty($cekdata)){
                                    $data['CODE']        = $a['code'];
                                    $data['PARENT_CODE'] = $a['parent_code'];
                                    $data['BPS_CODE']    = $a['bps_code'];
                                    $data['NAME']        = $a['name'];
                                    $data['JENIS']       = "2";
                                    $data['CREATED_BY']  = "ac55c7c3-bf4a-48cb-86b8-f1d02de32c7c";
                                    $this->md->insertdata($data);
        
        
                                    $parameter = "districts?city_codes=".$a['code'];
                                    $response  = Satusehat::masterdomisili($parameter);
                                    if($response['status']===200){
                                        foreach($response['data'] as $a){
                                            $cekdata =$this->md->cekdata($a['code']);

                                            if(empty($cekdata)){
                                                $data['CODE']        = $a['code'];
                                                $data['PARENT_CODE'] = $a['parent_code'];
                                                $data['BPS_CODE']    = $a['bps_code'];
                                                $data['NAME']        = $a['name'];
                                                $data['JENIS']       = "3";
                                                $data['CREATED_BY']  = "ac55c7c3-bf4a-48cb-86b8-f1d02de32c7c";
                                                $this->md->insertdata($data);
            
            
                                                $parameter = "sub-districts?district_codes=".$a['code'];
                                                $response  = Satusehat::masterdomisili($parameter);
                                                if($response['status']===200){
                                                    foreach($response['data'] as $a){
                                                        $cekdata =$this->md->cekdata($a['code']);

                                                        if(empty($cekdata)){
                                                            $data['CODE']        = $a['code'];
                                                            $data['PARENT_CODE'] = $a['parent_code'];
                                                            $data['BPS_CODE']    = $a['bps_code'];
                                                            $data['NAME']        = $a['name'];
                                                            $data['JENIS']       = "4";
                                                            $data['CREATED_BY']  = "ac55c7c3-bf4a-48cb-86b8-f1d02de32c7c";
                                                            $this->md->insertdata($data);
                                                        }            
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

    }

?>