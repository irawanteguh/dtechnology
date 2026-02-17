<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Registrasi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
			$this->load->model("Modelregistrasi","md");
        }

		public function index(){
            $this->template->load("template/template-sidebar","v_registrasi");
		}

		public function datakaryawan(){
            $result = $this->md->datakaryawan($_SESSION['orgid']);
            
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

		public function certificatestatus(){
            $userid = $this->input->post("userid");
            $noktp  = $this->input->post("noktp");

            $response = BSRe::checkcertificateuser($noktp);
			
			if(isset($response['status_code'])){
				if($response['status_code']===1111){
					if($response['status']==="EXPIRED"){
						$dataupdate['certificate']      = "";
						$dataupdate['certificate_info'] = $response['message'];
					}else{
						$dataupdate['certificate']      = "3";
						$dataupdate['certificate_info'] = $response['status'];
					}
				}

				if($response['status_code']===2011){
					$dataupdate['certificate']      = "";
					$dataupdate['certificate_info'] = $response['status'];
				}

				$this->md->updatedatauserid($dataupdate,$userid);
			}
			

			$json["responCode"]   = "00";
			$json["responHead"]   = "success";
			$json["responDesc"]   = "success";
			$json['responResult'] = $response;

			echo json_encode($json);
        }

		public function edituser(){
            $userid       = $this->input->post("userid-edit");
            $nikrs        = $this->input->post("nikrs-edit");
            $namakaryawan = $this->input->post("namakaryawan-edit");
            $namaktp      = $this->input->post("namaktp-edit");
            $noktp        = $this->input->post("noktp-edit");
            $email        = $this->input->post("email-edit");

            $response = BSRe::checkcertificateuser($noktp);

			if(isset($response['status_code'])){
				if($response['status_code']===1111){

					if($response['status']==="EXPIRED"){
						$dataupdate['certificate']      = "";
						$dataupdate['certificate_info'] = $response['message'];
					}else{
						$dataupdate['certificate']      = "3";
						$dataupdate['certificate_info'] = $response['status'];
					}
				}

				if($response['status_code']===2011){
					$dataupdate['certificate']      = "";
					$dataupdate['certificate_info'] = $response['status'];
				}
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

	}

?>