<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Groupactivity extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelgroupactivity","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_groupactivity");
		}

        public function daftarjabatan(){
			$search = "";
            $result = $this->md->daftarjabatan($_SESSION['orgid'],$search);
            
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

        public function daftarkegiatan(){
            $positionid = $this->input->post("positionid");
            $result     = $this->md->daftarkegiatan($_SESSION['orgid'],$positionid);
            
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

        public function mappingactivity(){
            $switchId    = $this->input->post("switchId");
            $switchValue = $this->input->post("switchValue");
            $positionid  = $this->input->post("positionid");

            if($switchValue==="true"){
                $data['active']="1";
            }else{
                $data['active']="0";
            }

            
            $resultcheckdata =  $this->md->checkdata($positionid,$switchId);

            if(!empty($resultcheckdata)){
                $data['last_update_date']=date("Y-m-d H:i:s");
                $data['last_update_by']=$_SESSION['userid'];
                if($this->md->updatemapping($positionid,$switchId,$data)){
                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Activity Success";
                }else{
                    $json["responCode"]="01";
                    $json["responHead"]="info";
                    $json["responDesc"]="Activity Field";
                }
            }else{
                $data['org_id']           = $_SESSION['orgid'];
                $data['transaksi_id']     = generateuuid();
                $data['position_id']      = $positionid;
                $data['activity_id']      = $switchId;
                $data['created_by']       = $_SESSION['userid'];
                $data['last_update_by']   = $_SESSION['userid'];
                $data['last_update_date'] = date("Y-m-d H:i:s");

                if($this->md->insertmapping($data)){
                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Activity Success";
                }else{
                    $json["responCode"]="01";
                    $json["responHead"]="info";
                    $json["responDesc"]="Activity Field";
                }
            }

            echo json_encode($json);
        }
	}
?>