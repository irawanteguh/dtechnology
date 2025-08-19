<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Selfassessment extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modelselfassessment","md");
        }

		public function index(){
            $xids = $this->input->get("xids");
            $xide = $this->input->get("xide");

            if($xids && $xide){
                // kalau ada xids & xide
                $data = $this->loadcombobox(); 
                $this->template->load("template/template-sidebar","v_selfassessmentelement",$data);

            }elseif($xids){
                // kalau hanya ada xids
                $data = $this->loadcombobox();
                $this->template->load("template/template-sidebar","v_selfassessmentstandart",$data);

            }else{
                // default
                $this->template->load("template/template-sidebar","v_selfassessmentbab");
            }
        }


        public function loadcombobox(){
            $resultjudulbab      = $this->md->judulbab($this->input->get("xids"));
            $resultjudulstandart = $this->md->judulstandart($this->input->get("xide"));

            $resultstandart = $this->md->standart($this->input->get("xids"));
            $resultelement  = $this->md->element($this->input->get("xide"));

            $judulbab        = ($resultjudulbab) ? $resultjudulbab->penilaian : "-";
            $judulstandart   = ($resultjudulstandart) ? $resultjudulstandart->penilaian : "-";
            $juduldostandart = ($resultjudulstandart) ? $resultjudulstandart->do : "-";

            $liststandart="";
            foreach($resultstandart as $a ){
                $liststandart.="<tr>";
                $liststandart.="<td class='ps-4'>".$a->urut."</td>";
                $liststandart.="<td><div class='fw-bolder'>".$a->penilaian."</div><div class='fst-italic fs-9'>".$a->do."</div></td>";
                $liststandart.="<td class='text-center'><span class='badge badge-light-info'>".$a->jmlelemen." Elemen</span></td>";
                $liststandart.="<td></td>";
                $liststandart.="<td class='text-end'><a href='../../index.php/akreditasi/selfassessment?xids=".$a->bab_id."&xide=".$a->penilaian_id."' class='btn btn-sm btn-light-primary'>Buka Elemen Penilaian</a></td>";
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

                    $listelement.="<td></td>";
                    $listelement .= "<td class='text-end'>";
                        $listelement .="<div class='btn-group' role='group'>";
                            $listelement .="<button id='btnGroupDrop1' type='button' class='btn btn-light-primary dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>Action</button>";
                            $listelement .="<div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>";
                            $listelement .="<a class='dropdown-item btn btn-sm text-primary' href='#' data-bs-toggle='modal' data-bs-target='#modal_sub_element_add' dataelementid='".$a->penilaian_id."'><i class='bi bi-plus-lg text-primary'></i> Tambah Sub Elemen</a>";
                            $listelement .="</div>";
                        $listelement .="</div>";
                    $listelement .="</td>";
                    $listelement.="</tr>";
                }


            $jumlahstandart = is_array($resultstandart) ? count($resultstandart) : 0;

            $data['liststandart'] = $liststandart;
            $data['listelement']  = $listelement;

            $data['jumlahstandart']  = $jumlahstandart." Standart Penilaian";
            $data['judulbab']        = $judulbab;
            $data['judulstandart']   = $judulstandart;
            $data['juduldostandart'] = $juduldostandart;
            return $data;
        }

        public function bab(){
            $result = $this->md->bab();
            
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


	}
?>