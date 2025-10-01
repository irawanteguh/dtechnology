<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Masterppk extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelmasterppk","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_masterppk");
		}

		public function masterdatappk(){
            $result = $this->md->masterdatappk();
            
			if(!empty($result)){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = "We Get The Data You Want";
				$json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

		public function detaildiagnosappk(){
			$datatransaksiid = $this->input->post("datatransaksiid");
			$result          = $this->md->detaildiagnosappk($datatransaksiid);
            
			if(!empty($result)){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = "We Get The Data You Want";
				$json['responResult'] = $result;
            }else{
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "We Didn't Get The Data You Wanted";
            }

            echo json_encode($json);
        }

		public function addppk(){
			$datatransaksiid      = "5c5b6d4c-b890-40af-aadd-8c9cb2db2362";
			$data['org_id']       = $_SESSION['orgid'];
			$data['transaksi_id'] = $datatransaksiid;
			$data['name']         = $this->input->post("modal_add_ppk_name");
			$data['created_by']   = $_SESSION['userid'];
            
			if($this->md->insertdatappk($data)){
				$body = [
					"metadata" => [
						"method" => "new_claim"
					],
					"data" => [
						"nomor_kartu" => "1111111111111",
						"nomor_sep"   => $datatransaksiid,
						"nomor_rm"    => "123456",
						"nama_pasien" => "Pasien Testing",
						"tgl_lahir"   => "2000-01-01 02:00:00",
						"gender"      => "1"
					]
				];

				$response = Inacbg::sendinacbgs(json_encode($body));
				if($response['metadata']['code']===200){
					$dataupdate['status']="1";
					if($this->md->updateppk($dataupdate,$datatransaksiid)){
						$body = [
							"metadata" => [
								"method"    => "set_claim_data",
								"nomor_sep" => $datatransaksiid,
							],
							"data" => [
								"nomor_sep"         => $datatransaksiid,
								"nomor_kartu"       => "1111111111111",
								"tgl_masuk"         => "2024-11-09 08:55:00",
								"tgl_pulang"        => "2024-11-09 09:55:00",
								"cara_masuk"        => "gp",
								"jenis_rawat"       => "1",
								"kelas_rawat"       => "3",
								"adl_sub_acute"     => "60",
								"adl_chronic"       => "60",
								"icu_indikator"     => "0",
								"icu_los"           => "0",
								"upgrade_class_ind" => "0",
								"add_payment_pct"   => "0",
								"birth_weight"      => "0",
								"sistole"           => 0,
								"diastole"          => 0,
								"discharge_status"  => "1",
								"tarif_rs" => [
									"prosedur_non_bedah" => "0",
									"prosedur_bedah"     => "0",
									"konsultasi"         => "0",
									"tenaga_ahli"        => "0",
									"keperawatan"        => "0",
									"penunjang"          => "0",
									"radiologi"          => "0",
									"laboratorium"       => "0",
									"pelayanan_darah"    => "0",
									"rehabilitasi"       => "0",
									"kamar"              => "0",
									"rawat_intensif"     => "0",
									"obat"               => "0",
									"obat_kronis"        => "0",
									"obat_kemoterapi"    => "0",
									"alkes"              => "0",
									"bmhp"               => "0",
									"sewa_alat"          => "0"
								],
								"pemulasaraan_jenazah"      => "0",
								"kantong_jenazah"           => "0",
								"peti_jenazah"              => "0",
								"plastik_erat"              => "0",
								"desinfektan_jenazah"       => "0",
								"mobil_jenazah"             => "0",
								"desinfektan_mobil_jenazah" => "0",
								"covid19_status_cd"         => "0",
								"nomor_kartu_t"             => "nik",
								"episodes"                  => "",
								"akses_naat"                => "C",
								"isoman_ind"                => "0",
								"bayi_lahir_status_cd"      => 1,
								"dializer_single_use"       => "0",
								"kantong_darah"             => 0,
								"alteplase_ind"             => 0,
								"tarif_poli_eks"            => "0",
								"nama_dokter"               => "BAMBANG, DR",
								"kode_tarif"                => "AP",
								"payor_id"                  => "3",
								"payor_cd"                  => "JKN",
								"cob_cd"                    => 0,
								"coder_nik"                 => "123123123123"
							]
						];

						$response = Inacbg::sendinacbgs(json_encode($body));
						if($response['metadata']['code']===200){
							$dataupdate['status']="2";
							if($this->md->updateppk($dataupdate,$datatransaksiid)){
								$json["responCode"]   = "00";
								$json["responHead"]   = "success";
								$json["responDesc"]   = "Data has been successfully added.";
								$json['responResult'] = $response;
							}
						}
					}					
				}
			}else{
				$json["responCode"] = "01";
				$json["responHead"] = "error";
				$json["responDesc"] = "Failed to add data.";
			}

            echo json_encode($json);
        }

		// public function groupingidrg(){
		// 	$datatransaksiid=$this->input->post("datatransaksiid");

		// 	$bodynewclaim = [
		// 		"metadata" => [
		// 			"method" => "new_claim"
		// 		],
		// 		"data" => [
		// 			"nomor_kartu" => "1111111111111",
		// 			"nomor_sep"   => $datatransaksiid,
		// 			"nomor_rm"    => "123456",
		// 			"nama_pasien" => "Pasien Testing",
		// 			"tgl_lahir"   => "2000-01-01 02:00:00",
		// 			"gender"      => "1"
		// 		]
		// 	];

		// 	$responsenewclaim = Inacbg::sendinacbgs(json_encode($bodynewclaim));
		// 	if($responsenewclaim['metadata']['code']===400 && $responsenewclaim['metadata']['error_no']==="E2007"){
		// 		$bodysetnewclaim = [
        //             "metadata" => [
        //                 "method"    => "set_claim_data",
        //                 "nomor_sep" => $datatransaksiid,
        //             ],
        //             "data" => [
        //                 "nomor_sep"        => $datatransaksiid,
        //                 "nomor_kartu"      => "1111111111111",
        //                 "tgl_masuk"        => "2024-11-09 08:55:00",
        //                 "tgl_pulang"       => "2024-11-09 09:55:00",
        //                 "cara_masuk"       => "gp",
        //                 "jenis_rawat"      => "1",
        //                 "kelas_rawat"      => "3",
        //                 "adl_sub_acute"    => "60",
        //                 "adl_chronic"      => "-",
        //                 "icu_indikator"    => "0",
        //                 "icu_los"          => "0",
        //                 "upgrade_class_ind"=> "0",
        //                 "add_payment_pct"  => "-",
        //                 "birth_weight"     => "0",
        //                 "sistole"          => 0,
        //                 "diastole"         => 0,
        //                 "discharge_status" => "1",
        //                 "tarif_rs" => [
        //                     "prosedur_non_bedah" => "0",
        //                     "prosedur_bedah"     => "0",
        //                     "konsultasi"         => "0",
        //                     "tenaga_ahli"        => "0",
        //                     "keperawatan"        => "0",
        //                     "penunjang"          => "0",
        //                     "radiologi"          => "0",
        //                     "laboratorium"       => "0",
        //                     "pelayanan_darah"    => "0",
        //                     "rehabilitasi"       => "0",
        //                     "kamar"              => "0",
        //                     "rawat_intensif"     => "0",
        //                     "obat"               => "0",
        //                     "obat_kronis"        => "0",
        //                     "obat_kemoterapi"    => "0",
        //                     "alkes"              => "0",
        //                     "bmhp"               => "0",
        //                     "sewa_alat"          => "0"
        //                 ],
        //                 "pemulasaraan_jenazah"      => "1",
        //                 "kantong_jenazah"           => "1",
        //                 "peti_jenazah"              => "1",
        //                 "plastik_erat"              => "1",
        //                 "desinfektan_jenazah"       => "1",
        //                 "mobil_jenazah"             => "0",
        //                 "desinfektan_mobil_jenazah" => "0",
        //                 "covid19_status_cd"         => "1",
        //                 "nomor_kartu_t"             => "nik",
        //                 "episodes"                  => "1;12#2;3#6;5",
        //                 "akses_naat"                => "C",
        //                 "isoman_ind"                => "0",
        //                 "bayi_lahir_status_cd"      => 1,
        //                 "dializer_single_use"       => "1",
        //                 "kantong_darah"             => 1,
        //                 "alteplase_ind"             => 1,
        //                 "tarif_poli_eks"            => "0",
        //                 "nama_dokter"               => "BAMBANG, DR",
        //                 "kode_tarif"                => "AP",
        //                 "payor_id"                  => "3",
        //                 "payor_cd"                  => "JKN",
        //                 "cob_cd"                    => 0,
        //                 "coder_nik"                 => "123123123123"
        //             ]
        //         ];

		// 		$responsesetnewclaim = Inacbg::sendinacbgs(json_encode($bodysetnewclaim));
		// 		// return var_dump($responsesetnewclaim);

		// 		if(($responsesetnewclaim['metadata']['code']===200) || ($responsesetnewclaim['metadata']['code']===400 && $responsesetnewclaim['metadata']['error_no']==="E2102")){
		// 			$resultdiagnosaset = $this->md->diagnosaset($datatransaksiid);

		// 			$bodydiagnosaset = [
		// 				"metadata" => [
		// 					"method" => "idrg_diagnosa_set",
		// 					"nomor_sep" => $datatransaksiid,
		// 				],
		// 				"data" => [
		// 					"diagnosa" => $resultdiagnosaset->resultdiagnosa,
		// 				]
		// 			];

		// 			$responsediagnosaset = Inacbg::sendinacbgs(json_encode($bodydiagnosaset));
		// 			// return var_dump($responsediagnosaset);

		// 			if(($responsediagnosaset['metadata']['code']===200) || ($responsediagnosaset['metadata']['code']===400 && $responsediagnosaset['metadata']['error_no']==="E2102")){
		// 				$resultprocedureset = $this->md->procedureset($datatransaksiid);

		// 				$bodyprocedureset = [
		// 					"metadata" => [
		// 						"method" => "idrg_procedure_set",
		// 						"nomor_sep" => $datatransaksiid,
		// 					],
		// 					"data" => [
		// 						"procedure" => $resultprocedureset->resultprocedure,
		// 					]
		// 				];

		// 				$responseprocedureset = Inacbg::sendinacbgs(json_encode($bodyprocedureset));
		// 				// return var_dump($responseprocedureset);

		// 				if(($responseprocedureset['metadata']['code']===200) || ($responseprocedureset['metadata']['code']===400 && $responseprocedureset['metadata']['error_no']==="E2102")){
		// 					$bodygroupingidrg = [
		// 						"metadata" => [
		// 							"method"  => "grouper",
		// 							"stage"   => "1",
		// 							"grouper" => "idrg"
		// 						],
		// 						"data" => [
		// 							"nomor_sep" => $datatransaksiid
		// 						]
		// 					];

		// 					$responsegroupingidrg = Inacbg::sendinacbgs(json_encode($bodygroupingidrg));
		// 					// return var_dump($responsegroupingidrg);

		// 					if(($responsegroupingidrg['metadata']['code']===200) || ($responsegroupingidrg['metadata']['code']===400 && $responsegroupingidrg['metadata']['error_no']==="E2102")){
		// 						$bodyfinalidrg = [
		// 							"metadata" => [
		// 								"method"  => "idrg_grouper_final"
		// 							],
		// 							"data" => [
		// 								"nomor_sep" => $datatransaksiid
		// 							]
		// 						];

		// 						$responsefinalidrg = Inacbg::sendinacbgs(json_encode($bodyfinalidrg));
		// 						// return var_dump($responsefinalidrg);

		// 						if(($responsefinalidrg['metadata']['code']===200) || ($responsefinalidrg['metadata']['code']===400 && $responsefinalidrg['metadata']['error_no']==="E2102")){
		// 							$bodyimportinacbgs = [
		// 								"metadata" => [
		// 									"method"  => "idrg_to_inacbg_import"
		// 								],
		// 								"data" => [
		// 									"nomor_sep" => $datatransaksiid
		// 								]
		// 							];

		// 							$responseimportinacbgs = Inacbg::sendinacbgs(json_encode($bodyimportinacbgs));
		// 							// return var_dump($responseimportinacbgs);

		// 							if(($responseimportinacbgs['metadata']['code']===200) || ($responseresponseimportinacbgsfinalidrg['metadata']['code']===400 && $responseimportinacbgs['metadata']['error_no']==="E2102")){
		// 								$bodygroupinginacbgs_satu = [
		// 									"metadata" => [
		// 										"method"  => "grouper",
		// 										"stage"  => "1",
		// 										"grouper"  => "inacbg"
		// 									],
		// 									"data" => [
		// 										"nomor_sep" => $datatransaksiid
		// 									]
		// 								];

		// 								$responsegroupinginacbgs_satu = Inacbg::sendinacbgs(json_encode($bodygroupinginacbgs_satu));
		// 								return var_dump($responsegroupinginacbgs_satu);
		// 							}
		// 						}
		// 					}
		// 				}
		// 			}
		// 		}
		// 	}
        // }

		// public function newclaim(){
		// 	$datatransaksiid=$this->input->post("datatransaksiid");

		// 	$body = [
		// 		"metadata" => [
		// 			"method" => "new_claim"
		// 		],
		// 		"data" => [
		// 			"nomor_kartu" => "1111111111111",
		// 			"nomor_sep"   => $datatransaksiid,
		// 			"nomor_rm"    => "123456",
		// 			"nama_pasien" => "Pasien Testing",
		// 			"tgl_lahir"   => "2000-01-01 02:00:00",
		// 			"gender"      => "1"
		// 		]
		// 	];

		// 	$response = Inacbg::sendinacbgs(json_encode($body));
		// 	// return var_dump($response);

		// 	if($response['metadata']['code']===200){
		// 		$json["responCode"]   = "00";
		// 		$json["responHead"]   = "success";
		// 		$json["responDesc"]   = $response['metadata']['message'];
		// 		$json['responResult'] = $response;
		// 	}else{
		// 		if($response['metadata']['code']===400 && $response['metadata']['error_no']==="E2001"){
		// 			$json["responCode"]   = "01";
		// 			$json["responHead"]   = "error";
		// 		}else{
		// 			$json["responCode"]   = "02";
		// 			$json["responHead"]   = "info";
		// 		}
				
		// 		$json["responDesc"]   = $response['metadata']['message'];
		// 		$json['responResult'] = $response;
		// 	}
			
		// 	echo json_encode($json);
        // }

		// public function newclaimdata(){
		// 	$datatransaksiid=$this->input->post("datatransaksiid");

		// 	$body = [
		// 		"metadata" => [
		// 			"method"    => "set_claim_data",
		// 			"nomor_sep" => $datatransaksiid,
		// 		],
		// 		"data" => [
		// 			"nomor_sep"         => $datatransaksiid,
		// 			"nomor_kartu"       => "1111111111111",
		// 			"tgl_masuk"         => "2024-11-09 08:55:00",
		// 			"tgl_pulang"        => "2024-11-09 09:55:00",
		// 			"cara_masuk"        => "gp",
		// 			"jenis_rawat"       => "1",
		// 			"kelas_rawat"       => "3",
		// 			"adl_sub_acute"     => "60",
		// 			"adl_chronic"       => "60",
		// 			"icu_indikator"     => "0",
		// 			"icu_los"           => "0",
		// 			"upgrade_class_ind" => "0",
		// 			"add_payment_pct"   => "0",
		// 			"birth_weight"      => "0",
		// 			"sistole"           => 0,
		// 			"diastole"          => 0,
		// 			"discharge_status"  => "1",
		// 			"tarif_rs" => [
		// 				"prosedur_non_bedah" => "0",
		// 				"prosedur_bedah"     => "0",
		// 				"konsultasi"         => "0",
		// 				"tenaga_ahli"        => "0",
		// 				"keperawatan"        => "0",
		// 				"penunjang"          => "0",
		// 				"radiologi"          => "0",
		// 				"laboratorium"       => "0",
		// 				"pelayanan_darah"    => "0",
		// 				"rehabilitasi"       => "0",
		// 				"kamar"              => "0",
		// 				"rawat_intensif"     => "0",
		// 				"obat"               => "0",
		// 				"obat_kronis"        => "0",
		// 				"obat_kemoterapi"    => "0",
		// 				"alkes"              => "0",
		// 				"bmhp"               => "0",
		// 				"sewa_alat"          => "0"
		// 			],
		// 			"pemulasaraan_jenazah"      => "0",
		// 			"kantong_jenazah"           => "0",
		// 			"peti_jenazah"              => "0",
		// 			"plastik_erat"              => "0",
		// 			"desinfektan_jenazah"       => "0",
		// 			"mobil_jenazah"             => "0",
		// 			"desinfektan_mobil_jenazah" => "0",
		// 			"covid19_status_cd"         => "0",
		// 			"nomor_kartu_t"             => "nik",
		// 			"episodes"                  => "",
		// 			"akses_naat"                => "C",
		// 			"isoman_ind"                => "0",
		// 			"bayi_lahir_status_cd"      => 1,
		// 			"dializer_single_use"       => "0",
		// 			"kantong_darah"             => 0,
		// 			"alteplase_ind"             => 0,
		// 			"tarif_poli_eks"            => "0",
		// 			"nama_dokter"               => "BAMBANG, DR",
		// 			"kode_tarif"                => "AP",
		// 			"payor_id"                  => "3",
		// 			"payor_cd"                  => "JKN",
		// 			"cob_cd"                    => 0,
		// 			"coder_nik"                 => "123123123123"
		// 		]
		// 	];

		// 	$response = Inacbg::sendinacbgs(json_encode($body));
		// 	// return var_dump($response);

		// 	if($response['metadata']['code']===200){
		// 		$json["responCode"]   = "00";
		// 		$json["responHead"]   = "success";
		// 		$json["responDesc"]   = $response['metadata']['message'];
		// 		$json['responResult'] = $response;
		// 	}else{
		// 		if($response['metadata']['code']===400 && $response['metadata']['error_no']==="E2102"){
		// 			$json["responCode"]   = "01";
		// 			$json["responHead"]   = "info";
		// 			$json["responDesc"]   = $response['metadata']['message'];
		// 			$json['responResult'] = $response;
		// 		}
		// 	}

		// 	echo json_encode($json);
        // }

		public function setdiagnosaidrg(){
			$datatransaksiid   = $this->input->post("datatransaksiid");
			$resultdiagnosaset = $this->md->diagnosaset($datatransaksiid);

			$body = [
				"metadata" => [
					"method" => "idrg_diagnosa_set",
					"nomor_sep" => $datatransaksiid,
				],
				"data" => [
					"diagnosa" => $resultdiagnosaset->resultdiagnosa,
				]
			];

			$response = Inacbg::sendinacbgs(json_encode($body));
			if($response['metadata']['code']===200){
				foreach ($response['data']['expanded'] as $row) {
					if(isset($row['metadata']['code']) && $row['metadata']['code'] == 200){
						$dataupdate['status']="1";
						$this->md->updateicd($dataupdate,$datatransaksiid,$row['code']);
					}
				}
				$dataupdateheader['status']="3";
				$this->md->updateppk($dataupdateheader,$datatransaksiid);

				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = $response['metadata']['message'];
				$json['responResult'] = $response;
			}

			echo json_encode($json);
		}

		public function setprocedureidrg(){
			$datatransaksiid    = $this->input->post("datatransaksiid");
			$resultprocedureset = $this->md->procedureset($datatransaksiid);

			$body = [
				"metadata" => [
					"method" => "idrg_procedure_set",
					"nomor_sep" => $datatransaksiid,
				],
				"data" => [
					"procedure" => $resultprocedureset->resultprocedure,
				]
			];

			$response = Inacbg::sendinacbgs(json_encode($body));
			if($response['metadata']['code']===200){
				foreach ($response['data']['expanded'] as $row) {
					if(isset($row['metadata']['code']) && $row['metadata']['code'] == 200){
						$dataupdate['status']="1";
						$this->md->updateicd($dataupdate,$datatransaksiid,$row['code']);
					}
				}
				$dataupdateheader['status']="4";
				$this->md->updateppk($dataupdateheader,$datatransaksiid);

				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = $response['metadata']['message'];
				$json['responResult'] = $response;
			}

			echo json_encode($json);
		}


		public function groupingidrg(){
			$datatransaksiid=$this->input->post("datatransaksiid");

			$body = [
				"metadata" => [
					"method"  => "grouper",
					"stage"   => "1",
					"grouper" => "idrg"
				],
				"data" => [
					"nomor_sep" => $datatransaksiid
				]
			];

			$response = Inacbg::sendinacbgs(json_encode($body));
			if($response['metadata']['code']===200){
				$dataupdateheader['mdc_number']      = $response['response_idrg']['mdc_number'];
				$dataupdateheader['mdc_description'] = $response['response_idrg']['mdc_description'];
				$dataupdateheader['drg_code']        = $response['response_idrg']['drg_code'];
				$dataupdateheader['drg_description'] = $response['response_idrg']['drg_description'];
				$dataupdateheader['status']          = "5";
				$this->md->updateppk($dataupdateheader,$datatransaksiid);

				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = $response['metadata']['message'];
				$json['responResult'] = $response;
			}
			echo json_encode($json);
        }

		public function finalidrg(){
			$datatransaksiid=$this->input->post("datatransaksiid");

			$body = [
				"metadata" => [
					"method"  => "idrg_grouper_final"
				],
				"data" => [
					"nomor_sep" => $datatransaksiid
				]
			];

			$response = Inacbg::sendinacbgs(json_encode($body));
			// return var_dump($response);

			if($response['metadata']['code']===200){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = $response['metadata']['message'];
				$json['responResult'] = $response;
			}else{
				if($response['metadata']['code']===400 && $response['metadata']['error_no']==="E2102"){
					$json["responCode"]   = "01";
					$json["responHead"]   = "info";
					$json["responDesc"]   = $response['metadata']['message'];
					$json['responResult'] = $response;
				}
			}

			echo json_encode($json);
        }

		public function editidrg(){
			$datatransaksiid=$this->input->post("datatransaksiid");

			$body = [
				"metadata" => [
					"method"  => "idrg_grouper_reedit"
				],
				"data" => [
					"nomor_sep" => $datatransaksiid
				]
			];

			$response = Inacbg::sendinacbgs(json_encode($body));
			// return var_dump($response);

			if($response['metadata']['code']===200){
				$json["responCode"]   = "00";
				$json["responHead"]   = "success";
				$json["responDesc"]   = $response['metadata']['message'];
				$json['responResult'] = $response;
			}

			echo json_encode($json);
        }
	}

?>