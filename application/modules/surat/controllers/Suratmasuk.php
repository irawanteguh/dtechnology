<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Suratmasuk extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelsuratmasuk","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_suratmasuk",$data);
		}

        public function loadcombobox(){
            $resultasalsurat = $this->md->asalsurat();
            $resultpengirimsurat = $this->md->pengirimsurat($_SESSION['orgid']);

            $asalsurat="";
            foreach($resultasalsurat as $a ){
                $asalsurat.="<option value='".$a->kode."'>".$a->keterangan."</option>";
            }

            $pengirimsurat="";
            foreach($resultpengirimsurat as $a ){
                $pengirimsurat.="<option value='".$a->pengirimid."'>".$a->keterangan."</option>";
            }

            $data['asalsurat']     = $asalsurat;
            $data['pengirimsurat'] = $pengirimsurat;
            return $data;
        }

        public function insertsuratmasuk(){
            $transid = generateuuid();

            $config['upload_path']   = './assets/suratmasuk/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('modal_suratmasuk_add_file')) {
                $error_message = strip_tags($this->upload->display_errors());

                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            } else {
                $data['group_id']            = $_SESSION['groupid'];
                $data['org_id']              = $_SESSION['orgid'];
                $data['trans_id']            = $transid;
                $data['no_urut']             = $this->input->post("modal_suratmasuk_add_nourut") ?: null;
                $data['no_agenda']           = $this->input->post("modal_suratmasuk_add_noagenda") ?: null;
                $data['kode_surat']          = $this->input->post("modal_suratmasuk_add_kodesurat") ?: null;
                $data['tanggal_surat']       = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_suratmasuk_add_tglmasuk"))->format("Y-m-d");
                $data['nomor_surat']         = $this->input->post("modal_suratmasuk_add_nosurat") ?: null;
                $data['tanggal_masuk_surat'] = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_suratmasuk_add_tglsurat"))->format("Y-m-d");
                $data['asal_surat']          = $this->input->post("modal_suratmasuk_add_asalsurat") ?: null;

                if($this->input->post("modal_suratmasuk_add_asalsurat")==="E"){
                    $data['dari_text'] = $this->input->post("modal_suratmasuk_add_pengirimsurat_txt") ?: null;
                }else{
                    $data['dari_id'] = $this->input->post("modal_suratmasuk_add_pengirimsurat_id") ?: null;
                }

                $data['perihal']    = $this->input->post("modal_suratmasuk_add_perihal") ?: null;
                $data['ringkasan']  = $this->input->post("modal_suratmasuk_add_ringkasan") ?: null;
                $data['created_by'] = $_SESSION['userid'];


                $parameter = "and a.org_id in ('d843b43e-158e-45ce-8f68-795ae1e218d0','".$_SESSION['orgid']."')";
                $resultdisposisi = $this->md->disposisi($parameter);

                foreach ($resultdisposisi as $a) {
                    $datadisposisi['group_id']           = $_SESSION['groupid'];
                    $datadisposisi['org_id']             = $_SESSION['orgid'];
                    $datadisposisi['transaksi_id']       = generateuuid();
                    $datadisposisi['surat_id']           = $transid;
                    $datadisposisi['from_org_id']        = $_SESSION['orgid'];
                    $datadisposisi['from_department_id'] = $_SESSION['departmentid'];
                    $datadisposisi['from_user_id']       = $_SESSION['userid'];
                    $datadisposisi['from_datetime']      = date("Y-m-d H:i:s");
                    $datadisposisi['to_org_id']          = $a->org_id;
                    $datadisposisi['to_department_id']   = $a->department_id;
                    $datadisposisi['to_user_id']         = $a->user_id;

                    $this->md->insertdisposisi($datadisposisi);
                }

                if($this->md->insertsuratmasuk($data)){
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


        public function suratmasuk(){
            $result = $this->md->suratmasuk($_SESSION['orgid']);
            
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
        
        
	}
?>