<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Activity extends CI_Controller{

	public function __construct(){
		parent::__construct();
		rootsystem::system();
		$this->load->model("Modelactivity", "md");
	}

	public function index(){
		$data = $this->loadcombobox();
		$this->template->load("template/template-sidebar", "v_activity", $data);
	}

	public function loadcombobox(){
		$resultcekklinisid = $this->md->cekklinisid($_SESSION['orgid'],$_SESSION['groupid'],$_SESSION['userid']);

		if ($resultcekklinisid->klinis_id != "") {
			$pk = "and klinis_id = '".$resultcekklinisid->klinis_id."'";
		}else{
			$pk = "and klinis_id is null";
		}

		$resultactivity = $this->md->activity($_SESSION['groupid'],$_SESSION['userid'],$pk);
		$activity       = "";
		foreach ($resultactivity as $a) {
			$activity .= "<option value='" . $a->activity_id . "'>" . $a->activity . "</option>";
		}

		$data['activity'] = $activity;

		return $data;
	}

	public function calender(){
		$result = $this->md->calender($_SESSION['orgid'],$_SESSION['userid']);
		$events = array();

		foreach ($result as $a) {

			$data['transid']        = $a->trans_id;
			$data['title']          = $a->kegiatanutama;
			$data['kegiatandetail'] = $a->activity;
			$data['start']          = $a->start_date;
			$data['end']            = $a->end_date;
			$data['validator']      = $a->validatorkegiatan;

			if($a->status === "0"){
				$data['color']     = '#0d6efd';
			}

			if($a->status === "1"){
				$data['color']     = '#00a65a';
			}

			if($a->status === "2"){
				$data['color']     = '#ffc107';
			}

			if($a->status === "9"){
				$data['color']     = '#dc3545';
			}
			
			$events[] = $data;
		};

		echo json_encode($events);
	}

	public function volume(){
		$kegiatanid      = $this->input->post('kegiatan');
		$kegiatanidarray = explode(":", $kegiatanid);

		$mulaikegiatan   = $this->input->post('mulaikegiatan');
		$selesaikegiatan = $this->input->post('selesaikegiatan');

		$lisvol = $this->md->volume($_SESSION['groupid'],$kegiatanidarray[0],$mulaikegiatan,$selesaikegiatan,);
		$list   = "";

		foreach ($lisvol as $d) {
			$list .= "<option value='" . $d->vol . "'>" . $d->vol . "</option>";
		}

		echo $list;
	}

	public function insertactivity(){
		$activityid       = $this->input->post("data_activity_primaryactivity_add");
		$activityIdsArray = explode(":", $activityid);
	
		$resultcekklinisactivity = $this->md->cekklinisactivity($activityIdsArray[0]);
		if($resultcekklinisactivity->pk === ""){
			$paramater         = "and   a.position_primary='Y'";
		}else{
			$paramater         = "and   a.position_id in (select position_id from dt01_hrd_mapping_activity where org_id=a.org_id and active='1' and activity_id='".$activityIdsArray[0]."')";
		}

		$resultcekatasanid = $this->md->cekatasanid($_SESSION['orgid'],$_SESSION['userid'],$paramater);
		$atasanid = $resultcekatasanid->atasan_id;      
		
		$start_date     = DateTime::createFromFormat("d.m.Y", $this->input->post("data_activity_date_add"))->format("Y-m-d");
		$start_time_in  = $this->input->post("data_activity_time_start_add");
		$end_time_out   = $this->input->post("data_activity_time_end_add");
	
		if (strlen($start_time_in) < 5 || strlen($end_time_out) < 5) {
			$json['responCode'] = "01";
			$json['responHead'] = "error";
			$json['responDesc'] = "Mohon Periksa Kembali Format Jam Mulai dan atau Jam Selesai HH24:MI";
		} else {
			$conflict = $this->md->cekKegiatan($_SESSION['orgid'], $_SESSION['userid'], $start_date, $start_time_in, $end_time_out);
		
			if (!empty($conflict)) {
				$json['responCode'] = "01";
				$json['responHead'] = "error";
				$json['responDesc'] = "Terdapat kegiatan lain pada waktu tersebut.";
			} else {
				$data['org_id']         = $_SESSION['orgid'];
				$data['trans_id']       = generateuuid();
				$data['activity_id']    = $activityIdsArray[0];
				$data['durasi']         = $activityIdsArray[1];
				$data['total']          = intval($this->input->post("data_activity_volume_add")) * intval($activityIdsArray[1]);
				$data['activity']       = $this->input->post("data_activity_description_add");
				$data['start_date']     = $start_date;
				$data['start_time_in']  = $start_time_in;
				$data['start_time_out'] = $end_time_out;
				$data['end_date']       = $start_date;
				$data['end_time_in']    = $start_time_in;
				$data['end_time_out']   = $end_time_out;
				$data['qty']            = $this->input->post("data_activity_volume_add");
				$data['user_id']        = $_SESSION['userid'];
				$data['atasan_id']      = $atasanid;
		
				if($this->md->insertactivity($data)){
					$json['responCode'] = "00";
					$json['responHead'] = "success";
					$json['responDesc'] = "Tambah Activity Berhasil";
				}else{
					$json['responCode'] = "01";
					$json['responHead'] = "info";
					$json['responDesc'] = "Tambah Activity Gagal";
				}
			}
		}	
	
		echo json_encode($json);
	}

	public function hapusactivity(){
		$transid           = $this->input->post("transid");

		$data['active'] = "0";

		if($this->md->updateactivity($data,$transid)){
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
