<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Status extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelstatus","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_status",$data);
		}

        public function loadcombobox(){
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }

            $resultmasterorganization = $this->md->masterorganization($parameter);
            $resultperiode            = $this->md->periode();

            $masterorganization = "";
            $periode            = "";

            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $data['periode']            = $periode;
            $data['masterorganization'] = $masterorganization;
            return $data;
		}

        public function datamonitoring(){
            $filterperiode      = $this->input->post("filterperiode");
            $selectorganization = $this->input->post("selectorganization");
            $result = $this->md->datamonitoring($selectorganization,$filterperiode);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
                $json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }
		

	}
?>