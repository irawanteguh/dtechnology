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

            $document="";
            foreach($resultmasterdocument as $a ){
                $document.="<option value='".$a->jenis_doc."'>".$a->document_name."</option>";
            }

            $data['document'] = $document;
            return $data;
		}

        public function masterassign(){
            $result = $this->md->userassign($_SESSION['orgid']);
            
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

		public function datarepository(){
            $parameter ="and a.org_id='".$_SESSION['orgid']."'";
            $result = $this->md->datarepository($parameter);
            
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

		public function signdocument() {
            $type    = $this->input->post("modal_sign_add_document_type");
            $assign  = json_decode($this->input->post("modal_sign_add_assign"),true);
            $info1   = $this->input->post("modal_sign_add_informasi1");
            $info2   = $this->input->post("modal_sign_add_informasi2");
            $transid = generateuuid();

            $data['org_id']     = $_SESSION['orgid'];
            $data['no_file']    = $transid;
            $data['jenis_doc']  = $type;
            $data['note_1']     = $info1;
            $data['note_2']     = $info2;
            $data['type']       = count($assign) == 1 ? 'S' : 'B';
            $data['location']   = "DTECHNOLOGY";
            $data['created_by'] = $_SESSION['userid'];
        
            if(!empty($assign)){
                if($this->md->insertsigndocument($data)){
        
                    $order = 0; 
                    foreach ($assign as $a) {
                        $assignValue = $a['value'];
                        list($name, $nik) = explode(' - ', $assignValue);
    
                        $name = trim($name);
                        $nik  = trim($nik);
        
                        $dataassign['org_id']     = $_SESSION['orgid'];
                        $dataassign['type']       = "E";
                        $dataassign['nik']        = $nik;
                        $dataassign['tag']        = $nik;
                        $dataassign['no_file']    = $transid;
                        $dataassign['order']      = $order+1;
                        $dataassign['created_by'] = $_SESSION['userid'];
        
                        $this->md->insertsigndocumentassign($dataassign);

                        $order++;
                    }
            
                    $json['responCode'] = "00";
                    $json['responHead'] = "success";
                    $json['responDesc'] = "Data Added Successfully";
                }else{
                    $json['responCode'] = "01";
                    $json['responHead'] = "info";
                    $json['responDesc'] = "Data Failed to Add";
                }
            }else{
                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = "Please Select Assigner";
            }
            
        
            echo json_encode($json);
        }
        
		public function uploadfile(){
			$nofile  = $_GET['nofile'];

            $config['upload_path']   = './assets/document/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $nofile;
            $config['overwrite']     = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                log_message('error', 'File upload error: ' . implode(' ', $error));

                $json["responCode"]="01";
                $json["responHead"]="error";
                $json["responDesc"]=json_encode($error);
            }else{
                $upload_data = $this->upload->data();

                $data['status']="1";
                $this->md->updatefile($data,$nofile);
                
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Upload File Success";
            }

            echo json_encode($json);

        }
	}

?>