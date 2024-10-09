<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Logservice extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
            $this->load->model("Modellogservice","md");
        }

		public function index(){
            $this->template->load("template/template-sidebar","v_logservice");
		}

        public function datalog(){
            $parameter ="AND CREATED_DATE >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
            $result = $this->md->datalog($_SESSION['orgid'],$parameter);
            
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