<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeluser","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_user",$data);
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
                $json["responDesc"]="We Get The Data You Want";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function adduser(){
            $resultcekusername = $this->md->cekusername($this->input->post("data_user_username_add"));

            if(empty($resultcekusername)){
                $datausser['group_id']    = $_SESSION['groupid'];
                $datausser['org_id']      = $_SESSION['orgid'];
                $datausser['user_id']     = generateuuid();
                $datausser['username']    = $this->input->post("data_user_username_add");
                $datausser['nik']         = $this->input->post("data_user_nik_add");
                $datausser['name']        = $this->input->post("data_user_name_add");
                $datausser['email']       = $this->input->post("data_user_email_add");
                $datausser['identity_no'] = $this->input->post("data_user_noktp_add");
                $datausser['created_by']  = $_SESSION['userid'];
    
                if($this->md->insertuser($datausser)){
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
                $json['responDesc']="Sorry, username has already been used";
            }
            

            echo json_encode($json);
        }

        public function adduserassistant(){
            $resultcekassistant = $this->md->cekassistant($_SESSION['orgid'],$this->input->post("userid"),$this->input->post("useridassistant"));

            if(empty($resultcekassistant)){
                $data['org_id']     = $_SESSION['orgid'];
                $data['trans_id']   = generateuuid();
                $data['user_id']    = $this->input->post("userid");
                $data['asst_id']    = $this->input->post("useridassistant");
                $data['created_by'] = $_SESSION['userid'];
    
                if($this->md->insertuserassistant($data)){
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
                $json['responDesc']="Assisstant Available";
            }
            

            echo json_encode($json);
        }
	}
?>