<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Overview extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeloverview","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_overview");
		}
        
		public function dataeticket(){
            $result = $this->md->dataeticket($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = "We Get The Data You Want";
				$json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function gettransid(){
            
			$json["responCode"]   = "00";
            $json["responHead"]   = "success";
            $json["responDesc"]   = "We Get The Data You Want";
            $json['responResult'] = generateuuid();

            echo json_encode($json);
        }

        public function neweticket(){
            $data['org_id']        = $_SESSION['orgid'];
            $data['department_id'] = $this->md->cekdepartmentid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
            $data['trans_id']      = $this->input->post("modal_new_eticket_transid");
            $data['subject']       = $this->input->post("modal_new_eticket_subject");
            $data['description']   = $this->input->post("modal_new_eticket_description");
            $data['created_by']    = $_SESSION['userid'];

            $resultcekdataeticket = $this->md->cekdataeticket($_SESSION['orgid'],$this->input->post("modal_new_eticket_transid"));

            if(empty($resultcekdataeticket)){
                if($this->md->inserteticket($data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Berhasil Di Tambah";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Gagal Di Tambah";
                }
            }else{
                if($this->md->updateeticket($this->input->post("modal_new_eticket_transid"),$data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Berhasil Di Tambah";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Gagal Di Tambah";
                }
            }
            
            echo json_encode($json);
        }

        public function uploaddocument(){
            $transid= $_GET['transid'];

            $config['upload_path']   = './assets/documentsupport/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();

                $resultcekdataeticket = $this->md->cekdataeticket($_SESSION['orgid'],$transid);

                if(empty($resultcekdataeticket)){
                    $data['org_id']        = $_SESSION['orgid'];
                    $data['department_id'] = $this->md->cekdepartmentid($_SESSION['orgid'],$_SESSION['userid'])->department_id;
                    $data['trans_id']      = $transid;
                    $data['attachment']    = "1";
                    $data['created_by']    = $_SESSION['userid'];

                    $this->md->inserteticket($data);
                }else{

                }

                echo "Upload Success";
            }

        }

	}
?>