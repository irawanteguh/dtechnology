<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Importdata extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelimportdata","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_importdata");
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
                if ($i < 5) continue;
        
                if (!isset($row[1], $row[2])) continue;

                // if(empty($this->md->cekdatanoinventaris($_SESSION['orgid'],$row[1]))){
                    $data = [
                        'org_id'          => $_SESSION['orgid'],
                        'trans_id'        => generateuuid(),
                        'no_assets'       => generateUniqueCode(),
                        'volume'          => 1,
                        'no_inventaris'   => $row[1],
                        'name'            => $row[2],
                        'merk'            => isset($row[3])  ? $row[3]  : null,
                        'tahun_produksi'  => isset($row[4])  ? $row[4]  : null,
                        'jenis_id'        => (isset($row[6]) && $row[6] === 'ALKES') ? '1' : null,
                        'sumber'          => isset($row[8])  ? $row[8]  : null,
                        'nilai_perolehan' => isset($row[9]) ? $row[9] : 0,
                        'status_id'       => (isset($row[10]) && $row[10] === 'ADA') ? '1' : null,
                        'location_id'     => isset($row[11]) && !empty($row[11]) ? $this->md->locationid($_SESSION['orgid'], $row[11]): null,
                        'created_by'      => $_SESSION['userid'],
                        'last_update_by'  => $_SESSION['userid']
                    ];
                    
            
                    $this->md->insertassets($data);
                    $inserted++;
                // }
                
            }
        
            echo "Import berhasil: {$inserted} data dimasukkan.";
        }
        

	}
?>