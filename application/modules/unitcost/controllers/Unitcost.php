<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Unitcost extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelunitcost","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_unitcost",$data);
		}

        public function loadcombobox(){
            $resultmasterkategori = $this->md->masterkategori();
            
            
            $masterkategori="";
            foreach($resultmasterkategori as $a ){
                $masterkategori.="<option value='".$a->code."'>".$a->master_name."</option>";
            }

            $data['masterkategori'] = $masterkategori;
            
            return $data;
		}

        public function masterlayanan(){
            $result = $this->md->masterlayanan($_SESSION['orgid']);
            
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

        public function detailcomponent(){
            $result = $this->md->detailcomponent($_SESSION['orgid']);
            
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

        public function addsimulation(){

            $data['group_id']     = $_SESSION['groupid'];
            $data['org_id']       = $_SESSION['orgid'];
            $data['layan_id']     = generateuuid();
            $data['nama_layan']   = $this->input->post("modal_unit_cost_add_name");
            $data['jenis_id']     = $this->input->post("modal_unit_cost_add_kategori");
            $data['durasi']       = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_add_durasi"));
            $data['created_by']   = $_SESSION['userid'];
            $data['created_date'] = date("Y-m-d H:i:s");

            if($this->md->insertsimulation($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

	}
?>