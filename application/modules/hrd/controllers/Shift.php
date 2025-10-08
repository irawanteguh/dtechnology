<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Shift extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelshift","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_shift",$data);
		}

        public function loadcombobox(){
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['masterorganization']   = $masterorganization;
            
            return $data;
		}

        public function jadwalshift(){
            $result = $this->md->jadwalshift($this->input->post("orgid"));
            
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

	}
?>