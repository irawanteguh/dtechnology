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
	}
?>