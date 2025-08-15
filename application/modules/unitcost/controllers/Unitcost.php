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
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);
            
            $masterkategori="";
            foreach($resultmasterkategori as $a ){
                $masterkategori.="<option value='".$a->code."'>".$a->master_name."</option>";
            }


            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['masterkategori']     = $masterkategori;
            $data['masterorganization'] = $masterorganization;
            return $data;
		}

        public function masterlayanan(){
            $orgid  = $this->input->post("orgid");
            $result = $this->md->masterlayanan($orgid);
            
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

        public function mastersdm(){
            $result = $this->md->mastersdm($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function masterobat(){
            $result = $this->md->masterobat($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function masteratk(){
            $result = $this->md->masteratk($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function mastersarana(){
            $result = $this->md->mastersarana($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function masteralkes(){
            $result = $this->md->masteralkes($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function masternonalkes(){
            $result = $this->md->masternonalkes($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function masterrumahtangga(){
            $result = $this->md->masterrumahtangga($_SESSION['orgid'],$this->input->post("layanid"));
            
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

        public function mastersoftware(){
            $result = $this->md->mastersoftware($_SESSION['orgid'],$this->input->post("layanid"));
            
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
            $result = $this->md->detailcomponent($_SESSION['orgid'],$this->input->post("layanid"));
            
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
            $data['com_1']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_add_com1"));
            $data['com_2']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_add_com2"));
            $data['com_3']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_add_com3"));
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

        public function editsimulation(){

            if($this->input->post("modal_unit_cost_edit_type")==="1"){
                $data['group_id']     = $_SESSION['groupid'];
                $data['org_id']       = $_SESSION['orgid'];
                $data['layan_id']     = generateuuid();
                $data['layan_id_rs']  = $this->input->post("modal_unit_cost_edit_layanid");
                $data['nama_layan']   = $this->input->post("modal_unit_cost_edit_name");
                $data['jenis_id']     = $this->input->post("modal_unit_cost_edit_kategori");
                $data['durasi']       = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_durasi"));
                $data['com_1']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com1"));
                $data['com_2']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com2"));
                $data['com_3']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com3"));
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
            }else{
                $data['nama_layan']   = $this->input->post("modal_unit_cost_edit_name");
                $data['jenis_id']     = $this->input->post("modal_unit_cost_edit_kategori");
                $data['durasi']       = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_durasi"));
                $data['com_1']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com1"));
                $data['com_2']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com2"));
                $data['com_3']        = (int) preg_replace('/\D/', '', $this->input->post("modal_unit_cost_edit_com3"));

                if($this->md->updatesimulation($_SESSION['orgid'],$this->input->post("modal_unit_cost_edit_layanid"),$data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Updated Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Updated";
                }
            }
            

            echo json_encode($json);
        }

        public function updatesdm(){
            $layanid    = $this->input->post('layanid');
            $positionid = $this->input->post('positionid');
            $jml        = $this->input->post('jml');

            if(empty($this->md->cekdatasdm($_SESSION['orgid'],$layanid,$positionid))){
                if($jml != 0){
                    $data['org_id']         = $_SESSION['orgid'];
                    $data['transaksi_id']   = generateuuid();
                    $data['layan_id']       = $layanid;
                    $data['position_id']    = $positionid;
                    $data['jml']            = $jml;
                    $data['jenis_id']       = "2";
                    $data['created_by']     = $_SESSION['userid'];
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->insertcomponent($data)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Add";
                    }
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }else{
                if($jml != 0){
                    $data['jml']            = $jml;
                    $data['active']         = "1";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentsdm($data,$_SESSION['orgid'],$layanid,$positionid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }else{
                    $data['jml']            = $jml;
                    $data['active']         = "0";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentsdm($data,$_SESSION['orgid'],$layanid,$positionid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }
            }
            
            echo json_encode($json);
        }

        public function updatefarmasi(){
            $layanid  = $this->input->post('layanid');
            $barangid = $this->input->post('barangid');
            $jml      = $this->input->post('jml');

            if(empty($this->md->cekdatafarmasi($_SESSION['orgid'],$layanid,$barangid))){
                if($jml != 0){
                    $data['org_id']         = $_SESSION['orgid'];
                    $data['transaksi_id']   = generateuuid();
                    $data['layan_id']       = $layanid;
                    $data['barang_id']      = $barangid;
                    $data['jml']            = $jml;
                    $data['jenis_id']       = "4";
                    $data['created_by']     = $_SESSION['userid'];
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->insertcomponent($data)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Add";
                    }
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }else{
                if($jml != 0){
                    $data['jml']            = $jml;
                    $data['active']         = "1";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentfarmasi($data,$_SESSION['orgid'],$layanid,$barangid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }else{
                    $data['jml']            = $jml;
                    $data['active']         = "0";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentfarmasi($data,$_SESSION['orgid'],$layanid,$barangid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }
            }
            
            echo json_encode($json);
        }

        public function updatedataassets(){
            $layanid      = $this->input->post('layanid');
            $dataassetsid = $this->input->post('dataassetsid');
            $datastatus   = $this->input->post('datastatus');

            if(empty($this->md->cekdataassets($_SESSION['orgid'],$layanid,$dataassetsid))){
                if($datastatus === "1"){
                    $data['org_id']         = $_SESSION['orgid'];
                    $data['transaksi_id']   = generateuuid();
                    $data['layan_id']       = $layanid;
                    $data['assets_id']      = $dataassetsid;
                    $data['jenis_id']       = "1";
                    $data['active']         = $datastatus;
                    $data['created_by']     = $_SESSION['userid'];
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->insertcomponent($data)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Add";
                    }
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }else{
                if($datastatus === "1"){
                    $data['active']         = $datastatus;
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentassets($data,$_SESSION['orgid'],$layanid,$dataassetsid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }else{
                    $data['active']         = $datastatus;
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentassets($data,$_SESSION['orgid'],$layanid,$dataassetsid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }
            }
            
            echo json_encode($json);
        }

        public function updatecomponent(){
            $layanid     = $this->input->post('layanid');
            $componentid = $this->input->post('componentid');
            $jml         = $this->input->post('jml');

            if(empty($this->md->cekdatacomponent($_SESSION['orgid'],$layanid,$componentid))){
                if($jml != 0){
                    $data['org_id']       = $_SESSION['orgid'];
                    $data['transaksi_id'] = generateuuid();
                    $data['layan_id']     = $layanid;
                    $data['component_id'] = $componentid;
                    $data['jml']          = $jml;
                    $data['jenis_id']     = "3";
                    $data['created_by']   = $_SESSION['userid'];

                    if($this->md->insertcomponent($data)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Add";
                    }
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }else{
                if($jml != 0){
                    $data['jml']            = $jml;
                    $data['active']         = "1";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentrumahtangga($data,$_SESSION['orgid'],$layanid,$componentid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }else{
                    $data['jml']            = $jml;
                    $data['active']         = "0";
                    $data['last_update_by'] = $_SESSION['userid'];

                    if($this->md->updatecomponentrumahtangga($data,$_SESSION['orgid'],$layanid,$componentid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Update Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data Failed to Update";
                    }
                }
            }
            
            echo json_encode($json);
        }

	}
?>