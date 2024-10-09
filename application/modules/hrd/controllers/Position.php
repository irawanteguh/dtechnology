<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Position extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelposition","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_position");
		}

		public function daftarjabatan(){
			$search = $this->input->post("search");
            $result = $this->md->daftarjabatan($_SESSION['orgid'],$search);
            
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

        public function addposition(){
            $data['org_id']           = $_SESSION['orgid'];
            $data['position_id']      = generateuuid();
            $data['position']         = $this->input->post("data_position_name_add");
            $data['created_by']       = $_SESSION['userid'];
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->insertmasterposition($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Berhasil Di Tambah";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Gagal Di Tambah";
            }

            echo json_encode($json);
        }

        public function editposition(){
            $positionid     = $this->input->post("data_positiion_id_edit");

            $data['active']           = '1';
            $data['position']         = $this->input->post("data_position_name_edit");
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatemasterposition($positionid,$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Berhasil Di Perbaharui";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Gagal Di Perbaharui";
            }

            echo json_encode($json);
        }

	}
?>