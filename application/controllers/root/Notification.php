<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Notification extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelnotification","md");
        }

        public function informationkpi(){
            $result = $this->md->informationkpi($_SESSION['orgid']);
            
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