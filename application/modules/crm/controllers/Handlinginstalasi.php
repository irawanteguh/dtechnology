<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Handlinginstalasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelhandlinginstalasi","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_handlinginstalasi");
		}

        public function datahandling(){
            $status    = "and a.status<>'0' and   a.department_id in (select department_id from dt01_gen_department_ms where org_id=a.org_id and active='1' and user_id='".$_SESSION['userid']."')";
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

        public function answer(){
            $data['answer_instalasi'] = $this->input->post("modal_handlinginstlasi_tindaklanjut_answer");
            
            if($this->md->updatesaran($data,$this->input->post("modal_handlinginstlasi_tindaklanjut_transid"))){
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

            if($this->input->post("datastatus")==="2"){

                $text  = "*".$this->input->post("dataorgname")."*";
                $text .= "%0a*RMB Hospital Group*";
                $text .= "%0a%0aKepada Yth,.";
                $text .= "%0aManager";
                $text .= "%0a*".$this->input->post("datanamapicmanager")."*%0a";
                $text .= "%0aMohon konfirmasi tindaklanjuti jawaban dari instalasi";
                $text .= "%0a%0aAtasnama%09%09: ".$this->input->post("datanamapasien")."";
                $text .= "%0aKode Laporan%09%09: `".$this->input->post("datacodelaporan")."`";
                $text .= "%0aSaran dan Masukan%09: ";
                $text .= "%0a_".$this->input->post("datasaran")."_";
                $text .= "%0a%0aTindaklanjut Unit%09%09: ";
                $text .= "%0a_".$this->input->post("datajawaban")."_";
                $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $_SESSION['orgid'],
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => $this->input->post("datadeviceid"),
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $this->input->post("datannohppicmanager"))),
                    'ref_id'       => $this->input->post("datatransid"),
                    'type_file'    => '0',
                    'catatan'      => 'CRM [INSTALASI]',
                    'created_by'   => $_SESSION['userid']
                ]);

                $data['datetime_fwd_manager'] = date("Y-m-d H:i:s");
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

        public function uploadbukti() {
            $transid = $_GET['transid'];

            // Ambil ekstensi file dari $_FILES
            $original_filename = $_FILES['file']['name'];
            $extension = pathinfo($original_filename, PATHINFO_EXTENSION); // contoh: pdf, jpg, png, etc.

            // Bangun nama file dengan ekstensi
            $filename_with_ext = $transid . '.' . $extension;

            $config['upload_path']   = './assets/buktitl/';
            $config['allowed_types'] = '*';
            $config['file_name']     = $filename_with_ext;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $data['bukti_tl']         = "1";
                $data['filename_buktitl'] = $filename_with_ext;

                $this->md->updatesaran($data,$transid);

                echo json_encode([
                    'status'   => true,
                    'message'  => 'Upload Success',
                    'filename' => $filename_with_ext
                ]);
            }
        }

	}
?>