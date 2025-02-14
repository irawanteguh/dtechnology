<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Listassets extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("modellistassets","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_listassets",$data);
		}

        public function loadcombobox(){
            $resultmasterbarang = $this->md->masterbarang($_SESSION['orgid']);

            $masterbarang="";
            foreach($resultmasterbarang as $a ){
                $masterbarang.="<option value='".$a->barang_id."'>".$a->nama_barang."</option>";
            }

            $data['masterbarang']   = $masterbarang;
            return $data;
		}

        public function insertassets(){

            $data['org_id']        = $_SESSION['orgid'];
            $data['trans_id']      = generateuuid();
            $data['barang_id']     = $this->input->post("modal_assets_add_barangid");
            $data['serial_number'] = $this->input->post("modal_assets_add_sn");
            $data['note']          = $this->input->post("modal_assets_add_spek");
            $data['created_by']    = $_SESSION['userid'];
            $data['created_date']  = date("Y-m-d H:i:s");

            if($this->md->insertassets($data)){
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

        public function masterassets(){
            $result = $this->md->masterassets($_SESSION['orgid']);
            
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