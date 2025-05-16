<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Appfinance extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_appfinance");
        }


        public function datarequest(){
            $startDate             = $this->input->post("startDate");
            $endDate               = $this->input->post("endDate");

            $status = "
                            AND a.status IN ('4')
                            -- AND date(a.created_date) between '".$startDate."' and '".$endDate."'
                        ";

            $orderby ="order by manager_date asc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);

            
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

        // public function datarequest(){
        //     $startDate = $this->input->post("startDate");
        //     $endDate   = $this->input->post("endDate");

        //     $status = "
        //                 and a.status in ('4')
        //                 and (
        //                         (
        //                             a.status <> '6' 
        //                             and (a.status_vice is null or a.status_vice = '') 
        //                             and (a.status_dir is null or a.status_dir = '')
        //                         )
        //                     )
        //                 and a.created_date between '".$startDate."' and '".$endDate."'
        //             ";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        // public function decline(){
        //     $status = "
        //                     and a.status in ('5','6')
        //                     and (
        //                             (
        //                                 a.status <> '6' 
        //                                 and (a.status_vice is null or a.status_vice = '') 
        //                                 and (a.status_dir is null or a.status_dir = '')
        //                             )
        //                             or
        //                             (
        //                                 a.status = '6'
        //                                 and (a.status_vice = 'N' or a.status_dir = 'N')
        //                             )
        //                         )
        //               ";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        public function decline(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");

            $status = "
                            and a.status in ('5','6')
                            and (
                                    (
                                        a.status <> '6' 
                                        and (a.status_vice is null or a.status_vice = '') 
                                        and (a.status_dir is null or a.status_dir = '')
                                        and (a.status_com is null or a.status_com = '')
                                    )
                                    or
                                    (
                                        a.status = '6'
                                        and (a.status_vice = 'N' or a.status_dir = 'N' or a.status_com = 'N')
                                    )
                                )
                            AND date(a.created_date) between '".$startDate."' and '".$endDate."'
                      ";
            $orderby ="order by keu_date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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

        // public function approve(){
        //     $status =   "
        //                     and a.status in ('6')
        //                     and (
        //                             (
        //                                 a.status <> '6' 
        //                                 and (a.status_vice is null or a.status_vice = '') 
        //                                 and (a.status_dir is null or a.status_dir = '')
        //                             )
        //                             or
        //                             (
        //                                 a.status='6' 
        //                                 and (a.status_vice is null or a.status_vice = '') 
        //                                 and (a.status_dir is null or a.status_dir = '')
        //                             )
        //                             or
        //                             (
        //                                 a.status='6'
        //                                 and a.status_vice='Y'
        //                                 and (a.status_dir is null or a.status_dir = '')
        //                             )
        //                             or
        //                             (
        //                                 a.status='6'
        //                                 and a.status_dir='Y'
        //                                 and (a.status_vice is null or a.status_vice = '')
        //                             )
        //                             or
        //                             (
        //                                 a.status='6'
        //                                 and a.status_vice='Y'
        //                                 and a.status_dir='Y'
        //                             )
        //                         )
        //                 ";
        //     $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
		// 	if(!empty($result)){
        //         $json["responCode"]="00";
        //         $json["responHead"]="success";
        //         $json["responDesc"]="Data Successfully Found";
		// 		$json['responResult']=$result;
        //     }else{
        //         $json["responCode"]="01";
        //         $json["responHead"]="info";
        //         $json["responDesc"]="Data Failed to Find";
        //     }

        //     echo json_encode($json);
        // }

        public function approve(){
            $startDate = $this->input->post("startDate");
            $endDate   = $this->input->post("endDate");
            $status =   "
                            and a.status in ('6')
                            and (
                                    (
                                        a.status <> '6' 
                                        and (a.status_vice is null or a.status_vice = '') 
                                        and (a.status_dir is null or a.status_dir = '')
                                        and (a.status_com is null or a.status_com = '')
                                    )
                                    or
                                    (
                                        a.status='6' 
                                        and (a.status_vice is null or a.status_vice = '') 
                                        and (a.status_dir is null or a.status_dir = '')
                                    )
                                    or
                                    (
                                        a.status='6'
                                        and a.status_vice='Y'
                                        and (a.status_dir is null or a.status_dir = '')
                                    )
                                    or
                                    (
                                        a.status='6'
                                        and a.status_dir='Y'
                                        and (a.status_vice is null or a.status_vice = '')
                                    )
                                    or
                                    (
                                        a.status='6'
                                        and a.status_vice='Y'
                                        and a.status_dir='Y'
                                    )
                                )
                            AND date(a.created_date) between '".$startDate."' and '".$endDate."'
                        ";
            $orderby ="order by keu_date desc;";
            $result = $this->md->datarequest($_SESSION['orgid'],$status,$orderby);
            
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