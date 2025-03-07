<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reserve extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelreserve","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_reserve",$data);
		}

        public function loadcombobox(){
            $resultmasterpatient = $this->md->masterpatient($_SESSION['orgid']);
            $resultmasterdokter = $this->md->masterdokter($_SESSION['orgid']);
            $resultmasterprovider = $this->md->masterprovider($_SESSION['orgid']);
            
            
            $patientid="";
            foreach($resultmasterpatient as $a ){
                $patientid.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
            }

            $provider="";
            foreach($resultmasterprovider as $a ){
                $provider.="<option value='".$a->provider_id."'>".$a->provider."</option>";
            }


            $dokteropr="";
            foreach($resultmasterdokter as $a ){
                $dokteropr.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            $dokterans="";
            foreach($resultmasterdokter as $a ){
                $dokterans.="<option value='".$a->user_id."'>".$a->name."</option>";
            }


            $dokterank="";
            foreach($resultmasterdokter as $a ){
                $dokterank.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            $data['provider']  = $provider;
            $data['patientid'] = $patientid;
            $data['dokteropr'] = $dokteropr;
            $data['dokterans'] = $dokterans;
            $data['dokterank'] = $dokterank;
            
            return $data;
		}

		public function dataok(){
            $result = $this->md->dataok($_SESSION['orgid']);
            
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

        public function chat(){
            $result = $this->md->chat($_SESSION['orgid'],$_SESSION['userid']);
            
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

        public function newreserve(){
            
            $data['org_id']       = $_SESSION['orgid'];
            $data['transaksi_id'] = generateuuid();
            $data['date']         = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_add_plan_date"))->format("Y-m-d");
            $data['pasien_id']    = $this->input->post("modal_add_plan_patientid");
            $data['provider_id']  = $this->input->post("modal_add_plan_provider");
            $data['tindakan']     = $this->input->post("modal_add_plan_tindakan");
            $data['dokter_opr']   = $this->input->post("modal_add_plan_dokter_opr");
            $data['dokter_ans']   = $this->input->post("modal_add_plan_dokter_ans");
            $data['dokter_ank']   = $this->input->post("modal_add_plan_dokter_ank");
            $data['cito']         = $this->input->post("modal_add_plan_cito");
            $data['created_by']   = $_SESSION['userid'];

            if($this->md->insertplan($data)){
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