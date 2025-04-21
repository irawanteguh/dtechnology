<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Quickreport extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelsb","md");
        }

		public function index(){
			$data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_quickreport",$data);
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

		public function databulan(){
			$tahun = $this->input->post("periode");
            $result = $this->md->databulan($tahun);
            
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

        public function addquickreport(){
            $orgid = $_SESSION['orgid'];
            $date  = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_quickreport_add_date"))->format("Y-m-d");

            $data['org_id']       = $orgid;
            $data['transaksi_id'] = generateuuid();
            $data['date']         = $date;
            $data['u_rj']         = preg_replace('/\D/', '', $this->input->post("URJ"));
            $data['u_ri']         = preg_replace('/\D/', '', $this->input->post("URI"));
            $data['a_rj']         = preg_replace('/\D/', '', $this->input->post("ARJ"));
            $data['a_ri']         = preg_replace('/\D/', '', $this->input->post("ARI"));
            $data['b_rj']         = preg_replace('/\D/', '', $this->input->post("BRJ"));
            $data['b_ri']         = preg_replace('/\D/', '', $this->input->post("BRI"));
            $data['lain']         = preg_replace('/\D/', '', $this->input->post("LAIN"));

            $existing = $this->md->cekdata($orgid, $date);

            if ($existing) {
                unset($data['transaksi_id']);
                $exec = $this->md->updatequickreport($orgid, $date, $data);
                $json['responDesc'] = "Data Updated Successfully";
            } else {
                $exec = $this->md->insertquickreport($data);
                $json['responDesc'] = "Data Added Successfully";
            }
        
            if ($exec) {
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