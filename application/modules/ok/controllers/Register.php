<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Register extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelreserve","md");
        }

		public function index(){
			$data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_register",$data);
		}

		public function loadcombobox(){
			$parameter           = "";
			$resultmasterreason  = $this->md->masterreason($_SESSION['orgid']);
			$resultmasterpatient = $this->md->masterpatient($_SESSION['orgid'],$parameter);

            $reason="";
            foreach($resultmasterreason as $a ){
                $reason.="<option value='".$a->master_id."'>".$a->master_name."</option>";
            }

			$pasienid="";
            foreach($resultmasterpatient as $a ){
                $pasienid.="<option value='".$a->pasien_id."'>".$a->identitaspasien."</option>";
            }

			$data['reason']   = $reason;
			$data['pasienid'] = $pasienid;
            
            return $data;
		}


	}
?>