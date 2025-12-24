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

        public function datapemesanan(){
            $orgid  = "and a.org_id='".$_SESSION['orgid']."'";
            $status = "
                            and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                            and   a.status in ('0','1','2','3','4','5','6','18','19','20','21','22','23','24','25','26','27','28','29','30','31')
                        ";


            $orderby = "
                ORDER BY 
                CASE WHEN a.status = '0' THEN a.created_date END DESC,
                CASE WHEN a.status in ('1','2') THEN a.kains_date END DESC,
                CASE WHEN a.status = '31' THEN a.cmo_date END ASC
            ";

            $result = $this->md->datapemesanan($orgid,$status,$orderby);
            
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
        
        public function datapenerimaan(){
            $nopemesanan = $this->input->post("nopenerimaan");
            $result = $this->md->datapenerimaan($_SESSION['orgid'],$nopemesanan);
            
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

        public function detailpembelianitem(){
            $nopemesanan  = $this->input->post("nopemesanan");
            $nopenerimaan = $this->input->post("nopenerimaan");
            $result       = $this->md->detailpembelianitem($_SESSION['orgid'],$nopemesanan,$nopenerimaan);
            
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
            $datanopemesanan  = $this->input->post("datanopemesanan");
            $datadepartmentid = $this->input->post("datadepartmentid");
            $datanmethodid    = $this->input->post("datanmethodid");

            if($datanmethodid === "5"){
                $parameter ="and a.jenis_id='b3a2e1a0-0001-4a00-9001-000000000001'";
            }else{
                $parameter ="and a.jenis_id<>'b3a2e1a0-0001-4a00-9001-000000000001'";
            }

            $result = $this->md->masterbarang($datanopemesanan,$parameter);
            
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
            $nopemesanan     = generateuuid();
            $nopemesananunit = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_request_department"),"and hd.type<>'20'")->nomor_pemesanan;

            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = $nopemesanan;
            $data['no_pemesanan_unit'] = $nopemesananunit;
            $data['judul_pemesanan']   = $this->input->post("modal_new_request_nama");
            $data['note']              = $this->input->post("modal_new_request_note");
            $data['department_id']     = $this->input->post("modal_new_request_department");
            $data['supplier_id']       = $this->input->post("modal_new_request_supplier");
            $data['method']            = $this->input->post("modal_new_request_method");
            $data['cito']              = $this->input->post("modal_new_request_cito");
            $data['version']           = "2.0.0.0";
            $data['created_by']        = $_SESSION['userid'];

            if($this->md->insertheader($data)){
                $chattext="No Pemesanan : ".$nopemesananunit.", Tanggal : ".date("d.m.Y").", Pengadaan : ".$this->input->post("modal_new_request_nama").", Catatan : ".$this->input->post("modal_new_request_note");

                $datachat['org_id']     = $_SESSION['orgid'];
                $datachat['chat_id']    = generateuuid();
                $datachat['ref_id']     = $nopemesanan;
                $datachat['chat']       = $chattext;
                $datachat['created_by'] = $_SESSION['userid'];

                $this->md->insertchat($datachat);

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

        public function newsuratjalan(){
            $transaksiid  = generateuuid();
            $nopenerimaan = $this->md->nopenerimaan($_SESSION['orgid'],$this->input->post("no_pemesanan_penerimaan"),$this->input->post("no_pemesanan_department"))->nomor_pemesanan;

            $data['org_id']             = $_SESSION['orgid'];
            $data['transaksi_id']       = $transaksiid;
            $data['no_penerimaan_unit'] = $nopenerimaan;
            $data['no_pemesanan']       = $this->input->post("no_pemesanan_penerimaan");
            $data['department_id']      = $this->input->post("no_pemesanan_department");
            $data['surat_jalan']        = $this->input->post("modal_add_penerimaan_barang_nosurat");
            $data['note']               = $this->input->post("modal_add_penerimaan_barang_note");
            $data['created_by']         = $_SESSION['userid'];

            if($this->md->insertsuratjalan($data)){
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

        public function updateheader(){
            $datanopemesanan     = $this->input->post('datanopemesanan');
            $datanopemesananunit = $this->input->post('datanopemesananunit');
            $datastatus          = $this->input->post('datastatus');
            $datavalidator       = $this->input->post('datavalidator');
            
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

            if($datavalidator==="CPO"){
                $data['status']   = $datastatus;
                $data['cpo_id']   = $_SESSION['userid'];
                $data['cpo_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CMD"){
                $data['status']   = $datastatus;
                $data['cmd_id']   = $_SESSION['userid'];
                $data['cmd_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CTO"){
                $data['status']   = $datastatus;
                $data['cto_id']   = $_SESSION['userid'];
                $data['cto_date'] = date('Y-m-d H:i:s');
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

            if($datavalidator==="KOORDINATOR_INV"){
                $data['status']           = $datastatus;
                $data['inv_koordinator_id']   = $_SESSION['userid'];
                $data['inv_koordinator_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="MANAGER_INV"){
                $data['status']     = $datastatus;
                $data['inv_manager_id']   = $_SESSION['userid'];
                $data['inv_manager_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="VICE_INV"){
                $data['status']     = $datastatus;
                $data['inv_vice_id']   = $_SESSION['userid'];
                $data['inv_vice_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="DIR_INV"){
                $data['status']       = $datastatus;
                $data['inv_dir_id']   = $_SESSION['userid'];
                $data['inv_dir_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CFO_INV"){
                $data['status']       = $datastatus;
                $data['inv_cfo_id']   = $_SESSION['userid'];
                $data['inv_cfo_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="CMO_INV"){
                $data['status']       = $datastatus;
                $data['inv_cmo_id']   = $_SESSION['userid'];
                $data['inv_cmo_date'] = date('Y-m-d H:i:s');
            }

            if($datavalidator==="FINANCE_INV"){
                $data['status']       = $datastatus;
                $data['inv_keu_id']   = $_SESSION['userid'];
                $data['inv_keu_date'] = date('Y-m-d H:i:s');
            }

            if($this->md->updateheader($datanopemesanan,$data)){

                $resultmasterstatus = $this->md->masterstatus($datastatus);

                $chattext = "No Pemesanan : ".$datanopemesananunit.", <span class='badge badge-light-".$resultmasterstatus->color."'>".$resultmasterstatus->master_name."</span>";

                $datachat['org_id']     = $_SESSION['orgid'];
                $datachat['chat_id']    = generateuuid();
                $datachat['ref_id']     = $datanopemesanan;
                $datachat['chat']       = $chattext;
                $datachat['created_by'] = $_SESSION['userid'];

                $this->md->insertchat($datachat);

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
            $data['qty_com']         = 0;
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

        public function penerimaanadditem(){
            $transaksiid  = generateuuid();
            $nopenerimaan = $this->input->post('nopenerimaan');
            $nopemesanan  = $this->input->post('nopemesanan');
            $barangid     = $this->input->post('barangid');
            $qty          = $this->input->post('qty');
            $harga        = $this->input->post('harga');
            $ppn          = $this->input->post('ppn');
            $subtotal     = $this->input->post('subtotal');
            $vat_amount   = $this->input->post('vat_amount');
            $noBatch      = $this->input->post('noBatch');
            
            $data['transaksi_id']  = $transaksiid;
            $data['org_id']        = $_SESSION['orgid'];
            $data['no_penerimaan'] = $nopenerimaan;
            $data['no_pemesanan']  = $nopemesanan;
            $data['barang_id']     = $barangid;
            $data['qty']           = $qty;
            $data['harga']         = $harga;
            $data['ppn']           = $ppn*100;
            $data['harga_ppn']     = $vat_amount;
            $data['total']         = $subtotal;
            $data['no_batch']      = $noBatch;
            $data['barang_id_ext'] = $this->md->barangidext($barangid);
            $data['created_by']    = $_SESSION['userid'];

            if($this->md->insertitempenerimaan($data)){
                $resulthitungdetail = $this->md->hitungdetailpenerimaan($_SESSION['orgid'],$nopenerimaan,$nopemesanan);

                $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                $dataheader['TOTAL']     = $resulthitungdetail->total;

                $this->md->updateheaderpenerimaan($nopemesanan,$nopenerimaan,$dataheader);

                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            // if(empty($this->md->cekitemidpenerimaan($_SESSION['orgid'],$nopenerimaan,$nopemesanan,$barangid))){
            //     $data['transaksi_id']      = $transaksiid;
            //     if($this->md->insertitempenerimaan($data)){
            //         $resulthitungdetail = $this->md->hitungdetailpenerimaan($_SESSION['orgid'],$nopenerimaan,$nopemesanan);
    
            //         $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
            //         $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
            //         $dataheader['TOTAL']     = $resulthitungdetail->total;
    
            //         $this->md->updateheaderpenerimaan($nopemesanan,$nopenerimaan,$dataheader);

            //         $json['responCode']="00";
            //         $json['responHead']="success";
            //         $json['responDesc']="Data Added Successfully";
            //     } else {
            //         $json['responCode']="01";
            //         $json['responHead']="info";
            //         $json['responDesc']="Data Failed to Add";
            //     }
            // }else{
            //     if($this->md->updateitempenerimaan($barangid,$nopenerimaan,$nopemesanan,$data)){
            //         $resulthitungdetail = $this->md->hitungdetailpenerimaan($_SESSION['orgid'],$nopenerimaan,$nopemesanan);
    
            //         $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
            //         $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
            //         $dataheader['TOTAL']     = $resulthitungdetail->total;
    
            //         $this->md->updateheaderpenerimaan($nopemesanan,$nopenerimaan,$dataheader);
                    
            //         $json['responCode']="00";
            //         $json['responHead']="success";
            //         $json['responDesc']="Data Added Successfully";
            //     }else{
            //         $json['responCode']="01";
            //         $json['responHead']="info";
            //         $json['responDesc']="Data Failed to Add";
            //     }
            // }

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
                $data['qty_com']         = 0;
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
                $data['qty_com']         = 0;
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
                $data['qty_com']         = 0;
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
                $data['qty_com']         = 0;
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
                $data['qty_com']         = 0;
                $data['pt_qty_atem']     = $qty;
                $data['pt_qty_farmasi']  = $qty;
                $data['pt_qty_it']       = $qty;
                $data['pt_qty_cfo']      = $qty;
                $data['pt_qty_cmo']      = $qty;
                $data['dir_id']         = $_SESSION['userid'];
                $data['dir_date']       = date('Y-m-d H:i:s');
            }

            if($validator==="CPO"){
                $data['pt_qty_atem']    = 0;
                $data['pt_qty_farmasi'] = $qty;
                $data['pt_qty_it']      = 0;
                $data['pt_qty_cfo']     = $qty;
                $data['pt_qty_cmo']     = $qty;
                $data['cpo_id']         = $_SESSION['userid'];
                $data['cpo_date']       = date('Y-m-d H:i:s');
            }

            if($validator==="CMD"){
                $data['pt_qty_atem']    = $qty;
                $data['pt_qty_farmasi'] = 0;
                $data['pt_qty_it']      = 0;
                $data['pt_qty_cfo']     = $qty;
                $data['pt_qty_cmo']     = $qty;
                $data['cmd_id']         = $_SESSION['userid'];
                $data['cmd_date']       = date('Y-m-d H:i:s');
            }

            if($validator==="CTO"){
                $data['pt_qty_atem']    = 0;
                $data['pt_qty_farmasi'] = 0;
                $data['pt_qty_it']      = $qty;
                $data['pt_qty_cfo']     = $qty;
                $data['pt_qty_cmo']     = $qty;
                $data['cto_id']         = $_SESSION['userid'];
                $data['cto_date']       = date('Y-m-d H:i:s');
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

        public function uploadbuktibayar(){
            $datanopemesanan= $_GET['datanopemesanan'];

            $config['upload_path']   = './assets/buktitransfer/';
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
                $dataupdate['status']="17";
                $this->md->updateheader($datanopemesanan,$dataupdate);

                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Upload Success";
            }

            echo json_encode($json);
        }

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
                    $chattext = "Silakan Klik Link <a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='".$noinvoice."' data-dirfile='" . $this->config->base_url() . "assets/invoice/" .$noinvoice. ".pdf' onclick='viewdocwithnote(this)'>Invoice</a> untuk melihat lampiran invoice, No Invoice : " .$noinvoice;

                    $datachat['org_id']     = $_SESSION['orgid'];
                    $datachat['chat_id']    = generateuuid();
                    $datachat['ref_id']     = $nopemesanan;
                    $datachat['chat']       = $chattext;
                    $datachat['created_by'] = $_SESSION['userid'];

                    $this->md->insertchat($datachat);

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
                        $chattext = "Silakan Klik Link <a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='".$noinvoice."' data-dirfile='" . $this->config->base_url() . "assets/invoice/" .$noinvoice. ".pdf' onclick='viewdocwithnote(this)'>Invoice</a> untuk melihat lampiran invoice, No Invoice : " .$noinvoice;

                        $datachat['org_id']     = $_SESSION['orgid'];
                        $datachat['chat_id']    = generateuuid();
                        $datachat['ref_id']     = $nopemesanan;
                        $datachat['chat']       = $chattext;
                        $datachat['created_by'] = $_SESSION['userid'];

                        $this->md->insertchat($datachat);

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

        public function uploadlampiran(){ 
            $nopemesanan = $this->input->post("modal_upload_lampiran_nopemesanan");

            $json = [
                'responCode' => "01",
                'responHead' => "info",
                'responDesc' => "Unknown error"
            ];

            $config['upload_path']   = './assets/documentpo/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $nopemesanan;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('modal_upload_doc_file')) {
                $error_message = strip_tags($this->upload->display_errors());
                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            } else {
                $dataupdate['attachment']      = "1";
                $dataupdate['attachment_note'] = $this->input->post("modal_upload_lampiran_note");
                $dataupdate['attachment_date'] = date('Y-m-d H:i:s');

                if($this->md->updateheader($nopemesanan,$dataupdate)){
                    $chattext = "Silakan Klik Link <a href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf_note' data_attachment_note='".$this->input->post("modal_upload_lampiran_note")."' data-dirfile='" . $this->config->base_url() . "assets/documentpo/" .$nopemesanan. ".pdf' onclick='viewdocwithnote(this)'>Dokumen Pendukung</a> untuk melihat data pendukung pengadaan, Catatan : " . ($this->input->post("modal_upload_lampiran_note") ?? '');

                    $datachat['org_id']     = $_SESSION['orgid'];
                    $datachat['chat_id']    = generateuuid();
                    $datachat['ref_id']     = $nopemesanan;
                    $datachat['chat']       = $chattext;
                    $datachat['created_by'] = $_SESSION['userid'];

                    $this->md->insertchat($datachat);

                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Updated Successfully";
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data failed to update";
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

        public function hapusdata(){
            $data['active']           = "0";

            if($this->md->updatepenerimaan($this->input->post("datatransid"),$data)){
                $resulthitungdetail = $this->md->hitungdetailpenerimaan($_SESSION['orgid'],$this->input->post("nopenerimaan"),$this->input->post("nopemesanan"));
    
                $dataheader['SUBTOTAL']  = $resulthitungdetail->harga;
                $dataheader['HARGA_PPN'] = $resulthitungdetail->harga_ppn;
                $dataheader['TOTAL']     = $resulthitungdetail->total;

                $this->md->updateheaderpenerimaan($this->input->post("nopemesanan"),$this->input->post("nopenerimaan"),$dataheader);

                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

        
    }
?>