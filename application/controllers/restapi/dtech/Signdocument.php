<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Signdocument extends REST_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->model("Modelsigndocument","md");
            $this->resetresponse();
        }

        public function resetresponse(){
            $body    = [];
            $code    = 401;
            $status  = false;
            $message = "";
        }

        // public function _remap($method, $arguments = []) {
        //     $headers = getallheaders();
        //     $response = [];

        //     if(isset($headers["x-token"])){
        //         try{
        //             $decodedtoken = Authorization::validateToken($headers["x-token"]);
        //             if($decodedtoken != false){
        //                 if(isset($decodedtoken->expired) && $decodedtoken->expired >= time()){
        //                     return parent::_remap($method, $arguments);
        //                 }else{
        //                     $response['code']    = 401;
        //                     $response['status']  = false;
        //                     $response['message'] = "Token expired";
        //                 }
        //             } else {
        //                 $response['code']    = 406;
        //                 $response['status']  = false;
        //                 $response['message'] = "Not Acceptable: Token not valid";
        //             }
        //         }catch(Exception $e){
        //             $response['code']    = 406;
        //             $response['status']  = false;
        //             $response['message'] = "Not Acceptable: Token exception";
        //         }
        //     }else{
        //         $response['code']    = 406;
        //         $response['status']  = false;
        //         $response['message'] = "Not Acceptable: Header x-token not found";
        //     }

        //     return $this->response($response, $response['code']);
        // }

        //RMB Hospital Group Direct To Tilaka RSMS
        public function addsigndocument_POST() {
            $data  = [];
            // $input = json_decode($this->input->raw_input_stream, true);
            $input = $this->input->post();

            $data['org_id']          = $input['org_id'];
            $data['no_file']         = $input['no_file'];
            $data['filename']        = $input['filename'];
            $data['jenis_doc']       = $input['jenis_doc'];
            $data['assign']          = $input['assign'];
            $data['status_sign']     = $input['status_sign'];
            $data['pasien_idx']      = $input['pasien_idx'];
            $data['transaksi_idx']   = $input['transaksi_idx'];
            $data['source_file']     = $input['source_file'];
            $data['status_file']     = $input['status_file'];
            $data['user_identifier'] = $input['user_identifier'];

            $config['upload_path']   = FCPATH.'assets/document/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $input['no_file'];
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error_message = strip_tags($this->upload->display_errors());

                // log_message('error', 'File upload error: ' . $error_message);
                $message = "File upload error: ".$error_message;
            }else{
                if($this->md->insertsigndocument($data)){
                    $message = "Data Berhasil Di Simpan";
                }else{
                    $message = "Data Gagal Di Simpan";
                }
            }

            return $this->response([
                'status'  => true,
                'message' => $message,
                'data'    => $data
            ], 200);

        }

        // public function statusdocument_get() {
        //     $data  = [];
        //     $input = json_decode($this->input->raw_input_stream, true);

        //     if (!isset($input['orgid']) || empty($input['orgid'])) {
        //         return $this->response([
        //             'status' => false,
        //             'message' => 'Bad Request: orgid is required'
        //         ], 400);
        //     }

        //     if (!isset($input['nofile']) || empty($input['nofile'])) {
        //         return $this->response([
        //             'status' => false,
        //             'message' => 'Bad Request: orgid is required'
        //         ], 400);
        //     }

        //     $resultstatusdocument = $this->md->statusdocument($input['orgid'],$input['nofile']);

        //     if(!empty($resultstatusdocument)){
        //         $data['no_file']             = $resultstatusdocument->no_file;
        //         $data['jenis_document_code'] = $resultstatusdocument->jenis_doc;
        //         $data['jenis_document']      = $resultstatusdocument->typedocument;
        //         $data['note_1']              = $resultstatusdocument->pasien_idx;
        //         $data['note_2']              = $resultstatusdocument->transaksi_idx;
        //         $data['note_3']              = $resultstatusdocument->note;
        //         $data['assign_name']         = $resultstatusdocument->assignname;
        //         $data['active']              = (bool) $resultstatusdocument->active;
        //         $data['status_file']         = (bool) $resultstatusdocument->status_file;
        //         $data['status_sign_code']    = $resultstatusdocument->status_sign;
        //         $data['status_sign']         = $resultstatusdocument->status;
        //         $data['created_date']        = $resultstatusdocument->created_date;
        //         $message                     = "Dokument ditemukan";
        //     }else{
        //         $data['no_file'] = $input['nofile'];
        //         $message         = "Dokument tidak ditemukan";
        //     }

        //     return $this->response([
        //         'status' => true,
        //         'message' => $message,
        //         'data' => $data
        //     ], 200);
        // }

    }
?>