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
            $resultkategoriasset = $this->md->kategoriasset();
            $resultstatusasset   = $this->md->statusasset();
            $resultsumberasset   = $this->md->sumberasset();

            if($_SESSION['leveluser']==="83e9982c-814a-4349-89fb-cbee6f34e340" || $_SESSION['holding']==="Y"){
                $parameter="and a.header_id='".$_SESSION['groupid']."'";
            }else{
                $parameter="and a.org_id='".$_SESSION['orgid']."'";
            }
            $resultmasterorganization   = $this->md->masterorganization($parameter);

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

            $statusasset="";
            foreach($resultstatusasset as $a ){
                $statusasset.="<option value='".$a->code."'>".$a->master_name."</option>";
            }
            
            $sumberasset="";
            foreach($resultsumberasset as $a ){
                $sumberasset.="<option value='".$a->code."'>".$a->master_name."</option>";
            }

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['kategoriassetsadd']  = $kategoriassets;
            $data['kategoriassetsedit'] = $kategoriassetsedit;

            $data['statusassetadd']     = $statusasset;
            $data['statusassetedit']    = $statusasset;

            $data['sumberassetadd']        = $sumberasset;
            $data['sumberassetedit']        = $sumberasset;
            $data['masterorganization'] = $masterorganization;
            return $data;
        }

        public function insertassets(){
            $data['org_id']                      = $_SESSION['orgid'];
            $data['trans_id']                    = generateuuid();
            $data['no_assets']                   = generateUniqueCode();

            
            $data['name']                        = $this->input->post("modal_assets_add_name");
            $data['jenis_id']                    = $this->input->post("category");
            $data['spesifikasi']                 = $this->input->post("modal_assets_add_spesifikasi");
            $data['tahun_perolehan']             = $this->input->post("modal_assets_add_tahun");
            $data['tanggal_pembelian']           = ($dt = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_assets_add_tanggal"))) ? $dt->format("Y-m-d") : null;
            $data['volume']                      = $this->input->post("modal_assets_add_volume");
            $data['vol_listrik']                 = $this->input->post("modal_assets_add_vollistrik");
            $data['estimasi_penggunaan_day']     = $this->input->post("modal_assets_add_penggunaan");
            $data['sumber_id']                   = $this->input->post("modal_assets_add_sumber");
            $data['nilai_perolehan']             = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_add_nilaiasset"));
            $data['nilai_pemeliharaan']          = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_add_nilaipemeliharaan"));
            $data['nilai_bunga_pinjaman']        = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_add_nilaibunga"));
            $data['waktu_bunga']                 = $this->input->post("modal_assets_add_waktubunga");
            $data['waktu_depresiasi']            = $this->input->post("modal_assets_add_depresiasi");
            $data['air']                         = $this->input->post("modal_assets_add_air")         == 'on' ? 'Y' : 'N';
            $data['listrik']                     = $this->input->post("modal_assets_add_listrik")     == 'on' ? 'Y' : 'N';
            $data['internet']                    = $this->input->post("modal_assets_add_internet")    == 'on' ? 'Y' : 'N';
            $data['24_jam']                      = $this->input->post("modal_assets_add_operasional") == 'on' ? 'Y' : 'N';
            $data['serial_number']               = $this->input->post("modal_assets_add_sn") ?: null;
            $data['no_inventaris']               = $this->input->post("modal_assets_add_noinventaris") ?: null;
            $data['no_laporan_penilaian_assets'] = $this->input->post("modal_assets_add_laporanasset") ?: null;
            $data['location_id']                 = ($this->input->post("modal_assets_add_location") === 'x') ? null : $this->input->post("modal_assets_add_location");
            $data['status_id']                   = $this->input->post("modal_assets_add_status");
            $data['created_by']                  = $_SESSION['userid'];
            $data['last_update_by']              = $_SESSION['userid'];

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
            $data['name']                        = $this->input->post("modal_assets_edit_name");
            $data['jenis_id']                    = $this->input->post("categoryedit");
            
            $data['spesifikasi']                 = $this->input->post("modal_assets_edit_spesifikasi");
            
            $data['tahun_perolehan']             = $this->input->post("modal_assets_edit_tahun");
            $data['tanggal_pembelian']           = ($dt = DateTime::createFromFormat("d.m.Y", $this->input->post("modal_assets_edit_tanggal"))) ? $dt->format("Y-m-d") : null;
            $data['volume']                      = $this->input->post("modal_assets_edit_volume");
            $data['vol_listrik']                 = $this->input->post("modal_assets_edit_vollistrik");
            $data['estimasi_penggunaan_day']     = $this->input->post("modal_assets_edit_penggunaan");
            
            $data['sumber_id']                   = $this->input->post("modal_assets_edit_sumber");
            $data['nilai_perolehan']             = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaiasset"));
            $data['nilai_pemeliharaan']          = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaipemeliharaan"));
            $data['nilai_bunga_pinjaman']        = preg_replace('/[^0-9]/', '', $this->input->post("modal_assets_edit_nilaibunga"));
            $data['waktu_bunga']                 = $this->input->post("modal_assets_edit_waktubunga");
            $data['waktu_depresiasi']            = $this->input->post("modal_assets_edit_depresiasi");

            $data['air']                         = $this->input->post("modal_assets_edit_air")         == 'on' ? 'Y' : 'N';
            $data['listrik']                     = $this->input->post("modal_assets_edit_listrik")     == 'on' ? 'Y' : 'N';
            $data['internet']                    = $this->input->post("modal_assets_edit_internet")    == 'on' ? 'Y' : 'N';
            $data['24_jam']                      = $this->input->post("modal_assets_edit_operasional") == 'on' ? 'Y' : 'N';

            $data['serial_number']               = $this->input->post("modal_assets_edit_sn") ?: null;
            $data['no_inventaris']               = $this->input->post("modal_assets_edit_noinventaris") ?: null;
            $data['no_laporan_penilaian_assets'] = $this->input->post("modal_assets_edit_laporanasset") ?: null;

            $data['location_id']                 = ($this->input->post("modal_assets_edit_location") === 'x') ? null : $this->input->post("modal_assets_edit_location");
            $data['status_id']                   = $this->input->post("modal_assets_edit_status");

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
            $orgid = $this->input->post("orgid");
            $result = $this->md->masterassets($orgid);
            
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