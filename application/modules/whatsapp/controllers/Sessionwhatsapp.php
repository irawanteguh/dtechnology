<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sessionwhatsapp extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelsessionwhatsapp","md");
        }

		public function index(){
			$data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_sessionwhatsapp",$data);
		}
		public function loadcombobox(){
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);


            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['masterorganization'] = $masterorganization;
            return $data;
        }

		public function masterdevice(){
			$orgid = $this->input->post("orgid");
            $result = $this->md->masterdevice($orgid);
            
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

		public function updatedevice() {
			header('Content-Type: application/json');

			$json = json_decode(file_get_contents("php://input"), true);

			if (!$json) {
				echo json_encode(["status" => false, "message" => "Invalid JSON"]);
				return;
			}

			$data = [
				"device_id"     => $json["device_id"] ?? null,
				"device_name"   => $json["device_name"] ?? null,
				"phone"         => $json["phone"] ?? null,
				"status"        => $json["status"] ?? null
			];

			$transaksi_id = $json["transaksi_id"] ?? null;

			if (!$transaksi_id) {
				echo json_encode(["status" => false, "message" => "Missing transaksi_id"]);
				return;
			}

			$this->load->model("Modelsessionwhatsapp");
			$success = $this->Modelsessionwhatsapp->updatedevice($data, $transaksi_id);

			if ($success) {
				echo json_encode(["status" => true, "message" => "Device updated"]);
			} else {
				echo json_encode(["status" => false, "message" => "Failed to update"]);
			}
		}
        
		public function adddevice(){
			$data['org_id']       = $_SESSION['orgid'];
			$data['transaksi_id'] = generateuuid();
			$data['device_id']    = generateUniqueNumber();
			$data['device_name']  = $this->input->post("modal_whatsapp_add_name");

            if($this->md->insertdevice($data)){
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
	}

?>