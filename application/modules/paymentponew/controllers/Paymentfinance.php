<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
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

        public function datapemesanan(){
            $startDate = $this->input->post("startDate") ?: date("Y-m-d");
            $endDate   = $this->input->post("endDate")   ?: date("Y-m-d");

            $status = "
                AND (
                    (a.status in ('17') AND DATE(a.inv_keu_date) BETWEEN '".$startDate."' AND '".$endDate."')
                    or (a.status = '9' and method='4')
                    or (a.status in ('13','14','15','16'))
                )
            ";

            $orderby = "
                            ORDER BY 
                                CASE 
                                    WHEN a.status = '9'  THEN a.inv_manager_date
                                    WHEN a.status = '13' THEN a.inv_dir_date
                                    WHEN a.status IN ('14','15') THEN a.inv_keu_date
                                    WHEN a.status IN ('16','17') THEN a.payment_date
                                END DESC
                        ";

            $result = $this->md->datapemesanan($_SESSION['orgid'], $status, $orderby);
            
            if(!empty($result)){
                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "Data Successfully Found";
                $json["responResult"] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "Data Failed to Find";
            }

            echo json_encode($json);
        }



        // public function dataonprocess(){
            
        //     $status="
        //                 and   a.status in ('13')
        //             ";
        //     $parameter="order by inv_dir_date desc";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function dataapprove(){
        //     $status="
        //                 and   a.status in ('15')
        //             ";
        //     $parameter="order by inv_keu_date asc";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function datapayment(){
        //     $startDate = $this->input->post("startDate");
        //     $endDate   = $this->input->post("endDate");

        //     $status="
        //                 and   date(a.payment_date) between '".$startDate."' and '".$endDate."' or date(a.inv_keu_date) between '".$startDate."' and '".$endDate."'
        //                 and   a.status in ('16','17')
        //             ";
        //             $parameter="order by status asc, payment_date desc, inv_keu_date desc";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function datadecline(){
        //     $status="
        //                 and   a.status in ('14')
        //             ";
        //     $parameter="order by inv_keu_date desc";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function detailbarangpemesanan(){
        //     $nopemesanan = $this->input->post("nopemesanan");
        //     $result      = $this->md->detailbarangpemesanan($_SESSION['orgid'],$nopemesanan);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function catatankeuangan(){
        //     $nopemesanan  = $this->input->post("modal_note_finance_nopemesanan");
        //     $notelampiran = $this->input->post("modal_note_finance_catatan");
 
        //     $dataupdate['inv_keu_note'] = $notelampiran;
        //     $dataupdate['status']       = "15";
        //     $dataupdate['inv_keu_id']   = $_SESSION['userid'];
        //     $dataupdate['inv_keu_Date'] = date('Y-m-d H:i:s');

        //     if($this->md->updateheader($nopemesanan,$dataupdate)){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Updated Successfully";
        //     }else{
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data failed to update";
        //     }
            

        //     echo json_encode($json);
        // }

        // public function payment(){
        //     $nopemesanan  = $this->input->post("modal_finance_payment_nopemesanan");
        //     $rekeningid   = $this->input->post("modal_finance_payment_rekeningid");
        //     $nominal      = $this->input->post("modal_finance_payment_nominal");
        //     $departmentid = $this->input->post("modal_finance_payment_departmentid");
        //     $catatan      = $this->input->post("modal_finance_payment_note");
 
        //     $dataupdate['rekening_id']    = $rekeningid;
        //     $dataupdate['total_transfer'] = (int) preg_replace('/\D/', '', $nominal);
        //     $dataupdate['status']         = "16";
        //     $dataupdate['payment_id']     = $_SESSION['userid'];
        //     $dataupdate['payment_date']   = date('Y-m-d H:i:s');

        //     $resultcheckbalancelast = $this->md->checkbalancelast($_SESSION['orgid'],$rekeningid);
        //     if(empty($resultcheckbalancelast)){
        //         $lastbalance = 0;
        //     }else{
        //         $lastbalance =$resultcheckbalancelast[0]->balance;
        //     }

        //     $datarekening['org_id']         = $_SESSION['orgid'];
        //     $datarekening['transaksi_id']   = generateuuid();
        //     $datarekening['rekening_id']    = $rekeningid;
        //     $datarekening['department_id']  = $departmentid;
        //     $datarekening['note']           = $catatan;
        //     $datarekening['no_pemesanan']   = $nopemesanan;
        //     $datarekening['no_kwitansi']    = $this->md->nokwitansi($_SESSION['orgid'],$rekeningid)->nokwitansi;
        //     $datarekening['cash_out']       = (int) preg_replace('/\D/', '', $nominal);
        //     $datarekening['before_balance'] = $lastbalance;
        //     $datarekening['balance']        = strval($lastbalance)-(int) preg_replace('/\D/', '', $nominal);
        //     $datarekening['status']         = "6";
        //     $datarekening['accept_id']      = $_SESSION['userid'];
        //     $datarekening['accept_date']    = date('Y-m-d H:i:s');
        //     $datarekening['created_by']     = $_SESSION['userid'];

        //     $this->md->insertrekening($datarekening);
            
        //     if($this->md->updateheader($nopemesanan,$dataupdate)){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Updated Successfully";
        //     }else{
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data failed to update";
        //     }
            

        //     echo json_encode($json);
        // }

        // public function updateheader(){
        //     $datanopemesanan = $this->input->post('datanopemesanan');
        //     $datastatus      = $this->input->post('datastatus');
        //     $datavalidator   = $this->input->post('datavalidator');
            
        //     if($datavalidator==="FINANCE"){
        //         $data['status']       = $datastatus;
        //         $data['inv_keu_id']   = $_SESSION['userid'];
        //         $data['inv_keu_date'] = date('Y-m-d H:i:s');
        //     }

        //     if($this->md->updateheader($datanopemesanan,$data)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Update successful";
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Failed to update database";
        //     }

        //     echo json_encode($json);
        // }

        
        
    }
?>