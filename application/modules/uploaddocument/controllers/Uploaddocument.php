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

        public function uploadfilette() {
            header('Content-Type: application/json');
            $json = [];
        
            if (!isset($_FILES['file'])) {
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = "No file uploaded.";
                log_message('error', 'File upload error: No file uploaded.');
                echo json_encode($json);
                return;
            }
        
            $filename  = $_FILES['file']['name'];
            $partsfile = explode("-", basename($filename));
        
            if (count($partsfile) !== 5) {
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = "File name format is incorrect. Expected format: nofile-jenisdoc-assign-pasienid-transaksiid.pdf";
                echo json_encode($json);
                return;
            }
        
            list($nofile, $jenisdoc, $assign, $pasienid, $transaksiid) = $partsfile;
            $transaksiid = str_replace(".pdf", "", $transaksiid);
        
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
                $json['responDesc'] = "File upload failed: " . $error;
            } else {
                $upload_data = $this->upload->data();
        
                $data = [
                    'org_id'        => $_SESSION['orgid'] ?? '10c84edd-500b-49e3-93a5-a2c8cd2c8524',
                    'no_file'       => $nofile,
                    'status_file'   => "1",
                    'jenis_doc'     => $jenisdoc,
                    'assign'        => $assign,
                    'pasien_idx'    => $pasienid,
                    'transaksi_idx' => $transaksiid,
                    'source_file'   => "DTECHNOLOGY"
                ];
        
                if ($this->md->insertsigndocument($data)) {
                    $json['responCode'] = "00";
                    $json['responHead'] = "success";
                    $json['responDesc'] = "Successfully uploaded";
                } else {
                    log_message('error', 'File upload error: Failed to save data');
                    $json['responCode'] = "01";
                    $json['responHead'] = "error";
                    $json['responDesc'] = "Failed to save data";
                }
            }
        
            echo json_encode($json);
        }        
        
    }
?>