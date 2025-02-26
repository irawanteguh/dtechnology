<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Mastersuppliers extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmastersuppliers", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_mastersuppliers");
        }

        public function mastersuppliers(){
            $result = $this->md->mastersuppliers($_SESSION['orgid']);
            
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
        
        public function nonactive(){
            $supplierid = $this->input->post("supplierid");
            $data['active'] = "0";

            if($this->md->updatesupplier($data,$supplierid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }

        public function addsuppliers(){
            $suppliers = $this->input->post('modal_new_suppliers');

            $data['org_id']      = $_SESSION['orgid'];
            $data['supplier_id'] = generateuuid();
            $data['supplier']    = $suppliers;
            $data['created_by']  = $_SESSION['userid'];

            if($this->md->insertsuppliers($data)){
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
    }
?>