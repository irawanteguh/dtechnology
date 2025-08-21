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
            $parameter1        = "and   a.user_id='".$_SESSION['userid']."'";

            $resultmastersupplier = $this->md->mastersupplier($_SESSION['orgid']);
            $resultmasterunit1    = $this->md->masterunit($_SESSION['orgid'],$parameter1);
            $resultpaymentmethod  = $this->md->paymentmethod();
            
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $department="";
            foreach($resultmasterunit1 as $a ){
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

        public function newpurchaseorder(){
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

            if($this->input->post("modal_new_request_method")==="4"){
                $data['status_vice']       = "Y";
                $data['status_dir']        = "Y";

                $data['wadir_date'] = date('Y-m-d H:i:s');
                $data['dir_date']   = date('Y-m-d H:i:s');
            }
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
            $data['wadir_date']        = date('Y-m-d H:i:s');
            $data['dir_date']          = date('Y-m-d H:i:s');
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

        public function masterbarang(){
            $datanopemesanan = $this->input->post("datanopemesanan");
            $datadepartmentid = $this->input->post("datadepartmentid");

            if($datadepartmentid === "fbcefc36-f43e-4b7f-8731-fbe8453a08c2"){
                $parameter ="and a.jenis_id='b3a2e1a0-0001-4a00-9001-000000000001'";
            }else{
                $parameter ="and a.jenis_id<>'b3a2e1a0-0001-4a00-9001-000000000001'";
            }
            $result       = $this->md->masterbarang($_SESSION['orgid'],$datanopemesanan,$parameter);
            
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

        public function dataonprocess(){
            $status="   and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   a.status in ('0','92')
                    ";
            $orderby ="order by created_date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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

        public function dataapprove(){
            $status="   and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   a.status in ('2','4','6')
                        and (
                                (
                                    a.status<>'6'
                                    and (a.status_vice is null or a.status_dir is null)
                                )   and (a.status_vice is null or a.status_dir is null)
                                or
                                (
                                    a.status='6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
                                )
                                or
                                (
                                    a.status='6'
                                    and (a.status_vice='Y' or a.status_dir='Y')
                                )
                            )
                    ";
            $orderby ="order by created_date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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

        public function datadecline(){
            $status="   and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                        and   a.status in ('1','3','5','6')
                    ";
            $orderby ="order by kains_Date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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
            $datanopemesanan= $_GET['datanopemesanan'];

            $config['upload_path']   = './assets/documentpo/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $datanopemesanan;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();

                $dataupdate = array('attachment' => "1");

                $this->md->updateheader($datanopemesanan,$dataupdate);

                echo "Upload Success";
            }
        }

        public function uploadinvoice(){
            $datanopemesanan= $_GET['datanopemesanan'];

            $config['upload_path']   = './assets/invoice/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $datanopemesanan;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();

                $dataupdate = array(
                                    'invoice' => "1"
                                );

                $this->md->updateheader($datanopemesanan,$dataupdate);

                echo "Upload Success";
            }
        }

        public function notelampiran(){            
            $dataupdate['attachment_note'] = $this->input->post("modal_upload_lampiran_note");

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

        public function noinvoice(){
            $nopemesanan = $this->input->post("modal_upload_invoice_nopemesanan");
            $noinvoice   = $this->input->post("modal_upload_invoice_invoiceno");

            $dataupdate['invoice_no']     = $noinvoice;
            $dataupdate['status']         = "7";
            $dataupdate['inv_kains_id']   = $_SESSION['userid'];
            $dataupdate['inv_kains_date'] = date('Y-m-d H:i:s');

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

        public function updateheader(){
            $datanopemesanan = $this->input->post('datanopemesanan');
            $datastatus      = $this->input->post('datastatus');
            $datavalidator   = $this->input->post('datavalidator');
            
            if($datavalidator==="KAINS"){
                $data['status']     = $datastatus;
                $data['kains_id']   = $_SESSION['userid'];
                $data['kains_date'] = date('Y-m-d H:i:s');
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
            $data['qty_manager']  = $qty;
            $data['kains_id']     = $_SESSION['userid'];
            $data['kains_date']   = date('Y-m-d H:i:s');
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
    }
?>