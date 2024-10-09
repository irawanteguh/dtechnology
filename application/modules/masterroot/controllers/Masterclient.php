<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Masterclient extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelmasterclient","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_masterclient");
		}

        public function listclient(){ 
            $result = $this->md->listclient();
            
            if(!empty($result)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="We Get The Data You Want";
                $json['responResult']=$result;
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

        public function addclient(){
            $orgid = generateuuid();
            $uniqe = generateUniqueCode();

            $data['org_id']            = $orgid;
            $data['code']              = $uniqe;
            $data['org_name']          = $this->input->post("data_client_name_add");
            $data['website']           = $this->input->post("data_client_website_add");
            $data['trial']             = "N";
            $data['created_by']        = $_SESSION['userid'];
            $data['created_date']      = date("Y-m-d H:i:s");
            $data['last_updated_by']   = $_SESSION['userid'];
            $data['last_updated_date'] = date("Y-m-d H:i:s");

            if($this->md->insertmasterclient($data)){
                $userid        = generateuuid();
                $roleidIT      = generateuuid();
                $roleidDefault = generateuuid();

                $datausser['org_id']          = $orgid;
                $datausser['user_id']         = $userid;
                $datausser['username']        = "Admin_".$uniqe;
                $datausser['nik']             = $uniqe;
                $datausser['name']            = "Administrator ".$this->input->post("data_client_name_add");
                $datausser['created_by']      = $userid;
                $dataroles['last_updated_by'] = $userid;
                $this->md->insertuseradministrator($datausser);

                
                $dataroles['org_id']          = $orgid;
                $dataroles['trans_id']        = generateuuid();
                $dataroles['role_id']         = $roleidIT;
                $dataroles['role']            = "IT Operation";
                $dataroles['created_by']      = $userid;
                $dataroles['last_updated_by'] = $userid;
                $this->md->insertrolems($dataroles);

                $dataroles['org_id']          = $orgid;
                $dataroles['trans_id']        = generateuuid();
                $dataroles['role_id']         = $roleidDefault;
                $dataroles['role']            = "Default";
                $dataroles['created_by']      = $userid;
                $dataroles['last_updated_by'] = $userid;
                $this->md->insertrolems($dataroles);

                $dataroles['org_id']          = $orgid;
                $dataroles['trans_id']        = generateuuid();
                $dataroles['role_id']         = "34c2e933-4b1b-47cd-8497-71de44ac4e01";
                $dataroles['role']            = "Admin Tilaka";
                $dataroles['created_by']      = $userid;
                $dataroles['last_updated_by'] = $userid;
                $this->md->insertrolems($dataroles);

                $datarolesaccess['org_id']     = $orgid;
                $datarolesaccess['trans_id']   = generateuuid();
                $datarolesaccess['user_id']    = $userid;
                $datarolesaccess['role_id']    = $roleidIT;
                $datarolesaccess['created_by'] = $userid;
                $this->md->insertroleaccess($datarolesaccess);

                $resultmodulesms = $this->md->modulesms();
                foreach ($resultmodulesms as $a) {
                    $dataroledt['org_id']         = $orgid;
                    $dataroledt['trans_id']       = generateuuid();
                    $dataroledt['role_id']        = $roleidIT;
                    $dataroledt['modules_id']     = $a->modules_id;
                    $dataroledt['active']         = $a->active;
                    $dataroledt['created_by']     = $userid;
                    $dataroledt['last_update_by'] = $userid;

                    $this->md->insertroledt($dataroledt);
                }

                $resultmasterenvironment = $this->md->masterenvironment();
                foreach ($resultmasterenvironment as $a) {
                    $dataenvi['org_id']           = $orgid;
                    $dataenvi['env_id']           = generateuuid();
                    $dataenvi['environment_name'] = $a->environment_name;
                    if($a->environment_name==="ORG_ID"){
                        $dataenvi['dev']         = $orgid;
                        $dataenvi['prod']        = $orgid;
                    }else{
                        $dataenvi['dev']         = $a->dev;
                        $dataenvi['prod']        = $a->prod;
                    }
                    $dataenvi['urut']       = $a->urut;
                    $dataenvi['created_by'] = $_SESSION['userid'];

                    $this->md->insertenviroment($dataenvi);
                }

                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function updateclient() {
            $data['org_name'] = $this->input->post("data_client_name_edit");
            $data['website']  = $this->input->post("data_client_website_edit");
            
            if($this->md->updatemasterclient($data, $this->input->post('data_client_orgid_edit'))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Update Successful";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Update Failed";
            }

            echo json_encode($json);
        }

	}
?>