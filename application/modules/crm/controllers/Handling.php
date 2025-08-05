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
            $resultmasterdepartment   = $this->md->masterdepartment($_SESSION['orgid']);
    
            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);

            $department   = "";
            $masterorganization = "";

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            foreach ($resultmasterdepartment as $a) {
                $department .= "<option value='" . $a->department_id . "'>" . $a->department . "</option>";
            }

           
            $data['department']         = $department;
            $data['masterorganization'] = $masterorganization;
            return $data;
        }

        public function datahandling(){
            $orgid = $this->input->post("orgid");
            $result = $this->md->datahandling($orgid);
            
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
                $text .= "%0aKepala Unit / Department";
                $text .= "%0a*".$this->input->post("datanamapic")."*%0a";
                $text .= "%0aMohon tindaklanjuti saran dan masukan";
                $text .= "%0a%0aAtasnama%09%09: ".$this->input->post("datanamapasien")."";
                $text .= "%0aKode Laporan%09%09: `".$this->input->post("datacodelaporan")."`";
                $text .= "%0aSaran dan Masukan%09: ";
                $text .= "%0a_".$this->input->post("datasaran")."_";
                $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $_SESSION['orgid'],
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => $this->input->post("datadeviceid"),
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $this->input->post("datanohppic"))),
                    'ref_id'       => $this->input->post("datatransid"),
                    'type_file'    => '0',
                    'catatan'      => 'CRM [MARKETING]',
                    'created_by'   => $_SESSION['userid']
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

        public function response(){
            $data['response']            = $this->input->post("modal_handling_response_response");
            $data['datetime_fwd_pasien'] = date("Y-m-d H:i:s");
            $data['status']              = "4";
            
            $datasaran = $this->md->datasaran($this->input->post("modal_handling_response_transid"));

            $textUser  = "*{$datasaran[0]->nameorg}*";
            $textUser .= "%0a*RMB Hospital Group*";
            $textUser .= "%0a%0aKepada Yth,.";
            $textUser .= "%0a*{$datasaran[0]->nama}*%0a";
            $textUser .= "%0aTerima Kasih atas Masukan Anda";
            $textUser .= "%0aBerikut kami sampaikan :";
            $textUser .= "%0a_".$datasaran[0]->response."_";
            $textUser .= "%0a%0aKami menghargai kontribusi Anda dalam meningkatkan layanan kami.";
            $textUser .= "%0a%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

            $this->md->simpanboardcast([
                'org_id'       => $datasaran[0]->org_id,
                'transaksi_id' => generateuuid(),
                'body_1'       => $textUser,
                'device_id'    => '1234',
                'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $datasaran[0]->no_hp)),
                'ref_id'       => $this->input->post("modal_handling_response_transid"),
                'type_file'    => '0'
            ]);

            if($this->md->updatesaran($data,$this->input->post("modal_handling_response_transid"))){
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