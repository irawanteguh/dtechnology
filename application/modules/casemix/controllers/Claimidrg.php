<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Claimidrg extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelclaimidrg","md");
        }

		public function index(){
			$data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_claimidrg",$data);
		}

		public function loadcombobox(){
            $resultjeniskelamin = $this->md->jeniskelamin();
            $resultjenisrawat   = $this->md->jenisrawat();
            $resultkelasrawat   = $this->md->kelasrawat();

            // $resultmastericd10 = $this->md->mastericd10();

            // $mastericd10="";
            // foreach($resultmastericd10 as $a ){
            //     $mastericd10.="<option value='".$a->code_2."' data-validcode='".$a->validcode."'>".$a->description."</option>";
            // }

            $jeniskelamin="";
            foreach($resultjeniskelamin as $a ){
                $jeniskelamin.="<option value='".$a->code."'>".$a->keterangan."</option>";
            }

            $jenisrawat="";
            foreach($resultjenisrawat as $a ){
                $jenisrawat.="<option value='".$a->code."'>".$a->keterangan."</option>";
            }

            $kelasrawat="";
            foreach($resultkelasrawat as $a ){
                $kelasrawat.="<option value='".$a->code."'>".$a->keterangan."</option>";
            }

            $data['jeniskelamin'] = $jeniskelamin;
            $data['jenisrawat']   = $jenisrawat;
            $data['kelasrawat']   = $kelasrawat;
            return $data;
        }

        public function mastericd10() {
            $keyword = $this->input->post("keyword");

            $result = $this->md->mastericd10($keyword);

            $data = [];
            foreach ($result as $a) {
                $data[] = [
                    "id"          => $a->code_2,
                    "code_2"      => $a->code_2,
                    "description" => $a->description,
                    "validcode"   => $a->validcode
                ];
            }

            echo json_encode($data);
        }

        public function randomgenerator() {
            $jenisrawat = mt_rand(1, 3);

            $data['medicalrecord']    = generateUniqueNumber();
            $data['name']             = randomgeneatorname();
            $data['tgllahir']         = generateRandomTanggal();
            // $data['tgllahir']         = "2000-01-01 02:00:00";
            $data['sexid']            = "2";
            $data['jenisrawat']       = $jenisrawat;
            
            // return var_dump($jenisrawat);

            if($jenisrawat===1){
                $data['tglmasuk']  = date("Y-m-d H:i:s", strtotime("-3 days"));
                // $data['tglmasuk']  = date("Y-m-d H:i:s", strtotime("-1 hour"));
                $data['tglkeluar'] = date("Y-m-d H:i:s");
            }else{
                $data['tglmasuk']  = date("Y-m-d H:i:s");
                $data['tglkeluar'] = date("Y-m-d H:i:s");
            }

            if($jenisrawat===1){
                $data['kelasrawat'] = mt_rand(1, 3);
            }else{
                $data['kelasrawat'] = 3;
            }

            $data['nokartu']          = generateNoKartuBPJS();
            $data['nosep']            = generateNoSEP();
            $data['tindakannonbedah'] = generateNilaiTindakan();
            $data['tindakanbedah']    = generateNilaiTindakan();
            $data['konsultasi']       = generateNilaiTindakan();
            $data['tenagaahli']       = generateNilaiTindakan();
            $data['keperawatan']      = generateNilaiTindakan();
            $data['penunjang']        = generateNilaiTindakan();
            $data['radiologi']        = generateNilaiTindakan();
            $data['laboratorium']     = generateNilaiTindakan();
            $data['darah']            = generateNilaiTindakan();
            $data['rehab']            = generateNilaiTindakan();
            $data['kamar']            = generateNilaiTindakan();
            $data['intensif']         = generateNilaiTindakan();
            $data['obat']             = generateNilaiTindakan();
            $data['obatkronis']       = generateNilaiTindakan();
            $data['obatkemo']         = generateNilaiTindakan();
            $data['alkes']            = generateNilaiTindakan();
            $data['bmhp']             = generateNilaiTindakan();
            $data['alat']             = generateNilaiTindakan();
            $data['totaltarifrs'] = 
                                    $data['tindakannonbedah'] + $data['tindakanbedah'] + $data['konsultasi'] + 
                                    $data['tenagaahli'] + $data['keperawatan'] + $data['penunjang'] + 
                                    $data['radiologi'] + $data['laboratorium'] + $data['darah'] + 
                                    $data['rehab'] + $data['kamar'] + $data['intensif'] + 
                                    $data['obat'] + $data['obatkronis'] + $data['obatkemo'] + 
                                    $data['alkes'] + $data['bmhp'] + $data['alat'];

            echo json_encode($data);
        }

        public function setklaim(){
            $bodynewclaim = [
                        "metadata" => [
                            "method" => "new_claim"
                        ],
                        "data" => [
                            "nomor_kartu" => $this->input->post("claim_nokartu"),
                            "nomor_sep"   => $this->input->post("claim_nosep"),
                            "nomor_rm"    => $this->input->post("claim_mr"),
                            "nama_pasien" => $this->input->post("claim_name"),
                            // "tgl_lahir"   => $this->input->post("claim_bod"),
                            "tgl_lahir"   => "2000-01-01 02:00:00",
                            "gender"      => $this->input->post("claim_sexid")
                        ]
                    ];

            $responsenewclaim = Inacbg::sendinacbgs(json_encode($bodynewclaim));

            if($responsenewclaim['metadata']['code']===200){
                $bodysetnewclaim = [
                    "metadata" => [
                        "method"    => "set_claim_data",
                        "nomor_sep" => $this->input->post("claim_nosep"),
                    ],
                    "data" => [
                        "nomor_sep"        => $this->input->post("claim_nosep"),
                        "nomor_kartu"      => "0000097208276",
                        // "nomor_kartu"      => $this->input->post("claim_nokartu"),
                        // "tgl_masuk"        => $this->input->post("claim_tglmasuk"),
                        // "tgl_pulang"       => $this->input->post("claim_tglkeluar"),
                        "tgl_masuk"        => "2024-11-09 08:55:00",
                        "tgl_pulang"       => "2024-11-09 09:55:00",
                        "cara_masuk"       => "gp",
                        "jenis_rawat"      => $this->input->post("claim_jenisrawat"),
                        // "kelas_rawat"      => $this->input->post("claim_kelasrawat"),
                        "kelas_rawat"      => "3",
                        "adl_sub_acute"    => "15",
                        "adl_chronic"      => "12",
                        "icu_indikator"    => "0",
                        "icu_los"          => "0",
                        "upgrade_class_ind"=> "0",
                        "add_payment_pct"  => "10",
                        "birth_weight"     => "0",
                        "sistole"          => 110,
                        "diastole"         => 60,
                        "discharge_status" => "1",
                        // "tarif_rs" => [
                        //     "prosedur_non_bedah" => preg_replace('/[^0-9]/', '', $this->input->post("claim_tindakannonbedah")),
                        //     "prosedur_bedah"     => preg_replace('/[^0-9]/', '', $this->input->post("claim_tindakanbedah")),
                        //     "konsultasi"         => preg_replace('/[^0-9]/', '', $this->input->post("claim_konsultasi")),
                        //     "tenaga_ahli"        => preg_replace('/[^0-9]/', '', $this->input->post("claim_tenagaahli")),
                        //     "keperawatan"        => preg_replace('/[^0-9]/', '', $this->input->post("claim_keperawatan")),
                        //     "penunjang"          => preg_replace('/[^0-9]/', '', $this->input->post("claim_penunjang")),
                        //     "radiologi"          => preg_replace('/[^0-9]/', '', $this->input->post("claim_radiologi")),
                        //     "laboratorium"       => preg_replace('/[^0-9]/', '', $this->input->post("claim_laboratorium")),
                        //     "pelayanan_darah"    => preg_replace('/[^0-9]/', '', $this->input->post("claim_darah")),
                        //     "rehabilitasi"       => preg_replace('/[^0-9]/', '', $this->input->post("claim_rehab")),
                        //     "kamar"              => preg_replace('/[^0-9]/', '', $this->input->post("claim_kamar")),
                        //     "rawat_intensif"     => preg_replace('/[^0-9]/', '', $this->input->post("claim_intensif")),
                        //     "obat"               => preg_replace('/[^0-9]/', '', $this->input->post("claim_obat")),
                        //     "obat_kronis"        => preg_replace('/[^0-9]/', '', $this->input->post("claim_obatkronis")),
                        //     "obat_kemoterapi"    => preg_replace('/[^0-9]/', '', $this->input->post("claim_obatkemo")),
                        //     "alkes"              => preg_replace('/[^0-9]/', '', $this->input->post("claim_alkes")),
                        //     "bmhp"               => preg_replace('/[^0-9]/', '', $this->input->post("claim_bmhp")),
                        //     "sewa_alat"          => preg_replace('/[^0-9]/', '', $this->input->post("claim_alat")),
                        // ],
                        "tarif_rs" => [
                            "prosedur_non_bedah" => "300000",
                            "prosedur_bedah"     => "20000000",
                            "konsultasi"         => "300000",
                            "tenaga_ahli"        => "200000",
                            "keperawatan"        => "80000",
                            "penunjang"          => "1000000",
                            "radiologi"          => "500000",
                            "laboratorium"       => "600000",
                            "pelayanan_darah"    => "150000",
                            "rehabilitasi"       => "100000",
                            "kamar"              => "6000000",
                            "rawat_intensif"     => "2500000",
                            "obat"               => "100000",
                            "obat_kronis"        => "1000000",
                            "obat_kemoterapi"    => "5000000",
                            "alkes"              => "500000",
                            "bmhp"               => "400000",
                            "sewa_alat"          => "210000"
                        ],
                        "pemulasaraan_jenazah"      => "1",
                        "kantong_jenazah"           => "1",
                        "peti_jenazah"              => "1",
                        "plastik_erat"              => "1",
                        "desinfektan_jenazah"       => "1",
                        "mobil_jenazah"             => "0",
                        "desinfektan_mobil_jenazah" => "0",
                        "covid19_status_cd"         => "1",
                        "nomor_kartu_t"             => "nik",
                        "episodes"                  => "1;12#2;3#6;5",
                        "akses_naat"                => "C",
                        "isoman_ind"                => "0",
                        "bayi_lahir_status_cd"      => 1,
                        "dializer_single_use"       => "1",
                        "kantong_darah"             => 1,
                        "alteplase_ind"             => 1,
                        "tarif_poli_eks"            => "100000",
                        "nama_dokter"               => "BAMBANG, DR",
                        "kode_tarif"                => "AP",
                        "payor_id"                  => "3",
                        "payor_cd"                  => "JKN",
                        "cob_cd"                    => 0,
                        "coder_nik"                 => "123123123123"
                    ]
                ];

                // return var_dump(json_encode($bodysetnewclaim));
                $responsesetnewclaim = Inacbg::sendinacbgs(json_encode($bodysetnewclaim));

            }

            echo json_encode($responsesetnewclaim);
        }


	}

?>