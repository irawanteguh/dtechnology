<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Uploaddocument extends CI_Controller{ 
        public function __construct(){
            parent:: __construct();
            $this->load->model("Modeluploaddocument","md");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_uploaddocument");
        }

        public function uploadfilette(){
            header('Content-Type: application/json'); // Pastikan response JSON
            $json = [];
        
            if (!isset($_FILES['file'])) {
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = "No file uploaded.";
                echo json_encode($json);
                return;
            }
        
            $filename  = $_FILES['file']['name'];
            $partsfile = explode("-", basename($filename));

            $nofile      = $partsfile[0];
            $jenisdoc    = $partsfile[1];
            $assign      = $partsfile[2];
            $pasienid    = $partsfile[3];
            $transaksiid = str_replace(".pdf", "", $partsfile[4]);
        
            if (count($partsfile) !== 5) {
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = "The array does not have 5 elements";
                echo json_encode($json);
                return;
            }
        
            $config['upload_path']   = './assets/document/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $nofile;
            $config['overwrite']     = TRUE;
            
            $this->load->library('upload', $config);
        
            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors('', '');
                log_message('error', 'File upload error: ' . $error);
        
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = $error;
            } else {
                $upload_data = $this->upload->data();
        
                $data['org_id']        = isset($_SESSION['orgid']) ? $_SESSION['orgid'] : '10c84edd-500b-49e3-93a5-a2c8cd2c8524';
                $data['no_file']       = $nofile;
                $data['status_file']   = "1";
                $data['jenis_doc']     = $jenisdoc;
                $data['assign']        = $assign;
                $data['pasien_idx']    = $pasienid;
                $data['transaksi_idx'] = $transaksiid;
                $data['source_file']   = "DTECHNOLOGY";

                if($this->md->insertsigndocument($data)){
                    $json['responCode'] = "00";
                    $json['responHead'] = "success";
                    $json['responDesc'] = "Successfully uploaded";
                }else{
                    $json['responCode'] = "01";
                    $json['responHead'] = "error";
                    $json['responDesc'] = "Failed to save data";
                }
            }
        
            echo json_encode($json);
        }
        
    }
?>