<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Signdocument extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelsigndocument","md");
        }

		public function index(){
            if(isset($_GET['request_id']) && isset($_GET['status'])){

                if($_GET['status']==="Sukses"){
                    $datafile['STATUS_SIGN']="3";
                }else{
                    $datafile['REQUEST_ID']="";
                    $datafile['STATUS_SIGN']="1";
                }

                $this->md->updatefile($datafile,$_GET['request_id']);
                redirect("tilaka/signdocument");
            }else{
                if(isset($_GET['issue_id']) && isset($_GET['status']) && isset($_GET['reason_code'])){
                    if($_GET['status'] === "Selesai" && $_GET['reason_code'] === "0"){
                        $result   = $this->md->checkissueid($_SESSION['orgid'],$_GET['issue_id']);
                        $bodycheckcertificate['user_identifier']=$result->USER_IDENTIFIER;
                        $responsecheckcertificate = Tilaka::checkcertificateuser(json_encode($bodycheckcertificate));

                        if($responsecheckcertificate['success']){
                            $data['CERTIFICATE']      = $responsecheckcertificate['status'];
                            $data['CERTIFICATE_INFO'] = $responsecheckcertificate['message']['info'];
                            $this->md->updatedatauseridentifier($data,$result->USER_IDENTIFIER);
                            redirect("tilakaV2/registrasi",$data);
                        }
                    }
                }else{
                    $this->template->load("template/template-sidebar","v_signdocument");
                }
            }
		}

		public function datasigndocument(){
            $resultcheckroleaccess = $this->md->checkroleaccess($_SESSION['orgid'],$_SESSION['userid']);

            if(!empty($resultcheckroleaccess)){
                $parameter ="and a.org_id='".$_SESSION['orgid']."'";
            }else{
                $resultcheckuseridentifier = $this->md->checkuseridentifier($_SESSION['orgid'],$_SESSION['userid']);
                $parameter ="and a.org_id='".$_SESSION['orgid']."' and user_identifier='".$resultcheckuseridentifier[0]->user_identifier."'";
            }

            $result = $this->md->datasigndocument($parameter);
            
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