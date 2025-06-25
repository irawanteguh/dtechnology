<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class indikatorunit extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelindikatorunit","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_indikatorunit",$data);
		}

        public function loadcombobox(){
            $resultperiode = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $data['periode'] = $periode;
            return $data;
		}

        public function masterindikator(){
            $periode    = $this->input->post("periode");
            $department = "   and department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')";
            $result     = $this->md->masterindikator($_SESSION['orgid'],$periode,$department);
            
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