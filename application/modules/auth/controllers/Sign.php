<?php
    defined("BASEPATH") OR exit("No direct script access allowed");
    class Sign extends CI_Controller{ 

        public function __construct(){
            parent:: __construct();
            $this->load->model("Modelsign","md");
            $this->load->model("Modelnotification","mn");
        }
        
        public function index(){
            $this->template->load("template/template-blank","v_signin");
            $this->session->sess_destroy();
        }

        public function signin() {
            $username = $this->input->post("username");
            $password = encodedata($this->input->post("password"));
        
            $checkauth = $this->md->login($username, $password);
            
            if (!empty($checkauth)) {
                $datasession = $this->md->datasession($checkauth->user_id);
                $datanotification = $this->mn->informationkpi($datasession->org_id);
        
                $sessiondata = array(
                    "orgid"               => $datasession->org_id,
                    "groupid"             => $datasession->group_id,
                    "hospitalname"        => $datasession->hospitalname,
                    "website"             => $datasession->website,
                    "trial"               => $datasession->trial,
                    "holding"             => $datasession->holding,
                    "userid"              => $datasession->user_id,
                    "leveluser"           => $datasession->level_user,
                    "name"                => $datasession->name,
                    "initial"             => $datasession->initial,
                    "username"            => $datasession->username,
                    "imgprofile"          => $datasession->image_profile,
                    "email"               => $datasession->email,
                    "alamat"              => $datasession->address,
                    "periodeidactivity"   => $datanotification[0]->periodeidactivity ?? null,
                    "periodeidassessment" => $datanotification[0]->periodeidassessment ?? null,
                    "loggedin"            => true,
                    "timeout"             => false
                );
        
                $this->session->set_userdata($sessiondata);
        
                if (empty($datasession->no_hp)) {
                    $json["responCode"] = "03";
                    $json["responHead"] = "warning";
                    $json["responDesc"] = "Please update your mobile phone number.";
                } else {
                    if ($datasession->suspended === "N") {
                        $json["responCode"] = "00";
                        $json["responHead"] = "success";
                        $json["responDesc"] = "Hey, ".$datasession->name."<br>Welcome Back and Have a nice day";
                        $json["url"] = base_url()."index.php/dashboard/dashboard";
                    } else {
                        $json["responCode"] = "02";
                        $json["responHead"] = "error";
                        $json["responDesc"] = "Your account is suspended. Please contact your IT Operation.";
                        $json["url"] = base_url()."index.php/auth/deactive";
                    }
                }
            } else {
                $json["responCode"] = "01";
                $json["responHead"] = "error";
                $json["responDesc"] = "Username and/or Password Unknown";
            }
        
            echo json_encode($json);
        }

        public function updatemobile() {
            $no_hp   = $this->input->post('no_hp');
        
            if (empty($no_hp)) {
                echo json_encode(["success" => false, "message" => "Mobile number is required."]);
                return;
            }

            $data['no_hp']=$no_hp;
        
            $updated = $this->md->updatedata($data, $_SESSION['orgid'], $_SESSION['userid']);
        
            if ($updated) {
                echo json_encode(["success" => true, "message" => "Mobile number updated successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update mobile number."]);
            }
        }
        
        

        public function changepassword(){
            $password = encodedata($this->input->post("newpassword"));
        
            $data['password'] = $password;
        
            if($this->md->updatedata($data, $_SESSION['orgid'], $_SESSION['userid'])){
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