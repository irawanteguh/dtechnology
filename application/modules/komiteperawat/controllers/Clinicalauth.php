<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Clinicalauth extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelclinicalauth","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_clinicalauth",$data);
		}
        
        public function loadcombobox(){
            $resultmasterrkk = $this->md->masterrkk();

            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);

            $rkk="";
            foreach($resultmasterrkk as $a ){
                $rkk.="<option value='".$a->klinis_id."'>".$a->keterangan."</option>";
            }

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['rkk']                = $rkk;
            $data['masterorganization'] = $masterorganization;
            return $data;
		}


		public function masteremployee(){
            $orgid =$this->input->post("orgid");
            $result = $this->md->masteremployee($orgid);
            
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