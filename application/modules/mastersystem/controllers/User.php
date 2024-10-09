<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeluser","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_user");
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

        public function adduser(){
            $resultcekusername = $this->md->cekusername($this->input->post("data_user_username_add"));

            if(empty($resultcekusername)){
                $datausser['org_id']     = $_SESSION['orgid'];
                $datausser['user_id']    = generateuuid();
                $datausser['username']   = $this->input->post("data_user_username_add");
                $datausser['nik']        = generateUniqueCode();
                $datausser['name']       = $this->input->post("data_user_name_add");;
                $datausser['created_by'] = $_SESSION['userid'];
    
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
	}
?>