<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Role extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelrole","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_role");
		}

        public function masterrole(){
            $result = $this->md->masterrole();
            
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

        public function mastermodules(){
            $roleid = $this->input->post("roleid");
            $result = $this->md->mastermodules($_SESSION['orgid'],$roleid);
            
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

        public function addrole(){
            $data['org_id']            = $_SESSION['orgid'];
            $data['role_id']           = generateuuid();
            $data['role']              = $this->input->post("data_role_name_add");
            $data['created_by']        = $_SESSION['userid'];
            $data['created_date']      = date("Y-m-d H:i:s");
            $data['last_updated_by']   = $_SESSION['userid'];
            $data['last_updated_date'] = date("Y-m-d H:i:s");

            if($this->md->insertrole($data)){
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

        public function mappingrole(){
            $roleid      = $this->input->post("roleid");
            $switchId    = $this->input->post("switchId");
            $switchValue = $this->input->post("switchValue");
    
            if ($switchValue === "true" || $switchValue === true) {
                $data['active'] = "1";
            } else {
                $data['active'] = "0";
            }
    
            $resultcheckdata = $this->md->checkdata($_SESSION['orgid'], $roleid, $switchId);
    
            if (!empty($resultcheckdata)) {
                $data['last_update_date'] = date("Y-m-d H:i:s");
                $data['last_update_by']   = $_SESSION['userid'];
    
                if ($this->md->updatemapping($roleid, $switchId, $data)) {
                    $json["responCode"] = "00";
                    $json["responHead"] = "success";
                    $json["responDesc"] = "Update Role Success";
                } else {
                    $json["responCode"] = "01";
                    $json["responHead"] = "info";
                    $json["responDesc"] = "Update Role Failed";
                }
            } else {
                $data['org_id']           = $_SESSION['orgid'];
                $data['trans_id']         = generateuuid();
                $data['role_id']          = $roleid;
                $data['modules_id']       = $switchId;
                $data['created_by']       = $_SESSION['userid'];
                $data['last_update_by']   = $_SESSION['userid'];
                $data['last_update_date'] = date("Y-m-d H:i:s");
    
                if($this->md->insertmapping($data)){
                    $json["responCode"] = "00";
                    $json["responHead"] = "success";
                    $json["responDesc"] = "Update Role Success";
                }else{
                    $json["responCode"] = "01";
                    $json["responHead"] = "info";
                    $json["responDesc"] = "Update Role Failed";
                }
            }
        
            echo json_encode($json);
        }

        public function hapusdata(){
            $data['active']            = "0";
            $data['last_updated_by']   = $_SESSION['userid'];
            $data['last_updated_date'] = date("Y-m-d H:i:s");

            if($this->md->updaterole($this->input->post("dataroleid"),$data)){
                $datarolemapping['active']           = "0";
                $datarolemapping['last_update_by']   = $_SESSION['userid'];
                $datarolemapping['last_update_date'] = date("Y-m-d H:i:s");
                $this->md->updaterolemapping($this->input->post("dataroleid"),$datarolemapping);

                $dataroleaccess['active']           = "0";
                $dataroleaccess['last_update_by']   = $_SESSION['userid'];
                $dataroleaccess['last_update_date'] = date("Y-m-d H:i:s");
                $this->md->updateroleaccess($this->input->post("dataroleid"),$dataroleaccess);

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