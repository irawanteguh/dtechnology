<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Approvalcfo extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequest", "md");
        }

        public function index(){
            $data = $this->loadcombobox();
            $this->template->load("template/template-sidebar","v_approvalcfo",$data);
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
                                (a.method = '7' AND a.total > 2000000)
                                OR(a.method = '10' AND a.total > 500000)
                                OR (a.method IN ('5','8','9','11','12','14'))
                            )
                            and   a.status in ('21','23','25','27','28','29','30','31')
                        ";
           $orderby = "
                            ORDER BY 
                            CASE WHEN a.status = '29' THEN a.cfo_date END DESC

                        ";

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