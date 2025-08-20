<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Selfassessment extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelselfassessment","md");
        }

		public function index(){
            $xidb = $this->input->get("xidb");
            $xids = $this->input->get("xids");
            $xide = $this->input->get("xide");

            if($xidb && $xids && $xide){
                $data = $this->loadcombobox(); 
                $this->template->load("template/template-sidebar","v_selfassessmentdocument",$data);
            }elseif($xidb && $xids){
                $data = $this->loadcombobox(); 
                $this->template->load("template/template-sidebar","v_selfassessmentelement",$data);
            }elseif($xidb){
                $data = $this->loadcombobox();
                $this->template->load("template/template-sidebar","v_selfassessmentstandart",$data);
            }else{
                $this->template->load("template/template-sidebar","v_selfassessmentbab");
            }
        }


        public function loadcombobox(){
            $resultjudulbab      = $this->md->judulbab($this->input->get("xidb"));
            $resultjudulstandart = $this->md->judulstandart($this->input->get("xids"));
            $resultjudulelement  = $this->md->judulelement($this->input->get("xide"));

            $resultstandart     = $this->md->standart($_SESSION['orgid'],$this->input->get("xidb"));
            $resultelement      = $this->md->element($_SESSION['orgid'],$this->input->get("xids"));
            $resultlistdokument = $this->md->listdokument($_SESSION['orgid'],$this->input->get("xide"));

            $judulbab      = ($resultjudulbab) ? $resultjudulbab->penilaian : "-";
            $judulstandart = ($resultjudulstandart) ? $resultjudulstandart->penilaian : "-";
            $judulelement  = ($resultjudulelement) ? $resultjudulelement->penilaian : "-";

            $juduldostandart = ($resultjudulstandart) ? $resultjudulstandart->do : "-";

            $liststandart="";
            foreach($resultstandart as $a ){
                $liststandart.="<tr>";
                $liststandart.="<td class='ps-4'>".$a->urut."</td>";
                $liststandart.="<td><div class='fw-bolder'>".$a->penilaian."</div><div class='fst-italic fs-9'>".$a->do."</div></td>";
                $liststandart.="<td class='text-center'><span class='badge badge-light-info'>".$a->jmlelemen." Elemen</span></td>";
                $liststandart.= "<td class='text-center'><div class='mb-2'><span class='badge ".($a->elementterisi==0?"badge-light-danger":"badge-light-warning")."'>".$a->elementterisi." Elemen Terisi</span></div><div><span class='badge ".($a->jmldocument==0?"badge-light-danger":"badge-light-success")."'>".$a->jmldocument." Dokumen</span></div></td>";
                $liststandart.="<td class='text-end'><a href='../../index.php/akreditasi/selfassessment?xidb=".$a->bab_id."&xids=".$a->penilaian_id."' class='btn btn-sm btn-light-primary'>Buka Elemen Penilaian</a></td>";
                $liststandart.="</tr>";
            }

            $listelement="";
            foreach($resultelement as $a ){
                $listelement.="<tr>";
                $listelement.="<td class='ps-4'>".$a->urut."</td>";
                $listelement.="<td>";
                    $listelement.="<div>";
                        $listelement.="<div class='fw-bolder'>".$a->penilaian."</div>";
                        $listelement.="<div class='fst-italic fs-9'>".$a->do."</div>";

                        if (!empty($a->subelement)) {
                            $subelements = explode(";", $a->subelement);
                            $listelement .= "<ul class='mt-1 ps-4' style='list-style-type: lower-alpha;'>"; 
                            foreach($subelements as $sub){
                                $listelement .= "<li class='fs-8 text-muted'>".$sub."</li>";
                            }
                            $listelement .= "</ul>";
                        }

                    $listelement.="</div>";
                $listelement.="</td>";

                $listelement .= "<td class='text-center'><div class='mb-2'><span class='badge ".($a->elementterisi==0?"badge-light-danger":"badge-light-warning")."'>".$a->elementterisi." Elemen Terisi</span></div><div><span class='badge ".($a->jmldocument==0?"badge-light-danger":"badge-light-success")."'>".$a->jmldocument." Dokumen</span></div></td>";
                $listelement .= "<td class='text-end'>";
                    $listelement .="<div class='btn-group' role='group'>";
                        $listelement .="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                        $listelement .="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                        $listelement .="<a class='dropdown-item btn btn-sm text-primary' href='../../index.php/akreditasi/selfassessment?xidb=".$a->bab_id."&xids=".$a->standart_id."&xide=".$a->penilaian_id."'><i class='bi bi-cloud-arrow-up text-primary'></i> Upload dan Penilaian Dokumen</a>";
                        $listelement .="<a class='dropdown-item btn btn-sm text-primary' data-bs-toggle='modal' data-bs-target='#modal_sub_element_add' dataelementid='".$a->penilaian_id."'><i class='bi bi-plus-lg text-primary'></i> Tambah Sub Elemen</a>";
                        $listelement .="</div>";
                    $listelement .="</div>";
                $listelement .="</td>";
                $listelement.="</tr>";
            }

            $listdokument="";
            foreach($resultlistdokument as $i => $a){
                $listdokument.="<tr>";
                $listdokument .= "<td class='ps-4'>".($i+1)."</td>";
                $listdokument.="<td>".$a->judul."</td>";
                $listdokument.="<td>".$a->catatan."</td>";
                $listdokument.="<td class='text-end'><div>".$a->dibuatoleh."</div><div>".$a->tgldibuat."</div></td>";
                $listdokument .= "<td class='text-end'>";
                    $listdokument .="<div class='btn-group' role='group'>";
                        $listdokument .="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                        $listdokument .="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                        $listdokument.="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_view_pdf' data-dirfile='".base_url("assets/akreditasi/".$a->transaksi_id.".pdf")."' onclick='viewdocwithoutnote(this)'><i class='bi bi-eye text-primary'></i> View Dokumen</a>";
                        $listdokument .="</div>";
                    $listdokument .="</div>";
                $listdokument .="</td>";
                $listdokument.="</tr>";
            }


            $jumlahstandart = is_array($resultstandart) ? count($resultstandart) : 0;

            $data['liststandart'] = $liststandart;
            $data['listelement']  = $listelement;
            $data['listdokument'] = $listdokument;

            $data['jumlahstandart']  = $jumlahstandart." Standart Penilaian";

            $data['judulbab']      = $judulbab;
            $data['judulstandart'] = $judulstandart;
            $data['judulelement']  = $judulelement;

            $data['juduldostandart'] = $juduldostandart;
            return $data;
        }

        public function bab(){
            $result = $this->md->bab($_SESSION['orgid']);
            
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

        public function addstandart(){
            $data['penilaian_id'] = generateuuid();
            $data['penilaian']    = $this->input->post("modal_standart_add_penilaian");
            $data['do']           = $this->input->post("modal_standart_add_do");
            $data['bab_id']       = $this->input->post("modal_standart_babid");
            $data['jenis_id']     = "S";
            $data['urut']         = $this->md->urutstandart($this->input->post("modal_standart_babid"))->jml;
            $data['created_by']   = $_SESSION['userid'];

            if($this->md->insertpenilian($data)){
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

        public function addelement(){
            $data['penilaian_id'] = generateuuid();
            $data['penilaian']    = $this->input->post("modal_element_add_penilian");
            $data['bab_id']       = $this->input->post("modal_element_babid");
            $data['standart_id']  = $this->input->post("modal_element_standartid");
            $data['jenis_id']     = "E";
            $data['urut']         = $this->md->urutelement($this->input->post("modal_element_standartid"))->jml;
            $data['created_by']   = $_SESSION['userid'];

            if($this->md->insertpenilian($data)){
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

        public function addsubelement(){
            $data['penilaian_id'] = generateuuid();
            $data['penilaian']    = $this->input->post("modal_sub_element_add_penilian");
            $data['bab_id']       = $this->input->post("modal_sub_element_babid");
            $data['standart_id']  = $this->input->post("modal_sub_element_standartid");
            $data['element_id']   = $this->input->post("modal_sub_element_elementid");
            $data['jenis_id']     = "SE";
            $data['urut']         = $this->md->urutelement($this->input->post("modal_sub_element_elementid"))->jml;
            $data['created_by']   = $_SESSION['userid'];

            if($this->md->insertpenilian($data)){
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

        public function adddocument(){
            $transid = generateuuid();

            $config['upload_path']   = './assets/akreditasi/';
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = $transid;
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('modal_upload_document_file')) {
                $error_message = strip_tags($this->upload->display_errors());

                log_message('error', 'File upload error: ' . $error_message);

                $json['responCode'] = "01";
                $json['responHead'] = "info";
                $json['responDesc'] = $error_message;
            } else {
                $data['org_id']       = $_SESSION['orgid'];
                $data['transaksi_id'] = $transid;
                $data['simulasi_id']  = "07c99f2f-761e-47b3-b488-41d9f41935fb";
                $data['bab_id']       = $this->input->post("modal_upload_document_babid") ?: null;
                $data['standart_id']  = $this->input->post("modal_upload_document_standartid") ?: null;
                $data['element_id']   = $this->input->post("modal_upload_document_elementid") ?: null;
                $data['judul']        = $this->input->post("modal_upload_document_name") ?: null;
                $data['catatan']      = $this->input->post("modal_upload_document_note") ?: null;
                $data['created_by']   = $_SESSION['userid'];

                if($this->md->insertdocument($data)){
                    $json['responCode']="00";
                    $json['responHead']="success";
                    $json['responDesc']="Data Added Successfully";
                } else {
                    $json['responCode']="01";
                    $json['responHead']="info";
                    $json['responDesc']="Data Failed to Add";
                }
            }

            echo json_encode($json);
        }

        public function masternilai(){
            $xide   = $this->input->post("xide");

            $resultjenisnilai = $this->md->judulelement($xide)->jenis_penilaian;

            if($resultjenisnilai ==="1"){
                $parameter ="where x.nilaiid<>'2'";
            }else{
                $parameter ="";
            }

            $resultmasternilai = $this->md->masternilai($parameter);
            
			$json="";
            foreach($resultmasternilai as $a ){
                $json.="<option value='".$a->nilaiid."'>".$a->keterangan."</option>";
            }

            echo $json;

        }


	}
?>