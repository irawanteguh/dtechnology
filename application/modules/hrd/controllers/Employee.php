<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Employee extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelemployee","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_employee",$data);
		}

        public function loadcombobox(){
            $resulttype                 = $this->md->type();
            $resultmasterclassification = $this->md->masterclassification($_SESSION['orgid']);
            $resultdutydays             = $this->md->dutydays();
            $resultdutyhours            = $this->md->dutyhours();

            $type="";
            foreach($resulttype as $a ){
                $type.="<option value='".$a->id."'>".$a->type."</option>";
            }

            $classification="";
            foreach($resultmasterclassification as $a ){
                $classification.="<option value='".$a->kategori_id."'>".$a->kategori."</option>";
            }

            $days="";
            foreach($resultdutydays as $a ){
                $days.="<option value='".$a->id."'>".$a->keterangan."</option>";
            }

            $hours="";
            foreach($resultdutyhours as $a ){
                $hours.="<option value='".$a->id."'>".$a->keterangan."</option>";
            }

            $data['type']           = $type;
            $data['classification'] = $classification;
            $data['days']           = $days;
            $data['hours']          = $hours;
            
            return $data;
		}

        public function position(){
            $resultdaftarjabatan = $this->md->daftarjabatan($_SESSION['orgid']);
            
            $position="";
            foreach($resultdaftarjabatan as $a ){
                $position.="<option value='".$a->position_id."'>".$a->position." ".$a->fungsional."</option>";
            }

            echo $position;
        }

        public function namaatasan(){
            $userid               = $this->input->post('userid');
            $parameter            = "and a.user_id <> '".$userid."'";
            $resultdaftarkaryawan = $this->md->masteremployee($_SESSION['orgid'],$parameter);
            
            $namaatasan   = "";
            foreach($resultdaftarkaryawan as $a ){
                $namaatasan.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            echo $namaatasan;
        }

        public function masteremployee(){
            $result = $this->md->masteremployee($_SESSION['orgid'],"");
            
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
		
        public function insertpenempatan(){
            $type           = $this->input->post("drawer_data_employee_registrationposition_type_add");
            $userid         = $this->input->post("drawer_data_employee_registrationposition_userid_add");
            $positionid     = $this->input->post("drawer_data_employee_registrationposition_positionid_add");
            $atasanid       = $this->input->post("drawer_data_employee_registrationposition_atasanid_add");
            $date           = DateTime::createFromFormat("d.m.Y", $this->input->post("drawer_data_employee_registrationposition_date_add"))->format("Y-m-d");
            

            $data['org_id']           = $_SESSION['orgid'];
            $data['trans_id']         = generateuuid();
            $data['user_id']          = $userid;
            $data['position_id']      = $positionid;
            $data['atasan_id']        = $atasanid;
            $data['start_date']       = $date;
            $data['position_primary'] = $type;
            $data['created_by']       = $_SESSION['userid'];
            
            if($type === "Y"){
                $cekdataprimary = $this->md->cekdataprimary(ORG_ID,$userid);
                if(empty($cekdataprimary)){
                    if($this->md->insertpenempatan($data)){
                        $json['responCode']="00";
                        $json['responHead']="success";
                        $json['responDesc']="Data Added Successfully";
                    }else{
                        $json['responCode']="01";
                        $json['responHead']="error";
                        $json['responDesc']="Data Failed to Add";
                    }
                }else{
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="The Main Job Already Exists <br>".$cekdataprimary->position;
                    $json['responResult']=$cekdataprimary;
                }
            }else{
                if($this->md->insertpenempatan($data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                }else{
                    $json['responCode']="01";
                    $json['responHead']="error";
                    $json['responDesc']="Data Failed to Add";
                }
            }

            echo json_encode($json);
        }

        public function editpenempatan(){
            $type       = $this->input->post("modal_data_employee_registrationposition_type_edit");
            $transid    = $this->input->post("modal_data_employee_registrationposition_transid_edit");
            $userid     = $this->input->post("modal_data_employee_registrationposition_userid_edit");
            $positionid = $this->input->post("modal_data_employee_registrationposition_positionid_edit");
            $atasanid   = $this->input->post("modal_data_employee_registrationposition_atasanid_edit");
            $date       = DateTime::createFromFormat("d.m.Y", $this->input->post("drawer_data_employee_registrationposition_date_edit"))->format("Y-m-d");
            

            $data['org_id']           = $_SESSION['orgid'];
            $data['trans_id']         = generateuuid();
            $data['user_id']          = $userid;
            $data['position_id']      = $positionid;
            $data['atasan_id']        = $atasanid;
            $data['start_date']       = $date;
            $data['position_primary'] = $type;
            $data['created_by']       = $_SESSION['userid'];
            
            if($this->md->updatepenempatan($data,$transid)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            }else{
                $json['responCode']="01";
                $json['responHead']="error";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function hapuspenempatan(){
            $transid = $this->input->post("modal_data_employee_registrationposition_transid_view");

            $data['active'] = "0";

            if($this->md->updatepenempatan($data,$transid)){
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

        public function nonactivepenempatan(){
            $transid = $this->input->post("modal_data_employee_registrationposition_transid_view");
            
            $data['status']   = "0";
            $data['end_date'] = $date = date("Y-m-d");

            if($this->md->updatepenempatan($data,$transid)){
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

        public function updatekategoritenaga(){
            $userid           = $this->input->post("drawer_data_employee_registrationkategoritenaga_userid_add");
            $classificationid = $this->input->post("drawer_data_employee_registrationkategoritenaga_classifictionid_add");
            $days             = $this->input->post("drawer_data_employee_registrationkategoritenaga_days_add");
            $hours            = $this->input->post("drawer_data_employee_registrationkategoritenaga_hours_add");
            $total            = $this->input->post("drawer_data_employee_registrationkategoritenaga_totalhours_add");

            $data['kategori_id'] = $classificationid;
            $data['duty_days']   = $days;
            $data['duty_hours']  = $hours;
            $data['hours_month'] = $total;

            if($this->md->updateuserdata($data,$userid)){
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