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
        $result    = $this->md->liststaff($_SESSION['orgid'],$_SESSION['userid'],$_SESSION['periodeidactivity']);
        
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
        $result = $this->md->listassement();
        
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
        $result = $this->md->detailactivity($_SESSION['orgid'],$_SESSION['userid'],$this->input->post("userid"),$_SESSION['periodeidactivity']);
        
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
            $data['periode']       = $_SESSION['periodeidassessment'];
            $data['created_by']    = $_SESSION['userid'];
            $data['assessment_id'] = $assessment['assessment_id'];
            $data['nilai']         = $assessment['nilai'];
            $data['active']        = "1";

            $resultcheckassessment = $this->md->checkassessment($_SESSION['orgid'],$this->input->post("modal_validation_perilaku_userid_add"),$_SESSION['periodeidassessment'],$assessment['assessment_id']);
            
            if(empty($resultcheckassessment)){
                $this->md->insertassessment($data);
            }else{
                $this->md->updateassessment($data,$this->input->post("modal_validation_perilaku_userid_add"),$_SESSION['periodeidassessment'],$assessment['assessment_id']);
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
        $pilih      = $this->input->post('pilih');
        $type       = $this->input->post('type');
        $activityid = $this->input->post('activityid');
        $activity   = $this->input->post('activity');
        $date       = $this->input->post('date');
        $time_in    = $this->input->post('time_in');
        $time_out   = $this->input->post('time_out');
        $status     = $this->input->post('status');
        $userid     = $this->input->post('userid');
    
        $valid = ($status != 'approve') ? '9' : '1';
    
        foreach ($pilih as $transid => $value) {

            if($type[$transid]==="1"){
                $dataupdate['status']        = $valid;
                $dataupdate['validasi_by']   = $_SESSION['userid'];
                $dataupdate['validasi_date'] = (new DateTime())->format('Y-m-d H:i:s');
                
                $hasil = $this->md->validasikegiatan($dataupdate,$transid);
            }else{
                $resultcheckactivity = $this->md->checkactivity($transid);
                $datainsert['org_id']         = $_SESSION['orgid'];
                $datainsert['trans_id']       = $transid;
                $datainsert['ref']            = $transid;
                $datainsert['activity_id']    = $activityid[$transid];
                $datainsert['activity']       = $activity[$transid];
                $datainsert['start_date']     = DateTime::createFromFormat('d.m.Y', $date[$transid])->format('Y-m-d');
                $datainsert['start_time_in']  = $time_in[$transid];
                $datainsert['start_time_out'] = $time_out[$transid];
                $datainsert['end_date']       = DateTime::createFromFormat('d.m.Y', $date[$transid])->format('Y-m-d');
                $datainsert['end_time_in']    = $time_in[$transid];
                $datainsert['end_time_out']   = $time_out[$transid];
                $datainsert['qty']            = 1;
                $datainsert['durasi']         = 3;
                $datainsert['total']          = 3;
                $datainsert['status']         = $valid;
                $datainsert['user_id']        = $userid[$transid];
                $datainsert['atasan_id']      = $_SESSION['userid'];
                $datainsert['validasi_by']    = $_SESSION['userid'];
                $datainsert['validasi_date']  = (new DateTime())->format('Y-m-d H:i:s');
                
                if(empty($resultcheckactivity)){
                    $hasil = $this->md->insertactivity($datainsert);
                }else{
                    $datainsert['active']='1';
                    $hasil = $this->md->validasikegiatan($datainsert,$transid);
                }
                
            }
            
        }

        $json['responCode']="00";
        $json['responHead']="success";
        $json['responDesc']="Validasi Success";

        echo json_encode($json);
    }
    
}
