<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Rkk extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelrkk","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_rkk",$data);
		}
        
        public function loadcombobox(){
            $resultmasterrkk = $this->md->masterrkk();

            $rkk="";
            foreach($resultmasterrkk as $a ){
                $rkk.="<option value='".$a->klinis_id."'>".$a->keterangan."</option>";
            }

            $data['rkk'] = $rkk;
            return $data;
		}


		public function masteremployee(){
            $result = $this->md->masteremployee($_SESSION['orgid']);
            
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

        public function updaterkk(){
            $userid = $this->input->post("drawer_data_rkk_userid_add");
            $rkkid  = $this->input->post("drawer_data_rkk_rkkid_add");

            $data['klinis_id']   = $rkkid;

            if($this->md->updateuserdata($data,$userid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }

	}
?>