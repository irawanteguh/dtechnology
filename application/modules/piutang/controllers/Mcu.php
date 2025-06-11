<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Mcu extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmcu", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_mcu",$data);
        }

        public function loadcombobox(){
            $resultmasterunit = $this->md->masterunit($_SESSION['orgid'],"");
            $resultprovider   = $this->md->provider($_SESSION['orgid']);
            $resultrekening   = $this->md->rekening($_SESSION['orgid']);
            $resultperiode    = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periodeid."'>".$a->keterangan."</option>";
            }

            $department="";
            foreach($resultmasterunit as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $provider="";
            foreach($resultprovider as $a ){
                $provider.="<option value='".$a->provider_id."'>".$a->provider."</option>";
            }

            $rekening="";
            foreach($resultrekening as $a ){
                $rekening.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $data['periode']    = $periode;
            $data['provider']   = $provider;
            $data['rekening']   = $rekening;
            $data['department'] = $department;

            return $data;
		}

        public function datapiutang(){
            $result = $this->md->datapiutang($_SESSION['orgid']);
            
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

        public function historypembayaran(){
            $result = $this->md->historypembayaran($_SESSION['orgid'],"2025");
            
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

        public function newinvoicemcu(){
            $notagihan = $this->input->post("modal_mcu_invoice_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_note");
            $date      = $this->input->post("modal_mcu_invoice_date");
            $provider  = $this->input->post("modal_mcu_invoice_provider");
            $nominal   = $this->input->post("modal_mcu_invoice_tagihan");
            $periodeid = $this->input->post("modal_mcu_invoice_periodeid");

            $data['org_id']           = $_SESSION['orgid'];
            $data['piutang_id']       = generateuuid();
            $data['no_tagihan']       = $notagihan;
            $data['rekanan_id']       = $provider;
            $data['note']             = $note;
            $data['date']             = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['jenis_id']         = "2";
            $data['periode']          = $periodeid;
            $data['nilai']            = (int) preg_replace('/\D/', '', $nominal);
            $data['created_by']       = $_SESSION['userid'];
            $data['last_update_by']   = $_SESSION['userid'];
            $data['created_date']     = date('Y-m-d H:i:s');
            $data['last_update_date'] = date('Y-m-d H:i:s');

            if($this->md->insertpiutang($data)){
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

        public function editinvoicemcu(){
            $piutangid = $this->input->post("modal_mcu_invoice_edit_piutangid");
            $notagihan = $this->input->post("modal_mcu_invoice_edit_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_edit_note");
            $date      = $this->input->post("modal_mcu_invoice_edit_date");
            $provider  = $this->input->post("modal_mcu_invoice_edit_provider");
            $nominal   = $this->input->post("modal_mcu_invoice_edit_tagihan");
            $periodeid = $this->input->post("modal_mcu_invoice_edit_periodeid");

            $data['org_id']           = $_SESSION['orgid'];
            $data['piutang_id']       = generateuuid();
            $data['no_tagihan']       = $notagihan;
            $data['rekanan_id']       = $provider;
            $data['note']             = $note;
            $data['periode']          = $periodeid;
            $data['date']             = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['nilai']            = (int) preg_replace('/\D/', '', $nominal);
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date('Y-m-d H:i:s');

            if($this->md->updatepiutang($piutangid, $data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Update";
            }

            echo json_encode($json);
        }

        public function uploadinvoice(){
            $piutangid= $_GET['piutangid'];

            $config['upload_path']   = './assets/invoice/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $piutangid;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();
                $dataupdate['attachment']="1";
                $this->md->updatepiutang($piutangid,$dataupdate);
                echo "Upload Success";
            }

        }

        public function pembayaran(){
            $piutangid    = $this->input->post("modal_mcu_pembayaran_piutangid");
            $departmentid = $this->input->post("modal_mcu_pembayaran_departmentid");
            $rekeningid   = $this->input->post("modal_mcu_pembayaran_rekeningid");
            $note         = $this->input->post("modal_mcu_pembayaran_note");
            $date         = $this->input->post("modal_mcu_pembayaran_date");
            $nominal      = $this->input->post("modal_mcu_pembayaran_in");
            $transaksiid  = generateuuid();
            
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'],$rekeningid);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']         = $_SESSION['orgid'];
            $data['transaksi_id']   = $transaksiid;
            $data['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'],$rekeningid)->nokwitansi;
            $data['rekening_id']    = $rekeningid;
            $data['note']           = $note;
            $data['piutang_id']     = $piutangid;
            $data['ref_id']         = $transaksiid;
            $data['department_id']  = $departmentid;
            $data['cash_in']        = (int) preg_replace('/\D/', '', $nominal);
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)+(int) preg_replace('/\D/', '', $nominal);
            $data['status']         = "6";
            $data['accept_id']      = $_SESSION['userid'];
            $data['accept_date']    = date('Y-m-d H:i:s');
            $data['created_by']     = $_SESSION['userid'];
            $this->md->insertrekening($data);

            $datapemabyaran['org_id']       = $_SESSION['orgid'];
            $datapemabyaran['transaksi_id'] = $transaksiid;
            $datapemabyaran['piutang_id']   = $piutangid;
            $datapemabyaran['rekening_id']  = $rekeningid;
            $datapemabyaran['note']         = $note;
            $datapemabyaran['date']         = DateTime::createFromFormat("d.m.Y",$date)->format("Y-m-d");
            $datapemabyaran['nominal']      = (int) preg_replace('/\D/', '', $nominal);
            $datapemabyaran['created_by']   = $_SESSION['userid'];

            if($this->md->insertpembayaran($datapemabyaran)){
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