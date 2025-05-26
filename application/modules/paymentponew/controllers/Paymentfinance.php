<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentfinance", "md");
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

        public function dataonprocess(){
            
            $status="
                        and   a.status in ('13')
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

        public function dataapprove(){
            $status="
                        and   a.status in ('15')
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

        public function datapayment(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $status="
                        and   date(a.payment_date) between '".$startDate."' and '".$endDate."' or date(a.inv_keu_date) between '".$startDate."' and '".$endDate."'
                        and   a.status in ('16','17')
                    ";
                    $parameter="order by status asc, payment_date desc, inv_keu_date desc";
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
            $nopemesanan = $this->input->post("modal_finance_payment_nopemesanan");
            $rekeningid  = $this->input->post("modal_finance_payment_rekeningid");
 
            $dataupdate['rekening_id']  = $rekeningid;
            $dataupdate['status']       = "16";
            $dataupdate['payment_id']   = $_SESSION['userid'];
            $dataupdate['payment_date'] = date('Y-m-d H:i:s');

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
        
    }
?>