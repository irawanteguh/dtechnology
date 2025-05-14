<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . '/libraries/REST_Controller.php';

    class Sb extends REST_Controller{

        public function __construct(){
            parent::__construct();
            // $this->load->model("Modelkhanza","md");
        }

        
    }

?>