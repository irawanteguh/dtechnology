<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Document extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeldocument","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_document",$data);
		}

        public function loadcombobox(){
            $resultmastertypedocument   = $this->md->mastertypedocument();

            $mastertypedocument="";
            foreach($resultmastertypedocument as $a ){
                $mastertypedocument.="<option value='".$a->jenis_id."'>".$a->keterangan."</option>";
            }

            $data['mastertypedocument']   = $mastertypedocument;
            return $data;
        }

		public function masterdocument(){
            $result = $this->md->masterdocument();
            
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

        public function documentadd(){

            $data['org_id']        = $_SESSION['orgid'];
            $data['jenis_doc']     = $this->input->post("modal_document_add_code") ?: generateUniqueNumber();
            $data['document_name'] = $this->input->post("modal_document_add_name");
            $data['jenis_id']      = $this->input->post("modal_document_add_type");
            $data['created_by']    = $_SESSION['userid'];
            $data['created_date']  = date("Y-m-d H:i:s");

            if($this->md->insertdocumentadd($data)){
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

        // public function masteruser(){
        //     $result = $this->md->masteruser($_SESSION['orgid']);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="We Get The Data You Want";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="We Didn't Get The Data You Wanted";
        //     }

        //     echo json_encode($json);
        // }

        // public function insertdepartment(){

        //     $data['org_id']        = $_SESSION['orgid'];
        //     $data['department_id'] = generateuuid();
        //     $data['header_id']     = $this->input->post("headerid");
        //     $data['level_id']      = $this->input->post("levelid");
        //     $data['department']    = $this->input->post("department_name");
        //     $data['code']          = $this->input->post("department_code");
        //     $data['created_by']    = $_SESSION['userid'];
        //     $data['created_date']  = date("Y-m-d H:i:s");

        //     if($this->md->insertdepartment($data)){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Added Successfully";
        //     } else {
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data Failed to Add";
        //     }

        //     echo json_encode($json);
        // }

        // public function editdepartment(){
        //     $data['department'] = $this->input->post("department_name_edit");
        //     $data['code']       = $this->input->post("department_code_edit");

        //     if($this->md->updatedepartment($data,$this->input->post("departmentidedit"))){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Added Successfully";
        //     } else {
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data Failed to Add";
        //     }

        //     echo json_encode($json);
        // }

        // public function adduser(){
        //     $data['user_id']     = $this->input->post("userid");

        //     if($this->md->updatedepartment($data,$this->input->post("departmentid"))){
        //         $json['responCode']="00";
        //         $json['responHead']="success";
        //         $json['responDesc']="Data Added Successfully";
        //     } else {
        //         $json['responCode']="01";
        //         $json['responHead']="info";
        //         $json['responDesc']="Data Failed to Add";
        //     }

        //     echo json_encode($json);
        // }
	}
?>