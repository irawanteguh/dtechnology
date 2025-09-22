<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Claimidrg extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
            $this->load->model("Modelclaimidrg","md");
        }

		public function index(){
			// $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_claimidrg");
		}

		// public function loadcombobox(){
        //     $resultmastericd10 = $this->md->mastericd10();

        //     $mastericd10="";
        //     foreach($resultmastericd10 as $a ){
        //         $mastericd10.="<option value='".$a->code_2."' data-validcode='".$a->validcode."'>".$a->description."</option>";
        //     }

        //     $data['mastericd10']  = $mastericd10;
        //     return $data;
        // }

        public function mastericd10() {
    $keyword = $this->input->post("keyword");

    $result = $this->md->mastericd10($keyword);

    $data = [];
    foreach ($result as $a) {
        $data[] = [
            "id"          => $a->code_2,
            "code_2"      => $a->code_2,
            "description" => $a->description,
            "validcode"   => $a->validcode
        ];
    }

    echo json_encode($data);
}

	}

?>