<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Sb extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelserviceapi","md");
            $this->resetresponse();
        }

        public function resetresponse(){
            $body    = [];
            $code    = 401;
            $status  = false;
            $message = "";
        }

        public function _remap($method, $arguments = []) {
            $headers = getallheaders();
            $response = [];

            if(isset($headers["x-token"])){
                try{
                    $decodedtoken = Authorization::validateToken($headers["x-token"]);
                    if($decodedtoken != false){
                        if(isset($decodedtoken->expired) && $decodedtoken->expired >= time()){
                            return parent::_remap($method, $arguments);
                        }else{
                            $response['code']    = 401;
                            $response['status']  = false;
                            $response['message'] = "Token expired";
                        }
                    } else {
                        $response['code']    = 406;
                        $response['status']  = false;
                        $response['message'] = "Not Acceptable: Token not valid";
                    }
                }catch(Exception $e){
                    $response['code']    = 406;
                    $response['status']  = false;
                    $response['message'] = "Not Acceptable: Token exception";
                }
            }else{
                $response['code']    = 406;
                $response['status']  = false;
                $response['message'] = "Not Acceptable: Header x-token not found";
            }

            return $this->response($response, $response['code']);
        }

        public function quickreport_post() {
            $input = json_decode($this->input->raw_input_stream, true);

            if (!isset($input['orgid']) || empty($input['orgid'])) {
                return $this->response([
                    'status' => false,
                    'message' => 'Bad Request: orgid is required'
                ], 400);
            }

            if (!isset($input['quickreport']) || !is_array($input['quickreport'])) {
                return $this->response([
                    'status' => false,
                    'message' => 'Bad Request: quickreport object is required'
                ], 400);
            }

            $qr = $input['quickreport'];

            if (!isset($qr['tanggal']) || empty($qr['tanggal'])) {
                return $this->response([
                    'status' => false,
                    'message' => 'Bad Request: quickreport.tanggal is required'
                ], 400);
            }

            if (!isset($qr['kunjungan']) || !is_array($qr['kunjungan'])) {
                return $this->response([
                    'status' => false,
                    'message' => 'Bad Request: quickreport.kunjungan is required'
                ], 400);
            }

            if (!isset($qr['pendapatan']) || !is_array($qr['pendapatan'])) {
                return $this->response([
                    'status' => false,
                    'message' => 'Bad Request: quickreport.pendapatan is required'
                ], 400);
            }

            $orgid      = $input['orgid'];
            $date       = $qr['tanggal'];
            $kunjungan  = $qr['kunjungan'];
            $pendapatan = $qr['pendapatan'];

            $getval = function($arr, $kategori, $key) {
                return isset($arr[$kategori][$key]) ? preg_replace('/\D/', '', $arr[$kategori][$key]) : '0';
            };

            $data = [
                'org_id'           => $orgid,
                'transaksi_id'     => generateuuid(),
                'date'             => $date,
                'last_update_date' => date("Y-m-d H:i:s"),
                'u_rj'             => $getval($pendapatan, 'rawatjalan', 'umum'),
                'u_ri'             => $getval($pendapatan, 'rawatinap', 'umum'),
                'a_rj'             => $getval($pendapatan, 'rawatjalan', 'asuransi'),
                'a_ri'             => $getval($pendapatan, 'rawatinap', 'asuransi'),
                'b_rj'             => $getval($pendapatan, 'rawatjalan', 'bpjs'),
                'b_ri'             => $getval($pendapatan, 'rawatinap', 'bpjs'),
                'mcu_cash'         => $getval($pendapatan, 'rawatjalan', 'mcu_cash'),
                'mcu_inv'          => $getval($pendapatan, 'rawatjalan', 'mcu_inv'),
                'lain'             => $getval($pendapatan, 'rawatjalan', 'lain'),
                'pob'              => $getval($pendapatan, 'rawatjalan', 'pob'),
                'k_urj'            => $getval($kunjungan, 'rawatjalan', 'umum'),
                'k_uri'            => $getval($kunjungan, 'rawatinap', 'umum'),
                'k_arj'            => $getval($kunjungan, 'rawatjalan', 'asuransi'),
                'k_ari'            => $getval($kunjungan, 'rawatinap', 'asuransi'),
                'k_brj'            => $getval($kunjungan, 'rawatjalan', 'bpjs'),
                'k_bri'            => $getval($kunjungan, 'rawatinap', 'bpjs')
            ];

            // Cek data sudah ada atau belum
            $existing = $this->md->cekdata($orgid, $date);

            if ($existing) {
                unset($data['transaksi_id']);
                $exec = $this->md->updatequickreport($orgid, $date, $data);
                $message = "Data Updated Successfully";
            } else {
                $exec = $this->md->insertquickreport($data);
                $message = "Data Added Successfully";
            }

            return $this->response([
                'status' => true,
                'message' => $message,
                'data' => $data
            ], 200);
        }

    }
?>