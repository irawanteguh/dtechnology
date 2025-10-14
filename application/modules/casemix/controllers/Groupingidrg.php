<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Groupingidrg extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelgroupingidrg","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_groupingidrg");
		}

        public function randomgenerator() {
            $transaksiid = generateuuid();
            $nosep       = generateNoSEP();
            $nokartu     = generateNoKartuBPJS();
            $norm        = generateUniqueNumber();
            $namapasien  = randomgeneatorname();
            $tgllahir    = generateRandomTanggal();
            $jenisrawat  = mt_rand(1, 3);
            $sexid       = (string) mt_rand(1, 2);

            $data['group_id']     = $_SESSION['groupid'];
            $data['org_id']       = $_SESSION['orgid'];
            $data['transaksi_id'] = $transaksiid;
            $data['no_rm']        = $norm;
            $data['nama_pasien']  = $namapasien;
            $data['tgl_lahir']    = $tgllahir;
            $data['gender']       = $sexid;
            $data['jenis_rawat']  = $jenisrawat;

            if ($jenisrawat === 1) {
                $data['tgl_masuk']  = date("Y-m-d H:i:s", strtotime("-3 days"));
                $data['tgl_pulang'] = date("Y-m-d H:i:s");
            } else {
                $data['tgl_masuk']  = date("Y-m-d H:i:s");
                $data['tgl_pulang'] = date("Y-m-d H:i:s");
            }

            if ($jenisrawat === 1) {
                $data['kelas_rawat'] = mt_rand(1, 3);
            } else {
                $data['kelas_rawat'] = 3;
            }

            $data['no_kartu']           = $nokartu;
            $data['no_sep']             = $nosep;
            $data['prosedur_non_bedah'] = generateNilaiTindakan();
            $data['prosedur_bedah']     = generateNilaiTindakan();
            $data['konsultasi']         = generateNilaiTindakan();
            $data['tenaga_ahli']        = generateNilaiTindakan();
            $data['keperawatan']        = generateNilaiTindakan();
            $data['penunjang']          = generateNilaiTindakan();
            $data['radiologi']          = generateNilaiTindakan();
            $data['laboratorium']       = generateNilaiTindakan();
            $data['pelayanan_darah']    = generateNilaiTindakan();
            $data['rehabilitasi']       = generateNilaiTindakan();
            $data['kamar']              = generateNilaiTindakan();
            $data['rawat_intensif']     = generateNilaiTindakan();
            $data['obat']               = generateNilaiTindakan();
            $data['obat_kronis']        = generateNilaiTindakan();
            $data['obat_kemoterapi']    = generateNilaiTindakan();
            $data['alkes']              = generateNilaiTindakan();
            $data['bmhp']               = generateNilaiTindakan();
            $data['sewa_alat']          = generateNilaiTindakan();

            if($this->md->insertclaim($data)){
                $this->setclaim($transaksiid);

                $json["responCode"]   = "00";
                $json["responHead"]   = "success";
                $json["responDesc"]   = "Data has been successfully added.";
            }else{
                $json["responCode"] = "01";
				$json["responHead"] = "error";
				$json["responDesc"] = "Failed to add data.";
            }
            echo json_encode($json);
        }

        public function setclaim($transaksiid){
            $resultdata = $this->md->pencariandataklaim($transaksiid);

            $body = [
					"metadata" => [
						"method" => "new_claim"
					],
					"data" => [
						"nomor_kartu" => $resultdata->NO_KARTU,
						"nomor_sep"   => $resultdata->NO_SEP,
						"nomor_rm"    => $resultdata->NO_RM,
						"nama_pasien" => $resultdata->NAMA_PASIEN,
						"tgl_lahir"   => $resultdata->TGL_LAHIR,
						"gender"      => $resultdata->GENDER
					]
				];
            $response = Inacbg::sendinacbgs(json_encode($body));
            if($response['metadata']['code']===200){
                $dataupdate['status']="1";
                $this->md->updateclaim($dataupdate,$resultdata->TRANSAKSI_ID);
            }
        }

        public function dataklaim(){
            $result = $this->md->dataklaim();
            
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

	}
?>