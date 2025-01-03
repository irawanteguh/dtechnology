<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Eticketview extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeleticketview","md");
        }

		public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_eticketview",$data);
		}

        public function loadcombobox(){
            $resultmasterseverity  = $this->md->masterseverity();
            $resultmasterpic  = $this->md->masterpic();
            

            $masterseverity="";
            foreach($resultmasterseverity as $a ){
                $masterseverity.="<option value='".$a->id."'>".$a->metod."</option>";
            }

            $masterpic="";
            foreach($resultmasterpic as $a ){
                $masterpic.="<option value='".$a->id."'>".$a->metod."</option>";
            }

            $data['masterseverity'] = $masterseverity;
            $data['masterpic']      = $masterpic;
            
            return $data;
		}
        
        public function dataeticket(){
            $result = $this->md->dataeticket($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = "We Get The Data You Want";
				$json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        // public function validasi(){
        //     $data['status']      = $this->input->post("status");
        //     $data['atasan_id']   = $_SESSION['userid'];
        //     $data['atasan_date'] = date('Y-m-d H:i:s');

        //     if($this->md->updateeticket($this->input->post("transid"),$data)){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Berhasil Di Tambah";
        //     } else {
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data Gagal Di Tambah";
        //     }
            
        //     echo json_encode($json);
        // }
	}
?>