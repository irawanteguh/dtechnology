<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Masterbarang extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelmasterbarang", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar", "v_masterbarang",$data);
        }

        public function loadcombobox(){
            $resulcategory = $this->md->category($_SESSION['orgid']);
            $resulclassification = $this->md->classification();
            $resulsatuan = $this->md->satuan($_SESSION['orgid']);
            
            $category="";
            foreach($resulcategory as $a ){
                $category.="<option value='".$a->jenis_id."'>".$a->jenis."</option>";
            }

            $classification="";
            foreach($resulclassification as $a ){
                $classification.="<option value='".$a->typeid."'>".$a->type."</option>";
            }

            $satuan="";
            foreach($resulsatuan as $a ){
                $satuan.="<option value='".$a->satuan_id."'>".$a->satuan."</option>";
            }


            $data['category']       = $category;
            $data['classification'] = $classification;
            $data['pu']             = $satuan;
            $data['uu']             = $satuan;
            
            return $data;
		}

        public function masterbarang(){
            $result = $this->md->masterbarang($_SESSION['orgid']);
            
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
            $barangid = $this->input->post("barangid");
            $data['active'] = "0";

            if($this->md->updatemasterbarang($data,$barangid)){
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

        public function edititem(){
            $barangid       = $this->input->post("modal_edit_itemid");
            $namabarang     = $this->input->post("modal_edit_item");
            $category       = $this->input->post("modal_edit_category");
            $classification = $this->input->post("modal_edit_classification");
            $pu             = $this->input->post("modal_edit_pu");
            $uu             = $this->input->post("modal_edit_uu");

            
            $data['nama_barang']       = $namabarang;
            $data['jenis_id']          = $category;
            $data['type']              = $classification;
            $data['satuan_beli_id']    = $pu;
            $data['satuan_pakai_id']   = $uu;
            $data['last_updated_by']   = $_SESSION['userid'];
            $data['last_updated_date'] = date("Y-m-d H:i:s");

            if($this->md->updatemasterbarang($data,$barangid)){
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

        public function additem(){
            $namabarang = $this->input->post('modal_new_item');

            $data['org_id']      = $_SESSION['orgid'];
            $data['barang_id']   = generateuuid();
            $data['nama_barang'] = $namabarang;
            $data['created_by']  = $_SESSION['userid'];

            if($this->md->insertitem($data)){
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