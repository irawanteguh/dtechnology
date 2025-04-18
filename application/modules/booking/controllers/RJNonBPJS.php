<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class RJNonBPJS extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelrjnonbpjs","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-blank","v_rjnonbpjs",$data);
		}

        public function loadcombobox(){
            $resultmasterprovider   = $this->md->masterprovider(ORG_ID);
            $resultmasterpoliklinik = $this->md->masterpoliklinik(ORG_ID);
    
            $provider       = "";
            foreach ($resultmasterprovider as $a) {
                $provider .= "<option value='" . $a->providerid . "'>" . $a->provider . "</option>";
            }

            $poliklinik       = "";
            foreach ($resultmasterpoliklinik as $a) {
                $poliklinik .= "<option value='" . $a->poli_id . "'>" . $a->poli . "</option>";
            }
    
            $data['provider']   = $provider;
            $data['poliklinik'] = $poliklinik;
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
            $poliid = explode('_', $this->input->post('poliid'))[0] ?? null;
            $hariid = $this->input->post('hariid');

            $resultmasterdokter = $this->md->masterdokter(ORG_ID,$poliid,$hariid);

            $doctor="";

            foreach($resultmasterdokter as $a ){
                $doctor.="<option value='".$a->user_id."'>".$a->name."</option>";
            }

            echo $doctor;
        }

        public function jadwaldokter(){
            $poliid   = $this->input->post("poliid");
            $dokterid = $this->input->post("dokterid");
            $hariid   = $this->input->post("hariid");

            $result = $this->md->jadwaldokter(ORG_ID,$poliid,$dokterid,$hariid);
            
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
            $data['org_id']            = ORG_ID;
            $data['episode_id']        = generateuuid();
            $data['booking_id']        = generateUniqueNumber();
            $data['date']              = DateTime::createFromFormat("d.m.Y", $this->input->post("booking_date"))->format("Y-m-d");
            $data['pasien_id_old']     = $this->input->post("booking_nomr");
            $data['hari_id']           = $this->input->post("booking_hariid");
            $data['no_billing']        = $this->md->nobilling()->nobilling;
            $data['slot']              = explode('_', $this->input->post('booking_jadwal_poli_id'))[1] ?? null;
            $data['kuota']             = explode('_', $this->input->post('booking_jadwal_poli_id'))[2] ?? null;
            $data['antrian']           = explode('_', $this->input->post('booking_jadwal_poli_id'))[3] ?? null;
            $data['sisa_antrian']      = explode('_', $this->input->post('booking_jadwal_poli_id'))[4] ?? null;
            $data['jam_mulai']         = explode('_', $this->input->post('booking_jadwal_poli_id'))[5] ?? null;
            $data['jam_selesai']       = explode('_', $this->input->post('booking_jadwal_poli_id'))[6] ?? null;
            $data['provider_id']       = $this->input->post("booking_provider");
            $data['poli_id']           = $this->input->post("booking_poliid");
            $data['dokter_id']         = $this->input->post("booking_doctorid");
            $data['jadwal_poli_id']    = $this->input->post("booking_jadwal_poli_id") ?: "";
            $data['jenis_episode']     = "O";
            $data['kelas_id']          = "6";
            $data['status']            = "00";
            $data['method_registrasi'] = "ONLINE";

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