<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Repodocument extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelrepodocument","md");
        }

		public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_repodocument",$data);
		}

        public function loadcombobox(){
            $resultmasterdocument = $this->md->masterdocument($_SESSION['orgid']);
            $resultuserassign     = $this->md->userassign($_SESSION['orgid']);
            $resultpositionsigner     = $this->md->positionsigner();

            $document="";
            foreach($resultmasterdocument as $a ){
                $document.="<option value='".$a->jenis_doc."'>".$a->document_name."</option>";
            }

            $assign="";
            foreach($resultuserassign as $a ){
                $assign.="<option value='".$a->nik."'>".$a->name."</option>";
            }

            $positionsigner="";
            foreach($resultpositionsigner as $a ){
                $positionsigner.="<option value='".$a->id."'>".$a->position."</option>";
            }


            $data['document']       = $document;
            $data['assign']         = $assign;
            $data['positionsigner'] = $positionsigner;
            return $data;
		}

		public function dataupload(){
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");
            $resultcheckroleaccess = $this->md->checkroleaccess($_SESSION['orgid'],$_SESSION['userid']);

            if(!empty($resultcheckroleaccess)){
                $parameter ="and a.org_id='".$_SESSION['orgid']."'";
            }else{
                $parameter ="
                                and a.org_id='".$_SESSION['orgid']."'
                                and a.assign='".$_SESSION['username']."'
                                or  a.created_by='".$_SESSION['userid']."'
                                or  a.created_by in (select user_id from dt01_gen_user_asst_dt where active='1' and asst_id='".$_SESSION['userid']."')
                                or  a.assign in (select nik from dt01_gen_user_data where active='1' and user_id in (select user_id from dt01_gen_user_asst_dt where active='1' and asst_id='".$_SESSION['userid']."'))
                            ";
            }

            if($startDate===null){
                $startDate = $startDate = date('Y-m-d');
            }

            if($endDate===null){
                $endDate = $endDate = date('Y-m-d');
            }

            $result = $this->md->dataupload($parameter,$startDate,$endDate);
            
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

        public function signdocument(){
            $type     = $this->input->post("modal_sign_add_document_type");
            $assign   = $this->input->post("modal_sign_add_assign");
            $info1    = $this->input->post("modal_sign_add_informasi1");
            $info2    = $this->input->post("modal_sign_add_informasi2");
            $position = $this->input->post("modal_sign_add_position");

            $data['org_id']        = $_SESSION['orgid'];
            $data['no_file']       = generateuuid()."_".$position;
            $data['status_file']   = "0";
            $data['jenis_doc']     = $type;
            $data['assign']        = $assign;
            $data['pasien_idx']    = $info1;
            $data['transaksi_idx'] = $info2;
            $data['source_file']   = "DTECHNOLOGY";
            $data['created_by']    = $_SESSION['userid'];

            if($this->md->insertsigndocument($data)){
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

        public function uploadfile(){
            $nofile = $_GET['nofile'];

            $config['upload_path']   = './assets/document/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $nofile;
            $config['overwrite']     = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();

                $data['STATUS_FILE']="1";
                $data['SOURCE_FILE']="DTECHNOLOGY";
                $this->md->updatefile($data, $nofile);

                echo "Upload Success";
            }

        }

	}

?>