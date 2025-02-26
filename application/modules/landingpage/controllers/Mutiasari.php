<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Mutiasari extends CI_Controller{ 
        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelmutiasari","md");
        }
        
        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-landingpage","v_mutiasari",$data);
        }

        public function loadcombobox(){
            $asurance       = "";
            $gallery        = "";
            $masterdoctor   = "";
            $masterkolegium = "";
            $jadwaldokter   = "";
            $first          = true;
            $delay          = 100;

            $directory            = FCPATH.'assets/images/asurance/';
            $directorygalery      = FCPATH.'assets/images/gallery/';
            $resultmasterdoctor   = $this->md->masterdoctor(ORG_ID);
            $resultmasterkolegium = $this->md->masterkolegium(ORG_ID);
            $resultjadwaldokter   = $this->md->masterdoctor(ORG_ID);

            

            foreach($resultmasterdoctor as $a ){
                $masterdoctor .="<div class='col-lg-3 col-md-6 d-flex align-items-stretch'>";
                    $masterdoctor .="<div class='member' data-aos='fade-up' data-aos-delay='".$delay."'>";
                        $masterdoctor .="<div class='member-img'>";
                            $masterdoctor .="<img src='".base_url("assets/images/avatars/".$a->user_id).".png' class='img-fluid' alt=''>";
                            $masterdoctor .= "<div class='social'>";
                                $masterdoctor .= "<a href=''><i class='bi bi-twitter'></i></a>";
                                $masterdoctor .= "<a href=''><i class='bi bi-facebook'></i></a>";
                                $masterdoctor .= "<a href=''><i class='bi bi-instagram'></i></a>";
                                $masterdoctor .= "<a href=''><i class='bi bi-linkedin'></i></a>";
                            $masterdoctor .= "</div>";
                        $masterdoctor .="</div>";
                        $masterdoctor .="<div class='member-info'>";
                            $masterdoctor .="<h4>".$a->name."</h4>";
						    $masterdoctor .="<span>".$a->kolegium."</span>";
                        $masterdoctor .="</div>";
                    $masterdoctor .="</div>";
                $masterdoctor .="</div>";

                $delay += 200;
            }

            // foreach ($resultmasterkolegium as $a) {
            //     $masterkolegium .="<div class='col-md-6 d-flex align-items-stretch'>";
            //         $masterkolegium .="<div class='card' style='' data-aos='fade-up' data-aos-delay='100'>";
            //             $masterkolegium .="<div class='card-body'>";
            //                 $masterkolegium .="<h5 class='card-title'><a href=''>".$a->kolegium."</a></h5>";
            //                 $masterkolegium .="<p class='card-text'>".$a->description."</p>";
            //             $masterkolegium .="</div>";
            //         $masterkolegium .="</div>";
            //     $masterkolegium .="</div>";
            // }

            foreach ($resultmasterkolegium as $a) {
                $masterkolegium .="<div class='col-lg-3 col-md-4 mt-4'>";
                    $masterkolegium .="<div class='icon-box'>";
                        $masterkolegium .="<i class='".$a->icon."' style='color: #cc1919;'></i>";
                        $masterkolegium .="<h3><a href=''>".$a->kolegium."</a></h3>";
                    $masterkolegium .="</div>";
                $masterkolegium .="</div>";
            }

            if (is_dir($directory)) {
                $files = glob($directory . '*.{png,jpg,jpeg}', GLOB_BRACE);
                
                if (!empty($files)) {
                    // Bagi gambar menjadi kelompok 4 per slide
                    $chunks = array_chunk($files, 2);
            
                    foreach ($chunks as $group) {
                        $asurance .= "<div class='swiper-slide'><div class='row justify-content-center align-items-center'>";
                        
                        foreach ($group as $file) {
                            $filename = basename($file);
                            $asurance .= "<div class='col-lg-6 col-md-6 col-6 text-center'>
                                            <div class='client-logo'>
                                                <img src='" . base_url("assets/images/asurance/" . $filename) . "' class='img-fluid' alt=''>
                                            </div>
                                          </div>";
                        }
            
                        $asurance .= "</div></div>"; // Tutup swiper-slide dan row
                    }
                }
            }  
            
            if (is_dir($directorygalery)) {
                $files = glob($directorygalery . '*.jpg');
                foreach ($files as $file) {
                    $filename = basename($file); 
                    $gallery .="<div class='col-lg-4 col-md-6 portfolio-item filter-app'>";
                        $gallery .="<div class='portfolio-wrap'>";
                            $gallery .="<img src='".base_url("assets/images/gallery/".$filename)."' alt='' class='img-fluid'>";
                            $gallery .="<div class='portfolio-info'>";
                                $gallery .="<h4>App 1</h4>";
                                $gallery .="<p>App</p>";
                                $gallery .="<div class='portfolio-links'>";
                                    $gallery .="<a href='".base_url("assets/images/gallery/".$filename)."' data-gallery='portfolioGallery' class='portfolio-lightbox' title='App 1'><i class='bx bx-plus'></i></a>";  
                                    $gallery .="<a href='portfolio-details.html' title='More Details'><i class='bx bx-link'></i></a>"; 
                                $gallery .="</div>";
                            $gallery .="</div>";
                        $gallery .="</div>";
                    $gallery .="</div>";
                }
            }

            $jadwaldokter .="<div class='table-responsive'>";
                $jadwaldokter .="<table class='table align-middle table-row-dashed fs-6 gy-2'>";
                    $jadwaldokter .="<thead>";
                        $jadwaldokter .="<tr>";
                            $jadwaldokter .="<th>Spesialis</th>";
                            $jadwaldokter .="<th>Nama Dokter</th>";
                            $jadwaldokter .="<th>Senin</th>";
                            $jadwaldokter .="<th>Selasa</th>";
                            $jadwaldokter .="<th>Rabu</th>";
                            $jadwaldokter .="<th>Kamis</th>";
                            $jadwaldokter .="<th>Jumat</th>";
                            $jadwaldokter .="<th>Sabtu</th>";
                        $jadwaldokter .="</tr>";
                    $jadwaldokter .="</thead>";
                    $jadwaldokter .="<tbody>";
                    foreach($resultjadwaldokter as $a ){
                        $jadwaldokter .="<tr>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td>".$a->name."</td>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td></td>";
                            $jadwaldokter .="<td></td>";
                        $jadwaldokter .="</tr>";
                    }
                    $jadwaldokter .="</tbody>";
                $jadwaldokter .="</table>";
            $jadwaldokter .="</div>";
        

            $data['masterdoctor']       = $masterdoctor;
            $data['masterkolegium']     = $masterkolegium;
            $data['asurance']     = $asurance;
            $data['gallery']     = $gallery;
            $data['jadwaldokter']     = $jadwaldokter;

            return $data;
		}
    }
?>