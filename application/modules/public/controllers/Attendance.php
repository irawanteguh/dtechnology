<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Attendance extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelattendance","md");
        }

		public function index(){
			$this->template->load("template/template-public","v_attendance");
		}

		public function datauser(){
            $userid = $this->input->post("userid");
            $result = $this->md->datauser($userid);
            
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

        public function simpanabsen(){
            $data['org_id']       = $this->input->post("orgid");
            $data['transaksi_id'] = $this->input->post("transaksiid");
            $data['user_id']      = $this->input->post("userid");
            $data['tgl_jam']      = date("Y-m-d H:i:s");

            if($this->md->insertabsen($data)){
                $json['responCode']   = "00";
                $json['responHead']   = "success";
                $json['responDesc']   = "Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }
            
            echo json_encode($json);
        }

        public function save_image() {
            $imageid = generateuuid();
            $post = json_decode($this->input->raw_input_stream, true);

            $image_data    = $post['image'];
            $image_data    = str_replace('data:image/jpeg;base64,', '', $image_data);
            $image_data    = str_replace('data:image/png;base64,', '', $image_data);
            $image_data    = str_replace(' ', '+', $image_data);
            $decoded_image = base64_decode($image_data);

            // Pastikan folder tujuan ada
            $folder_path = FCPATH . 'assets/attendance/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }

            // Buat nama file unik
            $filename  = $imageid.'.jpeg';
            $file_path = $folder_path . $filename;

            // Simpan file ke folder
            if(file_put_contents($file_path, $decoded_image)){
                $data['image_id'] = $imageid;
            
                if($this->md->insertface($data)){

                    sleep(2);
                    
                    $result = $this->md->datauser($imageid);
                    
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
                }else{
                    $json['responCode'] = "01";
                    $json['responHead'] = "error";
                    $json['responDesc'] = "Gagal Simpan Data";
                }
            } else {
                $json['responCode'] = "01";
                $json['responHead'] = "error";
                $json['responDesc'] = "Foto gagal diupload";
            }

            // Kembalikan hasil dalam JSON
            echo json_encode($json);
        }

	}
?>