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
            // $parameter1 ="";
            $parameter2 ="and   a.pasien_id not in (select pasien_id from dt01_med_ok_hd where active='1' and org_id=a.org_id and status not in ('99') and pasien_id=a.pasien_id)";
            $parameter3 ="";
            // $resultmasterpatient  = $this->md->masterpatient($_SESSION['orgid'],$parameter1);
            $resultmasterpatient2    = $this->md->masterpatient($_SESSION['orgid'],$parameter2);
            $resultmasterpatientedit = $this->md->masterpatient($_SESSION['orgid'],$parameter3);
            $resultmasterdokter      = $this->md->masterdokter($_SESSION['orgid']);
            $resultmasterprovider    = $this->md->masterprovider($_SESSION['orgid']);
            $resultmasterreason      = $this->md->masterreason($_SESSION['orgid']);
            $resultmasterpackage     = $this->md->masterpackage($_SESSION['orgid']);
            
            
            // $patientid="";
            // foreach($resultmasterpatient as $a ){
            //     $patientid.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
            // }

            $patientid2="";
            foreach($resultmasterpatient2 as $a ){
                $patientid2.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
            }

            $patientidedit="";
            foreach($resultmasterpatientedit as $a ){
                $patientidedit.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
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

            $data['provider'] = $provider;
              // $data['patientid'] = $patientid;
            $data['patientid2']    = $patientid2;
            $data['patientidedit'] = $patientidedit;
            $data['dokteropr']     = $dokteropr;
            $data['dokterans']     = $dokterans;
            $data['dokterank']     = $dokterank;
            $data['reason']        = $reason;
            $data['package']       = $package;
            
            return $data;
		}

		public function datarequest(){
            $parameter = "and a.status='5'";
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

        public function dataregister(){
            $parameter = "and a.status='5'";
            $result = $this->md->dataok($_SESSION['orgid'],$parameter);
            
			if(!empty($result)){
                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "Data Successfully Found";
                $json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "Data Failed to Find";
            }

            echo json_encode($json);
        }

        public function datacancelled(){
            $parameter = "and a.status ='99'";
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

        // public function newreserve(){
            
        //     if($this->input->post("modal_add_plan_date")!=""){
        //         $data['org_id']       = $_SESSION['orgid'];
        //         $data['transaksi_id'] = generateuuid();
        //         $data['date']         = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_add_plan_date"))->format("Y-m-d");
        //         $data['package_id']   = $this->input->post("modal_add_plan_package");
        //         $data['pasien_id']    = $this->input->post("modal_add_plan_patientid");
        //         $data['provider_id']  = $this->input->post("modal_add_plan_provider");
        //         $data['diagnosis']    = $this->input->post("modal_add_plan_diagnosis");
        //         $data['tindakan']     = $this->input->post("modal_add_plan_tindakan");
        //         $data['benefit']      = $this->input->post("modal_add_plan_benefit");
        //         $data['dokter_opr']   = $this->input->post("modal_add_plan_dokter_opr");
        //         // $data['dokter_ans']   = $this->input->post("modal_add_plan_dokter_ans");
        //         // $data['dokter_ank']   = $this->input->post("modal_add_plan_dokter_ank");
        //         // $data['cito']         = $this->input->post("modal_add_plan_cito");
        //         $data['created_by']   = $_SESSION['userid'];
    
        //         if($this->md->insertplan($data)){
        //             $json['responCode']="00";
        //             $json['responHead']="success";
        //             $json['responDesc']="Data Added Successfully";
        //         } else {
        //             $json['responCode']="01";
        //             $json['responHead']="info";
        //             $json['responDesc']="Data Failed to Add";
        //         }
        //     }else{
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Please Enter Date";
        //     }
            

        //     echo json_encode($json);
        // }

        public function newrequest(){
            
            if($this->input->post("modal_reserve_request_date")!=""){
                $data['org_id']            = $_SESSION['orgid'];
                $data['transaksi_id']      = generateuuid();
                $data['date']              = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_reserve_request_date"))->format("Y-m-d");
                $data['pasien_id']         = $this->input->post("modal_reserve_request_patientid");
                $data['dokter_opr']        = $this->input->post("modal_reserve_request_dokteropr");
                $data['diagnosis']         = $this->input->post("modal_reserve_request_diagnosis");
                $data['basic_diagnosis']   = $this->input->post("modal_reserve_request_basicdiagnosis");
                $data['tindakan']          = $this->input->post("modal_reserve_request_medicaltreatment");
                $data['indikasi_tindakan'] = $this->input->post("modal_reserve_request_indicationmedicaltreatment");
                $data['procedures']        = $this->input->post("modal_reserve_request_procedures");
                $data['purpose']           = $this->input->post("modal_reserve_request_purpose");
                $data['risk']              = $this->input->post("modal_reserve_request_risk");
                $data['prognosis']         = $this->input->post("modal_reserve_request_prognosis");
                $data['alternative']       = $this->input->post("modal_reserve_request_alternatives");
                $data['save']              = $this->input->post("modal_reserve_request_save");
                $data['cito']              = $this->input->post("modal_reserve_request_cito");
                $data['status']            = "5";
                $data['created_by']        = $_SESSION['userid'];
    
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

        public function editrequest(){
            
            if($this->input->post("modal_reserve_request_date_edit")!=""){
                $data['date']              = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_reserve_request_date_edit"))->format("Y-m-d");
                $data['dokter_opr']        = $this->input->post("modal_reserve_request_dokteropr_edit");
                $data['diagnosis']         = $this->input->post("modal_reserve_request_diagnosis_edit");
                $data['basic_diagnosis']   = $this->input->post("modal_reserve_request_basicdiagnosis_edit");
                $data['tindakan']          = $this->input->post("modal_reserve_request_medicaltreatment_edit");
                $data['indikasi_tindakan'] = $this->input->post("modal_reserve_request_indicationmedicaltreatment_edit");
                $data['procedures']        = $this->input->post("modal_reserve_request_procedures_edit");
                $data['purpose']           = $this->input->post("modal_reserve_request_purpose_edit");
                $data['risk']              = $this->input->post("modal_reserve_request_risk_edit");
                $data['prognosis']         = $this->input->post("modal_reserve_request_prognosis_edit");
                $data['alternative']       = $this->input->post("modal_reserve_request_alternatives_edit");
                $data['save']              = $this->input->post("modal_reserve_request_save_edit");
                $data['cito']              = $this->input->post("modal_reserve_request_cito_edit");
    
                if($this->md->updateplan($this->input->post("modal_reserve_edit_operasiid"),$data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Update Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Update";
                }
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Please Enter Date";
            }
            

            echo json_encode($json);
        }

        public function cancelled(){
            
            $data['reason_id']   = $this->input->post("modal_cancelled_reason");
            $data['status']      = "99";
            $data['reason_by']   = $_SESSION['userid'];
            $data['reason_date'] = date('Y-m-d H:i:s');

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

        public function sendchat() {
            $chatText  = $this->input->post('chat');
            $operasiid = $this->input->post('operasiid');
            $status    = $this->input->post('status');

            $data['org_id']     = $_SESSION['orgid'];
            $data['chat_id']    = generateuuid();
            $data['operasi_id'] = $operasiid;
            $data['chat']       = $chatText;
            $data['created_by'] = $_SESSION['userid'];

            if($this->md->insertchat($data)){
                if($status==="0"){
                    $dataupdate['status']="1";
                    $this->md->updateplan($operasiid,$dataupdate);
                }
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

                if($a->status === "5"){
                    $data['color']     = '#6f42c1';
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