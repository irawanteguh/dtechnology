<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Importaspakalkes extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelimportaspakalkes","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_importaspakalkes");
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
        
            $inserted = 0;
            foreach ($decoded as $i => $row) {
                // Lewatkan baris sebelum baris ke-6
                if ($i < 5) continue;
        
                // Cek apakah kolom 5 ada dan bernilai "YA"
                if (!isset($row[5]) || strtoupper(trim($row[5])) !== 'YA') continue;
        
                // Optional: pastikan kolom 0, 3, dan 4 ada
                if (!isset($row[0], $row[3], $row[4])) continue;
        
                $data = [
                    'org_id'          => $_SESSION['orgid'],
                    'trans_id'        => generateuuid(),
                    'no_assets'       => generateUniqueCode(),
                    'volume'          => 1,
                    'location_id'     => $row[0],
                    'alkes_id_aspak'  => $row[3],
                    'name'            => $row[4],
                    'serial_number'   => isset($row[6])  ? $row[6]  : '',
                    'merk'            => isset($row[7])  ? $row[7]  : '',
                    'tipe'            => isset($row[8])  ? $row[8]  : '',
                    'tahun_perolehan' => isset($row[9])  ? $row[9]  : '',
                    'nilai_perolehan' => isset($row[11]) ? $row[11] : '',
                    'distributor'     => isset($row[13]) ? $row[13] : '',
                    'akl'             => isset($row[14]) ? $row[14] : '',
                    'spesifikasi'     => isset($row[15]) ? $row[15] : '',
                    'jenis_id'        => "1",
                    'created_by'      => $_SESSION['userid']
                ];
                
        
                $this->md->insertassets($data);
                $inserted++;
            }
        
            echo "Import berhasil: {$inserted} data dimasukkan.";
        }
        

	}
?>