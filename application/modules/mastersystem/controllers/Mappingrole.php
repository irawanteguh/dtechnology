<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Mappingrole extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelmappingrole","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_mappingrole");
		}

        public function masterrole(){
            $result = $this->md->masterrole($_SESSION['orgid']);
            
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

        public function mappingrole() {
            $allSwitchStatuses = $this->input->post("allSwitchStatuses");
            $roleid = $this->input->post("roleid");
        
            foreach ($allSwitchStatuses as $status) {
                $switchId = $status['id'];
                $switchValue = $status['value'];
        
                if ($switchValue === "true" || $switchValue === true) {
                    $data['active'] = "1";
                } else {
                    $data['active'] = "0";
                }
        
                $resultcheckdata = $this->md->checkdata($_SESSION['orgid'], $roleid, $switchId);
        
                if (!empty($resultcheckdata)) {
                    $data['last_update_date'] = date("Y-m-d H:i:s");
                    $data['last_update_by'] = $_SESSION['userid'];
        
                    if ($this->md->updatemapping($roleid, $switchId, $data)) {
                        $json["responCode"] = "00";
                        $json["responHead"] = "success";
                        $json["responDesc"] = "Activity Success";
                    } else {
                        $json["responCode"] = "01";
                        $json["responHead"] = "info";
                        $json["responDesc"] = "Activity Failed";
                    }
                } else {
                    $data['org_id'] = $_SESSION['orgid'];
                    $data['trans_id'] = generateuuid();
                    $data['role_id'] = $roleid;
                    $data['modules_id'] = $switchId;
                    $data['created_by'] = $_SESSION['userid'];
                    $data['last_update_by'] = $_SESSION['userid'];
                    $data['last_update_date'] = date("Y-m-d H:i:s");
        
                    if ($this->md->insertmapping($data)) {
                        $json["responCode"] = "00";
                        $json["responHead"] = "success";
                        $json["responDesc"] = "Activity Success";
                    } else {
                        $json["responCode"] = "01";
                        $json["responHead"] = "info";
                        $json["responDesc"] = "Activity Failed";
                    }
                }
            }
        
            echo json_encode($json);
        }
        
	}
?>