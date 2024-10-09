<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    class Sign extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelsign","md");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_signin");
            $this->session->sess_destroy();
        }

        public function signin(){
            $username        = $this->input->post("username");
            $password        = encodedata($this->input->post("password"));

            $checkauth =$this->md->login($username,$password);
            
            if(!empty($checkauth)){
                $datasession = $this->md->datasession($checkauth->user_id);

                $sessiondata = array(
                    "orgid"        => $datasession->org_id,
                    "hospitalname" => $datasession->hospitalname,
                    "website"      => $datasession->website,
                    "trial"        => $datasession->trial,
                    "userid"       => $datasession->user_id,
                    "name"         => $datasession->name,
                    "initial"      => $datasession->initial,
                    "username"     => $datasession->username,
                    "imgprofile"   => $datasession->image_profile,
                    "email"        => $datasession->email,
                    "alamat"       => $datasession->address,
                    "loggedin"     => true,
                    "timeout"      => false
                );
                
                $this->session->set_userdata($sessiondata);
    
                if($datasession->suspended==="N"){
                    $json["responCode"]="00";
                    $json["responHead"]="success";
                    $json["responDesc"]="Hey, ".$datasession->name."<br>Welcome Back and Have a nice day";
                    $json["url"]=base_url()."index.php/dashboard/dashboard";
                }else{
                    $json["responCode"]="02";
                    $json["responHead"]="error";
                    $json["responDesc"]="Your account is suspended please Contact your IT Operation";
                    $json["url"]=base_url()."index.php/auth/deactive";
                }
            }else{
                $json["responCode"]="01";
                $json["responHead"]="error";
                $json["responDesc"]="Username and/or Password Unknown";
            }
            
            echo json_encode($json);
        }

        public function changepassword(){
            $password = encodedata($this->input->post("newpassword"));
        
            $data['PASSWORD'] = $password;
        
            if($this->md->updatepassword($data, $_SESSION['orgid'], $_SESSION['userid'])){
                $json["responCode"] = "00";
                $json["responHead"] = "success";
                $json["responDesc"] = "You have successfully reset your password!";
            } else {
                $json["responCode"] = "01";
                $json["responHead"] = "info";
                $json["responDesc"] = "Sorry, looks like there are some errors detected, please try again.";
            }
        
            echo json_encode($json);
        }
        

        public function logoutsystem(){                            
            $this->session->sess_destroy();
            redirect("auth/sign");
        }

    }
?>