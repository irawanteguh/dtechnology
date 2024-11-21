<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Request extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_request");
        }

        public function datarequest(){
            $result = $this->md->datarequest($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }

        public function detailbarang(){
            $nopemesanan =$this->input->post("data_nopemesanan");
            $result = $this->md->detailbarang($_SESSION['orgid'],$nopemesanan);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }

        public function updatedetailitem() {
            $no_pemesanan = $this->input->post('no_pemesanan');
            $item_id      = $this->input->post('item_id');
            $qty          = $this->input->post('qty');
            $harga        = $this->input->post('harga');
            $ppn          = $this->input->post('ppn');
            $subtotal     = $this->input->post('subtotal');
            $vat_amount   = $this->input->post('vat_amount');
            
            $data['QTY_MINTA'] = $qty;
            $data['HARGA']     = $harga;
            $data['PPN']       = $ppn*100;
            $data['HARGA_PPN'] = $vat_amount;
            $data['TOTAL']     = $subtotal;

            if($this->md->updatedetailitem($item_id,$data)){
                $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);

                $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                $dataheader['TOTAL']     = $resulthitungdetail->total;

                $this->md->updateheader($no_pemesanan,$dataheader);

                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Update successful";
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Failed to update database";
            }

            echo json_encode($json);
        }

        public function uploaddocument(){
            $no_pemesanan= $_GET['no_pemesanan'];

            $config['upload_path']   = './assets/documentpo/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $no_pemesanan;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();

                $dataupdate = array('ATTACHMENT' => "1");

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }

        }
        
    }
?>