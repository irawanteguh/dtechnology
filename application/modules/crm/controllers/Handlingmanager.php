<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Handlingmanager extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelhandlingmanager","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_handlingmanager");
		}

        public function datahandling(){
            $status    = "and a.status='2'
                          and a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )";
            $result = $this->md->datahandling($_SESSION['orgid'],$status);
            
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

        public function updatesaran(){
            $data['status'] = $this->input->post("datastatus");

            if($this->input->post("datastatus")==="3"){

                $text  = "*".$this->input->post("dataorgname")."*";
                $text .= "%0a*RMB Hospital Group*";
                $text .= "%0a%0aKepada Yth,.";
                $text .= "%0aKepala Unit / Department Marketing";
                $text .= "%0a*".$this->input->post("dataorgnamemarketing")."*%0a";
                $text .= "%0aSaran dan masukan";
                $text .= "%0a%0aAtasnama%09%09: ".$this->input->post("datanamapasien")."";
                $text .= "%0aKode Laporan%09: `".$this->input->post("datacodelaporan")."`";
                $text .= "%0aSudah Disetujui Manager, mohon ditindaklanjuti";
                $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $_SESSION['orgid'],
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => $this->input->post("datadeviceid"),
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $this->input->post("datanohppic"))),
                    'ref_id'       => $this->input->post("datatransid"),
                    'type_file'    => '0',
                    'catatan'      => 'CRM [MANAGER]',
                    'created_by'   => $_SESSION['userid']
                ]);

                $data['datetime_fwd_marketing'] = date("Y-m-d H:i:s");
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