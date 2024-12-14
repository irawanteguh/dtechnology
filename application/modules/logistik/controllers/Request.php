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
            $resultpaymentmethod  = $this->md->paymentmethod();
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $paymentmethod="";
            foreach($resultpaymentmethod as $a ){
                $paymentmethod.="<option value='".$a->id."'>".$a->metod."</option>";
            }

            $data['mastersupplier']           = $mastersupplier;
            $data['paymentmethod']           = $paymentmethod;
            
            return $data;
		}

        public function newrequest(){
            $data['org_id']          = $_SESSION['orgid'];
            $data['no_pemesanan']    = $this->md->buatnopemesanan($_SESSION['orgid'])->nomor_pemesanan;
            $data['judul_pemesanan'] = $this->input->post("modal_new_request_nama");
            $data['note']            = $this->input->post("modal_new_request_note");
            $data['department_id']   = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
            $data['supplier_id']     = $this->input->post("modal_new_request_supplier");
            $data['method']          = $this->input->post("modal_new_request_method");
            $data['cito']            = $this->input->post("modal_new_request_cito");
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

        public function additem(){
            $no_pemesanan = $this->input->post('no_pemesanan');
            $validasi     = $this->input->post('validasi');
            $barangid     = $this->input->post('barangid');
            $stock        = $this->input->post('stock');
            $qty          = $this->input->post('qty');
            $harga        = $this->input->post('harga');
            $ppn          = $this->input->post('ppn');
            $subtotal     = $this->input->post('subtotal');
            $vat_amount   = $this->input->post('vat_amount');
            $note         = $this->input->post('note');
            $itemid       = generateuuid();

            $data['org_id']       = $_SESSION['orgid'];
            $data['no_pemesanan'] = $no_pemesanan;
            $data['barang_id']    = $barangid;
            $data['stock']        = $stock;
            $data['qty_minta']    = $qty;
            $data['harga']        = $harga;
            $data['ppn']          = $ppn*100;
            $data['harga_ppn']    = $vat_amount;
            $data['total']        = $subtotal;
            $data['note']         = $note;
            $data['created_by']   = $_SESSION['userid'];

            if(empty($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid))){
                $data['item_id']      = $itemid;
                if($this->md->insertitem($data)){

                    $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);
    
                    $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                    $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                    $dataheader['TOTAL']     = $resulthitungdetail->total;
    
                    $this->md->updateheader($no_pemesanan,$dataheader);
    
                    $datastock['org_id']        = $_SESSION['orgid'];
                    $datastock['transaksi_id']  = $itemid;
                    $datastock['department_id'] = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
                    $datastock['barang_id']     = $barangid;
                    $datastock['qty']           = $stock;
                    $datastock['jenis_id']      = "1";
                    $datastock['created_by']    = $_SESSION['userid'];

                    $this->md->insertstock($datastock);

                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Berhasil Di Tambah";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Gagal Di Tambah";
                }
            }else{
                if($this->md->updatebarangid($barangid,$no_pemesanan,$data)){
                    $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);
    
                    $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                    $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                    $dataheader['TOTAL']     = $resulthitungdetail->total;
    
                    $this->md->updateheader($no_pemesanan,$dataheader);

                    $updatedatastock['org_id']        = $_SESSION['orgid'];
                    $updatedatastock['department_id'] = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
                    $updatedatastock['barang_id']     = $barangid;
                    $updatedatastock['qty']           = $stock;
                    $updatedatastock['jenis_id']      = "1";
                    $updatedatastock['created_by']    = $_SESSION['userid'];

                    if(!empty($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid))){
                        $this->md->updatestock($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid)->ITEM_ID,$updatedatastock);
                    }
                    
    
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Berhasil Di Tambah";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Gagal Di Tambah";
                }
            }

            echo json_encode($json);
        }

        public function datarequest(){
            $departmentid = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
            $status="and   a.department_id='".$departmentid."'";
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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
            $data_nopemesanan = $this->input->post("data_nopemesanan");
            $result           = $this->md->masterbarang($_SESSION['orgid'],$data_nopemesanan);
            
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
            $stock        = $this->input->post('stock');
            $harga        = $this->input->post('harga');
            $ppn          = $this->input->post('ppn');
            $subtotal     = $this->input->post('subtotal');
            $vat_amount   = $this->input->post('vat_amount');
            $note         = $this->input->post('note');
            
            if($validasi==="KAINS"){
                $data['QTY_MINTA']   = $qty;
                $data['QTY_MANAGER'] = $qty;
            }

            if($validasi==="MANAGER"){
                $data['QTY_MANAGER']  = $qty;
                $data['QTY_KEU']      = $qty;
                $data['MANAGER_ID']   = $_SESSION['userid'];
                $data['MANAGER_DATE'] = date('Y-m-d H:i:s');
            }

            if($validasi==="FINANCE"){
                $data['QTY_KEU']   = $qty;
                $data['QTY_WADIR'] = $qty;
                $data['KEU_ID']    = $_SESSION['userid'];
                $data['KEU_DATE']  = date('Y-m-d H:i:s');
            }

            if($validasi==="VICE"){
                $data['QTY_WADIR']  = $qty;
                $data['QTY_DIR']    = $qty;
                $data['WADIR_ID']   = $_SESSION['userid'];
                $data['WADIR_DATE'] = date('Y-m-d H:i:s');
            }

            if($validasi==="DIR"){
                $data['QTY_DIR']  = $qty;
                $data['DIR_ID']   = $_SESSION['userid'];
                $data['DIR_DATE'] = date('Y-m-d H:i:s');
            }
            
            $data['STOCK']     = $stock;
            $data['HARGA']     = $harga;
            $data['PPN']       = $ppn*100;
            $data['HARGA_PPN'] = $vat_amount;
            $data['TOTAL']     = $subtotal;
            $data['NOTE']      = $note;

            if($this->md->updatedetailitem($item_id,$data)){
                $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);

                $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                $dataheader['TOTAL']     = $resulthitungdetail->total;

                $this->md->updateheader($no_pemesanan,$dataheader);

                if($validasi==="KAINS"){
                    $updatedatastock['org_id']        = $_SESSION['orgid'];
                    $updatedatastock['department_id'] = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
                    $updatedatastock['qty']           = $stock;
                    $updatedatastock['jenis_id']      = "1";
                    $updatedatastock['created_by']    = $_SESSION['userid'];
    
                    $this->md->updatestock($item_id,$updatedatastock);
                }
                

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

        public function uploadinvoice(){
            $no_pemesanan= $_GET['no_pemesanan'];

            $config['upload_path']   = './assets/invoice/';
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

                $dataupdate['INVOICE']="1";
                $dataupdate['STATUS']="7";

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }
        }

        public function uploadbuktibayar(){
            $no_pemesanan= $_GET['no_pemesanan'];

            $config['upload_path']   = './assets/buktitransfer/';
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

                $dataupdate['STATUS']="17";

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }

        }

        public function updateheader() {
            $datanopemesanan = $this->input->post('datanopemesanan');
            $status          = $this->input->post('status');
            $position        = $this->input->post('position');
            
            if($position==="VICE"){
                $data['STATUS_VICE'] = $status;
                $data['WADIR_ID']    = $_SESSION['userid'];
                $data['WADIR_DATE']  = date('Y-m-d H:i:s');
            }else{
                if($position==="DIR"){
                    $data['STATUS_DIR'] = $status;
                    $data['DIR_ID']     = $_SESSION['userid'];
                    $data['DIR_DATE']   = date('Y-m-d H:i:s');
                }else{
                    $data['STATUS'] = $status;
                }
            }
            

            if($status==="3" || $status==="4"){
                $data['MANAGER_ID']   = $_SESSION['userid'];
                $data['MANAGER_DATE'] = date('Y-m-d H:i:s');
            }

            if($status==="5" || $status==="6"){
                $data['KEU_ID']   = $_SESSION['userid'];
                $data['KEU_DATE'] = date('Y-m-d H:i:s');
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

        public function notelampiran(){
            $nopemesanan  = $this->input->post("no_pemesanan_upload");
            $notelampiran = $this->input->post("modal-upload-lampiran-note");

            
            $dataupdate['attachment_note'] = $notelampiran;

            if($this->md->updateheader($nopemesanan,$dataupdate)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data failed to update";
            }
            

            echo json_encode($json);
        }

        public function noinvoice(){
            $nopemesanan = $this->input->post("no_pemesanan_invoice");
            $noinvoice   = $this->input->post("modal_upload_invoice_no");

            $dataupdate['invoice_no'] = $noinvoice;

            if($this->md->updateheader($nopemesanan,$dataupdate)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data failed to update";
            }
            
            echo json_encode($json);
        }
        
    }
?>