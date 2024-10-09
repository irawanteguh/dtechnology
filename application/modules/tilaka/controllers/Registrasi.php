<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasi","md");
            $this->load->model("auth/Modelsign","ms");
        }

		public function index(){
            if(isset($_GET['request_id']) && isset($_GET['register_id']) && isset($_GET['reason_code']) && isset($_GET['status'])){
                
                if($_GET['reason_code'] === "0" && $_GET['status'] === "S"){
                    $body['register_id']=$_GET['register_id'];
                    $response = Tilaka::checkregistrasiuser(json_encode($body));
                    if($response['success']){

                        if($response['data']['status']==="S" && $response['data']['reason_code']==="0"){
                            $data['USER_IDENTIFIER'] = $response['data']['tilaka_name'];
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            $body['user_identifier']=$response['data']['tilaka_name'];
                            $response = Tilaka::checkcertificateuser(json_encode($body));
                            if($response['success']){
                                $data['CERTIFICATE']=$response['status'];
                            }
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            redirect("tilaka/registrasi");
                        }

                        if($response['data']['status']==="F" && $response['data']['reason_code']==="2"){
                            $data['USER_IDENTIFIER'] = $response['data']['tilaka_name'];
    
                            $body['user_identifier']=$response['data']['tilaka_name'];
                            $response = Tilaka::checkcertificateuser(json_encode($body));
                            if($response['success']){
                                $data['CERTIFICATE']=$response['status'];
                            }
    
                            $this->md->updatedataregister($data,$_GET['register_id']);
                            redirect("tilaka/registrasi");
                        }

                        if($response['data']['status']==="F" && $response['data']['reason_code']==="3"){
                            $data['REGISTER_ID']    = "";
                            $data['IMAGE_IDENTITY'] = "N";
                            $this->md->updatedataregister($data,$_GET['register_id']);
                            redirect("tilaka/registrasi");
                        }

                    }
                }

                if($_GET['reason_code'] === "1" && $_GET['status'] === "S"){
                    $body['register_id']=$_GET['register_id'];
                    $response = Tilaka::checkregistrasiuser(json_encode($body));
                    if($response['success']){
                        
                        if($response['data']['status']==="F" && $response['data']['reason_code']==="1" && $response['data']['manual_registration_status']==="F"){
                            $data['REGISTER_ID']    = "";
                            $data['IMAGE_IDENTITY'] = "N";
                            $this->md->updatedataregister($data,$_GET['register_id']);
                            redirect("tilaka/registrasi");
                        }

                        if($response['data']['status']==="F" && $response['data']['reason_code']==="1" && $response['data']['manual_registration_status']==="S"){
                            $data['USER_IDENTIFIER'] = $response['data']['tilaka_name'];
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            $body['user_identifier']=$response['data']['tilaka_name'];
                            $response = Tilaka::checkcertificateuser(json_encode($body));
                            if($response['success']){
                                $data['CERTIFICATE']=$response['status'];
                            }
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            redirect("tilaka/registrasi");
                        }
                    }
                }

                if($_GET['reason_code'] === "2" && $_GET['status'] === "S"){
                    $body['register_id']=$_GET['register_id'];
                    $response = Tilaka::checkregistrasiuser(json_encode($body));
                    if($response['success']){
                        
                        if($response['data']['status']==="F" && $response['data']['reason_code']==="2" && $response['data']['manual_registration_status']==="S"){
                            $data['USER_IDENTIFIER'] = $response['data']['tilaka_name'];
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            $body['user_identifier']=$response['data']['tilaka_name'];
                            $response = Tilaka::checkcertificateuser(json_encode($body));
                            if($response['success']){
                                $data['CERTIFICATE']=$response['status'];
                            }
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            redirect("tilaka/registrasi");
                        }
                    }
                }

                if($_GET['reason_code'] === "undefined" && $_GET['status'] === "S"){
                    $body['register_id']=$_GET['register_id'];
                    $response = Tilaka::checkregistrasiuser(json_encode($body));
                    if($response['success']){
                        
                        if($response['data']['status']==="F" && $response['data']['reason_code']==="2" && $response['data']['manual_registration_status']==="S"){
                            $data['USER_IDENTIFIER'] = $response['data']['tilaka_name'];
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            $body['user_identifier']=$response['data']['tilaka_name'];
                            $response = Tilaka::checkcertificateuser(json_encode($body));
                            if($response['success']){
                                $data['CERTIFICATE']=$response['status'];
                            }
                            $this->md->updatedataregister($data,$_GET['register_id']);

                            redirect("tilaka/registrasi");
                        }
                    }
                }
                
            }else{
                if(isset($_GET['status']) && isset($_GET['revoke_id']) && isset($_GET['user_identifier'])){
                    if($_GET['status'] === "Sukses"){
                        $data['CERTIFICATE']="X";
                        $this->md->updatedatauseridentifier($data,$_GET['user_identifier']);

                        redirect("tilaka/registrasi");
                    }
                }else{
                    if(isset($_GET['issue_id']) && isset($_GET['status']) && isset($_GET['reason_code'])){
                        if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "3"){
                            
                            $data['CERTIFICATE']="X";
                            $data['ISSUE_ID']="";
                            $this->md->updatedataissueid($data,$_GET['issue_id']);
                            redirect("tilaka/registrasi");
                        }
                    }else{
                        if(isset($_GET['issue_id']) && isset($_GET['status'])){
                            if($_GET['status'] === "Selesai"){
                                $data['CERTIFICATE']="Y";
                                $this->md->updatedataissueid($data,$_GET['issue_id']);
                                redirect("tilaka/registrasi");
                            }
                        }else{
                            if(isset($_GET['tilaka_name'])){
                                redirect("tilaka/registrasi");
                            }else{
                                $this->template->load("template/template-sidebar","v_registrasi");
                            }
                        }
                    }
                }
            }
		}

        public function certificatestatus(){
            $userid         = $this->input->post("userid");
            $useridentifier = $this->input->post("useridentifier");
            $registerid     = $this->input->post("registerid");

            $body['user_identifier']=$useridentifier;
            $response = Tilaka::checkcertificateuser(json_encode($body));
            
            if($response['success']){
                $data['CERTIFICATE']=$response['status'];
                $this->md->updatedatauser($data,$userid);
            }

            $json["responCode"]   = "00";
            $json["responHead"]   = "success";
            $json["responDesc"]   = "success";
            $json['responResult'] = $response;

            echo json_encode($json);
        }

		public function datakaryawan(){
			$search = $this->input->post("search");
            $result = $this->md->datakaryawan($_SESSION['orgid'],$search);
            
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

        public function edituser(){
            $userid       = $this->input->post("userid-edit");
            $nikrs        = $this->input->post("nikrs-edit");
            $namakaryawan = $this->input->post("namakaryawan-edit");
            $namaktp      = $this->input->post("namaktp-edit");
            $noktp        = $this->input->post("noktp-edit");
            $email        = $this->input->post("email-edit");
            $file         = (object)@$_FILES['avatar'];

            $config['upload_path']      = './assets/images/avatars/';
            $config['allowed_types']    = 'jpeg';
            $config['file_name']        = $userid;
            $config['overwrite']        = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('avatar')){
                $error = array('error' => $this->upload->display_errors());
                $dataupdate['IMAGE_PROFILE'] = "N";
            }else{
                $data = array('upload_data' => $this->upload->data());
                $dataupdate['IMAGE_PROFILE'] = "Y";
            }

            $dataupdate['NIK']           = $nikrs;
            $dataupdate['NAME']          = $namakaryawan;
            $dataupdate['NAME_IDENTITY'] = $namaktp;
            $dataupdate['EMAIL']         = $email;
            $dataupdate['IDENTITY_NO']   = $noktp;

            if($this->md->updatedatauser($dataupdate,$userid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Perbaharui Data Sukses";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Perbaharui Data gagal";
            }

            echo json_encode($json);
        }

        public function uploadktp(){
            $userid = $_GET['userid'];

            $config['upload_path']   = './assets/ktp/';
            $config['allowed_types'] = 'jpeg';           // Ensure this matches the expected file type
            $config['file_name']     = $userid;          // Rename the file to the user ID
            $config['overwrite']     = TRUE;             // Overwrite existing files

            // Load the upload library with the configuration
            $this->load->library('upload', $config);

            // Attempt to upload the file
            if (!$this->upload->do_upload('file')) { // Check that 'file' matches your input's name attribute
                $error = array('error' => $this->upload->display_errors());

                // Log error and output it
                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                // Handle successful upload
                $upload_data = $this->upload->data();
                $dataupdate = array('IMAGE_IDENTITY' => "Y");

                // Update the user data in the database
                $this->md->updatedatauser($dataupdate, $userid);

                echo "Upload Success";
            }

        }

        public function registrasiuser(){
            $userid   = $this->input->post("userid-registrasi");
            $result   = $this->md->dataregistrasi($_SESSION['orgid'],$userid);
            $ktp_path = FCPATH."/assets/ktp/".$userid.".jpeg";
            
            if(file_exists($ktp_path)){
                $consent_timestamp = date("Y-m-d H:i:s");
                $consent_text      = "Syarat dan Ketentuan Sebagaimana Yang Telah Di Atur Oleh ".$_SESSION['hospitalname'];
                $version           = "TNT – v.1.0.1";
                $expireddate       = date("Y-m-d", strtotime("+365 days")) . " 23:59";

                
                $datahash = CLIENT_ID_TILAKA.$consent_text.$version.$consent_timestamp;
                $hash     = hash_hmac('sha256', $datahash, CLIENT_SECRET_TILAKA);
                
                $ktp_data    = file_get_contents($ktp_path);
                $ktp_encoded = base64_encode($ktp_data);
    
                $responseuuid = Tilaka::uuid($result->NAME_IDENTITY,$result->EMAIL);

                if($responseuuid!=null){
                    if($responseuuid['success']){
                        $body['registration_id']   = $responseuuid['data'][0];
                        $body['email']             = $result->EMAIL;
                        $body['name']              = $result->NAME_IDENTITY;
                        $body['company_name']      = $_SESSION['hospitalname'];
                        $body['date_expire']       = $expireddate;
                        $body['nik']               = $result->IDENTITY_NO;
                        $body['photo_ktp']         = "data:image/jpeg;base64,".$ktp_encoded;
                        $body['consent_text']      = $consent_text;
                        $body['is_approved']       = true;
                        $body['version']           = $version;
                        $body['hash_consent']      = $hash;
                        $body['consent_timestamp'] = $consent_timestamp;
    
                        $response = Tilaka::registerkyc(json_encode($body));
    
                        if($response['success']){
                            $data['REGISTER_ID'] = $response['data'][0];
                            $data['CERTIFICATE'] = "";
                            $this->md->updatedatauser($data,$userid);
    
                            unlink($ktp_path);
                        }
            
                        $json["responCode"]   = "00";
                        $json["responHead"]   = "success";
                        $json["responDesc"]   = "success";
                        $json['responResult'] = $response;
                    }else{
                        $json["responCode"]   = "00";
                        $json["responHead"]   = "success";
                        $json["responDesc"]   = "success";
                        $json['responResult'] = $responseuuid;
                    }
                }else{
                    $json["responCode"] = "01";
                    $json["responHead"] = "error";
                    $json["responDesc"] = "Gagal Mendapatkan UUID Registration";
                }
                
            }else{
                $json["responCode"]="01";
                $json["responHead"]="error";
                $json["responDesc"]="File KTP Tidak Di Temukan<br><b>".$ktp_path."<b>";
            }

            echo json_encode($json);
        }

        public function revoke(){
            $useridentifier = $this->input->post("useridentifier");

            $body['user_identifier'] = $useridentifier;
            $body['reason']          = "Akses Tanda Tangan Elektronik Di Hapus";

            $response = Tilaka::revoke(json_encode($body));
            
            if($response['success']){
                $data['REVOKE_ID']=$response['data'][0];
                $this->md->updatedatauseridentifier($data,$useridentifier);
            }

            $json["responCode"]   = "00";
            $json["responHead"]   = "success";
            $json["responDesc"]   = "Data Di Temukan";
            $json['responResult'] = $response;

            echo json_encode($json);
        }

        public function reenroll(){
            $useridentifier    = $this->input->post("useridentifier");
            $consent_timestamp = date("Y-m-d H:i:s");
            $consent_text      = "Syarat dan Ketentuan Sebagaimana Yang Telah Di Atur Oleh ".$_SESSION['hospitalname'];
            $version           = "TNT – v.1.0.1";

            $registrationid = Tilaka::uuidreenroll($useridentifier);
            
            if($registrationid!=null){
                if($registrationid['success']){
                    $datahash = CLIENT_ID_TILAKA.$consent_text.$version.$consent_timestamp;
                    $hash     = hash_hmac('sha256', $datahash, CLIENT_SECRET_TILAKA);
        
                    $body['registration_id']   = $registrationid['data'][0];
                    $body['consent_text']      = $consent_text;
                    $body['is_approved']       = true;
                    $body['version']           = $version;
                    $body['hash_consent']      = $hash;
                    $body['consent_timestamp'] = $consent_timestamp;
        
                    $response = Tilaka::registerkyc(json_encode($body));
                    
                    if($response['success']){
                        $data['ISSUE_ID']=$response['data'][0];
                        $this->md->updatedatauseridentifier($data,$useridentifier);
                    }
    
                    $json["responCode"]   = "00";
                    $json["responHead"]   = "success";
                    $json["responDesc"]   = "Data Di Temukan";
                    $json['responResult'] = $response;
                }else{
                    $json["responCode"]   = "01";
                    $json["responHead"]   = "success";
                    $json["responDesc"]   = "success";
                    $json['responResult'] = $registrationid;
                }
            }else{
                $json["responCode"]   = "01";
                $json["responHead"]   = "error";
                $json["responDesc"]   = "Gagal Mendapatkan UUID Registration";
            }
            

            echo json_encode($json);
        }
		
	}

?>