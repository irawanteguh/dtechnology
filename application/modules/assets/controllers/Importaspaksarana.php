<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Importaspaksarana extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelimportaspaksarana","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_importaspaksarana");
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
        
            $inserted   = 0;
            $header9_id = null;
            $header8_id = null;
        
            foreach ($decoded as $i => $row) {
                // Lewati baris jika kolom kosong atau tidak sesuai
                if (!isset($row[0]) || trim($row[0]) === '') continue;
        
                $mark           = trim($row[0]);                          // Kolom 'mark'
                $name1          = isset($row[1]) ? trim($row[1]) : '';    // Untuk mark '*'
                $name2          = isset($row[2]) ? trim($row[2]) : '';    // Untuk mark '**'
                $sarana         = isset($row[3]) ? trim($row[3]) : '';    // Untuk data biasa
                $tersedia       = isset($row[4]) ? strtoupper(trim($row[4])) : '';
                $tahunperolehan = isset($row[5]) ? trim($row[5]) : null;
                $tahunrenovasi  = isset($row[6]) ? trim($row[6]) : null;
                $kondisi        = isset($row[7]) ? trim($row[7]) : null;
                $keterangan     = isset($row[8]) ? trim($row[8]) : null;
        
                $uuid = generateuuid();
        
                if ($mark === '*') {
                    // Baris Jenis ID 9 - Header utama
                    if ($name1 === '') continue;
        
                    $data = [
                        'org_id'     => $_SESSION['orgid'],
                        'trans_id'   => $uuid,
                        'no_assets'  => generateUniqueCode(),
                        'name'       => $name1,
                        'jenis_id'   => '9',
                        'created_by' => $_SESSION['userid']
                    ];
                    $header9_id = $uuid;
                } elseif ($mark === '**') {
                    // Baris Jenis ID 8 - Sub-header
                    if ($name2 === '') continue;
        
                    $data = [
                        'org_id'                 => $_SESSION['orgid'],
                        'trans_id'               => $uuid,
                        'no_assets'              => generateUniqueCode(),
                        'name'                   => $name2,
                        'jenis_id'               => '8',
                        'header_sarana_id_aspak' => $header9_id,
                        'created_by'             => $_SESSION['userid']
                    ];
                    $header8_id = $uuid;
                } elseif (is_numeric($mark)) {
                    // Baris data (detail) dengan numeric mark
                    if ($tersedia !== 'ADA') continue;
        
                    $data = [
                        'org_id'                   => $_SESSION['orgid'],
                        'trans_id'                 => $uuid,
                        'no_assets'                => generateUniqueCode(),
                        'name'                     => $sarana,
                        'tahun_perolehan'          => $tahunperolehan,
                        'tahun_renovasi'           => $tahunrenovasi,
                        // 'kondisi'                  => $kondisi,
                        'spesifikasi'              => $keterangan,
                        'jenis_id'                 => '2',
                        'sarana_id_aspak'          => $mark,
                        'header_sarana_id_aspak' => $header8_id,
                        'created_by'               => $_SESSION['userid']
                    ];
                } else {
                    continue; // skip unknown mark
                }
        
                $this->md->insertassets($data);
                $inserted++;
            }
        
            echo "Import berhasil: {$inserted} data dimasukkan.";
        }
        
        
        

	}
?>