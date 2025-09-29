<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Department extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeldepartment","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_department",$data);
		}

        public function loadcombobox(){
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }

            $resultmasterorganization = $this->md->masterorganization($parameter);
            $resultmasterdepartment   = $this->md->masterdepartment($_SESSION['orgid']);

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $masterdepartment = $this->buildOptions($resultmasterdepartment);

            $data['masterorganization']   = $masterorganization;
            $data['masterdepartment']   = $masterdepartment;
            return $data;
        }

        private function buildOptions($items, $parent_id = null, $level = 0){
            $html = "";
            foreach ($items as $item) {
                if ($item->header_id == $parent_id) {
                    $indent = str_repeat("&nbsp;&nbsp;&nbsp;", $level);
                    $html .= "<option value='".$item->department_id."'>".$indent.$item->keterangan."</option>";
                    // Rekursif untuk anak
                    $html .= $this->buildOptions($items, $item->department_id, $level+1);
                }
            }

            return $html;
        }

		public function masterdatadepartment(){
            $orgid = $this->input->post("orgid");
            $result = $this->md->masterdatadepartment($orgid);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function masteruser(){
            $result = $this->md->masteruser($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="We Get The Data You Want";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function insertdepartment(){
            $data['org_id']        = $_SESSION['orgid'];
            $data['department_id'] = generateuuid();
            $data['header_id']     = $this->input->post("department_departmentheader");
            $data['level_id']      = $this->input->post("levelid");
            $data['department']    = $this->input->post("department_name");
            $data['code']          = $this->input->post("department_code");
            $data['jabatan']       = $this->input->post("department_position");
            $data['created_by']    = $_SESSION['userid'];
            $data['created_date']  = date("Y-m-d H:i:s");

            if($this->md->insertdepartment($data)){
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

        public function editdepartment(){
            $data['level_id']         = $this->input->post("levelidedit");
            $data['header_id']        = $this->input->post("department_departmentheader_edit");
            $data['department']       = $this->input->post("department_name_edit")     !== "" ? $this->input->post("department_name_edit") : null;
            $data['jabatan']          = $this->input->post("department_position_edit") !== "" ? $this->input->post("department_position_edit") : null;
            $data['code']             = $this->input->post("department_code_edit")     !== "" ? $this->input->post("department_code_edit") : null;
            $data['head_koordinator'] = $this->input->post("department_koordinator_edit") === "Y" ? "Y" : "N";
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatedepartment($data,$this->input->post("departmentidedit"))){
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

        public function adduser(){
            $data['user_id']     = $this->input->post("userid");

            if($this->md->updatedepartment($data,$this->input->post("departmentidadduser"))){
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

        public function hapusdata(){
            $data['active']           = "0";
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatedepartment($data,$this->input->post("datatransid"))){
                $this->md->updatedepartmentheaderid($data,$this->input->post("datatransid"));
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }
	}
?>