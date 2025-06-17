<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Bukudagang extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelbukudagang","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_bukudagang",$data);
		}

        public function loadcombobox(){
            $resultperiode = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periode."'>".$a->periode."</option>";
            }

            $data['periode'] = $periode;
            return $data;
		}

        public function rekapbukudagang(){
            $periode = $this->input->post("periode");
            $result = $this->md->rekapbukudagang($_SESSION['orgid'],$periode);
            
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

        public function datapiutang(){
            $parameter ="";
            $periode = $this->input->post("periodeid");
            $bukuid  = $this->input->post("bukuid");

            if($bukuid==="36547ad1-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id IN ('1','7') and rekanan_id = 'daf5e80d-fdb6-48a9-9712-ab253091dcdb'";
            }

            if($bukuid==="36547ba5-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id = '2'";
            }
            
            if($bukuid==="36547c63-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id = '3'";
            }

            if($bukuid==="36547cd1-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id = '4'";
            }

            

            if($bukuid==="36547b3e-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id IN ('1','7') and rekanan_id = '10217fa6-f8d6-4495-940e-17bad5f4c61e'";
            }

            if($bukuid==="36547a64-46d8-11f0-8318-0894effd6cc3"){
                $parameter ="and jenis_id IN ('1','7') and rekanan_id NOT IN ('10217fa6-f8d6-4495-940e-17bad5f4c61e','daf5e80d-fdb6-48a9-9712-ab253091dcdb')";
            }

            $result = $this->md->datapiutang($_SESSION['orgid'],$periode,$parameter);
            
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

        public function updatedata(){
            $bukuid     = $this->input->post("modal_buku_dagang_bukuid");
            $periodeid  = $this->input->post("modal_buku_dagang_periodeid");
            $estimasi   = $this->input->post("modal_buku_dagang_estimasi");
            $penerimaan = $this->input->post("modal_buku_dagang_penerimaan");

            $data['org_id']       = $_SESSION['orgid'];
            $data['transaksi_id'] = generateuuid();
            $data['buku_id']      = $bukuid;
            $data['periode']      = $periodeid;
            $data['estimasi']     = (int) preg_replace('/\D/', '', $estimasi);
            $data['penerimaan']   = (int) preg_replace('/\D/', '', $penerimaan);
            $data['created_by']   = $_SESSION['userid'];
            $data['created_date'] = date('Y-m-d H:i:s');

            $existing = $this->md->cekdata($_SESSION['orgid'],$bukuid,$periodeid);

            if ($existing) {
                unset($data['transaksi_id']);
                $exec = $this->md->updatebukudagang($_SESSION['orgid'],$bukuid,$periodeid,$data);
                $json['responDesc'] = "Data Updated Successfully";
            } else {
                $exec = $this->md->insertbukudagang($data);
                $json['responDesc'] = "Data Added Successfully";
            }

            if($exec){
                $json['responCode'] = "00";
                $json['responHead'] = "success";
            } else {
                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = "Data Failed to Save";
            }

            echo json_encode($json);
        }
		

	}
?>