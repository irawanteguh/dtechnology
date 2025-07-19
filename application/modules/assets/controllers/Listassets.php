<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Listassets extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("modellistassets","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_listassets",$data);
		}

        public function loadcombobox(){
            $resultkategoriasset  = $this->md->kategoriasset();
            $resultmasterlocation = $this->md->masterlocation($_SESSION['orgid']);

            $kategoriassets = "";
            foreach($resultkategoriasset as $a){
                $kategoriassets .= "<label class='d-flex flex-stack mb-5 cursor-pointer'>";

                // Kolom Kiri: Icon + Label
                $kategoriassets .= "<span class='d-flex align-items-center me-2'>";

                // Icon/Simbol
                $kategoriassets .= "<span class='symbol symbol-50px me-6'>";
                $kategoriassets .= "<span class='symbol-label bg-light-".$a->color."'>";
                $kategoriassets .= "<i class='".$a->icon." fa-2x text-".$a->color."'></i>";
                $kategoriassets .= "</span>";
                $kategoriassets .= "</span>";

                // Informasi Nama & Deskripsi
                $kategoriassets .= "<span class='d-flex flex-column'>";
                $kategoriassets .= "<span class='fw-bolder fs-6'>" . $a->master_name . "</span>";
                $kategoriassets .= "<span class='fs-7 text-muted'>" . $a->master_name . "</span>";
                $kategoriassets .= "</span>"; // end info

                $kategoriassets .= "</span>"; // end align-items-center

                // Kolom Kanan: Input radio
                $kategoriassets .= "<span class='form-check form-check-custom form-check-solid is-valid'>";
                $kategoriassets .= "<input class='form-check-input' type='radio' name='category' value='" . $a->code . "'>";
                $kategoriassets .= "</span>";

                $kategoriassets .= "</label>";
            }

            $location="";
            foreach($resultmasterlocation as $a ){
                $location.="<option value='".$a->trans_id."'>".$a->keterangan."</option>";
            }

            $data['kategoriassets'] = $kategoriassets;
            $data['location'] = $location;
            return $data;
        }


        public function insertassets(){

            $data['org_id']                      = $_SESSION['orgid'];
            $data['trans_id']                    = generateuuid();
            $data['no_assets']                   = generateUniqueCode();
            $data['no_laporan_penilaian_assets'] = $this->input->post("laporan_penilaian");
            $data['name']                        = $this->input->post("name");
            $data['jenis_id']                    = $this->input->post("category");
            
            $data['tahun_pembuatan']         = $this->input->post("tahun_dibangun");
            $data['dinding']                 = $this->input->post("dinding_pelapis");
            $data['volume']                  = $this->input->post("volume");
            $data['estimasi_penggunaan_day'] = $this->input->post("estimasi_penggunaan");
            
            $data['nilai_perolehan']      = preg_replace('/[^0-9]/', '', $this->input->post("nilai_perolehan"));
            $data['nilai_pemeliharaan']   = preg_replace('/[^0-9]/', '', $this->input->post("biaya_pemeliharaan"));
            $data['waktu_bunga']          = $this->input->post("waktu_pinjaman");
            $data['nilai_bunga_pinjaman'] = preg_replace('/[^0-9]/', '', $this->input->post("bunga_pinjaman"));
            $data['waktu_depresiasi']     = $this->input->post("depresiasi");

            $data['location_id']     = $this->input->post("location_id");
            
            $data['created_by']                  = $_SESSION['userid'];
            $data['created_date']                = date("Y-m-d H:i:s");

            if($this->md->insertassets($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Added Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Add";
            }

            echo json_encode($json);
        }

        public function masterassets(){
            $result = $this->md->masterassets($_SESSION['orgid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

	}
?>