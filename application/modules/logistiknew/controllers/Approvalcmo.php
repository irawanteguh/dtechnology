<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalcmo extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_approvalcmo",$data);
        }

        public function loadcombobox(){
            $resultmasterorganization   = $this->md->masterorganization();

            $masterorganization="";
            foreach($resultmasterorganization as $a ){
                $masterorganization.="<option value='".$a->org_id."'>".$a->org_name."</option>";
            }

            $data['masterorganization'] = $masterorganization;
            return $data;
        }

        public function datapemesanan(){
            $orgid = ($this->input->post("orgid") === "x") ? "" : "AND a.org_id='".$this->input->post("orgid")."'";
            $status  = " 
                            AND (
                                (a.method = '7' AND a.total > 5000000)
                                OR (a.method = '10' AND a.total > 500000)
                                OR (a.method IN ('5','8','9','11','12'))
                            )
                            and   a.status in ('29','30','31')
                        "; 
            $orderby = "order by created_date desc;";

            $result = $this->md->datapemesanan($orgid,$status,$orderby);
            
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

    }
?>