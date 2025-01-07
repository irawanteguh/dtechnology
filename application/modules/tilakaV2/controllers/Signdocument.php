<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signdocument extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
            $this->load->model("Modelsigndocument","md");
        }

		public function index(){
            if(isset($_GET['user_identifier']) && isset($_GET['request_id']) && isset($_GET['status'])){

                if($_GET['status']==="Sukses"){
                    $datasimpanhd['status']="4";
                    $datasimpanit['status']="2";
                }

                $this->md->updatefile($datasimpanhd,$_GET['request_id']);
                $this->md->updatesigner($datasimpanit,$_GET['request_id']);

                redirect("tilakaV2/signdocument");
            }else{
                $this->template->load("template/template-sidebar","v_signdocument");
            }
		}

        public function datasigndocument(){
            $result = $this->md->datasigndocument(ORG_ID);
            
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