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
            $resultcekunitid      = $this->md->cekunitid($_SESSION['orgid'],$_SESSION['userid']);
            $resultpaymentmethod  = $this->md->paymentmethod();
            
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $department="";
            foreach($resultcekunitid as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $paymentmethod="";
            foreach($resultpaymentmethod as $a ){
                $paymentmethod.="<option value='".$a->id."'>".$a->metod."</option>";
            }

            $data['mastersupplier'] = $mastersupplier;
            $data['department']     = $department;
            $data['paymentmethod']  = $paymentmethod;
            
            return $data;
		}

        public function newrequest(){
            $parameter = "and type<>'20'";
            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = generateuuid();
            $data['no_pemesanan_unit'] = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_request_department"),$parameter)->nomor_pemesanan;
            $data['judul_pemesanan']   = $this->input->post("modal_new_request_nama");
            $data['note']              = $this->input->post("modal_new_request_note");
            $data['department_id']     = $this->input->post("modal_new_request_department");
            $data['supplier_id']       = $this->input->post("modal_new_request_supplier");
            $data['method']            = $this->input->post("modal_new_request_method");
            $data['cito']              = $this->input->post("modal_new_request_cito");
            $data['created_by']        = $_SESSION['userid'];

            if($this->md->insertheader($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function newinvoice(){
            $parameter = "and type<>'20'";
            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = generateuuid();
            $data['no_pemesanan_unit'] = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_invoice_department"),$parameter)->nomor_pemesanan;
            $data['judul_pemesanan']   = $this->input->post("modal_new_invoice_nama");
            $data['note']              = $this->input->post("modal_new_invoice_note");
            $data['department_id']     = $this->input->post("modal_new_invoice_department");
            $data['supplier_id']       = $this->input->post("modal_new_invoice_supplier");
            $data['method']            = $this->input->post("modal_new_invoice_method");
            $data['cito']              = $this->input->post("modal_new_invoice_cito");
            $data['type']              = "1";
            $data['status_vice']       = "Y";
            $data['status_dir']        = "Y";
            $data['created_by']        = $_SESSION['userid'];

            if($this->md->insertheader($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function datarequest(){
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('0','2','4')";
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

        public function decline(){
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('1','3','5','6','8') and (a.status='6' and a.status_vice='N') or (a.status='8' and (a.status_vice='Y' or a.status_dir='Y'))";
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

        public function approve(){
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('6','7','13')";
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
                    $datastock['department_id'] = $this->input->post('departmentid');
                    $datastock['barang_id']     = $barangid;
                    $datastock['qty']           = $stock;
                    $datastock['jenis_id']      = "1";
                    $datastock['created_by']    = $_SESSION['userid'];

                    $this->md->insertstock($datastock);

                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }else{
                if($this->md->updatebarangid($barangid,$no_pemesanan,$data)){
                    $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);
    
                    $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                    $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                    $dataheader['TOTAL']     = $resulthitungdetail->total;
    
                    $this->md->updateheader($no_pemesanan,$dataheader);

                    $updatedatastock['org_id']        = $_SESSION['orgid'];
                    $updatedatastock['department_id'] = $this->input->post('departmentid');
                    $updatedatastock['barang_id']     = $barangid;
                    $updatedatastock['qty']           = $stock;
                    $updatedatastock['jenis_id']      = "1";
                    $updatedatastock['created_by']    = $_SESSION['userid'];

                    if(!empty($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid))){
                        $this->md->updatestock($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid)->ITEM_ID,$updatedatastock);
                    }
                    
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
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

        public function updatedetailitem(){
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

                $dataupdate['status']="17";

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }

        }

        public function updateheader(){
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

        public function catatankeuangan(){
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
            $nopemesanan = $this->input->post("modal_upload_invoice_nopemesanan");
            $noinvoice   = $this->input->post("modal_upload_invoice_invoiceno");

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

        public function terimabarang(){
            $no_pemesanan = $this->input->post('no_pemesanan');
            $barangid     = $this->input->post('barangid');
            $qty          = $this->input->post('qty');
            $laststok     = 0;

            $resultceklaststok = $this->md->ceklaststok($_SESSION['orgid'],$barangid);

            if(!empty($resultceklaststok)){
                $laststok = $resultceklaststok->jml;
            }

            $data['org_id']        = $_SESSION['orgid'];
            $data['transaksi_id']  = generateuuid();
            $data['no_pemesanan']  = $no_pemesanan;
            $data['barang_id']     = $barangid;
            $data['masuk']         = $qty;
            $data['qty']           = $qty+$laststok;
            $data['department_id'] = "f2998547-2c01-4710-97fb-e2b37eb11f8e";
            $data['location_id']   = "f47399ac-bb19-4ee9-9e47-86dbae594dad";
            $data['jenis_id']      = "2";
            $data['created_by']    = $_SESSION['userid'];

            if($this->md->insertstock($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Berhasil Di Tambah";
            }

            echo json_encode($json);
        }
        
    }
?>