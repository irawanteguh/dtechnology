<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Login extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
            $this->load->model("Modellogin","md");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_login");
        }

        public function loginsystem(){
            $username        = $this->input->post("username");
            $password        = $this->input->post("password");
            // $usernameencrypt = $this->encryption->encrypt($username);
            // $passwordencrypt = $this->encryption->encrypt($password);

            $checkauth =$this->md->login($username,$password);
            
            if(!empty($checkauth)){
                $sessiondata = array(
                    "initialuser"  => $checkauth->initialuser,
                    "name"         => $checkauth->name,
                    "hospitalname" => $checkauth->hospitalname,
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

    }
?>