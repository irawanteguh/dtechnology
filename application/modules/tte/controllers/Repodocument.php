<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    include FCPATH."assets/vendors/phpqrcode/qrlib.php";

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
            $resultuserassign = $this->md->userassign($_SESSION['orgid']);

            $assign="";
            foreach($resultuserassign as $a ){
                $assign.="<option value='".$a->nik."'>".$a->name."</option>";
            }

            $data['assign'] = $assign;
            return $data;
		}

        public function alldocument(){
            $result = $this->md->alldocument();
            
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

        public function adddocument(){
            $directory = "";

            $assign       = $this->input->post("modal_sign_add_tilaka_assign");
            $type         = $this->input->post("modal_sign_add_tilaka_type");
            $info1        = $this->input->post("modal_sign_add_tilaka_informasi1");
            $info2        = $this->input->post("modal_sign_add_tilaka_informasi2");
            $originalname = pathinfo($_FILES['modal_sign_add_tilaka_document']['name'], PATHINFO_FILENAME);
            $transid      = generateuuid();

            if(TYPESTORAGE==="ROOT"){
                $directory ="./assets/document/";
            }
            $config['upload_path']   = $directory;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('modal_sign_add_tilaka_document')) {
                $error_message = strip_tags($this->upload->display_errors());

                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            } else {
                $uploadData = $this->upload->data();
                $filePath   = $uploadData['full_path'];

                if(!file_exists($filePath)){
                    log_message('error', 'File not found after upload: ' . $filePath);

                    $json['responCode'] = "02";
                    $json['responHead'] = "warning";
                    $json['responDesc'] = "File upload completed but not found on server.";
                    echo json_encode($json);
                    return;
                }

                $data['org_id']           = $_SESSION['orgid'];
                $data['transaksi_id']     = $transid;
                $data['no_file']          = $originalname;
                $data['jenis_doc']        = $type;
                $data['signer_id']        = $assign;
                $data['note_1']           = $info1;
                $data['note_2']           = $info2;
                $data['storage']          = TYPESTORAGE;
                $data['type_of']          = "Signature";
                $data['from_in']          = "Dtechnology";
                $data['provider_sign']    = "Tilaka";
                $data['type_certificate'] = "Psre";
                $data['quick_sign']       = "1";
                $data['created_by']       = $_SESSION['userid'];

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

        public function voiddocument(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "99";

            if($this->md->updatedocument($data,$transid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }

        public function cancelvoiddocument(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "0";

            if($this->md->updatedocument($data,$transid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data failed to update";
            }

            echo json_encode($json);
        }

        public function uploadtotilaka(){
            $data               = [];
            $responseuploadfile = [];
            $datatransaksiid    = $this->input->post("datatransaksiid");
            $datafilelocation   = $this->input->post("datafilelocation");

            if(fileExists($datafilelocation)===false){
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="File Not Exists";

                $data['status_sign'] = "98";
                $this->md->updatedocument($data,$datatransaksiid);
            }else{
                if(getFileSize($datafilelocation)===0){
                    $json['responCode']="01";
                    $json['responHead']="error";
                    $json['responDesc']="File Corrupted";

                    $data['status_sign'] = "97";
                    $this->md->updatedocument($data,$datatransaksiid);
                }else{
                    $responseuploadfile = TilakaPlus::uploadfile($datafilelocation);

                    // return var_dump($responseuploadfile);

                    if(!isset($responseuploadfile['success'])){
                        // array(4) {
                        //             ["timestamp"]=>
                        //             string(29) "2026-02-22T15:48:01.496+00:00"
                        //             ["status"]=>
                        //             int(404)
                        //             ["error"]=>
                        //             string(9) "Not Found"
                        //             ["path"]=>
                        //             string(19) "/api/v1/plus-upload"
                        //         }

                        $json['responCode']="01";
                        $json['responHead']="error";
                        $json['responDesc']=$responseuploadfile['error']." [ ".$responseuploadfile['path']." ]";
                    }else{
                        if($responseuploadfile['success']===false){

                            // array(3) {
                            //         ["success"]=>
                            //         bool(false)
                            //         ["message"]=>
                            //         string(14) "file harus pdf"
                            //         ["filename"]=>
                            //         NULL
                            //     }

                            $json['responCode']="01";
                            $json['responHead']="error";
                            $json['responDesc']=$responseuploadfile['message'];

                            $data['status_sign'] = "96";
                            $data['response']    = $responseuploadfile['message'];
                            $this->md->updatedocument($data,$datatransaksiid);
                        }else{
                            // array(3) {
                            // ["success"]=>
                            // bool(true)
                            // ["message"]=>
                            // string(26) "File uploaded successfully"
                            // ["filename"]=>
                            // string(82) "1114850e78d84070a0bf_tilaka_699b278d1a5ec_b5ef49b5-ff74-40b4-8b1b-61768bcc6d95.pdf"
                            // }

                            $json['responCode']="00";
                            $json['responHead']="success";
                            $json['responDesc']=$responseuploadfile['message'];

                            $data['status_sign'] = "1";
                            $data['filename']    = $responseuploadfile['filename'];
                            $data['response']    = $responseuploadfile['message'];
                            $this->md->updatedocument($data,$datatransaksiid);
                        }
                    }
                }
            }

            echo json_encode($json);
        }


	}

?>