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
        // public function addsigndocument_POST() {
        //     $data  = [];
        //     $input = json_decode($this->input->raw_input_stream, true);

        //     return var_dump($input);

        //     $data['org_id']          = $input['org_id'];
        //     $data['no_file']         = $input['no_file'];
        //     $data['filename']        = $input['filename'];
        //     $data['jenis_doc']       = $input['jenis_doc'];
        //     $data['assign']          = $input['assign'];
        //     $data['status_sign']     = $input['status_sign'];
        //     $data['pasien_idx']      = $input['pasien_idx'];
        //     $data['transaksi_idx']   = $input['transaksi_idx'];
        //     $data['source_file']     = $input['source_file'];
        //     $data['status_file']     = $input['status_file'];
        //     $data['user_identifier'] = $input['user_identifier'];

        //     $config['upload_path']   = FCPATH.'assets/document/';
        //     $config['allowed_types'] = 'pdf';
        //     $config['file_name']     = $input['no_file'];
        //     $config['overwrite']     = true;

        //     $this->load->library('upload', $config);

        //     if (!$this->upload->do_upload('file')) {
        //         $error_message = strip_tags($this->upload->display_errors());

        //         // log_message('error', 'File upload error: ' . $error_message);
        //         $message = "File upload error: ".$error_message;
        //     }else{
        //         if($this->md->insertsigndocument($data)){
        //             $message = "Data Berhasil Di Simpan";
        //         }else{
        //             $message = "Data Gagal Di Simpan";
        //         }
        //     }

        //     return $this->response([
        //         'status'  => true,
        //         'message' => $message,
        //         'data'    => $data
        //     ], 200);

        // }

        public function addsigndocument_POST(){
            $input = json_decode($this->input->raw_input_stream, true);

            if(empty($input)){
                return $this->response([
                    'status'  => false,
                    'message' => 'Request body kosong atau format tidak valid.'
                ], 400);
            }

            $data = [
                'org_id'          => $input['org_id'] ?? '',
                'no_file'         => $input['no_file'] ?? '',
                'jenis_doc'       => $input['jenis_doc'] ?? '',
                'assign'          => $input['assign'] ?? '',
                'pasien_idx'      => $input['pasien_idx'] ?? '',
                'transaksi_idx'   => $input['transaksi_idx'] ?? '',
                'source_file'     => $input['source_file'] ?? '',
                'status_file'     => $input['status_file'] ?? '',
            ];

            $file_content = $input['file_content'] ?? null;
            $save_path    = FCPATH . 'assets/document/' . $data['no_file'] . '.pdf';

            if (empty($file_content)) {
                return $this->response([
                    'status'  => false,
                    'message' => 'File content kosong (base64 tidak ditemukan).',
                    'data'    => $data
                ], 400);
            }

            // Decode base64 ke binary dan simpan sebagai file PDF
            $binary_data = base64_decode($file_content);

            if ($binary_data === false) {
                return $this->response([
                    'status'  => false,
                    'message' => 'File base64 gagal didekode.',
                    'data'    => $data
                ], 400);
            }

            // Simpan file ke lokasi tujuan
            if (file_put_contents($save_path, $binary_data) === false) {
                return $this->response([
                    'status'  => false,
                    'message' => 'Gagal menyimpan file ke server.',
                    'data'    => $data
                ], 500);
            }

            // Simpan metadata ke database
            $save = $this->md->insertsigndocument($data);

            return $this->response([
                'status'  => $save,
                'message' => $save ? 'File dan data berhasil disimpan.' : 'File tersimpan, tapi gagal insert database.',
                'file'    => base_url('assets/document/' . $data['no_file'] . '.pdf'),
                'data'    => $data
            ], 200);
        }

        public function statusdocument_get($nofile) {
            $data                 = [];
            $resultstatusdocument = $this->md->statusdocument($nofile);

            if(!empty($resultstatusdocument)){
                $location = "";

                if($resultstatusdocument->source_file==="DTECHNOLOGY"){
                    $location = FCPATH."assets/document/".$resultstatusdocument->no_file.".pdf";
                }else{
                    $location = PATHFILE_GET_TILAKA."/".$resultstatusdocument->no_file.".pdf";
                }
                    
                if(file_exists($location)){
                    $data['no_file']             = $resultstatusdocument->no_file;
                    $data['jenis_document_code'] = $resultstatusdocument->jenis_doc;
                    $data['jenis_document']      = $resultstatusdocument->typedocument;
                    $data['note_1']              = $resultstatusdocument->pasien_idx;
                    $data['note_2']              = $resultstatusdocument->transaksi_idx;
                    $data['note_3']              = $resultstatusdocument->note;
                    $data['assign_name']         = $resultstatusdocument->assignname;
                    $data['active']              = (bool) $resultstatusdocument->active;
                    $data['status_file']         = (bool) $resultstatusdocument->status_file;
                    $data['status_sign_code']    = $resultstatusdocument->status_sign;
                    $data['status_sign']         = $resultstatusdocument->status;
                    $data['file_content']        = base64_encode(file_get_contents($location));
                    $data['created_date']        = $resultstatusdocument->created_date;
                    $status                      = true;
                    $message                     = "Dokumen ditemukan";
                }else{
                    $status          = false;
                    $message         = "File Tidak Di Temukan";
                }
            }else{
                $data['no_file'] = $nofile;
                $status          = false;
                $message         = "Dokumen tidak ditemukan";
            }

            return $this->response([
                'status'  => $status,
                'message' => $message,
                'data'    => $data
            ], 200);
        }

    }
?>