<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Location extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modellocation","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_location",$data);
		}

        public function loadcombobox(){
            $resultmasteruser = $this->md->masteruser($_SESSION['orgid']);

            $pic="";
            foreach($resultmasteruser as $a ){
                $pic.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            $data['pic']   = $pic;
            return $data;
		}

        public function masterlocation(){
            $result = $this->md->masterlocation($_SESSION['orgid']);
            
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

        public function insertlocation(){

            $data['org_id']       = $_SESSION['orgid'];
            $data['location_id']  = generateuuid();
            $data['header_id']    = $this->input->post("headerid");
            $data['level_id']     = $this->input->post("levelid");
            $data['location']     = $this->input->post("location_name");
            $data['user_id']      = $this->input->post("location_pic");
            $data['created_by']   = $_SESSION['userid'];
            $data['created_date'] = date("Y-m-d H:i:s");

            if($this->md->insertlocation($data)){
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