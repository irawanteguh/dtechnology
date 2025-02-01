<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentmanager", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentfinance");
        }

        public function datarequest(){
            $status="
                        and   a.status in ('13')
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

        public function decline(){
            $status="
                        and   a.status in ('14')
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
                        and   a.status in ('15')
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

        public function payment(){
            $status="
                        and   a.status in ('16','17')
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

                $dataupdate['INVOICE']="1";

                $this->md->updateheader($no_pemesanan,$dataupdate);

                echo "Upload Success";
            }
        }

        public function submitpettycash(){
            $balance = $this->input->post("data_balance");
            $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid']);

            if(empty($resultcheckbalancelast)){
                $lastbalance = 0;
            }else{
                $lastbalance =$resultcheckbalancelast[0]->balance;
            }

            $data['org_id']           = $_SESSION['orgid'];
            $data['transaksi_id']     = generateuuid();
            $data['no_kwitansi']      = $this->md->nokwitansi($_SESSION['orgid'])->nokwitansi;
            $data['note']             = $this->input->post("data_note");
            $data['department_id']    = $this->input->post("data_departmentid");
            $data['no_pemesanan']     = $this->input->post("data_nopemesanan");
            $data['cash_in']          = strval($balance);
            $data['before_balance']   = $lastbalance;
            $data['balance']          = strval($lastbalance)+strval($balance);
            $data['ref_pettycash_id'] = $this->input->post("data_refpettycase");
            $data['status']           = "6";
            $data['created_by']       = $_SESSION['userid'];

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