<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Daily extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeldaily","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_daily",$data);
		}

        public function loadcombobox(){
            $resultprovider = $this->md->provider();

            $provider="";
            foreach($resultprovider as $a ){
                $provider.="<option value='".$a->kd_pj."'>".$a->png_jawab."</option>";
            }

            $data['provider'] = $provider;
            
            return $data;
		}

        public function billing(){
            $periode  = "";
            $provider = "";
            $provider    = $this->input->post("provider");
            $typeperiode = $this->input->post("typeperiode");
            

            if($provider === "X"){
                $provider ="";
            }else{
                $provider ="and kd_pj='".$provider."'";
            }

            if($typeperiode === "Y"){
                $periode ="and tgl_registrasi= CURDATE()";
            }else{
                $dateperiode = DateTime::createFromFormat("d.m.Y", $this->input->post("dateperiode"))->format("d.m.Y");
                $periode ="and date_format(a.tgl_registrasi, '%d.%m.%Y')='".$dateperiode."'";
            }

            $result = $this->md->billing($provider,$periode);
            
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

        public function billing_ranap(){
            $result = $this->md->billing_ranap();
            
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

        public function billing_bpjs(){
            $result = $this->md->billing_bpjs();
            
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

        public function rozi(){
            $result = $this->md->rozi();
            
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