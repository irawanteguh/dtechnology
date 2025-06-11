<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Lain extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modellain", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_lain",$data);
        }


        public function loadcombobox(){
            $resultperiodetahun = $this->md->periodetahun();
            $resultrekening     = $this->md->rekening($_SESSION['orgid']);
            $resultmasterunit   = $this->md->masterunit($_SESSION['orgid'],"");

            
            $periodetahun="";
            foreach($resultperiodetahun as $a ){
                $periodetahun.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $rekening="";
            foreach($resultrekening as $a ){
                $rekening.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $department="";
            foreach($resultmasterunit as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['periodetahun'] = $periodetahun;
            $data['rekening']     = $rekening;
            $data['department']   = $department;
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
            $tahun  = $this->input->post("startDate");
            $result = $this->md->historypembayaran($_SESSION['orgid'],$tahun);
            
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


        public function newinvoice(){
            $notagihan = $this->input->post("modal_mcu_invoice_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_note");
            $date      = $this->input->post("modal_mcu_invoice_date");
            $nominal   = $this->input->post("modal_mcu_invoice_tagihan");

            $data['org_id']           = $_SESSION['orgid'];
            $data['piutang_id']       = generateuuid();
            $data['no_tagihan']       = $notagihan;
            $data['note']             = $note;
            $data['date']             = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['jenis_id']         = "6";
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