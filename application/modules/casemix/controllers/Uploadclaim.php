<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Uploadclaim extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeluploadclaim","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_uploadclaim");
		}

        public function upload_file() {
            if (!empty($_FILES['txt_file']['name'])) {
                $file = $_FILES['txt_file']['tmp_name'];
                $content = file_get_contents($file);
                $rows = explode("\n", trim($content));
    
                $data = [];
                $headers = [];
    
                foreach ($rows as $i => $row) {
                    $cols = explode("\t", trim($row));
                    if ($i === 0) {
                        $headers = $cols;
                    } else {
                        $data[] = $cols;
                    }
                }
    
                echo json_encode([
                    'status' => 'success',
                    'headers' => $headers,
                    'data' => $data
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
            }
        }

        public function import_to_db() {
            $rows = $this->input->post('rows');
            if (!$rows) {
                echo "Data tidak ditemukan.";
                return;
            }
        
            $decoded = json_decode($rows, true);
        
            if (!is_array($decoded)) {
                echo "Format data tidak valid.";
                return;
            }
        
        
            foreach ($decoded as $row) {
                $data = [
                    'ORG_ID'             => $_SESSION['orgid'],
                    'KODE_RS'            => $row[0],
                    'KELAS_RS'           => $row[1],
                    'KELAS_RAWAT'        => $row[2],
                    'KODE_TARIF'         => $row[3],
                    'PTD'                => (int) $row[4],
                    'ADMISSION_DATE'     => $this->convertDate($row[5]),
                    'DISCHARGE_DATE'     => $this->convertDate($row[6]),
                    'BIRTH_DATE'         => $this->convertDate($row[7]),
                    'BIRTH_WEIGHT'       => (int) $row[8],
                    'SEX'                => (int) $row[9],
                    'DISCHARGE_STATUS'   => (int) $row[10],
                    'DIAGLIST'           => $row[11],
                    'PROCLIST'           => $row[12],
                    'ADL1'               => $row[13],
                    'ADL2'               => $row[14],
                    'IN_SP'              => $row[15],
                    'IN_SR'              => $row[16],
                    'IN_SI'              => $row[17],
                    'IN_SD'              => $row[18],
                    'INACBG'             => $row[19],
                    'SUBACUTE'           => $row[20],
                    'CHRONIC'            => $row[21],
                    'SP'                 => $row[22],
                    'SR'                 => $row[23],
                    'SI'                 => $row[24],
                    'SD'                 => $row[25],
                    'DESKRIPSI_INACBG'   => $row[26],
                    'TARIF_INACBG'       => (int) $row[27],
                    'TARIF_SUBACUTE'     => (int) $row[28],
                    'TARIF_CHRONIC'      => (int) $row[29],
                    'DESKRIPSI_SP'       => $row[30],
                    'TARIF_SP'           => (int) $row[31],
                    'DESKRIPSI_SR'       => $row[32],
                    'TARIF_SR'           => (int) $row[33],
                    'DESKRIPSI_SI'       => $row[34],
                    'TARIF_SI'           => (int) $row[35],
                    'DESKRIPSI_SD'       => $row[36],
                    'TARIF_SD'           => (int) $row[37],
                    'TOTAL_TARIF'        => (int) $row[38],
                    'TARIF_RS'           => (int) $row[39],
                    'TARIF_POLI_EKS'     => (int) $row[40],
                    'LOS'                => (int) $row[41],
                    'ICU_INDIKATOR'      => (int) $row[42],
                    'ICU_LOS'            => (int) $row[43],
                    'VENT_HOUR'          => (int) $row[44],
                    'NAMA_PASIEN'        => $row[45],
                    'MRN'                => $row[46],
                    'UMUR_TAHUN'         => (int) $row[47],
                    'UMUR_HARI'          => (int) $row[48],
                    'DPJP'               => $row[49],
                    'SEP'                => $row[50],
                    'NOKARTU'            => $row[51],
                    'PAYOR_ID'           => $row[52],
                    'CODER_ID'           => $row[53],
                    'VERSI_INACBG'       => $row[54],
                    'VERSI_GROUPER'      => $row[55],
                    'C1'                 => $row[56],
                    'C2'                 => $row[57],
                    'C3'                 => $row[58],
                    'C4'                 => $row[59],
                    'PROSEDUR_NON_BEDAH' => (int) $row[60],
                    'PROSEDUR_BEDAH'     => (int) $row[61],
                    'KONSULTASI'         => (int) $row[62],
                    'TENAGA_AHLI'        => (int) $row[63],
                    'KEPERAWATAN'        => (int) $row[64],
                    'PENUNJANG'          => (int) $row[65],
                    'RADIOLOGI'          => (int) $row[66],
                    'LABORATORIUM'       => (int) $row[67],
                    'PELAYANAN_DARAH'    => (int) $row[68],
                    'REHABILITASI'       => (int) $row[69],
                    'KAMAR_AKOMODASI'    => (int) $row[70],
                    'RAWAT_INTENSIF'     => (int) $row[71],
                    'OBAT'               => (int) $row[72],
                    'ALKES'              => (int) $row[73],
                    'BMHP'               => (int) $row[74],
                    'SEWA_ALAT'          => (int) $row[75],
                    'OBAT_KRONIS'        => (int) $row[76],
                    'OBAT_KEMO'          => (int) ($row[77] ?? 0),
                ];
                
                
                $resultcekdata = $this->md->cekdata($_SESSION['orgid'],$row[50]);

                if(empty($resultcekdata)) {
                    $this->md->insertdata($data);
                }
                
            }
        
            echo "Import berhasil: " . count($decoded) . " data dimasukkan.";
        }
        
        private function convertDate($str) {
            $date = DateTime::createFromFormat('d/m/Y', $str);
            return $date ? $date->format('Y-m-d') : NULL;
        }
        

	}
?>