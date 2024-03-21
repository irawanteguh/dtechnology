<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    include FCPATH."vendor/phpqrcode/qrlib.php";

	class Uploadfile extends CI_Controller {

        public static $clientid;
        public static $clientsecret;
        public static $coordinatex;
        public static $coordinatey;
        public static $height;
        public static $width;
        public static $page;

		public function __construct()
        {
            parent:: __construct();
            rootsystem::system();
            Tilaka::init();

			$this->load->model("Modeluploadfile","md");

            self::$clientid       = CLIENT_ID;
            self::$clientsecret   = CLIENT_SECRET;

            self::$coordinatex = COORDINATE_X;
            self::$coordinatey = COORDINATE_Y;
            self::$height      = HEIGHT;
            self::$width       = WIDTH;
            self::$page        = PAGE;
        }

		public function index()
		{
            $this->template->load("template/template-admin","v_uploadfile");
		}

        public function dataupload(){
            $result = $this->md->dataupload($_SESSION['orgid']);
            
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