<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Pettycashit extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpettycash", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_pettycashit",$data);
        }

        public function loadcombobox(){
            $parameter1        = "";
            $resultmasterunit1 = $this->md->masterunit($_SESSION['orgid'],$parameter1);

            $department="";
            foreach($resultmasterunit1 as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['department']     = $department;
            
            return $data;
		}

        public function datapettycash(){
            $result = $this->md->datapettycash($_SESSION['orgid']);
            
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

        public function newpengeluaran(){
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid']);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']         = $_SESSION['orgid'];
            $data['transaksi_id']   = generateuuid();
            $data['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'])->nokwitansi;
            $data['note']           = $this->input->post("modal_pettycash_pengeluaran_note");
            $data['department_id']  = $this->input->post("modal_pettycash_pengeluaran_department");
            $data['cash_out']       = $this->input->post("modal_pettycash_pengeluaran_out");
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)-strval($this->input->post("modal_pettycash_pengeluaran_out"));
            $data['created_by']     = $_SESSION['userid'];

            if($this->md->insertpettycash($data)){
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

        public function newpemasukan(){
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid']);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']         = $_SESSION['orgid'];
            $data['transaksi_id']   = generateuuid();
            $data['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'])->nokwitansi;
            $data['note']           = $this->input->post("modal_pettycash_pemasukan_note");
            $data['department_id']  = $this->input->post("modal_pettycash_pemasukan_department");
            $data['cash_in']       = $this->input->post("modal_pettycash_pemasukan_in");
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)+strval($this->input->post("modal_pettycash_pemasukan_in"));
            $data['created_by']     = $_SESSION['userid'];

            if($this->md->insertpettycash($data)){
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