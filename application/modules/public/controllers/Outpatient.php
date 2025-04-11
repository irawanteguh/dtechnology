<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Outpatient extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeloutpatient","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-public","v_outpatient",$data);
		}

        public function loadcombobox(){
            $resultmasterprovider   = $this->md->masterprovider();
            $resultmasterpoliklinik = $this->md->masterpoliklinik();
            $resultmasterdoctor     = $this->md->masterdoctor(ORG_ID);
    
            $provider     = "";
            $poliklinik   = "";
            $masterdoctor = "";

            foreach ($resultmasterprovider as $a) {
                $provider .= "<option value='" . $a->providerid . "'>" . $a->provider . "</option>";
            }

            foreach ($resultmasterpoliklinik as $a) {
                $poliklinik .= "<option value='" . $a->poli_id . "'>" . $a->poli . "</option>";
            }

            foreach($resultmasterdoctor as $a ){
                $image_url = base_url('assets/images/avatars/'.$a->user_id.'.png');

                $masterdoctor .= "<div class='text-center'>";
                    $masterdoctor .= "<div class='octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center' style='background-image: url(\"$image_url\")'></div>";
                    $masterdoctor .= "<div class='mb-0'>";
                        $masterdoctor .= "<a href='#' class='text-dark fw-bolder text-hover-primary fs-3'>".$a->name."</a>";
                        $masterdoctor .= "<div class='text-muted fs-6 fw-bold mt-1'>".$a->kolegium."</div>";
                    $masterdoctor .= "</div>";
                $masterdoctor .= "</div>";
            }
            
    
            $data['provider']     = $provider;
            $data['poliklinik']   = $poliklinik;
            $data['masterdoctor'] = $masterdoctor;

            return $data;
        }

		public function datapasien(){
            $parameter = $this->input->post("identitaspasien");
            $result = $this->md->datapasien($parameter);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
                $json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }

        public function masterdokter(){
            $hariMap = [
                '0' => 'MINGGU',
                '1' => 'SENIN',
                '2' => 'SELASA',
                '3' => 'RABU',
                '4' => 'KAMIS',
                '5' => 'JUMAT',
                '6' => 'SABTU'
            ];
            
            $hariId = explode(',', $this->input->post('hariid'));
            $hari = implode(', ', array_map(function($i) use ($hariMap) {return $hariMap[trim($i)] ?? 'TIDAK DIKETAHUI';}, $hariId));
            
            
            $resultmasterdokter = $this->md->masterdokter($this->input->post('poliid'),$hari);

            $doctor="";

            foreach($resultmasterdokter as $a ){
                $doctor.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            echo $doctor;
        }

        public function jadwaldokter(){
            $poliid   = $this->input->post("poliid");
            $dokterid = $this->input->post("dokterid");
            $date     = $this->input->post("date");
            $hari     = implode(', ', array_map(fn($i) => ['0'=>'MINGGU','1'=>'SENIN','2'=>'SELASA','3'=>'RABU','4'=>'KAMIS','5'=>'JUMAT','6'=>'SABTU'][$i] ?? 'TIDAK DIKETAHUI', explode(',', $this->input->post('hariid'))));


            $result = $this->md->jadwaldokter($poliid,$hari,$dokterid,date('Y-m-d',strtotime(str_replace('.', '-', $date))));
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Successfully Found";
                $json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Failed to Find";
            }

            echo json_encode($json);
        }

        public function insertepisode(){
            $jadwal_parts = explode('_', $this->input->post('booking_jadwal_poli_id'));
            $noreg        = (isset($jadwal_parts[0]) && isset($jadwal_parts[2]))? $jadwal_parts[0] . $jadwal_parts[2]: null;

            $data['tanggal_booking'] = date('Y-m-d');
            $data['jam_booking']     = date('H:i:s');
            $data['no_rkm_medis']    = $this->input->post("booking_nomr");
            $data['tanggal_periksa'] = DateTime::createFromFormat("d.m.Y", $this->input->post("booking_date"))->format("Y-m-d");
            $data['kd_dokter']       = $this->input->post("booking_doctorid");
            $data['kd_poli']         = $this->input->post("booking_poliid");
            $data['no_reg']          = $noreg;
            $data['kd_pj']           = $this->input->post("booking_provider");
            $data['limit_reg']       = 0;
            $data['waktu_kunjungan'] = (isset($jadwal_parts[2]))? $data['tanggal_periksa'].' '.$jadwal_parts[4] . ':00': null;
            $data['status']          = "Belum";

            if($this->md->insertepisode($data)){
                $databooking=$this->md->databooking($this->input->post("booking_nomr"));

                $json['responCode']   = "00";
                $json['responHead']   = "success";
                $json['responDesc']   = "Data Added Successfully";
                $json['responResult'] = $databooking;
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }
            
            echo json_encode($json);
        }

	}
?>