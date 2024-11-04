<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Position extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelposition","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_position",$data);
		}

        public function loadcombobox(){
            $resultmasterdepartment = $this->md->masterdepartment($_SESSION['orgid']);

            $masterdepartment="";
            foreach($resultmasterdepartment as $a ){
                $masterdepartment.="<option value='".$a->department_id."'>".$a->department."</option>";
            }

            $data['masterdepartmentadd'] = $masterdepartment;
            $data['masterdepartmentedit'] = $masterdepartment;
            
            return $data;
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
            $data['department_id']    = $this->input->post("modal_position_edit_departmentid_edit");
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