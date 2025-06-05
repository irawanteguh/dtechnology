<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Asuransi extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelasuransi", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_asuransi",$data);
        }


        public function loadcombobox(){
            $resultperiodetahun = $this->md->periodetahun();
            $resultperiode      = $this->md->periode();
            $resultprovider     = $this->md->provider($_SESSION['orgid']);
            $resultrekening     = $this->md->rekening($_SESSION['orgid']);
            $resultmasterunit   = $this->md->masterunit($_SESSION['orgid'],"");

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periodeid."'>".$a->keterangan."</option>";
            }
            
            $periodetahun="";
            foreach($resultperiodetahun as $a ){
                $periodetahun.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $provider="";
            foreach($resultprovider as $a ){
                $provider.="<option value='".$a->provider_id."'>".$a->provider."</option>";
            }

            $rekening="";
            foreach($resultrekening as $a ){
                $rekening.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $department="";
            foreach($resultmasterunit as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['periode']      = $periode;
            $data['periodetahun'] = $periodetahun;
            $data['provider']     = $provider;
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


        public function newinvoicerawatjalan(){
            $notagihan = $this->input->post("modal_mcu_invoice_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_note");
            $date      = $this->input->post("modal_mcu_invoice_date");
            $provider  = $this->input->post("modal_mcu_invoice_provider");
            $nominal   = $this->input->post("modal_mcu_invoice_tagihan");
            $periodeid = $this->input->post("modal_mcu_invoice_periodeid");

            $data['org_id']       = $_SESSION['orgid'];
            $data['piutang_id']   = generateuuid();
            $data['no_tagihan']   = $notagihan;
            $data['rekanan_id']   = $provider;
            $data['note']         = $note;
            $data['periode']      = $periodeid;
            $data['date']         = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['jenis_id']     = "1";
            $data['nilai']        = (int) preg_replace('/\D/', '', $nominal);
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by']   = $_SESSION['userid'];

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


        public function newinvoicerawatinap(){
            $notagihan = $this->input->post("modal_mcu_invoice_ri_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_ri_note");
            $date      = $this->input->post("modal_mcu_invoice_ri_date");
            $provider  = $this->input->post("modal_mcu_invoice_ri_provider");
            $nominal   = $this->input->post("modal_mcu_invoice_ri_tagihan");
            $periodeid = $this->input->post("modal_mcu_invoice_ri_periodeid");

            $data['org_id']       = $_SESSION['orgid'];
            $data['piutang_id']   = generateuuid();
            $data['no_tagihan']   = $notagihan;
            $data['rekanan_id']   = $provider;
            $data['note']         = $note;
            $data['periode']      = $periodeid;
            $data['date']         = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['jenis_id']     = "7";
            $data['nilai']        = (int) preg_replace('/\D/', '', $nominal);
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by']   = $_SESSION['userid'];

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