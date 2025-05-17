<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Uploadclaim extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            // $this->load->model("Modelvaliddoc","md");
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

	}
?>