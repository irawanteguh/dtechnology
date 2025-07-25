<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasi","md");
        }

		public function index(){
            $data = $this->loadcombobox();

            if(isset($_GET['request_id']) && isset($_GET['register_id']) && isset($_GET['reason_code']) && isset($_GET['status'])){
                
                if(($_GET['reason_code'] === "0" || $_GET['reason_code'] === "2") && $_GET['status']==="S"){ // reason code 0 : Sukses KYC, status S : Sukses
                    $body['register_id']=$_GET['register_id'];
                    $responsecheckregistrasiuser = Tilaka::checkregistrasiuser(json_encode($body));

                    if($responsecheckregistrasiuser['success']){
                        if(($responsecheckregistrasiuser['data']['status']==="S" && $responsecheckregistrasiuser['data']['reason_code']==="0") || ($responsecheckregistrasiuser['data']['status']==="F" && $responsecheckregistrasiuser['data']['reason_code']==="2")){ // reason code 0 : Sukses KYC, status S : Sukses
                            
                            
                            $body['user_identifier']=$responsecheckregistrasiuser['data']['tilaka_name'];
                            $responsecheckcertificateuser = Tilaka::checkcertificateuser(json_encode($body));

                            if($responsecheckcertificateuser['success']){
                                $datasimpan['USER_IDENTIFIER']  = $responsecheckregistrasiuser['data']['tilaka_name'];
                                $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                                $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                                $datasimpan['REVOKE_ID']        = "";
                                $datasimpan['ISSUE_ID']         = "";

                                $this->md->updatedataregister($datasimpan,$_GET['register_id']);
                                redirect("tilakaV2/registrasi",$data);
                            }
                        }
                    }
                }

                if(($_GET['reason_code'] === "1" || $_GET['reason_code'] === "undefined") && $_GET['status']==="S"){
                    $body['register_id']=$_GET['register_id'];
                    $responsecheckregistrasiuser = Tilaka::checkregistrasiuser(json_encode($body));

                    if($responsecheckregistrasiuser['data']['status']==="F" && $responsecheckregistrasiuser['data']['reason_code']==="1" && $responsecheckregistrasiuser['data']['manual_registration_status']==="F"){
                        $datasimpan['REGISTER_ID']    = "";
                        $datasimpan['IMAGE_IDENTITY'] = "N";
                        $this->md->updatedataregister($datasimpan,$_GET['register_id']);
                        redirect("tilakaV2/registrasi",$data);
                    }

                    if($responsecheckregistrasiuser['data']['status']==="F" && $responsecheckregistrasiuser['data']['reason_code']==="1" && ($responsecheckregistrasiuser['data']['manual_registration_status']==="S" || $responsecheckregistrasiuser['data']['manual_registration_status']==="V")){
                        $body['user_identifier']=$responsecheckregistrasiuser['data']['tilaka_name'];
                        $responsecheckcertificateuser = Tilaka::checkcertificateuser(json_encode($body));
                            
                        if($responsecheckcertificateuser['success']){
                            if($responsecheckcertificateuser['status']===1){
                                $datasimpan['USER_IDENTIFIER']  = $responsecheckregistrasiuser['data']['tilaka_name'];
                                $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                                $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                                $this->md->updatedataregister($datasimpan,$_GET['register_id']);
                                redirect("tilakaV2/registrasi",$data);
                            }else{
                                if($responsecheckcertificateuser['status']===3){
                                    $datasimpan['USER_IDENTIFIER']  = $responsecheckregistrasiuser['data']['tilaka_name'];
                                    $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                                    $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                                    $datasimpan['START_ACTIVE']     = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificateuser['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                                    $datasimpan['EXPIRED_DATE']     = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificateuser['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                                    $datasimpan['REVOKE_ID']        = "";
                                    $datasimpan['ISSUE_ID']         = "";
                                    $this->md->updatedataregister($datasimpan,$_GET['register_id']);
                                    redirect("tilakaV2/registrasi",$data);
                                }
                            }
                            
                        }
                    }
                }

                if($_GET['reason_code'] === "3" && $_GET['status']==="F"){ // reason code 3 : Request Id Expired, status F : Fail dukcapil (ada data yang tidak sesuai, misal nik tidak ditemukan pada database dukcapil
                    $datasimpan['IMAGE_IDENTITY']  = "N";
                    $datasimpan['REASON_CODE']     = $_GET['reason_code'];
                    $datasimpan['USER_IDENTIFIER'] = "";
                    $datasimpan['REGISTER_ID']     = "";
                    $datasimpan['REVOKE_ID']       = "";
                    $datasimpan['ISSUE_ID']        = "";
                    
                    $this->md->updatedataregister($datasimpan,$_GET['register_id']);
                    redirect("tilakaV2/registrasi",$data);
                }

            }else{
                if(isset($_GET['request_id']) && isset($_GET['tilaka_name']) && isset($_GET['tilaka-name']) && isset($_GET['request-id'])){
                    $body['user_identifier']=$_GET['tilaka_name'];
                    $responsecheckcertificateuser = Tilaka::checkcertificateuser(json_encode($body));

                    if($responsecheckcertificateuser['success']){
                        if($responsecheckcertificateuser['status']===3){
                            $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                            $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                            $datasimpan['START_ACTIVE']     = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificateuser['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                            $datasimpan['EXPIRED_DATE']     = DateTime::createFromFormat('Y-m-d H:i:s', $responsecheckcertificateuser['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                            $datasimpan['REVOKE_ID']="";
                            $datasimpan['ISSUE_ID']="";
                            $this->md->updatedataregister($datasimpan,$_GET['request_id']);
                            redirect("tilakaV2/registrasi",$data);
                        }
                    }else{
                        $body['register_id']=$_GET['request_id'];
                        $responsecheckregistrasiuser = Tilaka::checkregistrasiuser(json_encode($body));
                        if($responsecheckregistrasiuser['data']['status']==="F" && $responsecheckregistrasiuser['data']['reason_code']==="3"){ // reason code 3 : Request Id Expired, status F : Fail dukcapil (ada data yang tidak sesuai, misal nik tidak ditemukan pada database dukcapil
                            $datasimpan['IMAGE_IDENTITY']  = "N";
                            $datasimpan['REASON_CODE']     = $_GET['reason_code'];
                            $datasimpan['USER_IDENTIFIER'] = "";
                            $datasimpan['REGISTER_ID']     = "";
                            $datasimpan['REVOKE_ID']       = "";
                            $datasimpan['ISSUE_ID']        = "";
                            
                            $this->md->updatedataregister($datasimpan,$_GET['request_id']);
                            redirect("tilakaV2/registrasi",$data);
                        }
                    }
                }else{
                    if(isset($_GET['revoke_id']) && isset($_GET['status'])){ // Proses Revoke

                        if($_GET['status'] === "Berhasil"){
                            $result   = $this->md->checkrevokeid($_SESSION['orgid'],$_GET['revoke_id']);

                            $body['user_identifier']=$result->USER_IDENTIFIER;
                            $response = Tilaka::checkcertificateuser(json_encode($body));

                            if($response['success']){
                                if($response['status']===3){
                                    $datasimpan['REVOKE_ID']        = "";
                                    $datasimpan['ISSUE_ID']         = "";
                                    $datasimpan['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                                    $datasimpan['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                                }
                                $datasimpan['CERTIFICATE']      = $response['status'];
                                $datasimpan['CERTIFICATE_INFO'] = $response['data'][0]['status'];

                                $this->md->updatedatarevokeid($datasimpan,$_GET['revoke_id']);
                                redirect("tilakaV2/registrasi",$data);
                            }
                        }

                        if($_GET['status'] === "Gagal"){
                            $datasimpan['REVOKE_ID']="";
                            $this->md->updatedatarevokeid($datasimpan,$_GET['revoke_id']);
                            redirect("tilakaV2/registrasi",$data);
                        }

                    }else{
                        // Proses Re Enroll
                        // - Reason Code 0 → Sukses KYC
                        // - Reason Code 1 → Gagal dukcapil (ada data yang tidak sesuai, misal nik tidak ditemukan pada database dukcapil)
                        // - Reason Code 2 → Liveness Gagal
                        // - Reason Code 3 → RegisterId expired

                        if(isset($_GET['issue_id']) && isset($_GET['status']) && isset($_GET['reason_code'])){

                            if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "0"){ 
                                $result   = $this->md->checkissueid($_SESSION['orgid'],$_GET['issue_id']);

                                $body['user_identifier']=$result->USER_IDENTIFIER;
                                $response = Tilaka::checkcertificateuser(json_encode($body));

                                if($response['success']){

                                    if($response['status']===1){
                                        $datasimpan['REVOKE_ID']        = "";
                                        $datasimpan['ISSUE_ID']         = "";
                                        $datasimpan['CERTIFICATE']      = $response['status'];
                                        $datasimpan['CERTIFICATE_INFO'] = $response['message']['info'];
                                        $datasimpan['REASON_CODE']      = "";

                                        $this->md->updatedatauseridentifier($datasimpan,$result->USER_IDENTIFIER);
                                        redirect("tilakaV2/registrasi",$data);
                                    }

                                    if($response['status']===3){
                                        if($response['message']['info']==="Aktif"){
                                            $datasimpan['REVOKE_ID']        = "";
                                            $datasimpan['ISSUE_ID']         = "";
                                            $datasimpan['START_ACTIVE']     = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                                            $datasimpan['EXPIRED_DATE']     = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                                            $datasimpan['CERTIFICATE']      = $response['status'];
                                            $datasimpan['CERTIFICATE_INFO'] = $response['message']['info'];
                                            $datasimpan['REASON_CODE']      = "";

                                            $this->md->updatedatauseridentifier($datasimpan,$result->USER_IDENTIFIER);
                                            redirect("tilakaV2/registrasi",$data);
                                        }
                                    }
                                }
                            }

                            if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "1"){ 
                                $result   = $this->md->checkissueid($_SESSION['orgid'],$_GET['issue_id']);

                                $body['user_identifier']=$result->USER_IDENTIFIER;
                                $response = Tilaka::checkcertificateuser(json_encode($body));

                                if($response['success']){                                    
                                    $datasimpan['CERTIFICATE']      = $response['status'];
                                    $datasimpan['CERTIFICATE_INFO'] = $response['message']['info'];
                                    $datasimpan['REASON_CODE']      = $_GET['reason_code'];
                                    $datasimpan['ISSUE_ID']         = $_GET['issue_id'];
                                    
                                    $this->md->updatedatauseridentifier($datasimpan,$result->USER_IDENTIFIER);
                                    redirect("tilakaV2/registrasi",$data);
                                }
                            }

                            if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "2"){ 
                                $result   = $this->md->checkissueid($_SESSION['orgid'],$_GET['issue_id']);

                                $body['user_identifier']=$result->USER_IDENTIFIER;
                                $response = Tilaka::checkcertificateuser(json_encode($body));

                                if($response['success']){                                    
                                    $datasimpan['CERTIFICATE']      = $response['status'];
                                    $datasimpan['CERTIFICATE_INFO'] = $response['message']['info'];
                                    $datasimpan['REASON_CODE']      = $_GET['reason_code'];
                                    $datasimpan['ISSUE_ID']         = $_GET['issue_id'];
                                    
                                    $this->md->updatedatauseridentifier($datasimpan,$result->USER_IDENTIFIER);
                                    redirect("tilakaV2/registrasi",$data);
                                }
                            }

                            if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "3"){ 
                                $result   = $this->md->checkissueid($_SESSION['orgid'],$_GET['issue_id']);

                                $body['user_identifier']=$result->USER_IDENTIFIER;
                                $response = Tilaka::checkcertificateuser(json_encode($body));

                                if($response['success']){                                    
                                    $datasimpan['CERTIFICATE']      = $response['status'];
                                    $datasimpan['CERTIFICATE_INFO'] = $response['message']['info'];
                                    $datasimpan['REASON_CODE']      = $_GET['reason_code'];
                                    $datasimpan['ISSUE_ID']         = $_GET['issue_id'];
                                    
                                    $this->md->updatedatauseridentifier($datasimpan,$result->USER_IDENTIFIER);
                                    redirect("tilakaV2/registrasi",$data);
                                }
                            }

                        }else{
                            if(isset($_GET['request_id']) && isset($_GET['tilaka_name'])){
                                $body['user_identifier']=$_GET['tilaka_name'];
                                $responsecheckcertificateuser = Tilaka::checkcertificateuser(json_encode($body));

                                if($responsecheckcertificateuser['success']){
                                    $datasimpan['USER_IDENTIFIER']  = $_GET['tilaka_name'];
                                    $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                                    $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                                    $datasimpan['REVOKE_ID']        = "";
                                    $datasimpan['ISSUE_ID']         = "";

                                    $this->md->updatedataregister($datasimpan,$_GET['request_id']);
                                    redirect("tilakaV2/registrasi",$data);
                                }
                            }else{
                                if(isset($_GET['tilaka_name'])){
                                    redirect("tilakaV2/registrasi",$data);
                                }else{
                                    if(isset($_GET['user_identifier']) && isset($_GET['request_id']) && isset($_GET['status'])){
                                        redirect("tilakaV2/registrasi",$data);
                                    }else{
                                        $this->template->load("template/template-sidebar","v_registrasi",$data);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
		}

        public function loadcombobox(){
            $resultalasanrevoke = $this->md->alasanrevoke();

            $revoke="";
            foreach($resultalasanrevoke as $a ){
                $revoke.="<option value='".$a->keterangan."'>".$a->keterangan."</option>";
            }

            $data['revoke'] = $revoke;
            return $data;
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

        public function uploadktp(){
            $userid = $_GET['userid'];

            $config['upload_path']   = './assets/ktp/';
            $config['allowed_types'] = 'jpeg';
            $config['file_name']     = $userid;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                $upload_data = $this->upload->data();
                $dataupdate = array('IMAGE_IDENTITY' => "Y");

                $this->md->updatedatauser($dataupdate, $userid);

                echo "Upload Success";
            }

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

            $resultcheckemail = $this->md->checkemail($_SESSION['orgid'],$userid,$email);
            $resultchecknik   = $this->md->checknik($_SESSION['orgid'],$userid,$noktp);

            if(empty($resultcheckemail)){
                if(empty($resultchecknik)){
                    if($this->md->updatedatauserid($dataupdate,$userid)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Updated Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="info";
                        $json['responDesc']="Data failed to update";
                    }
                }else{
                    $json['responCode'] = "01";
                    $json['responHead'] = "info";
                    $json['responDesc'] = "Identity No is already in use";
                }
            }else{
                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = "Email is already in use";
            }
            

            echo json_encode($json);
        }

        public function registrasiuser(){
            $userid   = $this->input->post("userid-registrasi");
            $result   = $this->md->dataregistrasi($_SESSION['orgid'],$userid);
            $ktp_path = FCPATH."/assets/ktp/".$userid.".jpeg";
            
            if(file_exists($ktp_path)){
                $consent_timestamp = date("Y-m-d H:i:s");
                $consent_text      = "Syarat dan Ketentuan Sebagaimana Yang Telah Di Atur Oleh ".$_SESSION['hospitalname'];
                $version           = "TNT – v.1.0.1";
                $expireddate       = date("Y-m-d", strtotime("+3 days"))." 23:59";
                // $expireddate       = date("Y-m-d H:i", strtotime("+3 minutes"));

                $datahash    = CLIENT_ID_TILAKA.$consent_text.$version.$consent_timestamp;
                $hash        = hash_hmac('sha256', $datahash, CLIENT_SECRET_TILAKA);
                $ktp_data    = file_get_contents($ktp_path);
                $ktp_encoded = base64_encode($ktp_data);
    
                $responseuuid = Tilaka::uuid(CERTIFICATE,urlencode($result->NAME_IDENTITY),$result->EMAIL);

                if($responseuuid){
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
                            $data['REGISTER_ID']      = $response['data'][0];
                            $data['CERTIFICATE']      = "";
                            $data['CERTIFICATE_INFO'] = "";
                            $data['REVOKE_ID']        = "";
                            $data['ISSUE_ID']         = "";
                            $data['REASON_CODE']      = "";

                            if($this->md->updatedatauserid($data,$userid)){
                                unlink($ktp_path);
                            }
                        }
            
                        $json["responCode"]   = "00";
                        $json["responHead"]   = "success";
                        $json["responDesc"]   = "success";
                        $json['responResult'] = $response;
                    }else{
                        $json["responCode"]   = "01";
                        $json["responHead"]   = "error";
                        $json["responDesc"]   = $responseuuid['message'];
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
        
        public function certificatestatus(){
            $userid         = $this->input->post("userid");
            $useridentifier = $this->input->post("useridentifier");
            $registerid     = $this->input->post("registerid");

            $body['user_identifier']=$useridentifier;
            $response = Tilaka::checkcertificateuser(json_encode($body));

            if($response['success']){
                $data['CERTIFICATE']      = $response['status'];

                if ($response['status'] === 1 || $response['status'] === 3) {
                    $data['CERTIFICATE_INFO'] = $response['message']['info'];
                } else {
                    $data['CERTIFICATE_INFO'] = isset($response['data'][0]['status']) ? $response['data'][0]['status'] : $response['message']['info'];
                }                
                
                if($response['status']===0){ 
                    if($response['data'][0]['status']==="Expired"){
                        $data['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                        $data['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                    }
                }

                if($response['status']===3){
                    if($response['message']['info']==="Aktif"){
                        $data['REVOKE_ID']   = "";
                        $data['ISSUE_ID']    = "";
                        $data['START_ACTIVE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['start_active_date'])->format('Y-m-d H:i:s');
                        $data['EXPIRED_DATE'] = DateTime::createFromFormat('Y-m-d H:i:s', $response['data'][0]['expiry_date'])->format('Y-m-d H:i:s');
                    }
                }

                if($response['status']===4){
                    $data['USER_IDENTIFIER']  = "";
                    $data['REGISTER_ID']      = "";
                    $data['REVOKE_ID']        = "";
                    $data['ISSUE_ID']         = "";
                }

                $this->md->updatedatauserid($data,$userid);

                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "success";
                $json['responResult'] = $response;
            }else{
                $json["responCode"]   = "01";
                $json["responHead"]   = "info";
                $json["responDesc"]   = $response['message'];
                $json['responResult'] = $response;
            }
            
            
            echo json_encode($json);
        }

        public function revoke(){
            $useridentifier = $this->input->post("useridentifier");

            $body['user_identifier'] = $useridentifier;
            $body['reason']          = $this->input->post("reasonid");

            $response = Tilaka::revoke(json_encode($body));

            if($response['success']){

                $body['user_identifier']=$useridentifier;
                $responsecheckcertificateuser = Tilaka::checkcertificateuser(json_encode($body));

                if($responsecheckcertificateuser['success']){
                    $datasimpan['CERTIFICATE']      = $responsecheckcertificateuser['status'];
                    $datasimpan['CERTIFICATE_INFO'] = $responsecheckcertificateuser['message']['info'];
                    $datasimpan['REVOKE_ID']        = $response['data'][0];
                    $datasimpan['ISSUE_ID']         = "";

                    $this->md->updatedatauseridentifier($datasimpan,$useridentifier);

                    $json["responCode"]   = "00";
                    $json["responHead"]   = "success";
                    $json["responDesc"]   = "Data Di Temukan";
                    $json['responResult'] = $response;
                }
            }else{
                $json["responCode"]   = "01";
                $json["responHead"]   = "error";
                $json["responDesc"]   = $response['message'];
                $json['responResult'] = $response;
            }
            

            echo json_encode($json);
        }

        public function reenroll(){
            $bodycheckcertificate     = [];
            $responsecheckcertificate = [];

            $useridentifier    = $this->input->post("useridentifier-reenroll");

            $bodycheckcertificate['user_identifier']=$useridentifier;
            $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));
            
            if($responsecheckcertificate['success']){
                if($responsecheckcertificate['status']===0 || $responsecheckcertificate['status']===4){
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
                                    $bodycheckcertificate['user_identifier']=$useridentifier;
                                    $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                                    if($responsecheckcertificate['success']){
                                        $data['CERTIFICATE']      = $responsecheckcertificate['status'];
                                        $data['CERTIFICATE_INFO'] = $responsecheckcertificate['message']['info'];
                                        $data['ISSUE_ID']         = $response['data'][0];
                                        $this->md->updatedatauseridentifier($data,$useridentifier);
    
                                        $json["responCode"]   = "00";
                                        $json["responHead"]   = "success";
                                        $json["responDesc"]   = "Data Di Temukan";
                                        $json['responResult'] = $response;
                                    }
                                }else{
                                    $json["responCode"]   = "01";
                                    $json["responHead"]   = "error";
                                    $json["responDesc"]   = $response['message'];
                                }
                            }else{
                                $json["responCode"]   = "01";
                                $json["responHead"]   = "error";
                                $json["responDesc"]   = "error";
                                $json['responResult'] = $registrationid;
                            }
                        }else{
                            $json["responCode"]   = "01";
                            $json["responHead"]   = "error";
                            $json["responDesc"]   = "Gagal Mendapatkan UUID Registration";
                        }
                }else{
                    if($responsecheckcertificate['status']==1){
                        $data['CERTIFICATE']      = $responsecheckcertificate['status'];
                        $data['CERTIFICATE_INFO'] = $responsecheckcertificate['message']['info'];
                        $this->md->updatedatauseridentifier($data,$useridentifier);

                        $json["responCode"]   = "01";
                        $json["responHead"]   = "error";
                        $json["responDesc"]   = $responsecheckcertificate['message']['info'];
                        $json["responResult"] = $responsecheckcertificate;
                    }else{
                        $json["responCode"]   = "01";
                        $json["responHead"]   = "error";
                        $json["responDesc"]   = $responsecheckcertificate['data'][0]['status'];
                    }
                }
                
            }

            echo json_encode($json);
        }

        public function activequicksign(){
            $response =[];
            $body = [];
            if(file_exists(FCPATH."assets/speciment/".ORG_ID.".png")){
                $signatures['user_identifier']=$this->input->post("useridentifier");
                $signatures['email']=$this->input->post("email");
                $signatures['signature_image'] = "data:image/png;base64,".base64_encode(file_get_contents(FCPATH."assets/speciment/".ORG_ID.".png"));
    
                $body['request_id']=generateuuid();
                $body['signatures'][]=$signatures;

                $response = Tilaka::requestsignquicksign(json_encode($body));

                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "success";
                $json['responResult'] = $response;
            }

            echo json_encode($json);
            
        }
	}

?>