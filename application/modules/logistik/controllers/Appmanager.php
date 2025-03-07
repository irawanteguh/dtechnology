<?php
    defined('BASEPATH') or exit('No direct script access allowed');
    class Appmanager extends CI_Controller{

        public function __construct(){
            parent::__construct();
            rootsystem::system();
            $this->load->model("Modelrequestnew", "md");
        }

        public function index(){
            $this->template->load("template/template-sidebar", "v_appmanager");
        }

        public function datarequest(){
            $status="
                        and   a.status in ('2')
                        and (
                                (
                                    a.status <> '6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
                                )
                            )
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
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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
        //     $status="
        //                 and   a.status in ('4','6')
        //                 and (
        //                         (
        //                             a.status <> '6' 
        //                             and (a.status_vice is null or a.status_vice = '') 
        //                             and (a.status_dir is null or a.status_dir = '')
        //                         )
        //                         or
        //                         (
        //                             a.status='6' 
        //                             and (a.status_vice is null or a.status_vice = '') 
        //                             and (a.status_dir is null or a.status_dir = '')
        //                         )
        //                         or
        //                         (
        //                             a.status='6'
        //                             and a.status_vice='Y'
        //                             and (a.status_dir is null or a.status_dir = '')
        //                         )
        //                         or
        //                         (
        //                             a.status='6'
        //                             and a.status_dir='Y'
        //                             and (a.status_vice is null or a.status_vice = '')
        //                         )
        //                         or
        //                         (
        //                             a.status='6'
        //                             and a.status_vice='Y'
        //                             and a.status_dir='Y'
        //                         )
        //                     )
        //                 and   a.department_id in (
        //                                             select department_id
        //                                             from dt01_gen_department_ms
        //                                             where header_id in (
        //                                                                     select department_id
        //                                                                     from dt01_gen_department_ms
        //                                                                     where user_id='".$_SESSION['userid']."'
        //                                                             )
        //                                         )
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

        public function approve(){
            $status="
                        and   a.status in ('4','6')
                        and (
                                (
                                    a.status <> '6' 
                                    and (a.status_vice is null or a.status_vice = '') 
                                    and (a.status_dir is null or a.status_dir = '')
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
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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

        public function decline(){
            $status="
                        and   a.status in ('3','5','6')
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
            $result = $this->md->datarequest($_SESSION['orgid'],$status);
            
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