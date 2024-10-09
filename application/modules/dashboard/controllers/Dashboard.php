<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Dashboard extends CI_Controller {

		public function __construct(){
            parent:: __construct();
			rootsystem::system();
			$this->load->model("Modeldashboard","md");
        }

		public function index(){
            $data = $this->loadcombobox();
			$this->template->load("template/template-sidebar","v_dashboard",$data);
		}

        public function loadcombobox(){
            $resultprioritas= $this->md->prioritas();
            $prioritas="";
            foreach($resultprioritas as $a ){
                $prioritas.="<option value='".$a->id."'>".$a->status."</option>";
            }

            $data['prioritas'] = $prioritas;
            return $data;
		}

		public function todolist(){
            $result = $this->md->todolist($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function datastaff(){
            $result = $this->md->datastaff($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function charttodolist(){
            $result = $this->md->charttodolist($_SESSION['orgid'],$_SESSION['userid']);
            
			if(!empty($result)){
                $json["responCode"]="00";
                $json["responHead"]="success";
                $json["responDesc"]="Data Di Temukan";
				$json['responResult']=$result;
            }else{
                $json["responCode"]="01";
                $json["responHead"]="info";
                $json["responDesc"]="Data Tidak Di Temukan";
            }

            echo json_encode($json);
        }

        public function inserttodolist(){
            
            $data['org_id']     = $_SESSION['orgid'];
            $data['todo_id']    = generateuuid();
            $data['priority']   = $this->input->post("todolist-prioritas-tambah");
            $data['todo']       = $this->input->post("todolist-kegiatan-tambah");
            $data['due_date']   = DateTime::createFromFormat("d.m.Y", $this->input->post("todolist-duedate-tambah"))->format("Y-m-d");
            $data['user_id']    = $_SESSION['userid'];
            $data['created_by'] = $_SESSION['userid'];
            
            if($this->md->inserttodolist($data)){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Tambah Todo List Berhasil";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Tambah Todo List Gagal";
            }

            echo json_encode($json);
        }

        public function updatetodolist() {
            $data['STATUS']=$this->input->post('status');
            
            if($this->md->updatetodolist($data, $this->input->post('id'))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Update Todo List Berhasil";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Update Todo List Gagal";
            }

            echo json_encode($json);
        }

        public function deletetodolist() {
            $data['ACTIVE']="0";
            
            if($this->md->updatetodolist($data, $this->input->post('id'))){
                $json['responCode']="00";
                $json['responHead']="success";
                $json['responDesc']="Update Todo List Berhasil";
            }else{
                $json['responCode']="01";
                $json['responHead']="info";
                $json['responDesc']="Update Todo List Gagal";
            }

            echo json_encode($json);
        }
        

	}
?>