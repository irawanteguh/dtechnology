<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Handling extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelhandling","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_handling",$data);
		}

        public function loadcombobox(){
            $resultmasterdepartment   = $this->md->masterdepartment();
    
            $department   = "";
            $organization = "";
            $poliklinik   = "";
            $masterdoctor = "";

            foreach ($resultmasterdepartment as $a) {
                $department .= "<option value='" . $a->department_id . "'>" . $a->department . "</option>";
            }

           
            $data['department']   = $department;
            return $data;
        }

        public function datahandling(){
            $result = $this->md->datahandling($_SESSION['orgid']);
            
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

        public function updatedepartment(){
            $data['department_id'] = $this->input->post("modal_handling_update_department_departmentid");
            
            if($this->md->updatesaran($data,$this->input->post("modal_handling_update_department_transid"))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

        public function updatesaran(){
            $data['status'] = $this->input->post("datastatus");

            if($this->input->post("datastatus")==="1"){

                $text  = "*".$this->input->post("dataorgname")."*";
                $text .= "%0a*RMB Hospital Group*";
                $text .= "%0a%0aKepada Yth,.";
                $text .= "%0a*".$this->input->post("datanamapic")."*%0a";
                $text .= "%0aMohon tindaklanjuti saran dan masukan";
                $text .= "%0a%0aAtasnama%09%09: ".$this->input->post("datanamapasien")."";
                $text .= "%0aKode Laporan%09%09: ".$this->input->post("datacodelaporan")."";
                $text .= "%0aSaran dan Masukan%09: ";
                $text .= "%0a_".$this->input->post("datasaran")."_";
                $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $_SESSION['orgid'],
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => '1234',
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $this->input->post("datanohppic"))),
                    'ref_id'       => $this->input->post("datatransid"),
                    'type_file'    => '0'
                ]);

                $data['datetime_fwd_department'] = date("Y-m-d H:i:s");
            }
            
            if($this->md->updatesaran($data,$this->input->post("datatransid"))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

	}
?>