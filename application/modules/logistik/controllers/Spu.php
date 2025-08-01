<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Spu extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelspu", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_spu",$data);
        }

        public function loadcombobox(){
            $parameter1        = "and   a.user_id='".$_SESSION['userid']."'";
            $parameter2        = "and   a.user_id='".$_SESSION['userid']."'";

            $resultmasterunit1 = $this->md->masterunit($_SESSION['orgid'],$parameter1);
            $resultmasterunit2 = $this->md->masterunit($_SESSION['orgid'],$parameter2);

            $department="";
            foreach($resultmasterunit1 as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $departmentto="";
            foreach($resultmasterunit2 as $a ){
                $departmentto.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['department']     = $department;
            $data['departmentto']     = $departmentto;
            
            return $data;
		}

        public function datarequest(){
            $status="
                        and   a.from_department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   A.status in ('0')
                    ";
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
            $status="
                        and   a.from_department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   a.status in ('91') ";
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
            $status="
                        and   a.from_department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   a.status in ('93','1') ";
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
            $nopemesanan = $this->input->post("nopemesanan");
            $departmentid = $this->input->post("departmentid");

            if($departmentid === "fbcefc36-f43e-4b7f-8731-fbe8453a08c2"){
                $parameter ="and a.jenis_id='b3a2e1a0-0001-4a00-9001-000000000001'";
            }else{
                $parameter ="and a.jenis_id<>'b3a2e1a0-0001-4a00-9001-000000000001'";
            }
            $result       = $this->md->masterbarang($_SESSION['orgid'],$nopemesanan,$parameter);
            
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

                $dataupdate = array('attachment' => "1");

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

                $dataupdate['invoice']="1";

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }
        }

        public function notelampiran(){            
            $dataupdate['attachment_note'] = $this->input->post("modal_upload_lampiran_note");

            if($this->md->updateheader($this->input->post("no_pemesanan_upload"),$dataupdate)){
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

        public function newrequest(){
            $parameter = "and type='20'";

            $data['org_id']             = $_SESSION['orgid'];
            $data['no_pemesanan']       = generateuuid();
            $data['no_spu']             = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_request_department"),$parameter)->nomor_pemesanan;
            $data['judul_pemesanan']    = $this->input->post("modal_new_request_nama");
            $data['note']               = $this->input->post("modal_new_request_note");
            $data['from_department_id'] = $this->input->post("modal_new_request_department");
            $data['department_id']      = $this->input->post("modal_new_request_department_to");
            $data['cito']               = $this->input->post("modal_new_request_cito");
            $data['created_by']         = $_SESSION['userid'];
            $data['type']               = "20";
            $data['status']             = "0";

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
            $type         = $this->input->post('type');
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

            if($type==="PO_INVOICE"){
                $data['qty_minta']   = $qty;
                $data['qty_manager'] = $qty;
                $data['kains_id']    = $_SESSION['userid'];
                $data['kains_date']  = date('Y-m-d H:i:s');
            }

            if($type==="SPU"){
                $data['qty_req']         = $qty;
                $data['qty_req_manager'] = $qty;
                $data['req_id']          = $_SESSION['userid'];
                $data['req_date']        = date('Y-m-d H:i:s');
            }
            
            $data['harga']           = $harga;
            $data['ppn']             = $ppn*100;
            $data['harga_ppn']       = $vat_amount;
            $data['total']           = $subtotal;
            $data['note']            = $note;
            $data['created_by']      = $_SESSION['userid'];

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

            if($validator==="REQMANAGER"){
                $data['qty_req_manager']  = $qty;
                $data['qty_minta']        = $qty;
                $data['req_manager_id']   = $_SESSION['userid'];
                $data['req_manager_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="KAINS"){
                $data['qty_minta']   = $qty;
                $data['qty_manager'] = $qty;
                $data['kains_id']    = $_SESSION['userid'];
                $data['kains_date']  = date('Y-m-d H:i:s');
            }

            if($validator==="MANAGER"){
                $data['qty_manager']  = $qty;
                $data['qty_keu']      = $qty;
                $data['manager_id']   = $_SESSION['userid'];
                $data['manager_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="FINANCE"){
                $data['qty_keu']   = $qty;
                $data['qty_wadir'] = $qty;
                $data['qty_dir']   = $qty;
                $data['qty_com']   = $qty;
                $data['keu_id']    = $_SESSION['userid'];
                $data['keu_date']  = date('Y-m-d H:i:s');
            }

            if($validator==="VICE"){
                $data['qty_wadir']  = $qty;
                $data['qty_dir']    = $qty;
                $data['qty_com']    = $qty;
                $data['wadir_id']   = $_SESSION['userid'];
                $data['wadir_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="DIR"){
                $data['qty_wadir'] = $qty;
                $data['qty_dir']   = $qty;
                $data['qty_com']   = $qty;
                $data['dir_id']    = $_SESSION['userid'];
                $data['dir_date']  = date('Y-m-d H:i:s');
            }

            if($validator==="COM"){
                $data['qty_wadir'] = $qty;
                $data['qty_dir']   = $qty;
                $data['qty_com']   = $qty;
                $data['com_id']    = $_SESSION['userid'];
                $data['com_date']  = date('Y-m-d H:i:s');
            }
            
            $data['stock']     = $stock;
            $data['harga']     = $harga;
            $data['ppn']       = $ppn*100;
            $data['harga_ppn'] = $vat_amount;
            $data['total']     = $subtotal;
            $data['note']      = $note;

            if($qty==="0"){
                $data['active'] = "0";
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

        public function updateheader(){
            $datanopemesanan  = $this->input->post('datanopemesanan');
            $status           = $this->input->post('status');
            $validator        = $this->input->post('validator');
            $transidpettycash = $this->input->post('data_transaksiid');
            $balance          = $this->input->post('data_balance');
            $departmentid     = $this->input->post('data_departmentid');
            $note             = $this->input->post('data_note');
            $rekeningid       = $this->input->post('modal_payment_rekening_id');
            
            if($validator==="REQ"){
                $data['status']       = $status;
                $data['request_id']   = $_SESSION['userid'];
                $data['request_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="REQMANAGER"){
                $data['status']               = $status;
                $data['request_manager_id']   = $_SESSION['userid'];
                $data['request_manager_date'] = date('Y-m-d H:i:s');
            }

            if($validator==="KAINS"){
                if($status==="0" || $status==="1" || $status==="2"){
                    $data['status']     = $status;
                    $data['kains_id']   = $_SESSION['userid'];
                    $data['kains_date'] = date('Y-m-d H:i:s');
                }
                if($status==="7" || $status==="13"){
                    $data['status']     = $status;
                    $data['inv_kains_id']   = $_SESSION['userid'];
                    $data['inv_kains_date'] = date('Y-m-d H:i:s');
                }
                
            }

            if($validator==="MANAGER"){

                if($status==="2" || $status==="3" || $status==="4"){
                    $data['status']       = $status;
                    $data['manager_id']   = $_SESSION['userid'];
                    $data['manager_date'] = date('Y-m-d H:i:s');
                }

                if($status==="7" || $status==="8" || $status==="9" || $status==="13"){
                    $data['status']           = $status;
                    $data['inv_manager_id']   = $_SESSION['userid'];
                    $data['inv_manager_Date'] = date('Y-m-d H:i:s');
                }
                
            }

            if($validator==="FINANCE"){

                if($status==="4" || $status==="5" || $status==="6"){
                    $data['status']   = $status;
                    $data['keu_id']   = $_SESSION['userid'];
                    $data['keu_date'] = date('Y-m-d H:i:s');
                }

                if($status==="13" || $status==="14" || $status==="15" || $status==="16"){
                    $data['status']       = $status;
                    $data['rekening_id']  = $rekeningid;
                    $data['inv_keu_id']   = $_SESSION['userid'];
                    $data['inv_keu_Date'] = date('Y-m-d H:i:s');

                    if($transidpettycash!=null){
                        $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'], $rekeningid);

                        if(empty($resultcheckbalancelast)){
                            $lastbalance = 0;
                        }else{
                            $lastbalance =$resultcheckbalancelast[0]->balance;
                        }

                        $dataupdatepettycash['no_pemesanan']="";

                        $this->md->updatepettycash($datanopemesanan,$dataupdatepettycash);
                        
                        $datapettycash['org_id']           = $_SESSION['orgid'];
                        $datapettycash['transaksi_id']     = generateuuid();
                        $datapettycash['no_kwitansi']      = $this->md->nokwitansi($_SESSION['orgid'])->nokwitansi;
                        $datapettycash['note']             = $note;
                        $datapettycash['department_id']    = $departmentid;
                        $datapettycash['cash_out']         = strval($balance);
                        $datapettycash['before_balance']   = $lastbalance;
                        $datapettycash['balance']          = strval($lastbalance)-strval($balance);
                        $datapettycash['ref_pettycash_id'] = $transidpettycash;
                        $datapettycash['status']           = "6";
                        $datapettycash['created_by']       = $_SESSION['userid'];

                        $this->md->insertpettycash($datapettycash);
                    }
                }
            }

            if($validator==="VICE"){
                if($status==="9" || $status==="10" || $status==="11"){
                    $data['status']        = $status;
                    $data['inv_vice_id']   = $_SESSION['userid'];
                    $data['inv_vice_Date'] = date('Y-m-d H:i:s');
                }
                if($status==="" || $status==="N" || $status==="Y"){
                    $data['status_vice'] = $status;
                    $data['wadir_id']    = $_SESSION['userid'];
                    $data['wadir_date']  = date('Y-m-d H:i:s');
                }
            }

            if($validator==="DIR"){
                if($status==="11" || $status==="12" || $status==="13"){
                    $data['status']       = $status;
                    $data['inv_dir_id']   = $_SESSION['userid'];
                    $data['inv_dir_Date'] = date('Y-m-d H:i:s');
                }
                if($status==="" || $status==="N" || $status==="Y"){
                    $data['status_dir'] = $status;
                    $data['dir_id']    = $_SESSION['userid'];
                    $data['dir_date']  = date('Y-m-d H:i:s');
                }
            }

            if($validator==="COM"){
                if($status==="11" || $status==="12" || $status==="13"){
                    $data['status']       = $status;
                    $data['inv_dir_id']   = $_SESSION['userid'];
                    $data['inv_dir_Date'] = date('Y-m-d H:i:s');
                }
                if($status==="" || $status==="N" || $status==="Y"){
                    $data['status_com'] = $status;
                    $data['com_id']    = $_SESSION['userid'];
                    $data['com_date']  = date('Y-m-d H:i:s');
                }
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