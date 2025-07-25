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

            $kategoriassetsedit = "";
            foreach($resultkategoriasset as $a){
                $kategoriassetsedit .= "<label class='d-flex flex-stack mb-5 cursor-pointer'>";

                // Kolom Kiri: Icon + Label
                $kategoriassetsedit .= "<span class='d-flex align-items-center me-2'>";

                // Icon/Simbol
                $kategoriassetsedit .= "<span class='symbol symbol-50px me-6'>";
                $kategoriassetsedit .= "<span class='symbol-label bg-light-".$a->color."'>";
                $kategoriassetsedit .= "<i class='".$a->icon." fa-2x text-".$a->color."'></i>";
                $kategoriassetsedit .= "</span>";
                $kategoriassetsedit .= "</span>";

                // Informasi Nama & Deskripsi
                $kategoriassetsedit .= "<span class='d-flex flex-column'>";
                $kategoriassetsedit .= "<span class='fw-bolder fs-6'>" . $a->master_name . "</span>";
                $kategoriassetsedit .= "<span class='fs-7 text-muted'>" . $a->master_name . "</span>";
                $kategoriassetsedit .= "</span>"; // end info

                $kategoriassetsedit .= "</span>"; // end align-items-center

                // Kolom Kanan: Input radio
                $kategoriassetsedit .= "<span class='form-check form-check-custom form-check-solid is-valid'>";
                $kategoriassetsedit .= "<input class='form-check-input' type='radio' name='categoryedit' value='" . $a->code . "'>";
                $kategoriassetsedit .= "</span>";

                $kategoriassetsedit .= "</label>";
            }

            $data['kategoriassets']     = $kategoriassets;
            $data['kategoriassetsedit'] = $kategoriassetsedit;
            return $data;
        }

        public function insertassets(){
            $data['org_id']                      = $_SESSION['orgid'];
            $data['trans_id']                    = generateuuid();
            $data['no_assets']                   = generateUniqueCode();
            $data['no_laporan_penilaian_assets'] = $this->input->post("laporan_penilaian");
            $data['name']                        = $this->input->post("name");
            $data['jenis_id']                    = $this->input->post("category");
            $data['tahun_perolehan']             = $this->input->post("tahun_dibangun");
            $data['dinding']                     = $this->input->post("dinding_pelapis");
            $data['volume']                      = $this->input->post("volume");
            $data['estimasi_penggunaan_day']     = $this->input->post("estimasi_penggunaan");
            $data['nilai_perolehan']             = preg_replace('/[^0-9]/', '', $this->input->post("nilai_perolehan"));
            $data['nilai_pemeliharaan']          = preg_replace('/[^0-9]/', '', $this->input->post("biaya_pemeliharaan"));
            $data['waktu_bunga']                 = $this->input->post("waktu_pinjaman");
            $data['nilai_bunga_pinjaman']        = preg_replace('/[^0-9]/', '', $this->input->post("bunga_pinjaman"));
            $data['waktu_depresiasi']            = $this->input->post("depresiasi");
            $data['location_id']                 = ($this->input->post("location_id") === 'x') ? null : $this->input->post("location_id");
            $data['created_by']                  = $_SESSION['userid'];

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

        public function editassets(){
            $data['no_laporan_penilaian_assets'] = $this->input->post("modal_assets_edit_laporanasset");
            $data['name']                        = $this->input->post("modal_assets_edit_name");
            $data['jenis_id']                    = $this->input->post("categoryedit");
            $data['air']                         = $this->input->post("modal_assets_edit_air")      == 'on' ? 'Y' : 'N';
            $data['listrik']                     = $this->input->post("modal_assets_edit_listrik")  == 'on' ? 'Y' : 'N';
            $data['internet']                    = $this->input->post("modal_assets_edit_internet") == 'on' ? 'Y' : 'N';
            $data['tahun_perolehan']             = $this->input->post("modal_assets_edit_tahun");
            $data['tanggal_pembelian']           = ($dt = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_assets_edit_tanggal"))) ? $dt->format("Y-m-d") : null;
            $data['volume']                      = $this->input->post("modal_assets_edit_volume");
            $data['vol_listrik']                 = $this->input->post("modal_assets_edit_vollistrik");
            $data['estimasi_penggunaan_day']     = $this->input->post("modal_assets_edit_penggunaan");
            $data['24_jam']                      = $this->input->post("modal_assets_edit_operasional") == 'on' ? 'Y' : 'N';
            $data['nilai_perolehan']             = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaiasset"));
            $data['nilai_pemeliharaan']          = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaipemeliharaan"));
            $data['waktu_bunga']                 = $this->input->post("modal_assets_edit_waktubunga");
            $data['nilai_bunga_pinjaman']        = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaibunga"));
            $data['waktu_depresiasi']            = $this->input->post("modal_assets_edit_depresiasi");
            $data['location_id']                 = ($this->input->post("modal_assets_edit_location") === 'x') ? null : $this->input->post("modal_assets_edit_location");
            $data['last_update_by']              = $_SESSION['userid'];
            $data['last_update_date']            = date("Y-m-d H:i:s");


            if($this->md->updateassets($this->input->post("modal_assets_edit_transid"),$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Updated";
            }

            echo json_encode($json);
        }

        public function hapusdata(){
            $data['active']           = "0";
            $data['last_update_by']   = $_SESSION['userid'];
            $data['last_update_date'] = date("Y-m-d H:i:s");


            if($this->md->updateassets($this->input->post("datatransid"),$data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Data Updated Successfully";
            } else {
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Data Failed to Updated";
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

        public function masterlocation(){
            $resultmasterlocation = $this->md->masterlocation($_SESSION['orgid']);

            $location="";
            foreach($resultmasterlocation as $a ){
                $location.="<option value='".$a->locationid."'>".$a->keterangan."</option>";
            }

            echo $location;
        }

	}
?>