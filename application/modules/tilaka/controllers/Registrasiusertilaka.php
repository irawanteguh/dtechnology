<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasiusertilaka extends CI_Controller {

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasiusertilaka","md");
        }

		public function index()
		{
			$this->template->load("template/template-admin","v_registrasi");
		}

		public function datakaryawan(){
			$search = $this->input->post("search");
            $result = $this->md->datakaryawan($_SESSION['orgid'],$search);
            
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