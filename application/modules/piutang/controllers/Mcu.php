<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Mcu extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmcu", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_mcu",$data);
        }

        public function loadcombobox(){
            $resultprovider   = $this->md->provider($_SESSION['orgid']);

            $provider="";
            foreach($resultprovider as $a ){
                $provider.="<option value='".$a->provider_id."'>".$a->provider."</option>";
            }

            $data['provider']   = $provider;
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

        public function newinvoicemcu(){
            $notagihan = $this->input->post("modal_mcu_invoice_notagihan");
            $note      = $this->input->post("modal_mcu_invoice_note");
            $date      = $this->input->post("modal_mcu_invoice_date");
            $provider  = $this->input->post("modal_mcu_invoice_provider");
            $nominal   = $this->input->post("modal_mcu_invoice_tagihan");

            $data['org_id']       = $_SESSION['orgid'];
            $data['piutang_id']   = generateuuid();
            $data['no_tagihan']   = $notagihan;
            $data['rekanan_id']   = $provider;
            $data['note']         = $note;
            $data['date']         = DateTime::createFromFormat("d.m.Y", $date)->format("Y-m-d");
            $data['jenis_id']     = "2";
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


    }
?>