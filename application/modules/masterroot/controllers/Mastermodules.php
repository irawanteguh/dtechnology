<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Mastermodules extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelmastermodules","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_mastermodules",$data);
		}

        public function loadcombobox(){
            $resultmodulesheader= $this->md->modulesheader();
            $modulesheader="";
            foreach($resultmodulesheader as $a ){
                $modulesheader.="<option value='".$a->modules_id."'>".$a->modules_name."</option>";
            }

            $resultmodulesstatus= $this->md->modulesstatus();
            $modulesstatus="";
            foreach($resultmodulesstatus as $a ){
                $modulesstatus.="<option value='".$a->id."'>".$a->status."</option>";
            }

            $resultparent= $this->md->parent();
            $parent="";
            foreach($resultparent as $a ){
                $parent.="<option value='".$a->id."'>".$a->keterangan."</option>";
            }

            
            $data['modulesheader'] = $modulesheader;
            $data['modulesstatus'] = $modulesstatus;
            $data['parent']        = $parent;

            return $data;
		}

		public function masterapps(){ 
            $result = $this->md->masterapps();
            
            if(!empty($result)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="We Get The Data You Want";
                $json['responResult']=$result;
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function editmastermodules(){
            $data['status']            = $this->input->post("modulesstatus-edit");
            $data['modules_header_id'] = $this->input->post("modulesheader-edit");
            $data['modules_name']      = $this->input->post("modulesname-edit");
            $data['version']           = $this->input->post("modulesversion-edit");
            $data['parent']            = $this->input->post("modulesparent-edit");
            $data['package']           = $this->input->post("modulespackage-edit");
            $data['def_controller']    = $this->input->post("modulescontrollers-edit");
            $data['icon']              = $this->input->post("modulesicon-edit");

            if($this->md->updatemasterapps($this->input->post("modulesid-edit"),$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Edit Modules Berhasil";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Edit Modules Gagal";
            }

            echo json_encode($json);
        }

        public function hapusmastermodules(){
            $modulesid      = $this->input->post("modulesid-hapus");
            $data['active'] = '0';

            if($this->md->updatemasterapps($modulesid,$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Hapus Modules Berhasil";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Hapus Modules Gagal";
            
            }

            echo json_encode($json);
        }

        public function hidemastermodules(){
            $modulesid     = $this->input->post("modulesid-hide");
            $data['active'] = '9';

            if($this->md->updatemasterapps($modulesid,$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Hide Modules Berhasil";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Hide Modules Gagal";
            
            }

            echo json_encode($json);
        }

        public function unhidemastermodules(){
            $modulesid     = $this->input->post("modulesid-unhide");
            $data['active'] = '1';

            if($this->md->updatemasterapps($modulesid,$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Un Hide Modules Berhasil";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Un Hide Modules Gagal";
            
            }

            echo json_encode($json);
        }

	}
?>