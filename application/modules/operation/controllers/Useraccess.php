<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Useraccess extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeluseraccess","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_useraccess",$data);
		}

        public function loadcombobox(){
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);


            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['masterorganization'] = $masterorganization;
            return $data;
        }

		public function masteruser(){
            $orgid = $this->input->post("orgid");
            $result = $this->md->masteruser($orgid);
            
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
            $result = $this->md->masterrole($userid);
            
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