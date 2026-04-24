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

            $finalUrl     = null;
            $storageType  = null;

            /*
            =================================
            UPLOAD KE TEMP
            =================================
            */

            $tempPath = FCPATH.'assets/temp/';

            if(!is_dir($tempPath)){
                mkdir($tempPath,0777,true);
            }

            $config['upload_path']   = $tempPath;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload',$config);

            if (!$this->upload->do_upload('modal_sign_add_tilaka_document')) {

                echo json_encode([
                    "responCode" => "01",
                    "responHead" => "error",
                    "responDesc" => strip_tags($this->upload->display_errors())
                ]);
                return;
            }

            $uploadData = $this->upload->data();
            $tempFile   = $uploadData['full_path'];
            $mainName   = $transid.'.pdf';

            /*
            =================================
            CEK STORAGE TYPE
            =================================
            */

            if(filter_var(STORAGESIGNIN, FILTER_VALIDATE_URL)){

                /*
                =================================
                REMOTE STORAGE
                =================================
                */

                $storageType = "remote";

                $url = rtrim(STORAGESIGNIN,'/').'/receivedfile.php';

                $ch = curl_init($url);

                curl_setopt_array($ch,[
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => [
                        'file' => new CURLFile($tempFile,'application/pdf',$mainName)
                    ],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_SSL_VERIFYPEER => false
                ]);

                $response = curl_exec($ch);

                $curlErr  = curl_error($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                /*
                =================================
                CURL ERROR CHECK
                =================================
                */
                if($curlErr){

                    @unlink($tempFile);

                    echo json_encode([
                        "responCode" => "01",
                        "responHead" => "error",
                        "responDesc" => "Upload remote gagal (CURL): ".$curlErr
                    ]);
                    return;
                }

                /*
                =================================
                HTTP ERROR CHECK
                =================================
                */
                if($httpCode != 200){

                    @unlink($tempFile);

                    echo json_encode([
                        "responCode" => "01",
                        "responHead" => "error",
                        "responDesc" => "Upload remote gagal (HTTP $httpCode)",
                        "raw_response" => $response
                    ]);
                    return;
                }

                /*
                =================================
                JSON VALIDATION
                =================================
                */
                $result = json_decode($response, true);

                if(json_last_error() !== JSON_ERROR_NONE){

                    @unlink($tempFile);

                    echo json_encode([
                        "responCode" => "01",
                        "responHead" => "error",
                        "responDesc" => "Response server tidak valid JSON",
                        "raw_response" => $response
                    ]);
                    return;
                }

                /*
                =================================
                LOGICAL ERROR FROM REMOTE
                =================================
                */
                if(!isset($result['success']) || $result['success'] != true){

                    @unlink($tempFile);

                    echo json_encode([
                        "responCode" => "01",
                        "responHead" => "error",
                        "responDesc" => $result['message'] ?? "Upload remote gagal",
                        "remote_response" => $result
                    ]);
                    return;
                }

                /*
                =================================
                SUCCESS REMOTE
                =================================
                */
                $finalUrl = $result['url'] ?? null;

            }else{

                /*
                =================================
                LOCAL STORAGE
                =================================
                */

                $storageType = "local";

                $destFolder = rtrim(STORAGESIGNIN,'/').'/';

                if(!is_dir($destFolder)){
                    mkdir($destFolder,0777,true);
                }

                $destFile = $destFolder.$mainName;

                if(!rename($tempFile,$destFile)){

                    @unlink($tempFile);

                    echo json_encode([
                        "responCode" => "01",
                        "responHead" => "error",
                        "responDesc" => "Gagal memindahkan file ke storage"
                    ]);
                    return;
                }

                $finalUrl = rtrim(STORAGESIGNOUT,'/').'/'.$mainName;
            }

            /*
            =================================
            DELETE TEMP FILE
            =================================
            */
            if(file_exists($tempFile)){
                unlink($tempFile);
            }

            /*
            =================================
            VALIDASI FINAL URL
            =================================
            */
            if(empty($finalUrl)){

                echo json_encode([
                    "responCode" => "01",
                    "responHead" => "error",
                    "responDesc" => "File URL tidak ditemukan (upload gagal)"
                ]);
                return;
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
            $data['storage_in']       = STORAGESIGNIN;
            $data['storage_out']      = STORAGESIGNOUT;
            $data['type_of']          = TYPEOF;
            $data['from_in']          = "Dtechnology";
            $data['provider_sign']    = PROVIDERSIGN;
            $data['type_certificate'] = TYPECERTIFICATE;
            $data['created_by']       = $_SESSION['userid'];

            if($this->md->insertdocument($data)){

                echo json_encode([
                    "responCode" => "00",
                    "responHead" => "success",
                    "responDesc" => "Data Added Successfully",
                    "file_url"   => $finalUrl,
                    "storage"    => $storageType,
                    "trans_id"   => $transid
                ]);

            }else{

                echo json_encode([
                    "responCode" => "01",
                    "responHead" => "error",
                    "responDesc" => "Database insert failed",
                    "file_url"   => $finalUrl
                ]);
            }
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
            $data['storage_in']  = STORAGESIGNIN;
            $data['storage_out'] = STORAGESIGNOUT;
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