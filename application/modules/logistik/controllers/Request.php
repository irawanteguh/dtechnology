<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Request extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_request",$data);
        }

        public function loadcombobox(){
            $resultmastersupplier = $this->md->mastersupplier($_SESSION['orgid']);
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $data['mastersupplier']           = $mastersupplier;
            
            return $data;
		}

        public function newrequest(){
            
            $data['org_id']          = $_SESSION['orgid'];
            $data['no_pemesanan']    = $this->md->buatnopemesanan($_SESSION['orgid'])->nomor_pemesanan;
            $data['judul_pemesanan'] = $this->input->post("modal_new_request_nama");
            $data['note']            = $this->input->post("keterangan");
            $data['department_id']   = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
            $data['supplier_id']     = $this->input->post("modal_new_request_supplier");
            $data['created_by']      = $_SESSION['userid'];

            if($this->md->insertheader($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Berhasil Di Tambah";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Gagal Di Tambah";
            }

            echo json_encode($json);
        }

        public function datarequest(){
            $result = $this->md->datarequest($_SESSION['orgid'],$this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id);
            
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

        public function masterbarang(){
            $result = $this->md->masterbarang($_SESSION['orgid']);
            
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
            $validasi     = $this->input->post('validasi');
            $item_id      = $this->input->post('item_id');
            $qty          = $this->input->post('qty');
            $harga        = $this->input->post('harga');
            $ppn          = $this->input->post('ppn');
            $subtotal     = $this->input->post('subtotal');
            $vat_amount   = $this->input->post('vat_amount');
            
            if($validasi==="KAINS"){
                $data['QTY_MINTA'] = $qty;
            }

            if($validasi==="MANAGER"){
                $data['QTY_MANAGER']  = $qty;
                $data['MANAGER_ID']   = $_SESSION['userid'];
                $data['MANAGER_DATE'] = date('Y-m-d H:i:s');
            }
            
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

        public function updateheader() {
            $datanopemesanan = $this->input->post('datanopemesanan');
            $status       = $this->input->post('status');
            
            $data['STATUS'] = $status;

            if($status==="3" || $status==="4"){
                $data['MANAGER_ID']   = $_SESSION['userid'];
                $data['MANAGER_DATE'] = date('Y-m-d H:i:s');
            }
            

            if($this->md->updateheader($datanopemesanan,$data)){

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
        
    }
?>