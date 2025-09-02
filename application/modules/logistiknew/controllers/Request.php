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
            $this->template->load("template/template-sidebar","v_request",$data);
        }

        public function loadcombobox(){
            $resultmastersupplier = $this->md->mastersupplier();
            $resultmethod         = $this->md->method();
            $resultmasterunit     = $this->md->masterunit($_SESSION['orgid'],$_SESSION['userid']);
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $jenispengadaan="";
            foreach($resultmethod as $a ){
                $jenispengadaan.="<option value='".$a->code."'>".$a->master_name."</option>";
            }

            $department="";
            foreach($resultmasterunit as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['mastersupplier'] = $mastersupplier;
            $data['jenispengadaan'] = $jenispengadaan;
            $data['department']     = $department;

            return $data;
		}

        public function masterbarang(){
            $datanopemesanan  = $this->input->post("datanopemesanan");
            $datadepartmentid = $this->input->post("datadepartmentid");

            if($datadepartmentid === "fbcefc36-f43e-4b7f-8731-fbe8453a08c2"){
                $parameter ="and a.jenis_id='b3a2e1a0-0001-4a00-9001-000000000001'";
            }else{
                $parameter ="and a.jenis_id<>'b3a2e1a0-0001-4a00-9001-000000000001'";
            }

            $result = $this->md->masterbarang($_SESSION['orgid'],$datanopemesanan,$parameter);
            
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

        public function datapemesanan(){
            $status  = "
                            and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                            and   a.status in ('0','1','2','3','4','5','6','18','19','20','21','28','29','30','31')
                        ";
            $orderby = "order by created_date desc;";

            $result = $this->md->datapemesanan($_SESSION['orgid'],$status,$orderby);
            
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

        public function newpurchaseorder(){            
            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = generateuuid();
            $data['no_pemesanan_unit'] = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_request_department"),"and hd.type<>'20'")->nomor_pemesanan;
            $data['judul_pemesanan']   = $this->input->post("modal_new_request_nama");
            $data['note']              = $this->input->post("modal_new_request_note");
            $data['department_id']     = $this->input->post("modal_new_request_department");
            $data['supplier_id']       = $this->input->post("modal_new_request_supplier");
            $data['method']            = $this->input->post("modal_new_request_method");
            $data['cito']              = $this->input->post("modal_new_request_cito");
            $data['version']           = "2.0.0.0";
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

            $data['org_id']          = $_SESSION['orgid'];
            $data['no_pemesanan']    = $no_pemesanan;
            $data['barang_id']       = $barangid;
            $data['stock']           = $stock;
            $data['qty_minta']       = $qty;
            $data['qty_koordinator'] = $qty;
            $data['qty_manager']     = $qty;
            $data['qty_keu']         = $qty;
            $data['qty_dir']         = $qty;
            $data['qty_com']         = $qty;
            $data['pt_qty_atem']     = $qty;
            $data['pt_qty_farmasi']  = $qty;
            $data['pt_qty_it']       = $qty;
            $data['pt_qty_cfo']      = $qty;
            $data['pt_qty_cmo']      = $qty;
            $data['kains_id']        = $_SESSION['userid'];
            $data['kains_date']      = date('Y-m-d H:i:s');
            $data['harga']           = $harga;
            $data['ppn']             = $ppn*100;
            $data['harga_ppn']       = $vat_amount;
            $data['total']           = $subtotal;
            $data['note']            = $note;
            $data['created_by']      = $_SESSION['userid'];
            if($qty==="0"){
                $data['active']   = "0";
            }else{
                $data['active']   = "1";
            }

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
                if($this->md->updateitem($barangid,$no_pemesanan,$data)){
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
                        $this->md->updatestock($this->md->cekitemid($_SESSION['orgid'],$no_pemesanan,$barangid)->item_id,$updatedatastock);
                    }
                    
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }

            echo json_encode($json);
        }

        public function updatedetailitem(){
            $no_pemesanan     = $this->input->post('no_pemesanan');
            $validator        = $this->input->post('validator');
            $item_id          = $this->input->post('item_id');
            $qty              = $this->input->post('qty');
            $stock            = $this->input->post('stock');
            $harga            = $this->input->post('harga');
            $ppn              = $this->input->post('ppn');
            $subtotal         = $this->input->post('subtotal');
            $vat_amount       = $this->input->post('vat_amount');
            $note             = $this->input->post('note');

            if($validator==="KAINS"){
                $data['qty_minta']       = $qty;
                $data['qty_koordinator'] = $qty;
                $data['qty_manager']     = $qty;
                $data['qty_keu']         = $qty;
                $data['qty_dir']         = $qty;
                $data['qty_com']         = $qty;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['kains_id']        = $_SESSION['userid'];
                $data['kains_date']      = date('Y-m-d H:i:s');
            }

            if($validator==="KOORDINATOR"){
                $data['qty_koordinator'] = $qty;
                $data['qty_manager']     = $qty;
                $data['qty_keu']         = $qty;
                $data['qty_dir']         = $qty;
                $data['qty_com']         = $qty;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['koordinator_id']   = $_SESSION['userid'];
                $data['koordinator_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="MANAGER"){
                $data['qty_manager']     = $qty;
                $data['qty_keu']         = $qty;
                $data['qty_dir']         = $qty;
                $data['qty_com']         = $qty;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['manager_id']   = $_SESSION['userid'];
                $data['manager_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="FINANCE"){
                $data['qty_keu']         = $qty;
                $data['qty_dir']         = $qty;
                $data['qty_com']         = $qty;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['keu_id']         = $_SESSION['userid'];
                $data['keu_date']       = date('Y-m-d H:i:s');
            }

            if($validator==="DIRECTOR"){
                $data['qty_dir']         = $qty;
                $data['qty_com']         = $qty;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['dir_id']         = $_SESSION['userid'];
                $data['dir_date']       = date('Y-m-d H:i:s');
            }

            if($validator==="CFO"){
                $data['pt_qty_cfo'] = $qty;
                $data['pt_qty_cmo'] = $qty;
                $data['cfo_id']     = $_SESSION['userid'];
                $data['cfo_date']   = date('Y-m-d H:i:s');
            }

            if($validator==="CMO"){
                $data['pt_qty_cmo'] = $qty;
                $data['cmo_id']     = $_SESSION['userid'];
                $data['cmo_date']   = date('Y-m-d H:i:s');
            }
            
            $data['stock']     = $stock;
            $data['harga']     = $harga;
            $data['ppn']       = $ppn*100;
            $data['harga_ppn'] = $vat_amount;
            $data['total']     = $subtotal;
            $data['note']      = $note;

            if($qty==="0"){
                $data['active'] = "0";
            }else{
                $data['active'] = "1";
            }

            if($this->md->updatedetailitem($item_id,$data)){
                $resulthitungdetail = $this->md->hitungdetail($_SESSION['orgid'],$no_pemesanan);

                $dataheader['subtotal']  = $resulthitungdetail->harga;
                $dataheader['harga_ppn'] = $resulthitungdetail->harga_ppn;
                $dataheader['total']     = $resulthitungdetail->total;
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
            $datanopemesanan= $_GET['datanopemesanan'];

            $config['upload_path']   = './assets/documentpo/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $datanopemesanan;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error_message = strip_tags($this->upload->display_errors());

                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            }else{

                $dataupdate['attachment']      = "1";
                $dataupdate['attachment_date'] = date('Y-m-d H:i:s');
                $this->md->updateheader($datanopemesanan,$dataupdate);
                echo "Upload Success";
            }
        }

        public function updateheader(){
            $datanopemesanan = $this->input->post('datanopemesanan');
            $datastatus      = $this->input->post('datastatus');
            $datavalidator   = $this->input->post('datavalidator');
            
            if($datavalidator==="KAINS"){
                $data['status']     = $datastatus;
                $data['kains_id']   = $_SESSION['userid'];
                $data['kains_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="MANAGER"){
                $data['status']     = $datastatus;
                $data['manager_id']   = $_SESSION['userid'];
                $data['manager_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="KOORDINATOR"){
                $data['status']           = $datastatus;
                $data['koordinator_id']   = $_SESSION['userid'];
                $data['koordinator_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="FINANCE"){
                $data['status']   = $datastatus;
                $data['keu_id']   = $_SESSION['userid'];
                $data['keu_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="DIRECTOR"){
                $data['status']   = $datastatus;
                $data['dir_id']   = $_SESSION['userid'];
                $data['dir_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CFO"){
                $data['status']   = $datastatus;
                $data['cfo_id']   = $_SESSION['userid'];
                $data['cfo_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CMO"){
                $data['status']   = $datastatus;
                $data['cmo_id']   = $_SESSION['userid'];
                $data['cmo_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="KAINS_INV"){
                $data['status']         = $datastatus;
                $data['inv_kains_id']   = $_SESSION['userid'];
                $data['inv_kains_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="MANAGER_INV"){
                $data['status']     = $datastatus;
                $data['inv_manager_id']   = $_SESSION['userid'];
                $data['inv_manager_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="FINANCE_INV"){
                $data['status']       = $datastatus;
                $data['inv_keu_id']   = $_SESSION['userid'];
                $data['inv_keu_date'] = date('Y-m-d H:i:s');
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
            $dataupdate['attachment_note'] = $this->input->post("modal_upload_lampiran_note");
            $dataupdate['attachment_date'] = date('Y-m-d H:i:s');

            if($this->md->updateheader($this->input->post("modal_upload_lampiran_nopemesanan"),$dataupdate)){
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
            $nopemesanan  = $this->input->post("modal_note_finance_nopemesanan");
            $notelampiran = $this->input->post("modal_note_finance_catatan");
 
            $dataupdate['inv_keu_note'] = $notelampiran;
            $dataupdate['status']       = "15";
            $dataupdate['inv_keu_id']   = $_SESSION['userid'];
            $dataupdate['inv_keu_Date'] = date('Y-m-d H:i:s');

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

        public function payment(){
            $nopemesanan  = $this->input->post("modal_finance_payment_nopemesanan");
            $rekeningid   = $this->input->post("modal_finance_payment_rekeningid");
            $nominal      = $this->input->post("modal_finance_payment_nominal");
            $departmentid = $this->input->post("modal_finance_payment_departmentid");
            $catatan      = $this->input->post("modal_finance_payment_note");
 
            $dataupdate['rekening_id']    = $rekeningid;
            $dataupdate['total_transfer'] = (int) preg_replace('/\D/', '', $nominal);
            $dataupdate['status']         = "16";
            $dataupdate['payment_id']     = $_SESSION['userid'];
            $dataupdate['payment_date']   = date('Y-m-d H:i:s');

            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'],$rekeningid);
            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $datarekening['org_id']         = $_SESSION['orgid'];
            $datarekening['transaksi_id']   = generateuuid();
            $datarekening['rekening_id']    = $rekeningid;
            $datarekening['department_id']  = $departmentid;
            $datarekening['note']           = $catatan;
            $datarekening['no_pemesanan']   = $nopemesanan;
            $datarekening['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'],$rekeningid)->nokwitansi;
            $datarekening['cash_out']       = (int) preg_replace('/\D/', '', $nominal);
            $datarekening['before_balance'] = $lastbalance;
            $datarekening['balance']        = strval($lastbalance)-(int) preg_replace('/\D/', '', $nominal);
            $datarekening['status']         = "6";
            $datarekening['accept_id']      = $_SESSION['userid'];
            $datarekening['accept_date']    = date('Y-m-d H:i:s');
            $datarekening['created_by']     = $_SESSION['userid'];

            $this->md->insertrekening($datarekening);
            
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

        // public function uploadinvoice(){
        //     $nopemesanan = $this->input->post("modal_upload_invoice_nopemesanan");
        //     $noinvoice   = $this->input->post("modal_upload_invoice_invoiceno");

        //     $config['upload_path']   = './assets/invoice/';
        //     $config['allowed_types'] = 'pdf';
        //     $config['file_name']     = $nopemesanan;
        //     $config['overwrite']     = TRUE;

        //     $this->load->library('upload', $config);

        //     if (!$this->upload->do_upload('modal_upload_invoice_file')) {
        //         $error_message = strip_tags($this->upload->display_errors());

        //         log_message('error', 'File upload error: ' . $error_message);

        //         $json['responCode'] = "01";
        //         $json['responHead'] = "info";
        //         $json['responDesc'] = $error_message;
        //     } else {
        //         $dataupdate['invoice']      = "1";
        //         $dataupdate['invoice_no']   = $noinvoice;
        //         $dataupdate['invoice_date'] = date('Y-m-d H:i:s');

        //         if($this->md->updateheader($nopemesanan,$dataupdate)){
        //             $json['responCode']="00";
        //             $json['responHead']="success";
        //             $json['responDesc']="Data Added Successfully";
        //         } else {
        //             $json['responCode']="01";
        //             $json['responHead']="info";
        //             $json['responDesc']="Data Failed to Add";
        //         }
        //     }

        //     echo json_encode($json);
        // }

        public function uploadinvoice(){
            $nopemesanan = $this->input->post("modal_upload_invoice_nopemesanan");
            $noinvoice   = $this->input->post("modal_upload_invoice_invoiceno");

            // default respon gagal
            $json = [
                'responCode' => "01",
                'responHead' => "info",
                'responDesc' => "Unknown error"
            ];

            // Cek apakah berjalan di localhost
            $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']);

            if ($is_localhost) {
                // skip upload file
                $dataupdate['invoice']      = "1";
                $dataupdate['invoice_no']   = $noinvoice;
                $dataupdate['invoice_date'] = date('Y-m-d H:i:s');

                if($this->md->updateheader($nopemesanan,$dataupdate)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully (skip upload)";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            } else {
                // normal upload kalau bukan localhost
                $config['upload_path']   = './assets/invoice/';
                $config['allowed_types'] = 'pdf';
                $config['file_name']     = $nopemesanan;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('modal_upload_invoice_file')) {
                    $error_message = strip_tags($this->upload->display_errors());
                    log_message('error', 'File upload error: ' . $error_message);

                    $json['responCode'] = "01";
                    $json['responHead'] = "info";
                    $json['responDesc'] = $error_message;
                } else {
                    $dataupdate['invoice']      = "1";
                    $dataupdate['invoice_no']   = $noinvoice;
                    $dataupdate['invoice_date'] = date('Y-m-d H:i:s');

                    if($this->md->updateheader($nopemesanan,$dataupdate)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    } else {
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Add";
                    }
                }
            }

            echo json_encode($json);
        }


        public function detailbarangspu(){
            $nopemesanan = $this->input->post("nopemesanan");
            $result      = $this->md->detailbarangspu($_SESSION['orgid'],$nopemesanan);
            
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

        public function chat(){
            $refid = $this->input->post("refid");
            $result = $this->md->chat($_SESSION['userid'],$refid);
            
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

        public function sendchat() {
            $chatText = $this->input->post('chat');
            $refid    = $this->input->post('refid');
            $status   = $this->input->post('status');

            $data['org_id']     = $_SESSION['orgid'];
            $data['chat_id']    = generateuuid();
            $data['ref_id']     = $refid;
            $data['chat']       = $chatText;
            $data['created_by'] = $_SESSION['userid'];

            if($this->md->insertchat($data)){
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

        
    }
?>