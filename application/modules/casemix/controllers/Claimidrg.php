<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Claimidrg extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelclaimidrg","md");
        }

		public function index(){
			// $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_claimidrg");
		}

		// public function loadcombobox(){
        //     $resultmastericd10 = $this->md->mastericd10();

        //     $mastericd10="";
        //     foreach($resultmastericd10 as $a ){
        //         $mastericd10.="<option value='".$a->code_2."' data-validcode='".$a->validcode."'>".$a->description."</option>";
        //     }

        //     $data['mastericd10']  = $mastericd10;
        //     return $data;
        // }

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
            $data['medicalrecord']    = generateUniqueNumber();
            $data['name']             = randomgeneatorname();
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
            $body = [
                        "metadata" => [
                            "method" => "new_claim"
                        ],
                        "data" => [
                            "nomor_kartu" => $this->input->post("claim_nokartu"),
                            "nomor_sep"   => $this->input->post("claim_nosep"),
                            "nomor_rm"    => $this->input->post("claim_mr"),
                            "nama_pasien" => $this->input->post("claim_name"),
                            "tgl_lahir"   => "2000-01-01 02:00:00",
                            "gender"      => "2"
                        ]
                    ];

            $response = Inacbg::newclaim(json_encode($body));
            echo json_encode($response);
        }


	}

?>