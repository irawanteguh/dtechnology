<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Reportkpi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelreportkpi","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_reportkpi",$data);
		}

        public function loadcombobox(){
            $resultperiode = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->keterangan."</option>";
            }

            $data['periode'] = $periode;
            return $data;
		}

        public function reportkpi(){
            $periode    = $this->input->post("periode");
            $result = $this->md->reportkpi($_SESSION['orgid'],$periode);
            
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

        public function kepatuhaninput(){
            $periode    = $this->input->get("periode");
            $result = $this->md->kepatuhaninput($_SESSION['orgid'],$periode);
            
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