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

            $full_url   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $full_url  .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $has_query  = parse_url($full_url, PHP_URL_QUERY);

            if (!empty($has_query)) {
                $datacallback['org_id']      = $_SESSION['orgid'];
                $datacallback['callback_id'] = generateuuid();
                $datacallback['url']         = $full_url;
                $datacallback['created_by']  = $_SESSION['userid'];

                $this->md->insertcallback($datacallback);
            }

            if(isset($_GET['user_identifier']) && isset($_GET['request_id']) && isset($_GET['status'])){
                if($_GET['status']==="Sukses"){
                    $data     = [];
                    $datauser = [];

                    $data['status_sign'] = "4";
                    $this->md->updatedocument($data,$_GET['request_id']);

                    redirect("tte/repodocument",$data);
                }
            }else{
                $this->template->load("template/template-sidebar","v_repodocument",$data);
            }
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

            $assign       = $this->input->post("modal_sign_add_tilaka_assign");
            $type         = $this->input->post("modal_sign_add_tilaka_type");
            $info1        = $this->input->post("modal_sign_add_tilaka_informasi1");
            $info2        = $this->input->post("modal_sign_add_tilaka_informasi2");

            $originalname = pathinfo($_FILES['modal_sign_add_tilaka_document']['name'], PATHINFO_FILENAME);
            $transid      = generateuuid();

            /*
            =================================
            UPLOAD KE TEMP
            =================================
            */

            $tempPath = FCPATH.'assets/document/temp/';

            if(!is_dir($tempPath)){
                mkdir($tempPath,0777,true);
            }

            $config['upload_path']   = $tempPath;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload('modal_sign_add_tilaka_document')) {

                $error_message = strip_tags($this->upload->display_errors());

                log_message('error','File upload error: '.$error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;

                echo json_encode($json);
                return;
            }

            $uploadData = $this->upload->data();
            $tempFile   = $uploadData['full_path'];
            $mainName   = $transid.'.pdf';

            /*
            =================================
            CEK TYPE STORAGE
            =================================
            */

            if(filter_var(TYPESTORAGE, FILTER_VALIDATE_URL)){

                /*
                =================================
                REMOTE STORAGE
                =================================
                */

                $url = rtrim(TYPESTORAGE,'/').'/receivedfile.php';

                $ch = curl_init($url);

                curl_setopt_array($ch,[
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => [
                        'file' => new CURLFile($tempFile,'application/pdf',$mainName)
                    ],
                    CURLOPT_RETURNTRANSFER => true
                ]);

                $response = curl_exec($ch);

                if(curl_errno($ch)){

                    $err = curl_error($ch);

                    curl_close($ch);

                    @unlink($tempFile);

                    $json['responCode']="01";
                    $json['responHead']="error";
                    $json['responDesc']="Upload remote gagal : ".$err;

                    echo json_encode($json);
                    return;
                }

                curl_close($ch);

            }else{

                /*
                =================================
                LOCAL STORAGE
                =================================
                */

                $destFolder = rtrim(TYPESTORAGE,'/').'/';

                if(!is_dir($destFolder)){
                    mkdir($destFolder,0777,true);
                }

                $destFile = $destFolder.$mainName;

                if(!rename($tempFile,$destFile)){

                    @unlink($tempFile);

                    $json['responCode']="01";
                    $json['responHead']="error";
                    $json['responDesc']="Gagal memindahkan file ke storage";

                    echo json_encode($json);
                    return;
                }
            }

            /*
            =================================
            HAPUS TEMP
            =================================
            */

            if(file_exists($tempFile)){
                unlink($tempFile);
            }

            /*
            =================================
            SIMPAN DATABASE
            =================================
            */

            $data['org_id']           = $_SESSION['orgid'];
            $data['transaksi_id']     = $transid;
            $data['no_file']          = $originalname;
            $data['jenis_doc']        = $type;
            $data['signer_id']        = $assign;
            $data['note_1']           = $info1;
            $data['note_2']           = $info2;
            $data['storage_in']       = TYPESTORAGE;
            $data['type_of']          = TYPEOF;
            $data['from_in']          = "Dtechnology";
            $data['provider_sign']    = PROVIDERSIGN;
            $data['type_certificate'] = TYPECERTIFICATE;
            $data['created_by']       = $_SESSION['userid'];

            if($this->md->insertdocument($data)){

                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";

            }else{

                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function voiddocument(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "80";

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

        public function resend(){
            $transid = $this->input->post("datatransaksiid");

            $data['status_sign'] = "0";
            $data['storage_in']  = TYPESTORAGE;
            $data['response']    = null;

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


	}

?>