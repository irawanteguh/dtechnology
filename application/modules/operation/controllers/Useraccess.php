<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Useraccess extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeluseraccess","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_useraccess");
		}

		public function masteruser(){
            $result = $this->md->masteruser($_SESSION['orgid']);
            
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

        public function masterrole(){
            $userid = $this->input->post("userid");
            $result = $this->md->masterrole($_SESSION['orgid'],$userid);
            
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

        public function mappingrole(){
            $switchId    = $this->input->post("switchId");
            $switchValue = $this->input->post("switchValue");
            $userid  = $this->input->post("userid");

            if($switchValue==="true"){
                $data['active']="1";
            }else{
                $data['active']="0";
            }

            
            $resultcheckdata =  $this->md->checkdata($_SESSION['orgid'],$userid,$switchId);

            if(!empty($resultcheckdata)){
                $data['last_update_date']=date("Y-m-d H:i:s");
                $data['last_update_by']=$_SESSION['userid'];
                if($this->md->updatemapping($userid,$switchId,$data)){
                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Activity Success";
                }else{
                    $json["responCode"]="01";
                    $json["responHead"]="info";
                    $json["responDesc"]="Activity Field";
                }
            }else{
                $data['org_id']           = $_SESSION['orgid'];
                $data['trans_id']         = generateuuid();
                $data['user_id']          = $userid;
                $data['role_id']          = $switchId;
                $data['created_by']       = $_SESSION['userid'];
                $data['last_update_by']   = $_SESSION['userid'];
                $data['last_update_date'] = date("Y-m-d H:i:s");

                if($this->md->insertmapping($data)){
                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Update Data Success";
                }else{
                    $json["responCode"]="01";
                    $json["responHead"]="info";
                    $json["responDesc"]="Update Data Field";
                }
            }

            echo json_encode($json);
        }
	}
?>