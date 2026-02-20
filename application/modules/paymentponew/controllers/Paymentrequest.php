<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentrequest extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentrequest", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentrequest");
        }

        public function datapemesanan(){
            $status    = "  and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')
                            and   a.status in ('7','8','9','10','11','12','13','16','17','32','33','34','35','36','37')
                        ";
            $orderby = "
                ORDER BY 
                CASE WHEN a.status = '7' THEN a.inv_kains_date END DESC
            ";

            $result = $this->md->datapemesanan($_SESSION['orgid'],$status,$orderby);
            
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

        // public function dataonprocess(){
        //     $status    = "and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('7')";
        //     $parameter = "order by created_date desc";

        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
        //     if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
        //         $json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function dataapprove(){
        //     $status    = "and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('9','11','13','15','16','17')";
        //     $parameter = "order by status asc, created_date desc";

        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
        //     if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
        //         $json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function datadecline(){
        //     $status    = "and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and a.status in ('8','10','12','14')";
        //     $parameter = "order by created_date desc";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
        //     if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
        //         $json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function uploadinvoice(){
        //     $datanopemesanan= $_GET['datanopemesanan'];

        //     $config['upload_path']   = './assets/invoice/';
        //     $config['allowed_types'] = 'pdf';
        //     $config['file_name']     = $datanopemesanan;
        //     $config['overwrite']     = TRUE;

        //     $this->load->library('upload', $config);

        //     if (!$this->upload->do_upload('file')) {
        //         $error = array('error' => $this->upload->display_errors());

        //         log_message('error', 'File upload error: ' . implode(' ', $error));
        //         echo json_encode($error);
        //     } else {
        //         $upload_data = $this->upload->data();

        //         $dataupdate = array(
        //                             'invoice' => "1"
        //                         );

        //         $this->md->updateheader($datanopemesanan,$dataupdate);

        //         echo "Upload Success";
        //     }
        // }

        // public function noinvoice(){
        //     $nopemesanan = $this->input->post("modal_upload_invoice_nopemesanan");
        //     $noinvoice   = $this->input->post("modal_upload_invoice_invoiceno");

        //     $dataupdate['invoice_no']     = $noinvoice;
        //     $dataupdate['inv_kains_id']   = $_SESSION['userid'];
        //     $dataupdate['inv_kains_date'] = date('Y-m-d H:i:s');

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
        
    }
?>