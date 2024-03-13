<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    
    class Login extends CI_Controller{ 

        public function __construct()
        {
            parent:: __construct();
            // $this->load->model("Modellogin","md");
        }
        
        public function index()
        {
            $this->template->load("template/template-blank","v_login");
        }

        public function loginsystem()
		{
            $username  =$this->input->post("username");
            $password  =$this->input->post("password");

            $checkauth =$this->md->login($username,$password);
            
            if(!empty($checkauth)){
                $sessiondata = array(
                    "intialuser"   => $checkauth->INITIALUSER,
                    "useridprefix" => $checkauth->USERIDPREFIX,
                    "userid"       => $checkauth->USERIDLOGIN,
                    "nik"          => $checkauth->NIK,
                    "nama"         => $checkauth->NAMA,
                    "password"     => $checkauth->PASSWORD,
                    "pin"          => $checkauth->PIN,
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