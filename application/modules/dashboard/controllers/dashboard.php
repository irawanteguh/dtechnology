<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

		public function __construct()
        {
            parent:: __construct();
            // rootsystem::system();
        }

		public function index()
		{
			$sessiondata = array(
				"lokasiid"    => "09146506-a443-494d-ad42-7d8230535b6a",
				"userid"      => "ae16e56b-df6c-43fe-bf60-1f07ea9cdb91",
				"username"    => "",
				"password"    => "",
				"intialuser"  => "TE",
				"namauser"    => "Teguh Irawan",
				"imguser"     => "N",
				"fotoprofile" => "2d016865-64cd-4eaf-b0fc-269995f29b7f.jpg",
				"namars"      => "DTech Hospital",
				"website"     => "https://dtech.com",
				"loggedin"    => true,
				"timeout"     => false
			);

			$structure = "./assets/fileapps/".$_SESSION["lokasiid"]."/".$_SESSION["userid"]."/";
    
			if(!is_dir($structure)){
				mkdir($structure, 0777, true);      
			};
			
			$this->session->set_userdata($sessiondata);
			
			$this->template->load("template/template-admin","v_dashboard");
		}

	}

?>