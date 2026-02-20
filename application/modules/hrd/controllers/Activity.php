<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Activity extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelactivity","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_activity");
		}

		public function masteractivity(){
            $result = $this->md->masteractivity($_SESSION['orgid']);
            
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

        public function addactivity(){
            $data['org_id']           = $_SESSION['orgid'];
            $data['activity_id']      = generateuuid();
            $data['activity']         = $this->input->post("data_activity_name_add");
            $data['durasi']           = $this->input->post("data_activity_durasi_add");
            $data['pk']               = "";
            $data['created_by']       = $_SESSION['userid'];
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->insertmasteractivity($data)){
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

        public function hapusactivity(){
            $activityid     = $this->input->post("data_activity_id_hapus");

            $data['active']           = '0';
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatemasteactivity($activityid,$data)){
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

        public function aktifactivity(){
            $activityid     = $this->input->post("data_activity_id_aktif");

            $data['active']           = '1';
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatemasteactivity($activityid,$data)){
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

        public function editactivity(){
            $activityid     = $this->input->post("data_activity_id_edit");

            $data['active']           = '1';
            $data['activity']         = $this->input->post("data_activity_name_edit");
            $data['durasi']           = $this->input->post("data_activity_durasi_edit");
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");

            if($this->md->updatemasteactivity($activityid,$data)){
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