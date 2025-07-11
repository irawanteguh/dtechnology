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
            $resultmasterprovider     = $this->md->masterprovider();
            $resultmasterdepartment   = $this->md->masterdepartment();
            $resultmasterorganization = $this->md->masterorganization();
            $resultmasterpoliklinik   = $this->md->masterpoliklinik();
            $resultmasterdoctor       = $this->md->masterdoctor(ORG_ID);
    
            $provider     = "";
            $department   = "";
            $organization = "";
            $poliklinik   = "";
            $masterdoctor = "";

            foreach ($resultmasterprovider as $a) {
                $provider .= "<option value='" . $a->providerid . "'>" . $a->provider . "</option>";
            }

            foreach ($resultmasterorganization as $a) {
                $organization .= "<option value='" . $a->org_id . "'>" . $a->org_name . "</option>";
            }

            foreach ($resultmasterdepartment as $a) {
                $department .= "<option value='" . $a->department_id . "'>" . $a->department . "</option>";
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
            $data['department']   = $department;
            $data['organization'] = $organization;
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
            $hariMap = ['0' => 'MINGGU','1' => 'SENIN','2' => 'SELASA','3' => 'RABU','4' => 'KAMIS','5' => 'JUMAT','6' => 'SABTU'];
            $hariId  = explode(',', $this->input->post('hariid'));
            $hari    = implode(', ', array_map(function($i) use ($hariMap) {return $hariMap[trim($i)] ?? 'TIDAK DIKETAHUI';}, $hariId));
            
            
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
            
            $hariMap = ['0' => 'MINGGU','1' => 'SENIN','2' => 'SELASA','3' => 'RABU','4' => 'KAMIS','5' => 'JUMAT','6' => 'SABTU'];
            $hariId  = explode(',', $this->input->post('hariid'));
            $hari    = implode(', ', array_map(function($i) use ($hariMap) {return $hariMap[trim($i)] ?? 'TIDAK DIKETAHUI';}, $hariId));

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
            $norawat      = "B".DateTime::createFromFormat("d.m.Y", $this->input->post("booking_date"))->format("Y/m/d")."/".$jadwal_parts[6];

            $data['no_rkm_medis']   = $this->input->post("booking_nomr");
            $data['tgl_registrasi'] = DateTime::createFromFormat("d.m.Y", $this->input->post("booking_date"))->format("Y-m-d");
            $data['no_rawat']       = $norawat;
            $data['jam_reg']        = $jadwal_parts[4].':00';
            $data['kd_dokter']      = $this->input->post("booking_doctorid");
            $data['kd_poli']        = $this->input->post("booking_poliid");
            $data['no_reg']         = $noreg;
            $data['kd_pj']          = $this->input->post("booking_provider");
            $data['p_jawab']        = "-";
            $data['almt_pj']        = "-";
            $data['hubunganpj']     = "DIRI SENDIRI";
            $data['biaya_reg']      = 15000;
            $data['stts']           = "Belum";
            $data['stts_daftar']    = "Lama";
            $data['status_bayar']   = "Belum Bayar";

            if($this->md->insertepisode($data)){
                $databooking=$this->md->databooking($norawat);

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

        public function insertsaran(){
            $code = generateUniqueNumber();

            $data['org_id']        = $this->input->post("rssaran");
            $data['trans_id']      = $this->input->post("saranmasukanid");
            $data['code']          = $code;
            $data['nama']          = $this->input->post("namapasiensaran");
            $data['no_identitas']  = $this->input->post("noktppasiensaran");
            $data['no_hp']         = $this->input->post("notlpsaran");
            $data['nama_petugas']  = $this->input->post("namapetugassaran");
            $data['lantai']        = $this->input->post("ruangansaran");
            $data['department_id'] = $this->input->post("departmentsaran");
            $data['saran']         = $this->input->post("sarandanmasukansaran");

            if($this->md->insertepisode($data)){
                $datasaran = $this->md->datasaran($this->input->post("saranmasukanid"));
                $refId     = $this->input->post("saranmasukanid");
                $orgId     = $this->input->post("rssaran");

                // === Kirim ke user ===
                $text  = "*{$datasaran[0]->nameorg}*";
                $text .= "%0a*RMB Hospital Group*";
                $text .= "%0a%0aKepada Yth,.";
                $text .= "%0a*{$datasaran[0]->nama}*%0a";
                $text .= "%0aTerima Kasih atas Masukan Anda";
                $text .= "%0aSaran dan masukan Anda telah berhasil dikirim.";
                $text .= "%0aKami menghargai kontribusi Anda dalam meningkatkan layanan kami.";
                $text .= "%0aSilakan Simpan Kode Laporan Anda : *{$datasaran[0]->code}*";
                $text .= "%0a%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $orgId,
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => '1234',
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $this->input->post("notlpsaran"))),
                    'ref_id'       => $refId,
                    'type_file'    => '0'
                ]);

                // === Kirim ke marketing ===
                $text  = "*{$datasaran[0]->nameorg}*";
                $text .= "%0a*RMB Hospital Group*";
                $text .= "%0a%0aKepada Yth,.";
                $text .= "%0a*{$datasaran[0]->namamarketing}*%0a";
                $text .= "%0aMohon tindaklanjuti saran dan masukan";
                $text .= "%0a%0aAtasnama%09: {$datasaran[0]->nama}";
                $text .= "%0aKode Laporan%09: {$datasaran[0]->code}";
                $text .= "%0a%0a_Mohon untuk tidak membalas pesan ini_%0a_Pesan ini dibuat secara otomatis oleh_%0a*Smart Assistant RMB Hospital Group*";

                $this->md->simpanboardcast([
                    'org_id'       => $orgId,
                    'transaksi_id' => generateuuid(),
                    'body_1'       => $text,
                    'device_id'    => '1234',
                    'no_hp'        => preg_replace('/^0/', '62', preg_replace('/\D/', '', $datasaran[0]->nohpmarketing)),
                    'ref_id'       => $refId,
                    'type_file'    => '0'
                ]);


                $json['responCode']   = "00";
                $json['responHead']   = "success";
                $json['responDesc']   = "Data Added Successfully";
                $json['responResult'] = $datasaran;
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }
            
            echo json_encode($json);
        }

        public function uploadbukti(){
            $transid= $_GET['transid'];

            $config['upload_path']   = './assets/crm/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());

                log_message('error', 'File upload error: ' . implode(' ', $error));
                echo json_encode($error);
            } else {
                echo "Upload Success";
            }

        }

	}
?>