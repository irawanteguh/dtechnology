<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Mutasi extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmutasi", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_mutasi",$data);
        }

        public function loadcombobox(){
            $parameter1        = "";

            $resultmasterunit = $this->md->masterunit($_SESSION['orgid'],$parameter1);
            $resultrekening   = $this->md->rekening($_SESSION['orgid']);

            $rekening="";
            foreach($resultrekening as $a ){
                $rekening.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $department="";
            foreach($resultmasterunit as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['rekening']   = $rekening;
            $data['department'] = $department;
            return $data;
		}

        public function datamutasi(){
            $rekeningid = $this->input->post("rekeningid");
            $parameter = "
                            and a.status='6'
                         ";
            $result = $this->md->datamutasi($_SESSION['orgid'],$rekeningid,$parameter);
            
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

        public function newpemasukan(){
            $rekeningid   = $this->input->post("modal_rekening_pemasukan_rekeningid");
            $note         = $this->input->post("modal_rekening_pemasukan_note");
            $departmentid = $this->input->post("modal_rekening_pemasukan_department");
            $nominal      = $this->input->post("modal_rekening_pemasukan_in");
            
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'],$rekeningid);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']         = $_SESSION['orgid'];
            $data['transaksi_id']   = generateuuid();
            $data['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'],$rekeningid)->nokwitansi;
            $data['rekening_id']    = $rekeningid;
            $data['note']           = $note;
            $data['department_id']  = $departmentid;
            $data['cash_in']        = (int) preg_replace('/\D/', '', $nominal);
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)+(int) preg_replace('/\D/', '', $nominal);
            $data['status']         = "6";
            $data['accept_id']      = $_SESSION['userid'];
            $data['accept_date']    = date('Y-m-d H:i:s');
            $data['created_by']     = $_SESSION['userid'];

            if($this->md->insertrekening($data)){
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

        public function newpengeluaran(){
            $rekeningid   = $this->input->post("modal_rekening_pengeluaran_rekeningid");
            $note         = $this->input->post("modal_rekening_pengeluaran_note");
            $departmentid = $this->input->post("modal_rekening_pengeluaran_department");
            $nominal      = $this->input->post("modal_rekening_pengeluaran_out");
            
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'],$rekeningid);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']         = $_SESSION['orgid'];
            $data['transaksi_id']   = generateuuid();
            $data['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'],$rekeningid)->nokwitansi;
            $data['rekening_id']    = $rekeningid;
            $data['note']           = $note;
            $data['department_id']  = $departmentid;
            $data['cash_out']       = (int) preg_replace('/\D/', '', $nominal);
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)-(int) preg_replace('/\D/', '', $nominal);
            $data['status']         = "6";
            $data['accept_id']      = $_SESSION['userid'];
            $data['accept_date']    = date('Y-m-d H:i:s');
            $data['created_by']     = $_SESSION['userid'];

            if($this->md->insertrekening($data)){
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