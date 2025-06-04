<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Paymentmanager extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelpaymentmanager", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_paymentmanager");
        }
        
        public function dataonprocess(){
            $status="
                        and   a.status in ('7')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                    ";
            $parameter="order by inv_kains_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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

        public function dataapprove(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $status="
                        and   date(a.inv_manager_date) between '".$startDate."' and '".$endDate."'
                        and   a.status in ('9','11','13','15','16','17')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                        
                    ";
            $parameter="order by inv_manager_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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

        public function datadecline(){
            $status="
                        and   a.status in ('8','10','12','14')
                        and   a.department_id in (
                                                    select department_id
                                                    from dt01_gen_department_ms
                                                    where header_id in (
                                                                            select department_id
                                                                            from dt01_gen_department_ms
                                                                            where user_id='".$_SESSION['userid']."'
                                                                    )
                                                )
                    ";
                    $parameter="order by inv_manager_date desc";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$parameter);
            
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

        public function updateheader(){
            $datanopemesanan = $this->input->post('datanopemesanan');
            $datastatus      = $this->input->post('datastatus');
            $datavalidator   = $this->input->post('datavalidator');
            
            if($datavalidator==="MANAGER"){
                $data['status']           = $datastatus;
                $data['inv_manager_id']   = $_SESSION['userid'];
                $data['inv_manager_date'] = date('Y-m-d H:i:s');
                $data['inv_vice_date']    = date('Y-m-d H:i:s');
                $data['inv_dir_date']     = date('Y-m-d H:i:s');
            }

            if($this->md->updateheader($datanopemesanan,$data)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Update successful";
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Failed to update database";
            }

            echo json_encode($json);
        }
        
    }
?>