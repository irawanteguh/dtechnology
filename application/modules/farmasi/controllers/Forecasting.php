<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Forecasting extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelforecasting","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_forecasting",$data);
		}

        public function loadcombobox(){
            $resultperiode      = $this->md->periode();

            $periode="";
            foreach($resultperiode as $a ){
                $periode.="<option value='".$a->periodeid."'>".$a->keterangan."</option>";
            }

            $data['periode']      = $periode;
            return $data;
		}

        public function forecasting(){
            $periode = $this->input->post("periode");
            $bulan = explode(";", $periode);

            // Pastikan ada 4 bulan
            $bulan1 = isset($bulan[0]) ? trim($bulan[0]) : null;
            $bulan2 = isset($bulan[1]) ? trim($bulan[1]) : null;
            $bulan3 = isset($bulan[2]) ? trim($bulan[2]) : null;
            $bulan4 = isset($bulan[3]) ? trim($bulan[3]) : null;

            // Jika perlu kirim ke model
            $result = $this->md->forecasting($bulan1, $bulan2, $bulan3, $bulan4);
            
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