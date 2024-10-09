<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Grouper extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelgrouper","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_grouper");
		}

		public function listkunjungan(){
            $result = $this->md->listkunjungan();
            
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

        public function kelasperawatan(){
            $type   = $this->input->post("type");
            $result = $this->md->kelasperawatan($type);
            $kelas  = "";

            foreach ($result as $a) {
                $kelas .= "<option value='" . $a->value . "'>" . $a->keterangan . "</option>";
            }

            echo $kelas;
        }

        public function claim_print(){
            $body = [];

            $nosep = $this->input->post("nosep");
            $nosep ="16120507422";
            

            $body['metadata']['method'] = "claim_printX";
            $body['data']['nomor_sep']  = $nosep;

            $reponse = Inacbg::sendata_claimprint(json_encode($body));

            echo $reponse;
        }

	}
?>