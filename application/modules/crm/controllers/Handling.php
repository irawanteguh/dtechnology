<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Handling extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelhandling","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_handling",$data);
		}

        public function loadcombobox(){
            $resultmasterdepartment   = $this->md->masterdepartment();
    
            $department   = "";
            $organization = "";
            $poliklinik   = "";
            $masterdoctor = "";

            foreach ($resultmasterdepartment as $a) {
                $department .= "<option value='" . $a->department_id . "'>" . $a->department . "</option>";
            }

           
            $data['department']   = $department;
            return $data;
        }

        public function datahandling(){
            $result = $this->md->datahandling($_SESSION['orgid']);
            
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

        public function updatedepartment(){
            $data['department_id'] = $this->input->post("modal_handling_update_department_departmentid");
            
            if($this->md->updatesaran($data,$this->input->post("modal_handling_update_department_transid"))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

        public function updatesaran(){
            $data['status'] = $this->input->post("datastatus");

            if($this->input->post("datastatus")==="1"){
                $data['datetime_fwd_department'] = date("Y-m-d H:i:s");
            }
            
            if($this->md->updatesaran($data,$this->input->post("datatransid"))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

	}
?>