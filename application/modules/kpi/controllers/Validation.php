<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Validation extends CI_Controller{

	public function __construct(){
		parent::__construct();
		rootsystem::system();
		$this->load->model("Modelvalidation", "md");
	}

	public function index(){
		$this->template->load("template/template-sidebar", "v_validation");
	}

    public function liststaff(){
        $periodeid          = $this->input->post('periodeid');
        $result = $this->md->liststaff($_SESSION['orgid'],$_SESSION['userid'],$periodeid);
        
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

    public function listassement(){
        $result = $this->md->listassement($_SESSION['orgid']);
        
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

    public function detailactivity(){
        $result = $this->md->detailactivity($_SESSION['orgid'],$_SESSION['userid'],$this->input->post("userid"));
        
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

    public function insertassessment(){
        $assessment_ids = $this->input->post('assessment_ids');
        $nilai          = $this->input->post('nilai');
    
        if (!is_array($assessment_ids)) {
            $assessment_ids = [];
        }
        if (!is_array($nilai)) {
            $nilai = [];
        }
    
        $assessments = [];
        for ($i = 0; $i < count($assessment_ids); $i++) {
            $assessments[] = [
                'assessment_id' => $assessment_ids[$i],
                'nilai'         => $nilai[$i]
            ];
        }
    
        $this->db->trans_start();
    
        foreach ($assessments as $assessment) {
            $data['org_id']        = $_SESSION['orgid'];
            $data['transaksi_id']  = generateuuid();
            $data['user_id']       = $this->input->post("modal_validation_perilaku_userid_add");
            $data['periode']       = $this->input->post("modal_validation_perilaku_periodeid_add");
            $data['created_by']    = $_SESSION['userid'];
            $data['assessment_id'] = $assessment['assessment_id'];
            $data['nilai']         = $assessment['nilai'];

            $resultcheckassessment = $this->md->checkassessment($_SESSION['orgid'],$this->input->post("modal_validation_perilaku_userid_add"),$this->input->post("modal_validation_perilaku_periodeid_add"),$assessment['assessment_id']);
            
            if(empty($resultcheckassessment)){
                $this->md->insertassessment($data);
            }else{
                $this->md->updateassessment($data,$this->input->post("modal_validation_perilaku_userid_add"),$this->input->post("modal_validation_perilaku_periodeid_add"),$assessment['assessment_id']);
            }
            
        }
    
        // Complete transaction
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            $json["responCode"] = "01";
            $json["responHead"] = "info";
            $json["responDesc"] = "Data Tidak Di Temukan";
        } else {
            $json["responCode"] = "00";
            $json["responHead"] = "success";
            $json["responDesc"] = "Data Di Temukan";
        }
    
        echo json_encode($json);
    }


    public function validationactivity() {
        $pilih = $this->input->post('pilih');
        $status = $this->input->post('status');
    
        $valid = ($status === 'approve') ? '1' : '9';
    
        foreach($pilih as $transid => $value ) {
            $data['STATUS']        = $valid;
            $data['VALIDASI_BY']   = $_SESSION['userid'];
            $data['VALIDASI_DATE'] = (new DateTime())->format('Y-m-d H:i:s');
            
            $hasil = $this->md->validasikegiatan($data,$transid);
        }

        $json['responCode']="00";
        $json['responHead']="success";
        $json['responDesc']="Validasi Success";

        echo json_encode($json);
    }
    
    
    
}
