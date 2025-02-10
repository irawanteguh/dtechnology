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
                // $parameter ="and a.org_id='".$_SESSION['orgid']."' and user_identifier='".$resultcheckuseridentifier[0]->user_identifier."'";

                // $parameter ="
                //                 and a.org_id='".$_SESSION['orgid']."'
                //                 and a.assign='".$_SESSION['username']."'
                //                 or  a.created_by='".$_SESSION['userid']."'
                //                 or  a.created_by in (select user_id from dt01_gen_user_asst_dt where active='1' and asst_id='".$_SESSION['userid']."')
                //                 or  a.assign in (select nik from dt01_gen_user_data where active='1' and user_id in (select user_id from dt01_gen_user_asst_dt where active='1' and asst_id='".$_SESSION['userid']."'))
                //             ";

                $parameter ="
                                and a.org_id='".$_SESSION['orgid']."'
                                and a.user_identifier in (select user_identifier from dt01_gen_user_data where active='1' and user_id in (select user_id from dt01_gen_user_asst_dt where active='1' and asst_id='".$_SESSION['userid']."'))
                                or  a.user_identifier in (select user_identifier from dt01_gen_document_file_dt where active='1' and status_sign in ('2','3') and user_identifier<>'' and created_by='".$_SESSION['userid']."')
                            ";
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