<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Tabledb extends CI_Controller {

        public static $host;
		public static $user;
		public static $password;
		public static $database;
		public static $pathdatabase;
		public static $backupPath;

		public function __construct(){
            parent:: __construct();
            rootsystem::system();
            $this->load->model("Modeltabledb","md");

            self::$host         = "localhost";
			self::$user         = "root";
			self::$password     = "";
			self::$database     = "sikms";
			self::$pathdatabase = FCPATH."database/";
			self::$backupPath   = self::$pathdatabase.date('Y-m-d-H-i-s').'.sql';
        }

		public function index(){
            $this->template->load("template/template-sidebar","v_tabledb");
		}

        public function mastertabledb(){
            $result = $this->md->mastertabledb();
            
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

        function backuptable(){
			$table = $this->input->post("tablename");

			if(!is_dir(self::$pathdatabase)){
				mkdir(self::$pathdatabase, 0777, true);      
			};
			
			// Koneksi ke database
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
			
			// Periksa koneksi
			if ($conn->connect_error) {
				die("Koneksi ke database gagal: " . $conn->connect_error);
			}
		
			// Loop melalui tabel dan membuat file backup
			$handle     = fopen(self::$pathdatabase.$table."_".date('Y-m-d-H-i-s').'.sql','w+');
			$result     = $conn->query("SELECT * FROM $table");
			$numColumns = $result->field_count;
			// Tulis query DROP TABLE jika file backup baru
			if (ftell($handle) == 0){
				fwrite($handle, "DROP TABLE IF EXISTS $table;\n\n");
			}
			// Tulis query untuk membuat tabel
			$createTableQuery = $conn->query("SHOW CREATE TABLE $table");
			$createTable = $createTableQuery->fetch_row();
			fwrite($handle, $createTable[1].";\n\n");

			// Tulis query INSERT untuk setiap baris data
			while($row = $result->fetch_row()){
				$row = array_map('addslashes', $row);
				$row = array_map('htmlspecialchars', $row);
				$insertQuery = "INSERT INTO $table VALUES (";
				for($i=0; $i<$numColumns; $i++){
					$insertQuery .= '"'.$row[$i].'", ';
				}
				$insertQuery = substr($insertQuery, 0, -2);
				$insertQuery .= ");\n";
				fwrite($handle, $insertQuery);
			}
			
			fwrite($handle, "\n\n\n");
			fclose($handle);
			$conn->close();

			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Berhasil Di Backup";
			$json["url"]        = base_url()."index.php/operation/backupdb";

			echo json_encode($json);
		}
	}

?>