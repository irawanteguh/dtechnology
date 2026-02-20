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
            $parameter1        = "and   a.user_id='".$_SESSION['userid']."'";
            $resultmasterunit1 = $this->md->masterunit($_SESSION['orgid'],$parameter1);

            $department="";
            foreach($resultmasterunit1 as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['department']     = $department;
            
            return $data;
		}

        public function datapettycash(){
            $parameter = "
                            and a.status='0'
                            and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                         ";
            $result = $this->md->datapettycash($_SESSION['orgid'],$parameter);
            
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

        public function approved(){
            $parameter = "
                            and a.status in ('2','4','6')
                            and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                         ";
            $result = $this->md->datapettycash($_SESSION['orgid'],$parameter);
            
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
            $parameter = "
                            and a.status in ('1','3','5')
                            and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                         ";
            $result = $this->md->datapettycash($_SESSION['orgid'],$parameter);
            
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

        public function newsubmission (){
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
            // $data['before_balance'] = $lastbalance;
            // $data['balance']        = strval($lastbalance)-strval($this->input->post("modal_pettycash_pengeluaran_out"));
            $data['status']         = "0";
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
            $data['status']         = "6";
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
            $data['cash_in']        = $this->input->post("modal_pettycash_pemasukan_in");
            $data['before_balance'] = $lastbalance;
            $data['balance']        = strval($lastbalance)+strval($this->input->post("modal_pettycash_pemasukan_in"));
            $data['status']         = "6";
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

        public function updatepettycash(){
            $data_transaksiid = $this->input->post('data_transaksiid');
            $data_validasi    = $this->input->post('data_validasi');

            
            $data['status']=$data_validasi;

            if($data_validasi==="6"){
                $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid']);

                if(empty($resultcheckbalancelast)){
                    $lastbalance = 0;
                }else{
                    $lastbalance =$resultcheckbalancelast[0]->balance;
                }

                $data['before_balance'] = $lastbalance;
                $data['balance']        = strval($lastbalance)-strval($this->input->post("data_cashout"));
            }

            if($this->md->updatepettycash($data_transaksiid,$data)){
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