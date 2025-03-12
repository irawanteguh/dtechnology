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
            $resultmasterpatient  = $this->md->masterpatient($_SESSION['orgid']);
            $resultmasterdokter   = $this->md->masterdokter($_SESSION['orgid']);
            $resultmasterprovider = $this->md->masterprovider($_SESSION['orgid']);
            $resultmasterreason   = $this->md->masterreason($_SESSION['orgid']);
            $resultmasterpackage  = $this->md->masterpackage($_SESSION['orgid']);
            
            
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

            $reason="";
            foreach($resultmasterreason as $a ){
                $reason.="<option value='".$a->master_id."'>".$a->master_name."</option>";
            }

            $package="";
            foreach($resultmasterpackage as $a ){
                $package.="<option value='".$a->transaksi_id."'>".$a->packagetindakan."</option>";
            }

            $data['provider']  = $provider;
            $data['patientid'] = $patientid;
            $data['dokteropr'] = $dokteropr;
            $data['dokterans'] = $dokterans;
            $data['dokterank'] = $dokterank;
            $data['reason']    = $reason;
            $data['package']   = $package;
            
            return $data;
		}

		public function ongoing(){
            $parameter = "and a.status in ('0','1','2')";
            $result = $this->md->dataok($_SESSION['orgid'],$parameter);
            
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
            $operasiid = $this->input->post("operasiid");
            $result = $this->md->chat($_SESSION['orgid'],$_SESSION['userid'],$operasiid);
            
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
            
            if($this->input->post("modal_add_plan_date")!=""){
                $data['org_id']       = $_SESSION['orgid'];
                $data['transaksi_id'] = generateuuid();
                $data['date']         = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_add_plan_date"))->format("Y-m-d");
                $data['package_id']   = $this->input->post("modal_add_plan_package");
                $data['pasien_id']    = $this->input->post("modal_add_plan_patientid");
                $data['provider_id']  = $this->input->post("modal_add_plan_provider");
                $data['diagnosis']    = $this->input->post("modal_add_plan_diagnosis");
                $data['tindakan']     = $this->input->post("modal_add_plan_tindakan");
                $data['benefit']      = $this->input->post("modal_add_plan_benefit");
                $data['dokter_opr']   = $this->input->post("modal_add_plan_dokter_opr");
                // $data['dokter_ans']   = $this->input->post("modal_add_plan_dokter_ans");
                // $data['dokter_ank']   = $this->input->post("modal_add_plan_dokter_ank");
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
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Please Enter Date";
            }
            

            echo json_encode($json);
        }

        public function cancelled(){
            
            $data['reason_id'] = $this->input->post("modal_cancelled_reason");
            $data['status']    = "99";

            if($this->md->updateplan($this->input->post("modal_cancelled_operasiid"),$data)){
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

        public function sendChat() {
            $chatText = $this->input->post('chat');
            $operasiid = $this->input->post('operasiid');

            $data['org_id']     = $_SESSION['orgid'];
            $data['chat_id']    = generateuuid();
            $data['operasi_id'] = $operasiid;
            $data['chat']       = $chatText;
            $data['created_by'] = $_SESSION['userid'];

            if($this->md->insertchat($data)){
                $dataupdate['status']="1";
                $this->md->updateplan($operasiid,$dataupdate);
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

        public function updatedata(){
            
            $data['status']     = $this->input->post("data_value");
            $data['agree_id']   = $_SESSION['userid'];
            $data['agree_date'] = date('Y-m-d H:i:s');

            if($this->md->updateplan($this->input->post("data_operasiid"),$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Update";
            }

            echo json_encode($json);
        }

        public function calender(){
            $result = $this->md->calender($_SESSION['orgid'],$_SESSION['userid']);
            $events = array();
    
            foreach ($result as $a) {
    
                $data['transid']        = $a->transaksi_id;
                $data['title']          = $a->mrpasien." | ".$a->name;
                $data['start']          = $a->start_date;
                $data['end']            = $a->end_date;
    
                if($a->status === "0"){
                    $data['color']     = '#0d6efd';
                }
    
                if($a->status === "1"){
                    $data['color']     = '#00a65a';
                }
    
                if($a->status === "2"){
                    $data['color']     = '#ffc107';
                }
    
                if($a->status === "99"){
                    $data['color']     = '#dc3545';
                }
                
                $events[] = $data;
            };
    
            echo json_encode($events);
        }

	}
?>