<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Mutasi extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmutasi", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_mutasi",$data);
        }

        public function loadcombobox(){
            $resultrekening = $this->md->rekening($_SESSION['orgid']);

            $rekening="";
            foreach($resultrekening as $a ){
                $rekening.="<option value='".$a->rekening_id."'>".$a->keterangan."</option>";
            }

            $data['rekening'] = $rekening;
            return $data;
		}

        public function datamutasi(){
            $rekeningid = $this->input->post("rekeningid");
            $parameter  = "and a.status='6'";
            $result = $this->md->datamutasi($rekeningid,$parameter);
            
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