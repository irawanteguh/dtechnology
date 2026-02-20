<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Disposisi extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modeldisposisi","md");
        }

		public function index(){
			$this->template->load("template/template-sidebar","v_disposisi");
		}

		public function suratmasuk(){
            $result = $this->md->suratmasuk($_SESSION['userid']);
            
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

		public function lembardisposisi() {
			$suratid = $this->input->post("datatransid");
			$resultlembardisposisi = $this->md->lembardisposisi($_SESSION['orgid'], $suratid);

			$lembardisposisi = "";
			$header_shown = [
				"1" => false,
				"2" => false,
				"3" => false,
				"4" => false,
				"5" => false
			];

			foreach ($resultlembardisposisi as $a) {
				// Reset data attribute setiap loop
				$getvariable = "";
				if (!empty($a->org_id))        $getvariable      .= " data-orgid='" . $a->org_id . "'";
				if (!empty($a->department_id)) $getvariable      .= " data-departmentid='" . $a->department_id . "'";
				if (!empty($a->user_id))       $getvariable      .= " data-userid='" . $a->user_id . "'";
				if (!empty($suratid))          $getvariable      .= " data-suratid='" . $suratid . "'";

				// Header berdasarkan level_id
				if (in_array($a->level_id, ["1", "2", "3"]) && !$header_shown["1"]) {
					$lembardisposisi .= "<label class='d-flex align-items-center fs-5 fw-bold mb-5 badge badge-light-info'>Direksi dan Management : </label>";
					$header_shown["1"] = true;
				} elseif ($a->level_id === "4" && !$header_shown["4"]) {
					$lembardisposisi .= "<label class='d-flex align-items-center fs-5 fw-bold mb-5 mt-10 badge badge-light-info'>Manager : </label>";
					$header_shown["4"] = true;
				} elseif ($a->level_id === "5" && !$header_shown["5"]) {
					$lembardisposisi .= "<label class='d-flex align-items-center fs-5 fw-bold mb-5 mt-10 badge badge-light-info'>Kepala Instalasi / Department :</label>";
					$header_shown["5"] = true;
				}

				// Container elemen
				$lembardisposisi .= in_array($a->level_id, ["1", "2", "3"]) 
					? "<div class='fv-row mb-2 fv-plugins-icon-container col-xl-12'><div class='separator my-2'></div>"
					: "<div class='fv-row mb-2 fv-plugins-icon-container col-xl-6'><div class='separator my-2'></div>";

				$lembardisposisi .= "<div class='d-flex flex-stack'>";
				
				// Keterangan departemen & user
				$lembardisposisi .= "<div class='me-5'>";
				$lembardisposisi .= "<label class='d-flex align-items-center fs-5 fw-bold mb-2'>";
				if ($a->user_id === null) {
					$lembardisposisi .= "<span class='text-danger'>" . $a->department . "</span>";
					$lembardisposisi .= "<i class='fas fa-exclamation-circle ms-2 fs-7' data-bs-toggle='tooltip' title='Mohon Setting Staff Terlebih Dahulu'></i>";
				} else {
					$lembardisposisi .= "<span>" . $a->department . "</span>";
					$lembardisposisi .= "<i class='fas fa-exclamation-circle ms-2 fs-7' data-bs-toggle='tooltip' title='Klik / Pilih Jika Ingin Disposisi Surat Ke " . $a->department . "'></i>";
				}
				$lembardisposisi .= "</label>";
				$lembardisposisi .= "<div class='fs-7 fw-bold text-muted'>" . $a->name . "</div>";
				$lembardisposisi .= "</div>";

				// Checkbox input
				$lembardisposisi .= "<div class='d-flex'>";
				$lembardisposisi .= "<label class='form-check form-check-custom form-check-solid'>";
				if ($a->user_id === null) {
					$lembardisposisi .= "<input class='form-check-input h-20px w-20px' type='checkbox' id='" . $a->department_id . "' disabled>";
				} else {
					if ($a->transaksiid === null) {
						$lembardisposisi .= "<input class='form-check-input h-20px w-20px' type='checkbox' id='" . $a->department_id . "'" . $getvariable . ">";
					} else {
						if ($a->user_id === $_SESSION['userid']) {
							$lembardisposisi .= "<input class='form-check-input h-20px w-20px' type='checkbox' id='" . $a->department_id . "' checked disabled" . $getvariable . ">";
						} else {
							if($a->response==="Y"){
								$lembardisposisi .= "<input class='form-check-input h-20px w-20px' type='checkbox' id='" . $a->department_id . "' checked disabled>";
							}else{
								$lembardisposisi .= "<input class='form-check-input h-20px w-20px' type='checkbox' id='" . $a->department_id . "' checked" . $getvariable . ">";
							}
							
						}
					}
				}
				$lembardisposisi .= "</label>";
				$lembardisposisi .= "</div>"; // end checkbox container

				$lembardisposisi .= "</div>"; // end flex stack
				$lembardisposisi .= "</div>"; // end main container
			}

			echo $lembardisposisi;
		}

		public function disposisisurat_insert(){
			$datadisposisi['group_id']           = $_SESSION['groupid'];
			$datadisposisi['org_id']             = $_SESSION['orgid'];
			$datadisposisi['transaksi_id']       = generateuuid();
			$datadisposisi['surat_id']           = $this->input->post('surat_id');
			$datadisposisi['from_org_id']        = $_SESSION['orgid'];
			$datadisposisi['from_department_id'] = $_SESSION['departmentid'];
			$datadisposisi['from_user_id']       = $_SESSION['userid'];
			$datadisposisi['from_datetime']      = date("Y-m-d H:i:s");
			$datadisposisi['to_org_id']          = $this->input->post('org_id');
			$datadisposisi['to_department_id']   = $this->input->post('department_id');
			$datadisposisi['to_user_id']         = $this->input->post('user_id');

			if($this->md->insertdisposisi($datadisposisi)){
				if(empty($this->md->cekresponse($this->input->post('surat_id'),$_SESSION['userid']))){
					$updatereponse['to_datetime'] = date("Y-m-d H:i:s");
					$updatereponse['response']    = "Y";

					$this->md->updatedisposisi($this->input->post('surat_id'),$_SESSION['userid'],$updatereponse);
				};

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

		public function disposisisurat_delete() {
			$hapusdisposisi['active']         = "0";
			$hapusdisposisi['hapus_id']       = $_SESSION['userid'];
			$hapusdisposisi['hapus_datetime'] = date("Y-m-d H:i:s");

			if($this->md->updatedisposisi($this->input->post('surat_id'),$this->input->post('user_id'),$hapusdisposisi)){
				
				if(empty($this->md->cekresponse($this->input->post('surat_id'),$_SESSION['userid']))){
					$updatereponse['to_datetime'] = date("Y-m-d H:i:s");
					$updatereponse['response']    = "Y";

					$this->md->updatedisposisi($this->input->post('surat_id'),$_SESSION['userid'],$updatereponse);
				};

				$json['responCode']="00";
				$json['responHead']="success";
				$json['responDesc']="Data Update Successfully";
			} else {
				$json['responCode']="01";
				$json['responHead']="info";
				$json['responDesc']="Data Update to Add";
			}

			echo json_encode($json);

		}

		public function chat(){
            $refid = $this->input->post("refid");
            $result = $this->md->chat($_SESSION['userid'],$refid);
            
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

		public function sendchat() {
            $chatText = $this->input->post('chat');
            $refid    = $this->input->post('refid');
            $status   = $this->input->post('status');

            $data['org_id']     = $_SESSION['orgid'];
            $data['chat_id']    = generateuuid();
            $data['ref_id']     = $refid;
            $data['chat']       = $chatText;
            $data['created_by'] = $_SESSION['userid'];

            if($this->md->insertchat($data)){

                if(empty($this->md->cekresponse($refid,$_SESSION['userid']))){
					$updatereponse['to_datetime'] = date("Y-m-d H:i:s");
					$updatereponse['response']    = "Y";

					$this->md->updatedisposisi($refid,$_SESSION['userid'],$updatereponse);
				};

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

	}
?>