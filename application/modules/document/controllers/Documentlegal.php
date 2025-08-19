<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Documentlegal extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeldocumentlegal","md");
        }

		public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_documentlegalcalendar",$data);
        }

        public function loadcombobox(){
            $resultmasterdocument = $this->md->masterdocument();

            $document="";
            foreach($resultmasterdocument as $a ){
                $document.="<option value='".$a->jenis_doc."'>".$a->document_name."</option>";
            }

            $data['document']       = $document;
            return $data;
		}

        public function adddocumentlegal(){
            $transid = generateuuid();

            $config['upload_path']   = './assets/documentlegal/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('modal_repository_add_file')) {
                $error_message = strip_tags($this->upload->display_errors());

                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            } else {
                $data['org_id']       = $_SESSION['orgid'];
                $data['transaksi_id'] = $transid;
                $data['jenis_doc']    = $this->input->post("modal_repository_add_type") ?: null;
                $data['judul']        = $this->input->post("modal_repository_add_name") ?: null;
                $data['keterangan']   = $this->input->post("modal_repository_add_catatan") ?: null;
                $data['date_Active']  = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_repository_add_datestart"))->format("Y-m-d");
                $data['exp_date']     = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_repository_add_dateend"))->format("Y-m-d");
                $data['created_by']   = $_SESSION['userid'];

                if($this->md->insertdocument($data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }

            echo json_encode($json);
        }

        public function documentlegal(){
            $result = $this->md->documentlegal($_SESSION['orgid']);
            
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

        public function calender(){
            $result = $this->md->calender($_SESSION['orgid']);
            $events = array();

            foreach ($result as $a) {

                $data['transid']        = $a->transaksi_id;
                $data['title']          = $a->jenisdocument;
                $data['start']          = $a->berlakumulai;
                $data['end']            = $a->sampaidengan;
                
                if($a->jenisid === "1"){
                    $data['color']     = '#0d6efd';
                }

                if($a->jenisid === "2"){
                    $data['color']     = '#ffc107';
                }

                if($a->jenisid === "3"){
                    $data['color']     = '#dc3545';
                }

                
                $events[] = $data;
            };

            echo json_encode($events);
        }

	}
?>