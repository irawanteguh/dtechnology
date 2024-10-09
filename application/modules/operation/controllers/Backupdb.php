<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backupdb extends CI_Controller {

		public static $host;
		public static $user;
		public static $password;
		public static $database;
		public static $pathdatabase;
		public static $backupPath;

		public function __construct(){
            parent:: __construct();
            rootsystem::system();

			self::$host         = $this->db->hostname;
			self::$user         = $this->db->username;
			self::$password     = $this->db->password;
			self::$database     = $this->db->database;
			self::$pathdatabase = FCPATH."database/";
			self::$backupPath   = self::$pathdatabase.date('Y-m-d-H:i:s').'.sql';
        }

		public function index(){
            $filesdb = "";
			$directory = FCPATH . 'database/';
			if (is_dir($directory)) {
				$files = glob($directory . '*.sql');
				foreach ($files as $file) {
					$filename = basename($file);
					$fileTime = filemtime($file);
					$dateModified = date("F j, Y", $fileTime);

					$filesdb .= "
						<div class='col-md-6 col-lg-4 col-xl-3 animate__animated animate__zoomIn'>
							<div class='card h-100'>
								<div class='card-body d-flex justify-content-center text-center flex-column p-8'>
									<a href='download.php?file=" . urlencode($filename) . "' class='text-gray-800 text-hover-primary d-flex flex-column'>
										<div class='symbol symbol-60px mb-5'>
											<img src='" . base_url("assets/images/files/sql.svg") . "' alt='sql image'>
										</div>
										<div class='fs-5 fw-bolder mb-2'>" . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') . "</div>
									</a>
									<div class='fs-7 fw-bold text-gray-400'>" . $dateModified . "</div><br>
									<button onclick='confirmDeletion(\"" . addslashes($filename) . "\")' class='btn btn-danger'>Delete</button>
								</div>
							</div>
						</div>";
				}
			}


            $data['filesdb']  = $filesdb;
            $this->template->load("template/template-sidebar","v_backupdb",$data);
		}

        function backupdatabase(){
			if(!is_dir(self::$pathdatabase)){
				mkdir(self::$pathdatabase, 0777, true);      
			};
			
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
			if ($conn->connect_error) {
				die("Koneksi ke database gagal: " . $conn->connect_error);
			}
			
			$tables = array();
			$result = $conn->query("SHOW TABLES LIKE 'dt01\_%'");
			while($row = $result->fetch_row()){
				$tables[] = $row[0];
			}
			
			$handle = fopen(self::$backupPath,'w+');
			foreach($tables as $table){
				$result = $conn->query("SELECT * FROM $table");
				$numColumns = $result->field_count;
				
				fwrite($handle, "DROP TABLE IF EXISTS $table;\n\n");
				
				$createTableQuery = $conn->query("SHOW CREATE TABLE $table");
				$createTable = $createTableQuery->fetch_row();
				fwrite($handle, $createTable[1].";\n\n");
				
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
			}
			fclose($handle);
			$conn->close();

			$json["responCode"] = "00";
			$json["responHead"] = "success";
			$json["responDesc"] = "Data Berhasil Di Backup";
			$json["url"]        = base_url()."index.php/operation/backupdb";

			echo json_encode($json);
		}

		function backuptable(){
			if(!is_dir(self::$pathdatabase)){
				mkdir(self::$pathdatabase, 0777, true);      
			};
			
			$conn = new mysqli(self::$host, self::$user, self::$password, self::$database);
			if ($conn->connect_error) {
				die("Koneksi ke database gagal: " . $conn->connect_error);
			}
			
			$tables = array();
			$result = $conn->query("SHOW TABLES LIKE 'dt01\_%'");
			while($row = $result->fetch_row()){
				$tables[] = $row[0];
			}
			
			$handle = fopen(self::$backupPath,'w+');
			foreach($tables as $table){
				$result     = $conn->query("SELECT * FROM $table");
				$numColumns = $result->field_count;
				
				fwrite($handle, "DROP TABLE IF EXISTS $table;\n\n");
				
				$createTableQuery = $conn->query("SHOW CREATE TABLE $table");
				$createTable      = $createTableQuery->fetch_row();
				fwrite($handle, $createTable[1].";\n\n");
				
				fwrite($handle, "\n\n\n");
			}
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