<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Login extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
            $this->load->model("Modellogin","md");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_login");
            $this->session->sess_destroy();
        }

        public function loginsystem(){
            $username        = $this->input->post("username");
            $password        = $this->input->post("password");

            $checkauth =$this->md->login($username,$password);
            
            if(!empty($checkauth)){
                $sessiondata = array(
                    "orgid"        => $checkauth->org_id,
                    "hospitalname" => $checkauth->hospitalname,
                    "website"      => $checkauth->hospitalname,
                    "initialuser"  => $checkauth->initialuser,
                    "imgprofile"   => $checkauth->image_profile,
                    "name"         => $checkauth->name,
                    "username"     => $checkauth->username,
                    "loggedin"     => true,
                    "timeout"      => false
                );
                
                $this->session->set_userdata($sessiondata);
    
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Username dan atau Password Valid";
                $json["url"]=base_url()."index.php/dashboard/dashboard";
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Username dan atau Password Tidak Valid";
            }
            
            echo json_encode($json);
        }

        public function logoutsystem()
        {
            $this->session->unset_userdata( 
                $_SESSION['orgid'],
                $_SESSION['hospitalname'],
                $_SESSION['website'],
                $_SESSION['initialuser'],
                $_SESSION['imgprofile'],
                $_SESSION['name'],
                $_SESSION['username'],
                $_SESSION['loggedin'],
                $_SESSION['timeout']
            );
                                            
            $this->session->sess_destroy();
            redirect("auth/login");
        }

    }
?>