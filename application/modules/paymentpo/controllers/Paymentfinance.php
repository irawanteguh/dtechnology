<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentmanager", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_paymentfinance",$data);
        }

        public function loadcombobox(){
            $resultrekening = $this->md->rekening($_SESSION['orgid']);
            
            $rekeningid="";
            foreach($resultrekening as $a ){
                $rekeningid.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $data['rekeningid'] = $rekeningid;
            return $data;
		}

        public function datarequest(){
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");
            
            $status="
                        and   a.status in ('13')
                        -- and   a.created_date between '".$startDate."' and '".$endDate."'
                    ";
                    $parameter="order by inv_dir_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");
            $status="
                        and   a.status in ('14')
                        and a.created_date between '".$startDate."' and '".$endDate."'
                    ";
                    $parameter="order by inv_keu_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");

            $status="
                        and   a.status in ('15')
                        and   date(a.inv_keu_date) between '".$startDate."' and '".$endDate."'
                    ";
                    $parameter="order by inv_keu_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");
            $status="
                        and   a.status in ('16','17')
                        and a.created_date between '".$startDate."' and '".$endDate."'
                    ";
                    $parameter="order by status asc, inv_keu_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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