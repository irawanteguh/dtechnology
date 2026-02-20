<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Websitemutiasari extends CI_Controller{ 
        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelmutiasari","md");
        }
        
        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-landingpage","v_websitemutiasari",$data);
        }

        public function loadcombobox(){
            $directory            = FCPATH.'assets/images/gallery/';
            $resultmasterkolegium = $this->md->masterkolegium(ORG_ID);
            $resultmasterdoctor   = $this->md->masterdoctor(ORG_ID);

            $masterkolegium     = "";
            $descmasterkolegium = "";
            $masterdoctor       = "";
            $gallery            = "";
            $first              = true;

            foreach($resultmasterkolegium as $a ){
                $activeClass = $first ? "active show" : "";
                $masterkolegium     .= "<li class='nav-item'><a class='nav-link $activeClass' data-bs-toggle='tab' href='#".$a->kolegium_id."'>" . $a->kolegium . "</a></li>";
                $descmasterkolegium .= "<div class='tab-pane $activeClass' id='".$a->kolegium_id."' role='tabpanel'><div class='row gy-4'><div class='col-lg-8 details order-2 order-lg-1'><h3>".$a->kolegium."</h3><p class='fst-italic'>".$a->description_eng."</p><p>".$a->description."</p></div><div class='col-lg-4 text-center order-1 order-lg-2'><img src='assets/img/departments-1.jpg' alt='' class='img-fluid'></div></div></div>";
                $first = false;
            }

            foreach($resultmasterdoctor as $a ){
                $masterdoctor     .= "<div class='col-lg-6'>";
                    $masterdoctor     .= "<div class='member d-flex align-items-start'>";
                        $masterdoctor     .= "<div class='pic'><img src='".base_url("assets/images/avatars/".$a->user_id).".jpg' class='img-fluid' alt=''></div>";
                        $masterdoctor     .= "<div class='member-info'>";
                                $masterdoctor .= "<h4>".$a->name."</h4>";
                                $masterdoctor .= "<span>".$a->kolegium."</span>";
                                $masterdoctor .= "<p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>";
                                $masterdoctor .= "<div class='social'>";
                                    $masterdoctor .= "<a href=''><i class='ri-twitter-fill'></i></a>";
                                    $masterdoctor .= "<a href=''><i class='ri-facebook-fill'></i></a>";
                                    $masterdoctor .= "<a href=''><i class='ri-instagram-fill'></i></a>";
                                    $masterdoctor .= "<a href=''><i class='ri-linkedin-box-fill'></i></a>";
                                $masterdoctor .= "</div>";
                        $masterdoctor     .= "</div>";
                    $masterdoctor     .= "</div>";
                $masterdoctor     .= "</div>";
            }

            if (is_dir($directory)) {
                $files = glob($directory . '*.jpg');
                foreach ($files as $file) {
                    $filename = basename($file); 
                    $gallery .= "<div class='col-lg-3 col-md-4'><div class='gallery-item'><a href='".base_url("assets/images/gallery/".$filename)."' class='galelry-lightbox'><img src='".base_url("assets/images/gallery/".$filename)."' alt='' class='img-fluid'></a></div></div>";
                }
            }

            $data['masterkolegium']     = $masterkolegium;
            $data['descmasterkolegium'] = $descmasterkolegium;
            $data['masterdoctor']       = $masterdoctor;
            $data['gallery']            = $gallery;
            return $data;
		}
    }
?>