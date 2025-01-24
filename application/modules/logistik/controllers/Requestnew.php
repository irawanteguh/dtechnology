<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Requestnew extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_requestnew",$data);
        }

        public function loadcombobox(){
            $parameter1        = "and   a.user_id='".$_SESSION['userid']."'";

            $resultmastersupplier = $this->md->mastersupplier($_SESSION['orgid']);
            $resultmasterunit1    = $this->md->masterunit($_SESSION['orgid'],$parameter1);
            $resultpaymentmethod  = $this->md->paymentmethod();
            
            
            $mastersupplier="";
            foreach($resultmastersupplier as $a ){
                $mastersupplier.="<option value='".$a->supplier_id."'>".$a->supplier."</option>";
            }

            $department="";
            foreach($resultmasterunit1 as $a ){
                $department.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $paymentmethod="";
            foreach($resultpaymentmethod as $a ){
                $paymentmethod.="<option value='".$a->id."'>".$a->metod."</option>";
            }

            $data['mastersupplier'] = $mastersupplier;
            $data['department']     = $department;
            $data['paymentmethod']  = $paymentmethod;
            
            return $data;
		}

        public function newrequest(){
            $parameter = "and type<>'20'";
            
            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = generateuuid();
            $data['no_pemesanan_unit'] = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_request_department"),$parameter)->nomor_pemesanan;
            $data['judul_pemesanan']   = $this->input->post("modal_new_request_nama");
            $data['note']              = $this->input->post("modal_new_request_note");
            $data['department_id']     = $this->input->post("modal_new_request_department");
            $data['supplier_id']       = $this->input->post("modal_new_request_supplier");
            $data['method']            = $this->input->post("modal_new_request_method");
            $data['cito']              = $this->input->post("modal_new_request_cito");
            $data['created_by']        = $_SESSION['userid'];

            if($this->md->insertheader($data)){
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

        public function newinvoice(){
            $parameter = "and type<>'20'";
            
            $data['org_id']            = $_SESSION['orgid'];
            $data['no_pemesanan']      = generateuuid();
            $data['no_pemesanan_unit'] = $this->md->buatnopemesanan($_SESSION['orgid'],$this->input->post("modal_new_invoice_department"),$parameter)->nomor_pemesanan;
            $data['judul_pemesanan']   = $this->input->post("modal_new_invoice_nama");
            $data['note']              = $this->input->post("modal_new_invoice_note");
            $data['department_id']     = $this->input->post("modal_new_invoice_department");
            $data['supplier_id']       = $this->input->post("modal_new_invoice_supplier");
            $data['method']            = $this->input->post("modal_new_invoice_method");
            $data['cito']              = $this->input->post("modal_new_invoice_cito");
            $data['type']              = "1";
            $data['status_vice']       = "Y";
            $data['status_dir']        = "Y";
            $data['created_by']        = $_SESSION['userid'];

            if($this->md->insertheader($data)){
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

        public function datarequest(){
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and status in ('0') ";
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
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and status in ('2','4','6') ";
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
            $status="and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."') and status in ('1','3','5') ";
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

        public function detailbarangspu(){
            $nopemesanan = $this->input->post("nopemesanan");
            $result      = $this->md->detailbarangspu($_SESSION['orgid'],$nopemesanan);
            
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
        
    }
?>